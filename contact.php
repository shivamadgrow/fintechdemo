<?php
/**
 * Paisa in Minutes - Contact & Support Page
 */

declare(strict_types=1);

$pageTitle = 'Contact Us – Customer Support & Grievance Desk';
$pageDescription = 'Get in touch with the Paisa in Minutes support desk. Our team is available Monday to Saturday to assist with personal loan discovery queries and grievances.';

require_once __DIR__ . '/includes/header.php';

$contactSuccess = false;
$contactError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'contact') {
    if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
        $contactError = 'Security session expired. Please submit again.';
    } else {
        $name = cleanInput($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $message = cleanInput($_POST['message'] ?? '');

        if (strlen($name) < 2 || !$email || strlen($message) < 5) {
            $contactError = 'Please fill out all required fields with valid information.';
        } else {
            // Success response
            $contactSuccess = true;
        }
    }
}
?>

<section class="section" style="background:#f8fafc; padding-top:3.5rem;">
  <div class="container container-narrow">
    <div class="text-center" style="margin-bottom: 3rem;">
      <span class="badge badge-royal" style="margin-bottom:0.5rem;">We Are Here To Help</span>
      <h1 class="heading-1" style="margin-bottom:0.75rem;">Contact Customer Support</h1>
      <p class="text-lead" style="max-width:600px; margin:0 auto;">
        Have a question about your personal loan discovery request? Reach out to our dedicated support representatives.
      </p>
    </div>

    <div class="grid grid-cols-12" style="gap:2rem;">
      <!-- Contact Info Cards (5 cols) -->
      <div style="grid-column:span 5; display:flex; flex-direction:column; gap:1.25rem;">
        <div class="card" style="padding:1.5rem;">
          <h3 class="heading-4" style="color:var(--color-royal-600); margin-bottom:0.4rem;">Customer Toll-Free</h3>
          <p style="font-size:0.875rem; color:var(--text-muted); margin-bottom:0.5rem;">Mon - Sat, 9:30 AM to 6:30 PM IST</p>
          <a href="tel:18002028899" style="font-size:1.15rem; font-weight:700; color:var(--text-primary);"><?= htmlspecialchars($config['company']['phone']) ?></a>
        </div>

        <div class="card" style="padding:1.5rem;">
          <h3 class="heading-4" style="color:var(--color-royal-600); margin-bottom:0.4rem;">Email Inquiries</h3>
          <p style="font-size:0.875rem; color:var(--text-muted); margin-bottom:0.5rem;">Average response within 4 working hours</p>
          <a href="mailto:<?= htmlspecialchars($config['company']['email']) ?>" style="font-size:1rem; font-weight:700; color:var(--color-royal-600);"><?= htmlspecialchars($config['company']['email']) ?></a>
        </div>

        <div class="card" style="padding:1.5rem;">
          <h3 class="heading-4" style="color:var(--color-royal-600); margin-bottom:0.4rem;">Corporate Office</h3>
          <p style="font-size:0.875rem; color:var(--text-secondary); line-height:1.5;">
            <?= htmlspecialchars($config['company']['address']) ?>
          </p>
        </div>
      </div>

      <!-- Contact Form (7 cols) -->
      <div style="grid-column:span 7;" class="card">
        <h2 class="heading-3" style="margin-bottom:1rem;">Send Us a Message</h2>
        
        <?php if ($contactSuccess): ?>
          <div style="background:#dcfce7; border:1px solid #bbf7d0; color:#15803d; padding:1.25rem; border-radius:12px; margin-bottom:1.5rem;">
            <strong style="display:block; margin-bottom:4px;">Thank you! Your message has been received.</strong>
            Our customer care team has registered your query and will reply via email within 24 business hours.
          </div>
        <?php elseif ($contactError): ?>
          <div style="background:#fee2e2; border:1px solid #fecaca; color:#b91c1c; padding:12px; border-radius:8px; margin-bottom:1.5rem;">
            <?= htmlspecialchars($contactError) ?>
          </div>
        <?php endif; ?>

        <form method="POST">
          <input type="hidden" name="action" value="contact">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(getCsrfToken()) ?>">

          <div class="form-group">
            <label class="form-label">Your Name <span style="color:#ef4444;">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Ramesh Sharma" required>
          </div>

          <div class="grid grid-cols-2" style="gap:1rem;">
            <div class="form-group">
              <label class="form-label">Email Address <span style="color:#ef4444;">*</span></label>
              <input type="email" name="email" class="form-control" placeholder="ramesh@example.com" required>
            </div>
            <div class="form-group">
              <label class="form-label">Phone Number</label>
              <input type="tel" name="phone" class="form-control" placeholder="9876543210" maxlength="10">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Subject</label>
            <select name="subject" class="form-control">
              <option value="Application Inquiry">Loan Discovery / Application Status</option>
              <option value="Lender Query">Question About Partner Lenders</option>
              <option value="Technical Issue">Website Feedback / Technical Issue</option>
              <option value="Grievance">Grievance or Dispute Escalation</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label">Message Details <span style="color:#ef4444;">*</span></label>
            <textarea name="message" class="form-control" rows="4" placeholder="How can our support team assist you today?" required></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-block">
            Submit Support Inquiry &rarr;
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
