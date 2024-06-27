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
            'primary' => __('Primary Menu'),
            'home-menu' => __('Home Menu'),
            'contact-us-menu' => __('Contact Us Menu'),
            'unified-search-menu' => __('Unified Search Menu')
        ]);

        $this->initialize_acf_options();
    }

    private function initialize_acf_options() {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title'    => 'Site Settings',
                'menu_title'    => 'Site Settings',
                'menu_slug'     => 'site-settings',
                'capability'    => 'manage_options',
                'redirect'      => false,
                'position'      => 2,
                'icon_url'      => 'dashicons-admin-generic'
            ));
    
            acf_add_options_sub_page(array(
                'page_title'    => 'General Settings',
                'menu_title'    => 'General Settings',
                'parent_slug'   => 'site-settings',
                'menu_slug'     => 'general-settings',
                'position'      => 99,
            ));
        }
    
        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group(array(
                'key' => 'group_general_settings',
                'title' => 'General Settings Fields',
                'fields' => array(
                    array(
                        'key' => 'field_footer_logo',
                        'label' => 'Footer Logo',
                        'name' => 'footer_logo',
                        'type' => 'image',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_footer_text',
                        'label' => 'Footer Text',
                        'name' => 'footer_text',
                        'type' => 'textarea',
                    ),
                    array(
                        'key' => 'field_navbar_logo',
                        'label' => 'Navbar Logo',
                        'name' => 'navbar_logo',
                        'type' => 'image',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_navbar_text',
                        'label' => 'Navbar Text',
                        'name' => 'navbar_text',
                        'type' => 'text',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'general-settings',
                        ),
                    ),
                ),
            ));
        }
    }
}