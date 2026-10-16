<?php
/**
 * Paisa in Minutes - Educational Guide Detail View
 */

declare(strict_types=1);

$slug = trim((string) ($_GET['slug'] ?? 'understanding-reducing-vs-flat-rate-emi'));

$posts = [
    'understanding-reducing-vs-flat-rate-emi' => [
        'title' => 'Reducing-Balance vs. Flat Interest Rate: Why You Must Never Confuse the Two',
        'category' => 'Borrower Education',
        'read_time' => '4 min read',
        'date' => 'October 12, 2026',
        'content' => <<<HTML
          <p class="text-lead" style="margin-bottom:1.5rem;">
            When searching for personal loans in India, borrowers frequently encounter two entirely distinct interest calculation models: <strong>Flat Interest Rate</strong> and <strong>Reducing-Balance Interest Rate</strong>. While a 12% flat rate might sound identical or even cheaper than a 14% reducing rate on surface, the mathematical reality is shockingly different.
          </p>

          <h3 class="heading-3" style="margin: 2rem 0 0.75rem 0;">What is a Flat Interest Rate?</h3>
          <p style="margin-bottom:1rem; line-height:1.7;">
            In a flat rate calculation, interest is charged on the <em>entire initial principal amount</em> across the entire tenure, ignoring the fact that you are actively paying down the loan balance every single month.
          </p>
          <p style="margin-bottom:1.5rem; line-height:1.7;">
            For example, on a ₹50,000 personal loan for 1 year at 12% flat rate: Total interest is calculated as ₹50,000 × 12% = ₹6,000. Total repayment = ₹56,000, resulting in an EMI of ₹4,666.
          </p>

          <h3 class="heading-3" style="margin: 2rem 0 0.75rem 0;">What is a Reducing-Balance Interest Rate?</h3>
          <p style="margin-bottom:1rem; line-height:1.7;">
            Under the standard reducing-balance method (mandated by the Reserve Bank of India for all regulated lenders), interest for any given month is calculated <strong>only on the outstanding principal balance</strong> remaining after deducting the principal portion of your previous monthly payments.
          </p>
          <p style="margin-bottom:1.5rem; line-height:1.7;">
            On the exact same ₹50,000 personal loan for 12 months at 14% reducing rate: Monthly EMI is ₹4,490, and total interest paid is only ₹3,884! Even though the headline rate is 14% vs 12%, you save more than ₹2,100 in actual cash because your interest shrinks as the balance diminishes.
          </p>

          <div style="background:#eff6ff; border-radius:14px; padding:1.5rem; margin:2rem 0; border:1px solid #bfdbfe;">
            <h4 style="color:#1e40af; font-size:1.1rem; font-weight:700; margin-bottom:0.5rem;">Rule of Thumb for Comparing Rates</h4>
            <p style="color:#1e3a8a; font-size:0.95rem; line-height:1.6; margin:0;">
              As a general financial benchmark, an advertised flat interest rate corresponds to roughly <strong>1.8x to 1.9x</strong> in equivalent reducing-balance Annual Percentage Rate (APR). A 12% flat loan has an effective APR of approximately 22%!
            </p>
          </div>

          <h3 class="heading-3" style="margin: 2rem 0 0.75rem 0;">How Paisa in Minutes Protects You</h3>
          <p style="margin-bottom:1.5rem; line-height:1.7;">
            All partner offers displayed on Paisa in Minutes strictly adhere to the transparent reducing-balance APR methodology. Furthermore, our interactive EMI calculator lets you visualize the exact split between principal and interest so you never get blindsided by misleading loan marketing.
          </p>
HTML
    ],
    'how-to-protect-cibil-score-when-applying' => [
        'title' => 'How to Protect Your CIBIL Score When Searching for Short-Term Personal Credit',
        'category' => 'Credit Health',
        'read_time' => '5 min read',
        'date' => 'October 10, 2026',
        'content' => <<<HTML
          <p class="text-lead" style="margin-bottom:1.5rem;">
            When you need quick funds for an unforeseen expense, it is tempting to submit applications across five or six different loan websites simultaneously. However, doing so can trigger a cascade of "hard inquiries" that immediately impairs your credit bureau score.
          </p>

          <h3 class="heading-3" style="margin: 2rem 0 0.75rem 0;">Hard Inquiries vs. Soft Eligibility Inquiries</h3>
          <p style="margin-bottom:1rem; line-height:1.7;">
            A <strong>Hard Inquiry</strong> occurs when a formal credit provider pulls your complete bureau report to sanction an active credit application. Multiple hard inquiries in a brief 14-day window indicate "credit hunger" or potential financial distress to credit algorithms, shaving off valuable points from your score.
          </p>
          <p style="margin-bottom:1.5rem; line-height:1.7;">
            A <strong>Soft Inquiry</strong>, by contrast, is an exploratory pre-screening check. It enables discovery platforms like Paisa in Minutes to evaluate your general borrowing tier without leaving any negative mark on your bureau file.
          </p>

          <h3 class="heading-3" style="margin: 2rem 0 0.75rem 0;">Key Steps to Keep Your Score Above 750</h3>
          <ul style="padding-left:1.5rem; line-height:1.8; margin-bottom:1.5rem;">
            <li>Always pre-screen eligibility through discovery portals using soft pull checks before applying formally.</li>
            <li>Maintain an aggregate credit utilization ratio below 30% of your existing credit limits.</li>
            <li>Set up automated e-NACH mandate instructions so you never miss an EMI due date due to travel or oversight.</li>
            <li>Limit personal borrowing to manageable micro-tickets (₹10,000 to ₹1,00,000) that you can clear within 12 to 24 months.</li>
          </ul>
HTML
    ],
];

$post = $posts[$slug] ?? $posts['understanding-reducing-vs-flat-rate-emi'];
$pageTitle = $post['title'] . ' | Paisa in Minutes';
$pageDescription = substr(strip_tags($post['content']), 0, 160) . '...';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="background:#ffffff; padding-top:3.5rem;">
  <div class="container container-slim">
    <div style="margin-bottom: 2rem;">
      <a href="blog.php" style="color:var(--color-royal-600); font-weight:600; font-size:0.875rem;">&larr; Back to all Guides</a>
      <div style="display:flex; gap:0.75rem; align-items:center; margin-top:1rem; margin-bottom:0.75rem;">
        <span class="badge badge-salmon"><?= htmlspecialchars($post['category']) ?></span>
        <span style="font-size:0.8125rem; color:var(--text-muted);"><?= htmlspecialchars($post['read_time']) ?> &bull; <?= htmlspecialchars($post['date']) ?></span>
      </div>
      <h1 class="heading-2" style="line-height:1.2;"><?= htmlspecialchars($post['title']) ?></h1>
    </div>

    <!-- Article Body -->
    <div style="font-size:1.05rem; color:var(--text-primary); line-height:1.75;">
      <?= $post['content'] ?>
    </div>

    <!-- Bottom Action Card -->
    <div class="card" style="margin-top:3.5rem; background:var(--color-navy-900); color:#fff; text-align:center;">
      <h3 class="heading-3" style="color:#fff; margin-bottom:0.5rem;">Evaluate Your Live Loan EMI</h3>
      <p style="color:#cbd5e1; font-size:0.95rem; margin-bottom:1.5rem;">
        Use our reducing-balance EMI calculator to compare illustrative repayment figures right now.
      </p>
      <div style="display:flex; justify-content:center; gap:1rem;">
        <a href="personal-loan-calculator.php" class="btn btn-yellow">Open Loan Calculator</a>
        <a href="check-eligibility.php" class="btn btn-outline-white">Check Free Eligibility</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
