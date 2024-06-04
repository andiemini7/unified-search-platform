<?php
require get_template_directory() . '/vendor/autoload.php';
require get_template_directory() . '/includes/init.php';

function add_tailwind_css() {
    
    wp_enqueue_style('tailwind-css', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
}


add_action('wp_enqueue_scripts', 'add_tailwind_css');

?>


