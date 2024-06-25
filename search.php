<?php get_header(); ?>

<?php $search_value = isset($_GET['s']) ? $_GET['s'] : ''; ?>

<div class="mx-auto container">
    <div id="page-container" class="flex justify-start flex-wrap gap-[34px] my-5">
        <!-- Container for pages -->
    </div>
    <div id="posts-container" class="flex justify-start flex-wrap gap-[34px] my-5">
    <!-- Container for posts -->
    </div>
    <div id="trello-container" class="flex justify-start flex-wrap gap-[34px] my-5">
        <!-- Container for trello -->
    </div>

    <div class="flex justify-center mb-5">
        <button id="see-more" 
                data-endpoint1="<?php echo get_rest_url(null, '/wp/v1/pages?s='.strval($search_value)); ?>"
                data-endpoint2="<?php echo get_rest_url(null, '/wp/v1/posts?s='.strval($search_value)); ?>"
                data-endpoint3="<?php echo get_rest_url(null, '/wp/v1/trello?s='.strval($search_value)); ?>"
                class="text-[#2F628C] border border-solid border-[#2F628C] rounded-full py-2 px-4"
        >Show More</button>
    </div>
</div>

<?php get_footer(); ?>
