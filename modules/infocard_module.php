<?php

$title = get_sub_field('title');
$description = get_sub_field('description');
$image = get_sub_field('image');

if (mb_strlen($description) > 120) {
    $description = mb_substr($description, 0, 120) . '';
}


if ($image) {
    $image_url = $image['url'];
    $image_alt = $image['alt'];
    if (empty($image_alt)) {
        $image_alt = $title;
    }
}
?>

<div class="infocard flex flex-col items-center text-center pt-4 pb-8 m-auto w-[450px] bg-[#e8ddff] rounded-[25px] text-[#1f1048] mb-[20px]">
    <h2 class="text-[25px] font-bold mb-2 select-none"><?php echo esc_html($title); ?></h2>
    <p class="infocard-descr text-[14px] mb-4 select-none"><?php echo esc_html($description); ?></p>
    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="infocard-img rounded-lg w-[200px] h-[200px] object-cover">
</div>