<?php
/**
 * The check sidebar containing the left-sidebar widget area
 *
 * @package bootscore
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sidebar_position = get_theme_mod('sidebar_position_setting', 'none');

if ($sidebar_position === 'left' || $sidebar_position === 'both'): ?>

    <?php get_template_part( 'template-parts/sidebar', 'left' ); ?>

<?php endif;?>

<div class="col-md py-5" id="main-content" >