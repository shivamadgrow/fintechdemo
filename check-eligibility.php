<?php
/**
 * Paisa in Minutes - 4-Step Personal Loan Eligibility Journey
 * Mobile-first application flow with real-time validation, review step and secure API submission
 */

declare(strict_types=1);

$pageTitle = 'Check Personal Loan Eligibility – 4 Step Fast Digital Application';
$pageDescription = 'Check your personal loan eligibility up to ₹1,00,000 in under 2 minutes. 100% digital, soft bureau check, and instant matching with RBI-regulated NBFC partners.';

require_once __DIR__ . '/includes/header.php';
$csrfToken = getCsrfToken();
$loanConfig = $config['loan'];
?>

<section class="section" style="background: #f8fafc; min-height: 85vh; padding-top: 3rem;" aria-label="Eligibility Application Wizard">
  <div class="container container-narrow">
    <!-- Wizard Header -->
    <div class="text-center" style="margin-bottom: 2rem;">
      <span class="badge badge-royal" style="margin-bottom: 0.5rem;">Fast 2-Minute Journey</span>
      <h1 class="heading-2" style="margin-bottom: 0.5rem;">
        Check Your Personal Loan Eligibility
      </h1>
      <p style="color: var(--text-secondary); max-width: 540px; margin: 0 auto; font-size: 0.95rem;">
        Discover personalized loan offers up to <strong>₹1,00,000</strong> without impacting your credit score.
      </p>
    </div>

    <!-- Active Wizard Form Card -->
    <div id="eligibilityWizardContainer" class="eligibility-wizard-card">
      <!-- 4-Step Progress Bar -->
      <div class="wizard-progress" aria-label="Application Progress">
        <div class="wizard-progress-bar" id="wizardProgressBar" style="width: 0%;"></div>
        
        <div class="wizard-step active" id="stepIndicator1">
          <div class="wizard-circle">1</div>
          <span class="wizard-label">Basic Info</span>
        </div>
        <div class="wizard-step" id="stepIndicator2">
          <div class="wizard-circle">2</div>
          <span class="wizard-label">Financial</span>
        </div>
        <div class="wizard-step" id="stepIndicator3">
          <div class="wizard-circle">3</div>
          <span class="wizard-label">Details</span>
        </div>
        <div class="wizard-step" id="stepIndicator4">
          <div class="wizard-circle">4</div>
          <span class="wizard-label">Review</span>
        </div>
      </div>

      <!-- Inline Notification Alert -->
      <div id="wizardAlert" style="display:none; padding:12px 16px; border-radius:10px; margin-bottom:1.5rem; font-size:0.875rem; background:#fee2e2; color:#b91c1c; border:1px solid #fecaca;" role="alert"></div>

      <form id="eligibilityForm" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
        <input type="hidden" name="partnerPreferred" value="<?= htmlspecialchars($_GET['partner'] ?? '') ?>">

        <!-- ====================================================================
             STEP 1: BASIC INFORMATION
             ==================================================================== -->
        <div class="wizard-step-pane active" id="wizardStep1">
          <div style="margin-bottom: 1.5rem;">
            <h2 class="heading-4" style="margin-bottom: 0.25rem;">Step 1: Your Contact Information</h2>
            <p style="font-size: 0.8125rem; color: var(--text-muted);">Please provide your accurate details as mentioned on your Aadhaar card.</p>
          </div>

          <!-- Full Name -->
          <div class="form-group">
            <label for="fullName" class="form-label">
              Full Legal Name <span style="color:#ef4444;">*</span>
              <span class="form-label-desc">(As per PAN/Aadhaar)</span>
            </label>
            <input type="text" id="fullName" name="fullName" class="form-control wizard-field" placeholder="e.g. Ramesh Kumar Sharma" required autocomplete="name">
            <span class="form-error" id="fullNameError"></span>
          </div>

          <!-- Mobile Number -->
          <div class="form-group">
            <label for="mobileNumber" class="form-label">
              Mobile Number <span style="color:#ef4444;">*</span>
              <span class="form-label-desc">(Linked with Aadhaar for digital verification)</span>
            </label>
            <div class="input-with-icon">
              <span class="input-icon-prefix">+91</span>
              <input type="tel" id="mobileNumber" name="mobileNumber" class="form-control wizard-field" placeholder="9876543210" maxlength="10" required autocomplete="tel-national">
            </div>
            <span class="form-error" id="mobileNumberError"></span>
          </div>

          <!-- Email (Optional) -->
          <div class="form-group">
            <label for="email" class="form-label">
              Email Address <span class="form-label-desc">(For electronic Key Fact Statement)</span>
            </label>
            <input type="email" id="email" name="email" class="form-control wizard-field" placeholder="name@example.com" autocomplete="email">
            <span class="form-error" id="emailError"></span>
          </div>

          <!-- Terms Consent Checkbox -->
          <div class="form-group" style="margin-top: 1.5rem;">
            <label style="display:flex; align-items:flex-start; gap:0.6rem; cursor:pointer; font-size:0.8125rem; color:var(--text-secondary); line-height:1.5;">
              <input type="checkbox" id="initialConsentCheck" class="wizard-field" required checked style="margin-top:3px; accent-color:var(--color-royal-600); width:16px; height:16px;">
              <span>
                I agree to the <a href="terms-and-conditions.php" target="_blank" style="color:var(--color-royal-600); text-decoration:underline;">Terms & Conditions</a> and <a href="privacy-policy.php" target="_blank" style="color:var(--color-royal-600); text-decoration:underline;">Privacy Policy</a>, and authorize Paisa in Minutes and its RBI-registered lending partners to contact me via SMS/WhatsApp/Call regarding my loan inquiry.
              </span>
            </label>
            <span class="form-error" id="initialConsentCheckError"></span>
          </div>
        </div>

        <!-- ====================================================================
             STEP 2: FINANCIAL PROFILE
             ==================================================================== -->
        <div class="wizard-step-pane" id="wizardStep2">
          <div style="margin-bottom: 1.5rem;">
            <h2 class="heading-4" style="margin-bottom: 0.25rem;">Step 2: Employment & Income Profile</h2>
            <p style="font-size: 0.8125rem; color: var(--text-muted);">This helps determine which partner offers the lowest APR for your profile.</p>
          </div>

          <!-- Employment Type -->
          <div class="form-group">
            <label for="employmentType" class="form-label">Employment Type <span style="color:#ef4444;">*</span></label>
            <select id="employmentType" name="employmentType" class="form-control wizard-field" required>
              <option value="Salaried" selected>Salaried (Private / Govt / MNC)</option>
              <option value="Self-Employed Professional">Self-Employed Professional (Doctor, CA, Consultant)</option>
              <option value="Self-Employed Business">Self-Employed Business / Trader / Merchant</option>
            </select>
          </div>

          <!-- Monthly In-Hand Income -->
          <div class="form-group">
            <label for="monthlyIncome" class="form-label">
              Monthly Net In-Hand Income <span style="color:#ef4444;">*</span>
              <span class="form-label-desc">(Credited to bank account)</span>
            </label>
            <div class="input-with-icon">
              <span class="input-icon-prefix">₹</span>
              <input type="number" id="monthlyIncome" name="monthlyIncome" class="form-control wizard-field" placeholder="e.g. 35000" min="10000" step="1000" required>
            </div>
            <span class="form-error" id="monthlyIncomeError"></span>
          </div>

          <!-- Required Loan Amount (Slider + Input Sync) -->
          <div class="form-group" style="margin-top: 1.5rem;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.4rem;">
              <label for="wizardAmountSlider" class="form-label" style="margin-bottom: 0;">Required Loan Amount <span style="color:#ef4444;">*</span></label>
              <div style="position:relative; width:130px;">
                <span style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#2563eb; font-weight:700;">₹</span>
                <input type="number" id="wizardAmountInput" name="loanAmount" class="form-control" value="50000" min="10000" max="100000" step="5000" style="padding-left:26px; font-weight:700;">
              </div>
            </div>
            <input type="range" id="wizardAmountSlider" class="range-slider" min="10000" max="100000" step="5000" value="50000" aria-label="Loan Amount Selector">
            <div class="range-slider-labels">
              <span>₹10,000</span>
              <span>Max: ₹1,00,000</span>
            </div>
          </div>

          <!-- Desired Tenure -->
          <div class="form-group">
            <label for="loanTenure" class="form-label">Preferred Tenure (Months)</label>
            <select id="loanTenure" name="loanTenure" class="form-control wizard-field">
              <option value="3">3 Months (Short-term)</option>
              <option value="6">6 Months</option>
              <option value="9">9 Months</option>
              <option value="12" selected>12 Months (Recommended)</option>
              <option value="18">18 Months</option>
              <option value="24">24 Months</option>
            </select>
          </div>

          <!-- City & PIN code -->
          <div class="grid grid-cols-2" style="gap:1rem;">
            <div class="form-group">
              <label for="city" class="form-label">Current City</label>
              <input type="text" id="city" name="city" class="form-control wizard-field" placeholder="e.g. Pune, Delhi, Bengaluru">
            </div>
            <div class="form-group">
              <label for="pincode" class="form-label">PIN Code</label>
              <input type="text" id="pincode" name="pincode" class="form-control wizard-field" placeholder="e.g. 411001" maxlength="6">
              <span class="form-error" id="pincodeError"></span>
            </div>
          </div>
        </div>

        <!-- ====================================================================
             STEP 3: ADDITIONAL INFORMATION
             ==================================================================== -->
        <div class="wizard-step-pane" id="wizardStep3">
          <div style="margin-bottom: 1.5rem;">
            <h2 class="heading-4" style="margin-bottom: 0.25rem;">Step 3: Purpose & KYC Pre-check</h2>
            <p style="font-size: 0.8125rem; color: var(--text-muted);">Collected only where necessary for responsible lending compliance.</p>
          </div>

          <!-- Purpose of Loan -->
          <div class="form-group">
            <label for="loanPurpose" class="form-label">Purpose of Loan</label>
            <select id="loanPurpose" name="loanPurpose" class="form-control wizard-field">
              <option value="Emergency Medical Expenses">Emergency Medical Expenses</option>
              <option value="Home Renovation / Relocation">Home Renovation / Relocation</option>
              <option value="Education / Certification Fees">Education / Certification Fees</option>
              <option value="Debt Consolidation / Credit Repayment">Debt Consolidation / Bill Repayment</option>
              <option value="Family / Travel Expenses">Family Event / Travel</option>
              <option value="Working Capital Support">Working Capital / Freelance Support</option>
              <option value="Other Personal Needs" selected>Other Personal Needs</option>
            </select>
          </div>

          <!-- PAN Card (Optional at step 3, validated if provided) -->
          <div class="form-group">
            <label for="panNumber" class="form-label">
              PAN Number <span class="form-label-desc">(Optional - helps instant credit appraisal)</span>
            </label>
            <input type="text" id="panNumber" name="panNumber" class="form-control wizard-field" placeholder="ABCDE1234F" maxlength="10" style="text-transform:uppercase;">
            <span class="form-error" id="panNumberError"></span>
            <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">
              Your PAN will be masked and processed through bank-grade encryption exclusively for eligibility appraisal.
            </p>
          </div>

          <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:12px; padding:1.25rem; margin-top:1.5rem;">
            <h3 style="color:#1e40af; font-size:0.875rem; font-weight:700; margin-bottom:0.25rem;">
              🔒 Digital Lending Safe Harbors
            </h3>
            <p style="color:#1e3a8a; font-size:0.8125rem; line-height:1.5;">
              We never ask for your debit card PIN, net banking password, or confidential OTP. All official KYC steps are conducted via certified Government Digilocker / UIDAI infrastructure.
            </p>
          </div>
        </div>

        <!-- ====================================================================
             STEP 4: EDITABLE REVIEW & SUBMIT
             ==================================================================== -->
        <div class="wizard-step-pane" id="wizardStep4">
          <div style="margin-bottom: 1.5rem;">
            <h2 class="heading-4" style="margin-bottom: 0.25rem;">Step 4: Review Your Information</h2>
            <p style="font-size: 0.8125rem; color: var(--text-muted);">Ensure all details are accurate before submitting to lending partners.</p>
          </div>

          <!-- Live Review Summary Box -->
          <div class="review-summary-box">
            <div class="review-row">
              <span style="color:var(--text-muted);">Full Name:</span>
              <div>
                <strong id="reviewName">-</strong>
                <a href="#" data-jump-step="1" style="color:var(--color-royal-600); margin-left:8px; font-size:0.8125rem; text-decoration:underline;">Edit</a>
              </div>
            </div>
            <div class="review-row">
              <span style="color:var(--text-muted);">Mobile:</span>
              <div>
                <strong id="reviewMobile">-</strong>
                <a href="#" data-jump-step="1" style="color:var(--color-royal-600); margin-left:8px; font-size:0.8125rem; text-decoration:underline;">Edit</a>
              </div>
            </div>
            <div class="review-row">
              <span style="color:var(--text-muted);">Employment:</span>
              <div>
                <strong id="reviewEmployment">-</strong>
                <a href="#" data-jump-step="2" style="color:var(--color-royal-600); margin-left:8px; font-size:0.8125rem; text-decoration:underline;">Edit</a>
              </div>
            </div>
            <div class="review-row">
              <span style="color:var(--text-muted);">Monthly Income:</span>
              <div>
                <strong id="reviewIncome">-</strong>
                <a href="#" data-jump-step="2" style="color:var(--color-royal-600); margin-left:8px; font-size:0.8125rem; text-decoration:underline;">Edit</a>
              </div>
            </div>
            <div class="review-row">
              <span style="color:var(--text-muted);">Requested Amount:</span>
              <div>
                <strong id="reviewAmount" style="color:#2563eb;">-</strong>
                <a href="#" data-jump-step="2" style="color:var(--color-royal-600); margin-left:8px; font-size:0.8125rem; text-decoration:underline;">Edit</a>
              </div>
            </div>
            <div class="review-row">
              <span style="color:var(--text-muted);">Tenure:</span>
              <div>
                <strong id="reviewTenure">-</strong>
                <a href="#" data-jump-step="2" style="color:var(--color-royal-600); margin-left:8px; font-size:0.8125rem; text-decoration:underline;">Edit</a>
              </div>
            </div>
            <div class="review-row">
              <span style="color:var(--text-muted);">Purpose:</span>
              <strong id="reviewPurpose">-</strong>
            </div>
            <div class="review-row">
              <span style="color:var(--text-muted);">Location:</span>
              <strong id="reviewCity">-</strong>
            </div>
          </div>

          <!-- Final Consent & Statutory Disclaimers -->
          <div style="margin-top: 1.25rem;">
            <label style="display:flex; align-items:flex-start; gap:0.6rem; cursor:pointer; font-size:0.8125rem; color:var(--text-secondary); line-height:1.5;">
              <input type="checkbox" id="finalConsentCheck" name="finalConsentCheck" value="1" required checked style="margin-top:3px; accent-color:var(--color-royal-600); width:16px; height:16px;">
              <span>
                I confirm that the above details are accurate and true. I understand that Paisa in Minutes does not guarantee loan disbursal, and that final loan approval and interest rates depend solely on the credit underwriting of our RBI-registered lending partners.
              </span>
            </label>
          </div>
        </div>

        <!-- Wizard Navigation Footer Buttons -->
        <div class="wizard-footer-actions">
          <button type="button" id="wizardPrevBtn" class="btn btn-outline-navy btn-sm" style="visibility:hidden;">
            &larr; Previous Step
          </button>

          <button type="button" id="wizardNextBtn" class="btn btn-primary">
            Continue to Next Step &rarr;
          </button>

          <button type="submit" id="wizardSubmitBtn" class="btn btn-yellow" style="display:none;">
            <span id="submitSpinner" style="display:none; width:16px; height:16px; border:2px solid #000; border-top-color:transparent; border-radius:50%; animation:spin 0.8s linear infinite; margin-right:8px;"></span>
            Verify &amp; Submit Application
          </button>
        </div>
      </form>
    </div>

    <!-- ====================================================================
         VERIFIED SUCCESS SCREEN (Rendered after successful API call)
         ==================================================================== -->
    <div id="eligibilitySuccessContainer" class="eligibility-wizard-card text-center" style="display:none;">
      <div style="width:72px; height:72px; background:#dcfce7; color:#15803d; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem auto; font-size:2rem;">
        ✓
      </div>
      <span class="badge badge-emerald" style="margin-bottom:0.75rem;">Application Verified</span>
      <h2 class="heading-2" style="margin-bottom:0.5rem;">Application Successfully Submitted!</h2>
      <p style="color:var(--text-secondary); max-width:520px; margin:0 auto 1.5rem auto;">
        Your personal loan eligibility has been recorded. Our partner underwriting team is performing the automated digital pre-assessment.
      </p>

      <div style="background:#f1f5f9; border-radius:14px; padding:1.25rem; max-width:440px; margin:0 auto 2rem auto;">
        <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em; color:var(--text-muted); font-weight:700;">
          Your Unique Application Reference ID
        </div>
        <div id="successReferenceId" style="font-family:var(--font-heading); font-size:1.75rem; font-weight:800; color:var(--color-royal-600); margin:0.35rem 0;">
          PIM-2610-SAMPLE
        </div>
        <div style="font-size:0.8125rem; color:var(--text-secondary);">
          Keep this reference ID for tracking your application status.
        </div>
      </div>

      <!-- What happens next -->
      <div class="text-left" style="background:#fff; border:1px solid var(--border-subtle); border-radius:14px; padding:1.5rem; max-width:540px; margin:0 auto 2rem auto;">
        <h3 class="heading-4" style="font-size:1rem; margin-bottom:0.75rem;">What Happens Next:</h3>
        <ol style="padding-left:1.25rem; font-size:0.875rem; color:var(--text-secondary); line-height:1.6;">
          <li>You will receive an SMS and WhatsApp confirmation with lender quotation options.</li>
          <li>Select your preferred lender to complete 1-minute Aadhaar OTP verification.</li>
          <li>Sanction letter and Key Fact Statement will be issued electronically.</li>
          <li>Disbursal will be initiated directly into your bank account.</li>
        </ol>
      </div>

      <div style="display:flex; justify-content:center; gap:1rem;">
        <a href="offers.php" class="btn btn-primary">
          Explore Current Partner Offers
        </a>
        <a href="index.php" class="btn btn-outline-navy">
          Return to Home
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Page-specific Javascript -->
<script src="assets/js/eligibility.js?v=<?= $config['app']['version'] ?>" defer></script>

<style>
@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
