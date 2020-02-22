<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

if ( get_query_var( 'buzzstone_header_image' ) == '' && buzzstone_trx_addons_featured_image_override( is_singular() && has_post_thumbnail() && in_array( get_post_type(), array( 'post', 'page' ) ) ) ) {
	$buzzstone_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if ( ! empty( $buzzstone_src[0] ) ) {
		buzzstone_sc_layouts_showed( 'featured', true );
		?>
		<div class="sc_layouts_featured with_image without_content <?php echo esc_attr( buzzstone_add_inline_css_class( 'background-image:url(' . esc_url( $buzzstone_src[0] ) . ');' ) ); ?>"></div>
		<?php
	}
}
