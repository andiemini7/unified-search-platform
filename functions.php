<?php

function unified_search_platform_setup() {
    add_theme_support('title-tag');
}

add_action('after_setup_theme',
'unified_search_platform_setup');


function my_theme_enqueue_styles() {
    wp_enqueue_style('tailwindcss', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css', [], null);
    wp_enqueue_style('my-theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
