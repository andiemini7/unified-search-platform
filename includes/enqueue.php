<?php

function enqueueStyles() {
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/dist/styles.css', [], null);
    wp_enqueue_style('theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
    wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', ['jquery'], null, true);
    wp_enqueue_script('see-more', get_template_directory_uri() . '/see-more.js', array('jquery'), null, true);
}

