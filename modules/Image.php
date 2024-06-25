<?php
if (get_row_layout() == 'image') {
    $image_source = get_sub_field('image_source');
    $image_url = get_sub_field('image_url');
    $image_upload = get_sub_field('image_upload');
    $image_upload_url = is_array($image_upload) ? $image_upload['url'] : '';

    // Determine the image source and display accordingly
    if ($image_source == 'upload' && $image_upload) {
        ?>
        <div class="flex items-center justify-top">
            <div class="image">
                <img src="<?php echo esc_url($image_upload_url); ?>" alt="<?php echo esc_attr($image_upload['alt']); ?>" class="uploaded-image w-35 h-auto rounded-lg">
            </div>
        </div>
        <?php
    } elseif ($image_source == 'url' && $image_url) {
        ?>
        <div class="flex items-center justify-center min-h-screen">
            <div class="image">
                <img src="<?php echo esc_url($image_url); ?>" alt="Image from URL" class="url-image w-32 h-auto rounded-lg">
            </div>
        </div>
        <?php
    }
}
?>
