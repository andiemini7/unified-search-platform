<?php
get_header();
?>

<div class="">
    <?php
    $modules = get_field('modules');

    if (have_rows('modules')) :
        while (have_rows('modules')) : the_row();
            $module_layout = get_row_layout();
            if ($module_layout === 'search_bar') {
                include(get_template_directory() . '/modules/' . $module_layout . '.php');
            } else {
                echo '<div class="module-container">';
                include(get_template_directory() . '/modules/' . $module_layout . '.php');
                echo '</div>';
            }
        endwhile;
    else :
        echo '<p>No modules found for this post.</p>';
    endif;
    ?>
</div>

<?php
get_footer();
?>
