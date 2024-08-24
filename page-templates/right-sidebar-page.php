<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'container_type_setting', 'container' );

?>

<div class="bg-light" id="wrapper">
	<div class="<?php echo esc_attr( $container ); ?>">
		<div class="row">
            <div class="col-md py-5" id="main-content" >
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
            </div>
			<?php get_template_part( 'template-parts/sidebar', 'right' ); ?>
		</div><!-- #row -->
	</div><!-- #container -->
</div>
<?php
get_footer();
