<?php
get_header();

$modules = get_field('modules');
// var_dump($modules);

if (have_rows('modules')) :
    while (have_rows('modules')) : the_row();
        // var_dump(get_row_layout());
        include(get_template_directory() . '/modules/' . get_row_layout() . '.php');
    endwhile;
else :
    echo '<p>No modules found for this post.</p>';
endif;

get_footer();
 ?>