<?php get_header(); ?>

<?php

if (have_rows('modules')) :
    echo '<div class="container mx-auto px-4 py-6">'; 
    echo '<div class="flex flex-wrap -mx-4">';
    while (have_rows('modules')) : the_row();
        $layout = get_row_layout();
        
        if ($layout == 'card') { 
           
            $name = get_sub_field('name');
            $date = get_sub_field('date');
            $description = get_sub_field('description');
            ?>
            <div class="relative bg-white rounded-lg shadow-md overflow-hidden mx-4 my-4" style="width: 330px; height: 400px; margin:16px;"> 
                <div class="absolute inset-0 m-0 h-full w-full overflow-hidden bg-transparent bg-cover bg-center text-gray-700">
                    <img src="http://unified-search-platform.test/wp-content/uploads/2024/06/malet.avif">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-t from-black/80 via-black/50"></div>
                </div>
                <div class="absolute inset-0 flex flex-col justify-end p-6">
                    <div class="flex items-baseline justify-between" style="padding-left: 16px; padding-right: 16px;">
                        <h2 class="mb-4 block font-sans text-2.5xl font-medium leading-[1.5] tracking-normal text-white antialiased mb-2">
                            <?php echo esc_html($name); ?>
                        </h2>
                        <p class="block mb-4 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-white mb-2">
                            <?php echo esc_html($date); ?>
                         </p>
                    </div>
                    <div class="h-1/3 bg-gray-100 p-4"> 
                    <p class="text-gray-700"> 
                        <?php echo esc_html($description); ?>
                    </p>
                </div>
                </div>
            </div>
            <?php
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
