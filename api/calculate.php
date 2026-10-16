<?php
/**
 * Paisa in Minutes - Server-Side EMI Calculation API
 * Provides mathematically verified reducing-balance repayments & amortization
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../includes/helpers.php';
$config = require __DIR__ . '/../config/app.php';

$principal = (float) ($_GET['amount'] ?? $_POST['amount'] ?? $config['loan']['default_amount']);
$annualRate = (float) ($_GET['rate'] ?? $_POST['rate'] ?? $config['loan']['default_apr']);
$tenureMonths = (int) ($_GET['tenure'] ?? $_POST['tenure'] ?? $config['loan']['default_tenure']);

// Clamp to business parameters
$principal = min(max($principal, $config['loan']['min_amount']), $config['loan']['max_amount']);
$annualRate = min(max($annualRate, $config['loan']['min_apr']), $config['loan']['max_apr']);
if (!in_array($tenureMonths, $config['loan']['tenures'], true)) {
    $tenureMonths = $config['loan']['default_tenure'];
}

$result = calculateEmi($principal, $annualRate, $tenureMonths);

echo json_encode([
    'success' => true,
    'principal' => $result['principal'],
    'principal_formatted' => formatIndianCurrency($result['principal']),
    'annual_rate_pct' => $annualRate,
    'tenure_months' => $tenureMonths,
    'emi' => $result['emi'],
    'emi_formatted' => formatIndianCurrency($result['emi']),
    'total_interest' => $result['total_interest'],
    'total_interest_formatted' => formatIndianCurrency($result['total_interest']),
    'total_payment' => $result['total_payment'],
    'total_payment_formatted' => formatIndianCurrency($result['total_payment']),
    'principal_percentage' => round(($result['principal'] / $result['total_payment']) * 100, 1),
    'interest_percentage' => round(($result['total_interest'] / $result['total_payment']) * 100, 1),
]);
