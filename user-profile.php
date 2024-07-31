<?php
/* Template Name: User Profile */

get_header(); 

// Get the current logged-in user's ID
$current_user_id = get_current_user_id();

// Get user meta data
$user_full_name = get_field('full_name', 'user_' . $current_user_id);
$user_email = get_field('email', 'user_' . $current_user_id);
$user_phone = get_field('phone', 'user_' . $current_user_id);
$user_address = get_field('address', 'user_' . $current_user_id);
$user_role = get_field('role', 'user_' . $current_user_id);
$user_picture = get_field('user_picture', 'user_' . $current_user_id);
$experience = get_field('experience', 'user_' . $current_user_id);
$age = get_field('age', 'user_' . $current_user_id);
$gender = get_field('gender', 'user_' . $current_user_id);
$language = get_field('language', 'user_' . $current_user_id);
$education_level = get_field('education_level', 'user_' . $current_user_id);
$user_about = get_field('about', 'user_' . $current_user_id);
$user_member_since = get_field('member_since', 'user_' . $current_user_id);
$user_tags = get_field('user_tags', 'user_' . $current_user_id);

// Default cover image
$default_cover_image = get_template_directory_uri() . '/assets/images/cover5.png';

// Fetch the team data based on the user ID
$args = array(
    'post_type' => 'teams',
    'meta_query' => array(
        array(
            'key' => 'select_members',
            'value' => '"' . $current_user_id . '"',
            'compare' => 'LIKE'
        )
    )
);
$team_query = new WP_Query($args);

$team_name = '';
$team_description = '';
$team_projects = array();
$team_leader = '';

if ($team_query->have_posts()) :
    while ($team_query->have_posts()) : $team_query->the_post();
        $team_name = get_field('name_team');
        $team_description = get_field('description');
        $team_projects = get_field('project');
        $team_leader = get_field('team_leader');
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No team information found for this user.</p>';
endif;
?>


    <div class="container mx-auto py-8 px-4">
        <!-- Cover Section -->
        <div class="relative mb-6">
            <img src="<?php echo $default_cover_image; ?>" alt="Cover Image" class="w-full h-64 object-cover">
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                    <?php if ($user_picture): ?>
                        <img src="<?php echo esc_url($user_picture); ?>" alt="<?php echo esc_attr($user_full_name); ?>" class="w-full h-full object-cover">
                    <?php endif; ?>
                </div>
            </div>
       

        <!-- User Info -->
        <div class="text-center mt-4">
            <h1 class="text-2xl font-bold"><?php echo esc_html($user_full_name); ?></h1>
            <p class="text-blue-600"><?php echo esc_html($user_role); ?></p>
            <div class="flex justify-center items-center space-x-4 mt-2">
                <span class="flex items-center space-x-1">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
</svg>

                    <span><?php echo esc_html($user_address); ?></span>
                </span>
                <span class="flex items-center space-x-1">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4M5 7h14M4 21h16a2 2 0 002-2V7H2v12a2 2 0 002 2z"></path></svg>
                    <span>Member since,<?php echo esc_html($user_member_since); ?></span>
                </span>
            </div>
            
        </div>

         <!-- User Tags -->
    <div class="flex justify-center mt-4 space-x-2">
        <?php if ($user_tags): ?>
            <?php
            $tags = explode(',', $user_tags);
            foreach ($tags as $tag):
                $tag = trim($tag);
            ?>
                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded"><?php echo esc_html($tag); ?></span>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


        <div class="flex flex-col lg:flex-row gap-8 mt-8">
            <!-- Left Section -->
            <div class="w-full lg:w-1/3 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                <div class="mb-4">
                <h3 class="text-lg font-medium flex items-center">
                    <svg class="w-7 h-7 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                    Experience:
                </h3>
                <p class="text-gray-600"><?php echo esc_html($experience); ?></p>
            </div>
            <div class="mb-4">
                <h3 class="text-lg font-medium flex items-center">
                    <svg class="w-7 h-7 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                   </svg>

                    </svg>
                    Age:
                </h3>
                    <p class="text-gray-600"><?php echo esc_html($age); ?></p>
                </div>
               
                <div class="mb-4">
                <h3 class="text-lg font-medium flex items-center">
                    <svg class="w-7 h-7 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Gender:
                </h3>
                    <p class="text-gray-600"><?php echo esc_html($gender); ?></p>
                </div>
                <div class="mb-4">
                <h3 class="text-lg font-medium flex items-center">
                    <svg class="w-7 h-7 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                    </svg>
                    </svg>
                    Language:
                </h3>
                    <p class="text-gray-600"><?php echo esc_html($language); ?></p>
                </div>
                <div class="mb-4">
                <h3 class="text-lg font-medium flex items-center">
                    <svg class="w-7 h-7 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    </svg>
                    Education Level:
                </h3>
                    <p class="text-gray-600"><?php echo esc_html($education_level); ?></p>
                </div>
            </div>

            <!-- Right Content -->
            <div class="w-full lg:w-2/3 bg-white p-6 rounded-lg shadow-md">
                <!-- About Section -->
                <?php if ($user_about): ?>
            
                <h2 class="text-xl font-semibold mb-4">About</h2>
                <div class="mb-4"><?php echo $user_about; ?></div>
           

                <!-- Team Information -->
                <div>
                    <?php if ($team_name): ?>
                        <h2 class="text-xl font-semibold mb-4">Team Information</h2>
                        <p class="mb-2"><strong>Team Name:</strong> <?php echo esc_html($team_name); ?></p>
                        <p class="mb-4"><strong>Team Description:</strong> <?php echo esc_html($team_description); ?></p>
                        <?php if ($team_leader): ?>
                            <p class="mb-4"><strong>Team Leader:</strong> <?php echo esc_html($team_leader->post_title); ?></p>
                        <?php endif; ?>
                        <?php if ($team_projects): ?>
                            <h3 class="text-lg font-semibold mb-2">Projects</h3>
                            <ul class="list-disc pl-5">
                                <?php foreach ($team_projects as $project): ?>
                                    <li class="mb-1">
                                        <a class="text-blue-500 hover:underline" href="<?php echo get_permalink($project->ID); ?>"><?php echo esc_html($project->post_title); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                </div>
        <?php endif; ?>
    </div>
            </div>
        </div>
    </div>




<?php get_footer(); ?>
