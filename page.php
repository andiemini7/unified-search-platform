<?php
get_header();
?>

<div class="">
    <?php
    $modules = get_field('modules');

    if (have_rows('modules')) :
        while (have_rows('modules')) : the_row();
            include(get_template_directory() . '/modules/' . get_row_layout() . '.php');
        endwhile;
    else :
        echo '<p>No modules found for this post.</p>';
    endif;
    ?>
</div>

<?php
get_footer();
?>
