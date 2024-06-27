<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <?php wp_head(); ?>
</head>
<body>
<div class="container mx-auto p-4">
    <nav class="bg-white p-4 mb-4 flex justify-between items-center">
        <div class="flex items-center">
            <?php 
            $navbar_logo = get_field('navbar_logo', 'option');
            $navbar_text = get_field('navbar_text', 'option');
            ?>
            <a href="<?php echo home_url(); ?>" class="flex items-center text-[#2F628C] text-xl font-bold">
                <?php if ($navbar_logo): ?>
                    <img src="<?php echo esc_url($navbar_logo); ?>" alt="Logo" class="h-8">
                <?php elseif ($navbar_text): ?>
                    <span><?php echo esc_html($navbar_text); ?></span>
                <?php else: ?>
                    <span class="text-sm text-red-500">Please set the logo in general settings</span>
                <?php endif; ?>
            </a>
        </div>

        <div class="flex items-center justify-end lg:hidden">
            <button id="mobile-menu-toggle" class="text-[#2F628C]">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times hidden"></i>
            </button>
        </div>

        <!-- Desktop -->
        <div class="flex justify-center flex-grow lg:flex lg:space-x-10 hidden lg:block">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unified-search-menu',
                'container' => false,
                'menu_class' => 'flex space-x-10 text-[#2F628C]',
                'link_before' => '<span class="text-[#2F628C]">',
                'link_after' => '</span>',
            ));
            ?>
        </div>

        <div class="flex items-center justify-end hidden lg:flex">
            <?php include_once 'views/searchBar.php' ?>
        </div>
    </nav>

    <!-- Mobile -->
    <div id="mobile-menu" class="lg:hidden hidden bg-white w-full h-full fixed top-0 left-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-start py-4 pl-4 mt-7">
            <?php if ($navbar_logo): ?>
                <img src="<?php echo esc_url($navbar_logo); ?>" alt="Logo" class="h-8">
            <?php elseif ($navbar_text): ?>
                <span class="text-[#2F628C] ml-2"><?php echo esc_html($navbar_text); ?></span>
            <?php else: ?>
                <span class="text-sm text-red-500">Please set the logo in general settings</span>
                <img class="w-full mb-2" src="<?php echo esc_url(get_template_directory_uri() . '/path/to/default-logo.png'); ?>" alt="Default Logo">
            <?php endif; ?>
        </div>
        <div class="flex flex-col text-center justify-start text-2xl space-y-4 pt-8 px-4 border-t-1 border-b-1 border-gray-300">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unified-search-menu',
                'container' => false,
                'menu_class' => 'flex flex-col space-y-4 text-[#2F628C]',
                'link_before' => '<span class="text-[#2F628C]">',
                'link_after' => '</span>',
            ));
            ?>
        </div>
    </div>

    
    <!-- <form action="/" method="get" class="flex justify-center my-4">
        <input type="text" name="s" class="border border-gray-300 p-2 rounded-l w-full max-w-md">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r">Search</button>
    </form> -->

</div>
<?php wp_footer(); ?>
</body>
</html>

