<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}
?>

<div class="col-md-3 py-5 widget-area" id="sidebar-right">

	<?php dynamic_sidebar( 'sidebar-right' ); ?>

</div><!-- #secondary -->