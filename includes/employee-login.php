
<?php
function employee_login_form() {
    ob_start(); // Start output buffering

    if (!is_user_logged_in()) {
        ?>
        
        <div class="w-[500px] bg-[#181A21] rounded-lg mt-[10%]">
        <h2 class="text-xl text-white mt-3 font-bold">Sign in</h2>
            <form id="loginform" action="<?php echo wp_login_url(home_url()); ?>" method="post">
                <h2 class="font-sans text mt-[25px] text-[#1999ff] w-[390px] font-bold">SIGN IN WITH USERNAME</h2>
                <input type="text" name="log" id="user_login" class="ps-2.5 decoration-white text-white m-1 rounded bg-[#32353c] w-80 h-10 mb-2.5 outline-none hover:bg-[#393c44] transition ease-out duration-300 " required>
                <div class="mb-4">
                <h2 class="font-sans text text-[#afafaf] w-[275px]">PASSWORD</h2>
                    <input type="password" name="pwd" id="user_pass" class="ps-2.5 decoration-white text-white m-1 rounded bg-[#32353c] w-80 h-10 mb-2.5 outline-none hover:bg-[#393c44] transition ease-out duration-300 " required>
                </div>
                <div class="mb-4 flex items-center justify-center">
                    <input type="checkbox" name="rememberme" id="rememberme" class="mr-2 pointer-events-auto">
                    <label for="rememberme" class="text-gray-700 text-sm w-[300px]"><p class="w-[100px]">Remember Me</p></label>
                </div>
                <div class="mb-4">
                <button type="submit" name="wp-submit" id="wp-submit" value="Log In" class="rounded w-[200px] h-[45px] mb-3 bg-[#00a2ff] text-white transition ease-out duration-300 p-1 hover:bg-[#00c3ff] pointer-events-auto">Sign in</button>
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
