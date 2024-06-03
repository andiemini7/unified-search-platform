<?php

require get_template_directory() . '/includes/init.php';


// See More Button
function enqueue_SeeMore_scripts()
{
    // Enqueue jQuery if not already included
    wp_enqueue_script('jquery');

    // Enqueue your custom JavaScript file
    wp_enqueue_script('see-more-js', get_template_directory_uri() . '/see-more.js', array('jquery'), null, true);

    // Localize script to pass parameters to JavaScript
    global $wp_query;
    wp_localize_script('see-more-js', 'custom_js_params', array(
        'found_posts' => $wp_query->found_posts
    ));
}
// add_action('wp_enqueue_scripts', 'enqueue_SeeMore_scripts');
