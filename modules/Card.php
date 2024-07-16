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
    echo '<div class="container mx-auto px-4 flex flex-wrap -mx-4">';
        while ($posts_query->have_posts()) : $posts_query->the_post();
            // Get the title and excerpt
            $title = get_the_title();
            $excerpt = get_the_excerpt();
            $edit_link = get_edit_post_link();
            ?>
            <a href="<?php echo esc_url($edit_link); ?>" class="block p-6 max-w-sm mx-auto rounded-xl hover:scale-105 transition-transform duration-300 m-4">
            <div class="relative inline-block bg-gray-100 rounded-lg shadow-md overflow-hidden mx-4 my-4" style="width: 330px; height: 400px;">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/image1.png');');">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50"></div>
                </div>
                <div class="absolute bottom-0 flex flex-col justify-end text-white" style="padding-left:5px; padding-right: 20px; padding-top:300px; padding-bottom: 20px;">
                    <!-- Post title -->
                    <div class="flex-1 p-1 bg-transparent mb-5 ml-2">
                        <h2 class="text-l font-light leading-tight font-serif text-white mr-2">
                            <?php echo esc_html($title); ?>
                        </h2>
                        <p class="text-white">
                            <?php echo esc_html($excerpt); ?>
                        </p>
                    </div>
                </div>
            </div>
            </a>
            <?php
        endwhile;
    echo '</div>';
    wp_reset_postdata();
endif;
?>