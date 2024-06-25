<?php
// Get ACF fields
$image_block = get_sub_field('image_block'); // Get the image field
$title = get_sub_field('title'); // Get the title field
$description = get_sub_field('description'); // Get the description field

// Ensure the image field is available
if ($image_block) {
    $image_url = $image_block['url'];
    $image_alt = $image_block['alt'];
    if (empty($image_alt)) {
        $image_alt = $title; // Fallback to title if alt is empty
    }
}
?>

<<<<<<< Updated upstream
<div class="w-full flex flex-col items-center text-center py-8">
=======
<div class="w-full flex flex-col items-center text-center py-8 background-color:#E7F0F9;">
>>>>>>> Stashed changes
    <div class="text-content">
        <?php if (!empty($title)) : ?> <br>
            <h2 class="text-4xl font-bold mb-2"><?php echo esc_html($title); ?></h2>
        <?php endif; ?> <br>
        <?php if (!empty($description)) : ?>
            <p class="text-m mb-4"><?php echo esc_html($description); ?></p>
        <?php endif; ?> <br><br>
    </div>
    <div class="image-content">
        <?php if (!empty($image_url)) : ?>
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" style="width:1000px; height:400px;" class="rounded-lg">
        <?php endif; ?> <br><br> 
    </div>
</div>

