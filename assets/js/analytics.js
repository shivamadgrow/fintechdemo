/**
 * Paisa in Minutes - Unified Conversion & Marketing Analytics Bridge
 * Consent-aware dispatcher for Google Analytics 4 (GA4) and Meta Pixel
 * Strict financial privacy: Zero transmission of PAN, phone numbers or bank credentials
 */

(function () {
  'use strict';

  class AnalyticsManager {
    constructor() {
      this.hasConsent = this.checkConsent();
      this.ga4Id = window.PIM_ANALYTICS_CONFIG?.ga4Id || null;
      this.pixelId = window.PIM_ANALYTICS_CONFIG?.pixelId || null;
      this.initOutboundTracking();
    }

    checkConsent() {
      const consent = localStorage.getItem('pim_cookie_consent');
      return consent === 'accepted';
    }

    setConsent(status) {
      this.hasConsent = status;
      if (status) {
        this.trackEvent('consent_update', { analytics_storage: 'granted' });
      }
    }

    /**
     * Track unified events
     */
    trackEvent(eventName, params = {}) {
      if (!this.hasConsent && eventName !== 'consent_update') {
        // Suppress non-essential marketing events until user provides consent
        return;
      }

      // 1. Google Analytics 4 Dispatcher
      if (typeof window.gtag === 'function') {
        window.gtag('event', eventName, params);
      }

      // 2. Meta Pixel Dispatcher
      if (typeof window.fbq === 'function') {
        switch (eventName) {
          case 'page_view':
            window.fbq('track', 'PageView');
            break;
          case 'generate_lead':
            window.fbq('track', 'Lead', {
              value: params.value || 0,
              currency: 'INR',
              content_name: 'Personal Loan Lead',
            });
            break;
          case 'form_start':
            window.fbq('trackCustom', 'FormStart', params);
            break;
          case 'calculator_interaction':
            window.fbq('trackCustom', 'CalculatorInteraction', params);
            break;
          case 'application_click':
            window.fbq('trackCustom', 'PartnerClick', params);
            break;
          default:
            window.fbq('trackCustom', eventName, params);
        }
      }

      // Debugging log in development
      if (window.PIM_ANALYTICS_CONFIG?.debug) {
        console.log(`[Analytics] Tracked ${eventName}:`, params);
      }
    }

    trackCalculator(amount, tenure, rate) {
      this.trackEvent('calculator_interaction', {
        loan_amount: amount,
        tenure_months: tenure,
        interest_rate: rate,
      });
    }

    initOutboundTracking() {
      document.addEventListener('click', (e) => {
        const partnerLink = e.target.closest('[data-partner-outbound]');
        if (partnerLink) {
          const partnerId = partnerLink.getAttribute('data-partner-outbound');
          const partnerName = partnerLink.getAttribute('data-partner-name') || partnerId;
          this.trackEvent('application_click', {
            partner_id: partnerId,
            partner_name: partnerName,
          });
        }
      });
    }
  }

  window.PIMAnalytics = new AnalyticsManager();
})();
