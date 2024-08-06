<?php
if (get_row_layout() == 'image') {
    $image_source = get_sub_field('image_source');
    $image_url = get_sub_field('image_url');
    $image_upload = get_sub_field('image_upload');
    $image_upload_url = is_array($image_upload) ? $image_upload['url'] : '';

   
    if ($image_source == 'upload' && $image_upload) {
        ?>
        <div class="w-full flex flex-col items-center py-8">
            <div class="image">
                <img src="<?php echo esc_url($image_upload_url); ?>" alt="<?php echo esc_attr($image_upload['alt']); ?>" class="uploaded-image w-35 h-auto rounded-lg">
            </div>
        </div>
        <?php
    } elseif ($image_source == 'url' && $image_url) {
        ?>
        <div class="w-7/12 mx-auto flex flex-col items-center py-8">
            <div class="image">
                <img src="<?php echo esc_url($image_url); ?>" alt="Image from URL" class="url-image w-35 h-auto rounded-lg">
            </div>
        </div>
        <?php
    }
}
?>
