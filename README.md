# Paisa in Minutes – Next-Generation Indian Fintech Platform (PHP)

> **Live Local Development Server**: `http://127.0.0.1:8000` (or configured via XAMPP Apache `htdocs`)

A production-ready consumer fintech platform for personal loan discovery and eligibility education in India, built purely in **Modern PHP 8.2**, **Vanilla CSS (Custom Design System)**, and **Vanilla JavaScript** inspired by the aesthetic, typography, and motion of the reference template ([Milestone](https://shivams-fantabulous-site-435a78.webflow.io/)).

---

## 🌟 Key Architecture & Highlights

1. **Pure PHP Architecture (`"website php pr hi banni hai mujhe"`)**:
   - Zero heavy framework overhead or build tool friction.
   - Built to run seamlessly on XAMPP, WAMP, LAMP, or any standard PHP 8.2+ hosting environment.
   - Modular architecture: `includes/header.php`, `includes/navbar.php`, `includes/footer.php`, `includes/helpers.php`.

2. **Milestone Design Aesthetics**:
   - **Deep Navy & Royal Blue**: High-contrast, trustworthy palette (`#0B1536`, `#2563EB`).
   - **Butter Yellow & Salmon Accents**: Playful, modern pill buttons, moon badges (`#ECE863`, `#F4BEA9`).
   - **Continuous Horizontal Tickers**: SVG-icon tickers replicating the reference site's smooth marquees.
   - **Sculpted Radii & Layered Shadows**: 24px rounded cards, pill-shaped toggles, subtle micro-motion.

3. **Product Constraints & Personal Loans Focus**:
   - Market: India | Currency: INR (₹).
   - Maximum loan discovery limit strictly capped at **₹1,00,000** (range: ₹10,000 to ₹1,00,000).
   - Only personal loans—no home, auto, or business loans advertised.

4. **Reducing-Balance EMI Calculator (`personal-loan-calculator.php`)**:
   - Formula: `EMI = [P × r × (1 + r)^n] / [(1 + r)^n - 1]`.
   - Real-time 2-way synchronized range slider and numeric inputs.
   - Visual SVG Donut Chart dynamically rendering Principal vs. Interest percentage breakdown.
   - Complete month-by-month Amortization Schedule table.
   - Shareable loan scenario URL generator (`?amount=50000&tenure=12&rate=14.5`).

5. **Mobile-First 4-Step Eligibility Wizard (`check-eligibility.php`)**:
   - Step 1: Basic Information (Full Name, 10-digit Indian Mobile `^[6-9]\d{9}$`, Terms Consent).
   - Step 2: Financial Profile (Employment Type, Net Monthly Income, City, PIN code, Loan Amount Slider).
   - Step 3: Additional Details & KYC Pre-check (Loan Purpose, Masked PAN `[A-Z]{5}[0-9]{4}[A-Z]{1}`).
   - Step 4: Editable Review Summary with live jump shortcuts to edit fields before submitting.
   - Real-time client & server validation with CSRF token verification and duplicate submission lockout.
   - Verified Success View presenting unique application reference ID (e.g. `PIM-2610-916309`).

6. **Lead Management & Admin Dashboard (`admin/leads.php`)**:
   - SQLite ACID-compliant persistence (`data/leads.sqlite`) with `.htaccess` direct web access blocking.
   - Passcode-protected admin console (`Admin@Paisa2026`).
   - Live lead search and 1-click CSV export.

7. **RBI Digital Lending Guidelines Compliance**:
   - Clear declaration as a **Lending Service Provider (LSP)** / aggregator.
   - Mandatory Key Fact Statement (KFS) representative example disclosure.
   - Principal Nodal Grievance Redressal Officer contact and RBI Sachet portal escalation link.
   - DPDP Act 2023 compliant cookie & privacy consent banner.

8. **Marketing & Conversion Tracking**:
   - Consent-aware GA4 & Meta Pixel integration (`assets/js/analytics.js`).
   - Outbound partner click tracking and UTM attribution persistence (`utm_source`, `utm_campaign`, `gclid`, `fbclid`).

---

## 📁 Directory Layout

```
Demo web/
├── config/
│   ├── app.php                # Centralized business, brand, partner and rate configuration
│   └── database.php           # SQLite connection & table schema initialization
├── includes/
│   ├── header.php             # Semantic <head>, SEO tags, OpenGraph, Schema.org JSON-LD
│   ├── navbar.php             # Responsive top navbar with mobile drawer
│   ├── footer.php             # Regulatory footer with KFS disclosures & sitemap
│   ├── cookie-consent.php     # DPDP Act privacy consent banner
│   └── helpers.php            # CSRF, XSS sanitizers, Indian currency formatting, EMI math
├── assets/
│   ├── css/
│   │   ├── design-system.css  # Typography, colors, spacing, 12-col grid
│   │   ├── components.css     # Buttons, cards, sliders, pills, marquees, accordions
│   │   └── pages.css          # Header, hero, calculator, eligibility, footer styles
│   └── js/
│       ├── main.js            # Mobile menu, accordion FAQ, smooth scrolling, cookies
│       ├── calculator.js      # Reducing-balance EMI math, SVG chart, amortization
│       ├── eligibility.js     # 4-step wizard validation, review, and API submission
│       └── analytics.js       # GA4 & Meta Pixel event dispatcher
├── api/
│   ├── submit-lead.php        # Validated endpoint for lead capture & SQLite insertion
│   └── calculate.php          # Server-side EMI calculation endpoint
├── admin/
│   └── leads.php              # Passcode-protected lead management & CSV export dashboard
├── data/
│   ├── .htaccess              # Security lock: denies direct web access to database
│   └── leads.sqlite           # SQLite database
├── tests/
│   └── test_lead_flow.php     # Automated CLI test suite
├── index.php                  # Homepage with hero slider, ticker, how it works, partner cards
├── personal-loan-calculator.php # Dedicated deep-dive EMI calculator with amortization table
├── check-eligibility.php      # 4-step mobile-first qualified eligibility journey
├── offers.php                 # Approved lending partner offers directory
├── how-it-works.php           # Detailed 3-step digital journey guide
├── about.php                  # Company mission and regulatory LSP role
├── contact.php                # Support channels & interactive inquiry form
├── faq.php                    # Searchable financial literacy FAQs with accordion
├── blog.php                   # Financial literacy guides directory
├── blog-post.php              # Deep-dive article view
├── privacy-policy.php         # DPDP Act 2023 compliant privacy policy
├── terms-and-conditions.php   # User terms and loan aggregator disclaimers
├── loan-disclosures.php       # RBI Digital Lending Disclosures & KFS
├── grievance-redressal.php    # Grievance Redressal matrix and Nodal Officer contact
├── 404.php                    # Custom 404 error page
├── sitemap.xml                # Dynamic XML sitemap
├── robots.txt                 # Search engine crawler directives
└── .env.example               # Environment variable template
```

---

## 🚀 Running Locally

The PHP server is currently running on `http://127.0.0.1:8000`.

To start it manually at any time using XAMPP PHP:
```powershell
& "C:\xampp\php\php.exe" -S 127.0.0.1:8000
```
Then visit `http://127.0.0.1:8000` in your web browser.

To run the automated verification test suite:
```powershell
& "C:\xampp\php\php.exe" tests/test_lead_flow.php
```

Admin console credentials:
- URL: `http://127.0.0.1:8000/admin/leads.php`
- Passcode: `Admin@Paisa2026`
