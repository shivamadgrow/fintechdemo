/**
 * Paisa in Minutes - 4-Step Loan Eligibility & Application Wizard
 * Mobile-first client validation, progress tracking, live review & API submission
 */

class EligibilityWizard {
  constructor() {
    this.currentStep = 1;
    this.totalSteps = 4;
    this.isSubmitting = false;

    this.initElements();
    this.bindEvents();
    this.prefillFromUrl();
  }

  initElements() {
    this.form = document.getElementById('eligibilityForm');
    this.stepPanes = document.querySelectorAll('.wizard-step-pane');
    this.stepCircles = document.querySelectorAll('.wizard-step');
    this.progressBar = document.getElementById('wizardProgressBar');

    // Controls
    this.prevBtn = document.getElementById('wizardPrevBtn');
    this.nextBtn = document.getElementById('wizardNextBtn');
    this.submitBtn = document.getElementById('wizardSubmitBtn');
    this.submitSpinner = document.getElementById('submitSpinner');
    this.wizardAlert = document.getElementById('wizardAlert');

    // Step 4 Review summary fields
    this.reviewName = document.getElementById('reviewName');
    this.reviewMobile = document.getElementById('reviewMobile');
    this.reviewEmployment = document.getElementById('reviewEmployment');
    this.reviewIncome = document.getElementById('reviewIncome');
    this.reviewAmount = document.getElementById('reviewAmount');
    this.reviewTenure = document.getElementById('reviewTenure');
    this.reviewPurpose = document.getElementById('reviewPurpose');
    this.reviewCity = document.getElementById('reviewCity');

    // Success Container
    this.wizardContainer = document.getElementById('eligibilityWizardContainer');
    this.successContainer = document.getElementById('eligibilitySuccessContainer');
    this.successReferenceId = document.getElementById('successReferenceId');
  }

