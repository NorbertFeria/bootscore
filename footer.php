<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootscore
 */

$container = get_theme_mod( 'container_type_setting', 'container' );
?>
	<!-- Footer -->
	<footer class="p-5 bg-dark text-white position-relative">
    <div class="<?php echo esc_attr( $container ); ?>">
      <?php
          if (get_theme_mod('enable_footer_widget_setting', false)) {
            if (is_active_sidebar('footer-fullwidth')) {
                $footer_widget_classes = esc_attr(get_theme_mod('footer_widget_classes_setting', 'row my-3'));
                echo '<div class="' . $footer_widget_classes . '">';
                  echo '<div class="md-col-12">';
                    dynamic_sidebar('footer-fullwidth');
                  echo '</div>';
                echo '</div>';
            }
          }
      ?>
      <div class="row">
        <div class="site-info text-center">
          <?php echo esc_html(get_theme_mod('footer_text_setting', 'Copyright © 2024 Bootscore' )); ?>
            <a href="#" class="position-absolute bottom-0 end-0 p-5">
              <i class="bi bi-arrow-up-circle h1"></i>
            </a>
        </div>
      </div>
    </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
