<?php
/**
 * Paisa in Minutes - Cookie & Privacy Consent Banner
 * Compliant with India's Digital Personal Data Protection (DPDP) Act 2023
 */
declare(strict_types=1);
?>
<aside id="cookieConsentBanner" style="display:none; position:fixed; bottom:20px; left:20px; right:20px; max-width:540px; margin:0 auto; z-index:9999; background:rgba(11,21,54,0.95); border:1px solid rgba(255,255,255,0.18); border-radius:18px; padding:1.25rem 1.5rem; backdrop-filter:blur(12px); box-shadow:0 20px 40px rgba(0,0,0,0.4); color:#fff;" role="dialog" aria-live="polite" aria-label="Privacy Consent Notice">
  <div style="display:flex; align-items:flex-start; gap:1rem;">
    <div style="font-size:1.5rem; line-height:1;">🍪</div>
    <div style="flex:1;">
      <h4 style="font-size:0.9375rem; font-weight:700; color:#fff; margin-bottom:0.35rem;">Privacy & Transparency Notice</h4>
      <p style="font-size:0.8125rem; color:#cbd5e1; line-height:1.5; margin-bottom:1rem;">
        We use essential cookies to maintain secure loan calculations and anonymous analytics to understand site usage under India's DPDP Act. We never sell your personal financial data.
      </p>
      <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
        <button type="button" id="acceptCookieBtn" class="btn btn-yellow btn-sm" style="font-size:0.8125rem; padding:0.4rem 1rem;">
          Accept All
        </button>
        <button type="button" id="declineCookieBtn" class="btn btn-outline-white btn-sm" style="font-size:0.8125rem; padding:0.4rem 1rem;">
          Essential Only
        </button>
        <a href="privacy-policy.php" style="color:#94a3b8; font-size:0.8125rem; align-self:center; text-decoration:underline;">Read Policy</a>
      </div>
    </div>
  </div>
</aside>
