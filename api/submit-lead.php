<?php
/**
 * Paisa in Minutes - Lead Capture & Application API Endpoint
 * Handles server-side validation, CSRF verification, rate-limiting,
 * duplicate prevention, SQLite storage, and optional CRM dispatch.
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/helpers.php';
$config = require __DIR__ . '/../config/app.php';

// Accept only POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

try {
    $pdo = getDatabaseConnection();
    $clientIp = getClientIp();

    // 1. Rate Limiting Check
    $maxPerHour = $config['security']['max_lead_submissions_per_ip_hour'] ?? 5;
    $windowSeconds = $config['security']['rate_limit_window_seconds'] ?? 3600;
    if (!checkRateLimit($pdo, $clientIp, 'lead_submission', $maxPerHour, $windowSeconds)) {
        http_response_code(429);
        echo json_encode([
            'success' => false,
            'message' => 'Too many application attempts from this network. Please wait a while before trying again.',
        ]);
        exit;
    }

    // 2. CSRF Token Verification
    $csrfToken = $_POST['csrf_token'] ?? '';
    if (!validateCsrfToken($csrfToken)) {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'message' => 'Your security session has expired. Please refresh the page and submit again.',
        ]);
        exit;
    }

    // 3. Extract & Sanitize Inputs
    $fullName = cleanInput($_POST['fullName'] ?? '');
    $mobile = preg_replace('/[^0-9]/', '', (string) ($_POST['mobileNumber'] ?? ''));
    $email = filter_var(trim((string) ($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL) ?: null;
    $employmentType = cleanInput($_POST['employmentType'] ?? 'Salaried');
    $monthlyIncome = (int) ($_POST['monthlyIncome'] ?? 0);
    $loanAmount = (int) ($_POST['loanAmount'] ?? $config['loan']['default_amount']);
    $tenureMonths = (int) ($_POST['loanTenure'] ?? $config['loan']['default_tenure']);
    $loanPurpose = cleanInput($_POST['loanPurpose'] ?? 'Personal Needs');
    $city = cleanInput($_POST['city'] ?? '');
    $pincode = preg_replace('/[^0-9]/', '', (string) ($_POST['pincode'] ?? ''));
    $pan = strtoupper(trim((string) ($_POST['panNumber'] ?? '')));
    $partnerPreferred = cleanInput($_POST['partnerPreferred'] ?? '');
    $consent = !empty($_POST['finalConsentCheck']) ? 1 : 0;

    // 4. Strict Server-Side Validations
    $errors = [];

    if (strlen($fullName) < 3) {
        $errors[] = 'Full legal name must contain at least 3 characters.';
    }

    if (!isValidIndianMobile($mobile)) {
        $errors[] = 'Please provide a valid 10-digit Indian mobile number.';
    }

    if ($monthlyIncome < 10000) {
        $errors[] = 'Minimum required monthly in-hand income is ₹10,000.';
    }

    // Enforce configured boundary (Strict personal loan limit: ₹1,00,000)
    if ($loanAmount < $config['loan']['min_amount'] || $loanAmount > $config['loan']['max_amount']) {
        $errors[] = sprintf(
            'Loan amount must be between ₹%s and ₹%s.',
            number_format($config['loan']['min_amount']),
            number_format($config['loan']['max_amount'])
        );
    }

    if (!in_array($tenureMonths, $config['loan']['tenures'], true)) {
        $tenureMonths = $config['loan']['default_tenure'];
    }

    if ($pincode && strlen($pincode) !== 6) {
        $errors[] = 'PIN code must be exactly 6 digits.';
    }

    if ($pan && !isValidPan($pan)) {
        $errors[] = 'Invalid PAN format. Example format: ABCDE1234F.';
    }

    if (!$consent) {
        $errors[] = 'Consent to check eligibility with lending partners is required.';
    }

    if (!empty($errors)) {
        http_response_code(422);
        echo json_encode([
            'success' => false,
            'message' => implode(' ', $errors),
            'errors' => $errors,
        ]);
        exit;
    }

    // 5. Duplicate Submission Prevention (within 15 minutes for same mobile number)
    $fifteenMinsAgo = date('Y-m-d H:i:s', time() - 900);
    $dupStmt = $pdo->prepare("SELECT lead_reference, created_at FROM leads WHERE mobile_number = :mobile AND created_at >= :recent LIMIT 1");
    $dupStmt->execute([
        ':mobile' => $mobile,
        ':recent' => $fifteenMinsAgo,
    ]);
    $existingLead = $dupStmt->fetch();

    if ($existingLead) {
        echo json_encode([
            'success' => true,
            'is_duplicate' => true,
            'lead_reference' => $existingLead['lead_reference'],
            'loan_amount' => $loanAmount,
            'message' => 'We already received your application recently! Your reference number is ' . $existingLead['lead_reference'] . '. Our partner will connect shortly.',
        ]);
        exit;
    }

    // 6. Capture Attribution Data
    $attribution = captureAttribution();
    $leadReference = generateLeadReference();
    $maskedPan = $pan ? maskPan($pan) : null;
    $userAgent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500);

    // 7. Insert Lead into Database
    $insertStmt = $pdo->prepare("
        INSERT INTO leads (
            lead_reference, full_name, mobile_number, email, employment_type,
            monthly_income, loan_amount, tenure_months, loan_purpose, city, pincode,
            pan_masked, partner_preferred, consent_received, status, ip_address, user_agent,
            utm_source, utm_medium, utm_campaign, utm_content, utm_term, gclid, fbclid,
            landing_page, first_touch_source
        ) VALUES (
            :lead_reference, :full_name, :mobile_number, :email, :employment_type,
            :monthly_income, :loan_amount, :tenure_months, :loan_purpose, :city, :pincode,
            :pan_masked, :partner_preferred, :consent_received, 'qualified', :ip_address, :user_agent,
            :utm_source, :utm_medium, :utm_campaign, :utm_content, :utm_term, :gclid, :fbclid,
            :landing_page, :first_touch_source
        )
    ");

    $insertStmt->execute([
        ':lead_reference' => $leadReference,
        ':full_name' => $fullName,
        ':mobile_number' => $mobile,
        ':email' => $email,
        ':employment_type' => $employmentType,
        ':monthly_income' => $monthlyIncome,
        ':loan_amount' => $loanAmount,
        ':tenure_months' => $tenureMonths,
        ':loan_purpose' => $loanPurpose,
        ':city' => $city,
        ':pincode' => $pincode,
        ':pan_masked' => $maskedPan,
        ':partner_preferred' => $partnerPreferred,
        ':consent_received' => 1,
        ':ip_address' => $clientIp,
        ':user_agent' => $userAgent,
        ':utm_source' => $attribution['utm_source'],
        ':utm_medium' => $attribution['utm_medium'],
        ':utm_campaign' => $attribution['utm_campaign'],
        ':utm_content' => $attribution['utm_content'],
        ':utm_term' => $attribution['utm_term'],
        ':gclid' => $attribution['gclid'],
        ':fbclid' => $attribution['fbclid'],
        ':landing_page' => $attribution['landing_page'],
        ':first_touch_source' => $attribution['first_touch_source'],
    ]);

    // 8. Optional CRM Webhook Dispatch
    if (!empty($config['crm']['enabled']) && !empty($config['crm']['webhook_url'])) {
        dispatchLeadToCrm($config['crm']['webhook_url'], [
            'lead_reference' => $leadReference,
            'full_name' => $fullName,
            'mobile_number' => $mobile,
            'monthly_income' => $monthlyIncome,
            'loan_amount' => $loanAmount,
            'tenure_months' => $tenureMonths,
            'employment_type' => $employmentType,
            'city' => $city,
            'utm_source' => $attribution['utm_source'],
            'utm_campaign' => $attribution['utm_campaign'],
        ], $config['crm']['api_key'] ?? '');
    }

    // 9. Return Successful JSON Response
    echo json_encode([
        'success' => true,
        'lead_reference' => $leadReference,
        'loan_amount' => $loanAmount,
        'tenure_months' => $tenureMonths,
        'message' => 'Congratulations! Your loan discovery request has been verified and assigned reference ID ' . $leadReference,
    ]);

} catch (Throwable $e) {
    error_log('Lead submission exception: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An unexpected server error occurred. Please try again shortly.',
    ]);
}

/**
 * Non-blocking CRM dispatcher helper
 */
function dispatchLeadToCrm(string $url, array $payload, string $apiKey): void {
    if (!function_exists('curl_init')) return;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ]);
    curl_exec($ch);
    curl_close($ch);
}
