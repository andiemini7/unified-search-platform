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
            <div class="relative bg-gray-100 rounded-lg shadow-md overflow-hidden mx-4 my-4" style="width: 330px; height: 400px; margin:16px;"> <!-- Changed bg-white to bg-gray-100 -->
                <div class="absolute inset-0 m-0 h-2/3 w-full overflow-hidden bg-transparent bg-cover bg-center text-gray-700"> <!-- Adjusted height for image section -->
                    <img src="http://unified-search-platform.test/wp-content/uploads/2024/06/image1.png" class="w-full h-full object-cover">
                    <div class="absolute inset-0 w-full h-full" style="background: linear-gradient(to top, rgba(0, 0, 255, 0.3), rgba(0, 0, 255, 0));"></div> <!-- Added gradient overlay -->
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
                    <div class="h-1/3 bg-gray-100 font-medium leading-[1.5] p-4 flex justify-center items-center"> 
                        <p class="text-white text-center"> 
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
