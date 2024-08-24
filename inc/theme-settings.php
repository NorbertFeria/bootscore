<?php
/**
 * Boot Score theme settings functions
 *
  * @package bootscore
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( ! defined( '_BOOTSCORE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_BOOTSCORE_VERSION', '1.0.0' );
}


if ( ! defined( 'IS_DEV_MODE' ) ) {
	// Replace the version number of the theme on each release.
	define( 'IS_DEV_MODE', true );
}

