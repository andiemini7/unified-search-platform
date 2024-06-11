<?php

namespace Hp\UnifiedSearchPlatform;

class Enqueue {

function enqueueStyles() {
    wp_enqueue_style('custom-tailwind', get_template_directory_uri() . '/assets/dist/css/style.css', array(), filemtime(get_template_directory() . '/assets/dist/css/style.css'));
    wp_enqueue_style('theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/parts/search.js', ['jquery'], null, true);

}

}



