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
	$buzzstone_columns    = 1;
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
	<?php post_class( 'post_item post_layout_extra post_format_' . esc_attr( $buzzstone_post_format ) ); ?>
	<?php echo ( ! buzzstone_is_off( $buzzstone_animation ) && empty( $buzzstone_template_args['slider'] ) ? ' data-animation="' . esc_attr( buzzstone_get_animation_classes( $buzzstone_animation ) ) . '"' : '' ); ?>
	>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

    $all_cat = '';
	$cats = get_post_type()=='post' ? get_the_category_list(' ') : apply_filters('buzzstone_filter_get_post_categories', '');
	if($cats){
        $all_cat = '<span class="post_categories_style">'.$cats.'</span>';
    }
    $has_thumb = has_post_thumbnail();
    $extra_el = false;
    if(!$has_thumb && in_array($buzzstone_post_format, array('gallery')) && !buzzstone_exists_trx_addons()) {
        $extra_el = true;
    }

	$buzzstone_components = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'meta_parts' ) );
	$cats = '';
    $categories = 'categories';
    $pos = strpos($buzzstone_components, $categories);
    if ( $pos !==false ) {
        $cats = get_post_type()=='post' ? get_the_category_list(' ') : apply_filters('buzzstone_filter_get_post_categories', '');
        if (in_array($buzzstone_post_format, array('gallery')) || (!in_array($buzzstone_post_format, array('audio')) && has_post_thumbnail() && !empty($cats) ) ) {
            $cats = '<span class="post_categories_style">'.$cats.'</span>';
        } else {
            $cats = '';
        }
    }

    if($extra_el) {
        $cats = '';
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
            'post_info' => $cats,
            'thumb_bg' => true
		)
	);

    ?><div class="wrap_post_content"><?php


if ( $pos !==false && empty($cats)) {
    buzzstone_show_layout($all_cat);
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
			?>
		</div><!-- .post_header -->
		<?php
	}

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
						echo mb_substr( strip_tags( get_the_excerpt() ), 0, 100 ).'...';
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
					echo mb_substr( strip_tags( get_the_excerpt() ), 0, 100 ).'...';
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

	do_action( 'buzzstone_action_before_post_meta' );

	// Post meta
    $buzzstone_counters   = buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'counters' ) );

    $vowels = array(",categories", "categories,", "categories");
    $buzzstone_components = str_replace($vowels, "", $buzzstone_components);

			if ( ! empty( $buzzstone_components ) && ! in_array( $buzzstone_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				buzzstone_show_post_meta(
					apply_filters(
						'buzzstone_filter_post_meta_args', array(
							'components' => $buzzstone_components,
							'counters'   => $buzzstone_counters,
							'seo'        => false,
						), 'extra', 1
					)
				);
			}

	?>
	</div></article>
<?php

if ( is_array( $buzzstone_template_args ) ) {
	if ( ! empty( $buzzstone_template_args['slider'] ) || $buzzstone_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
