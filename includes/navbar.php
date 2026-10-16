<?php
/**
 * Paisa in Minutes - Global Navigation Bar Include
 */

declare(strict_types=1);

$currentScript = basename($_SERVER['SCRIPT_NAME'] ?? '');
?>
<header class="site-header" role="banner">
  <div class="container site-nav">
    <!-- Brand Logo -->
    <a href="index.php" class="nav-brand" aria-label="Paisa in Minutes Homepage">
      <div class="nav-brand-logo">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="12" y1="1" x2="12" y2="23"></line>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
        </svg>
      </div>
      <div>
        Paisa<span class="accent">inMinutes</span>
      </div>
    </a>

    <!-- Navigation Links -->
    <nav aria-label="Main Navigation">
      <ul class="nav-links" id="navLinks">
        <li>
          <a href="index.php" class="nav-link <?= $currentScript === 'index.php' ? 'active' : '' ?>">Home</a>
        </li>
        <li>
          <a href="check-eligibility.php" class="nav-link <?= $currentScript === 'check-eligibility.php' ? 'active' : '' ?>">Check Eligibility</a>
        </li>
        <li>
          <a href="personal-loan-calculator.php" class="nav-link <?= $currentScript === 'personal-loan-calculator.php' ? 'active' : '' ?>">Loan Calculator</a>
        </li>
        <li>
          <a href="offers.php" class="nav-link <?= $currentScript === 'offers.php' ? 'active' : '' ?>">Partner Offers</a>
        </li>
        <li>
          <a href="how-it-works.php" class="nav-link <?= $currentScript === 'how-it-works.php' ? 'active' : '' ?>">How It Works</a>
        </li>
        <li>
          <a href="faq.php" class="nav-link <?= $currentScript === 'faq.php' ? 'active' : '' ?>">FAQs</a>
        </li>
      </ul>
    </nav>

    <!-- Header Actions -->
    <div class="nav-actions">
      <a href="check-eligibility.php" class="btn btn-yellow btn-sm" id="navCtaBtn">
        Apply Now
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"></line>
          <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
      </a>

      <!-- Mobile Hamburger Button -->
      <button class="nav-toggle-btn" id="navToggleBtn" aria-label="Toggle navigation menu" aria-expanded="false">
        &#9776;
      </button>
    </div>
  </div>
</header>
