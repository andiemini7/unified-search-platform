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

// ACF Repeater
function display_clients() {

    if( have_rows('clients') ): ?>
        <div class="client-wrapper">
            <?php while( have_rows('clients') ): the_row();
                $client_name = get_sub_field('client_name');
                $client_description = get_sub_field('client_description');
                $client_profile = get_sub_field('client_profile'); 
                ?>
                <div class="client-wrappers">
                    <?php if( $client_profile ): ?>
                        <img src="<?php echo esc_url($client_profile['url']); ?>" width="100" alt="<?php echo esc_attr($client_name); ?>" />
                    <?php endif; ?>
                    <h1><?php echo esc_html($client_name); ?></h1>
                    <span style="display:inline-block; width:500px;"><?php echo esc_html($client_description); ?></span>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;
}
