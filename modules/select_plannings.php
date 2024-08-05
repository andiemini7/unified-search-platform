<?php
$post_id = get_the_ID();
$selected_plannings = get_sub_field('select_plannings');

if ($selected_plannings) {
   
    $planning_ids = wp_list_pluck($selected_plannings, 'ID');

    $categories = get_terms([
        'taxonomy' => 'planning_category',
        'hide_empty' => false,
    ]);

    if (!is_wp_error($categories) && !empty($categories)) {
        echo '<div class="planning-container max-w-7xl mx-auto px-4">';

        foreach ($categories as $category) {
          
            $query_args = array(
                'post_type' => 'plannings',
                'post__in'  => $planning_ids,
                'posts_per_page' => -1,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'planning_category',
                        'field' => 'term_id',
                        'terms' => $category->term_id,
                    ),
                ),
            );

            $query = new WP_Query($query_args);

            if ($query->have_posts()) {
                // Shfaq emrin e kategorisë
                // echo '<h2 class="category-title text-2xl font-bold mb-6">' . esc_html($category->name) . '</h2>';

              
                echo '<div class="planning-cards-icon grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 mt-10">';
                while ($query->have_posts()) {
                    $query->the_post();
                    
                    $plan_id = get_the_ID();
                    $plannings = get_field('planing'); 

                    if ($plannings) {
                        foreach ($plannings as $planning) {
                            $title = isset($planning['title']) ? $planning['title'] : '';
                            $description = isset($planning['description']) ? $planning['description'] : '';
                            $schedule_title = isset($planning['schedule_title']) ? $planning['schedule_title'] : '';
                            $schedule_time = isset($planning['schedule_time_']) ? $planning['schedule_time_'] : '';

                            $icon_url = isset($planning['icon']) ? $planning['icon'] : ''; 
                            $image_url = isset($planning['image']) ? $planning['image'] : ''; 

                            if ($icon_url) {
                                echo '<div class="planning-card-icon bg-purple-100 p-8 rounded-lg mt-10 shadow-lg flex flex-col">';
                                echo '<div class="icon mb-4"><img src="' . esc_url($icon_url) . '" alt="Icon" class="icon-img " style="max-width:170%;"/></div>';
                                if ($image_url) {
                                    echo '<div class="image mb-4"><img src="' . esc_url($image_url) . '" alt="Image" class="w-full h-auto"/></div>';
                                }
                                echo '<h2 class="title text-xl font-semibold mb-2 text-gray-800 " style="margin-bottom:10px; margin-top:30px;">' . esc_html(str_replace(array('<p>', '</p>'), '', $title)) . '</h2>';
                                echo '<p class="description text-md mb-4 text-gray-700 leading-relaxed">' . esc_html(str_replace(array('<p>', '</p>'), '', $description)) . '</p>';
                                echo '</div>';
                            }
                        }
                    }
                }
                echo '</div>'; 

               
                echo '<div class="planning-cards-no-icon grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">';
                while ($query->have_posts()) {
                    $query->the_post();

                    $plan_id = get_the_ID();
                    $plannings = get_field('planing'); 

                    if ($plannings) {
                        foreach ($plannings as $planning) {
                            $title = isset($planning['title']) ? $planning['title'] : '';
                            $description = isset($planning['description']) ? $planning['description'] : '';
                            $schedule_title = isset($planning['schedule_title']) ? $planning['schedule_title'] : '';
                            $schedule_time = isset($planning['schedule_time_']) ? $planning['schedule_time_'] : '';

                            $icon_url = isset($planning['icon']) ? $planning['icon'] : ''; 
                            $image_url = isset($planning['image']) ? $planning['image'] : ''; 

                            if (!$icon_url) {
                                echo '<div class="planning-card-no-icon bg-purple-100 p-6 rounded-lg shadow-lg">';
                                if ($image_url) {
                                    echo '<div class="image mb-4"><img src="' . esc_url($image_url) . '" alt="Image" class="w-full h-auto"/></div>';
                                }
                                
                                echo '<h2 class="title text-xl font-semibold mb-2 text-gray-800">' . esc_html(str_replace(array('<p>', '</p>'), '', $title)) . '</h2>';
                                echo '<p class="description text-md mb-4 text-gray-700 leading-relaxed">' . esc_html(str_replace(array('<p>', '</p>'), '', $description)) . '</p>';
                                echo '<p class="schedule-title text-md font-semibold mb-1 text-black">' . esc_html(str_replace(array('<p>', '</p>'), '', $schedule_title)) . '</p>';
                                echo '<p class="schedule-time bg-white border border-gray-300 rounded-lg p-2 text-sm text-gray-900 mt-2 text-center" style="margin-right:130px;"">' . esc_html(str_replace(array('<p>', '</p>'), '', $schedule_time)) . '</p>';
                                echo '</div>';
                            }
                        }
                    }
                }
                echo '</div>'; 
            }
        }

        echo '</div>';
    } else {
        echo '<p class="text-center text-gray-600 text-lg">No planning categories found.</p>';
    }

    wp_reset_postdata();
} else {
    echo '<p class="text-center text-gray-600 text-lg">No selected plannings found.</p>';
}
?>

<style>
.planning-container {
    max-width: 1550px; 
    margin: 0 auto; 
}

.planning-card {
    background-color: #EDE7F6; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
}

.schedule-time {
    background-color: #ffffff;
    border-radius: 0.5rem; 
    padding: 0.5rem; 
    text-align: center;
    color: #1f2937; 
    position: relative; 
    box-shadow:
        0 6px 1px rgba(206, 189, 255, 1), 
        0 0 0 1px rgba(206, 189, 255, 1), 
        0 0 0 1px rgba(206, 189, 255, 1),
        0 8px 15px rgba(0, 0, 0, 0);
}
@media (max-width: 640px) { 
    .planning-cards-icon {
        grid-template-columns: 1fr !important; 
        gap: 4px; 
    }

    .planning-card-icon {
        padding: 1rem !important; 
        margin: 0.9rem 0; 
    }

    .planning-cards-no-icon {
        grid-template-columns: 1fr !important; 
    }
}

</style>