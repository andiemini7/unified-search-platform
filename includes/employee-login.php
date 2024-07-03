<?php
function employee_login_form()
{
    ob_start(); // Start output buffering

    if (!is_user_logged_in()) {
?>
        <h1 class="text-5xl text-black my-3 font-bold">Sign in</h1>
        <h2 class="text-xl text-black my-3 font-bold">Don't have an account? <br /> You can <a href="http://localhost/unified-search-platform/register/" style="color:#4461F2">register here!</a></h2>
        <div class="w-[500px] mt-5">

            <form id="loginform" action="<?php echo wp_login_url(home_url()); ?>" method="post">
                <div class="mb-4">
                    <input type="text" placeholder="Username" name="log" id="user_login" class="ps-2.5 decoration-white  m-1 rounded bg-[#eaf0f7] w-[500px] h-[55px] mb-2.5 outline-none hover:bg-[#DAE3EF] transition ease-out duration-300 " required>
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Password" name="pwd" id="user_pass" class="ps-2.5 decoration-white m-1 rounded bg-[#eaf0f7] w-[500px] h-[55px] mb-2.5 outline-none hover:bg-[#DAE3EF] transition ease-out duration-300 " required>
                </div>
                <div class="mb-4">
                    <button type="submit" name="wp-submit" id="wp-submit" value="Log In" class="rounded-full w-[500px] h-[55px] mt-5 mb-3 bg-[#030615] shadow-lg shadow-[#030615] text-white transition ease-out duration-300 p-1 hover:bg-[#00c3ff] hover:shadow-lg hover:shadow-white pointer-events-auto">Sign in</button>
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
