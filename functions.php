<?php

function unified_search_platform_setup() {
    add_theme_support('title-tag');
}


add_action('after_setup_theme',
'unified_search_platform_setup');


function my_theme_enqueue_styles() {
    wp_enqueue_style('tailwindcss', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css', [], null);
    wp_enqueue_style('my-theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function register_my_menus() {
    register_nav_menus(
        array(
            'home-menu' => __('Home Menu'),
            'contact-us-menu' => __('Contact Us Menu'),
            'unified-search-menu' => __('Unified Search Menu') // New menu
        )
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
add_action('init', 'register_my_menus');

require get_template_directory() . '/enqueues.php';
require get_template_directory() . '/init.php';




if (!is_user_logged_in()) {
    $args = array(
        'echo'           => true,
        'redirect'       => site_url($_SERVER['REQUEST_URI']), 
        'form_id'        => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Log In' ),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => true,
        'value_username' => '',
        'value_remember' => false
    );
    
    wp_login_form($args);
} else {
    echo '<p>You are already logged in.</p>';
}
?>
