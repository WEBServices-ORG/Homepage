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
    wp_enqueue_style('webservices-style', get_stylesheet_uri(), array(), '1.1.0');
}
add_action('wp_enqueue_scripts', 'webservices_enqueue_styles');
