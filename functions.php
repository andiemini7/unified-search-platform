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

    // Calculate total number of pages
    $total_pages = $query->max_num_pages;

    // Return results and total number of pages
    return new WP_REST_Response(array(
        'results' => $results,
        'total_pages' => $total_pages,
        'current_page' => $paged
    ), 200);
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
    $post_types = get_post_types(array('public' => true), 'names');
    
    $args = array(
        's'              => $search_term,
        'post_type'       => $post_types, 
        'posts_per_page'  => 10,
    );

    $query = new WP_Query($args);
    $suggestions = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $suggestions[] = array(
                'title' => get_the_title(),
                'link'  => get_permalink(),
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

        $response = '<div class="bg-white rounded-md p-4">';
        if ($team_image) {
            $response .= '<img src="' . esc_url($team_image['url']) . '" alt="' . esc_attr($team_image['alt']) . '" class="w-full h-48 object-cover mt-3 mb-6 rounded-lg">';
        }
        $response .= '<h2 class="text-2xl font-bold text-gray-800 mb-4">' . esc_html($team_name) . '</h2>';
        $response .= '<p class="text-gray-800 mb-2"><strong>Description:</strong></p>';
        $response .= '<p class="text-gray-700 mb-4">' . esc_html($team_description) . '</p>';
        $response .= '<p class="text-gray-800 mb-2"><strong>Active members:</strong></p>';
        $response .= '<p class="text-gray-700 mb-6">' . esc_html($num_members) . ' members</p>';

        if ($projects) {
            $response .= '<h3 class="font-bold text-gray-800 mb-2">Current projects</h3>';
            $response .= '<div class="flex flex-wrap gap-2 mb-4">';
            foreach ($projects as $project) {
                $response .= '<span class="shadow bg-white text-gray-800 px-3 py-2 rounded-lg shadow-md">' . esc_html(get_the_title($project->ID)) . '</span>';
            }
            $response .= '</div>';
        }

        if ($team_leader) {
            $leader_name = $team_leader->display_name;
            $leader_email = $team_leader->user_email;
            $leader_image = get_field('leader_image', 'user_' . $team_leader->ID);

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
    $post_types = get_post_types(array('public' => true), 'names');

    $args = array(
        'post_type'      => $post_types, 
        'orderby'        => 'date', 
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    $top_suggestions = array();

    $icons = [
        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FF5733" viewBox="0 0 24 24">
            <path d="M12 2c-3.31 0-6 2.69-6 6v6c0 .55.45 1 1 1h10c.55 0 1-.45 1-1v-6c0-3.31-2.69-6-6-6zm-2 16h4v2h-4v-2zm2-5.5c1.38 0 2.5-1.12 2.5-2.5s-1.12-2.5-2.5-2.5-2.5 1.12-2.5 2.5 1.12 2.5 2.5 2.5z"/>
        </svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#33C4FF" viewBox="0 0 24 24">
             <path d="M12 3L2 12h3v8h6v-6h4v6h6v-8h3L12 3zm7 15h-4v-6h-4v6H7v-8.18l5-4.5 5 4.5V18z"/>
        </svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#4CAF50" viewBox="0 0 24 24">
            <path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-6 2H7v2h5V4zm6 16H7v-2h11v2zm0-4H7v-2h11v2zm0-4H7V8h11v2z"/>
        </svg>',
        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFC107" viewBox="0 0 24 24">
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
                'icon'    => $icons[$index % count($icons)], 
            );
            $index++;
        }
    } else {
        $top_suggestions[] = array(
            'title'   => 'No posts found.',
            'link'    => '',
            'icon'    => '',
        );
    }
    wp_reset_postdata();

    return $top_suggestions;
}


