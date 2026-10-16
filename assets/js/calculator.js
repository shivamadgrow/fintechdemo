/**
 * Paisa in Minutes - Loan EMI Calculator Engine
 * Reducing-balance calculation, two-way slider sync, SVG donut chart & amortization schedule
 */

class LoanCalculator {
  constructor(config = {}) {
    this.minAmount = config.minAmount || 10000;
    this.maxAmount = config.maxAmount || 100000;
    this.defaultAmount = config.defaultAmount || 50000;
    this.minTenure = config.minTenure || 3;
    this.maxTenure = config.maxTenure || 24;
    this.defaultTenure = config.defaultTenure || 12;
    this.defaultRate = config.defaultRate || 14.5;
    
    this.state = {
      amount: this.defaultAmount,
      tenure: this.defaultTenure,
      rate: this.defaultRate,
    };

    this.debounceTimer = null;
    this.initElements();
    this.bindEvents();
    this.readUrlParameters();
    this.recalculate();
  }

  initElements() {
    // Input elements
    this.sliderAmount = document.getElementById('calcSliderAmount');
    this.inputAmount = document.getElementById('calcInputAmount');
    this.sliderRate = document.getElementById('calcSliderRate');
    this.inputRate = document.getElementById('calcInputRate');
    this.tenurePills = document.querySelectorAll('[data-tenure-pill]');

    // Output displays
    this.displayEmi = document.getElementById('calcEmiDisplay');
    this.displayTotalInterest = document.getElementById('calcTotalInterestDisplay');
    this.displayTotalPayment = document.getElementById('calcTotalPaymentDisplay');
    this.displayPrincipal = document.getElementById('calcPrincipalDisplay');

    // Chart SVG elements
    this.chartSvg = document.getElementById('calcDonutChart');
    this.chartPrincipalSegment = document.getElementById('chartPrincipalSegment');
    this.chartInterestSegment = document.getElementById('chartInterestSegment');
    this.chartPrincipalPct = document.getElementById('chartPrincipalPct');
    this.chartInterestPct = document.getElementById('chartInterestPct');

    // Amortization table
    this.amortizationBody = document.getElementById('amortizationTableBody');
    this.shareBtn = document.getElementById('calcShareScenarioBtn');
    this.shareFeedback = document.getElementById('calcShareFeedback');
  }

  bindEvents() {
    // Slider Amount <-> Number Input Sync
    if (this.sliderAmount && this.inputAmount) {
      this.sliderAmount.addEventListener('input', (e) => {
        const val = parseInt(e.target.value, 10);
        this.state.amount = this.clampAmount(val);
        this.inputAmount.value = this.state.amount;
        this.updateSliderTrack(this.sliderAmount, this.minAmount, this.maxAmount, this.state.amount);
        this.onUserInteraction();
      });

      this.inputAmount.addEventListener('change', (e) => {
        let val = parseInt(e.target.value.replace(/[^0-9]/g, ''), 10) || this.minAmount;
        val = this.clampAmount(val);
        this.state.amount = val;
        this.inputAmount.value = val;
        this.sliderAmount.value = val;
        this.updateSliderTrack(this.sliderAmount, this.minAmount, this.maxAmount, val);
        this.onUserInteraction();
      });
    }

    // Rate Slider <-> Rate Input Sync
    if (this.sliderRate && this.inputRate) {
      this.sliderRate.addEventListener('input', (e) => {
        const val = parseFloat(e.target.value);
        this.state.rate = val;
        this.inputRate.value = val.toFixed(1);
        this.updateSliderTrack(this.sliderRate, 10, 28, val);
        this.onUserInteraction();
      });

      this.inputRate.addEventListener('change', (e) => {
        let val = parseFloat(e.target.value) || 14.5;
        val = Math.min(Math.max(val, 10), 28);
        this.state.rate = val;
        this.inputRate.value = val.toFixed(1);
        this.sliderRate.value = val;
        this.updateSliderTrack(this.sliderRate, 10, 28, val);
        this.onUserInteraction();
      });
    }

    // Tenure Pills Selection
    this.tenurePills.forEach((pill) => {
      pill.addEventListener('click', () => {
        const tenureVal = parseInt(pill.getAttribute('data-tenure-pill'), 10);
        this.state.tenure = tenureVal;

        this.tenurePills.forEach((p) => p.classList.remove('active'));
        pill.classList.add('active');

        this.onUserInteraction();
      });
    });

    // Share Calculation Button
    if (this.shareBtn) {
      this.shareBtn.addEventListener('click', () => this.copyShareableLink());
    }
  }

  clampAmount(val) {
    return Math.min(Math.max(val, this.minAmount), this.maxAmount);
  }

  updateSliderTrack(slider, min, max, val) {
    if (!slider) return;
    const percentage = ((val - min) / (max - min)) * 100;
    slider.style.background = `linear-gradient(to right, #2563eb 0%, #2563eb ${percentage}%, #e2e8f0 ${percentage}%, #e2e8f0 100%)`;
  }

  onUserInteraction() {
    this.recalculate();

    // Debounced analytics tracking
    clearTimeout(this.debounceTimer);
    this.debounceTimer = setTimeout(() => {
      if (window.PIMAnalytics) {
        window.PIMAnalytics.trackCalculator(this.state.amount, this.state.tenure, this.state.rate);
      }
    }, 800);
  }

