<?php
/**
 * The template to display the 404 page
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

get_header();

get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', '404' ), '404' );

get_footer();
