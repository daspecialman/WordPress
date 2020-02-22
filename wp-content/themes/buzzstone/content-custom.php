<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.50
 */

$buzzstone_template_args = get_query_var( 'buzzstone_template_args' );
if ( is_array( $buzzstone_template_args ) ) {
	$buzzstone_columns    = empty( $buzzstone_template_args['columns'] ) ? 2 : max( 1, $buzzstone_template_args['columns'] );
	$buzzstone_blog_style = array( $buzzstone_template_args['type'], $buzzstone_columns );
} else {
	$buzzstone_blog_style = explode( '_', buzzstone_get_theme_option( 'blog_style' ) );
	$buzzstone_columns    = empty( $buzzstone_blog_style[1] ) ? 2 : max( 1, $buzzstone_blog_style[1] );
}
$buzzstone_blog_id       = buzzstone_get_custom_blog_id( join( '_', $buzzstone_blog_style ) );
$buzzstone_blog_style[0] = str_replace( 'blog-custom-', '', $buzzstone_blog_style[0] );
$buzzstone_expanded      = ! buzzstone_sidebar_present() && buzzstone_is_on( buzzstone_get_theme_option( 'expand_content' ) );
$buzzstone_animation     = buzzstone_get_theme_option( 'blog_animation' );
$buzzstone_components    = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'meta_parts' ) );
$buzzstone_counters      = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'counters' ) );

$buzzstone_post_format   = get_post_format();
$buzzstone_post_format   = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );

$buzzstone_blog_meta     = buzzstone_get_custom_layout_meta( $buzzstone_blog_id );
$buzzstone_custom_style  = ! empty( $buzzstone_blog_meta['scripts_required'] ) ? $buzzstone_blog_meta['scripts_required'] : 'none';

if ( ! empty( $buzzstone_template_args['slider'] ) || $buzzstone_columns > 1 || ! buzzstone_is_off( $buzzstone_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $buzzstone_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo ( buzzstone_is_off( $buzzstone_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $buzzstone_custom_style ) ) . '-1_' . esc_attr( $buzzstone_columns );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" 
<?php
	post_class(
			'post_item post_format_' . esc_attr( $buzzstone_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $buzzstone_columns )
					. ' post_layout_' . esc_attr( $buzzstone_blog_style[0] )
					. ' post_layout_' . esc_attr( $buzzstone_blog_style[0] ) . '_' . esc_attr( $buzzstone_columns )
					. ( ! buzzstone_is_off( $buzzstone_custom_style )
						? ' post_layout_' . esc_attr( $buzzstone_custom_style )
							. ' post_layout_' . esc_attr( $buzzstone_custom_style ) . '_' . esc_attr( $buzzstone_columns )
						: ''
						)
		);
	echo ( ! buzzstone_is_off( $buzzstone_animation ) && empty( $buzzstone_template_args['slider'] ) ? ' data-animation="' . esc_attr( buzzstone_get_animation_classes( $buzzstone_animation ) ) . '"' : '' );
?>
>
	<?php
	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}
	// Custom header's layout
	do_action( 'buzzstone_action_show_layout', $buzzstone_blog_id );
	?>
</article><?php
if ( ! empty( $buzzstone_template_args['slider'] ) || $buzzstone_columns > 1 || ! buzzstone_is_off( $buzzstone_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