  /**
   * Reducing-balance EMI math:
   * EMI = P × r × (1 + r)^n / ((1 + r)^n - 1)
   */
  calculateEMI(P, annualRate, n) {
    if (P <= 0 || n <= 0) return { emi: 0, totalInterest: 0, totalPayment: 0 };

    if (annualRate <= 0) {
      const emi = Math.round(P / n);
      return { emi, totalInterest: 0, totalPayment: P };
    }

    const r = (annualRate / 12) / 100;
    const factor = Math.pow(1 + r, n);
    const emi = Math.round((P * r * factor) / (factor - 1));
    const totalPayment = emi * n;
    const totalInterest = Math.max(0, totalPayment - P);

    return { emi, totalInterest, totalPayment };
  }

  recalculate() {
    const { amount, tenure, rate } = this.state;
    const result = this.calculateEMI(amount, rate, tenure);

    // Update DOM Display
    if (this.displayEmi) this.displayEmi.textContent = '₹' + result.emi.toLocaleString('en-IN');
    if (this.displayTotalInterest) this.displayTotalInterest.textContent = '₹' + result.totalInterest.toLocaleString('en-IN');
    if (this.displayTotalPayment) this.displayTotalPayment.textContent = '₹' + result.totalPayment.toLocaleString('en-IN');
    if (this.displayPrincipal) this.displayPrincipal.textContent = '₹' + amount.toLocaleString('en-IN');

    // Update Donut Chart
    this.updateVisualChart(amount, result.totalInterest, result.totalPayment);

    // Update Amortization Table if present
    if (this.amortizationBody) {
      this.generateAmortizationSchedule(amount, rate, tenure, result.emi);
    }
  }

  updateVisualChart(principal, interest, total) {
    if (!this.chartPrincipalSegment || !this.chartInterestSegment || total <= 0) return;

    const principalPct = Math.round((principal / total) * 100);
    const interestPct = 100 - principalPct;

    if (this.chartPrincipalPct) this.chartPrincipalPct.textContent = `${principalPct}%`;
    if (this.chartInterestPct) this.chartInterestPct.textContent = `${interestPct}%`;

    // SVG Circle perimeter = 2 * PI * r (r = 45 => ~282.74)
    const perimeter = 282.74;
    const principalDash = (principalPct / 100) * perimeter;
    const interestDash = (interestPct / 100) * perimeter;

    this.chartPrincipalSegment.setAttribute('stroke-dasharray', `${principalDash} ${perimeter}`);
    this.chartInterestSegment.setAttribute('stroke-dasharray', `${interestDash} ${perimeter}`);
    this.chartInterestSegment.setAttribute('stroke-dashoffset', `-${principalDash}`);
  }

  generateAmortizationSchedule(principal, annualRate, tenure, emi) {
    const monthlyRate = (annualRate / 12) / 100;
    let balance = principal;
    let html = '';

    for (let month = 1; month <= tenure; month++) {
      const interestComponent = Math.round(balance * monthlyRate);
      const principalComponent = Math.min(balance, emi - interestComponent);
      balance = Math.max(0, balance - principalComponent);

      html += `
        <tr>
          <td style="padding: 10px 14px; font-weight: 600; text-align: center;">Month ${month}</td>
          <td style="padding: 10px 14px; text-align: right;">₹${emi.toLocaleString('en-IN')}</td>
          <td style="padding: 10px 14px; text-align: right; color: #2563eb;">₹${principalComponent.toLocaleString('en-IN')}</td>
          <td style="padding: 10px 14px; text-align: right; color: #f97316;">₹${interestComponent.toLocaleString('en-IN')}</td>
          <td style="padding: 10px 14px; text-align: right; font-weight: 600;">₹${balance.toLocaleString('en-IN')}</td>
        </tr>
      `;
    }

    this.amortizationBody.innerHTML = html;
  }

  readUrlParameters() {
    const params = new URLSearchParams(window.location.search);
    if (params.has('amount')) {
      const a = parseInt(params.get('amount'), 10);
      if (!isNaN(a)) {
        this.state.amount = this.clampAmount(a);
        if (this.sliderAmount) this.sliderAmount.value = this.state.amount;
        if (this.inputAmount) this.inputAmount.value = this.state.amount;
      }
    }

    if (params.has('tenure')) {
      const t = parseInt(params.get('tenure'), 10);
      if (!isNaN(t) && t >= this.minTenure && t <= this.maxTenure) {
        this.state.tenure = t;
        this.tenurePills.forEach((p) => {
          if (parseInt(p.getAttribute('data-tenure-pill'), 10) === t) {
            p.classList.add('active');
          } else {
            p.classList.remove('active');
          }
        });
      }
    }

    if (params.has('rate')) {
      const r = parseFloat(params.get('rate'));
      if (!isNaN(r) && r >= 10 && r <= 28) {
        this.state.rate = r;
        if (this.sliderRate) this.sliderRate.value = r;
        if (this.inputRate) this.inputRate.value = r.toFixed(1);
      }
    }

    if (this.sliderAmount) {
      this.updateSliderTrack(this.sliderAmount, this.minAmount, this.maxAmount, this.state.amount);
    }
  }

  copyShareableLink() {
    const url = new URL(window.location.origin + window.location.pathname);
    url.searchParams.set('amount', this.state.amount);
    url.searchParams.set('tenure', this.state.tenure);
    url.searchParams.set('rate', this.state.rate);

    navigator.clipboard.writeText(url.toString()).then(() => {
      if (this.shareFeedback) {
        this.shareFeedback.style.display = 'inline-block';
        setTimeout(() => {
          this.shareFeedback.style.display = 'none';
        }, 3000);
      }
    }).catch(() => {
      prompt('Copy this loan scenario link:', url.toString());
    });
  }
}

// Global initialization
window.PIMLoanCalculator = LoanCalculator;
document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('calcSliderAmount')) {
    window.loanCalcInstance = new LoanCalculator();
  }
});
