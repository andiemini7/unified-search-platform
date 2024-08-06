<?php
// Fetch the post ID and ACF fields
$post_id = get_the_ID();
$icon = get_field('icon', $post_id);
$sub_title = get_field('sub_title', $post_id);
$description = get_field('description', $post_id);
$bullet_points = get_field('bullet_points', $post_id);
?>

<div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <?php if ($icon): ?>
        <img class="w-full h-32 object-cover" src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($sub_title); ?>">
    <?php endif; ?>
    <div class="p-4">
        <?php if ($sub_title): ?>
            <h2 class="text-xl font-semibold text-gray-800 mb-2"><?php echo esc_html($sub_title); ?></h2>
        <?php endif; ?>
        <?php if ($description): ?>
            <p class="text-gray-600 mb-4"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
        <?php if ($bullet_points): ?>
            <ul class="list-disc pl-5">
                <?php foreach ($bullet_points as $point): ?>
                    <li class="text-gray-600"><?php echo esc_html($point['bullet_point']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
