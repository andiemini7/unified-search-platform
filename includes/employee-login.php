<?php
function employee_login_form() {
    ob_start(); // Start output buffering

    if (!is_user_logged_in()) {
        $args = array(
            'echo'           => true,
            'redirect'       => site_url($_SERVER['REQUEST_URI']), 
            'form_id'        => 'loginform',
            'label_username' => __( 'Username' ),
            'label_password' => __( 'Password' ),
            'label_remember' => __( 'Remember Me' ),
            'label_log_in'   => __( 'Log In' ),
            'id_username'    => 'user_login',
            'id_password'    => 'user_pass',
            'id_remember'    => 'rememberme',
            'id_submit'      => 'wp-submit',
            'remember'       => true,
            'value_username' => '',
            'value_remember' => false
        );
        
        wp_login_form($args);
    } else {
        echo '<p>You are already logged in.</p>';
    }
    

    $output = '';
    if (isset($_POST['employee_login'])) {
        $username = sanitize_text_field($_POST['username']);
        $password = sanitize_text_field($_POST['password']);
        $credentials = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true,
        );
        $user = wp_signon($credentials, false);
        if (is_wp_error($user)) {
            $output .= '<p class="error">' . $user->get_error_message() . '</p>';
        } else {
            wp_redirect(home_url());
            exit;
        }
    } 

    

    return ob_get_clean() . $output; // Return buffered output and clean buffer
}
add_shortcode('employee_login', 'employee_login_form');