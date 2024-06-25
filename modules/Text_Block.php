<?php
// Get ACF fields
$text_block = get_sub_field('text_block');
?>

<div class="w-full">
    <div class="p-8 bg-white text-center background-color:#E7F0F9;">
        <p class="text-lg"><?php echo esc_html($text_block); ?></p>
    </div>
</div>
