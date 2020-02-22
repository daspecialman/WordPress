<?php
/**
 * The template for homepage posts with custom style
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.50
 */

buzzstone_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	$buzzstone_blog_style = buzzstone_get_theme_option( 'blog_style' );
	$buzzstone_parts      = explode( '_', $buzzstone_blog_style );
	$buzzstone_columns    = ! empty( $buzzstone_parts[1] ) ? max( 1, min( 6, (int) $buzzstone_parts[1] ) ) : 1;
	$buzzstone_blog_id    = buzzstone_get_custom_blog_id( $buzzstone_blog_style );
	$buzzstone_blog_meta  = buzzstone_get_custom_layout_meta( $buzzstone_blog_id );
	if ( ! empty( $buzzstone_blog_meta['margin'] ) ) {
		buzzstone_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( buzzstone_prepare_css_value( $buzzstone_blog_meta['margin'] ) ) ) );
	}
	$buzzstone_custom_style = ! empty( $buzzstone_blog_meta['scripts_required'] ) ? $buzzstone_blog_meta['scripts_required'] : 'none';

	buzzstone_blog_archive_start();

	$buzzstone_classes    = 'posts_container blog_custom_wrap' 
							. ( ! buzzstone_is_off( $buzzstone_custom_style )
								? sprintf( ' %s_wrap', $buzzstone_custom_style )
								: ( $buzzstone_columns > 1 
									? ' columns_wrap columns_padding_bottom' 
									: ''
									)
								);
	$buzzstone_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$buzzstone_sticky_out = buzzstone_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $buzzstone_stickies ) && count( $buzzstone_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $buzzstone_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $buzzstone_sticky_out ) {
		if ( buzzstone_get_theme_option( 'first_post_large' ) && ! is_paged() && ! in_array( buzzstone_get_theme_option( 'body_style' ), array( 'fullwide', 'fullscreen' ) ) ) {
			the_post();
			get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', 'excerpt' ), 'excerpt' );
		}
		?>
		<div class="<?php echo esc_attr( $buzzstone_classes ); ?>">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $buzzstone_sticky_out && ! is_sticky() ) {
			$buzzstone_sticky_out = false;
			?>
			</div><div class="<?php echo esc_attr( $buzzstone_classes ); ?>">
			<?php
		}
		$buzzstone_part = $buzzstone_sticky_out && is_sticky() ? 'sticky' : 'custom';
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', $buzzstone_part ), $buzzstone_part );
	}
	?>
	</div>
	<?php

	buzzstone_show_pagination();

	buzzstone_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
