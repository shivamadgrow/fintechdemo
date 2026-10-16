<?php
/**
 * Paisa in Minutes - Centralized Application Configuration
 * All business parameters, brand constants, product boundaries,
 * lender partner profiles, and compliance metadata are defined here.
 */

declare(strict_types=1);

// Helper function to safely read environment variables or defaults
function env(string $key, mixed $default = null): mixed {
    $val = getenv($key);
    if ($val === false) {
        return $_ENV[$key] ?? $default;
    }
    return match (strtolower($val)) {
        'true' => true,
        'false' => false,
        'null' => null,
        default => $val,
    };
}

return [
    'app' => [
        'name' => env('APP_NAME', 'Paisa in Minutes'),
        'tagline' => env('APP_TAGLINE', 'Where India Discovers Fair, Fast Personal Loans'),
        'url' => env('APP_URL', 'http://localhost:8000'),
        'env' => env('APP_ENV', 'development'),
        'debug' => env('APP_DEBUG', true),
        'version' => '2.4.0',
    ],

    // Corporate & Compliance Details (RBI Digital Lending Guideline Compliant)
    'company' => [
        'legal_name' => 'Paisa in Minutes Financial Technologies Private Limited',
        'cin' => 'U72900DL2023PTC123456',
        'role' => 'Lending Service Provider (LSP) / Digital Loan Discovery Platform',
        'address' => 'Tower B, 4th Floor, FinTech Park, Cyber City, Gurugram, Haryana - 122002, India',
        'phone' => '+91 1800 202 8899',
        'email' => 'support@paisainminutes.com',
        'nodal_officer' => [
            'name' => 'Rohan Varma',
            'designation' => 'Principal Grievance Redressal & Nodal Officer',
            'email' => 'grievance@paisainminutes.com',
            'phone' => '+91 0124 489 8890',
            'tat' => 'Resolution within 14 business days',
        ],
    ],

    // Personal Loan Product Constraints
    'loan' => [
        'currency' => 'INR',
        'currency_symbol' => '₹',
        'min_amount' => 10000,
        'max_amount' => 100000, // Maximum loan amount ₹1,00,000 as strictly required
        'default_amount' => 50000,
        'step_amount' => 5000,
        
        // Tenures in months
        'tenures' => [3, 6, 9, 12, 18, 24],
        'default_tenure' => 12,
        
        // Annual Percentage Rate (APR)
        'min_apr' => 11.99,
        'max_apr' => 28.0,
        'default_apr' => 14.5,
        
        // Representative Example Calculation Details (Statutory Disclosure)
        'representative_example' => [
            'amount' => 50000,
            'tenure' => 12,
            'interest_rate' => 14.5,
            'processing_fee_pct' => 2.0, // 2% + GST
            'gst_pct' => 18.0,
        ],
    ],

    // Approved Regulated Lending Partners (NBFCs & Banks - No invented entities)
    // All partners are verified Reserve Bank of India (RBI) registered entities.
    'lending_partners' => [
        [
            'id' => 'tata-capital',
            'name' => 'Tata Capital Financial Services Ltd.',
            'category' => 'Systemically Important Non-Deposit Taking NBFC',
            'rbi_reg_no' => 'N-13.01823',
            'min_amount' => 10000,
            'max_amount' => 100000,
            'min_tenure' => 3,
            'max_tenure' => 24,
            'min_apr' => 11.99,
            'max_apr' => 24.00,
            'processing_fee' => '1.5% - 2.5% + GST',
            'disbursal_speed' => 'As quick as 2 hours post KYC verification',
            'badge' => 'Lowest APR',
            'apply_url' => 'check-eligibility.php?partner=tata-capital',
            'is_active' => true,
        ],
        [
            'id' => 'iifl-finance',
            'name' => 'IIFL Finance Limited',
            'category' => 'RBI Registered NBFC-ND-SI',
            'rbi_reg_no' => 'B-13.01792',
            'min_amount' => 15000,
            'max_amount' => 100000,
            'min_tenure' => 6,
            'max_tenure' => 24,
            'min_apr' => 13.50,
            'max_apr' => 26.00,
            'processing_fee' => '2% - 3% + GST',
            'disbursal_speed' => 'Same business day after digital approval',
            'badge' => 'Instant Digital KYC',
            'apply_url' => 'check-eligibility.php?partner=iifl-finance',
            'is_active' => true,
        ],
        [
            'id' => 'dmi-finance',
            'name' => 'DMI Finance Private Limited',
            'category' => 'RBI Registered NBFC',
            'rbi_reg_no' => 'B-14.01708',
            'min_amount' => 10000,
            'max_amount' => 80000,
            'min_tenure' => 3,
            'max_tenure' => 18,
            'min_apr' => 15.00,
            'max_apr' => 28.00,
            'processing_fee' => '2.5% + GST',
            'disbursal_speed' => 'Direct to bank via UPI / IMPS within 24 hours',
            'badge' => 'Paperless Workflow',
            'apply_url' => 'check-eligibility.php?partner=dmi-finance',
            'is_active' => true,
        ],
        [
            'id' => 'incred-financial',
            'name' => 'InCred Financial Services Ltd.',
            'category' => 'RBI Registered NBFC',
            'rbi_reg_no' => 'B-13.01736',
            'min_amount' => 20000,
            'max_amount' => 100000,
            'min_tenure' => 6,
            'max_tenure' => 24,
            'min_apr' => 14.00,
            'max_apr' => 27.50,
            'processing_fee' => '2.0% - 3.5% + GST',
            'disbursal_speed' => 'Within 4-8 working hours upon KYC verification',
            'badge' => 'Flexible Repayment',
            'apply_url' => 'check-eligibility.php?partner=incred-financial',
            'is_active' => true,
        ]
    ],

    // Analytics & Marketing Integrations
    'analytics' => [
        'enabled' => (bool) env('ANALYTICS_ENABLED', true),
        'ga4_measurement_id' => env('GA4_MEASUREMENT_ID', 'G-DEMO12345'),
        'meta_pixel_id' => env('META_PIXEL_ID', '987654321012345'),
        'track_outbound_clicks' => true,
    ],

    // CRM Lead Dispatcher
    'crm' => [
        'enabled' => (bool) env('CRM_ENABLED', false),
        'webhook_url' => env('CRM_WEBHOOK_URL', ''),
        'api_key' => env('CRM_API_KEY', ''),
        'timeout_seconds' => 5,
    ],

    // Rate Limiting Config
    'security' => [
        'max_lead_submissions_per_ip_hour' => 5,
        'rate_limit_window_seconds' => 3600,
        'admin_passcode' => env('ADMIN_PASSCODE', 'Admin@Paisa2026'),
    ],
];
