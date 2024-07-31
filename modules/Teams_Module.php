<?php
$teams = get_posts(array(
    'post_type' => 'teams',
    'posts_per_page' => -1,
));
?>

<div class="container mx-auto px-4 ">
    <ul class="griditems grid grid-flow-col auto-cols-fr gap-8">
        <?php foreach ($teams as $team) : ?>
            <li class="relative overflow-hidden border rounded-lg shadow-lg team-card p-[15px] w-auto hover:scale-105 m-4 mb-[100px]" data-team-id="<?php echo $team->ID; ?>">
                <?php 
                  $team_image = get_field('team_image', $team->ID);
                  if ($team_image) : ?>
                  <div class="w-full bg-cover bg-center rounded-lg h-[75%]" style="background-image: url('<?php echo esc_url($team_image['sizes']['thumbnail']); ?>');">
                  </div>
                <?php endif; ?>
                <div class="absolute inset-0 flex flex-col items-start justify-end p-4 bg-black bg-opacity-50 text-white font-semibold open-popup">
                    <span class="mb-2 text-md text-black"><?php echo get_the_title($team->ID); ?></span>
                    <div class="mt-2 flex items-center text-xl font-bold">
                        <?php
                        $team_members = get_field('select_members', $team->ID);
                        $num_members = $team_members ? count($team_members) : 0;
                        ?>
                        <span class="text-black"><?php echo $num_members . ' members'; ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </div>
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
    margin: 10px;
}
#side-modal .close:hover {
    color: #333;
}
.team-card {
    cursor: pointer;
    background-color: #f0f0f0;
    height: 350px;
    border-radius: 1rem;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.team-card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
}
.open-popup {
    background-color: transparent;
    border: none;
    outline: none;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 1rem;
    color: white;
    font-weight: bold;
    height: 100%;
    border-radius: 1rem;
    transition: background-color 0.3s ease;
}
.open-popup:hover {
    background-color: rgba(0, 0, 0, 0.2);
}
.open-popup span {
    text-align: left;
}
.open-popup .text-md {
    font-size: 1rem; 
}
.open-popup .text-xl {
    font-size: 1.25rem;
    font-weight: bold;
}
.open-popup .h-6 {
    height: 1.5rem; 
    width: 1.5rem; 
}

@media (max-width: 768px) {
    .griditems{
    grid-auto-flow: row;
}
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
