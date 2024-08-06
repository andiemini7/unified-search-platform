<?php
// Get the selected post type and selection type from ACF fields
$post_type = get_sub_field('manual_post_type');
$selection_type = get_sub_field('selection_type');
$card_title = get_sub_field('card_title'); // Get the custom card title

// Initialize the query arguments
$args = array(
    'post_type' => $post_type,
    'posts_per_page' => ($selection_type === 'latest') ? 10 : -1,
);

// If manual selection, get the selected posts
if ($selection_type === 'manual') {

    $manual_posts_field = 'manual_' . $post_type;
    $manual_posts = get_sub_field($manual_posts_field);

    if (!empty($manual_posts)) {
        $post_ids = wp_list_pluck($manual_posts, 'ID');
        $args['post__in'] = $post_ids;
        $args['orderby'] = 'post__in';
    } else {
        $args['post__in'] = array(0);
    }
}


$posts_query = new WP_Query($args);

// conditional statement if the page is 'technology-stack' or not
$container_class = 'container mx-auto px-4 flex -mx-4 mb-[30px]';
$title_class = 'custom-card-title text-[20px] mb-4';
if (is_page('technology-stack')) {
    $container_class .= ' flex-start tech-stack';
    $title_class .= ' ml-[13%] tech-stack text-[30px] text-left';
} else {
    $container_class .= ' justify-center ';
    $title_class .= ' text-center';
}

// Display posts
if ($posts_query->have_posts()) :
    // Display the custom title if it exists
    if ($card_title) {
        echo '<h2 class="' . esc_attr($title_class) . '">' . esc_html($card_title) . '</h2>';
    }
    echo '<div class="' . esc_attr($container_class) . '">';
    while ($posts_query->have_posts()) : $posts_query->the_post();

        $title = get_the_title();
        $excerpt = get_the_excerpt();
        // Trim the excerpt to a certain number of characters and append '...'
        if (mb_strlen($excerpt) > 40) {
            $excerpt = mb_substr($excerpt, 0, 40) . '...';
        }
        $edit_link = get_edit_post_link();
        $post_type = get_post_type();

        // Default values for non-Products post types
        $team_members = get_field('select_members');
        $num_members = $team_members ? count($team_members) : 0;
        $team_image_url = get_field('team_image') ? get_field('team_image')['url'] : get_the_post_thumbnail_url();

        // Check if the post type is 'products'
        if ($post_type === 'products') {
            // Get custom fields for the 'products' post type
            $custom_thumbnail = get_field('product_thumbnail');
            $custom_excerpt = get_field('product_excerpt');

            // Set the fields if they exist
            if ($custom_thumbnail) {
                $thumbnail_url = $custom_thumbnail; // Since the return format is 'url'
            } else {
                $thumbnail_url = get_the_post_thumbnail_url(); // Fallback
            }
            if ($custom_excerpt) {
                $excerpt = $custom_excerpt;
            }
            $title = get_the_title(); // No change for title
?>
            <a href="<?php echo esc_url($edit_link); ?>" class="inline-block p-4 max-w-md mx-auto rounded-xl hover:scale-105 transition-transform duration-300 m-2 bg-[#97979724] shadow-md w-full h-auto">
                <div class="flex items-center space-x-4">

                    <div class="w-[150px] h-[130px] flex-shrink-0 bg-white rounded-lg overflow-hidden">

                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col justify-center flex-grow p-2">
                        <h2 class="text-xl font-bold leading-tight text-black break-words">
                            <?php echo esc_html($title); ?>
                        </h2>
                        <p class="text-gray-700 text-sm mt-1 break-words">
                            <?php echo wp_strip_all_tags($excerpt); ?>
                        </p>
                    </div>
                </div>
            </a>


        <?php

        } else {
        ?>
            <a href="<?php echo esc_url($edit_link); ?>" class="griditems grid grid-flow-col auto-cols-fr gap-8 rounded-xl hover:scale-105 transition-transform duration-300 m-4 ">
                <div class="relative inline-block bg-gray-100 rounded-lg shadow-md overflow-hidden mx-4 my-4 w-[330px] h-[200px]">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($team_image_url); ?>');">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70"></div>
                    </div>

                    <div class="absolute bottom-0 flex flex-col justify-end text-white" style="padding-left:5px; padding-right: 20px; padding-top:300px; padding-bottom: 20px;">
                        <div class="flex-1 p-1 bg-transparent mb- offs mb-5 ml-2">
                            <h2 class="text-[30px] text-white font-poppins font-bold leading-tight text-black mr-2 mt-[20px] font-sans">
                                <?php echo esc_html($title); ?>
                            </h2>
                            <p class="text-[#353434] text-white mt-[10px] text-[20px] font-sans">
                                <?php echo esc_html($excerpt); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </a>

<?php
        }
    endwhile;
    echo '</div>';
    wp_reset_postdata();
endif;
?>