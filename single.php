<?php get_header(); ?>

<?php
    $modules = get_field('modules');
    var_dump($modules);
    if( have_rows('modules') ):

        while ( have_rows('modules') ) : the_row();
        var_dump(get_row_layout());
            include (get_template_directory().'/modules/'.get_row_layout().'.php');
        endwhile;
    endif;
?>

<?php get_footer(); ?>
