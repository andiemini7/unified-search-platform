<?php get_header(); ?>

<?php

$args = array(
    'post_type' => 'team-member'
);

$team_members = new WP_Query($args);

if($team_members->have_posts()):
    while($team_members->have_posts()): $team_members->the_post();
        // Fetch custom field for the current post
        $locations = get_field('locations'); 
        ?>
        <div style="width: 50%; border:1px solid black; margin:5px; padding:5px 10px;">
            <h1><?php the_title(); ?></h1>
            <span><?php the_post_thumbnail(); ?></span>
            <p><?php the_content(); ?></p>
        <?php foreach($locations as $location): ?>
            <p>Location: <?php echo $location->post_title ?></p>
        <?php endforeach; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endwhile;
endif; ?>

<?php get_footer(); ?>
