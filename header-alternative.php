<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
/*Desktop styles */

body {
            width: 100%;
            height: 550px;
            background-color: #F6F6F6;
            background-image: url("/wp-content/themes/unified-search-platform/assets/images/character1.png");
            background-repeat: no-repeat;
            background-size: 25%;
            background-position: 15% 115%;
        }

/* Mobile styles */
@media (max-width: 768px) {
    body{
        background-position: 50% 160%;
        background-size: 50%;
    }

    .regh2{
        margin-top: 20px;
    }
    .navbar{
        width:400px;
    }

    #mobile-menu-toggle{
        margin-right: 50%;
    }
    .logel{
        
        width: 60%;
        height: 40px;
    }

    .regel{
        margin-right: 50%;
        width: 300px;
        height: 40px;
    }

    
}

</style>
<body>
<div class="w-full mx-auto">
<nav class="bg-[#F6F6F6] p-4 px-8 mb-4 flex items-center">
    <div class="flex items-center">
        <?php 
            $navbar_logo = get_field('navbar_logo', 'option');
            $navbar_text = get_field('navbar_text', 'option');
        ?>
        <a href="<?php echo home_url(); ?>" class="flex items-center text-[#2F628C] text-xl font-bold">
            <?php if ($navbar_logo): ?>
                <img src="<?php echo esc_url($navbar_logo); ?>" alt="Logo" class="bg-cover bg-center h-10 w-full object-contain">
            <?php elseif ($navbar_text): ?>
                <span><?php echo esc_html($navbar_text); ?></span>
            <?php else: ?>
                <span class="text-sm text-red-500">Please set the logo in general settings</span>
            <?php endif; ?>
        </a>

        <!-- Desktop Menu -->
        <?php if (is_user_logged_in()) : ?>
        <div class="hidden lg:flex lg:mx-10 text-lg uppercase ml-10">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unified-search-menu',
                'container' => false,
                'menu_class' => 'flex text-[#2F628C]',
                'link_before' => '<span class="text-black font-semibold">',
                'link_after' => '</span>',
            ));
            ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Search and Authentication Links -->
    <div class="hidden lg:flex items-center ml-auto">
        <ul class="hidden lg:flex items-center">
            <?php if (is_user_logged_in()) : ?>
                <!-- Include search bar for desktop -->
                <?php include_once 'views/searchBar.php'; ?>
            <?php else : ?>
                <li class="inline-block mx-1">
                    <a href="<?php echo home_url('/signin/');?>" 
                       id="button-signup"
                       class="rounded-full border-solid border-2 border-black py-3 px-6 text-black bg-white block font-semibold"
                    >Sign In</a>
                </li>
                <li class="inline-block mx-1">
                    <a id="button-register"
                       href="<?php echo home_url('/register/'); ?>" 
                       class="rounded-full border-solid border-2 border-black py-3 px-6 text-white bg-black block font-semibold"
                    >Register</a>
                </li>
            <?php endif; ?>
        </ul>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="flex items-center lg:hidden ml-auto">
            <button id="mobile-menu-toggle" class="text-black">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times hidden"></i>
            </button>
        </div>
</nav>


    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden bg-white w-full h-full fixed top-0 left-0 z-50 overflow-y-auto uppercase">
    <?php if(is_user_logged_in()): ?>
        <div id="login" class="flex flex-col text-center justify-start text-xl y-4 pt-8 px-4 mt-10">
            <div class="mt-6 border-b border-[#808080]">
                <form action="/" method="get" class="flex justify-center my-4">
                    <input type="text" name="s" class="border border-gray-300 p-2 pl-4 rounded-l-full w-full max-w-md" placeholder="Search...">
                    <button type="submit" class="bg-black text-white p-2 pl-4 pr-5 rounded-r-full"><svg fill="#ffffff" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="30px" height="30px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
<path d="M8,15c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7S11.9,15,8,15z M8,3C5.2,3,3,5.2,3,8s2.2,5,5,5s5-2.2,5-5S10.8,3,8,3z"/>
<path d="M17.3,18.7l-3-3c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l3,3c0.4,0.4,0.4,1,0,1.4C18.3,19.1,17.7,19.1,17.3,18.7z"/>
</svg></button>
                </form>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unified-search-menu',
                'container' => false,
                'menu_class' => 'flex flex-col text-[#2F628C]',
                'link_before' => '<span class="text-black font-semibold">',
                'link_after' => '</span>',
            ));
            ?>
        </div>
        <?php else: ?>
            <div id="logout" class="flex flex-col text-center justify-start text-xl y-4 pt-8 px-4 mt-10">
        <ul class="flex flex-col items-center lg:hidden">
            <li class="block w-full p-1 border-b border-t border-black">
                <a href="<?php echo home_url('/signin/');?>" 
                   id="button-signup-mobile"
                   class="block text-black font-semibold  py-3 px-6"
                >Sign In</a>
            </li>
            <li class="block w-full p-1 border-b border-black">
                <a id="button-register-mobile"
                   href="<?php echo home_url('/register/'); ?>" 
                   class="block text-black font-semibold py-3 px-6"
                >Register</a>
            </li>
        </ul>
        </div>
        <?php endif; ?>
    </div>
</div>
</div>

<?php wp_footer(); ?>