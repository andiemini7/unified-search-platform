<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body <?php body_class('flex flex-col min-h-screen'); ?>>


<header class="bg-gray-900 text-white py-4">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold"><?php bloginfo('name'); ?></h1>
        <p class="text-sm"><?php bloginfo('description'); ?></p>
        <?php include_once 'views/searchBar.php'; ?>
    </div>
</header>

<main class="flex-grow">
    
