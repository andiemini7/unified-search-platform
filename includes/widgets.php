<?php
// Add widget support
function theme_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar', 'unified-search-platform' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets added here will appear in the sidebar.', 'your-theme-text-domain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'theme_widgets_init' );
