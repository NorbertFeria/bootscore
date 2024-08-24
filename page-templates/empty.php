<?php
/**
 * Template Name: Empty Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();


while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/content', 'blank' );

endwhile; // End of the loop.

get_footer();
