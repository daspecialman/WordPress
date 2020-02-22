<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_template_args = get_query_var( 'buzzstone_template_args' );
if ( is_array( $buzzstone_template_args ) ) {
	$buzzstone_columns    = empty( $buzzstone_template_args['columns'] ) ? 2 : max( 1, $buzzstone_template_args['columns'] );
	$buzzstone_blog_style = array( $buzzstone_template_args['type'], $buzzstone_columns );
} else {
	$buzzstone_blog_style = explode( '_', buzzstone_get_theme_option( 'blog_style' ) );
	$buzzstone_columns    = empty( $buzzstone_blog_style[1] ) ? 2 : max( 1, $buzzstone_blog_style[1] );
}
$buzzstone_post_format = get_post_format();
$buzzstone_post_format = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );
$buzzstone_animation   = buzzstone_get_theme_option( 'blog_animation' );
$buzzstone_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item'
		. ' post_layout_portfolio'
		. ' post_layout_gallery'
		. ' post_layout_gallery_' . esc_attr( $buzzstone_columns )
		. ' post_format_' . esc_attr( $buzzstone_post_format )
		. ( ! empty( $buzzstone_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
	);
	echo ( ! buzzstone_is_off( $buzzstone_animation ) && empty( $buzzstone_template_args['slider'] ) ? ' data-animation="' . esc_attr( buzzstone_get_animation_classes( $buzzstone_animation ) ) . '"' : '' );
	?>
	data-size="
		<?php
		if ( ! empty( $buzzstone_image[1] ) && ! empty( $buzzstone_image[2] ) ) {
			echo intval( $buzzstone_image[1] ) . 'x' . intval( $buzzstone_image[2] );}
		?>
	"
	data-src="
		<?php
		if ( ! empty( $buzzstone_image[0] ) ) {
			echo esc_url( $buzzstone_image[0] );}
		?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$buzzstone_image_hover = 'icon';
if ( in_array( $buzzstone_image_hover, array( 'icons', 'zoom' ) ) ) {
	$buzzstone_image_hover = 'dots';
}
$buzzstone_components = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'meta_parts' ) );
$buzzstone_counters   = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'counters' ) );
buzzstone_show_post_featured(
	array(
		'hover'         => $buzzstone_image_hover,
		'singular'      => false,
		'no_links'      => ! empty( $buzzstone_template_args['no_links'] ),
		'thumb_size'    => buzzstone_get_thumb_size( strpos( buzzstone_get_theme_option( 'body_style' ), 'full' ) !== false || $buzzstone_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $buzzstone_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $buzzstone_components )
								? buzzstone_show_post_meta(
									apply_filters(
										'buzzstone_filter_post_meta_args', array(
											'components' => $buzzstone_components,
											'counters' => $buzzstone_counters,
											'seo'      => false,
											'echo'     => false,
										), $buzzstone_blog_style[0], $buzzstone_columns
									)
								)
								: ''
								)
							. ( empty( $buzzstone_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $buzzstone_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'buzzstone' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
