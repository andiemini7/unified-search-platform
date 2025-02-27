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
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-media-document',
    ]);
}



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
            'menu_icon'     => 'dashicons-products',
        ]);
    }
   

    //Tech Support
    function register_tech_support() {
        register_post_type('tech-support', [
            'labels' => [
                'name' => __('Tech Support'),
                'singular_name' => __('Support'),
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail','excpert'],
            'menu_position' => 6,
            'menu_icon'     => 'dashicons-shield',
        ]);
    }
}


?>
