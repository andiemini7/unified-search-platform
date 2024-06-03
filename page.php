<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) : the_post();
            the_content();

            $selected_modules = get_post_meta(get_the_ID(), '_selected_modules', true);
            if ($selected_modules) {
                foreach ($selected_modules as $module_id) {
                    echo do_shortcode('[module id="' . $module_id . '"]');
                }
            }
        endwhile; // End of the loop.
        ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
