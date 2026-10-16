<?php
/**
 * Paisa in Minutes - Homepage
 * Production-ready Indian Fintech Personal Loan Discovery & Eligibility Platform
 * Inspired by Milestone template visual aesthetics & structure
 */

declare(strict_types=1);

$pageTitle = 'Paisa in Minutes – Where India Discovers Fair, Fast Personal Loans';
$pageDescription = 'Discover instant personal loans up to ₹1,00,000 from verified RBI-regulated NBFCs & Banks. Interactive loan slider, zero hidden charges, and transparent repayment calculation.';

require_once __DIR__ . '/includes/header.php';
$partners = $config['lending_partners'];
?>

<!-- ============================================================================
     HERO SECTION
     ============================================================================ -->
<section class="hero-section" aria-label="Personal Loan Discovery Hero">
  <div class="container">
    <div class="hero-grid">
      <!-- Left Column: Copy & CTAs -->
      <div class="hero-content">
        <div class="hero-badges">
          <span class="badge badge-yellow">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
            </svg>
            100% Digital Discovery
          </span>
          <span class="badge badge-navy">RBI-Regulated Lending Partners</span>
          <span class="badge badge-navy">No Hidden Charges</span>
        </div>

        <h1 class="heading-display hero-title">
          Get approved<br>
          <span class="salmon-outline">upfront.</span>
        </h1>

        <p class="text-lead" style="color: #cbd5e1; max-width: 540px;">
          Bridge immediate cashflow needs with transparent personal loans from <strong>₹10,000 to ₹1,00,000</strong>. Check your eligibility in 2 minutes without affecting your credit score.
        </p>

        <div class="hero-ctas">
          <a href="check-eligibility.php" class="btn btn-yellow btn-lg" id="heroApplyBtn">
            Check Eligibility Free
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
          <a href="personal-loan-calculator.php" class="btn btn-outline-white btn-lg">
            Detailed Calculator
          </a>
        </div>

        <!-- Verified Trust Statistics -->
        <div class="hero-trust-metrics">
          <div>
            <div class="metric-number">₹1,00,000</div>
            <div class="metric-label">Maximum Personal Limit</div>
          </div>
          <div>
            <div class="metric-number">11.99%*</div>
            <div class="metric-label">Starting Annual Rate (APR)</div>
          </div>
          <div>
            <div class="metric-number">24 Hours</div>
            <div class="metric-label">Fast Digital Disbursal</div>
          </div>
        </div>
      </div>

      <!-- Right Column: Interactive Hero Loan Amount Slider & Live Estimate -->
      <div>
        <div class="hero-calc-card">
          <div class="calc-card-header">
            <div>
              <h3 style="font-size: 1.25rem; font-weight: 700; color: #fff;">Quick Repayment Estimate</h3>
              <p style="font-size: 0.8125rem; color: #94a3b8;">Adjust loan amount & tenure for live estimate</p>
            </div>
            <span class="badge badge-yellow">Live Calculator</span>
          </div>

          <!-- Loan Amount Slider & Input -->
          <div class="form-group" style="margin-bottom: 1.5rem;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem;">
              <label for="calcSliderAmount" class="form-label" style="color: #cbd5e1; margin-bottom: 0;">Loan Amount</label>
              <div style="position:relative; width: 140px;">
                <span style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#2563eb; font-weight:700;">₹</span>
                <input type="number" id="calcInputAmount" class="form-control" value="50000" min="10000" max="100000" step="5000" style="padding-left:26px; padding-top:6px; padding-bottom:6px; font-weight:700; background:#070d1f; color:#fff; border-color:rgba(255,255,255,0.2);">
              </div>
            </div>
            <input type="range" id="calcSliderAmount" class="range-slider" min="10000" max="100000" step="5000" value="50000" aria-label="Loan Amount Slider">
            <div class="range-slider-labels">
              <span>₹10,000</span>
              <span>₹50,000</span>
              <span>₹1,00,000</span>
            </div>
          </div>

          <!-- Tenure Selector -->
          <div class="form-group">
            <label class="form-label" style="color: #cbd5e1;">Repayment Tenure (Months)</label>
            <div class="segmented-control" style="background:#070d1f; border-color:rgba(255,255,255,0.15);">
              <button type="button" class="segmented-pill" data-tenure-pill="3">3 M</button>
              <button type="button" class="segmented-pill" data-tenure-pill="6">6 M</button>
              <button type="button" class="segmented-pill" data-tenure-pill="9">9 M</button>
              <button type="button" class="segmented-pill active" data-tenure-pill="12">12 M</button>
              <button type="button" class="segmented-pill" data-tenure-pill="24">24 M</button>
            </div>
          </div>

          <!-- Hidden default rate for quick hero calculator -->
          <input type="hidden" id="calcSliderRate" value="14.5">
          <input type="hidden" id="calcInputRate" value="14.5">

          <!-- Live Estimated EMI Display -->
          <div class="hero-emi-display">
            <div style="font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #93c5fd;">
              Estimated Monthly EMI
            </div>
            <div class="emi-amount-large" id="calcEmiDisplay">₹4,502</div>
            <div style="font-size: 0.75rem; color: #cbd5e1;">
              Calculated at illustrative 14.5% reducing APR
            </div>
          </div>

          <!-- Repayment Breakdown Row -->
          <div style="display:flex; justify-content:space-between; padding:0.75rem 0; font-size:0.875rem; border-top:1px solid rgba(255,255,255,0.08); color:#cbd5e1;">
            <span>Total Interest Payable:</span>
            <strong id="calcTotalInterestDisplay" style="color:#fff;">₹4,024</strong>
          </div>
          <div style="display:flex; justify-content:space-between; padding:0.75rem 0; font-size:0.875rem; border-top:1px solid rgba(255,255,255,0.08); color:#cbd5e1;">
            <span>Total Repayment Amount:</span>
            <strong id="calcTotalPaymentDisplay" style="color:var(--color-accent-yellow);">₹54,024</strong>
          </div>

          <div style="margin-top: 1.25rem;">
            <a href="check-eligibility.php" class="btn btn-primary btn-block">
              Apply With This Estimate &rarr;
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================================
     MARQUEE TICKER (Milestone Inspired Continuous Motion)
     ============================================================================ -->