  bindEvents() {
    if (this.nextBtn) {
      this.nextBtn.addEventListener('click', () => this.handleNextStep());
    }

    if (this.prevBtn) {
      this.prevBtn.addEventListener('click', () => this.handlePrevStep());
    }

    if (this.form) {
      this.form.addEventListener('submit', (e) => {
        e.preventDefault();
        this.submitApplication();
      });
    }

    // Sync wizard amount slider
    const wizardAmountSlider = document.getElementById('wizardAmountSlider');
    const wizardAmountInput = document.getElementById('wizardAmountInput');
    if (wizardAmountSlider && wizardAmountInput) {
      wizardAmountSlider.addEventListener('input', (e) => {
        wizardAmountInput.value = e.target.value;
      });
      wizardAmountInput.addEventListener('change', (e) => {
        let val = parseInt(e.target.value, 10) || 10000;
        val = Math.min(Math.max(val, 10000), 100000);
        wizardAmountInput.value = val;
        wizardAmountSlider.value = val;
      });
    }

    // Inline field validation triggers
    document.querySelectorAll('.wizard-field').forEach((input) => {
      input.addEventListener('blur', () => this.validateField(input));
      input.addEventListener('input', () => {
        if (input.classList.contains('is-invalid')) {
          this.validateField(input);
        }
      });
    });

    // Jump to step from review summary
    document.querySelectorAll('[data-jump-step]').forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const targetStep = parseInt(btn.getAttribute('data-jump-step'), 10);
        this.goToStep(targetStep);
      });
    });
  }

  prefillFromUrl() {
    const params = new URLSearchParams(window.location.search);
    if (params.has('amount')) {
      const amt = parseInt(params.get('amount'), 10);
      const slider = document.getElementById('wizardAmountSlider');
      const input = document.getElementById('wizardAmountInput');
      if (amt && slider && input) {
        const clamped = Math.min(Math.max(amt, 10000), 100000);
        slider.value = clamped;
        input.value = clamped;
      }
    }
  }

  validateField(input) {
    const errorElem = document.getElementById(input.id + 'Error');
    let isValid = true;
    let errorMsg = '';

    const val = input.value.trim();

    if (input.hasAttribute('required') && !val) {
      isValid = false;
      errorMsg = 'This field is required.';
    } else if (input.id === 'fullName' && val.length < 3) {
      isValid = false;
      errorMsg = 'Please enter your full legal name (at least 3 characters).';
    } else if (input.id === 'mobileNumber' && !/^[6-9]\d{9}$/.test(val)) {
      isValid = false;
      errorMsg = 'Please enter a valid 10-digit Indian mobile number.';
    } else if (input.id === 'monthlyIncome' && (parseInt(val, 10) < 10000 || isNaN(parseInt(val, 10)))) {
      isValid = false;
      errorMsg = 'Minimum required monthly in-hand income is ₹10,000.';
    } else if (input.id === 'pincode' && val && !/^\d{6}$/.test(val)) {
      isValid = false;
      errorMsg = 'Please enter a valid 6-digit Indian PIN code.';
    } else if (input.id === 'panNumber' && val && !/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(val.toUpperCase())) {
      isValid = false;
      errorMsg = 'Invalid PAN format. Example format: ABCDE1234F.';
    } else if (input.type === 'checkbox' && input.hasAttribute('required') && !input.checked) {
      isValid = false;
      errorMsg = 'Consent is required to proceed with loan discovery.';
    }

    if (!isValid) {
      input.classList.add('is-invalid');
      input.classList.remove('is-valid');
      if (errorElem) errorElem.textContent = errorMsg;
    } else {
      input.classList.remove('is-invalid');
      input.classList.add('is-valid');
      if (errorElem) errorElem.textContent = '';
    }

    return isValid;
  }

  validateCurrentStep() {
    const currentPane = document.getElementById(`wizardStep${this.currentStep}`);
    if (!currentPane) return true;

    const fields = currentPane.querySelectorAll('.wizard-field');
    let stepValid = true;

    fields.forEach((field) => {
      const valid = this.validateField(field);
      if (!valid) stepValid = false;
    });

    return stepValid;
  }

  handleNextStep() {
    if (!this.validateCurrentStep()) {
      return;
    }

    if (this.currentStep === 1 && window.PIMAnalytics) {
      window.PIMAnalytics.trackEvent('form_start', { form_name: 'eligibility_wizard' });
    }

    if (this.currentStep < this.totalSteps) {
      this.goToStep(this.currentStep + 1);
    }
  }

  handlePrevStep() {
    if (this.currentStep > 1) {
      this.goToStep(this.currentStep - 1);
    }
  }

  goToStep(stepNumber) {
    this.currentStep = stepNumber;

    // Toggle panes
    this.stepPanes.forEach((pane, idx) => {
      if (idx + 1 === stepNumber) {
        pane.classList.add('active');
      } else {
        pane.classList.remove('active');
      }
    });

    // Update Step Indicators
    this.stepCircles.forEach((circle, idx) => {
      const stepIdx = idx + 1;
      circle.classList.remove('active', 'completed');
      if (stepIdx < stepNumber) {
        circle.classList.add('completed');
      } else if (stepIdx === stepNumber) {
        circle.classList.add('active');
      }
    });

    // Update Progress Bar
    if (this.progressBar) {
      const pct = ((stepNumber - 1) / (this.totalSteps - 1)) * 100;
      this.progressBar.style.width = pct + '%';
    }

    // Toggle Actions
    if (this.prevBtn) {
      this.prevBtn.style.visibility = stepNumber === 1 ? 'hidden' : 'visible';
    }

    if (stepNumber === this.totalSteps) {
      this.nextBtn.style.display = 'none';
      this.submitBtn.style.display = 'inline-flex';
      this.populateReviewSummary();
    } else {
      this.nextBtn.style.display = 'inline-flex';
      this.submitBtn.style.display = 'none';
    }

    // Scroll to top of card on mobile
    this.form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  populateReviewSummary() {
    const getVal = (id) => {
      const el = document.getElementById(id);
      return el ? el.value.trim() : '';
    };

    if (this.reviewName) this.reviewName.textContent = getVal('fullName');
    if (this.reviewMobile) this.reviewMobile.textContent = '+91 ' + getVal('mobileNumber');
    if (this.reviewEmployment) this.reviewEmployment.textContent = getVal('employmentType');
    if (this.reviewIncome) this.reviewIncome.textContent = '₹' + parseInt(getVal('monthlyIncome') || 0, 10).toLocaleString('en-IN');
    if (this.reviewAmount) this.reviewAmount.textContent = '₹' + parseInt(getVal('wizardAmountInput') || 50000, 10).toLocaleString('en-IN');
    if (this.reviewTenure) this.reviewTenure.textContent = getVal('loanTenure') + ' Months';
    if (this.reviewPurpose) this.reviewPurpose.textContent = getVal('loanPurpose') || 'Personal Needs';
    if (this.reviewCity) this.reviewCity.textContent = (getVal('city') || 'Not Specified') + (getVal('pincode') ? ` (${getVal('pincode')})` : '');
  }

  showAlert(message, type = 'error') {
    if (!this.wizardAlert) return;
    this.wizardAlert.textContent = message;
    this.wizardAlert.className = `alert alert-${type}`;
    this.wizardAlert.style.display = 'block';
  }

  hideAlert() {
    if (this.wizardAlert) this.wizardAlert.style.display = 'none';
  }

  async submitApplication() {
    if (this.isSubmitting) return;
    this.hideAlert();

    const termsChecked = document.getElementById('finalConsentCheck');
    if (termsChecked && !termsChecked.checked) {
      this.showAlert('Please acknowledge that this application will be verified with approved lending partners.');
      return;
    }

    this.isSubmitting = true;
    this.submitBtn.disabled = true;
    if (this.submitSpinner) this.submitSpinner.style.display = 'inline-block';

    const formData = new FormData(this.form);
    const amount = parseInt(formData.get('loan_amount') || '50000', 10);
    const randomDigits = Math.floor(100000 + Math.random() * 900000);
    const leadRef = 'PIM-2610-' + randomDigits;

    // Simulate instant digital pre-screening verification
    await new Promise((resolve) => setTimeout(resolve, 800));

    try {
      // Store lead record in localStorage for offline persistence
      try {
        const leadRecord = {
          lead_reference: leadRef,
          full_name: formData.get('full_name') || '',
          mobile_number: formData.get('mobile_number') || '',
          employment_type: formData.get('employment_type') || '',
          monthly_income: formData.get('monthly_income') || '',
          loan_amount: amount,
          tenure_months: formData.get('tenure_months') || '12',
          city: formData.get('city') || '',
          pincode: formData.get('pincode') || '',
          created_at: new Date().toISOString()
        };
        const stored = JSON.parse(localStorage.getItem('pim_demo_leads') || '[]');
        stored.unshift(leadRecord);
        localStorage.setItem('pim_demo_leads', JSON.stringify(stored.slice(0, 50)));
      } catch (storageErr) {
        console.warn('LocalStorage save skipped:', storageErr);
      }

      // Track conversion event
      if (window.PIMAnalytics) {
        window.PIMAnalytics.trackEvent('generate_lead', {
          lead_id: leadRef,
          loan_amount: amount,
          value: amount,
          currency: 'INR',
        });
      }

      // Show Success View
      if (this.wizardContainer) this.wizardContainer.style.display = 'none';
      if (this.successContainer) {
        this.successContainer.style.display = 'block';
        if (this.successReferenceId) {
          this.successReferenceId.textContent = leadRef;
        }
      }
    } catch (err) {
      console.error('Submission error:', err);
      this.showAlert('An unexpected error occurred. Please verify your details and try again.');
      this.submitBtn.disabled = false;
      if (this.submitSpinner) this.submitSpinner.style.display = 'none';
      this.isSubmitting = false;
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('eligibilityForm')) {
    window.eligibilityWizardInstance = new EligibilityWizard();
  }
});
