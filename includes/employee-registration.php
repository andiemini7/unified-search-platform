<?php
// Create 'employee' role
function add_employee_role() {
    add_role(
        'employee',
        __('Employee'),
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
        )
    );
}
add_action('init', 'add_employee_role');

// Restrict access to WordPress dashboard for 'employee' role
function restrict_wp_dashboard() {
    if (current_user_can('employee') && is_admin() && !defined('DOING_AJAX')) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'restrict_wp_dashboard');

// Handle the registration form submission
function handle_employee_registration() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_register'])) {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);

        $userdata = array(
            'user_login'    => $username,
            'user_email'    => $email,
            'user_pass'     => $password,
            'role'          => 'pending',
        );

        $user_id = wp_insert_user($userdata);

        if (!is_wp_error($user_id)) {
            // Hide the form and display the success message
            ?>
            <style>
                #employee-registration-form {
                    display: none;
                }
                .registration-message {
                    display: block;
                }
            </style>
            <div class="registration-message ">
                <div class="msgcard flex flex-wrap justify-center m-auto items-center bg-[#F5F5F5] h-[500px] text-[20px] rounded-[30px] p-[15px] mt-4 shadow-[2px_5px_4px_1px] shadow-gray-300">
                    <h2 class="text-2xl font-bold">Registration Successful!</h2>
                    <p>Thank you for registering. Your account is currently pending approval. Please check your email for further instructions.</p>
                    <p>If you do not see the email in your inbox, please check your spam or junk folder.</p>
                    <p>Once your account is approved, you will receive a confirmation email, and you will be able to log in.</p>
                    <div class="mb-4">
                        <a class="navbtn bg-[#000000] text-white tracking-wider transition ease-out duration-300 hover:bg-[#ffffff] hover:text-[#000000] cursor-pointer" href="<?php echo esc_url(home_url('/signin/')); ?>">Return</a>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo '<div class="flex items-center text-red-500 bg-[#f9dfdf] h-auto text-[20px] border-2 border-[#eb3a3a] rounded-[10px] p-[15px] mt-4">Error: ' . $user_id->get_error_message() . '</div>';
        }
    }
}


// Shortcode to display the registration form
function employee_registration_form() {
    ob_start();
    ?>
    <div id="employee-registration-form">

    <h1 class="text-5xl text-black my-3 font-bold">Register</h1>
    <h2 class="regh2 text-xl text-black my-3 font-bold">Already have an account?<br><a href="<?php echo esc_url(home_url('/signin/')); ?>" style="color:#4461F2"> Log in</a></h2>
    <div class="registerdiv mt-5">

        <form method="POST" class="flex flex-col items-center justify-center text-center justify-items-center">
            <div class="mb-4">
                <input type="text" placeholder="Username" name="username" class="regel ps-2.5 decoration-white font-bold m-1 rounded bg-[#eaf0f7] w-[500px] h-[55px] mb-2.5 outline-none hover:bg-[#DAE3EF] transition ease-out duration-300" required>
            </div>
            <div class="mb-4">
                <input type="email" placeholder="Email" name="email" class="regel ps-2.5 decoration-white font-bold m-1 rounded bg-[#eaf0f7] w-[500px] h-[55px] mb-2.5 outline-none hover:bg-[#DAE3EF] transition ease-out duration-300" required>
            </div>
            <div class="mb-4">
                <input type="password" placeholder="Password" name="password" class="regel ps-2.5 decoration-white font-bold m-1 rounded bg-[#eaf0f7] w-[500px] h-[55px] mb-2.5 outline-none hover:bg-[#DAE3EF] transition ease-out duration-300" required>
            </div>
            <div class="mb-4">
                <button type="submit" name="employee_register" class="regelbtn rounded-full w-[500px] h-[55px] mt-5 mb-3 bg-[#030615] text-white font-bold tracking-wider transition ease-out duration-300 p-1 hover:bg-[#00c3ff] pointer-events-auto">Sign Up</button>
            </div>
        </form>
    </div>
    </div>
    <div class="registration-message" style="display: none;"></div>
    <?php
    handle_employee_registration();
    return ob_get_clean();
}

add_shortcode('employee_registration', 'employee_registration_form');