<div class="section-navy" style="padding: 0; background: #070d1f;">
  <div class="marquee-container" aria-hidden="true">
    <div class="marquee-track">
      <div class="marquee-item"><span>Get Paid In Advance</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item text-outline"><span>100% Paperless KYC</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item"><span>RBI Registered Lenders</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item text-outline"><span>Zero Prepayment Penalties</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item"><span>Funds Disbursed In Minutes</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
    </div>
    <div class="marquee-track" aria-hidden="true">
      <div class="marquee-item"><span>Get Paid In Advance</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item text-outline"><span>100% Paperless KYC</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item"><span>RBI Registered Lenders</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item text-outline"><span>Zero Prepayment Penalties</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
      <div class="marquee-item"><span>Funds Disbursed In Minutes</span><svg class="marquee-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v12M6 12h12" stroke="#070d1f" stroke-width="2"></path></svg></div>
    </div>
  </div>
</div>

<!-- ============================================================================
     HOW IT WORKS (3 Step Clear Digital Journey)
     ============================================================================ -->
<section class="section" style="background:#ffffff;" aria-labelledby="howItWorksHeading">
  <div class="container text-center">
    <span class="badge badge-royal">Simple & Predictable</span>
    <h2 id="howItWorksHeading" class="heading-2" style="margin-top: 0.75rem; margin-bottom: 0.75rem;">
      How Paisa in Minutes Works
    </h2>
    <p class="text-lead" style="max-width: 640px; margin: 0 auto;">
      Three frictionless digital steps to evaluate your borrowing options with complete financial clarity.
    </p>

    <div class="process-grid text-left">
      <!-- Step 1 -->
      <div class="process-step-card">
        <div class="process-step-num">01</div>
        <h3 class="heading-4" style="margin-bottom: 0.5rem;">Check Instant Eligibility</h3>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; line-height: 1.55;">
          Provide your basic employment and income profile in our 4-step wizard. We perform a soft eligibility check that has zero negative impact on your credit bureau score.
        </p>
      </div>

      <!-- Step 2 -->
      <div class="process-step-card">
        <div class="process-step-num">02</div>
        <h3 class="heading-4" style="margin-bottom: 0.5rem;">Review Verified Partner Offers</h3>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; line-height: 1.55;">
          Compare competitive quotations from verified RBI-regulated NBFCs. Review the exact APR, tenure, monthly EMI, and processing fees before taking any commitment.
        </p>
      </div>

      <!-- Step 3 -->
      <div class="process-step-card">
        <div class="process-step-num">03</div>
        <h3 class="heading-4" style="margin-bottom: 0.5rem;">Digital KYC & Disbursal</h3>
        <p style="color: var(--text-secondary); font-size: 0.9375rem; line-height: 1.55;">
          Complete Aadhaar-based OTP verification with the selected lender. Once approved, the funds are transferred directly into your savings bank account via IMPS/NEFT.
        </p>
      </div>
    </div>

    <div style="margin-top: 3rem;">
      <a href="check-eligibility.php" class="btn btn-primary btn-lg">
        Start Your Free Eligibility Journey
      </a>
    </div>
  </div>
