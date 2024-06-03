<?php get_header(); ?>

<div class="mx-auto container">
<form action="/" method="get" class="flex justify-center my-4">
        <input type="text" name="s" class="border border-gray-300 p-2 rounded-l w-full max-w-md" placeholder="Search...">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r">Search</button>
    </form>
    <div class="posts-container flex justify-center flex-wrap gap-[34px] my-5">
        <?php
        while (have_posts()) : the_post();

            $post_thumbnail_url = get_the_post_thumbnail_url();
            $content = wp_trim_words(get_the_content(), 15, null);
            $author_name = ucfirst(get_the_author());
            $category = get_the_category();
            $category_name = $category ? get_cat_name($category[0]->term_id) : '';

        ?>
            <a href="<?php the_permalink(); ?>" class="w-[330px]">
                <div class="post-item h-[388px] w-[330px] bg-[#F7F9FF] shadow-md hover:shadow-[#51606F]/30 p-4 rounded-2xl
                transition ease-in-out delay-10 hover:scale-105">
                    <?php if ($post_thumbnail_url) : ?>
                        <img class="w-full h-[180px] rounded-lg object-cover" src="<?php echo $post_thumbnail_url; ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <div class="mt-4">
                        <?php if ($category_name) : ?>
                            <p class="text-[#2F628C] font-medium"><?php echo $category_name; ?></p>
                        <?php endif; ?>
                        <?php if (get_the_title()) : ?>
                            <h4 class="text-[#001D33] text-lg font-medium mt-2"><?php the_title(); ?></h4>
                        <?php endif; ?>
                        <?php if ($content) : ?>
                            <p class="text-[#51606F] text-sm mt-2"><?php echo $content; ?></p>
                        <?php endif; ?>
                        <?php if ($author_name) : ?>
                            <p class="text-[#51606F] text-sm font-medium mt-3"><?php echo $author_name; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php endwhile; ?>
    </div>

    <div class="flex justify-center mb-5">
        <button id="see-more" class="text-[#2F628C] border border-solid border-[#2F628C] rounded-full py-2 px-4">See More</button>
    </div>
</div>

<?php get_footer(); ?>
