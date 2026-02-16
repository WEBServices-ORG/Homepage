<?php
/**
 * Main Template File
 *
 * @package WEBServices
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();
?>

<header>
    <div class="container">
        <h1><?php bloginfo('name'); ?></h1>
        <p class="tagline"><?php echo esc_html(webservices_get_option('webservices_tagline')); ?></p>
        <p style="color: #667eea; font-size: 1.1rem; margin-bottom: 30px;">
            <?php echo esc_html(webservices_get_option('webservices_domain')); ?>
        </p>
        <div class="cta-buttons">
            <a href="https://github.com/WEBServices-ORG" class="btn btn-primary" target="_blank">View Our Work</a>
            <a href="mailto:contact@webservicesdev.com" class="btn btn-secondary">Contact Us</a>
        </div>
    </div>
</header>

<?php get_footer(); ?>
