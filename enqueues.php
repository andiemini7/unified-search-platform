<?php
class MyThemeEnqueues {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_styles() {
     
    }

    public function enqueue_scripts() {
   
    }
}


new MyThemeEnqueues();
?>
