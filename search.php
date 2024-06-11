<?php get_header(); ?>

<?php $search_value = isset($_GET['s']) ? $_GET['s'] : ''; ?>

<div class="mx-auto container">
<form action="/" method="get" class="flex justify-center my-4">
        <input type="text" name="s" class="border border-gray-300 p-2 rounded-l w-full max-w-md" placeholder="Search...">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r">Search</button>
    </form>
    <div id="posts-container" class="flex justify-start flex-wrap gap-[34px] my-5">
        <!-- Here goes the posts from the see-more.js file -->
    </div>

    <div class="flex justify-center mb-5">
        <button id="see-more" data-endpoint="<?php echo get_rest_url(null, '/wp/v1/search?s='.strval($search_value)); ?>"
         class="text-[#2F628C] border border-solid border-[#2F628C] rounded-full py-2 px-4"
         >Show More</button>
    </div>
</div>

<?php get_footer(); ?>
