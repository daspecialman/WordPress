<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_link        = get_permalink();
$buzzstone_post_format = get_post_format();
$buzzstone_post_format = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item related_item_style_1 post_format_' . esc_attr( $buzzstone_post_format ) ); ?>>
	<?php
	buzzstone_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'buzzstone_filter_related_thumb_size', buzzstone_get_thumb_size( (int) buzzstone_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'show_no_image' => buzzstone_get_theme_setting( 'allow_no_image' ),
			'singular'      => false,
			'post_info'     => '<div class="post_header entry-header">'
						. '<div class="post_categories">' . wp_kses_post( buzzstone_get_post_categories( '' ) ) . '</div>'
						. '<h6 class="post_title entry-title"><a href="' . esc_url( $buzzstone_link ) . '">' . wp_kses_data( get_the_title() ) . '</a></h6>'
						. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
								? '<span class="post_date"><a href="' . esc_url( $buzzstone_link ) . '">' . wp_kses_data( buzzstone_get_date() ) . '</a></span>'
								: '' )
					. '</div>',
		)
	);
	?>
</div>
