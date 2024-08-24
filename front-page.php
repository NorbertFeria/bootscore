<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bootscore
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'container_type_setting', 'container' );

if (get_theme_mod('enable_hero_widget_setting', false)) {
    if (is_active_sidebar('homepage-showcase')) {
        $hero_classes = esc_attr(get_theme_mod('hero_widget_classes_setting', 'bg-light text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start'));
        echo '<section class="' . $hero_classes . '">';
            echo  '<div class="' . esc_attr( $container ). '">';
                dynamic_sidebar('homepage-showcase');
            echo '</div>';
        echo '</section>';
    }
}
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
