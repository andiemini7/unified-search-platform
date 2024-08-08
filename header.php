<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
</head>
<body <?php body_class(); ?>>
<div class="w-full mx-auto">
<nav id="main-navbar" class="bg-white p-4 px-8 mb-4 flex items-center transition-shadow duration-300">
    <div class="flex items-center">
        <?php 
            $navbar_logo = get_field('navbar_logo', 'option');
            $navbar_text = get_field('navbar_text', 'option');
        ?>
        <a href="<?php echo home_url(); ?>" class="flex items-center text-[#2F628C] text-xl font-bold">
            <?php if ($navbar_logo): ?>
                <img src="https://i.ibb.co/bv8p1pn/starlabslogo.png" alt="Logo" class="starlabs-logo bg-cover bg-center h-[60px] ml-[35px] w-full object-contain">
            <?php elseif ($navbar_text): ?>
                <span><?php echo esc_html($navbar_text); ?></span>
            <?php else: ?>
                <span class="text-sm text-red-500">Please set the logo in general settings</span>
            <?php endif; ?>
        </a>

        <!-- Desktop Menu -->
        <div class="navbar-links ml-[40px]">
        <?php if (is_user_logged_in()) : ?>
        <div class="hidden lg:flex lg:mx-10 text-sm uppercase">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unified-search-menu',
                'container' => false,
                'menu_class' => 'flex text-[#2F628C] ',
                'link_before' => '<span class="text-black font-extralight hover:text-stone-400 transition ease-out duration-100">',
                'link_after' => '</span>',
            ));
            ?>
        </div>
        <?php endif; ?>
        </div>
    </div>

    <!-- Search and Authentication Links -->
    <div class="hidden lg:flex items-center ml-auto">
        <ul class="hidden lg:flex items-center">
            <?php if (is_user_logged_in()) : ?>
                <!-- Include search bar for desktop -->
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

    <!-- User Avatar and Sign Out Button -->
    <?php if (is_user_logged_in()) : ?>
        <?php 
            $current_user = wp_get_current_user(); 
            $current_user_id = $current_user->ID;
            $user_picture = get_field('user_picture', 'user_' . $current_user_id);
        ?>
        <div class="flex items-center ml-4">
        <div class="notifications-wrapper relative mr-5">
            <a href="#" id="notifications-button" class="relative flex">
                <i class="fa fa-bell text-xl"></i>
                <span id="notifications-count" class="hidden bg-red-600 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2">
                    <?php
                        $notifications = get_user_meta($current_user_id, 'user_notifications', true);
                        echo count($notifications);
                    ?>
                </span>
            </a>
            <div id="notifications-dropdown" class="hidden absolute top-full right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg max-h-96 overflow-y-auto">          
            </div>
        </div>
            <a href="<?php echo home_url('/user-profile/?user_id=' . $current_user_id); ?>" class="flex items-center">
                <?php if ($user_picture): ?>
                    <img src="<?php echo esc_url($user_picture); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" class="rounded-full h-10 w-10 object-cover mr-4">
                <?php else: ?>
                    <img src="<?php echo get_avatar_url($current_user_id, ['size' => '40']); ?>" alt="<?php echo esc_attr($current_user->display_name); ?>" class="rounded-full h-10 w-10 object-cover mr-4">
                <?php endif; ?>
            </a>
            <a href="<?php echo wp_logout_url(home_url()); ?>" class="hidden lg:block rounded-full border-solid border-2 border-black py-[6px] px-[10px] text-white bg-black block font-semibold">
                Sign Out
            </a>
        </div>
    <?php endif; ?>

    <!-- Mobile Menu Toggle -->
    <div class="flex items-center lg:hidden ml-auto">
        <button id="mobile-menu-toggle" class="text-black">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu" class="lg:hidden hidden bg-white w-full h-full fixed top-0 left-0 z-50 overflow-y-auto uppercase">
    <?php if (is_user_logged_in()): ?>
        <div id="login" class="flex flex-col text-center justify-start text-xl py-4 pt-8 px-4 mt-10">
            <div class="mt-6 border-b border-[#808080]">
                <form action="/" method="get" class="flex justify-center my-4">
                    <input type="text" name="s" class="border border-gray-300 p-2 pl-4 rounded-l-full w-full max-w-md" placeholder="Search...">
                    <button type="submit" class="bg-black text-white p-2 pl-4 pr-5 rounded-r-full">
                        <svg fill="#ffffff" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                            width="30px" height="30px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
                            <path d="M8,15c-3.9,0-7-3.1-7-7s3.1-7,7-7s7,3.1,7,7S11.9,15,8,15z M8,3C5.2,3,3,5.2,3,8s2.2,5,5,5s5-2.2,5-5S10.8,3,8,3z"/>
                            <path d="M17.3,18.7l-3-3c-0.4-0.4-0.4-1,0-1.4s1-0.4,1.4,0l3,3c0.4,0.4,0.4,1,0,1.4C18.3,19.1,17.7,19.1,17.3,18.7z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'unified-search-menu',
                'container' => false,
                'menu_class' => 'flex flex-col text-[#2F628C]',
            ));
            ?>
        </div>
    <?php endif; ?>
</div>
</div>

<?php wp_footer(); ?>
<script>
 document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('main-navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 0) {
            navbar.classList.add('sticky');
        } else {
            navbar.classList.remove('sticky');
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const notificationsButton = document.getElementById('notifications-button');
    const notificationsDropdown = document.getElementById('notifications-dropdown');
    const notificationsCount = document.getElementById('notifications-count');

    function updateNotificationCount(count) {
        if (count > 0) {
            notificationsCount.textContent = count;
            notificationsCount.classList.remove('hidden');
        } else {
            console.log("countELSE", count);
            notificationsCount.textContent = '';
            notificationsCount.classList.add('hidden');
        }
    }

    function loadNotifications() {
        fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=load_notifications')
            .then(response => response.json())
            .then(data => {
                notificationsDropdown.innerHTML = '';
                updateNotificationCount(data.count);
                if (data.notifications.length > 0) {
                    data.notifications.forEach(notification => {
                        const notificationElement = document.createElement('div');
                        notificationElement.className = 'notification';
                        notificationElement.innerHTML = `<a href="${notification.link}">${notification.message}</a>`;
                        notificationsDropdown.appendChild(notificationElement);
                    });
                } else {
                    notificationsDropdown.innerHTML = '<div class="notification">No new notifications.</div>';
                }
            });
    }

    updateNotificationCount(0);

    notificationsButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (notificationsDropdown.style.display === 'block') {
            notificationsDropdown.style.display = 'none';
        } else {
            notificationsDropdown.style.display = 'block';
            updateNotificationCount(0);
        }
    });

    document.addEventListener('click', function(event) {
        if (!notificationsButton.contains(event.target) && !notificationsDropdown.contains(event.target)) {
            notificationsDropdown.style.display = 'none';
        }
    });

 

    loadNotifications();
});

</script>
</body>
</html>
