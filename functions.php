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


// Endpoint
function my_custom_endpoint() {
    register_rest_route('myplugin/v1', '/pages', array(
        'methods' => 'GET',
        'callback' => 'custom_get_pages',
    ));
}
add_action('rest_api_init', 'my_custom_endpoint');


function custom_get_pages() {
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => 10, 
    );
    $query = new WP_Query($args);

    $pages = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $pages[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'description' => get_the_excerpt(),
            );
        }
        wp_reset_postdata();
    }

    return new WP_REST_Response($pages, 200);
}

require get_template_directory() . '/enqueues.php';
require get_template_directory() . '/init.php';

