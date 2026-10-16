/**
 * Paisa in Minutes - Main UI Interactions
 * Navigation, Accordions, Cookie Consent & Utilities
 */

document.addEventListener('DOMContentLoaded', () => {
  initMobileNavigation();
  initFaqAccordions();
  initCookieConsent();
  initSmoothScroll();
});

/**
 * Mobile Navigation Menu
 */
function initMobileNavigation() {
  const toggleBtn = document.getElementById('navToggleBtn');
  const navLinks = document.getElementById('navLinks');

  if (!toggleBtn || !navLinks) return;

  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = navLinks.classList.toggle('open');
    toggleBtn.setAttribute('aria-expanded', isOpen);
    toggleBtn.innerHTML = isOpen ? '&times;' : '&#9776;';
  });

  // Close when clicking outside
  document.addEventListener('click', (e) => {
    if (navLinks.classList.contains('open') && !navLinks.contains(e.target) && e.target !== toggleBtn) {
      navLinks.classList.remove('open');
      toggleBtn.setAttribute('aria-expanded', 'false');
      toggleBtn.innerHTML = '&#9776;';
    }
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && navLinks.classList.contains('open')) {
      navLinks.classList.remove('open');
      toggleBtn.setAttribute('aria-expanded', 'false');
      toggleBtn.innerHTML = '&#9776;';
      toggleBtn.focus();
    }
  });
}

/**
 * FAQ Accordion Panels
 */
function initFaqAccordions() {
  const accordionHeaders = document.querySelectorAll('.accordion-header');

  accordionHeaders.forEach((header) => {
    header.addEventListener('click', () => {
      const item = header.closest('.accordion-item');
      const body = item.querySelector('.accordion-body');
      const isOpen = item.classList.contains('open');

      // Close other accordions in the same container for clean UX
      const parent = item.closest('.accordion');
      if (parent) {
        parent.querySelectorAll('.accordion-item.open').forEach((openItem) => {
          if (openItem !== item) {
            openItem.classList.remove('open');
            const openBody = openItem.querySelector('.accordion-body');
            if (openBody) openBody.style.maxHeight = null;
          }
        });
      }

      if (isOpen) {
        item.classList.remove('open');
        body.style.maxHeight = null;
      } else {
        item.classList.add('open');
        body.style.maxHeight = body.scrollHeight + 32 + 'px';
      }
    });
  });
}

/**
 * Cookie & Privacy Consent Banner (DPDP Act & RBI Compliance)
 */
function initCookieConsent() {
  const consentBanner = document.getElementById('cookieConsentBanner');
  if (!consentBanner) return;

  const consentGiven = localStorage.getItem('pim_cookie_consent');
  if (!consentGiven) {
    consentBanner.style.display = 'block';
  }

  const acceptBtn = document.getElementById('acceptCookieBtn');
  const declineBtn = document.getElementById('declineCookieBtn');

  if (acceptBtn) {
    acceptBtn.addEventListener('click', () => {
      localStorage.setItem('pim_cookie_consent', 'accepted');
      consentBanner.style.display = 'none';
      if (window.PIMAnalytics) {
        window.PIMAnalytics.setConsent(true);
      }
    });
  }

  if (declineBtn) {
    declineBtn.addEventListener('click', () => {
      localStorage.setItem('pim_cookie_consent', 'declined');
      consentBanner.style.display = 'none';
      if (window.PIMAnalytics) {
        window.PIMAnalytics.setConsent(false);
      }
    });
  }
}

/**
 * Smooth anchor scrolling
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      const targetElem = document.querySelector(targetId);
      if (targetElem) {
        e.preventDefault();
        targetElem.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
}

/**
 * Format Indian currency string
 */
function formatINR(number) {
  const num = Math.round(number);
  return '₹' + num.toLocaleString('en-IN');
}
