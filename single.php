<?php get_header(); ?>

<div class="container mx-auto px-4 py-6" style="max-width: 1350px; ">
    <?php
    if (have_rows('modules')) :
        echo '<div class="flex flex-wrap -mx-4">';
        while (have_rows('modules')) : the_row();
            $layout = get_row_layout();
            
           {
                include(get_template_directory() . '/modules/' . $layout . '.php');
            }
        endwhile;
        echo '</div>';
    else :
        echo '<p>No modules found for this post.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>


