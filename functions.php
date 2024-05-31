<?php
// Include setup.php
require_once get_template_directory() . '/setup.php';



// ACF Repeater
function display_clients() {

    if( have_rows('clients') ): ?>
        <div class="client-wrapper">
            <?php while( have_rows('clients') ): the_row();
                $client_name = get_sub_field('client_name');
                $client_description = get_sub_field('client_description');
                $client_profile = get_sub_field('client_profile'); 
                ?>
                <div class="client-wrappers">
                    <?php if( $client_profile ): ?>
                        <img src="<?php echo esc_url($client_profile['url']); ?>" width="100" alt="<?php echo esc_attr($client_name); ?>" />
                    <?php endif; ?>
                    <h1><?php echo esc_html($client_name); ?></h1>
                    <span style="display:inline-block; width:500px;"><?php echo esc_html($client_description); ?></span>
                </div> 
            <?php endwhile; ?>
        </div>
    <?php endif;
}
?>