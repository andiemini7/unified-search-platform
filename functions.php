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


//ACF

add_action('init','acf_theme_support');


//API 

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/team-members', array(
        'methods' => 'GET',
        'callback' => 'get_team_members',
    ));
});

function get_team_members() {
    $args = array(
        'post_type' => 'team-member',
    );

    $team_members = new WP_Query($args);
    $data = array();

    if ($team_members->have_posts()) {
        while ($team_members->have_posts()) {
            $team_members->the_post();
            
            $locations = get_field('locations');
            $location_names = array();
            if ($locations) {
                foreach ($locations as $location) {
                    $location_names[] = $location->post_title;
                }
            }

            $data[] = array(
                'title' => get_the_title(),
                'locations' => $location_names,
            );
        }
        wp_reset_postdata();
    }

    return new WP_REST_Response($data, 200);
}

require get_template_directory() . '/enqueues.php';
require get_template_directory() . '/init.php';

