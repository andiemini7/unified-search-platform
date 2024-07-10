<?php


get_header();
?>

<?php

$teams = get_posts(array(
    'post_type' => 'teams',
    'posts_per_page' => -1,
));
?>


<div class="container mx-auto px-4 py-8">
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($teams as $team) : ?>
            <li class="border p-4 rounded shadow-lg team-card" data-team-id="<?php echo $team->ID; ?>">
                <?php 
                $team_image = get_field('team_image', $team->ID);
                if ($team_image) : ?>
                    <img src="<?php echo esc_url($team_image['url']); ?>" alt="<?php echo esc_attr($team_image['alt']); ?>" class="w-full h-48 object-cover mb-4 rounded">
                <?php endif; ?>
                <h3 class="text-xl font-semibold"><?php echo get_the_title($team->ID); ?></h3>
                <p class="mt-2"><strong>Description:</strong> <?php echo get_field('description', $team->ID); ?></p>
                <button class="mt-4 bg-gray-200 text-black px-4 py-2 rounded open-popup">View Details</button>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


<div id="side-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white h-full absolute right-0 p-8 overflow-y-auto w-full sm:w-2/3 md:w-1/2 lg:w-1/3 transform translate-x-full transition-transform">
        <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 close" style="font-size: 2rem;">&times;</button>
        <div id="team-details"></div>
    </div>
</div>

<style>
#side-modal .close {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 2rem; 
    outline: none;
   margin:10px
}
#side-modal .close:hover {
    color: #333;
}
</style>

<script>
jQuery(document).ready(function($) {
   
    $('.team-card').on('click', '.open-popup', function() {
        var teamId = $(this).closest('.team-card').data('team-id');
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'post',
            data: {
                action: 'get_team_details',
                team_id: teamId
            },
            success: function(response) {
                $('#team-details').html(response);
                $('#side-modal').removeClass('hidden');
                setTimeout(function() {
                    $('#side-modal .bg-white').removeClass('translate-x-full');
                }, 10); 
            }
        });
    });

    $('.close, #side-modal').on('click', function() {
        $('#side-modal .bg-white').addClass('translate-x-full');
        setTimeout(function() {
            $('#side-modal').addClass('hidden');
        }, 300);
    });

    
    $('#side-modal .bg-white').on('click', function(e) {
        e.stopPropagation();
    });
});
</script>

<?php get_footer(); ?>