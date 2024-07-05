<?php
// manage-pending-users.php

// Function to approve a pending user
function approve_pending_user($user_id) {
    $user = get_user_by('ID', $user_id);
    if ($user) {
        $user->set_role('subscriber'); // Change the role to 'subscriber' or any other appropriate role
    }
}

// Display the pending users page
function manage_pending_users_page() {
    if (isset($_POST['approve_user']) && isset($_POST['user_id'])) {
        $user_id = intval($_POST['user_id']);
        approve_pending_user($user_id);
        echo '<div class="updated"><p>User approved successfully.</p></div>';
    }

    $pending_users = get_users(array('role' => 'pending'));
    ?>
    <div class="wrap">
        <h1>Pending Users</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending_users as $user): ?>
                    <tr>
                        <td><?php echo esc_html($user->user_login); ?></td>
                        <td><?php echo esc_html($user->user_email); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo esc_attr($user->ID); ?>">
                                <input type="submit" name="approve_user" value="Approve" class="button button-primary">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Add a new submenu item under the Users menu
function manage_pending_users_menu() {
    add_users_page('Pending Users', 'Pending Users', 'manage_options', 'pending-users', 'manage_pending_users_page');
}
add_action('admin_menu', 'manage_pending_users_menu');
