<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.10
 */

$buzzstone_footer_id = buzzstone_get_custom_footer_id();
$buzzstone_footer_meta = get_post_meta( $buzzstone_footer_id, 'trx_addons_options', true );
if ( ! empty( $buzzstone_footer_meta['margin'] ) ) {
	buzzstone_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( buzzstone_prepare_css_value( $buzzstone_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $buzzstone_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $buzzstone_footer_id ) ) ); ?>
						<?php
						if ( ! buzzstone_is_inherit( buzzstone_get_theme_option( 'footer_scheme' ) ) ) {
							echo ' scheme_' . esc_attr( buzzstone_get_theme_option( 'footer_scheme' ) );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'buzzstone_action_show_layout', $buzzstone_footer_id );
	?>
</footer><!-- /.footer_wrap -->
