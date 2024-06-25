<?php
if ($layout == 'card') {
    $name = get_sub_field('name');
    $date = get_sub_field('date');
    $description = get_sub_field('description');
    $image = get_sub_field('image'); // Assuming the field name for the user image is 'image'

    // Check if image is an array and get the URL if so
    $image_url = is_array($image) ? $image['url'] : $image;

    ?>
   <div class="relative bg-gray-100 rounded-lg shadow-md overflow-hidden mx-4 my-4" style="width: 330px; height: 400px; margin:16px;">
    <div class="absolute inset-0 m-0 h-2/3 w-full overflow-hidden bg-transparent bg-cover bg-center text-gray-700">
        <img src="http://unified-search-platform.test/wp-content/uploads/2024/06/image1.png" class="w-full h-full object-cover rounded-lg">
        <div class="absolute inset-0 w-full h-full" style="background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));"></div>
    </div>
        <div class="absolute inset-0 flex flex-col justify-end p-6 text-white">
            <!-- Top section with user image, name, and date -->
            <div class="flex items-baseline justify-between">
                <div class="flex items-center ml-3">
                <span class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 mr-4 inline-block" style="width: 25px; height: px;">
                    <img src="<?php echo esc_url($image_url); ?>" alt="User Image" class="w-full h-full object-cover">
                </span>
                <!-- Name and date -->
                <span class="flex items-center ml-2">
                    <h2 class="text-l font-light leading-tight font-serif text-white mr-2">
                        <?php echo esc_html($name); ?>
                    </h2>
                    <span class="text-gray-400 text-base ml-2">&bull;</span> <!-- Bullet -->
                    <span class="text-sm text-gray-300 ml-2"><?php echo esc_html($date); ?></span> <!-- Date with smaller text size -->
                </span>
            </div>
            </div>

            <div class="flex-1 p-1 rounded-lg bg-transparent"> <!-- Transparent background -->
                <p class="text-white">
                    <?php echo esc_html($description); ?>
                </p>
            </div>
        </div>
    </div>
    <?php
}
?>
