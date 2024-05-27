<?php get_header(); ?>

<div class="container mx-auto p-4">

    <nav class="bg-gray-800 p-4 mb-4">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'home-menu',
            'container' => false,
            'menu_class' => 'flex justify-center space-x-4',
            'link_before' => '<span class="text-white">',
            'link_after' => '</span>',
        ));
        ?>
    </nav>


    <nav class="bg-gray-800 p-4 mb-4">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'unified-search-menu',
            'container' => false,
            'menu_class' => 'flex justify-center space-x-4',
            'link_before' => '<span class="text-white">',
            'link_after' => '</span>',
        ));
        ?>
    </nav>


    <nav class="bg-gray-800 p-4 mb-4">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'contact-us-menu',
            'container' => false,
            'menu_class' => 'flex justify-center space-x-4',
            'link_before' => '<span class="text-white">',
            'link_after' => '</span>',
        ));
        ?>
    </nav>

    <h1 class="text-4xl font-bold text-center my-4">Unified Search Results</h1>
    

    <form action="/" method="get" class="flex justify-center my-4">
        <input type="text" name="s" class="border border-gray-300 p-2 rounded-l w-full max-w-md" placeholder="Search...">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r">Search</button>
    </form>
    
   
    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php while (have_posts()) : the_post(); ?>
                <div class="border border-gray-200 p-4 rounded shadow">
                    <h2 class="text-2xl font-bold mb-2"><a href="<?php the_permalink(); ?>" class="text-blue-500"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        
    
        <div class="my-4">
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
