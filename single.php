<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bootscore
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'container_type_setting', 'container' );

?>

<div class="bg-light" id="wrapper">
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="row">
			<?php get_template_part( 'template-parts/sidebarcheck', 'left' ); ?>
			<main id="primary">
				<?php
					while ( have_posts() ) :
					the_post();
						get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
			<?php get_template_part( 'template-parts/sidebarcheck', 'right' ); ?>
		</div><!-- #row -->
	</div><!-- #container -->
</div>
<?php
get_footer();
