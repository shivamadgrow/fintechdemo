<?php
/**
 * Automated Verification Test Script
 * Verifies EMI formula calculations, database insertion, and retrieval.
 */

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/helpers.php';
$config = require __DIR__ . '/../config/app.php';

echo "====================================================\n";
echo "PAISA IN MINUTES - AUTOMATED TEST SUITE\n";
echo "====================================================\n\n";

// Test 1: EMI Calculation Formula
echo "TEST 1: Reducing-balance EMI math verification...\n";
$calc = calculateEmi(50000, 14.5, 12);
echo "Principal: ₹50,000 | Tenure: 12M | Rate: 14.5%\n";
echo "Monthly EMI: " . formatIndianCurrency($calc['emi']) . "\n";
echo "Total Interest: " . formatIndianCurrency($calc['total_interest']) . "\n";
echo "Total Repayment: " . formatIndianCurrency($calc['total_payment']) . "\n";
assert($calc['emi'] > 4400 && $calc['emi'] < 4600, "EMI is mathematically within expected reducing balance bounds");
echo "[PASS] Test 1 passed successfully!\n\n";

// Test 2: Zero Interest Edge Case
echo "TEST 2: Zero interest edge case handling...\n";
$zeroCalc = calculateEmi(60000, 0, 6);
assert($zeroCalc['emi'] === 10000, "Zero interest EMI should be exactly 60000 / 6 = 10000");
assert($zeroCalc['total_interest'] === 0, "Zero interest total interest should be 0");
echo "[PASS] Test 2 passed successfully!\n\n";

// Test 3: Database Lead Retrieval
echo "TEST 3: Database records verification...\n";
$pdo = getDatabaseConnection();
$stmt = $pdo->query("SELECT lead_reference, full_name, mobile_number, loan_amount, monthly_income, status, created_at FROM leads ORDER BY id DESC LIMIT 5");
$leads = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Total leads retrieved: " . count($leads) . "\n";
foreach ($leads as $l) {
    echo "- Ref: {$l['lead_reference']} | Name: {$l['full_name']} | Mobile: {$l['mobile_number']} | Amount: ₹{$l['loan_amount']} | Status: {$l['status']}\n";
}
assert(count($leads) >= 1, "At least 1 lead should be present");
echo "[PASS] Test 3 passed successfully!\n\n";

// Test 4: Mobile & PAN Validation regexes
echo "TEST 4: Indian mobile number & PAN format validations...\n";
assert(isValidIndianMobile("9876543210") === true, "Valid Indian mobile must pass");
assert(isValidIndianMobile("1234567890") === false, "Invalid start digit must fail");
assert(isValidIndianMobile("98765") === false, "Short mobile number must fail");
assert(isValidPan("ABCDE1234F") === true, "Valid PAN must pass");
assert(isValidPan("12345ABCDE") === false, "Invalid PAN structure must fail");
echo "[PASS] Test 4 passed successfully!\n\n";

echo "====================================================\n";
echo "ALL TESTS PASSED WITH 100% SUCCESS!\n";
echo "====================================================\n";
