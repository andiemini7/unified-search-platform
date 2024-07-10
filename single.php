<?php
get_header();
?>

<div class="container mx-auto p-4">
    <?php
    $modules = get_field('modules');

    if (have_rows('modules')) :
        while (have_rows('modules')) : the_row();

        if (get_row_layout() == 'card') {
            include(get_template_directory() . '/modules/card.php');
        } else {
            include(get_template_directory() . '/modules/' . get_row_layout() . '.php');
        }
    endwhile;

    else :
        echo '<p>No modules found for this post.</p>';
    endif;
    ?>
</div>

<?php

get_footer();
