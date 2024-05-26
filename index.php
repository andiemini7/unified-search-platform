<?php
get_header(); 
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-8">Unified Search Results</h1>
    
    <!-- Search Form -->
    <form action="/" method="get" class="flex justify-center mb-8">
        <input type="text" name="s" class="border border-gray-300 p-2 rounded-l-lg w-full max-w-md" placeholder="Search...">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r-lg">Search</button>
    </form>
    
    <!-- Search Results -->
    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while (have_posts()) : the_post(); ?>
                <div class="border border-gray-200 p-4 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-2"><a href="<?php the_permalink(); ?>" class="text-blue-500 hover:underline"><?php the_title(); ?></a></h2>
                    <p class="text-gray-700"><?php the_excerpt(); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            <?php 
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => __('« Previous', 'textdomain'),
                'next_text' => __('Next »', 'textdomain'),
            ]); 
            ?>
        </div>
    <?php else : ?>
        <p class="text-center text-gray-500">No results found. Please try a different search.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