</section>

<!-- ============================================================================
     CORE VALUE PROPOSITIONS & PRODUCT BENEFITS
     ============================================================================ -->
<section class="section section-navy" aria-labelledby="benefitsHeading">
  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1.5rem; margin-bottom: 3rem;">
      <div>
        <span class="badge badge-yellow">Why Choose Us</span>
        <h2 id="benefitsHeading" class="heading-2" style="margin-top: 0.75rem; color: #fff;">
          Responsible Personal Loans Designed for Real Indian Needs
        </h2>
      </div>
      <p style="color: #cbd5e1; max-width: 480px; font-size: 0.95rem;">
        We strictly prioritize customer welfare over aggressive lending. Every limit, fee, and repayment term is displayed transparently upfront.
      </p>
    </div>

    <div class="grid grid-cols-3">
      <!-- Card 1 -->
      <div class="card card-navy">
        <div style="font-size: 2rem; margin-bottom: 1rem;">🛡️</div>
        <h3 class="heading-4" style="color: #fff; margin-bottom: 0.5rem;">100% RBI-Regulated Lenders</h3>
        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.55;">
          We partner only with legitimate, RBI-registered NBFCs and commercial banks. No unregulated loan apps, no predatory interest rates, and no unauthorized contact list scraping.
        </p>
      </div>

      <!-- Card 2 -->
      <div class="card card-navy">
        <div style="font-size: 2rem; margin-bottom: 1rem;">⚖️</div>
        <h3 class="heading-4" style="color: #fff; margin-bottom: 0.5rem;">Sensible Micro-Limits</h3>
        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.55;">
          We specialize strictly in personal loans up to ₹1,00,000. Capped limits prevent debt traps and ensure affordable EMIs tailored for monthly salary earners.
        </p>
      </div>

      <!-- Card 3 -->
      <div class="card card-navy">
        <div style="font-size: 2rem; margin-bottom: 1rem;">📄</div>
        <h3 class="heading-4" style="color: #fff; margin-bottom: 0.5rem;">Clear Key Fact Statement (KFS)</h3>
        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.55;">
          Before accepting any offer, receive a standardized Key Fact Statement disclosing total interest, processing fees, net disbursal amount, and prepayment terms.
        </p>
      </div>

      <!-- Card 4 -->
      <div class="card card-navy">
        <div style="font-size: 2rem; margin-bottom: 1rem;">🔒</div>
        <h3 class="heading-4" style="color: #fff; margin-bottom: 0.5rem;">DPDP Act Data Privacy</h3>
        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.55;">
          Your personal data is encrypted in transit and at rest. We never share your phone number with aggressive cold-calling telemarketers.
        </p>
      </div>

      <!-- Card 5 -->
      <div class="card card-navy">
        <div style="font-size: 2rem; margin-bottom: 1rem;">⚡</div>
        <h3 class="heading-4" style="color: #fff; margin-bottom: 0.5rem;">Rapid Digital Underwriting</h3>
        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.55;">
          Algorithmic pre-assessment eliminates branch visits and physical document submissions. Decisions are communicated digitally in minutes.
        </p>
      </div>

      <!-- Card 6 -->
      <div class="card card-navy">
        <div style="font-size: 2rem; margin-bottom: 1rem;">🤝</div>
        <h3 class="heading-4" style="color: #fff; margin-bottom: 0.5rem;">Dedicated Grievance Matrix</h3>
        <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.55;">
          Our Principal Nodal Officer ensures any customer query or complaint is resolved within 14 business days, with direct escalation paths to the RBI Sachet portal.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================================
     APPROVED LENDING PARTNER OFFERS (Live Configured NBFCs)
     ============================================================================ -->
