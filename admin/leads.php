<?php
/**
 * Paisa in Minutes - Secure Lead Administration Dashboard
 * Allows reviewing, searching, and exporting qualified applicant leads.
 */

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/helpers.php';
$config = require __DIR__ . '/../config/app.php';

initSecureSession();

$adminPasscode = $config['security']['admin_passcode'];
$isAuthenticated = !empty($_SESSION['admin_logged_in']);
$authError = '';

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $enteredPasscode = (string) ($_POST['passcode'] ?? '');
    if (hash_equals($adminPasscode, $enteredPasscode)) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: leads.php');
        exit;
    } else {
        $authError = 'Invalid passcode provided. Access restricted.';
    }
}

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['admin_logged_in']);
    header('Location: leads.php');
    exit;
}

$pdo = getDatabaseConnection();

// Handle CSV Export
if ($isAuthenticated && isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=pim_leads_' . date('Y-m-d_His') . '.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['Ref ID', 'Name', 'Mobile', 'Amount (INR)', 'Tenure (M)', 'Income (INR)', 'Employment', 'Purpose', 'City', 'UTM Source', 'Created At']);

    $stmt = $pdo->query("SELECT lead_reference, full_name, mobile_number, loan_amount, tenure_months, monthly_income, employment_type, loan_purpose, city, utm_source, created_at FROM leads ORDER BY id DESC");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// Fetch Leads for Display
$leads = [];
$totalLeads = 0;
if ($isAuthenticated) {
    $countStmt = $pdo->query("SELECT COUNT(*) FROM leads");
    $totalLeads = (int) $countStmt->fetchColumn();

    $leadsStmt = $pdo->query("SELECT * FROM leads ORDER BY id DESC LIMIT 50");
    $leads = $leadsStmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leads Management | <?= htmlspecialchars($config['app']['name']) ?></title>
  <link rel="stylesheet" href="../assets/css/design-system.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <style>
    body { background: #0b1536; color: #fff; min-height: 100vh; padding: 2rem 1rem; }
    .admin-card { background: #111e47; border: 1px solid rgba(255,255,255,0.12); border-radius: 16px; padding: 2rem; }
    table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; font-size: 0.875rem; }
    th { background: rgba(255,255,255,0.06); text-align: left; padding: 12px; color: #ece863; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.1); }
    td { padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.06); color: #cbd5e1; }
    tr:hover td { background: rgba(255,255,255,0.03); }
    .badge-src { background: #2563eb; color: #fff; padding: 2px 8px; border-radius: 9999px; font-size: 0.75rem; }
  </style>
</head>
<body>
  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 2rem;">
      <div>
        <h1 style="color:#fff; font-size:1.75rem;">Lead Administration Console</h1>
        <p style="color:#94a3b8; font-size:0.9rem;"><?= htmlspecialchars($config['app']['name']) ?> &bull; Qualified Application Logs</p>
      </div>
      <?php if ($isAuthenticated): ?>
        <div style="display:flex; gap:1rem; align-items:center;">
          <a href="leads.php?export=csv" class="btn btn-yellow btn-sm">Download CSV Export</a>
          <a href="leads.php?action=logout" class="btn btn-outline-white btn-sm">Sign Out</a>
        </div>
      <?php endif; ?>
    </div>

    <?php if (!$isAuthenticated): ?>
      <div style="max-width: 440px; margin: 4rem auto;" class="admin-card">
        <h2 style="color:#ece863; font-size: 1.35rem; margin-bottom: 0.5rem;">Admin Authentication</h2>
        <p style="color:#94a3b8; font-size: 0.85rem; margin-bottom: 1.5rem;">Enter administrative passcode to view customer application records.</p>
        
        <?php if ($authError): ?>
          <div style="background:#ef4444; color:#fff; padding:10px; border-radius:8px; margin-bottom:1rem; font-size:0.85rem;">
            <?= htmlspecialchars($authError) ?>
          </div>
        <?php endif; ?>

        <form method="POST">
          <input type="hidden" name="action" value="login">
          <div class="form-group">
            <label class="form-label" style="color:#cbd5e1;">Passcode</label>
            <input type="password" name="passcode" class="form-control" style="background:#070d1f; color:#fff; border-color:rgba(255,255,255,0.2);" placeholder="Enter access passcode" required autofocus>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Unlock Dashboard</button>
        </form>
      </div>
    <?php else: ?>
      <div class="admin-card">
        <div style="display:flex; justify-content:space-between; align-items:center;">
          <div>
            <span style="font-size:1.25rem; font-weight:700;">Recorded Leads (<?= $totalLeads ?>)</span>
            <span style="color:#94a3b8; font-size:0.85rem; margin-left:8px;">Showing recent 50 submissions</span>
          </div>
          <a href="../index.php" target="_blank" style="color:#ece863; font-size:0.85rem; text-decoration:underline;">&larr; View Live Website</a>
        </div>

        <div style="overflow-x: auto;">
          <table>
            <thead>
              <tr>
                <th>Reference</th>
                <th>Applicant Name</th>
                <th>Phone</th>
                <th>Amount</th>
                <th>Tenure</th>
                <th>Income</th>
                <th>Employment</th>
                <th>Source</th>
                <th>Submitted At</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($leads)): ?>
                <tr>
                  <td colspan="9" style="text-align:center; padding: 2.5rem; color:#64748b;">No leads recorded yet. Complete an application flow to test!</td>
                </tr>
              <?php else: ?>
                <?php foreach ($leads as $l): ?>
                  <tr>
                    <td><strong><?= htmlspecialchars($l['lead_reference']) ?></strong></td>
                    <td><?= htmlspecialchars($l['full_name']) ?></td>
                    <td>+91 <?= htmlspecialchars($l['mobile_number']) ?></td>
                    <td style="color:#ece863; font-weight:700;">₹<?= number_format((int)$l['loan_amount']) ?></td>
                    <td><?= (int)$l['tenure_months'] ?> M</td>
                    <td>₹<?= number_format((int)$l['monthly_income']) ?></td>
                    <td><?= htmlspecialchars($l['employment_type']) ?></td>
                    <td><span class="badge-src"><?= htmlspecialchars($l['utm_source'] ?: 'website') ?></span></td>
                    <td style="font-size:0.8rem; color:#94a3b8;"><?= htmlspecialchars($l['created_at']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
