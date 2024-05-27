<?php

function unified_search_platform_setup() {
    add_theme_support('title-tag');
}


add_action('after_setup_theme',
'unified_search_platform_setup');


function my_theme_enqueue_styles() {
    wp_enqueue_style('tailwindcss', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css', [], null);
    wp_enqueue_style('my-theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
    wp_enqueue_style('base1', get_template_directory_uri() . '/assets/css/base1.css', array(), '1.0.0', 'all');
    wp_enqueue_style('base2', get_template_directory_uri() . '/assets/css/base2.css', array(), '1.0.0', 'all');
    wp_enqueue_style('base3', get_template_directory_uri() . '/assets/css/base3.css', array(), '1.0.0', 'all');

}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function register_my_menus() {
    register_nav_menus(
        array(
            'home-menu' => __('Home Menu'),
            'contact-us-menu' => __('Contact Us Menu'),
            'unified-search-menu' => __('Unified Search Menu') // New menu
        )
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
add_action('init', 'register_my_menus');

require get_template_directory() . '/enqueues.php';
require get_template_directory() . '/init.php';

