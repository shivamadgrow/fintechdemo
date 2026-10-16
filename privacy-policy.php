<?php
/**
 * Paisa in Minutes - Privacy Policy
 * Compliant with India's Digital Personal Data Protection (DPDP) Act 2023 and RBI Digital Lending Guidelines
 */

declare(strict_types=1);

$pageTitle = 'Privacy Policy – Data Protection & Security | Paisa in Minutes';
$pageDescription = 'Our commitment to protecting your personal and financial data in full compliance with the Digital Personal Data Protection Act 2023 and RBI guidelines.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="background:#ffffff; padding-top:3.5rem;">
  <div class="container container-slim">
    <div style="margin-bottom: 2.5rem;">
      <span class="badge badge-emerald" style="margin-bottom:0.5rem;">Data Protection Compliance</span>
      <h1 class="heading-2" style="margin-bottom:0.5rem;">Privacy Policy</h1>
      <p style="font-size:0.875rem; color:var(--text-muted);">
        Effective Date: October 12, 2026 &bull; Version 2.4.0
      </p>
    </div>

    <div style="font-size:0.95rem; color:var(--text-secondary); line-height:1.75;">
      <p style="margin-bottom:1.25rem;">
        This Privacy Policy describes how <strong><?= htmlspecialchars($config['company']['legal_name']) ?></strong> ("Paisa in Minutes", "we", "us", or "our") collects, processes, stores, and protects personal and financial data provided by users ("you", "applicant") on this website. We operate strictly in compliance with the <strong>Digital Personal Data Protection (DPDP) Act, 2023</strong>, the Information Technology Act, 2000, and the Reserve Bank of India’s <strong>Guidelines on Digital Lending</strong>.
      </p>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">1. Principles of Data Minimization &amp; Limited Purpose</h2>
      <p style="margin-bottom:1.25rem;">
        We collect only the minimal data strictly required to facilitate digital loan discovery, pre-qualification checks, and regulatory audit compliance:
      </p>
      <ul style="padding-left:1.5rem; margin-bottom:1.25rem;">
        <li><strong>Identity & Contact Data:</strong> Full name, verified mobile phone number, email address, and residential city/PIN code.</li>
        <li><strong>Financial Profile Data:</strong> Self-declared employment tier, monthly in-hand income, and requested loan amount.</li>
        <li><strong>KYC Verification Identifiers:</strong> PAN number (collected only where requested by an approved lending partner, encrypted and masked during transmission).</li>
        <li><strong>Technical & Attribution Data:</strong> IP address, user-agent string, and marketing attribution tags (UTM parameters) to understand lead referral sources.</li>
      </ul>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">2. Explicit Prohibitions on Intrusive Permissions</h2>
      <p style="margin-bottom:1.25rem;">
        In strict adherence to RBI digital lending directives, our platform:
      </p>
      <ul style="padding-left:1.5rem; margin-bottom:1.25rem;">
        <li>Does <strong>NOT</strong> access your mobile contact book, address book, or social media connections.</li>
        <li>Does <strong>NOT</strong> access your photo gallery, media storage, or camera without explicit real-time e-KYC prompt.</li>
        <li>Does <strong>NOT</strong> track real-time continuous background biometric or geolocation data.</li>
      </ul>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">3. Data Sharing with Regulated Lending Partners</h2>
      <p style="margin-bottom:1.25rem;">
        Your information is shared strictly with authorized, RBI-registered Banks and Non-Banking Financial Companies (NBFCs) listed in our Lending Partner Registry, solely for the purpose of credit assessment, statutory verification, and loan sanctioning. We never sell, lease, or monetize your contact details to third-party telemarketers or unauthorized third parties.
      </p>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">4. Data Storage &amp; Encryption Standards</h2>
      <p style="margin-bottom:1.25rem;">
        All user communications are encrypted in transit using industry-standard TLS 1.3 cryptographic protocols. All application records and database repositories are hosted strictly within sovereign Indian territory, meeting the localization mandates of the Reserve Bank of India.
      </p>

      <h2 class="heading-4" style="color:var(--text-primary); margin:2rem 0 0.5rem 0;">5. Right to Erasure &amp; Consent Revocation</h2>
      <p style="margin-bottom:1.25rem;">
        Under the DPDP Act 2023, you retain the legal right to review, update, or revoke your consent for data processing. You may request deletion of your pre-qualification records by writing directly to our Data Protection & Grievance Desk at <a href="mailto:<?= htmlspecialchars($config['company']['nodal_officer']['email']) ?>" style="color:var(--color-royal-600);"><?= htmlspecialchars($config['company']['nodal_officer']['email']) ?></a>.
      </p>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
