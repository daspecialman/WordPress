<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$buzzstone_post_format = get_post_format();
$buzzstone_post_format = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );
$buzzstone_animation   = buzzstone_get_theme_option( 'blog_animation' );

?><div class="column-1_<?php echo esc_attr( $buzzstone_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $buzzstone_post_format ) ); ?>
	<?php echo ( ! buzzstone_is_off( $buzzstone_animation ) ? ' data-animation="' . esc_attr( buzzstone_get_animation_classes( $buzzstone_animation ) ) . '"' : '' ); ?>
	>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	buzzstone_show_post_featured(
		array(
			'thumb_size' => buzzstone_get_thumb_size( 1 == $buzzstone_columns ? 'big' : ( 2 == $buzzstone_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $buzzstone_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			buzzstone_show_post_meta( apply_filters( 'buzzstone_filter_post_meta_args', array(), 'sticky', $buzzstone_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php


