<?php
/**
 * Boot Score theme widgets
 *
  * @package bootscore
 */

/**
 * Register widget area and bootstrap classes on widgets.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bootscore_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Right Sidebar', 'bootscore' ),
			'id'            => 'sidebar-right',
			'description'   => esc_html__( 'Add widgets here.', 'bootscore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Left Sidebar', 'bootscore' ),
			'id'            => 'sidebar-left',
			'description'   => esc_html__( 'Add widgets here.', 'bootscore' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Homepage Showcase', 'bootscore' ),
			'id'            => 'homepage-showcase',
			'description'   => esc_html__( 'Add widgets here.', 'bootscore' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Fullwidth', 'bootscore' ),
			'id'            => 'footer-fullwidth',
			'description'   => esc_html__( 'Add widgets here.', 'bootscore' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

}
add_action( 'widgets_init', 'bootscore_widgets_init' );

if ( ! function_exists( 'bootscore_add_widget_categories_class' ) ) {
	/**
	 * Adds Bootstrap class to select tag in the Categories widget.
	 *
	 * @since 1.2.0
	 *
	 * @param array $cat_args An array of Categories widget drop-down arguments.
	 * @return array The filtered array of Categories widget drop-down arguments.
	 */
	function bootscore_add_widget_categories_class( $cat_args ) {

		if ( isset( $cat_args['class'] ) ) {
			$cat_args['class'] .= ' ' . bootscore_get_select_control_class();
		} else {
			$cat_args['class'] = bootscore_get_select_control_class();
		}

		return $cat_args;
	}
}
add_filter( 'widget_categories_dropdown_args', 'bootscore_add_widget_categories_class' );

if ( ! function_exists( 'bootscore_add_block_widget_categories_class' ) ) {
	/**
	 * Adds Bootstrap class to select tag in the Categories block widget.
	 *
	 * @since 1.2.0
	 *
	 * @param string $output      The taxonomy drop-down HTML output.
	 * @param array  $parsed_args Arguments used to build the drop-down.
	 * @return string The filtered taxonomy drop-down HTML output.
	 */
	function bootscore_add_block_widget_categories_class( $output, $parsed_args ) {
		$class = bootscore_get_select_control_class();

		if ( isset( $parsed_args['class'] ) && ! empty( $parsed_args['class'] ) ) {
			$search  = array(
				"class=\"{$parsed_args['class']}\"",
				"class='{$parsed_args['class']}'",
			);
			$replace = array(
				"class=\"{$parsed_args['class']} {$class}\"",
				"class=\"{$parsed_args['class']} {$class}\"",
			);
		} else {
			$search  = '<select';
			$replace = "<select class=\"{$class}\"";
		}

		return str_replace( $search, $replace, $output );
	}
}
add_filter( 'wp_dropdown_cats', 'bootscore_add_block_widget_categories_class', 10, 2 );

if ( ! function_exists( 'bootscore_add_block_widget_archives_classes' ) ) {
	/**
	 * Adds Bootstrap class to select tag in the Archives widget.
	 *
	 * @since 1.2.0
	 *
	 * @param string $block_content The block content.
	 * @param array  $block         The full block, including name and attributes.
	 * @return string The filtered block content.
	 */
	function bootscore_add_block_widget_archives_classes( $block_content, $block ) {

		if ( isset( $block['attrs']['displayAsDropdown'] ) && true === $block['attrs']['displayAsDropdown'] ) {
			return str_replace(
				'<select',
				'<select class="' . bootscore_get_select_control_class() . '"',
				$block_content
			);
		}
		return $block_content;
	}
}
add_filter( 'render_block_core/archives', 'bootscore_add_block_widget_archives_classes', 10, 2 );

if ( ! function_exists( 'bootscore_add_block_widget_search_classes' ) ) {
	/**
	 * Adds Bootstrap classes to search block widget.
	 *
	 * @since 1.2.0
	 *
	 * @param string $block_content The block content.
	 * @param array  $block         The full block, including name and attributes.
	 * @return string The filtered block content.
	 */
	function bootscore_add_block_widget_search_classes( $block_content, $block ) {

		$search  = array(
			'wp-block-search__input ',
			'wp-block-search__input"',
			'wp-block-search__button ',
		);
		$replace = array(
			'wp-block-search__input form-control ',
			'wp-block-search__input form-control"',
			'wp-block-search__button btn btn-primary ',
		);

		if ( isset( $block['attrs']['buttonPosition'] ) && 'button-inside' === $block['attrs']['buttonPosition'] ) {
			$search[]  = 'wp-block-search__inside-wrapper';
			$replace[] = 'wp-block-search__inside-wrapper input-group';

			if ( 'bootstrap4' === get_theme_mod( 'bootscore_bootstrap_version', 'bootstrap4' ) ) {
				$search[]  = '<button';
				$search[]  = '</button>';
				$replace[] = '<div class="input-group-append"><button';
				$replace[] = '</button></div>';
			}
		}

		return str_replace( $search, $replace, $block_content );
	}
}
add_filter( 'render_block_core/search', 'bootscore_add_block_widget_search_classes', 10, 2 );