<?php
/**
 * The check sidebar containing the right-sidebar widget area
 *
 * @package bootscore
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sidebar_position = get_theme_mod('sidebar_position_setting', 'none');

if ($sidebar_position === 'left' || $sidebar_position === 'both') : ?>
    </div><!--  main-content -->
    
    <?php get_template_part( 'template-parts/sidebar', 'right' ); ?>

<?php endif; ?>