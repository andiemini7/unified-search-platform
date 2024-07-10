<?php
require get_template_directory() . '/vendor/autoload.php';
require_once get_template_directory() . '/includes/employee-registration.php';
require_once get_template_directory() . '/includes/employee-login.php';
require get_template_directory() . '/includes/init.php';
require_once get_template_directory() . '/includes/manage-pending-users.php';
require get_template_directory() .'/app/acf/acf.php';

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

function redirect_if_not_logged_in() {
    if (!is_user_logged_in()) {
        if (!is_page('signin') && !is_page('register')) {
            wp_redirect(home_url('/signin'));
            exit();
        }
    } else {
        $user = wp_get_current_user();
        if (in_array('pending', (array) $user->roles)) {
            wp_logout();
            wp_redirect(home_url('/signin'));
            exit();
        }

        if (is_page('signin') || is_page('register')) {
            wp_redirect(home_url('/homepage'));
            exit();
        }
    }
}
add_action('template_redirect', 'redirect_if_not_logged_in');

function add_pending_user_role() {
    add_role('pending', 'Pending', array(
        'read' => false,
        'edit_posts' => false,
        'delete_posts' => false,
    ));
}
add_action('init', 'add_pending_user_role');


function handle_autosuggest() {
    if (ob_get_length()) ob_clean();

    $search_term = sanitize_text_field($_GET['term']); 
    $args = array(
        's' => $search_term,
        'post_type' => array('post', 'page','documentation','members','teams','projects'), 
        'posts_per_page' => 10, 
    );

    $query = new WP_Query($args);
    $suggestions = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $suggestions[] = array(
                'title' => get_the_title(),
                'link' => get_permalink(),
            );
        }
    }

    wp_reset_postdata();
    wp_send_json_success($suggestions);
    wp_die();
}
