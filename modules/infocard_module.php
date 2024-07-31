<?php
// Get ACF fields
$title = get_sub_field('title'); 
$description = get_sub_field('description'); 
$image = get_sub_field('image'); 

// Ensure the image field is available
if ($image) {
    $image_url = $image['url'];
    $image_alt = $image['alt'];
    if (empty($image_alt)) {
        $image_alt = $title; // Fallback to title if alt is empty
    }
}
?>

<div class="infocard w-full flex flex-col items-center text-center py-8">
    <?php if (!empty($title)) : ?>
        <h2 class="text-4xl font-bold mb-2"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if (!empty($description)) : ?>
        <p class="text-m mb-4"><?php echo esc_html($description); ?></p>
    <?php endif; ?>

    <?php if (!empty($image_url)) : ?>
        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="rounded-lg w-[500px]">
    <?php endif; ?>
</div>
