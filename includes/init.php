<?php

require_once('enqueue.php');
require_once('setup.php'); 

class MyThemeInit {
    public function __construct() {
        add_action('after_setup_theme', [$this, 'theme_setup']);
        add_action('init', [$this, 'register_documentations']);
        add_action('init', [$this, 'documentation_taxonomies']);
        add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles'); 
        add_action('after_setup_theme', 'my_theme_setup'); 
    }

    public function theme_setup() {
        var_dump('HERE');
    }

    public function register_documentations() {
        require_once get_template_directory() . '/app/PostTypes/PostTypes.php';
        register_documentations(); 
    }

    public function documentation_taxonomies() {
        require_once get_template_directory() . '/app/PostTypes/PostTypes.php';
        documentation_taxonomies();
    }
}

new MyThemeInit();

?>
