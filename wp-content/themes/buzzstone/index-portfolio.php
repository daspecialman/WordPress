<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

buzzstone_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	buzzstone_blog_archive_start();

	$buzzstone_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$buzzstone_sticky_out = buzzstone_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $buzzstone_stickies ) && count( $buzzstone_stickies ) > 0 && get_query_var( 'paged' ) < 1;

	// Show filters
	$buzzstone_cat          = buzzstone_get_theme_option( 'parent_cat' );
	$buzzstone_post_type    = buzzstone_get_theme_option( 'post_type' );
	$buzzstone_taxonomy     = buzzstone_get_post_type_taxonomy( $buzzstone_post_type );
	$buzzstone_show_filters = buzzstone_get_theme_option( 'show_filters' );
	$buzzstone_tabs         = array();
	if ( ! buzzstone_is_off( $buzzstone_show_filters ) ) {
		$buzzstone_args           = array(
			'type'         => $buzzstone_post_type,
			'child_of'     => $buzzstone_cat,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => $buzzstone_taxonomy,
			'pad_counts'   => false,
		);
		$buzzstone_portfolio_list = get_terms( $buzzstone_args );
		if ( is_array( $buzzstone_portfolio_list ) && count( $buzzstone_portfolio_list ) > 0 ) {
			$buzzstone_tabs[ $buzzstone_cat ] = esc_html__( 'All', 'buzzstone' );
			foreach ( $buzzstone_portfolio_list as $buzzstone_term ) {
				if ( isset( $buzzstone_term->term_id ) ) {
					$buzzstone_tabs[ $buzzstone_term->term_id ] = $buzzstone_term->name;
				}
			}
		}
	}
	if ( count( $buzzstone_tabs ) > 0 ) {
		$buzzstone_portfolio_filters_ajax   = true;
		$buzzstone_portfolio_filters_active = $buzzstone_cat;
		$buzzstone_portfolio_filters_id     = 'portfolio_filters';
		?>
		<div class="portfolio_filters buzzstone_tabs buzzstone_tabs_ajax">
			<ul class="portfolio_titles buzzstone_tabs_titles">
				<?php
				foreach ( $buzzstone_tabs as $buzzstone_id => $buzzstone_title ) {
					?>
					<li><a href="<?php echo esc_url( buzzstone_get_hash_link( sprintf( '#%s_%s_content', $buzzstone_portfolio_filters_id, $buzzstone_id ) ) ); ?>" data-tab="<?php echo esc_attr( $buzzstone_id ); ?>"><?php echo esc_html( $buzzstone_title ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
			$buzzstone_ppp = buzzstone_get_theme_option( 'posts_per_page' );
			if ( buzzstone_is_inherit( $buzzstone_ppp ) ) {
				$buzzstone_ppp = '';
			}
			foreach ( $buzzstone_tabs as $buzzstone_id => $buzzstone_title ) {
				$buzzstone_portfolio_need_content = $buzzstone_id == $buzzstone_portfolio_filters_active || ! $buzzstone_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr( sprintf( '%s_%s_content', $buzzstone_portfolio_filters_id, $buzzstone_id ) ); ?>"
					class="portfolio_content buzzstone_tabs_content"
					data-blog-template="<?php echo esc_attr( buzzstone_storage_get( 'blog_template' ) ); ?>"
					data-blog-style="<?php echo esc_attr( buzzstone_get_theme_option( 'blog_style' ) ); ?>"
					data-posts-per-page="<?php echo esc_attr( $buzzstone_ppp ); ?>"
					data-post-type="<?php echo esc_attr( $buzzstone_post_type ); ?>"
					data-taxonomy="<?php echo esc_attr( $buzzstone_taxonomy ); ?>"
					data-cat="<?php echo esc_attr( $buzzstone_id ); ?>"
					data-parent-cat="<?php echo esc_attr( $buzzstone_cat ); ?>"
					data-need-content="<?php echo ( false === $buzzstone_portfolio_need_content ? 'true' : 'false' ); ?>"
				>
					<?php
					if ( $buzzstone_portfolio_need_content ) {
						buzzstone_show_portfolio_posts(
							array(
								'cat'        => $buzzstone_id,
								'parent_cat' => $buzzstone_cat,
								'taxonomy'   => $buzzstone_taxonomy,
								'post_type'  => $buzzstone_post_type,
								'page'       => 1,
								'sticky'     => $buzzstone_sticky_out,
							)
						);
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		buzzstone_show_portfolio_posts(
			array(
				'cat'        => $buzzstone_cat,
				'parent_cat' => $buzzstone_cat,
				'taxonomy'   => $buzzstone_taxonomy,
				'post_type'  => $buzzstone_post_type,
				'page'       => 1,
				'sticky'     => $buzzstone_sticky_out,
			)
		);
	}

	buzzstone_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
