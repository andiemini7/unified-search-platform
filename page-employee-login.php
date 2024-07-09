<?php

/**
 * Template Name: Employee Login
 */

get_header('alternative');
?>
<div class="flex flex-col items-center justify-center text-center justify-items-center m-1">
    <?php echo do_shortcode('[employee_login]'); ?>
    <?php if (!is_user_logged_in()) : ?>
    <?php endif; ?>
</div>
