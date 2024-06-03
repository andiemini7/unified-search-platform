<?php
/* Template Name: Modules Page */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        while (have_posts()) : the_post();
            the_content();

            $modules = get_field('select_modules');
            if ($modules):
                echo '<div class="modules-wrapper">';
                foreach ($modules as $post):
                    setup_postdata($post);
                    if (have_rows('module_content')):
                        while (have_rows('module_content')): the_row();
                            if (get_row_layout() == 'text_block'):
                                echo '<div class="module-text-block">' . get_sub_field('text_block') . '</div>';
                            elseif (get_row_layout() == 'image_block'):
                                $image = get_sub_field('image_block');
                                if ($image):
                                    echo '<div class="module-image-block"><img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"></div>';
                                endif;
                            endif;
                        endwhile;
                    endif;
                endforeach;
                wp_reset_postdata();
                echo '</div>';
            endif;
        endwhile; // End of the loop.
        ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
