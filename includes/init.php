<?php

namespace Hp\UnifiedSearchPlatform;

use Hp\UnifiedSearchPlatform\Enqueue;
use Hp\UnifiedSearchPlatform\Setup;
use Hp\UnifiedSearchPlatform\Routes;
use Hp\UnifiedSearchPlatform\App\CustomPostType\PostTypes;

class Init {
    public function __construct() {
        add_action('after_setup_theme', [new Setup(), 'unifiedsearch_setup']);
        //Documentaions
        add_action('init', [$this, 'register_documentations']);
        // add_action('init', [$this, 'documentation_taxonomies']);
       
        //Teams
        add_action('init', [$this, 'register_teams']); 
        // add_action('init', [$this, 'team_taxonomies']);
        //Projects
        add_action('init', [$this, 'register_projects']); 
        // add_action('init', [$this, 'project_taxonomies']);

        //Products
        add_action('init', [$this, 'register_products']);


        add_action('wp_enqueue_scripts', [new Enqueue(), 'enqueueStyles']);
        add_action('rest_api_init', [new Routes(), 'register_routes']);
        add_action('wp_ajax_nopriv_autosuggest', 'handle_autosuggest');
        add_action('wp_ajax_autosuggest', 'handle_autosuggest');
        
    }

    //Documentaions
    public function register_documentations() {
        $postTypes = new PostTypes();
        $postTypes->register_documentations();
    }

    

   

    //Teams
    public function register_teams() {
        $postTypes = new PostTypes();
        $postTypes->register_teams();
    }

    

    //Projects
    public function register_projects() {
        $postTypes = new PostTypes();
        $postTypes->register_projects();
    }


    //Products
    public function register_products() {
        $postTypes = new PostTypes();
        $postTypes->register_products();
    }



    



    public function enqueueStyles() {
        // Enqueue your styles here
    }

    public function unifiedsearch_setup() {
        // Setup theme support, menus, etc.
    }
}


// Initialize the theme setup
new Init();
