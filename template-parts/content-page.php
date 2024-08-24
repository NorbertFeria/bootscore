<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootscore
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( ! is_page_template( 'page-templates/no-title.php' ) ) {
		the_title(
			'<header class="entry-header"><h1 class="entry-title">',
			'</h1></header><!-- .entry-header -->'
		);
	} ?>

	<?php bootscore_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		bootscore_link_pages();
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php bootscore_edit_post_link(); ?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
