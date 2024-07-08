<?php
function create_teams_cpt() {
    $labels = array(
        'name' => __( 'Teams', 'textdomain' ),
        'singular_name' => __( 'Team', 'textdomain' ),
        
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_position' => 6,
        'show_in_rest' => true,
    );

    register_post_type( 'teams', $args );
}

add_action( 'init', 'create_teams_cpt' );
