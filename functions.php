<?php
/**
 * Boot Score functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bootscore
 */

 // Bootscore's includes directory.
$bootscore_inc_dir = 'inc';

// Array of files to include.
$bootscore_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/theme-setup.php',                     // Theme setup and custom theme supports.
	'/theme-widgets.php',                   // Register widget area.
	'/theme-enqueue.php',                  // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/functions-nav-walker.php',            // Custom pagination for this theme.
	'/template-functions.php',              // Custom hooks.
	'/customizer.php',              		// Customizer.
);

foreach ( $bootscore_includes as $file ) {
	require_once get_theme_file_path( $bootscore_inc_dir . $file );
}

