# Next-Generation Fintech Platform (PHP) - Architecture & Implementation Plan

## 1. Executive Summary & Brand Identity
- **Platform Name**: **Paisa in Minutes** (Centralized configuration in `config/app.php`)
- **Category**: Consumer Personal Loan Discovery & Eligibility Platform (India)
- **Currency & Limits**: INR (₹), Minimum ₹10,000, Maximum ₹1,00,000
- **Technology Stack**: Modern PHP 8.2 backend, Vanilla CSS with custom Design System tokens inspired by the reference site (`Milestone`), Vanilla JavaScript (zero bloated dependencies), SQLite for ACID-compliant lead storage and analytics persistence, CSRF security, rate-limiting, and modular includes (`header.php`, `footer.php`, `navbar.php`).

## 2. Directory Structure
```
Demo web/
├── config/
│   ├── app.php                # Centralized business, brand, partner, and analytics config
│   └── database.php           # SQLite database connection & lead table schema initialization
├── includes/
│   ├── header.php             # Unified HTML <head>, SEO meta tags, OpenGraph, JSON-LD, Stylesheets
│   ├── navbar.php             # Responsive top navigation with animated menu drawer & CTA
│   ├── footer.php             # Comprehensive footer with legal disclosures, RBI compliance notes, sitemap links
│   ├── analytics.php          # GA4 and Meta Pixel consent-aware event tracking scripts
│   ├── cookie-consent.php     # RBI/DPDP-compliant privacy consent notice
│   └── helpers.php            # Security sanitizers, CSRF generators, currency formatters, rate-limiter
├── assets/
│   ├── css/
│   │   ├── design-system.css  # Design tokens: palette, typography, radii, shadows, animations, grid
│   │   ├── components.css     # Buttons, cards, badges, sliders, pill toggles, modals, tickers
│   │   └── pages.css          # Page-specific layouts (hero, calculator, multi-step eligibility)
│   ├── js/
│   │   ├── main.js            # Navigation toggle, ticker animation, micro-interactions, modal management
│   │   ├── calculator.js      # Reducing-balance EMI math, visual breakdown SVG chart, 2-way sync
│   │   ├── eligibility.js     # 4-step interactive mobile-first application wizard with real-time validation
│   │   └── analytics.js       # Event dispatcher for GA4 and Meta Pixel (calculator, form_start, lead)
│   └── images/
│       ├── logo.svg           # Vector brand logo with fintech mark
│       └── illustrations/     # Crisp, lightweight SVG vector illustrations matching reference style
├── api/
│   ├── submit-lead.php        # Validated endpoint for lead capture, duplicate check, SQLite save, webhook
│   └── calculate.php          # Server-side EMI validation and calculation API
├── admin/
│   └── leads.php              # Secure passcode-protected lead review and export dashboard
├── data/                      # SQLite database folder (auto-created with .htaccess protection)
├── index.php                  # Homepage (Hero with dual CTAs, live slider preview, trust badges, process, FAQs)
├── personal-loan-calculator.php # Dedicated deep-dive EMI calculator with amortization table and shareable link
├── check-eligibility.php      # Mobile-first 4-step qualified loan eligibility journey
├── offers.php                 # Approved partner offers cards with verified disclosures
├── how-it-works.php           # Transparent 3-step digital lending process
├── about.php                  # Platform mission, leadership, lender relationship notice
├── contact.php                # Support contacts, grievance officers, interactive query form
├── faq.php                    # Searchable financial literacy FAQs with accordion
├── blog.php                   # Educational financial literacy hub
├── blog-post.php              # Dynamic educational guide article
├── privacy-policy.php         # Digital Personal Data Protection (DPDP) Act 2023 compliant policy
├── terms-and-conditions.php   # User terms and loan aggregation disclaimer
├── loan-disclosures.php       # RBI Digital Lending Guidelines & Key Fact Statement (KFS) disclosures
├── grievance-redressal.php    # Grievance redressal matrix, Nodal Officer contact, RBI Sachet portal
├── 404.php                    # Friendly custom 404 error page
├── sitemap.xml                # Dynamic XML sitemap
├── robots.txt                 # SEO crawler instructions
└── .env.example               # Safe environment variable template
```

## 3. Reference Visual & Behavioral Design Mapping
Inspired by [https://shivams-fantabulous-site-435a78.webflow.io/](https://shivams-fantabulous-site-435a78.webflow.io/):
- **Hero & Composition**: Bold, punchy headlines (`Get approved upfront`), smooth sliding micro-tickers, organic badges (`100% Digital`, `RBI-Compliant Lenders`, `Instant Decision`), and warm yellow/coral accent button transitions.
- **Color Scheme**: Deep Navy (`#0C1631`), Slate Royal Accent (`#1E40AF` / `#2563EB`), Warm Light Background (`#F8F9FA` & `#F5F3EB`), Coral/Salmon highlight (`#F97316` / `#FB923C`), Butter Yellow pill badges (`#FEF08A` / `#ECE863`).
- **Interactive Loan Amount Slider**: Custom dual-state slider with thumb glow, synchronized input box, tick intervals, and instant monthly repayment breakdown.
- **Step-by-step Flow**: Connected line indicators, smooth card transitions, instant eligibility preview.

## 4. Security & Compliance
- Full adherence to RBI digital lending guidelines (platform as a Loan Service Provider / aggregator, transparent NBFC/Bank partners, no hidden loan charges, clear grievance officer).
- CSRF token validation on all POST requests.
- Strict client + server side regex validation for 10-digit Indian mobile numbers (`^[6-9]\d{9}$`), PAN formatting, and employment tiers.
- In-memory/SQLite rate limiting to prevent form abuse and spam bots.
- Complete UTM parameter tracking (`utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, `utm_term`, `gclid`, `fbclid`).
