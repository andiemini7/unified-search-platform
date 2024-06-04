<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <script src="https://cdn.tailwindcss.com"></script>     
   
</head>
<body <?php body_class('flex flex-col min-h-screen'); ?>>

<header class="bg-gray-900 text-white py-4">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold"><?php bloginfo('name'); ?></h1>
        <p class="text-sm"><?php bloginfo('description'); ?></p>
    </div>
</header>
<main class="flex-grow">
    
