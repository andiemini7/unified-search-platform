<?php
$menu_name = 'product_menu'; 
$locations = get_nav_menu_locations(); 
$menu_items = [];
if (isset($locations[$menu_name])) {
    $menu_id = $locations[$menu_name];
    $menu_items_raw = wp_get_nav_menu_items($menu_id); 

    foreach ($menu_items_raw as $item) {
        if (empty($item->menu_item_parent)) {
            $menu_items[$item->ID] = [
                'item' => $item,
                'children' => []
            ];
        } else {
            $menu_items[$item->menu_item_parent]['children'][] = $item;
        }
    }
}
?>

<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid gap-y-8 md:grid-cols-2 lg:grid-cols-5 lg:gap-x-36 text-center md:text-left">
            
            <div class="block lg:hidden col-span-full mb-4 flex flex-col items-center">
                <?php 
                $footer_logo = get_field('footer_logo', 'option');
                $footer_text = get_field('footer_text', 'option');
                
                if ($footer_logo) {
                    echo '<img class="h-10 w-auto mb-2" src="' . esc_url($footer_logo) . '" alt="Footer Logo">';
                } else {
                    echo '<p class="text-sm font-normal leading-5 text-red-500">Footer logo is missing. Please add it in the general settings.</p>';
                    echo '<img class=" w-full mb-2" src="' . esc_url(get_template_directory_uri() . '/path/to/default-logo.png') . '" alt="Unified Search">';
                }
                if ($footer_text) {
                    echo '<p class="text-sm font-normal leading-5 text-gray-200">' . esc_html($footer_text) . '</p>';
                } else {
                    echo '<p class="text-sm font-normal leading-5 text-red-500">Footer text is missing. Please add it in the site settings.</p>';
                }
                ?>
            </div>

            <div class="hidden lg:block">
                <?php 
                if ($footer_logo) {
                    echo '<img class=" w-auto mb-2" src="' . esc_url($footer_logo) . '" alt="Footer Logo">';
                } else {
                    echo '<p class="text-sm font-normal leading-5 text-red-500">Footer logo is missing. Please add it in the general settings.</p>';
                    echo '<img class=" w-auto mb-2" src="' . esc_url(get_template_directory_uri() . '/path/to/default-logo.png') . '" alt="Unified Search">';
                }
                if ($footer_text) {
                    echo '<p class="text-sm font-normal leading-5 text-gray-200">' . esc_html($footer_text) . '</p>';
                } else {
                    echo '<p class="text-sm font-normal leading-5 text-red-500">Footer text is missing. Please add it in the site settings.</p>';
                }
                ?>
            </div>

            <?php foreach ($menu_items as $parent): ?>
                <div>
                    <h2 class="text-sm font-medium mb-2 leading-5"><?php echo esc_html($parent['item']->post_title); ?></h2>
                    <ul class="text-sm font-normal leading-5 text-gray-200">
                        <?php foreach ($parent['children'] as $child): ?>
                            <li class="mb-2">
                                <a href="<?php echo esc_url($child->url); ?>" class="hover:underline"><?php echo esc_html($child->title); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="text-center mt-6 lg:mt-8">
        <p class="text-sm text-gray-600">&copy; <?php echo date("Y"); ?> All Rights Reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>