<section class="section" style="background:#f8fafc;" aria-labelledby="offersPreviewHeading">
  <div class="container">
    <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:1.5rem; margin-bottom: 2.5rem;">
      <div>
        <span class="badge badge-royal">Verified Institutions</span>
        <h2 id="offersPreviewHeading" class="heading-2" style="margin-top: 0.5rem;">
          Approved Lending Partners
        </h2>
        <p style="color: var(--text-secondary); margin-top: 0.25rem;">
          Compare real, authorized digital lending programs with verified APR ranges.
        </p>
      </div>
      <a href="offers.php" class="btn btn-outline-navy btn-sm">
        View All Partner Disclosures &rarr;
      </a>
    </div>

    <div class="grid grid-cols-2" style="gap: 1.5rem;">
      <?php foreach (array_slice($partners, 0, 4) as $p): ?>
        <div class="offer-card">
          <div>
            <div class="offer-header">
              <div>
                <span class="badge badge-emerald" style="margin-bottom: 0.5rem;"><?= htmlspecialchars($p['badge']) ?></span>
                <h3 class="heading-4"><?= htmlspecialchars($p['name']) ?></h3>
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                  <?= htmlspecialchars($p['category']) ?> &bull; RBI Reg: <?= htmlspecialchars($p['rbi_reg_no']) ?>
                </div>
              </div>
            </div>

            <div class="offer-features-grid">
              <div class="offer-feature-item">
                <div class="feature-title">Max Limit</div>
                <div class="feature-val" style="color:#2563eb;">₹<?= number_format($p['max_amount']) ?></div>
              </div>
              <div class="offer-feature-item">
                <div class="feature-title">Annual Rate (APR)</div>
                <div class="feature-val"><?= $p['min_apr'] ?>% - <?= $p['max_apr'] ?>%</div>
              </div>
              <div class="offer-feature-item">
                <div class="feature-title">Supported Tenure</div>
                <div class="feature-val"><?= $p['min_tenure'] ?> to <?= $p['max_tenure'] ?> Months</div>
              </div>
              <div class="offer-feature-item">
                <div class="feature-title">Processing Fee</div>
                <div class="feature-val"><?= htmlspecialchars($p['processing_fee']) ?></div>
              </div>
            </div>

            <p style="font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 1rem;">
              Speed: <?= htmlspecialchars($p['disbursal_speed']) ?>
            </p>
          </div>

          <a href="<?= htmlspecialchars($p['apply_url']) ?>" class="btn btn-primary btn-block" data-partner-outbound="<?= htmlspecialchars($p['id']) ?>" data-partner-name="<?= htmlspecialchars($p['name']) ?>">
            Check Eligibility for <?= htmlspecialchars(explode(' ', $p['name'])[0]) ?> &rarr;
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================================
     FREQUENTLY ASKED QUESTIONS (Interactive Accordion)
     ============================================================================ -->
