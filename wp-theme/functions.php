<?php
/**
 * WEBServices Theme Functions
 *
 * @package WEBServices
 * @since 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function webservices_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'webservices_theme_setup');

/**
 * Enqueue theme styles
 */
function webservices_enqueue_styles() {
    wp_enqueue_style('webservices-style', get_stylesheet_uri(), array(), '1.2.0');
}
add_action('wp_enqueue_scripts', 'webservices_enqueue_styles');

/**
 * Add baseline SEO metadata for front-facing pages.
 */
function webservices_output_meta_tags() {
    $canonical = is_front_page() ? home_url('/') : home_url(add_query_arg(array(), $GLOBALS['wp']->request));
    ?>
    <meta name="description" content="WEBServices builds deterministic macOS SwiftUI tooling and products for solo developers and small studios.">
    <link rel="canonical" href="<?php echo esc_url(trailingslashit($canonical)); ?>">
    <meta name="theme-color" content="#0b0b0b">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta property="og:description" content="Deterministic macOS SwiftUI tooling and products.">
    <meta property="og:url" content="<?php echo esc_url(trailingslashit($canonical)); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/Icon.png'); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <meta name="twitter:description" content="Deterministic macOS SwiftUI tooling and products.">
    <meta name="twitter:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/Icon.png'); ?>">
    <?php
}
add_action('wp_head', 'webservices_output_meta_tags', 1);
