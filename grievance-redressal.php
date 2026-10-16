<?php
/**
 * Paisa in Minutes - Grievance Redressal Mechanism
 * In accordance with RBI Digital Lending Directives
 */

declare(strict_types=1);

$pageTitle = 'Grievance Redressal Matrix – Nodal Officer & Escalation | Paisa in Minutes';
$pageDescription = 'Customer grievance redressal policy, Principal Nodal Officer contact, turnaround times, and escalation mechanism to the Reserve Bank of India Sachet portal.';

require_once __DIR__ . '/includes/header.php';
$nodal = $config['company']['nodal_officer'];
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;">
  <div class="container container-narrow">
    <div class="text-center" style="margin-bottom: 3.5rem;">
      <span class="badge badge-emerald" style="margin-bottom:0.5rem;">Fair Practice Code</span>
      <h1 class="heading-1" style="margin-bottom:0.75rem;">
        Grievance Redressal Policy
      </h1>
      <p class="text-lead" style="max-width: 640px; margin: 0 auto;">
        We are committed to delivering prompt, impartial, and transparent resolution to any customer concern or dispute.
      </p>
    </div>

    <!-- 3-Tier Escalation Matrix -->
    <div class="grid grid-cols-3" style="gap:1.5rem; margin-bottom: 3rem;">
      <!-- Level 1 -->
      <div class="card" style="background:#fff;">
        <span class="badge badge-royal" style="margin-bottom:1rem;">Level 1: Support Desk</span>
        <h3 class="heading-4" style="margin-bottom:0.5rem;">Customer Care</h3>
        <p style="color:var(--text-secondary); font-size:0.875rem; line-height:1.5; margin-bottom:1rem;">
          For initial queries regarding loan pre-screening status, partner referral links, or platform navigation.
        </p>
        <div style="font-size:0.8125rem; color:var(--text-muted);">
          <div>Email: <a href="mailto:support@paisainminutes.com" style="color:var(--color-royal-600); font-weight:600;">support@paisainminutes.com</a></div>
          <div>Toll-Free: <?= htmlspecialchars($config['company']['phone']) ?></div>
          <div style="margin-top:0.5rem; font-weight:700; color:#15803d;">Turnaround: Within 48 Hours</div>
        </div>
      </div>

      <!-- Level 2 -->
      <div class="card" style="background:#fff; border-color:var(--color-royal-500); box-shadow:var(--shadow-sm);">
        <span class="badge badge-yellow" style="margin-bottom:1rem;">Level 2: Nodal Desk</span>
        <h3 class="heading-4" style="margin-bottom:0.5rem;">Principal Nodal Officer</h3>
        <p style="color:var(--text-secondary); font-size:0.875rem; line-height:1.5; margin-bottom:1rem;">
          If your issue is not resolved at Level 1 within 48 hours, escalate directly to our designated Nodal Officer.
        </p>
        <div style="font-size:0.8125rem; color:var(--text-muted);">
          <div>Officer: <strong><?= htmlspecialchars($nodal['name']) ?></strong></div>
          <div>Email: <a href="mailto:<?= htmlspecialchars($nodal['email']) ?>" style="color:var(--color-royal-600); font-weight:600;"><?= htmlspecialchars($nodal['email']) ?></a></div>
          <div>Phone: <?= htmlspecialchars($nodal['phone']) ?></div>
          <div style="margin-top:0.5rem; font-weight:700; color:#15803d;">Turnaround: Max 14 Days</div>
        </div>
      </div>

      <!-- Level 3 -->
      <div class="card" style="background:#fff;">
        <span class="badge badge-salmon" style="margin-bottom:1rem;">Level 3: Regulatory</span>
        <h3 class="heading-4" style="margin-bottom:0.5rem;">Reserve Bank of India</h3>
        <p style="color:var(--text-secondary); font-size:0.875rem; line-height:1.5; margin-bottom:1rem;">
          If the grievance remains unresolved for over 30 calendar days, you may escalate directly to the RBI.
        </p>
        <div style="font-size:0.8125rem; color:var(--text-muted);">
          <div>Portal: <a href="https://sachet.rbi.org.in/" target="_blank" rel="noopener noreferrer" style="color:var(--color-royal-600); font-weight:600;">RBI Sachet Portal &rarr;</a></div>
          <div>CMS: <a href="https://cms.rbi.org.in/" target="_blank" rel="noopener noreferrer" style="color:var(--color-royal-600); font-weight:600;">RBI CMS Portal &rarr;</a></div>
          <div style="margin-top:0.5rem; font-weight:700; color:var(--color-accent-salmon-dark);">Regulatory Recourse</div>
        </div>
      </div>
    </div>

    <!-- Official Postal Address for Written Grievances -->
    <div class="card" style="background:#fff; padding:2rem;">
      <h2 class="heading-4" style="margin-bottom:1rem;">Submission of Written Grievances</h2>
      <p style="color:var(--text-secondary); line-height:1.6; margin-bottom:1rem; font-size:0.9375rem;">
        You may also submit complaints via Registered Post or Speed Post addressed to:
      </p>
      <div style="background:var(--bg-surface-subtle); padding:1.25rem; border-radius:12px; font-size:0.875rem; line-height:1.6;">
        <strong>Attention: Principal Grievance Redressal Officer</strong><br>
        <?= htmlspecialchars($config['company']['legal_name']) ?><br>
        <?= htmlspecialchars($config['company']['address']) ?><br>
        Ref. Tracking: Please state your <strong>Lead Reference ID</strong> clearly on all written correspondence.
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
