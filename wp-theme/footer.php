<?php
/**
 * Footer Template
 *
 * @package WEBServices
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<footer>
    <div class="container">
        <p>
            <a href="https://github.com/WEBServices-ORG" class="github-link" target="_blank">
                Explore Our Open Source Projects
            </a>
        </p>
        <p style="margin-top: 20px;">
            <?php bloginfo('name'); ?> &copy; <?php echo date('Y'); ?> | 
            <a href="<?php echo esc_url(home_url('/')); ?>" class="github-link">
                <?php echo esc_html(webservices_get_option('webservices_domain')); ?>
            </a>
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
