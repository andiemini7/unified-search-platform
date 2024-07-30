<?php 
$benefits_title = get_sub_field('title'); 

if (have_rows('benefits')): ?>
    <div class="benefits-bar flex flex-wrap items-center justify-center mt-5 mb-5 ml-10 space-x-4">
        <?php if ($benefits_title): ?>
            <div class="w-full mb-4">
                <h2 class="flex items-center justify-center text-xl font-bold text-gray-800"><?php echo esc_html($benefits_title); ?></h2>
            </div>
        <?php endif; ?>

        <?php while (have_rows('benefits')): the_row(); 
            $icon = get_sub_field('icon');
            $text = get_sub_field('text');
        ?>
            <div class="flex items-center space-x-2 p-2 border rounded-lg bg-gray-100 w-[200px] mb-4 shadow-md">
                <?php if ($icon): ?>
                    <img src="<?php echo esc_url($icon); ?>" class="w-6 h-6" alt="Benefit Icon">
                <?php endif; ?>
                <span class="text-sm text-gray-800"><?php echo esc_html($text); ?></span>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>
