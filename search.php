<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

				<?php if ( have_posts() ) : ?>

					<h1 class="page-title">
						<?php
						printf(
							/* translators: %s: query term */
							esc_html__( 'Search Results for: %s', 'understrap' ),
							'<span>' . get_search_query() . '</span>'
						);
						?>
					</h1>

					<?php
						while ( have_posts() ) :

							the_post();
							get_template_part( 'template-parts/content', 'search' );

						endwhile; // End of the loop.
					?>
				
				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<?php get_template_part( 'template-parts/sidebarcheck', 'right' ); ?>

		</div><!-- #row -->

	</div><!-- #container -->

</div>

<?php
get_footer();
