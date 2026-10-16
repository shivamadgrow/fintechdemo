<?php
/**
 * Paisa in Minutes - Financial Literacy & Education Hub
 */

declare(strict_types=1);

$pageTitle = 'Financial Literacy & Personal Loan Guides | Paisa in Minutes';
$pageDescription = 'Educational guides on personal loan borrowing in India. Learn about reducing-balance interest rates, CIBIL score optimization, and RBI digital lending safety guidelines.';

require_once __DIR__ . '/includes/header.php';

$articles = [
    [
        'slug' => 'understanding-reducing-vs-flat-rate-emi',
        'title' => 'Reducing-Balance vs. Flat Interest Rate: Why You Must Never Confuse the Two',
        'category' => 'Borrower Education',
        'read_time' => '4 min read',
        'excerpt' => 'A flat 12% loan might actually cost you nearly 22% in effective APR! Learn how the reducing-balance formula saves thousands of rupees on your personal loan.',
        'date' => 'October 2026',
    ],
    [
        'slug' => 'how-to-protect-cibil-score-when-applying',
        'title' => 'How to Protect Your CIBIL Score When Searching for Short-Term Personal Credit',
        'category' => 'Credit Health',
        'read_time' => '5 min read',
        'excerpt' => 'Multiple hard inquiries in a short window can drag your score down by 30+ points. Here is how soft eligibility checks keep your credit profile pristine.',
        'date' => 'October 2026',
    ],
    [
        'slug' => 'rbi-digital-lending-guidelines-borrower-rights',
        'title' => 'RBI Digital Lending Guidelines: 5 Mandatory Rights Every Borrower Must Know',
        'category' => 'Regulations & Safety',
        'read_time' => '6 min read',
        'excerpt' => 'From mandatory Key Fact Statements (KFS) to cooling-off exit periods, explore the vital protections guaranteed by the Reserve Bank of India.',
        'date' => 'September 2026',
    ],
    [
        'slug' => 'how-micro-personal-loans-manage-emergency-cashflow',
        'title' => 'Managing Emergency Cashflow: Why Micro-Loans (Under ₹1 Lakh) Are Often Safer',
        'category' => 'Personal Finance',
        'read_time' => '3 min read',
        'excerpt' => 'Why borrowing only what you need for urgent repairs or medical bills prevents multi-year debt burdens.',
        'date' => 'September 2026',
    ],
];
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;">
  <div class="container">
    <div class="text-center" style="margin-bottom: 3.5rem;">
      <span class="badge badge-royal" style="margin-bottom: 0.5rem;">Consumer Literacy Hub</span>
      <h1 class="heading-1" style="margin-bottom: 0.75rem;">
        Financial Literacy &amp; Personal Loan Guides
      </h1>
      <p class="text-lead" style="max-width: 640px; margin: 0 auto;">
        Objective, research-backed insights to help you make responsible borrowing decisions in India.
      </p>
    </div>

    <div class="grid grid-cols-2" style="gap: 2rem;">
      <?php foreach ($articles as $art): ?>
        <article class="card" style="display:flex; flex-direction:column; justify-content:space-between; background:#fff;">
          <div>
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.75rem;">
              <span class="badge badge-salmon"><?= htmlspecialchars($art['category']) ?></span>
              <span style="font-size:0.75rem; color:var(--text-muted);"><?= htmlspecialchars($art['read_time']) ?> &bull; <?= htmlspecialchars($art['date']) ?></span>
            </div>

            <h2 class="heading-4" style="margin-bottom: 0.75rem;">
              <a href="blog-post.php?slug=<?= urlencode($art['slug']) ?>" style="color:var(--text-primary); text-decoration:none;">
                <?= htmlspecialchars($art['title']) ?>
              </a>
            </h2>

            <p style="color:var(--text-secondary); font-size:0.9rem; line-height:1.6; margin-bottom: 1.5rem;">
              <?= htmlspecialchars($art['excerpt']) ?>
            </p>
          </div>

          <div>
            <a href="blog-post.php?slug=<?= urlencode($art['slug']) ?>" class="btn btn-outline-navy btn-sm">
              Read Complete Guide &rarr;
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
