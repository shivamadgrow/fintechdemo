<?php
/**
 * Paisa in Minutes - Complete FAQ & Financial Literacy Database
 */

declare(strict_types=1);

$pageTitle = 'Frequently Asked Questions – Personal Loan Discovery & Eligibility';
$pageDescription = 'Search comprehensive answers to common questions about personal loans up to ₹1,00,000, reducing-balance EMI calculations, processing fees, CIBIL scores and RBI compliance.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;">
  <div class="container container-narrow">
    <div class="text-center" style="margin-bottom: 3rem;">
      <span class="badge badge-royal" style="margin-bottom: 0.5rem;">Knowledge Base</span>
      <h1 class="heading-1" style="margin-bottom: 0.75rem;">
        Frequently Asked Questions
      </h1>
      <p class="text-lead" style="max-width: 600px; margin: 0 auto;">
        Everything you need to know about our digital loan discovery platform, regulatory practices, and loan parameters.
      </p>

      <!-- Instant Search Filter -->
      <div style="max-width: 480px; margin: 2rem auto 0 auto; position:relative;">
        <input type="text" id="faqSearchInput" class="form-control" placeholder="Search keywords (e.g. CIBIL, interest, PAN, repayment)..." style="padding-left: 2.75rem; border-radius: var(--radius-pill); box-shadow: var(--shadow-sm);">
        <svg style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); width:18px; height:18px; color:var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </div>
    </div>

    <!-- Category 1: Eligibility & Limits -->
    <div class="faq-category-block" style="margin-bottom: 2.5rem;">
      <h2 class="heading-3" style="color:var(--color-royal-600); margin-bottom: 1.25rem; font-size:1.35rem;">
        1. Loan Eligibility &amp; Product Boundaries
      </h2>
      <div class="accordion">
        <div class="accordion-item open">
          <div class="accordion-header" tabindex="0">
            <span>What is the maximum loan limit I can apply for on Paisa in Minutes?</span>
            <svg class="accordion-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
          <div class="accordion-body" style="max-height: 180px;">
            The maximum personal loan discovery limit is strictly <strong>₹1,00,000</strong>. We purposefully specialize in short-term personal credit (₹10,000 to ₹1,00,000) to ensure borrowers maintain a healthy debt-to-income ratio without taking on excessive financial burden.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header" tabindex="0">
            <span>Who is eligible to apply for a loan?</span>
            <svg class="accordion-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
          <div class="accordion-body">
            Eligible applicants must be Indian citizens aged 21 to 58 years with a minimum monthly net in-hand income of ₹10,000 (salaried or self-employed). You will need a valid Aadhaar card, PAN card, and an active bank account in your name.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header" tabindex="0">
            <span>Can I apply if I am self-employed or a freelancer?</span>
            <svg class="accordion-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
          <div class="accordion-body">
            Yes! Several of our approved lending partners cater specifically to self-employed professionals, traders, gig workers, and digital freelancers with regular bank account credits.
          </div>
        </div>
      </div>
    </div>

    <!-- Category 2: Rates, Fees & Formulas -->
    <div class="faq-category-block" style="margin-bottom: 2.5rem;">
      <h2 class="heading-3" style="color:var(--color-royal-600); margin-bottom: 1.25rem; font-size:1.35rem;">
        2. Interest Rates, Fees &amp; Key Fact Statement
      </h2>
      <div class="accordion">
        <div class="accordion-item">
          <div class="accordion-header" tabindex="0">
            <span>How is the EMI calculated?</span>
            <svg class="accordion-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
          <div class="accordion-body">
            EMIs are calculated using the reducing-balance method, where interest is charged only on the outstanding principal balance each month rather than the full initial loan amount. This ensures you pay less total interest as your loan balance amortizes over time.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header" tabindex="0">
            <span>What are the typical processing fees and other charges?</span>
            <svg class="accordion-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
          <div class="accordion-body">
            Processing fees generally range between 1.5% and 3% + 18% GST of the sanctioned loan amount, which is deducted from the disbursed loan amount. All fee details are explicitly documented in your Key Fact Statement (KFS) prior to loan acceptance. There are no surprise hidden service fees.
          </div>
        </div>
      </div>
    </div>

    <!-- Category 3: Regulatory & Disbursal -->
    <div class="faq-category-block">
      <h2 class="heading-3" style="color:var(--color-royal-600); margin-bottom: 1.25rem; font-size:1.35rem;">
        3. Security, Regulatory Role &amp; Disbursal
      </h2>
      <div class="accordion">
        <div class="accordion-item">
          <div class="accordion-header" tabindex="0">
            <span>Does Paisa in Minutes directly lend money?</span>
            <svg class="accordion-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
          <div class="accordion-body">
            No. Paisa in Minutes operates as a certified Lending Service Provider (LSP) and technology facilitator. We do not underwrite, lend, or collect funds directly. All loans are disbursed by our verified RBI-registered NBFC and Bank lending partners.
          </div>
        </div>

        <div class="accordion-item">
          <div class="accordion-header" tabindex="0">
            <span>How fast is the loan disbursal after approval?</span>
            <svg class="accordion-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </div>
          <div class="accordion-body">
            Upon successful digital KYC verification and e-NACH mandate registration, approved lending partners typically disburse the loan funds via IMPS within 2 to 24 business hours directly into your bank account.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Client-side FAQ search script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('faqSearchInput');
  if (!searchInput) return;

  searchInput.addEventListener('input', (e) => {
    const q = e.target.value.toLowerCase().trim();
    const items = document.querySelectorAll('.accordion-item');

    items.forEach((item) => {
      const text = item.textContent.toLowerCase();
      if (!q || text.includes(q)) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    });
  });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
