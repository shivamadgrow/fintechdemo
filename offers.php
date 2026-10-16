<?php
/**
 * Paisa in Minutes - Approved Lending Partner Offers
 * Verified, regulated NBFCs and Banks personal loan discovery directory
 */

declare(strict_types=1);

$pageTitle = 'Approved Lending Partner Offers – RBI Regulated NBFCs';
$pageDescription = 'Compare verified personal loan programs from Tata Capital, IIFL Finance, DMI Finance and InCred. Real APR ranges, processing fee disclosures, and paperless digital applications.';

require_once __DIR__ . '/includes/header.php';
$partners = $config['lending_partners'];
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;" aria-label="Partner Offers Directory">
  <div class="container">
    <!-- Header -->
    <div class="text-center" style="margin-bottom: 2.5rem;">
      <span class="badge badge-emerald" style="margin-bottom: 0.5rem;">Verified Digital Lenders</span>
      <h1 class="heading-1" style="margin-bottom: 0.75rem;">
        Approved Lending Partner Offers
      </h1>
      <p class="text-lead" style="max-width: 640px; margin: 0 auto;">
        We partner exclusively with Reserve Bank of India (RBI) registered Non-Banking Financial Companies and Banks.
      </p>
    </div>

    <!-- Regulatory Notice Banner -->
    <div style="background:#fff; border:1px solid var(--border-subtle); border-radius:16px; padding:1.25rem 1.75rem; margin-bottom: 2.5rem; display:flex; align-items:center; gap:1.25rem;">
      <div style="font-size:2rem;">🏛️</div>
      <div style="font-size:0.875rem; color:var(--text-secondary); line-height:1.5;">
        <strong style="color:var(--text-primary);">Third-Party Lending Disclosures:</strong>
        Paisa in Minutes does not underwrite, sanction, or collect repayments directly. All loan quotations, credit appraisals, and disbursal decisions are made independently by the respective regulated lender listed below in accordance with digital lending guidelines.
      </div>
    </div>

    <!-- Partner Offers Cards Grid -->
    <div class="grid grid-cols-2" style="gap: 2rem;">
      <?php foreach ($partners as $p): ?>
        <div class="card" style="display:flex; flex-direction:column; justify-content:space-between; background:#fff; border-radius:24px;">
          <div>
            <!-- Top Badges -->
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 1rem;">
              <span class="badge badge-emerald"><?= htmlspecialchars($p['badge']) ?></span>
              <span style="font-size:0.75rem; color:var(--text-muted); font-weight:600;">RBI: <?= htmlspecialchars($p['rbi_reg_no']) ?></span>
            </div>

            <!-- Lender Name & Category -->
            <h2 class="heading-3" style="margin-bottom: 0.35rem;"><?= htmlspecialchars($p['name']) ?></h2>
            <p style="font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 1.5rem;">
              <?= htmlspecialchars($p['category']) ?>
            </p>

            <!-- Metrics Matrix -->
            <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem; background:var(--bg-surface-subtle); padding:1.25rem; border-radius:16px; margin-bottom:1.5rem;">
              <div>
                <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Max Amount</div>
                <div style="font-size:1.25rem; font-weight:800; color:var(--color-royal-600); margin-top:2px;">₹<?= number_format($p['max_amount']) ?></div>
              </div>
              <div>
                <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Annual Rate (APR)</div>
                <div style="font-size:1.25rem; font-weight:800; color:var(--text-primary); margin-top:2px;"><?= $p['min_apr'] ?>% - <?= $p['max_apr'] ?>%</div>
              </div>
              <div>
                <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Tenure Range</div>
                <div style="font-size:0.95rem; font-weight:700; color:var(--text-primary); margin-top:2px;"><?= $p['min_tenure'] ?> to <?= $p['max_tenure'] ?> Months</div>
              </div>
              <div>
                <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; font-weight:600;">Processing Fee</div>
                <div style="font-size:0.95rem; font-weight:700; color:var(--text-primary); margin-top:2px;"><?= htmlspecialchars($p['processing_fee']) ?></div>
              </div>
            </div>

            <!-- Disbursal Details -->
            <div style="font-size:0.875rem; color:var(--text-secondary); margin-bottom:1.5rem; line-height:1.5;">
              <strong style="color:var(--text-primary);">Turnaround Speed:</strong> <?= htmlspecialchars($p['disbursal_speed']) ?>
            </div>
          </div>

          <!-- Card Actions -->
          <div style="display:flex; gap:1rem; align-items:center;">
            <a href="check-eligibility.php?partner=<?= htmlspecialchars($p['id']) ?>" class="btn btn-primary btn-block" data-partner-outbound="<?= htmlspecialchars($p['id']) ?>" data-partner-name="<?= htmlspecialchars($p['name']) ?>">
              Check Eligibility for <?= htmlspecialchars(explode(' ', $p['name'])[0]) ?> &rarr;
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
