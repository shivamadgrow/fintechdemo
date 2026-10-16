<?php
/**
 * Paisa in Minutes - SQLite Database Connection & Schema Initialization
 * Provides safe PDO connection and automatically creates tables if not exists.
 */

declare(strict_types=1);

function getDatabaseConnection(): PDO {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $dataDir = __DIR__ . '/../data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }

    // Protect data directory from direct web browser access
    $htaccess = $dataDir . '/.htaccess';
    if (!file_exists($htaccess)) {
        file_put_contents($htaccess, "Require all denied\nDeny from all\n");
    }

    $dbFile = $dataDir . '/leads.sqlite';
    $dsn = 'sqlite:' . $dbFile;

    try {
        $pdo = new PDO($dsn, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        // Enable SQLite Write-Ahead Logging for better concurrency
        $pdo->exec('PRAGMA journal_mode = WAL;');
        $pdo->exec('PRAGMA synchronous = NORMAL;');

        // Initialize tables if needed
        initializeDatabaseSchema($pdo);

        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage());
        throw new RuntimeException("Could not connect to the database.");
    }
}

function initializeDatabaseSchema(PDO $pdo): void {
    $schema = "
        CREATE TABLE IF NOT EXISTS leads (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            lead_reference VARCHAR(32) UNIQUE NOT NULL,
            full_name VARCHAR(120) NOT NULL,
            mobile_number VARCHAR(15) NOT NULL,
            email VARCHAR(150),
            employment_type VARCHAR(40) NOT NULL,
            monthly_income INTEGER NOT NULL,
            loan_amount INTEGER NOT NULL,
            tenure_months INTEGER NOT NULL,
            loan_purpose VARCHAR(80),
            city VARCHAR(80),
            pincode VARCHAR(10),
            pan_masked VARCHAR(20),
            partner_preferred VARCHAR(60),
            consent_received INTEGER DEFAULT 1,
            status VARCHAR(30) DEFAULT 'qualified',
            ip_address VARCHAR(50),
            user_agent TEXT,
            utm_source VARCHAR(100),
            utm_medium VARCHAR(100),
            utm_campaign VARCHAR(100),
            utm_content VARCHAR(100),
            utm_term VARCHAR(100),
            gclid VARCHAR(150),
            fbclid VARCHAR(150),
            landing_page VARCHAR(255),
            first_touch_source VARCHAR(100),
            crm_synced INTEGER DEFAULT 0,
            crm_sync_response TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE INDEX IF NOT EXISTS idx_leads_mobile ON leads(mobile_number);
        CREATE INDEX IF NOT EXISTS idx_leads_created_at ON leads(created_at);
        CREATE INDEX IF NOT EXISTS idx_leads_lead_ref ON leads(lead_reference);

        CREATE TABLE IF NOT EXISTS rate_limits (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            ip_address VARCHAR(50) NOT NULL,
            action VARCHAR(50) NOT NULL,
            timestamp INTEGER NOT NULL
        );
        CREATE INDEX IF NOT EXISTS idx_rate_limits_ip_action ON rate_limits(ip_address, action, timestamp);

        CREATE TABLE IF NOT EXISTS outbound_clicks (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            partner_id VARCHAR(60) NOT NULL,
            user_ip VARCHAR(50),
            utm_source VARCHAR(100),
            utm_campaign VARCHAR(100),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ";

    $pdo->exec($schema);
}
