<?php
require_once('enqueue.php');
require_once('setup.php'); 

class Init {
    public function __construct() {
        add_action('init', [$this, 'register_documentations']);
        add_action('init', [$this, 'documentation_taxonomies']);
        add_action('wp_enqueue_scripts', 'enqueueStyles'); 
        add_action('after_setup_theme', 'unifiedsearch_setup');
        // See More Button Enqueue Script
        add_action('wp_enqueue_scripts', 'enqueue_SeeMore_scripts');


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

new Init();
?>
