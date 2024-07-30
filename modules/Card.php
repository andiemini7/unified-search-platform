<?php
// Get the selected post type and selection type from ACF fields
$post_type = get_sub_field('manual_post_type');
$selection_type = get_sub_field('selection_type');

// Initialize the query arguments
$args = array(
    'post_type' => $post_type,
    'posts_per_page' => ($selection_type === 'latest') ? 10 : -1, // Limit to 10 posts if 'latest' is selected
);

// If manual selection, get the selected posts
if ($selection_type === 'manual') {
    // Determine the correct relationship field based on the selected post type
    $manual_posts_field = 'manual_' . $post_type;
    $manual_posts = get_sub_field($manual_posts_field);

    if (!empty($manual_posts)) {
        $post_ids = wp_list_pluck($manual_posts, 'ID'); // Collect IDs of manually selected posts
        $args['post__in'] = $post_ids; // Limit query to these specific post IDs
        $args['orderby'] = 'post__in'; // Preserve the order of the selected posts
    } else {
        $args['post__in'] = array(0); // If no posts are selected, make sure no posts are queried
    }
}

// Query the posts
$posts_query = new WP_Query($args);

// Display posts
if ($posts_query->have_posts()) :
    echo '<div class="container mx-auto px-4 flex flex-wrap -mx-4 justify-start">';
    while ($posts_query->have_posts()) : $posts_query->the_post();
        // Get the title and excerpt
        $title = get_the_title();
        $excerpt = get_the_excerpt();
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
            <a href="<?php echo esc_url($edit_link); ?>" class="block p-6 max-w-sm mx-auto rounded-xl hover:scale-105 transition-transform duration-300 m-4 bg-[#97979724] w-[350px]">
                <div class="relative inline-block bg-gray-100 rounded-lg shadow-md overflow-hidden mx-4 my-4 table-cell w-[330px] h-[250px]">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo esc_url($team_image_url); ?>');">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50"></div>
                    </div>
                </div>
                <h2 class="text-[30px] font-poppins font-bold leading-tight text-black mr-2 mt-[20px] font-sans">
                    <?php echo esc_html($title); ?>
                </h2>
                <p class="text-[#353434] mt-[10px] text-[20px] font-sans">
                    <?php echo esc_html($excerpt); ?>
                </p>
                <p class="text-[#353434] mt-[10px] text-[20px] font-sans">
                    <?php echo esc_html($num_members) . ' members'; ?>
                </p>
            </a>
<?php
        }
    endwhile;
    echo '</div>';
    wp_reset_postdata();
endif;
?>
