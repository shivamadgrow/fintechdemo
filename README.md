# Paisa in Minutes – Fintech Personal Loan Discovery Website (HTML & Vanilla JS)

A high-performance, modern consumer fintech website for personal loan discovery and eligibility education in India, built purely in **Semantic HTML5**, **Vanilla CSS (Custom Design System)**, and **Vanilla JavaScript** inspired by modern fintech aesthetics.

---

## 🌟 Key Architecture & Highlights

1. **Pure Front-End Architecture (Zero Backend / Server Overhead)**:
   - Zero framework overhead, zero node/build tool friction, zero PHP/database requirements.
   - 100% static: opens directly in any browser and deploys seamlessly on **GitHub Pages**, **Netlify**, **Vercel**, **Cloudflare Pages**, or Apache/Nginx.
   - Clean semantic markup with rich OpenGraph meta tags, Twitter Cards, and Schema.org JSON-LD structured data.

2. **Design Aesthetics**:
   - **Deep Navy & Royal Blue**: High-contrast, trustworthy palette (`#0B1536`, `#2563EB`).
   - **Butter Yellow & Salmon Accents**: Modern pill buttons, moon badges (`#ECE863`, `#F4BEA9`).
   - **Continuous Horizontal Tickers**: SVG-icon tickers for smooth visual marquees.
   - **Sculpted Radii & Layered Shadows**: 24px rounded cards, pill toggles, and micro-animations.

3. **Product Constraints & Personal Loans Focus**:
   - Market: India | Currency: INR (₹).
   - Maximum loan discovery limit strictly capped at **₹1,00,000** (range: ₹10,000 to ₹1,00,000).
   - Only personal loans—no home, auto, or business loans advertised.

4. **Reducing-Balance EMI Calculator (`personal-loan-calculator.html`)**:
   - Formula: `EMI = [P × r × (1 + r)^n] / [(1 + r)^n - 1]`.
   - Real-time 2-way synchronized range slider and numeric inputs.
   - Visual SVG Donut Chart dynamically rendering Principal vs. Interest percentage breakdown.
   - Complete month-by-month Amortization Schedule table.
   - Shareable loan scenario URL generator (`?amount=50000&tenure=12&rate=14.5`).

5. **Mobile-First 4-Step Eligibility Wizard (`check-eligibility.html`)**:
   - Step 1: Basic Information (Full Name, 10-digit Indian Mobile `^[6-9]\d{9}$`, Terms Consent).
   - Step 2: Financial Profile (Employment Type, Net Monthly Income, City, PIN code, Loan Amount Slider).
   - Step 3: Additional Details & KYC Pre-check (Loan Purpose, Masked PAN `[A-Z]{5}[0-9]{4}[A-Z]{1}`).
   - Step 4: Editable Review Summary with live jump shortcuts to edit fields before submitting.
   - Client-side validation with instant verification feedback, `localStorage` persistence, and verified Application Reference ID (e.g. `PIM-2610-847291`).

6. **RBI Digital Lending Guidelines Compliance**:
   - Clear statutory declaration as a **Lending Service Provider (LSP)** / loan aggregator.
   - Mandatory Key Fact Statement (KFS) representative example disclosure.
   - Principal Nodal Grievance Redressal Officer contact and RBI Sachet portal escalation link.
   - DPDP Act 2023 compliant cookie & privacy consent banner.

7. **Marketing & Conversion Tracking**:
   - Consent-aware GA4 & Meta Pixel integration (`assets/js/analytics.js`).
   - Outbound partner click tracking and UTM attribution persistence.

---

## 📁 Directory Layout

```text
├── index.html                 # Homepage with hero slider, ticker, how it works, partner cards
├── personal-loan-calculator.html # Dedicated deep-dive EMI calculator with amortization table
├── check-eligibility.html     # 4-step mobile-first qualified eligibility journey
├── offers.html                # Approved lending partner offers directory
├── how-it-works.html          # Detailed 3-step digital journey guide
├── about.html                 # Company mission and regulatory LSP role
├── contact.html               # Support channels & interactive inquiry form
├── faq.html                   # Searchable financial literacy FAQs with accordion
├── blog.html                  # Financial literacy guides directory
├── blog-post.html             # Deep-dive educational article reader
├── privacy-policy.html        # DPDP Act 2023 compliant privacy policy
├── terms-and-conditions.html  # User terms and loan aggregator disclaimers
├── loan-disclosures.html      # RBI Digital Lending Disclosures & KFS
├── grievance-redressal.html   # Grievance Redressal matrix and Nodal Officer contact
├── 404.html                   # Custom 404 error page
├── sitemap.xml                # Search engine XML sitemap
├── robots.txt                 # Search bot crawling rules
└── assets/
    ├── css/
    │   ├── design-system.css  # Typography, colors, spacing tokens
    │   ├── components.css     # Buttons, cards, badges, tickers, accordions
    │   └── pages.css          # Page-specific layout rules
    └── js/
        ├── main.js            # Mobile drawer, FAQ accordions, cookie banner
        ├── calculator.js      # EMI reducing-balance math & SVG donut chart
        ├── eligibility.js     # 4-step wizard validation & client submission
        └── analytics.js       # GA4 & Meta Pixel consent-aware dispatcher
```

---

## 🚀 Running Locally

Simply open `index.html` in any modern web browser or serve via any static web server:

```powershell
# Python built-in static server
python -m http.server 8000

# Or Node.js serve / npx
npx serve .
```
Visit `http://localhost:8000` in your browser.
