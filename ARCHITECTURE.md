# System Architecture: Fintech Marketing Agency

## High-Level Architectural Overview

- **Platform Name**: **Fintech Marketing Agency**
- **Domain Focus**: Short-term personal loan discovery & financial education in India (Capped at ₹1,00,000 maximum).
- **Technology Stack**: Semantic HTML5, Vanilla CSS with custom Design System tokens, Vanilla JavaScript (zero bloated dependencies), client-side state management & offline-first localStorage support.

---

## Directory Structure

```text
├── index.html                 # Homepage (Hero with dual CTAs, live slider preview, trust badges, process, FAQs)
├── personal-loan-calculator.html # Dedicated deep-dive EMI calculator with amortization table and shareable link
├── check-eligibility.html     # Mobile-first 4-step qualified loan eligibility journey
├── offers.html                # Approved partner offers cards with verified disclosures
├── how-it-works.html          # Detailed visual step-by-step borrowing journey
├── about.html                 # Corporate details, CIN, LSP declaration
├── contact.html               # Contact channels & inquiry form
├── faq.html                   # Interactive FAQ accordions
├── blog.html                  # Educational guides directory
├── blog-post.html             # Article detail view with client-side slug reader
├── privacy-policy.html        # DPDP Act 2023 compliant data protection policy
├── terms-and-conditions.html  # Lending aggregator terms of use
├── loan-disclosures.html      # RBI Digital Lending Disclosures & Key Fact Statement (KFS)
├── grievance-redressal.html   # Nodal Officer escalation matrix & RBI Sachet portal link
├── 404.html                   # Custom error page
├── sitemap.xml                # SEO XML Sitemap
├── robots.txt                 # Search engine crawler policies
└── assets/
    ├── css/
    │   ├── design-system.css  # Typography, color tokens, CSS variables, resets
    │   ├── components.css     # Buttons, badges, tickers, cards, form inputs, wizard styles
    │   └── pages.css          # Page-specific responsive grid layouts
    └── js/
        ├── main.js            # Mobile navigation, accordions, cookie consent banner
        ├── calculator.js      # Reducing-balance EMI math, SVG donut chart, amortization table
        ├── eligibility.js     # 4-step wizard engine, validation, application reference generator
        └── analytics.js       # Unified GA4 and Meta Pixel consent-aware tracking bridge
```

---

## Core Capabilities

1. **Standalone Front-End Website**: No backend, database, or server installation needed. Runs directly in any browser or on any static hosting provider.
2. **Interactive Loan Calculator**: Full client-side math computing reducing-balance EMI and dynamic SVG donut chart.
3. **4-Step Eligibility Flow**: Fully responsive wizard with field format checks, review screen, and realistic application reference generation.
4. **Statutory Compliance**: Full adherence to RBI digital lending guidelines, representative APR disclosures, and DPDP cookie privacy banner.
