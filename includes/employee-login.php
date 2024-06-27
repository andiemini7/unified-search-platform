
<?php
function employee_login_form() {
    ob_start(); // Start output buffering

    if (!is_user_logged_in()) {
        ?>
        <div class="">
            <h2 class="text-xl text-white">Login</h2>
            <form id="loginform" action="<?php echo wp_login_url(home_url()); ?>" method="post">
                <input type="text" name="log" id="user_login" class="text-center decoration-white m-1 rounded-full bg-gray-300 w-72 h-11 mb-2.5 outline-none hover:bg-slate-200 transition ease-out duration-300 focus:bg-slate-100" placeholder="username" required>
                <div class="mb-4">
                    <input type="password" name="pwd" id="user_pass" class="text-center decoration-white m-1 rounded-full bg-gray-300 w-72 h-11 mb-2.5 outline-none hover:bg-slate-200 transition ease-out duration-300 focus:bg-slate-100" placeholder="password" required>
                </div>
                <div class="mb-4 flex items-center justify-center">
                    <input type="checkbox" name="rememberme" id="rememberme" class="mr-2">
                    <label for="rememberme" class="text-gray-700 text-sm">Remember Me</label>
                </div>
                <div class="mb-4">
                    <input type="submit" name="wp-submit" id="wp-submit" value="Log In" class="rounded bg-[#1f2937] text-white transition ease-out duration-300 p-1 hover:bg-[#00a2ff]">
                </div>
                <input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>">
            </form>
        </div>
        <?php
    } else {
        echo '<p class="text-xl text-black m-1 p-8">You have successfully logged in!</p>';
    }

    return ob_get_clean();
}
add_shortcode('employee_login', 'employee_login_form');
