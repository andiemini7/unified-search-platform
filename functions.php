<?php

require get_template_directory() . '/includes/init.php';


// API Endpoint
function custom_search_endpoint() {
    register_rest_route('wp/v1', '/search', array(
        'methods'  => 'GET',
        'callback' => 'custom_search_callback',
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
add_action('rest_api_init', 'custom_search_endpoint');

function custom_search_callback($data) {
    $search_query = sanitize_text_field($data['s']);
    $paged = isset($data['page']) ? intval($data['page']) : 1;
    $posts_per_page = get_option('posts_per_page');

    $args = array(
        's' => $search_query,
        'paged' => $paged,
        'posts_per_page' => $posts_per_page,
    );

    $query = new WP_Query($args);
    $posts = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_thumbnail_url = get_the_post_thumbnail_url();
            $content = wp_trim_words(get_the_content(), 15, null);
            $author_name = ucfirst(get_the_author());
            $category = get_the_category();
            $category_name = $category ? get_cat_name($category[0]->term_id) : '';

            $posts[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_the_permalink(),
                'thumbnail' => $post_thumbnail_url,
                'excerpt' => $content,
                'author' => $author_name,
                'category' => $category_name,
            );
        }
    }

    wp_reset_postdata();
    return new WP_REST_Response($posts, 200);
}

