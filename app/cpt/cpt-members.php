<?php
function create_members_cpt() {
    $labels = array(
        'name' => __( 'Members', 'textdomain' ),
        'singular_name' => __( 'Member', 'textdomain' ),
        
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_position' => 5,
        'show_in_rest' => true,
    );

    register_post_type( 'members', $args );
}

add_action( 'init', 'create_members_cpt' );
