<?php
/**
 * Paisa in Minutes - Global Header Include
 * Provides semantic HTML <head>, SEO meta tags, OpenGraph, JSON-LD, stylesheets and analytics hooks.
 */

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
$config = require __DIR__ . '/../config/app.php';

// Capture UTM parameters seamlessly
$attribution = captureAttribution();

// Page-specific overrides or defaults
$pageTitle = ($pageTitle ?? 'Instant Personal Loan Discovery & Eligibility') . ' | ' . $config['app']['name'];
$pageDescription = $pageDescription ?? 'Discover verified personal loans up to ₹1,00,000 from RBI-regulated lending partners in India. Transparent interest rates, zero hidden charges, and instant digital eligibility check.';
$canonicalUrl = $canonicalUrl ?? ($config['app']['url'] . ($_SERVER['REQUEST_URI'] ?? '/'));
$ogImage = $ogImage ?? ($config['app']['url'] . '/assets/images/og-preview.png');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Primary SEO Meta Tags -->
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <meta name="theme-color" content="#0b1536">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
  <meta property="og:site_name" content="<?= htmlspecialchars($config['app']['name']) ?>">
  <meta property="og:locale" content="en_IN">

  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="assets/css/design-system.css?v=<?= $config['app']['version'] ?>">
  <link rel="stylesheet" href="assets/css/components.css?v=<?= $config['app']['version'] ?>">
  <link rel="stylesheet" href="assets/css/pages.css?v=<?= $config['app']['version'] ?>">

  <!-- Schema.org JSON-LD Structured Data for Financial Platform & Lending Service -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "Organization",
        "@id": "<?= $config['app']['url'] ?>/#organization",
        "name": "<?= htmlspecialchars($config['company']['legal_name']) ?>",
        "alternateName": "<?= htmlspecialchars($config['app']['name']) ?>",
        "url": "<?= $config['app']['url'] ?>",
        "telephone": "<?= htmlspecialchars($config['company']['phone']) ?>",
        "email": "<?= htmlspecialchars($config['company']['email']) ?>",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Tower B, 4th Floor, FinTech Park, Cyber City",
          "addressLocality": "Gurugram",
          "addressRegion": "Haryana",
          "postalCode": "122002",
          "addressCountry": "IN"
        }
      },
      {
        "@type": "FinancialProduct",
        "name": "Paisa in Minutes Personal Loan Discovery",
        "description": "Short-term personal loan discovery service up to ₹1,00,000 with flexible tenures of 3 to 24 months.",
        "provider": {
          "@id": "<?= $config['app']['url'] ?>/#organization"
        },
        "annualPercentageRate": {
          "@type": "QuantitativeValue",
          "minValue": <?= $config['loan']['min_apr'] ?>,
          "maxValue": <?= $config['loan']['max_apr'] ?>,
          "unitText": "PERCENT"
        },
        "amount": {
          "@type": "MonetaryAmount",
          "currency": "INR",
          "minValue": <?= $config['loan']['min_amount'] ?>,
          "maxValue": <?= $config['loan']['max_amount'] ?>
        }
      }
    ]
  }
  </script>

  <!-- Client-Side Analytics Configuration -->
  <script>
    window.PIM_ANALYTICS_CONFIG = {
      ga4Id: <?= json_encode($config['analytics']['ga4_measurement_id']) ?>,
      pixelId: <?= json_encode($config['analytics']['meta_pixel_id']) ?>,
      debug: <?= json_encode($config['app']['debug']) ?>,
    };
  </script>
</head>
<body>
<?php require __DIR__ . '/navbar.php'; ?>
<main id="mainContent">
