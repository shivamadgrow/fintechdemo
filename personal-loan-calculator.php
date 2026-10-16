<?php
/**
 * Paisa in Minutes - Personal Loan EMI Calculator
 * Reducing-balance calculation, interactive sliders, visual donut chart,
 * amortization table, and shareable scenario URL.
 */

declare(strict_types=1);

$pageTitle = 'Personal Loan EMI Calculator – Reducing Balance Formula & Visual Chart';
$pageDescription = 'Calculate accurate monthly EMI, total interest, and total repayment for personal loans up to ₹1,00,000. Interactive sliders, visual principal-vs-interest chart, and month-by-month amortization schedule.';

require_once __DIR__ . '/includes/header.php';
$loanConfig = $config['loan'];
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;" aria-label="Loan EMI Calculator Section">
  <div class="container">
    <!-- Header -->
    <div class="text-center" style="margin-bottom: 3rem;">
      <span class="badge badge-royal" style="margin-bottom: 0.5rem;">Mathematical Transparency</span>
      <h1 class="heading-1" style="margin-bottom: 0.75rem;">
        Personal Loan EMI Calculator
      </h1>
      <p class="text-lead" style="max-width: 640px; margin: 0 auto;">
        Plan your monthly repayments with complete accuracy using the standard reducing-balance EMI methodology.
      </p>
    </div>

    <!-- 2-Column Calculator Layout -->
    <div class="grid grid-cols-12" style="gap: 2rem; align-items: flex-start;">
      <!-- Left Column: Controls (7 cols) -->
      <div style="grid-column: span 7;" class="card">
        <h2 class="heading-3" style="margin-bottom: 1.5rem; display:flex; justify-content:space-between; align-items:center;">
          <span>Loan Parameters</span>
          <button type="button" id="calcShareScenarioBtn" class="btn btn-outline-navy btn-sm" title="Copy shareable link for this calculation">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="18" cy="5" r="3"></circle>
              <circle cx="6" cy="12" r="3"></circle>
              <circle cx="18" cy="19" r="3"></circle>
              <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
              <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
            </svg>
            Share Scenario
          </button>
        </h2>
        <span id="calcShareFeedback" style="display:none; color:#15803d; font-size:0.8125rem; font-weight:600; margin-bottom:1rem;">Link copied to clipboard!</span>

        <!-- 1. Loan Amount -->
        <div class="form-group" style="margin-bottom: 2rem;">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem;">
            <label for="calcSliderAmount" class="form-label" style="margin-bottom: 0; font-size: 1rem;">
              Loan Principal Amount
            </label>
            <div style="position:relative; width: 150px;">
              <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#2563eb; font-weight:700;">₹</span>
              <input type="number" id="calcInputAmount" class="form-control" value="50000" min="10000" max="100000" step="5000" style="padding-left:28px; font-weight:700; font-size:1.05rem;">
            </div>
          </div>
          <input type="range" id="calcSliderAmount" class="range-slider" min="10000" max="100000" step="5000" value="50000" aria-label="Loan Amount Slider">
          <div class="range-slider-labels">
            <span>₹10,000 (Min)</span>
            <span>₹50,000</span>
            <span>₹1,00,000 (Max Limit)</span>
          </div>
        </div>

        <!-- 2. Annual Interest Rate (APR) -->
        <div class="form-group" style="margin-bottom: 2rem;">
          <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem;">
            <label for="calcSliderRate" class="form-label" style="margin-bottom: 0; font-size: 1rem;">
              Annual Interest Rate (APR)
            </label>
            <div style="position:relative; width: 110px;">
              <input type="number" id="calcInputRate" class="form-control" value="14.5" min="10" max="28" step="0.5" style="padding-right:28px; font-weight:700; font-size:1.05rem; text-align:right;">
              <span style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#64748b; font-weight:700;">%</span>
            </div>
          </div>
          <input type="range" id="calcSliderRate" class="range-slider" min="10" max="28" step="0.5" value="14.5" aria-label="Interest Rate Slider">
          <div class="range-slider-labels">
            <span>10% (Lowest)</span>
            <span>14.5% (Typical)</span>
            <span>28% (Highest)</span>
          </div>
        </div>

        <!-- 3. Tenure Selection -->
        <div class="form-group">
          <label class="form-label" style="font-size: 1rem; margin-bottom: 0.75rem;">
            Repayment Tenure (Months)
          </label>
          <div class="segmented-control">
            <button type="button" class="segmented-pill" data-tenure-pill="3">3 Months</button>
            <button type="button" class="segmented-pill" data-tenure-pill="6">6 Months</button>
            <button type="button" class="segmented-pill" data-tenure-pill="9">9 Months</button>
            <button type="button" class="segmented-pill active" data-tenure-pill="12">12 Months</button>
            <button type="button" class="segmented-pill" data-tenure-pill="18">18 Months</button>
            <button type="button" class="segmented-pill" data-tenure-pill="24">24 Months</button>
          </div>
        </div>

        <!-- Formula Notice -->
        <div style="margin-top:2.5rem; padding:1.25rem; background:var(--bg-surface-subtle); border-radius:12px; font-size:0.8125rem; color:var(--text-secondary); line-height:1.5;">
          <strong style="color:var(--text-primary); display:block; margin-bottom:4px;">Reducing-Balance Calculation Formula:</strong>
          <code>EMI = [P × r × (1 + r)^n] / [(1 + r)^n - 1]</code><br>
          Where <strong>P</strong> is Principal, <strong>r</strong> is Monthly Interest Rate (Annual Rate / 12 / 100), and <strong>n</strong> is number of monthly installments.
        </div>
      </div>

      <!-- Right Column: Visual Breakdown & Summary Card (5 cols) -->
      <div style="grid-column: span 5;">
        <div class="card" style="background:var(--color-navy-900); color:#fff; border-color:rgba(255,255,255,0.15); box-shadow:var(--shadow-lg);">
          <span class="badge badge-yellow" style="margin-bottom: 1rem;">Repayment Summary</span>
          
          <div style="margin-bottom: 1.5rem;">
            <div style="font-size:0.875rem; color:#93c5fd; text-transform:uppercase; letter-spacing:0.05em; font-weight:700;">
              Monthly Loan EMI
            </div>
            <div id="calcEmiDisplay" style="font-family:var(--font-heading); font-size:2.75rem; font-weight:800; color:var(--color-accent-yellow); line-height:1.1; margin:0.35rem 0;">
              ₹4,502
            </div>
            <p style="font-size:0.8125rem; color:#cbd5e1;">Due every month on reducing balance basis</p>
          </div>

          <!-- Donut Chart Visualization (Principal vs Interest) -->
          <div class="chart-container" style="border-top:1px solid rgba(255,255,255,0.1); border-bottom:1px solid rgba(255,255,255,0.1); padding: 1.5rem 0;">
            <svg id="calcDonutChart" class="donut-chart-svg" viewBox="0 0 100 100">
              <!-- Background Ring -->
              <circle cx="50" cy="50" r="45" fill="transparent" stroke="#1e293b" stroke-width="10"></circle>
              <!-- Principal Segment (Royal Blue) -->
              <circle id="chartPrincipalSegment" cx="50" cy="50" r="45" fill="transparent" stroke="#2563eb" stroke-width="10" stroke-dasharray="260 282.74"></circle>
              <!-- Interest Segment (Orange/Coral) -->
              <circle id="chartInterestSegment" cx="50" cy="50" r="45" fill="transparent" stroke="#f97316" stroke-width="10" stroke-dasharray="22 282.74" stroke-dashoffset="-260"></circle>
            </svg>

            <div class="chart-legend">
              <div class="legend-item">
                <span style="display:flex; align-items:center;">
                  <span class="legend-color-dot" style="background:#2563eb;"></span>
                  Principal (<span id="chartPrincipalPct">93%</span>)
                </span>
                <strong id="calcPrincipalDisplay" style="color:#fff;">₹50,000</strong>
              </div>
              <div class="legend-item">
                <span style="display:flex; align-items:center;">
                  <span class="legend-color-dot" style="background:#f97316;"></span>
                  Total Interest (<span id="chartInterestPct">7%</span>)
                </span>
                <strong id="calcTotalInterestDisplay" style="color:#f97316;">₹4,024</strong>
              </div>
            </div>
          </div>

          <!-- Total Repayment Sum -->
          <div style="margin: 1.5rem 0;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem; font-size:1rem;">
              <span style="color:#cbd5e1;">Total Repayment Amount:</span>
              <strong id="calcTotalPaymentDisplay" style="font-size:1.35rem; color:var(--color-accent-yellow);">₹54,024</strong>
            </div>
          </div>

          <a href="check-eligibility.php" class="btn btn-yellow btn-block btn-lg">
            Apply For This Amount &rarr;
          </a>
        </div>
      </div>
    </div>

    <!-- ========================================================================
         MONTHLY AMORTIZATION SCHEDULE TABLE
         ======================================================================== -->
    <div class="card" style="margin-top: 3.5rem;">
      <h2 class="heading-3" style="margin-bottom: 0.5rem;">
        Detailed Monthly Amortization Schedule
      </h2>
      <p style="color:var(--text-secondary); font-size:0.9rem; margin-bottom: 1.5rem;">
        Complete breakdown of principal deduction, interest payment, and remaining loan balance month by month.
      </p>

      <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.9375rem;">
          <thead>
            <tr style="background: var(--bg-surface-subtle); border-bottom: 2px solid var(--border-subtle);">
              <th style="padding: 12px 14px; text-align: center; color: var(--text-primary);">Installment</th>
              <th style="padding: 12px 14px; text-align: right; color: var(--text-primary);">EMI (₹)</th>
              <th style="padding: 12px 14px; text-align: right; color: var(--color-royal-600);">Principal (₹)</th>
              <th style="padding: 12px 14px; text-align: right; color: #f97316;">Interest (₹)</th>
              <th style="padding: 12px 14px; text-align: right; color: var(--text-primary);">Balance (₹)</th>
            </tr>
          </thead>
          <tbody id="amortizationTableBody">
            <!-- Dynamically populated by calculator.js -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Calculator Engine Script -->
<script src="assets/js/calculator.js?v=<?= $config['app']['version'] ?>" defer></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
