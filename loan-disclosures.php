<?php
/**
 * Paisa in Minutes - Statutory Loan Disclosures & KFS
 * Compliant with Reserve Bank of India (RBI) Digital Lending Directives
 */

declare(strict_types=1);

$pageTitle = 'Statutory Loan Disclosures & Key Fact Statement (KFS) | Paisa in Minutes';
$pageDescription = 'Statutory loan disclosures, Key Fact Statement (KFS) standards, approved lending partner registry, and code of conduct for digital lending in India.';

require_once __DIR__ . '/includes/header.php';
$partners = $config['lending_partners'];
$rep = $config['loan']['representative_example'];
$repCalc = calculateEmi($rep['amount'], $rep['interest_rate'], $rep['tenure']);
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;">
  <div class="container container-narrow">
    <div class="text-center" style="margin-bottom: 3rem;">
      <span class="badge badge-emerald" style="margin-bottom:0.5rem;">RBI Compliance</span>
      <h1 class="heading-1" style="margin-bottom:0.75rem;">
        Statutory Digital Lending Disclosures
      </h1>
      <p class="text-lead" style="max-width: 620px; margin: 0 auto;">
        Mandatory regulatory declarations and Key Fact Statement disclosures in full compliance with the Reserve Bank of India.
      </p>
    </div>

    <!-- 1. LSP Role Declaration -->
    <div class="card" style="margin-bottom: 2rem;">
      <h2 class="heading-3" style="margin-bottom: 0.75rem;">1. Role of Lending Service Provider (LSP)</h2>
      <p style="color:var(--text-secondary); line-height:1.7; margin-bottom:1rem;">
        <strong><?= htmlspecialchars($config['company']['legal_name']) ?></strong> acts purely as a Lending Service Provider (LSP) under the <em>RBI Guidelines on Digital Lending (DOR.CRE.REC.66/21.07.001/2022-23)</em>.
      </p>
      <ul style="padding-left:1.5rem; color:var(--text-secondary); line-height:1.6;">
        <li>We are NOT an NBFC or commercial bank and do not take credit risk on our balance sheet.</li>
        <li>Loan disbursements flow directly from the regulated lender's bank account to the borrower's verified bank account without passing through any pool or pass-through account managed by the LSP.</li>
        <li>All repayments are credited directly to the regulated lender through authorized e-NACH or BBPS channels.</li>
      </ul>
    </div>

    <!-- 2. Illustrative Key Fact Statement (KFS) -->
    <div class="card" style="margin-bottom: 2rem;">
      <h2 class="heading-3" style="margin-bottom: 0.75rem;">2. Standardized Key Fact Statement (KFS) Model</h2>
      <p style="color:var(--text-secondary); line-height:1.7; margin-bottom:1.5rem;">
        Every borrower is provided a standardized Key Fact Statement in high-contrast legible format prior to entering any binding loan agreement. Below is an illustrative example:
      </p>

      <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
          <tbody>
            <tr style="border-bottom:1px solid var(--border-subtle);">
              <td style="padding:10px; font-weight:600; color:var(--text-muted);">Sanctioned Loan Principal</td>
              <td style="padding:10px; text-align:right; font-weight:700;">₹<?= number_format($rep['amount']) ?></td>
            </tr>
            <tr style="border-bottom:1px solid var(--border-subtle);">
              <td style="padding:10px; font-weight:600; color:var(--text-muted);">Annual Percentage Rate (APR)</td>
              <td style="padding:10px; text-align:right; font-weight:700; color:var(--color-royal-600);"><?= $rep['interest_rate'] ?>% p.a. (Reducing Balance)</td>
            </tr>
            <tr style="border-bottom:1px solid var(--border-subtle);">
              <td style="padding:10px; font-weight:600; color:var(--text-muted);">Loan Tenure</td>
              <td style="padding:10px; text-align:right; font-weight:700;"><?= $rep['tenure'] ?> Months (12 Installments)</td>
            </tr>
            <tr style="border-bottom:1px solid var(--border-subtle);">
              <td style="padding:10px; font-weight:600; color:var(--text-muted);">Monthly Equated Installment (EMI)</td>
              <td style="padding:10px; text-align:right; font-weight:700; color:var(--color-accent-salmon-dark);">₹<?= number_format($repCalc['emi']) ?></td>
            </tr>
            <tr style="border-bottom:1px solid var(--border-subtle);">
              <td style="padding:10px; font-weight:600; color:var(--text-muted);">Total Interest Payable Over Tenure</td>
              <td style="padding:10px; text-align:right; font-weight:700;">₹<?= number_format($repCalc['total_interest']) ?></td>
            </tr>
            <tr style="border-bottom:1px solid var(--border-subtle);">
              <td style="padding:10px; font-weight:600; color:var(--text-muted);">Upfront Processing Fee</td>
              <td style="padding:10px; text-align:right; font-weight:700;">₹1,000 + 18% GST (₹180) = ₹1,180</td>
            </tr>
            <tr style="border-bottom:1px solid var(--border-subtle); background:var(--bg-surface-subtle);">
              <td style="padding:12px 10px; font-weight:700; color:var(--text-primary);">Total Amount Payable by Borrower</td>
              <td style="padding:12px 10px; text-align:right; font-weight:800; font-size:1.05rem; color:var(--color-royal-600);">₹<?= number_format($repCalc['total_payment']) ?></td>
            </tr>
            <tr>
              <td style="padding:10px; font-weight:600; color:var(--text-muted);">Net Disbursed Amount (Principal - Fee)</td>
              <td style="padding:10px; text-align:right; font-weight:700; color:#15803d;">₹<?= number_format($rep['amount'] - 1180) ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- 3. Approved Regulated Entity (RE) Registry -->
    <div class="card" style="margin-bottom: 2rem;">
      <h2 class="heading-3" style="margin-bottom: 0.75rem;">3. Lending Partner Registry (Regulated Entities)</h2>
      <p style="color:var(--text-secondary); line-height:1.7; margin-bottom:1.5rem;">
        In accordance with digital lending transparency directives, below is the official register of our authorized lending partners:
      </p>

      <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
          <thead>
            <tr style="background:var(--bg-surface-subtle); border-bottom:2px solid var(--border-subtle); text-align:left;">
              <th style="padding:10px;">Lender Legal Name</th>
              <th style="padding:10px;">Category</th>
              <th style="padding:10px;">RBI Reg. No.</th>
              <th style="padding:10px;">APR Range</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($partners as $p): ?>
              <tr style="border-bottom:1px solid var(--border-subtle);">
                <td style="padding:10px; font-weight:700; color:var(--text-primary);"><?= htmlspecialchars($p['name']) ?></td>
                <td style="padding:10px; color:var(--text-secondary);"><?= htmlspecialchars($p['category']) ?></td>
                <td style="padding:10px; font-family:monospace;"><?= htmlspecialchars($p['rbi_reg_no']) ?></td>
                <td style="padding:10px; font-weight:600; color:var(--color-royal-600);"><?= $p['min_apr'] ?>% - <?= $p['max_apr'] ?>%</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
