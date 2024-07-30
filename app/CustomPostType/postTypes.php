<?php

namespace Hp\UnifiedSearchPlatform\App\CustomPostType;
class PostTypes {
function register_documentations() {

    //Documentaion
    register_post_type('documentation', [
        'labels' => [
            'name' => __('Documentations'),
            'singular_name' => __('Documentation'),
        ],
        'public' => true,
        'supports' => ['title', 'editor'],
        'menu_icon' => 'dashicons-media-document',
    ]);
}

    // function documentation_taxonomies() {
    //     register_taxonomy('documentation_category', 'documentation', [
    //         'labels' => [
    //             'name' => __('Categories'),
    //             'singular_name' => __('Category'),
    //         ],
    //         'public' => true,
    //         'hierarchical' => true,
    //     ]);
    //}

    // Members
    function register_members() {
        register_post_type('members', [
            'labels' => [
            'name' => __( 'Members', 'textdomain' ),
            'singular_name' => __( 'Member', 'textdomain' ),
            ],
    
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'menu_position' => 4,
            'show_in_rest' => true,
            'menu_icon'    => 'dashicons-id',
        ]);
    }

    // function member_taxonomies() {
    //     register_taxonomy('member_category', 'members', [
    //         'labels' => [
    //             'name' => __('Categories'),
    //             'singular_name' => __('Category'),
    //         ],
    //         'public' => true,
    //         'hierarchical' => true,
    //     ]);
    // }

    // Teams
    function register_teams() {
        register_post_type('teams', [
            'labels' => [
            'name' =>  __('Teams'),
            'singular_name' => __('Team'),
            
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'menu_position' => 5,
            'menu_icon'    => 'dashicons-groups',
        ]);
    }

    // function team_taxonomies() {
    //     register_taxonomy('team_category', 'teams', [
    //         'labels' => [
    //             'name' => __('Categories'),
    //             'singular_name' => __('Category'),
    //         ],
    //         'public' => true,
    //         'hierarchical' => true,
    //     ]);
    // }

     //Projects
     function register_projects() {
        register_post_type('projects', [
            'labels' => [
                'name' => __('Projects'),
                'singular_name' => __('Project'),
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'menu_position' => 6,
            'menu_icon'     => 'dashicons-portfolio',
        ]);
    }

      //Prodcts
      function register_products() {
        register_post_type('products', [
            'labels' => [
                'name' => __('Products'),
                'singular_name' => __('Product'),
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail','excpert'],
            'menu_position' => 6,
        ]);
    }
   
}
?>
