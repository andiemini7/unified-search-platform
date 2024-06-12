<?php
function employee_login_form() {
    ob_start(); // Start output buffering

    if (!is_user_logged_in()) {
        ?>
        <div class="">
            <h2 class="text-xl text-white">Login</h2>
            <form id="loginform" action="<?php echo site_url('wp-login.php'); ?>" method="post">
                    <input type="text" name="log" id="user_login" class="text-center m-1 rounded" placeholder="username" required>
                <div class="mb-4">
                    <input type="password" name="pwd" id="user_pass" class="text-center m-1 rounded" placeholder="password" required>
                </div>
                <div class="mb-4 flex items-center justify-center">
                    <input type="checkbox" name="rememberme" id="rememberme" class="mr-2">
                    <label for="rememberme" class="text-gray-700 text-sm">Remember Me</label>
                </div>
                <div class="mb-4">
                    <input type="submit" name="wp-submit" id="wp-submit" value="Log In" class="rounded bg-[#1f2937] text-white transition ease-out duration-300 p-1 hover:bg-[#00a2ff]">
                </div>
                <input type="hidden" name="redirect_to" value="<?php echo esc_url(site_url($_SERVER['REQUEST_URI'])); ?>">
            </form>
            
        </div>
        <?php
    } else {
        echo '<p class="text-xl text-white m-1" p-8>You are already logged in!</p>';
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

    

    return ob_get_clean() . $output;
}
add_shortcode('employee_login', 'employee_login_form');