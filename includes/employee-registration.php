<?php
// Create 'employee' role
function add_employee_role() {
    add_role(
        'employee',
        __( 'Employee' ),
        array(
            'read' => true,
            'edit_posts' => false,
            'delete_posts' => false,
        )
    );
}
add_action( 'init', 'add_employee_role' );

// Restrict access to WordPress dashboard for 'employee' role
function restrict_wp_dashboard() {
    if ( current_user_can( 'employee' ) && is_admin() && !defined('DOING_AJAX') ) {
        wp_redirect( home_url() );
        exit;
    }
}
add_action( 'admin_init', 'restrict_wp_dashboard' );



// Handle the registration form submission ,,,,
function handle_employee_registration() {
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset( $_POST['employee_register'] ) ) {
        $username = sanitize_user( $_POST['username'] );
        $email = sanitize_email( $_POST['email'] );
        $password = sanitize_text_field( $_POST['password'] );

        $userdata = array(
            'user_login'    => $username,
            'user_email'    => $email,
            'user_pass'     => $password,
            'role'          => 'employee',
        );

        $user_id = wp_insert_user( $userdata );

        if ( !is_wp_error( $user_id ) ) {
            ?> <p class="text-center">
                <?php 
                echo '<script>alert("You have been successfully registered!")</script>';
                ?>
            </p> 

            <?php
            
        } else {
            ?> <p class="text-center text-[#FF0000]">
                <?php
                echo 'An error occurred: ' . $user_id->get_error_message();
                ?>
            </p> 
            
            <?php 
            
        }
    }
}

// Shortcode to display the registration form ,,,,,
function employee_registration_form() {
    ob_start();
    ?>
    
    <div class="w-[500px] bg-[#181A21] rounded-lg mt-[10%]">
    <h2 class="text-xl text-white mt-3 font-bold">Register </h2>
    <form method="POST" class="flex flex-col items-center justify-center text-center justify-items-center">
        <div class="mb-4">
        <h2 class="font-sans mt-3 text text-[#afafaf] w-[100px]">USERNAME</h2>
        <input type="text" name="username" class="ps-2.5 decoration-white text-white m-1 rounded bg-[#32353c] w-80 h-10 mb-2.5 outline-none hover:bg-[#393c44] transition ease-out duration-300 " required>
        </div>
        <div class="mb-4">
        <h2 class="font-sans text text-[#afafaf] w-[60px]">EMAIL</h2>
        <input type="email" name="email" class="ps-2.5 decoration-white text-white m-1 rounded bg-[#32353c] w-80 h-10 mb-2.5 outline-none hover:bg-[#393c44] transition ease-out duration-300 " required>
        </div>
        <div class="mb-4">
        <h2 class="font-sans text text-[#afafaf] w-[100px]">PASSWORD</h2>
        <input type="password" name="password" class="ps-2.5 decoration-white text-white m-1 rounded bg-[#32353c] w-80 h-10 mb-2.5 outline-none hover:bg-[#393c44] transition ease-out duration-300 " required>
        </div>
        <div class="mb-4">
        <button type="submit" name="employee_register" class="rounded w-[200px] h-[45px] mb-3 bg-[#00a2ff] text-white transition ease-out duration-300 p-1 hover:bg-[#00c3ff] pointer-events-auto">Sign Up</button>
        </div>
    </form>
    </div>

    <?php
    handle_employee_registration();
    return ob_get_clean();
}
add_shortcode( 'employee_registration', 'employee_registration_form' );
