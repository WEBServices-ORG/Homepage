<?php
/**
 * 404 Template
 *
 * @package WEBServices
 * @since 1.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main class="container">
    <section class="primary-cta" aria-label="404 message">
        <h1>404</h1>
        <p>The requested page was not found.</p>
        <div class="primary-cta-actions">
            <a class="cta-primary" href="<?php echo esc_url(home_url('/')); ?>">Back to homepage</a>
            <a class="cta-secondary" href="mailto:support@webservicesdev.com">Contact support</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
