<?php
/**
 * Paisa in Minutes - Core Helper Functions
 * Security, sanitization, mathematical calculation, UTM attribution & formatting.
 */

declare(strict_types=1);

/**
 * Initializes secure PHP session
 */
function initSecureSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        // Secure cookie parameters
        $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? 80) == 443;
        session_set_cookie_params([
            'lifetime' => 86400 * 7,
            'path' => '/',
            'domain' => '',
            'secure' => $isSecure,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }
}

/**
 * Generates or returns active CSRF token
 */
function getCsrfToken(): string {
    initSecureSession();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validates submitted CSRF token
 */
function validateCsrfToken(?string $token): bool {
    initSecureSession();
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Format number into Indian Currency format (e.g. ₹1,00,000 or 50,000)
 */
function formatIndianCurrency(float|int $amount, bool $withSymbol = true): string {
    $amount = round($amount);
    $isNegative = $amount < 0;
    $amountStr = (string) abs((int) $amount);
    
    $len = strlen($amountStr);
    if ($len <= 3) {
        $formatted = $amountStr;
    } else {
        $lastThree = substr($amountStr, -3);
        $remaining = substr($amountStr, 0, $len - 3);
        // Split remaining into groups of 2 from right to left
        $reversed = strrev($remaining);
        $groups = str_split($reversed, 2);
        $formattedRemaining = strrev(implode(',', $groups));
        $formatted = $formattedRemaining . ',' . $lastThree;
    }

    $prefix = $isNegative ? '-' : '';
    $symbol = $withSymbol ? '₹' : '';
    return $prefix . $symbol . $formatted;
}

/**
 * Calculate standard reducing-balance monthly EMI
 * Formula: EMI = P × r × (1 + r)^n / ((1 + r)^n − 1)
 * Where P is principal, r is monthly interest rate, n is tenure in months
 */
function calculateEmi(float $principal, float $annualRatePct, int $tenureMonths): array {
    if ($principal <= 0 || $tenureMonths <= 0) {
        return [
            'emi' => 0,
            'total_interest' => 0,
            'total_payment' => 0,
            'principal' => 0,
        ];
    }

    if ($annualRatePct <= 0) {
        // Zero interest edge case
        $emi = round($principal / $tenureMonths);
        return [
            'emi' => (int) $emi,
            'total_interest' => 0,
            'total_payment' => (int) $principal,
            'principal' => (int) $principal,
        ];
    }

    $monthlyRate = ($annualRatePct / 12) / 100;
    $rateFactor = pow(1 + $monthlyRate, $tenureMonths);
    $emi = $principal * $monthlyRate * $rateFactor / ($rateFactor - 1);
    $emiRounded = (int) round($emi);

    $totalPayment = $emiRounded * $tenureMonths;
    $totalInterest = max(0, $totalPayment - (int) $principal);

    return [
        'emi' => $emiRounded,
        'total_interest' => $totalInterest,
        'total_payment' => $totalPayment,
        'principal' => (int) $principal,
    ];
}

/**
 * Capture and store attribution parameters in session
 */
function captureAttribution(): array {
    initSecureSession();

    $keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid'];
    $current = [];

    foreach ($keys as $key) {
        if (!empty($_GET[$key])) {
            $val = substr(trim((string) $_GET[$key]), 0, 150);
            $current[$key] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
            $_SESSION['attribution_last'][$key] = $current[$key];
        } else {
            $current[$key] = $_SESSION['attribution_last'][$key] ?? '';
        }
    }

    // Capture first touch if not already established
    if (empty($_SESSION['attribution_first'])) {
        $firstSource = $current['utm_source'] ?: (!empty($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : 'direct');
        $_SESSION['attribution_first'] = [
            'source' => $firstSource,
            'landing_page' => $_SERVER['REQUEST_URI'] ?? '/',
            'timestamp' => time(),
        ];
    }

    return [
        'utm_source' => $current['utm_source'] ?: 'website',
        'utm_medium' => $current['utm_medium'] ?: '',
        'utm_campaign' => $current['utm_campaign'] ?: '',
        'utm_term' => $current['utm_term'] ?: '',
        'utm_content' => $current['utm_content'] ?: '',
        'gclid' => $current['gclid'] ?: '',
        'fbclid' => $current['fbclid'] ?: '',
        'first_touch_source' => $_SESSION['attribution_first']['source'] ?? 'website',
        'landing_page' => $_SESSION['attribution_first']['landing_page'] ?? '/',
    ];
}

/**
 * Rate Limiting Check using SQLite
 */
function checkRateLimit(PDO $pdo, string $ip, string $action, int $maxRequests, int $windowSeconds): bool {
    $now = time();
    $cutoff = $now - $windowSeconds;

    // Prune expired records
    $pruneStmt = $pdo->prepare("DELETE FROM rate_limits WHERE timestamp < :cutoff");
    $pruneStmt->execute([':cutoff' => $cutoff]);

    // Count recent requests
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM rate_limits WHERE ip_address = :ip AND action = :action AND timestamp >= :cutoff");
    $countStmt->execute([
        ':ip' => $ip,
        ':action' => $action,
        ':cutoff' => $cutoff,
    ]);
    $count = (int) $countStmt->fetchColumn();

    if ($count >= $maxRequests) {
        return false; // Rate limit reached
    }

    // Insert current request
    $insStmt = $pdo->prepare("INSERT INTO rate_limits (ip_address, action, timestamp) VALUES (:ip, :action, :now)");
    $insStmt->execute([
        ':ip' => $ip,
        ':action' => $action,
        ':now' => $now,
    ]);

    return true;
}

/**
 * Generate human-readable Unique Lead Reference (e.g. PIM-2610-847291)
 */
function generateLeadReference(): string {
    return 'PIM-' . date('ym') . '-' . strtoupper(bin2hex(random_bytes(3)));
}

/**
 * Sanitize client inputs
 */
function cleanInput(string $data): string {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate 10-digit Indian Mobile Number
 */
function isValidIndianMobile(string $mobile): bool {
    return (bool) preg_match('/^[6-9]\d{9}$/', $mobile);
}

/**
 * Validate Indian PAN Format (e.g. ABCDE1234F)
 */
function isValidPan(string $pan): bool {
    return (bool) preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', strtoupper(trim($pan)));
}

/**
 * Mask PAN for security & data minimization: AB***123*F
 */
function maskPan(string $pan): string {
    $clean = strtoupper(trim($pan));
    if (strlen($clean) !== 10) {
        return '******';
    }
    return substr($clean, 0, 2) . '*****' . substr($clean, -2);
}

/**
 * Safe client IP extraction
 */
function getClientIp(): string {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}
