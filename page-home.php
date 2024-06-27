<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<div class="content-area">
    <main class="site-main" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            // Check if the flexible content field has rows of data.
            if ( have_rows( 'modules' ) ) :

                // Loop through the rows of data.
                while ( have_rows( 'modules' ) ) : the_row();

                    if ( get_row_layout() == 'text_block') : ?>
                        <div class="text-block">
                            <p><?php the_sub_field( 'text_block' ); ?></p>
                            
                        </div>
                        <div class="image-block">
                            <?php
                            $image = get_sub_field( 'image_block' );
                            if ( $image ) : ?>
                                <img src="<?php echo esc_url( $image['url'] ); ?>"  style="height:100px" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                            <?php endif; ?>
                        </div>
                        <div class="card">
                            <h3><?php the_sub_field( 'name' ); ?></h3>
                            <p><?php the_sub_field( 'description' ); ?></p>
                            <p><?php the_sub_field( 'date' ); ?></p>
                            <?php
                            $card_image = get_sub_field( 'image' );
                            if ( $card_image ) : ?>
                                <img src="<?php echo esc_url( $card_image['url'] ); ?>" alt="<?php echo esc_attr( $card_image['alt'] ); ?>" />
                            <?php endif; ?>
                        </div>
                        </div>
                    <?php
                    elseif ( get_row_layout() == 'card' ) : ?>
                        <div class="card">
                            <h3><?php the_sub_field( 'name' ); ?></h3>
                            <p><?php the_sub_field( 'description' ); ?></p>
                            <p><?php the_sub_field( 'date' ); ?></p>
                            <?php
                            $card_image = get_sub_field( 'image' );
                            if ( $card_image ) : ?>
                                <img src="<?php echo esc_url( $card_image['url'] ); ?>" alt="<?php echo esc_attr( $card_image['alt'] ); ?>" />
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;

                endwhile;

            else :

                // No layouts found.
                echo '<p>No modules found.</p>';

            endif;

        // End the loop.
        endwhile;
        ?>
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
