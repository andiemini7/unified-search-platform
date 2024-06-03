<?php
function register_documentations() {
    register_post_type('documentation', [
        'labels' => [
            'name' => __('Documentations'),
            'singular_name' => __('Documentation'),
        ],
        'public' => true,
        'supports' => ['title', 'editor'],
    ]);
}

function documentation_taxonomies() {
    register_taxonomy('documentation_category', 'documentation', [
        'labels' => [
            'name' => __('Categories'),
            'singular_name' => __('Category'),
        ],
        'public' => true,
        'hierarchical' => true,
    ]);
}


?>