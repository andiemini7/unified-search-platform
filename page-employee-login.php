<?php

/**
 * Template Name: Employee Login
 */

get_header('alternative');
?>
<div class="flex flex-col items-center justify-center text-center justify-items-center m-1">
    <?php echo do_shortcode('[employee_login]'); ?>
    <?php if (!is_user_logged_in()) : ?>
        <a href="<?php echo wp_login_url(); ?>?action=oauth2-login" class="rounded bg-[#1f2937] text-white transition ease-out duration-300 p-1 hover:bg-[#f2541f] hidden">Login with Starlabs SSO</a>

    <?php endif; ?>
</div>
