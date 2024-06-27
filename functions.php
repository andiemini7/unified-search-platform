<?php

require get_template_directory() . '/vendor/autoload.php';
require_once get_template_directory() . '/includes/employee-registration.php';
require_once get_template_directory() . '/includes/employee-login.php';
require get_template_directory() . '/includes/init.php';
require get_template_directory() . '/app/cpt/cpt-members.php';
require get_template_directory() . '/app/cpt/cpt-teams.php';


// API Endpoint
function custom_search_endpoints() {
    // Endpoint for fetching pages
    register_rest_route('wp/v1', '/pages', array(
        'methods'  => 'GET',
        'callback' => 'custom_search_pages_callback',
        'permission_callback' => '__return_true',
        'args'     => array(
            's' => array(
                'required' => true,
                'validate_callback' => function($param, $request, $key) {
                    return is_string($param);
                }
            ),
            'page' => array(
                'required' => false,
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            )
        ),
    ));

    // Endpoint for fetching posts
    register_rest_route('wp/v1', '/posts', array(
        'methods'  => 'GET',
        'callback' => 'custom_search_posts_callback',
        'permission_callback' => '__return_true',
        'args'     => array(
            's' => array(
                'required' => true,
                'validate_callback' => function($param, $request, $key) {
                    return is_string($param);
                }
            ),
            'page' => array(
                'required' => false,
                'validate_callback' => function($param, $request, $key) {
                    return is_numeric($param);
                }
            )
        ),
    ));
}
add_action('rest_api_init', 'custom_search_endpoints');

function custom_search_pages_callback($data) {
    return custom_search_callback($data, 'page');
}

function custom_search_posts_callback($data) {
    return custom_search_callback($data, 'post');
}

function custom_search_callback($data, $post_type) {
    $search_query = sanitize_text_field($data['s']);
    $paged = isset($data['page']) ? intval($data['page']) : 1;
    $posts_per_page = get_option('posts_per_page');

    $args = array(
        's' => $search_query,
        'paged' => $paged,
        'posts_per_page' => $posts_per_page,
        'post_type' => $post_type,
    );

    $query = new WP_Query($args);
    $results = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_type = get_post_type();
            $post_thumbnail_url = get_the_post_thumbnail_url();
            $content = wp_trim_words(get_the_content(), 15, null);
            $author_name = ucfirst(get_the_author());
            $category = get_the_category();
            $category_name = $category ? get_cat_name($category[0]->term_id) : '';

            $results[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_the_permalink(),
                'thumbnail' => $post_thumbnail_url,
                'excerpt' => $content,
                'author' => $author_name,
                'category' => $category_name,
                'post_type' => $post_type,
            );
        }
    }

    wp_reset_postdata();
    return new WP_REST_Response($results, 200);
}
// Add AJAX endpoint for checking if user is logged in
add_action('wp_ajax_check_logged_in', 'check_logged_in');
add_action('wp_ajax_nopriv_check_logged_in', 'check_logged_in'); // for non-logged-in users

function check_logged_in() {
    $response = array(
        'logged_in' => is_user_logged_in()
    );

    wp_send_json($response);
}

require get_template_directory() .'/app/acf/acf.php';
