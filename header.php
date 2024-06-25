<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container mx-auto p-4">
    <nav class="bg-white p-4 mb-4 flex justify-between items-center">

        <div class="flex items-center">
            <a href="<?php echo home_url(); ?>" class="text-[#2F628C] text-2xl font-bold">
                <img src="<?php echo get_template_directory_uri(); ?>/path/to/your/logo.png" alt="Logo" class="h-8">
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
            <form action="/" method="get" class="relative">
                <div class="relative">
                    <i class="fa fa-search absolute left-0 top-0 mt-4 ml-2"></i>
                    <input type="text" name="s" class="bg-white text-[#2F628C] rounded-full py-2 pl-7">
                </div>
                <!-- <button type="submit" class="bg-[#2F628C] text-white py-2 px-4 rounded">Submit</button> -->
            </form>
        </div>
    </nav>

    <!-- Mobile -->
    <div id="mobile-menu" class="lg:hidden hidden bg-white w-full h-full fixed top-0 left-0 z-50 overflow-y-auto">

        <div class="flex items-center justify-start py-4 pl-4 mt-7">
            <a href="<?php echo home_url(); ?>" class="text-[#2F628C] text-2xl font-bold">
                <img src="<?php echo get_template_directory_uri(); ?>/path/to/your/logo.png" alt="Logo" class="h-8">
            </a>
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

    <h1 class="text-4xl font-bold text-center my-4">Unified Search Results</h1>

    <!-- <form action="/" method="get" class="flex justify-center my-4">
        <input type="text" name="s" class="border border-gray-300 p-2 rounded-l w-full max-w-md">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r">Search</button>
    </form> -->

</div>

</body>
