
<?php
/**
 * The  sidebar containing the left-sidebar widget area
 *
 * @package bootscore
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="col-md-3 py-5 widget-area" id="sidebar-left">
    
    <?php dynamic_sidebar( 'sidebar-left' ); ?>
    
</div><!-- #sidebar-left -->