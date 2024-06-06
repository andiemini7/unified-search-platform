<?php
// Theme setup
namespace Hp\UnifiedSearchPlatform;

class Setup {
    public function unifiedsearch_setup() {
        // Add theme support
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        // Register navigation menus
        register_nav_menus([
            'home-menu' => __('Home Menu'),
            'contact-us-menu' => __('Contact Us Menu'),
            'unified-search-menu' => __('Unified Search Menu')
        ]);
        
    }
}   