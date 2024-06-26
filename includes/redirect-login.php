<?php

function redirect_to_signin_page() {
    if (!is_user_logged_in() && !is_page('signin')) {
        wp_redirect(site_url('/signin'));
        exit;
    }
}
add_action('template_redirect', 'redirect_to_signin_page');
