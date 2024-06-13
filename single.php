<?php 
get_header();

if (have_rows('modules')) :
    echo '<div class="container mx-auto px-4 py-6">'; 
    echo '<div class="flex flex-wrap -mx-4">';
    while (have_rows('modules')) : the_row();
        $layout = get_row_layout();
        
        if ($layout == 'card') {
            // Include the card module file from the modules folder
            include(get_template_directory() . '/modules/card-module.php');
        } else {
            include(get_template_directory() . '/modules/' . $layout . '.php');
        }
    endwhile;
    echo '</div>';
    echo '</div>';
else :
    echo '<p>No modules found for this post.</p>';
endif;

get_footer();
?>
