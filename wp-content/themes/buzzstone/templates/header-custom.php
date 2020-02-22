<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.06
 */

$buzzstone_header_css   = '';
$buzzstone_header_image = get_header_image();
$buzzstone_header_video = buzzstone_get_header_video();
if ( ! empty( $buzzstone_header_image ) && buzzstone_trx_addons_featured_image_override( is_singular() || buzzstone_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$buzzstone_header_image = buzzstone_get_current_mode_image( $buzzstone_header_image );
}

$buzzstone_header_id = buzzstone_get_custom_header_id();
$buzzstone_header_meta = get_post_meta( $buzzstone_header_id, 'trx_addons_options', true );
if ( ! empty( $buzzstone_header_meta['margin'] ) ) {
	buzzstone_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( buzzstone_prepare_css_value( $buzzstone_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $buzzstone_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $buzzstone_header_id ) ) ); ?>
				<?php
				echo ! empty( $buzzstone_header_image ) || ! empty( $buzzstone_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
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

	// Custom header's layout
	do_action( 'buzzstone_action_show_layout', $buzzstone_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
