<?php

namespace Hp\UnifiedSearchPlatform;

use Hp\UnifiedSearchPlatform\Enqueue;
use Hp\UnifiedSearchPlatform\Setup;
use Hp\UnifiedSearchPlatform\App\postTypes\PostTypes;

class Init {
    public function __construct() {
        $setup = new Setup();
        add_action('after_setup_theme', [$setup, 'unifiedsearch_setup']);
        add_action('init', [$this, 'register_documentations']);
        add_action('init', [$this, 'documentation_taxonomies']);
        $enqueue = new Enqueue();
        add_action('wp_enqueue_scripts', [$enqueue, 'enqueueStyles']);
    }

    public function register_documentations() {
        $postTypes = new PostTypes();
        $postTypes->register_documentations();
    }

    public function documentation_taxonomies() {
        $postTypes = new PostTypes();
        $postTypes->documentation_taxonomies();
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
