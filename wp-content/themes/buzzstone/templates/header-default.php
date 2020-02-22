<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_header_css   = '';
$buzzstone_header_image = get_header_image();
$buzzstone_header_video = buzzstone_get_header_video();
if ( ! empty( $buzzstone_header_image ) && buzzstone_trx_addons_featured_image_override( is_singular() || buzzstone_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$buzzstone_header_image = buzzstone_get_current_mode_image( $buzzstone_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $buzzstone_header_image ) || ! empty( $buzzstone_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $buzzstone_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $buzzstone_header_image ) {
		echo ' ' . esc_attr( buzzstone_add_inline_css_class( 'background-image: url(' . esc_url( $buzzstone_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( buzzstone_is_on( buzzstone_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight buzzstone-full-height';
	}
	if ( ! buzzstone_is_inherit( buzzstone_get_theme_option( 'header_scheme' ) ) ) {
		echo ' scheme_' . esc_attr( buzzstone_get_theme_option( 'header_scheme' ) );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $buzzstone_header_video ) ) {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	if ( buzzstone_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( buzzstone_is_on( buzzstone_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-mobile' ) );
	}


	// Header widgets area
	get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-widgets' ) );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
	get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-single' ) );

	?>
</header>
