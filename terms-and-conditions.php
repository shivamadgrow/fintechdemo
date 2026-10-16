<?php
/**
 * Paisa in Minutes - Terms & Conditions
 */

declare(strict_types=1);

$pageTitle = 'Terms & Conditions – Platform Usage Agreement | Paisa in Minutes';
$pageDescription = 'Terms and Conditions governing the use of the Paisa in Minutes personal loan discovery platform, eligibility calculators, and partner referral services.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="background:#ffffff; padding-top:3.5rem;">
  <div class="container container-slim">
    <div style="margin-bottom: 2.5rem;">
      <span class="badge badge-royal" style="margin-bottom:0.5rem;">User Agreement</span>
      <h1 class="heading-2" style="margin-bottom:0.5rem;">Terms &amp; Conditions</h1>
      <p style="font-size:0.875rem; color:var(--text-muted);">
        Last Updated: October 12, 2026 &bull; Version 2.4.0
      </p>
    </div>

    <div style="font-size:0.95rem; color:var(--text-secondary); line-height:1.75;">
      <p style="margin-bottom:1.25rem;">
        Welcome to <strong>Paisa in Minutes</strong>. By browsing, accessing, or submitting any application form on this website (the "Platform"), you agree to be bound by these Terms and Conditions ("Terms"). If you do not agree with any part of these Terms, please do not use our services.
      </p>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">1. Nature of Services &amp; Regulatory Role</h2>
      <p style="margin-bottom:1.25rem;">
        Paisa in Minutes operates exclusively as a <strong>Lending Service Provider (LSP)</strong> and digital loan aggregator. We are NOT a Bank, Non-Banking Financial Company (NBFC), or money lender under Indian law. We do not directly lend money, hold loan portfolios, or collect repayment installments from borrowers.
      </p>
      <p style="margin-bottom:1.25rem;">
        All personal loan sanctions, credit appraisal decisions, interest rate determinations, and fund disbursals are executed entirely by our RBI-registered lending partners. Submitting your details on this platform <strong>does not guarantee loan approval</strong>.
      </p>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">2. Eligibility &amp; User Representations</h2>
      <p style="margin-bottom:1.25rem;">
        By submitting an eligibility inquiry, you represent and warrant that:
      </p>
      <ul style="padding-left:1.5rem; margin-bottom:1.25rem;">
        <li>You are an Indian citizen residing in India, aged at least 21 years and not exceeding 58 years.</li>
        <li>All information provided (name, mobile number, monthly income, employment status) is true, accurate, and current.</li>
        <li>You are applying for a legitimate personal financial requirement and not for any unlawful or speculative activities.</li>
      </ul>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">3. Loan Calculators &amp; Illustrative Estimates</h2>
      <p style="margin-bottom:1.25rem;">
        The calculators, EMI figures, and interest estimates provided on this website are for educational and illustrative purposes only. Actual interest rates, processing charges, and repayment schedules offered by lending partners will depend on your individual credit bureau score, risk assessment, and income verification.
      </p>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">4. Intellectual Property</h2>
      <p style="margin-bottom:1.25rem;">
        All trademarks, logos, page layouts, calculators, algorithms, designs, and content on this website are the intellectual property of <?= htmlspecialchars($config['company']['legal_name']) ?> or licensed partners. Unauthorized copying, scraping, or redistribution is strictly prohibited.
      </p>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">5. Governing Law &amp; Jurisdiction</h2>
      <p style="margin-bottom:1.25rem;">
        These Terms shall be governed by and construed in accordance with the laws of the Republic of India. Any legal dispute or controversy arising out of these Terms shall be subject to the exclusive jurisdiction of the competent courts in Gurugram / New Delhi, India.
      </p>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
