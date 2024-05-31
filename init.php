<?php
class MyThemeInit {
    public function __construct() {
        add_action('after_setup_theme', [$this, 'theme_setup']);
        add_action('init', [$this, 'register_menus']);
    }

    public function theme_setup() {


    }
}

new MyThemeInit(); 

        // Add support for document title tag
        add_theme_support('title-tag');

        // Add support for post thumbnails
        add_theme_support('post-thumbnails');
    }

    public function register_menus() {
        register_nav_menus(
            array(
                'home-menu' => __('Home Menu'),
                'contact-us-menu' => __('Contact Us Menu'),
                'unified-search-menu' => __('Unified Search Menu') // New menu
            )
        );
    }
}

// Initialize the init class
new MyThemeInit();

?>
