<?php

function enqueueStyles() {
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/dist/styles.css', [], null);
    wp_enqueue_style('theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
    wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', ['jquery'], null, true);
}

