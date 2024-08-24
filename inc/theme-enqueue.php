<?php
/**
 * Boot Score theme enqueue
 *
  * @package bootscore
 */

/**
 * Enqueue scripts and styles.
 */

function bootscore_scripts(){

	$suffix   = defined( 'IS_DEV_MODE' ) && IS_DEV_MODE ? '' : '.min';

	wp_enqueue_style( 'bootstrap-style', get_theme_file_uri() . '/css/style_bootsrap'.$suffix.'.css', array(), _BOOTSCORE_VERSION );

	//wp_enqueue_style( 'bootscore-native-style', get_theme_file_uri() . '/css/style_bootscore'.$suffix.'.css', array(), _BOOTSCORE_VERSION );

	wp_enqueue_style( 'bootscore-theme-style', get_theme_file_uri() . '/css/style_theme'.$suffix.'.css', array(), _BOOTSCORE_VERSION );

	wp_enqueue_style( 'bootscore-style', get_stylesheet_uri(), array(), _BOOTSCORE_VERSION );

	//wp_style_add_data( 'bootscore-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bootscore-bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'bootscore_scripts' );