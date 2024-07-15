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



add_action('wp_ajax_get_team_details', 'get_team_details');
add_action('wp_ajax_nopriv_get_team_details', 'get_team_details');

function get_team_details() {
    
    $team_id = intval($_POST['team_id']);
    $team_post = get_post($team_id);

    if ($team_post) {
        $team_image = get_field('team_image', $team_id); 
        $team_name = get_the_title($team_id);
        $team_members = get_field('select_members', $team_id);
        $team_description = get_field('description', $team_id);
        $projects = get_field('project', $team_id);
        $team_leader = get_field('team_leader', $team_id);

       
        $num_members = $team_members ? count($team_members) : 0;

       
        $response .= '<div class="bg-white rounded-md p-4">';
if ($team_image) {
    $response .= '<img src="' . esc_url($team_image['url']) . '" alt="' . esc_attr($team_image['alt']) . '" class="w-full h-48 object-cover mt-3 mb-6 rounded-lg">';
}
$response .= '<h2 class="text-2xl font-bold text-gray-800 mb-4">' . esc_html($team_name) . '</h2>';
$response .= '<p class="text-gray-800 mb-2"><strong>Description:</strong></p>';
$response .= '<p class="text-gray-700 mb-4">' . esc_html($team_description) . '</p>';
$response .= '<p class="text-gray-800 mb-2"><strong>Active members:</strong></p>';
$response .= '<p class="text-gray-700 mb-6">' . esc_html($num_members) . ' members</p>';

if ($projects) {
    $response .= '<h3 class=" font-bold text-gray-800 mb-2">Current projects</h3>';
    $response .= '<div class="flex flex-wrap gap-2 mb-4">';
    foreach ($projects as $project) {
        $response .= '<span class="shadow bg-white text-gray-800 px-3  py-2 rounded-lg shadow-md">' . esc_html(get_the_title($project->ID)) . '</span>';
    }
    $response .= '</div>';
}

if ($team_leader) {
    $leader_name = get_the_title($team_leader->ID);
    $leader_email = get_field('email', $team_leader->ID);
    $leader_image = get_field('leader_image_', $team_leader->ID);


$response .= '<div class="flex items-center bg-gray-300 p-4 rounded-lg mt-6 overflow-hidden">';
if ($leader_image) {
    $response .= '<img src="' . esc_url($leader_image['url']) . '" class="w-16 h-16 rounded-full mr-4" alt="' . esc_attr($leader_image['alt']) . '">';
} else {
    $response .= '<img src="' . esc_url(get_avatar_url($team_leader->ID)) . '" class="w-16 h-16 rounded-lg mr-4 text-sm" alt="Leader">';
}
$response .= '<div class="flex-1">';
$response .= '<p class="font-bold text-gray-800">' . esc_html($leader_name) . '</p>';
$response .= '<p class="text-gray-700 text-sm">' . esc_html($leader_email) . '</p>';
$response .= '</div>';
$response .= '<span class="bg-gray-200 text-black px-3 py-1 rounded-lg ml-auto">Team leader</span>';
$response .= '</div>';
}
$response .= '</div>';

        echo $response;
    }

    wp_die();
}
function get_top_suggestions() {
    $args = array(
        'post_type'      => array('post', 'page'), 
        'posts_per_page' => 4,
        'orderby'        => 'date', 
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    $top_suggestions = array();

    $icons = [
        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path d="M12 2c-3.31 0-6 2.69-6 6v6c0 .55.45 1 1 1h10c.55 0 1-.45 1-1v-6c0-3.31-2.69-6-6-6zm-2 16h4v2h-4v-2zm2-5.5c1.38 0 2.5-1.12 2.5-2.5s-1.12-2.5-2.5-2.5-2.5 1.12-2.5 2.5 1.12 2.5 2.5 2.5z"/>
</svg>',
    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path d="M12 3L2 12h3v8h6v-6h4v6h6v-8h3L12 3zm7 15h-4v-6h-4v6H7v-8.18l5-4.5 5 4.5V18z"/>
</svg>',
'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-6 2H7v2h5V4zm6 16H7v-2h11v2zm0-4H7v-2h11v2zm0-4H7V8h11v2z"/>
</svg>
',
'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
</svg>',
    ];

    if ($query->have_posts()) {
        $index = 0;
        while ($query->have_posts() && $index < 4) {
            $query->the_post();
            $top_suggestions[] = array(
                'title'   => get_the_title(),
                'link'    => get_permalink(),
                'icon'    => $icons[$index],
            );
            $index++;
        }
    } else {
        echo 'No posts found.';
    }
    wp_reset_postdata();

    return $top_suggestions;
}