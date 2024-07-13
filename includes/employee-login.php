

<?php
function employee_login_form()
{
    ob_start(); // Start output buffering

    if (!is_user_logged_in()) {
?>
        <h1 class="text-5xl text-black my-3 font-bold">Sign in</h1>
        <h2 class="text-xl text-black my-3 font-bold">Don't have an account? <br /> You can <a href="http://localhost/register/" style="color:#4461F2">register here!</a></h2>
        <div class="signindiv mt-5">

            <form id="loginform" action="<?php echo wp_login_url(home_url()); ?>" method="post">
                <div class="mb-4">
                    <input type="text" placeholder="Username" name="log" id="user_login" class="logel ps-2.5 decoration-white font-bold m-1 rounded bg-[#eaf0f7] w-[500px] h-[55px] mb-2.5 outline-none hover:bg-[#DAE3EF] transition ease-out duration-300 " required>
                </div>
                <div class="mb-4">
                    <input type="password" placeholder="Password" name="pwd" id="user_pass" class="logel ps-2.5 decoration-white font-bold m-1 rounded bg-[#eaf0f7] w-[500px] h-[55px] mb-2.5 outline-none hover:bg-[#DAE3EF] transition ease-out duration-300 " required>
                </div>
                <div class="mb-4">
                    <button type="submit" name="wp-submit" id="wp-submit" value="Log In" class="logel rounded-full w-[500px] h-[55px] mt-5 mb-3 bg-[#030615] text-white font-bold tracking-wider transition ease-out duration-300 p-1 hover:bg-[#00c3ff]  pointer-events-auto">Sign In</button>
                </div>
                <div class="mb-4 flex justify-center">
                    <hr class="logline w-[20%] border-gray-700 mt-[8px] mr-[10px]"><p class="text-xs text-gray-700"> Or continue with </p><hr class="logline w-[20%] border-gray-700 mt-[8px] ml-[10px]">
                </div>
                <div class="mb-4 h-[50px] flex justify-center">
                <a href="http://localhost/wp-login.php?loginSocial=google" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600">
                    <img src="https://cdn3.iconfinder.com/data/icons/logos-brands-3/24/logo_brand_brands_logos_google-512.png" class="h-[30px] w-[30px] mx-2.5 hover:bg-[#DAE3EF] hover:drop-shadow-lg transition ease-out duration-250" />
                </a>
                <a href="http://localhost/wp-login.php?loginSocial=twitter" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="twitter" data-popupwidth="600" data-popupheight="600">
                <img src="https://cdn2.iconfinder.com/data/icons/threads-by-instagram/24/x-logo-twitter-new-brand-512.png" class="h-[30px] w-[30px] mx-2.5 hover:bg-[#DAE3EF] hover:drop-shadow-lg transition ease-out duration-250" />
</a>
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
