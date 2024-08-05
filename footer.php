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

<footer class="bg-[#e0e0e0] py-8">
    <div class="container mx-auto px-4 mr-auto">
        <div class="footer-container grid gap-y-8 grid-cols-[repeat(auto-fit,_minmax(0,_1fr))] justify-center text-center md:text-left">
            <div class="block lg:hidden col-span-full mb-4 flex flex-col items-center">
                <?php
                $footer_logo = get_field('footer_logo', 'option');
                $footer_text = get_field('footer_text', 'option');

                if ($footer_logo) {
                    echo '<img class="h-[80px] w-auto" src="https://i.ibb.co/bv8p1pn/starlabslogo.png' . '" alt="Footer Logo">';
                } else {
                    echo '<img class="w-full mb-2" src="' . esc_url(get_template_directory_uri() . '/path/to/default-logo.png') . '" alt="Unified Search">';
                }
                if ($footer_text) {
                    echo '<p class="text-sm font-normal leading-5 text-gray-200">' . esc_html($footer_text) . '</p>';
                }
                ?>
            </div>

            <?php foreach ($menu_items as $parent) : ?>
                <div class="footer-items flex flex-col items-center md:items-center">
                    <h2 class="text-lg font-medium mb-2 leading-5 font-semibold"><?php echo esc_html($parent['item']->post_title); ?></h2>
                    <ul class="text-sm font-normal leading-5 text-gray-700 text-center">
                        <?php foreach ($parent['children'] as $child) : ?>
                            <li class="mb-2">
                                <a href="<?php echo esc_url($child->url); ?>" class="hover:underline"><?php echo esc_html($child->title); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <hr class="border-[#91919170] mx-[8%] my-[20px]">
    <div class="flex justify-between items-center">
        <?php
        if ($footer_logo) {
            echo '<img class="footer-logo w-auto mb-2 h-[80px] ml-[20%] mt-[10px]" src="https://i.ibb.co/bv8p1pn/starlabslogo.png' . '" alt="Footer Logo">';
        } else {
            echo '<p class="text-sm font-normal leading-5 text-red-500">Footer logo is missing. Please add it in the general settings.</p>';
            echo '<img class="w-auto mb-2" src="' . esc_url(get_template_directory_uri() . '/path/to/default-logo.png') . '" alt="Unified Search">';
        }
        if ($footer_text) {
            echo '<p class="text-sm font-normal leading-5 text-gray-200">' . esc_html($footer_text) . '</p>';
        }
        ?>
        <?php
        $subscribed = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subscribe'])) {
            $subscribed = true;
        }
        ?>

        <div class="newsletter-form">
            <?php if ($subscribed) : ?>
                <div class="flex items-center">
                <h1 class="flex text-center mt-[40px]"> Thank you for subscribing to our newsletter  </h1>
                <h1 class="flex text-center mt-[40px] ml-[5px] fas fa-bell"></h1>
                </div>
                
            <?php else : ?>
                <form class="subscribe-form flex mt-[30px]" method="post" action="">
                    <input type="email" class="subscribe-email rounded-l-lg p-[5px] h-auto" name="email" placeholder="Subscribe to us" required>
                    <button type="submit" class="subscribe-button rounded-r-lg flex px-[5px] py-[10px] h-auto w-[50px] items-center text-white fas fa-arrow-right bg-black justify-center transition ease-out duration-300 hover:bg-[#000000b3]" name="subscribe"></button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-sm text-gray-600">&copy; <?php echo date("Y"); ?> All Rights Reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
