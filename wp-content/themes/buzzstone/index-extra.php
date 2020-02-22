<?php
/**
 * The template for homepage posts with "Extra" style
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

buzzstone_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	buzzstone_blog_archive_start();

	?><div class="posts_container">
		<?php

		$buzzstone_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
		$buzzstone_sticky_out = buzzstone_get_theme_option( 'sticky_style' ) == 'columns'
								&& is_array( $buzzstone_stickies ) && count( $buzzstone_stickies ) > 0 && get_query_var( 'paged' ) < 1;
		if ( $buzzstone_sticky_out ) {
			?>
			<div class="sticky_wrap columns_wrap">
			<?php
		}
		while ( have_posts() ) {
			the_post();
			if ( $buzzstone_sticky_out && ! is_sticky() ) {
				$buzzstone_sticky_out = false;
				?>
				</div>
				<?php
			}
			$buzzstone_part = $buzzstone_sticky_out && is_sticky() ? 'sticky' : 'extra';
			get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', $buzzstone_part ), $buzzstone_part );
		}
		if ( $buzzstone_sticky_out ) {
			$buzzstone_sticky_out = false;
			?>
			</div>
			<?php
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
