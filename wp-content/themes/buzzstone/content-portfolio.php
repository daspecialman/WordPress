<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item'
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $buzzstone_columns )
		. ' post_format_' . esc_attr( $buzzstone_post_format )
		. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
		. ( ! empty( $buzzstone_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
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

	$buzzstone_image_hover = ! empty( $buzzstone_template_args['hover'] ) && ! buzzstone_is_inherit( $buzzstone_template_args['hover'] )
								? $buzzstone_template_args['hover']
								: buzzstone_get_theme_option( 'image_hover' );
	// Featured image
	buzzstone_show_post_featured(
		array(
			'singular'      => false,
			'hover'         => $buzzstone_image_hover,
			'no_links'      => ! empty( $buzzstone_template_args['no_links'] ),
			'thumb_size'    => buzzstone_get_thumb_size(
				strpos( buzzstone_get_theme_option( 'body_style' ), 'full' ) !== false || $buzzstone_columns < 3
								? 'masonry-big'
				: 'masonry'
			),
			'show_no_image' => true,
			'class'         => 'dots' == $buzzstone_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $buzzstone_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!