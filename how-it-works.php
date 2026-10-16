<?php
/**
 * Paisa in Minutes - How It Works Page
 */

declare(strict_types=1);

$pageTitle = 'How It Works – The 100% Digital Personal Loan Discovery Process';
$pageDescription = 'Understand our transparent 3-step digital loan process. From soft credit eligibility checks to RBI-regulated KYC verification and direct bank account disbursal.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;">
  <div class="container container-narrow">
    <div class="text-center" style="margin-bottom: 3.5rem;">
      <span class="badge badge-royal" style="margin-bottom: 0.5rem;">Frictionless & Transparent</span>
      <h1 class="heading-1" style="margin-bottom: 0.75rem;">
        How Digital Loan Discovery Works
      </h1>
      <p class="text-lead" style="max-width: 620px; margin: 0 auto;">
        We replaced slow, paperwork-heavy bank branches with an automated, algorithm-backed personal loan platform.
      </p>
    </div>

    <!-- Step 1 Details -->
    <div class="card" style="margin-bottom: 2rem;">
      <div style="display:flex; align-items:flex-start; gap:1.5rem;">
        <div class="process-step-num" style="flex-shrink:0;">01</div>
        <div>
          <h2 class="heading-3" style="margin-bottom: 0.5rem;">Check Your Instant Eligibility</h2>
          <p style="color:var(--text-secondary); line-height:1.6; margin-bottom: 1rem;">
            Fill out our mobile-first application in less than 2 minutes. We evaluate key financial parameters like monthly in-hand income, employment stability, and requested loan amount (capped between ₹10,000 and ₹1,00,000).
          </p>
          <div style="background:#eff6ff; border-left:4px solid #2563eb; padding:12px 16px; border-radius:0 8px 8px 0; font-size:0.875rem; color:#1e40af;">
            <strong>Bureau Safety:</strong> This initial pre-screening uses a soft eligibility check that has zero negative impact on your credit bureau score.
          </div>
        </div>
      </div>
    </div>

    <!-- Step 2 Details -->
    <div class="card" style="margin-bottom: 2rem;">
      <div style="display:flex; align-items:flex-start; gap:1.5rem;">
        <div class="process-step-num" style="flex-shrink:0;">02</div>
        <div>
          <h2 class="heading-3" style="margin-bottom: 0.5rem;">Compare Pre-Approved Partner Quotations</h2>
          <p style="color:var(--text-secondary); line-height:1.6; margin-bottom: 1rem;">
            Our algorithm matches your profile with authorized, RBI-registered NBFC and Bank lending programs. You receive transparent quotes detailing:
          </p>
          <ul style="padding-left:1.25rem; color:var(--text-secondary); font-size:0.9375rem; line-height:1.6; margin-bottom:1rem;">
            <li>Exact Annual Percentage Rate (APR) based on reducing balance</li>
            <li>Clear processing fee (1.5% - 3% + 18% GST)</li>
            <li>Standardized Key Fact Statement (KFS) before any agreement is signed</li>
            <li>Flexible repayment tenures from 3 to 24 months</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Step 3 Details -->
    <div class="card" style="margin-bottom: 2rem;">
      <div style="display:flex; align-items:flex-start; gap:1.5rem;">
        <div class="process-step-num" style="flex-shrink:0;">03</div>
        <div>
          <h2 class="heading-3" style="margin-bottom: 0.5rem;">Digital KYC Verification & Bank Disbursal</h2>
          <p style="color:var(--text-secondary); line-height:1.6; margin-bottom: 1rem;">
            Once you select an offer, you complete digital verification via Aadhaar OTP (e-KYC) and set up automated e-NACH autopay for hassle-free monthly repayments. Approved funds are credited directly into your bank account via instant IMPS or NEFT.
          </p>
          <div style="background:#ecfdf5; border-left:4px solid #10b981; padding:12px 16px; border-radius:0 8px 8px 0; font-size:0.875rem; color:#065f46;">
            <strong>Direct Disbursal:</strong> The loan proceeds are transferred directly from the regulated lender's escrow bank account to your verified savings account. Paisa in Minutes never handles or holds your money.
          </div>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="text-center" style="margin-top: 3rem;">
      <a href="check-eligibility.php" class="btn btn-primary btn-lg">
        Start Your Free Eligibility Check &rarr;
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
