# Starlabs Onboarding Platform

**Requires PHP:** 8.0

**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

## Description

This project is an Onboarding Platform designed to provide a seamless search experience across multiple data sources. The platform allows users to explore and discover information efficiently, with features like auto-suggestions, customizable search bars, and modular content management. 

# Tech Stack 

Front-end: HTML, CSS, JavaScript, TailwindCSS
Back-end: PHP (WordPress), REST API , Advanced Custom Fields (ACF) (WordPress)  
Database: MySQL

# Features 

- Modular Search Bar: Fully customizable search bar with auto-suggestion capabilities.
- Custom Post Types: Management of custom post types and taxonomies with ACF.
- Responsive Design: Mobile-friendly design with adaptive UI components.
- Integration with TailwindCSS: Modern and responsive UI components using TailwindCSS.

## Copyright

Team6 , Copyright 2024 WordPress.org


# Installation

## Prerequisites:

- Before you begin, ensure you have the following software installed on your local development environment:

WordPress
- [x] PHP (version 8.0 or higher)
- [x] Node.js (for managing JavaScript dependencies)
- [x] Composer (for PHP dependencies)
- [x] npm (for managing Node packages)

# Steps

## Clone the repository:

```
https://github.com/andiemini7/unified-search-platform.git
cd unified-search-platform
```

## Install PHP dependencies:

```
composer install
```

## Install Node.js dependencies:

```
npm install
```

## Compile assets:

```
npm run build
npm run build:bun
```

## Set up WordPress:

- Set up your local environment (e.g., using Laragon, MAMP, XAMPP, or Local by Flywheel).

# Activate Plugins:

- Ensure all required plugins are activated from the WordPress admin dashboard.

## Plugins needed:

- [x] Nextend-social plugin (for SSO)
- [x] ACF

# Import ACF Fields:

- Navigate to the ACF plugin and import the provided JSON file (if any) to set up custom fields.

# Modules

- Search Module: Located in [modules>search_bar.php], allows users to search through the onboarding content.
- Calendar Event Module: Found in [modules>calendar_module.php], integrates with WordPress to manage events.
- Anchor Module: Located in [modules>Anchor_menu.php],
- Banner Module: Located in [modules>Banner_module.php],
- Benefits Module: Located in [modules>Benefits_bar.php],
- Card Module: Located in [modules>Card.php],
- Faq Module: Located in [modules>faq.php],
- Iframe Block Module: Located in [modules>Iframe_block.php],
- Image Block Module: Located in [modules>Image_block.php],
- Image Module: Located in [modules>Image.php],
- Infocard Module: Located in [modules>infocard_module.php],
- Resources Module: Located in [modules>resources_module.php],
- Select Plannings Module: Located in [modules>Select_plannings.php],
- Stats Module: Located in [modules>Stats_module.php],
- Teams Module: Located in [modules>Teams_module.php],
- Tech Support Card Module: Located in [modules>Techsupport_card.php],
- Text Block Module: Located in [modules>Text_Block.php],
- Wysiwyg Block Module: Located in [modules>Wysiwyg_block.php],

# Folder Structure

- assets/: Contains JavaScript, SASS files, Images, and the dist folder.
- plugins/: Custom plugins and third-party plugins.
- themes/: Theme files including custom templates and styles.
- acf/: Advanced Custom Fields JSON file.
- modules/: Contains all the modules.
- includes/: Contains files like enqueue.php, init.php etc.
