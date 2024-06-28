<?php
if (get_row_layout() == 'card') {
    $name = get_sub_field('name');
    $date = get_sub_field('date');
    $description = get_sub_field('description');
    $image = get_sub_field('image');
    $image_url = is_array($image) ? $image['url'] : '';

    // Display content
    ?>
    <div class="relative bg-gray-100 rounded-lg shadow-md overflow-hidden mx-4 my-4 " style="width: 330px; height: 400px; margin:auto">
        <div class="absolute inset-0 bg-cover bg-center " style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/image1.png');">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50"></div>
        </div>
        <div class="absolute bottom-0 flex flex-col justify-end text-white" style="padding-left:5px; padding-right: 20px; padding-top:300px; padding-bottom: 20px;">
            <!-- Top section with user image, name, and date -->
            <div class="flex items-baseline justify-between mb-3 ml-3">
                <div class="flex items-center">
                    <span class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 inline-block" style="width: 25px; height: 25px;">
                        <img src="<?php echo esc_url($image_url); ?>" alt="User Image" class="w-full h-full object-cover">
                    </span>
                    <!-- Name and date -->
                    <span class="flex items-center ml-2">
                        <h2 class="text-l font-light leading-tight font-serif text-white mr-2">
                            <?php echo esc_html($name); ?>
                        </h2>
                        <span class="text-gray-400 text-base">&bull;</span> 
                        <span class="text-sm text-gray-300 ml-2"><?php echo esc_html($date); ?></span>
                    </span>
                </div>
            </div>

            <div class="flex-1 p-1 bg-transparent mb-5 ml-2"> 
                <p class="text-white">
                    <?php echo esc_html($description); ?>
                </p>
            </div>
        </div>
    </div>
<?php
}
?>