function enqueue_custom_scripts() {
    wp_enqueue_script( 'custom-modal-script', get_template_directory_uri() . '/js/custom-modal.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );
function custom_post_type_resources() {
    $labels = array(
        'name'                  => _x('Resources', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Resource', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Resources', 'text_domain'),
        'name_admin_bar'        => __('Resource', 'text_domain'),
        'archives'              => __('Resource Archives', 'text_domain'),
        'attributes'            => __('Resource Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Resource:', 'text_domain'),
        'all_items'             => __('All Resources', 'text_domain'),
        'add_new_item'          => __('Add New Resource', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Resource', 'text_domain'),
        'edit_item'             => __('Edit Resource', 'text_domain'),
        'update_item'           => __('Update Resource', 'text_domain'),
        'view_item'             => __('View Resource', 'text_domain'),
        'view_items'            => __('View Resources', 'text_domain'),
        'search_items'          => __('Search Resource', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into resource', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this resource', 'text_domain'),
        'items_list'            => __('Resources list', 'text_domain'),
        'items_list_navigation' => __('Resources list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter resources list', 'text_domain'),
    );
    $args = array(
        'label'                 => __('Resource', 'text_domain'),
        'description'           => __('Resource Description', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'taxonomies'            => array('resource_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('resources', $args);
}
add_action('init', 'custom_post_type_resources', 0);

// Add Meta Box
function add_custom_meta_box() {
    add_meta_box(
        'additional_description',
        __('Additional Description', 'text_domain'),
        'additional_description_callback',
        'resources',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_custom_meta_box');

// Meta Box Callback
function additional_description_callback($post) {
    wp_nonce_field(basename(__FILE__), 'additional_description_nonce');
    $additional_description = get_post_meta($post->ID, '_additional_description', true);
    ?>
    <textarea style="width:100%" rows="5" name="additional_description"><?php echo esc_textarea($additional_description); ?></textarea>
    <?php
}

// Save Meta Box Data
function save_additional_description($post_id) {
    if (!isset($_POST['additional_description_nonce']) || !wp_verify_nonce($_POST['additional_description_nonce'], basename(__FILE__))) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['post_type']) && 'resources' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    $new_meta_value = (isset($_POST['additional_description']) ? sanitize_text_field($_POST['additional_description']) : '');
    update_post_meta($post_id, '_additional_description', $new_meta_value);
}
add_action('save_post', 'save_additional_description');


function custom_taxonomy_resource_category() {
    $labels = array(
        'name'                       => _x('Resource Categories', 'Taxonomy General Name', 'text_domain'),
        'singular_name'              => _x('Resource Category', 'Taxonomy Singular Name', 'text_domain'),
        'menu_name'                  => __('Resource Category', 'text_domain'),
        'all_items'                  => __('All Items', 'text_domain'),
        'parent_item'                => __('Parent Item', 'text_domain'),
        'parent_item_colon'          => __('Parent Item:', 'text_domain'),
        'new_item_name'              => __('New Item Name', 'text_domain'),
        'add_new_item'               => __('Add New Item', 'text_domain'),
        'edit_item'                  => __('Edit Item', 'text_domain'),
        'update_item'                => __('Update Item', 'text_domain'),
        'view_item'                  => __('View Item', 'text_domain'),
        'separate_items_with_commas' => __('Separate items with commas', 'text_domain'),
        'add_or_remove_items'        => __('Add or remove items', 'text_domain'),
        'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
        'popular_items'              => __('Popular Items', 'text_domain'),
        'search_items'               => __('Search Items', 'text_domain'),
        'not_found'                  => __('Not Found', 'text_domain'),
        'no_terms'                   => __('No items', 'text_domain'),
        'items_list'                 => __('Items list', 'text_domain'),
        'items_list_navigation'      => __('Items list navigation', 'text_domain'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('resource_category', array('resources'), $args);
}
add_action('init', 'custom_taxonomy_resource_category', 0);
function register_plannings() {
    // Regjistro `custom post type`
    register_post_type('plannings', [
        'labels' => [
            'name' => __('Plannings'),
            'singular_name' => __('Planning'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'custom-fields', 'thumbnail'], // Shto 'thumbnail' nëse dëshiron të mbështesësh imazhe të veçanta
        'menu_position' => 5,
        'menu_icon' => 'dashicons-calendar',
        'show_in_rest' => true, // Aktivizo për REST API
    ]);

    // Regjistro taksonomi për `plannings`
    register_taxonomy('planning_category', 'plannings', [
        'labels' => [
            'name' => __('Categories'),
            'singular_name' => __('Category'),
        ],
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'planning-category'],
        'show_in_rest' => true, // Aktivizo për REST API
    ]);
}
add_action('init', 'register_plannings');

// Allow SVG file upload
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');
  
  // Sanitize SVG files
  function sanitize_svg($svg) {
    return $svg;
  }
  add_filter('wp_handle_sideload_prefilter', 'sanitize_svg');
  add_filter('wp_handle_upload_prefilter', 'sanitize_svg');

//   notify
  function add_user_notification($user_id, $notification) {
    $notifications = get_user_meta($user_id, 'user_notifications', true);
    
    if (!$notifications) {
        $notifications = [];
    }

    array_unshift($notifications, array_merge($notification, ['read' => false]));

    update_user_meta($user_id, 'user_notifications', $notifications);
}

function notify_users_on_new_post($post_id, $post, $update) {
    if ($update || $post->post_status === 'auto-draft') {
        return;
    }

    $users = get_users();

    foreach ($users as $user) {
        $user_id = $user->ID;

        $notification = [
            'message' => 'A new post has been published: ' . get_the_title($post_id),
            'link' => get_permalink($post_id),
            'time' => current_time('mysql')
        ];

        add_user_notification($user_id, $notification);
    }
}

add_action('wp_insert_post', 'notify_users_on_new_post', 10, 3);

function load_notifications() {
    $current_user_id = get_current_user_id();
    $notifications = get_user_meta($current_user_id, 'user_notifications', true) ?: [];

    // Filter only unread notifications and mark them as read
    $unread_notifications = [];
    foreach ($notifications as &$notification) {
        if (!$notification['read']) {
            $unread_notifications[] = $notification;
            $notification['read'] = true;
        }
    }

    // Update the notifications to mark them as read
    update_user_meta($current_user_id, 'user_notifications', $notifications);

    $response = array(
        'notifications' => array_map(function($notification) {
            return array(
                'link' => $notification['link'],
                'message' => $notification['message']
            );
        }, $unread_notifications),
        'count' => count($unread_notifications),
        'has_notifications' => count($unread_notifications) > 0
    );

    wp_send_json($response);
}


add_action('wp_ajax_load_notifications', 'load_notifications');
add_action('wp_ajax_nopriv_load_notifications', 'load_notifications');
