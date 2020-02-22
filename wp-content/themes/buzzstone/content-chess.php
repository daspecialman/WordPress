<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_template_args = get_query_var( 'buzzstone_template_args' );
if ( is_array( $buzzstone_template_args ) ) {
	$buzzstone_columns    = empty( $buzzstone_template_args['columns'] ) ? 1 : max( 1, min( 3, $buzzstone_template_args['columns'] ) );
	$buzzstone_blog_style = array( $buzzstone_template_args['type'], $buzzstone_columns );
} else {
	$buzzstone_blog_style = explode( '_', buzzstone_get_theme_option( 'blog_style' ) );
	$buzzstone_columns    = empty( $buzzstone_blog_style[1] ) ? 1 : max( 1, min( 3, $buzzstone_blog_style[1] ) );
}
$buzzstone_expanded    = ! buzzstone_sidebar_present() && buzzstone_is_on( buzzstone_get_theme_option( 'expand_content' ) );
$buzzstone_post_format = get_post_format();
$buzzstone_post_format = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );
$buzzstone_animation   = buzzstone_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_chess'
										. ' post_layout_chess_' . esc_attr( $buzzstone_columns )
										. ' post_format_' . esc_attr( $buzzstone_post_format )
										. ( ! empty( $buzzstone_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! buzzstone_is_off( $buzzstone_animation ) && empty( $buzzstone_template_args['slider'] ) ? ' data-animation="' . esc_attr( buzzstone_get_animation_classes( $buzzstone_animation ) ) . '"' : '' );
									?>
	>

	<?php
	// Add anchor
	if ( 1 == $buzzstone_columns && ! is_array( $buzzstone_template_args ) && shortcode_exists( 'trx_sc_anchor' ) ) {
		echo do_shortcode( '[trx_sc_anchor id="post_' . esc_attr( get_the_ID() ) . '" title="' . esc_attr( get_the_title() ) . '" icon="' . esc_attr( buzzstone_get_post_icon() ) . '"]' );
	}

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$buzzstone_hover = ! empty( $buzzstone_template_args['hover'] ) && ! buzzstone_is_inherit( $buzzstone_template_args['hover'] )
						? $buzzstone_template_args['hover']
						: buzzstone_get_theme_option( 'image_hover' );
	buzzstone_show_post_featured(
		array(
			'class'         => 1 == $buzzstone_columns && ! is_array( $buzzstone_template_args ) ? 'buzzstone-full-height' : '',
			'singular'      => false,
			'hover'         => $buzzstone_hover,
			'no_links'      => ! empty( $buzzstone_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => buzzstone_get_thumb_size(
				strpos( buzzstone_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $buzzstone_columns ? 'huge' : 'original' )
										: ( 2 < $buzzstone_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'buzzstone_action_before_post_title' );

			// Post title
		if ( empty( $buzzstone_template_args['no_links'] ) ) {
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		} else {
			the_title( '<h3 class="post_title entry-title">', '</h3>' );
		}

			do_action( 'buzzstone_action_before_post_meta' );

			// Post meta
			$buzzstone_components = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'meta_parts' ) );
			$buzzstone_counters   = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'counters' ) );
			$buzzstone_post_meta  = empty( $buzzstone_components ) || in_array( $buzzstone_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: buzzstone_show_post_meta(
											apply_filters(
												'buzzstone_filter_post_meta_args', array(
													'components' => $buzzstone_components,
													'counters' => $buzzstone_counters,
													'seo'  => false,
													'echo' => false,
												), $buzzstone_blog_style[0], $buzzstone_columns
											)
										);
			buzzstone_show_layout( $buzzstone_post_meta );
			?>
		</div><!-- .entry-header -->

		<div class="post_content entry-content">
		<?php
		if ( empty( $buzzstone_template_args['hide_excerpt'] ) ) {
			?>
				<div class="post_content_inner">
				<?php
				if ( has_excerpt() ) {
					the_excerpt();
				} elseif ( strpos( get_the_content( '!--more' ), '!--more' ) !== false ) {
					the_content( '' );
				} elseif ( in_array( $buzzstone_post_format, array( 'link', 'aside', 'status' ) ) ) {
					the_content();
				} elseif ( 'quote' == $buzzstone_post_format ) {
					$quote = buzzstone_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
					if ( ! empty( $quote ) ) {
						buzzstone_show_layout( wpautop( $quote ) );
					} else {
						the_excerpt();
					}
				} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
					the_excerpt();
				}
				?>
				</div>
				<?php
		}
			// Post meta
		if ( in_array( $buzzstone_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			buzzstone_show_layout( $buzzstone_post_meta );
		}
			// More button
		if ( empty( $buzzstone_template_args['no_links'] ) && ! in_array( $buzzstone_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			?>
				<p><a class="more-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read more', 'buzzstone' ); ?></a></p>
				<?php
		}
		?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
