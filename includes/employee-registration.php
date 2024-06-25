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
    
    <form method="POST" class="flex flex-col items-center justify-center text-center justify-items-center">
        <label for="username" class="text-xl text-white">Register</label>

        <input type="text" placeholder="Username" name="username" class="text-center m-1 rounded" required>
        <input type="email" placeholder="Email" name="email" class="text-center m-1 rounded" required>
        <input type="password" placeholder="Password" name="password" class="text-center m-1 rounded" required>

        <button type="submit" name="employee_register" class="rounded mt-1.5 mx-0 mb-7 bg-[#1f2937] text-white transition ease-out duration-300 p-1 hover:bg-[#00a2ff]">Sign Up</button>
    </form>

    <?php
    handle_employee_registration();
    return ob_get_clean();
}
add_shortcode( 'employee_registration', 'employee_registration_form' );
