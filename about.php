<?php
/**
 * Paisa in Minutes - About Us Page
 */

declare(strict_types=1);

$pageTitle = 'About Us – Empowering Transparent Digital Credit in India';
$pageDescription = 'Learn about Paisa in Minutes, an Indian financial technology platform connecting credit-seeking consumers with regulated Bank and NBFC personal loans.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;">
  <div class="container container-narrow">
    <div class="text-center" style="margin-bottom: 3.5rem;">
      <span class="badge badge-royal" style="margin-bottom: 0.5rem;">Our Mission</span>
      <h1 class="heading-1" style="margin-bottom: 0.75rem;">
        Making Personal Credit Fair, Transparent & Fast
      </h1>
      <p class="text-lead" style="max-width: 640px; margin: 0 auto;">
        We believe every hard-working Indian deserves clear, honest access to short-term emergency liquidity without predatory terms or hidden traps.
      </p>
    </div>

    <div class="card" style="margin-bottom: 2.5rem;">
      <h2 class="heading-3" style="margin-bottom: 1rem;">Who We Are</h2>
      <p style="color:var(--text-secondary); line-height:1.7; margin-bottom:1.25rem;">
        <strong><?= htmlspecialchars($config['company']['legal_name']) ?></strong> is a technology-first digital lending discovery platform incorporated under the Companies Act, 2013 (CIN: <?= htmlspecialchars($config['company']['cin']) ?>). We operate as a dedicated <strong>Lending Service Provider (LSP)</strong> partnering with premier Reserve Bank of India (RBI) regulated Non-Banking Financial Companies (NBFCs) and commercial banks.
      </p>
      <p style="color:var(--text-secondary); line-height:1.7;">
        Across India, millions of young salaried professionals and small business owners face sudden short-term cash crunches—medical emergencies, home repairs, or certification fees. Traditional banks take weeks to process small loan amounts, while illegal loan apps exploit borrowers with extortionate daily fees and abusive harassment. Paisa in Minutes was founded to provide a legitimate, responsible, and compliant alternative.
      </p>
    </div>

    <!-- Guiding Principles Grid -->
    <h2 class="heading-3" style="margin-bottom: 1.5rem; text-align:center;">Our Uncompromising Standards</h2>
    <div class="grid grid-cols-2" style="gap:1.5rem; margin-bottom: 3rem;">
      <div class="card">
        <h3 class="heading-4" style="color:var(--color-royal-600); margin-bottom:0.5rem;">1. Capped at ₹1,00,000</h3>
        <p style="color:var(--text-secondary); font-size:0.9rem; line-height:1.6;">
          We deliberately cap personal loans to ₹1,00,000. We do not promote unmanageable long-term debt, ensuring your monthly obligations remain well within your income capability.
        </p>
      </div>

      <div class="card">
        <h3 class="heading-4" style="color:var(--color-royal-600); margin-bottom:0.5rem;">2. Standardized Key Fact Statements</h3>
        <p style="color:var(--text-secondary); font-size:0.9rem; line-height:1.6;">
          In accordance with RBI circulars, every loan offer includes an itemized breakdown of APR, interest, and processing charges before you accept.
        </p>
      </div>

      <div class="card">
        <h3 class="heading-4" style="color:var(--color-royal-600); margin-bottom:0.5rem;">3. DPDP Act Data Privacy</h3>
        <p style="color:var(--text-secondary); font-size:0.9rem; line-height:1.6;">
          We never access your contact address book, photo galleries, or location metadata. Your data is stored strictly in secure Indian data centers.
        </p>
      </div>

      <div class="card">
        <h3 class="heading-4" style="color:var(--color-royal-600); margin-bottom:0.5rem;">4. Strict Partner Vetting</h3>
        <p style="color:var(--text-secondary); font-size:0.9rem; line-height:1.6;">
          We do not work with unregistered loan providers or unregulated mobile apps. Every partner is an established institution holding an active RBI certificate.
        </p>
      </div>
    </div>

    <!-- Corporate Information -->
    <div class="card" style="background:var(--color-navy-900); color:#fff; border-color:rgba(255,255,255,0.15);">
      <h3 class="heading-4" style="color:#fff; margin-bottom:1rem;">Registered Entity Details</h3>
      <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:1rem; font-size:0.875rem;">
        <div>
          <span style="color:#94a3b8; display:block;">Legal Entity Name</span>
          <strong style="color:#fff;"><?= htmlspecialchars($config['company']['legal_name']) ?></strong>
        </div>
        <div>
          <span style="color:#94a3b8; display:block;">Corporate Identity Number (CIN)</span>
          <strong style="color:var(--color-accent-yellow);"><?= htmlspecialchars($config['company']['cin']) ?></strong>
        </div>
        <div>
          <span style="color:#94a3b8; display:block;">Registered Office</span>
          <strong style="color:#cbd5e1;"><?= htmlspecialchars($config['company']['address']) ?></strong>
        </div>
        <div>
          <span style="color:#94a3b8; display:block;">Regulatory Function</span>
          <strong style="color:#cbd5e1;"><?= htmlspecialchars($config['company']['role']) ?></strong>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
