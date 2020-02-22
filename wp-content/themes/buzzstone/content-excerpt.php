<?php
/**
 * The default template to display the content
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
	if ( ! empty( $buzzstone_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $buzzstone_columns > 1 ) {
		?>
		<div class="column-1_<?php echo esc_attr( $buzzstone_columns ); ?>">
		<?php
	}
}
$buzzstone_expanded    = ! buzzstone_sidebar_present() && buzzstone_is_on( buzzstone_get_theme_option( 'expand_content' ) );
$buzzstone_post_format = get_post_format();
$buzzstone_post_format = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );
$buzzstone_animation   = buzzstone_get_theme_option( 'blog_animation' );
$show_link = false;

?>
<article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_' . esc_attr( $buzzstone_post_format ) ); ?>
	<?php echo ( ! buzzstone_is_off( $buzzstone_animation ) && empty( $buzzstone_template_args['slider'] ) ? ' data-animation="' . esc_attr( buzzstone_get_animation_classes( $buzzstone_animation ) ) . '"' : '' ); ?>
	>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}



	// Title and post meta
	if ( get_the_title() != '' ) {
		?>
		<div class="post_header entry-header">
			<?php
			do_action( 'buzzstone_action_before_post_title' );

			// Post title
			if ( empty( $buzzstone_template_args['no_links'] ) ) {
				the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			} else {
				the_title( '<h2 class="post_title entry-title">', '</h2>' );
			}

			do_action( 'buzzstone_action_before_post_meta' );

			// Post meta
			$buzzstone_components = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'meta_parts' ) );
			$buzzstone_counters   = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'counters' ) );

			if ( ! empty( $buzzstone_components ) ) {
				buzzstone_show_post_meta(
					apply_filters(
						'buzzstone_filter_post_meta_args', array(
							'components' => $buzzstone_components,
							'counters'   => $buzzstone_counters,
							'seo'        => false,
						), 'excerpt', 1
					)
				);
			}
			?>
		</div><!-- .post_header -->
		<?php
	} else {
	    $show_link = true;
	}

	// Featured image
	$buzzstone_hover = ! empty( $buzzstone_template_args['hover'] ) && ! buzzstone_is_inherit( $buzzstone_template_args['hover'] )
						? $buzzstone_template_args['hover']
						: buzzstone_get_theme_option( 'image_hover' );
	buzzstone_show_post_featured(
		array(
			'singular'   => false,
			'no_links'   => ! empty( $buzzstone_template_args['no_links'] ),
			'hover'      => $buzzstone_hover,
			'thumb_size' => buzzstone_get_thumb_size( strpos( buzzstone_get_theme_option( 'body_style' ), 'full' ) !== false ? 'full' : ( $buzzstone_expanded ? 'huge' : 'big' ) ),
		)
	);

	if ( !empty(get_the_content()) ) {
    ?><div class="wrap_post_content"><?php

	// Post taxonomies
	the_tags( '<div class="info_post_tags">', '', '</div>' );

	// Post content
	if ( empty( $buzzstone_template_args['hide_excerpt'] ) ) {
		?>
		<div class="post_content entry-content">
		<?php
		if ( buzzstone_get_theme_option( 'blog_content' ) == 'fullpost' ) {
			// Post content area
			?>
				<div class="post_content_inner">
				<?php
				the_content( '' );
				?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'buzzstone' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'buzzstone' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
		} else {
			// Post content area
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
				// More button
				if ( $show_link && empty( $buzzstone_template_args['no_links'] ) && ! in_array( $buzzstone_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
					?>
					<p><a class="more-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read more', 'buzzstone' ); ?></a></p>
					<?php
				}
		}
		?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
	</div><?php } ?></article>
<?php

if ( is_array( $buzzstone_template_args ) ) {
	if ( ! empty( $buzzstone_template_args['slider'] ) || $buzzstone_columns > 1 ) {
		?>
		</div>
		<?php
	}
}