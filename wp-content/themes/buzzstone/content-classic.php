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
	$buzzstone_columns    = empty( $buzzstone_template_args['columns'] ) ? 2 : max( 1, $buzzstone_template_args['columns'] );
	$buzzstone_blog_style = array( $buzzstone_template_args['type'], $buzzstone_columns );
} else {
	$buzzstone_blog_style = explode( '_', buzzstone_get_theme_option( 'blog_style' ) );
	$buzzstone_columns    = empty( $buzzstone_blog_style[1] ) ? 2 : max( 1, $buzzstone_blog_style[1] );
}
$buzzstone_expanded   = ! buzzstone_sidebar_present() && buzzstone_is_on( buzzstone_get_theme_option( 'expand_content' ) );
$buzzstone_animation  = buzzstone_get_theme_option( 'blog_animation' );
$buzzstone_components = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'meta_parts' ) );
$buzzstone_counters   = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'counters' ) );

$buzzstone_post_format = get_post_format();
$buzzstone_post_format = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );

?><div class="
<?php
if ( ! empty( $buzzstone_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( 'classic' == $buzzstone_blog_style[0] ? 'column' : 'masonry_item masonry_item' ) . '-1_' . esc_attr( $buzzstone_columns );
}
?>
"><article id="post-<?php the_ID(); ?>"
	<?php
		post_class(
			'post_item post_format_' . esc_attr( $buzzstone_post_format )
					. ' post_layout_classic post_layout_classic_' . esc_attr( $buzzstone_columns )
					. ' post_layout_' . esc_attr( $buzzstone_blog_style[0] )
					. ' post_layout_' . esc_attr( $buzzstone_blog_style[0] ) . '_' . esc_attr( $buzzstone_columns )
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

	// Featured image
	$buzzstone_hover = ! empty( $buzzstone_template_args['hover'] ) && ! buzzstone_is_inherit( $buzzstone_template_args['hover'] )
						? $buzzstone_template_args['hover']
						: buzzstone_get_theme_option( 'image_hover' );
	buzzstone_show_post_featured(
		array(
			'thumb_size' => buzzstone_get_thumb_size(
				'classic' == $buzzstone_blog_style[0]
						? ( strpos( buzzstone_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $buzzstone_columns > 2 ? 'big' : 'huge' )
								: ( $buzzstone_columns > 2
									? ( $buzzstone_expanded ? 'med' : 'small' )
									: ( $buzzstone_expanded ? 'big' : 'med' )
									)
							)
						: ( strpos( buzzstone_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $buzzstone_columns > 2 ? 'masonry-big' : 'full' )
								: ( $buzzstone_columns <= 2 && $buzzstone_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $buzzstone_hover,
			'no_links'   => ! empty( $buzzstone_template_args['no_links'] ),
			'singular'   => false,
		)
	);
    ?>
    <div class="classic_post_wrap">
    <?php
	if ( ! in_array( $buzzstone_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php


            $categories = 'categories';
            $pos = strpos($buzzstone_components, $categories);
            if ( $pos !==false ) {
                $buzzstone_cat = $categories;
            } else {
                $buzzstone_cat = '';
            }
            if ( ! empty( $buzzstone_cat ) ) {
                buzzstone_show_post_meta(
                    apply_filters(
                        'buzzstone_filter_post_meta_args', array(
                        'components' => $buzzstone_cat,
                        'counters'   => '',
                        'seo'        => false,
                    ), $buzzstone_blog_style[0], $buzzstone_columns
                    )
                );
            }


			do_action( 'buzzstone_action_before_post_title' );

			// Post title
			if ( empty( $buzzstone_template_args['no_links'] ) ) {
				the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			} else {
				the_title( '<h4 class="post_title entry-title">', '</h4>' );
			}

			do_action( 'buzzstone_action_before_post_meta' );

			// Post meta
            $vowels = array(",categories", "categories,", "categories");
            $buzzstone_components = str_replace($vowels, "", $buzzstone_components);
			if ( ! empty( $buzzstone_components ) && ! in_array( $buzzstone_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				buzzstone_show_post_meta(
					apply_filters(
						'buzzstone_filter_post_meta_args', array(
							'components' => $buzzstone_components,
							'counters'   => $buzzstone_counters,
							'seo'        => false,
						), $buzzstone_blog_style[0], $buzzstone_columns
					)
				);
			}

			do_action( 'buzzstone_action_after_post_meta' );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>

    <?php
    if ( empty( $buzzstone_template_args['hide_excerpt'] ) ) {
    ?>

	<div class="post_content entry-content">
	<?php
	if ( empty( $buzzstone_template_args['hide_excerpt'] ) ) {
		?>
			<div class="post_content_inner">
			<?php
			if ( has_excerpt() ) {
                echo mb_substr( strip_tags( get_the_excerpt() ), 0, 113 ).'...';
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
                echo mb_substr( strip_tags( get_the_excerpt() ), 0, 113 ).'...';
			}
			?>
			</div>
			<?php
	}
		// Post meta
	if ( in_array( $buzzstone_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		if ( ! empty( $buzzstone_components ) ) {
			buzzstone_show_post_meta(
				apply_filters(
					'buzzstone_filter_post_meta_args', array(
						'components' => $buzzstone_components,
						'counters'   => $buzzstone_counters,
					), $buzzstone_blog_style[0], $buzzstone_columns
				)
			);
		}
	}
	// More button
	if ( false && empty( $buzzstone_template_args['no_links'] ) && ! in_array( $buzzstone_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
			<p><a class="more-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read more', 'buzzstone' ); ?></a></p>
			<?php
	}
	?>
	</div>

    <?php
    }
    ?>


	</div><!-- .entry-content -->

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
