<?php
class MyThemeSetup {
    public function __construct() {
        $this->init_classes();
    }

    private function init_classes() {
        require_once get_template_directory() . '/enqueues.php';
        require_once get_template_directory() . '/init.php';
    }
}

// Initialize the setup class
new MyThemeSetup();
?>
