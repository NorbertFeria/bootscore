<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bootscore
 */

if ( ! function_exists( 'bootscore_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function bootscore_posted_on() {
		$post = get_post();
		if ( ! $post ) {
			return;
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ), // @phpstan-ignore-line -- post exists
			esc_html( get_the_date() ), // @phpstan-ignore-line -- post exists
			esc_attr( get_the_modified_date( 'c' ) ), // @phpstan-ignore-line -- post exists
			esc_html( get_the_modified_date() ) // @phpstan-ignore-line -- post exists
		);

		$posted_on = apply_filters(
			'bootscore_posted_on',
			sprintf(
				'<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
				esc_html_x( 'Posted on', 'post date', 'bootscore' ),
				esc_url( get_permalink() ), // @phpstan-ignore-line -- post exists
				apply_filters( 'bootscore_posted_on_time', $time_string )
			)
		);

		$author_id = (int) get_the_author_meta( 'ID' );
		if ( 0 === $author_id ) {
			$byline = '';
		} else {
			$byline = apply_filters(
				'bootscore_posted_by',
				sprintf(
					'<span class="byline"> %1$s<span class="author vcard"> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
					$posted_on ? esc_html_x( 'by', 'post author', 'bootscore' ) : esc_html_x( 'Posted by', 'post author', 'bootscore' ),
					esc_url( get_author_posts_url( $author_id ) ),
					esc_html( get_the_author_meta( 'display_name', $author_id ) )
				)
			);
		}

		echo $posted_on . $byline; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'bootscore_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bootscore_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			bootscore_categories_tags_list();
		}
		bootscore_edit_post_link();
	}
endif;

if ( ! function_exists( 'bootscore_categories_tags_list' ) ) :
	/**
	 * Displays a list of categories and a list of tags.
	 *
	 * @since 1.2.0
	 */
	function bootscore_categories_tags_list() {
		bootscore_categories_list();
		bootscore_tags_list();
	}
endif;

if ( ! function_exists( 'bootscore_categories_list' ) ) :
	/**
	 * Displays a list of categories.
	 *
	 * @since 1.2.0
	 */
	function bootscore_categories_list() {
		$categories_list = get_the_category_list( bootscore_get_list_item_separator() );
		if ( $categories_list || bootscore_categorized_blog() ) {
			/* translators: %s: Categories of current post */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'bootscore' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'bootscore_get_select_control_class' ) ) {
	/**
	 * Retrieves the Bootstrap CSS class for the select tag.
	 *
	 * @since 1.2.0
	 *
	 * @return string Bootstrap CSS class for the select tag.
	 */
	function bootscore_get_select_control_class() {
		return 'form-select';
	}
} 

if ( ! function_exists( 'bootscore_tags_list' ) ) :
	/**
	 * Displays a list of tags.
	 *
	 * @since 1.2.0
	 */
	function bootscore_tags_list() {
		$tags_list = get_the_tag_list( '', bootscore_get_list_item_separator() );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			/* translators: %s: Tags of current post */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'bootscore' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'bootscore_categorized_blog' ) ) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function bootscore_categorized_blog() {
		$all_the_cool_cats = get_transient( 'bootscore_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'bootscore_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so bootscore_categorized_blog should return true.
			return true;
		}
		// This blog has only 1 category so bootscore_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'bootscore_get_list_item_separator' ) ) {
	/**
	 * Retrieves the localized list item separator.
	 *
	 * `wp_get_list_item_separator()` has been introduced in WP 6.0.0. For WP
	 * versions lower than 6.0.0 we have to use a custom translation.
	 *
	 * @since 1.2.0
	 *
	 * @return string Localized list item separator.
	 */
	function bootscore_get_list_item_separator() {
		if ( function_exists( 'wp_get_list_item_separator' ) ) {
			return esc_html( wp_get_list_item_separator() );
		}
		/* translators: used between list items, there is a space after the comma */
		return esc_html__( ', ', 'bootscore' );
	}
}

if ( ! function_exists( 'bootscore_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function bootscore_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'bootscore_link_pages' ) ) :
	/**
	 * Displays/retrieves page links for paginated posts (i.e. including the
	 * `<!--nextpage-->` Quicktag one or more times). This tag must be
	 * within The Loop. Default: echo.
	 *
	 * @since 1.0.0
	 *
	 * @link https://developer.wordpress.org/reference/functions/wp_link_pages/
	 *
	 * @return void|string Formatted output in HTML.
	 */
	function bootscore_link_pages() {
		$args = array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bootscore' ),
			'after'  => '</div>',
		);

		/**
		 * Filters the arguments used in retrieving page links for paginated posts.
		 *
		 * Runs before the 'wp_link_pages_args' hook.
		 *
		 * @since 1.0.0
		 */
		$args = apply_filters_deprecated(
			'bootscore_link_pages_args',
			array( $args ),
			'1.2.3',
			'wp_link_pages_args'
		);

		wp_link_pages( $args );
	}
endif;

if ( ! function_exists( 'bootscore_edit_post_link' ) ) {
	/**
	 * Displays the edit post link for post.
	 *
	 * @since 1.0.0
	 */
	function bootscore_edit_post_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'bootscore' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
