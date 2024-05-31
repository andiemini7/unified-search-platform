<?php
class MyThemeEnqueues {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_styles() {
        wp_enqueue_style('tailwindcss', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css', [], null);
        wp_enqueue_style('my-theme-styles', get_stylesheet_uri(), ['tailwindcss'], wp_get_theme()->get('Version'));
    }

    public function enqueue_scripts() {
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', ['jquery'], null, true);
    }
}

// Initialize the enqueues class
new MyThemeEnqueues();
?>
