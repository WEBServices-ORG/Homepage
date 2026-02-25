<?php
/**
 * Main Template File
 *
 * @package WEBServices
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<header>
    <div class="container">
        <div class="brand-row">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/Icon.png'); ?>" alt="WEBServices icon" class="brand-icon">
            <h1>WEBServices</h1>
            <a class="org-link" href="https://github.com/WEBServices-ORG" target="_blank" rel="noopener noreferrer" aria-label="GitHub Organization">⌁</a>
        </div>
    </div>
</header>

<main class="container">
    <p class="hero">Open-source &amp; paid developer tools. Built lean.</p>

    <section class="primary-cta" aria-label="Primary call to action">
        <h2>Start Fast</h2>
        <p>Run your first deterministic setup, then activate your license when ready.</p>
        <div class="primary-cta-actions">
            <a class="cta-primary" href="https://github.com/WEBServices-ORG/homepage" target="_blank" rel="noopener noreferrer">Start Trial</a>
            <a class="cta-secondary" href="https://store.webservicesdev.com" target="_blank" rel="noopener noreferrer">Buy License</a>
        </div>
    </section>

    <section>
        <h2>Products</h2>
        <div class="products">
            <article class="product-card">
                <div class="product-header">
                    <h3>Coming Soon</h3>
                    <span class="badge">Open Source</span>
                </div>
                <p class="product-desc">Coming soon.</p>
                <div class="product-links">
                    <a href="https://github.com/WEBServices-ORG" target="_blank" rel="noopener noreferrer">GitHub</a>
                    <a href="https://github.com/WEBServices-ORG" target="_blank" rel="noopener noreferrer">Docs</a>
                </div>
            </article>
        </div>
    </section>

    <section>
        <h2>Support</h2>
        <div class="support-row" aria-label="Support links">
            <a class="support-icon" href="https://buymeacoffee.com/webservices" target="_blank" rel="noopener noreferrer" aria-label="Buy Me a Coffee">☕</a>
            <a class="support-icon" href="https://ko-fi.com/webservices" target="_blank" rel="noopener noreferrer" aria-label="Ko-fi">K</a>
            <a class="support-icon" href="https://paypal.me/webservicesdev" target="_blank" rel="noopener noreferrer" aria-label="PayPal">P</a>
            <a class="support-icon" href="https://store.webservicesdev.com" target="_blank" rel="noopener noreferrer" aria-label="Lemon Squeezy">L</a>
            <a class="support-icon" href="https://github.com/WEBServices-ORG" target="_blank" rel="noopener noreferrer" aria-label="GitHub">G</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
