<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

buzzstone_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	buzzstone_blog_archive_start();

	$buzzstone_classes    = 'posts_container '
						. ( substr( buzzstone_get_theme_option( 'blog_style' ), 0, 7 ) == 'classic'
							? 'columns_wrap columns_padding_bottom'
							: 'masonry_wrap'
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
		$buzzstone_part = $buzzstone_sticky_out && is_sticky() ? 'sticky' : 'classic';
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
