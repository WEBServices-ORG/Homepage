<?php
/**
 * WEBServices Theme Functions
 *
 * @package WEBServices
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme setup
 */
function webservices_theme_setup() {
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'webservices_theme_setup');

/**
 * Enqueue theme styles
 */
function webservices_enqueue_styles() {
    wp_enqueue_style('webservices-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'webservices_enqueue_styles');

/**
 * Register theme customizer settings
 */
function webservices_customize_register($wp_customize) {
    // Site tagline section
    $wp_customize->add_section('webservices_hero', array(
        'title'    => __('Hero Section', 'webservices'),
        'priority' => 30,
    ));
    
    // Tagline setting
    $wp_customize->add_setting('webservices_tagline', array(
        'default'           => 'Building Next-Generation Digital Solutions',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('webservices_tagline', array(
        'label'   => __('Tagline', 'webservices'),
        'section' => 'webservices_hero',
        'type'    => 'text',
    ));
    
    // Domain display setting
    $wp_customize->add_setting('webservices_domain', array(
        'default'           => 'webservicesdev.com',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('webservices_domain', array(
        'label'   => __('Domain Display', 'webservices'),
        'section' => 'webservices_hero',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'webservices_customize_register');

/**
 * Get theme customizer values with defaults
 */
function webservices_get_option($option_name) {
    $defaults = array(
        'webservices_tagline' => 'Building Next-Generation Digital Solutions',
        'webservices_domain'  => 'webservicesdev.com',
    );
    
    $default_value = isset($defaults[$option_name]) ? $defaults[$option_name] : '';
    
    return get_theme_mod($option_name, $default_value);
}
