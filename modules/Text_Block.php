<?php 
     $id = get_the_id();
    //  var_dump($id);
    $text = get_sub_field('text_block', $id);
    // var_dump($text);
    $image = get_sub_field('image_block');

?>

<div class="w-full">
    <div class="p-8 bg-white text-center background-color:#E7F0F9;">
        <p class="text-lg"><?php echo esc_html($text); ?></p>
        <img src="<?php echo esc_url( $image['url'] ); ?>"  style="height:100px;margin:auto" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
    </div>
</div>