<?php
// Theme setup
function unifiedsearch_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus([
        'home-menu' => __('Home Menu'),
        'contact-us-menu' => __('Contact Us Menu'),
        'unified-search-menu' => __('Unified Search Menu')
    ]);
    
}

function theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Add support for two custom navigation menus.
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'theme-textdomain'),
        'footer' => __('Footer Menu', 'theme-textdomain')
    ));
}
add_action('after_setup_theme', 'theme_setup');