<section class="section" style="background:#ffffff;" aria-labelledby="faqHeading">
  <div class="container container-narrow">
    <div class="text-center" style="margin-bottom: 3rem;">
      <span class="badge badge-royal">Common Queries</span>
      <h2 id="faqHeading" class="heading-2" style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
        Frequently Asked Questions
      </h2>
      <p class="text-lead">
        Transparent answers regarding eligibility criteria, interest rates, and loan disbursal.
      </p>
    </div>

    <div class="accordion">
      <div class="accordion-item open">
        <div class="accordion-header" tabindex="0" role="button" aria-expanded="true">
          <span>What is the maximum personal loan amount I can discover on Paisa in Minutes?</span>
          <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>
        <div class="accordion-body" style="max-height: 200px;">
          The maximum personal loan discovery limit on our platform is strictly capped at <strong>₹1,00,000</strong>. This micro-ticket cap ensures responsible borrowing, affordable repayments, and prevents individuals from incurring excessive debt burden.
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header" tabindex="0" role="button" aria-expanded="false">
          <span>Does checking my loan eligibility impact my credit bureau score?</span>
          <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>
        <div class="accordion-body">
          No. The initial eligibility assessment on Paisa in Minutes uses a pre-screening soft inquiry model that does NOT record a hard credit inquiry on your CIBIL or Experian credit report. A formal credit appraisal is initiated only after you review and select a specific loan quotation.
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header" tabindex="0" role="button" aria-expanded="false">
          <span>Is Paisa in Minutes a bank or an NBFC?</span>
          <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>
        <div class="accordion-body">
          Paisa in Minutes is an authorized digital Lending Service Provider (LSP) and loan discovery aggregator. We do not directly lend money or collect public deposits. All loans are sanctioned and disbursed directly by our verified, RBI-registered lending partners (such as Tata Capital, IIFL Finance, DMI Finance, etc.) subject to credit underwriting.
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header" tabindex="0" role="button" aria-expanded="false">
          <span>What are the minimum eligibility criteria to apply?</span>
          <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>
        <div class="accordion-body">
          To qualify for a personal loan: You must be an Indian citizen aged between 21 and 58 years; earn a regular monthly in-hand income of at least ₹10,000 (salaried or self-employed); possess an active Aadhaar card and PAN card; and maintain an active savings bank account with mobile banking or net banking facilities.
        </div>
      </div>

      <div class="accordion-item">
        <div class="accordion-header" tabindex="0" role="button" aria-expanded="false">
          <span>How are interest rates and processing fees calculated?</span>
          <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>
        <div class="accordion-body">
          Interest rates range from 11.99% to 28% per annum calculated on a standard reducing-balance method. Processing fees typically range from 1.5% to 3% plus 18% GST of the sanctioned loan amount, which is deducted from the disbursed amount with zero hidden charges.
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================================
     FINAL CALL TO ACTION BANNER
     ============================================================================ -->
<section class="section" style="background:var(--color-navy-950); padding: 5rem 0; color:#fff;" aria-label="Apply Now Banner">
  <div class="container text-center">
    <span class="badge badge-yellow" style="margin-bottom: 1rem;">Take Control of Your Finances</span>
    <h2 class="heading-2" style="color: #fff; max-width: 680px; margin: 0 auto 1.25rem auto;">
      Ready to Discover Your Eligible Personal Loan in Minutes?
    </h2>
    <p class="text-lead" style="color: #cbd5e1; max-width: 580px; margin: 0 auto 2rem auto;">
      Paperless application, no branch visits, and transparent terms from India's most reputable regulated lenders.
    </p>
    <div style="display:flex; justify-content:center; gap:1rem; flex-wrap:wrap;">
      <a href="check-eligibility.php" class="btn btn-yellow btn-lg">
        Check Eligibility Now (Free)
      </a>
      <a href="personal-loan-calculator.php" class="btn btn-outline-white btn-lg">
        Try EMI Calculator
      </a>
    </div>
  </div>
</section>

<!-- Include Loan Calculator script for live slider preview -->
<script src="assets/js/calculator.js?v=<?= $config['app']['version'] ?>" defer></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
