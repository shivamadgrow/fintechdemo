<?php
/**
 * Paisa in Minutes - Custom 404 Error Page
 */

declare(strict_types=1);

http_response_code(404);
$pageTitle = 'Page Not Found (404) | Paisa in Minutes';
$pageDescription = 'The page you are looking for does not exist or has been moved. Explore our personal loan calculator and eligibility check tools.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="background:#f8fafc; min-height:75vh; display:flex; align-items:center;">
  <div class="container container-slim text-center">
    <div style="font-family:var(--font-heading); font-size:clamp(4rem, 10vw, 7rem); font-weight:800; color:var(--color-royal-600); line-height:1; margin-bottom:1rem;">
      404
    </div>
    <span class="badge badge-salmon" style="margin-bottom:1rem;">Resource Not Found</span>
    <h1 class="heading-2" style="margin-bottom:1rem;">Oops! This Financial Route Does Not Exist</h1>
    <p class="text-lead" style="max-width:520px; margin:0 auto 2rem auto;">
      The URL you requested may have been relocated, updated, or temporarily archived. Here are helpful destinations to get back on track:
    </p>

    <div style="display:flex; justify-content:center; gap:1rem; flex-wrap:wrap;">
      <a href="index.php" class="btn btn-primary">Return to Homepage</a>
      <a href="check-eligibility.php" class="btn btn-yellow">Check Loan Eligibility</a>
      <a href="personal-loan-calculator.php" class="btn btn-outline-navy">EMI Calculator</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
