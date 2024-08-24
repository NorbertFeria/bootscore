<?php
/**
 * Single post partial template
 *
 * @package bootscore
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php bootscore_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php bootscore_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		bootscore_link_pages();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php bootscore_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
