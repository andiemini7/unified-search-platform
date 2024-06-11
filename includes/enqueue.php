<?php
function enqueueStyles() {
    wp_enqueue_style('tailwindcss', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css', [], null);
    wp_enqueue_style('theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
    wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', ['jquery'], null, true);
    wp_enqueue_script('navigation-script', get_template_directory_uri() . '/assets/js/navigation.js', ['jquery'], null, true);
    wp_enqueue_script('front-script', get_template_directory_uri() . '/assets/js/front.js', ['jquery'], null, true);

}
