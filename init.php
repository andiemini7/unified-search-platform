<?php
class MyThemeInit {
    public function __construct() {
        add_action('after_setup_theme', [$this, 'theme_setup']);
   
    }

    public function theme_setup() {
        var_dump('HERE');
      
    }
}

new MyThemeInit();
?>
