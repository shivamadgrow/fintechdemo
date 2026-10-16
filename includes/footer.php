<?php
/**
 * Paisa in Minutes - Global Footer Include
 * Regulatory compliance notes, representative disclosures, legal links, scripts.
 */

declare(strict_types=1);

$config = require __DIR__ . '/../config/app.php';
$rep = $config['loan']['representative_example'];
$repCalc = calculateEmi($rep['amount'], $rep['interest_rate'], $rep['tenure']);
$repFee = round($rep['amount'] * ($rep['processing_fee_pct'] / 100));
$repGst = round($repFee * ($rep['gst_pct'] / 100));
?>
</main><!-- /#mainContent -->

<!-- Global Cookie Consent Notice -->
<?php require_once __DIR__ . '/cookie-consent.php'; ?>

<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="grid grid-cols-4" style="gap: 2.5rem;">
      <!-- Col 1: About & Brand -->
      <div style="grid-column: span 1.3;">
        <div style="display:flex; align-items:center; gap:0.6rem; margin-bottom:1rem;">
          <div style="width:32px; height:32px; background:var(--color-royal-600); border-radius:8px; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800;">
            ₹
          </div>
          <span style="font-family:var(--font-heading); font-size:1.35rem; font-weight:800; color:#fff;">
            Paisa<span style="color:var(--color-accent-yellow);">inMinutes</span>
          </span>
        </div>
        <p style="color:#94a3b8; font-size:0.875rem; line-height:1.6; margin-bottom:1.25rem;">
          India's trusted personal loan discovery and eligibility platform. We connect credit-seeking individuals with RBI-registered Banks and NBFCs for fast, fair, and paperless loan disbursals up to ₹1,00,000.
        </p>
        <div style="display:flex; flex-direction:column; gap:0.4rem; font-size:0.8125rem;">
          <div><strong style="color:#cbd5e1;">Support:</strong> <a href="tel:<?= preg_replace('/\s+/', '', $config['company']['phone']) ?>"><?= htmlspecialchars($config['company']['phone']) ?></a></div>
          <div><strong style="color:#cbd5e1;">Email:</strong> <a href="mailto:<?= htmlspecialchars($config['company']['email']) ?>"><?= htmlspecialchars($config['company']['email']) ?></a></div>
          <div><strong style="color:#cbd5e1;">CIN:</strong> <?= htmlspecialchars($config['company']['cin']) ?></div>
        </div>
      </div>

      <!-- Col 2: Products & Calculators -->
      <div>
        <h5>Loan Products</h5>
        <ul class="footer-links">
          <li><a href="check-eligibility.php">Personal Loans (₹10k - ₹1L)</a></li>
          <li><a href="personal-loan-calculator.php">EMI Loan Calculator</a></li>
          <li><a href="offers.php">Partner Loan Offers</a></li>
          <li><a href="how-it-works.php">Digital Lending Journey</a></li>
          <li><a href="check-eligibility.php?type=salaried">Salaried Personal Loan</a></li>
          <li><a href="check-eligibility.php?type=self-employed">Self-Employed Loan</a></li>
        </ul>
      </div>

      <!-- Col 3: Company & Education -->
      <div>
        <h5>Resources</h5>
        <ul class="footer-links">
          <li><a href="about.php">About Us</a></li>
          <li><a href="how-it-works.php">How It Works</a></li>
          <li><a href="faq.php">Frequently Asked Questions</a></li>
          <li><a href="blog.php">Financial Literacy Guides</a></li>
          <li><a href="contact.php">Contact & Support</a></li>
          <li><a href="admin/leads.php" style="color:#64748b; font-size:0.75rem;">Admin Access</a></li>
        </ul>
      </div>

      <!-- Col 4: Regulatory & Compliance -->
      <div>
        <h5>Compliance & Legal</h5>
        <ul class="footer-links">
          <li><a href="privacy-policy.php">Privacy Policy (DPDP Act)</a></li>
          <li><a href="terms-and-conditions.php">Terms & Conditions</a></li>
          <li><a href="loan-disclosures.php">RBI Digital Lending Disclosures</a></li>
          <li><a href="grievance-redressal.php">Grievance Redressal Matrix</a></li>
          <li><a href="sitemap.xml">XML Sitemap</a></li>
        </ul>
      </div>
    </div>

    <!-- Mandatory RBI Digital Lending & Key Fact Statement (KFS) Disclosures -->
    <div class="footer-disclosures">
      <p style="margin-bottom: 0.85rem;">
        <strong>Statutory Regulatory Notice:</strong> <?= htmlspecialchars($config['company']['legal_name']) ?> operates strictly as a Lending Service Provider (LSP) and loan aggregator facilitating digital discovery. We are NOT a Bank, Non-Banking Financial Company (NBFC), or money lender, and we do not directly lend money or accept public deposits. All personal loan applications, credit appraisals, underwriting, sanctions, and disbursals are executed directly by our RBI-registered lending partners in full adherence to the Reserve Bank of India’s Digital Lending Guidelines. Submitting an application on this platform does NOT guarantee loan approval or disbursal.
      </p>
      <p style="margin-bottom: 0.85rem;">
        <strong>Representative Loan Example (Key Fact Statement Illustrative):</strong> For a personal loan of <strong>₹<?= number_format($rep['amount']) ?></strong> borrowed at an Annual Percentage Rate (APR) of <strong><?= $rep['interest_rate'] ?>%</strong> for a tenure of <strong><?= $rep['tenure'] ?> Months</strong>: Monthly Equated Installment (EMI) is <strong>₹<?= number_format($repCalc['emi']) ?></strong>. Total interest payable over the tenure is <strong>₹<?= number_format($repCalc['total_interest']) ?></strong>. Processing fee is ₹<?= number_format($repFee) ?> + 18% GST (₹<?= number_format($repGst) ?>). Total cost of the loan (Principal + Interest) is <strong>₹<?= number_format($repCalc['total_payment']) ?></strong>. Net disbursal amount: ₹<?= number_format($rep['amount'] - $repFee - $repGst) ?>. Representative APR range across approved partners: <?= $config['loan']['min_apr'] ?>% to <?= $config['loan']['max_apr'] ?>%. Repayment tenure: 3 months to 24 months.
      </p>
      <p>
        <strong>Nodal Grievance Redressal Officer:</strong> <?= htmlspecialchars($config['company']['nodal_officer']['name']) ?>, <?= htmlspecialchars($config['company']['nodal_officer']['designation']) ?> | Email: <a href="mailto:<?= htmlspecialchars($config['company']['nodal_officer']['email']) ?>" style="color:#ece863;"><?= htmlspecialchars($config['company']['nodal_officer']['email']) ?></a> | Phone: <?= htmlspecialchars($config['company']['nodal_officer']['phone']) ?> | Escalation Portal: <a href="https://sachet.rbi.org.in/" target="_blank" rel="noopener noreferrer" style="color:#ece863;">RBI Sachet Portal</a>.
      </p>
    </div>

    <!-- Bottom Copyright -->
    <div class="footer-bottom">
      <div>
        &copy; <?= date('Y') ?> <?= htmlspecialchars($config['company']['legal_name']) ?>. All rights reserved.
      </div>
      <div style="display:flex; gap:1.5rem;">
        <a href="privacy-policy.php">Privacy</a>
        <a href="terms-and-conditions.php">Terms</a>
        <a href="loan-disclosures.php">Disclosures</a>
        <a href="grievance-redressal.php">Grievance</a>
      </div>
    </div>
  </div>
</footer>

<!-- Core JavaScript Assets -->
<script src="assets/js/main.js?v=<?= $config['app']['version'] ?>" defer></script>
<script src="assets/js/analytics.js?v=<?= $config['app']['version'] ?>" defer></script>
</body>
</html>
