<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_seo = buzzstone_is_on( buzzstone_get_theme_option( 'seo_snippets' ) );
?>
<article id="post-<?php the_ID(); ?>"
	<?php
	post_class('post_item_single post_type_' . esc_attr( get_post_type() )
		. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
	);
	if ( $buzzstone_seo ) {
		?>
		itemscope="itemscope"
		itemprop="articleBody"
		itemtype="http://schema.org/<?php echo esc_attr( buzzstone_get_markup_schema() ); ?>"
		itemid="<?php echo esc_url( get_the_permalink() ); ?>"
		content="<?php echo esc_attr( get_the_title() ); ?>"
		<?php
	}
	?>
>
<?php

	do_action( 'buzzstone_action_before_post_data' );

	// Structured data snippets
	if ( $buzzstone_seo ) {
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/seo' ) );
	}

	if ( is_singular( 'post' ) ) {
		$buzzstone_post_thumbnail_type  = buzzstone_get_theme_option( 'post_thumbnail_type' );
		$buzzstone_post_header_position = buzzstone_get_theme_option( 'post_header_position' );
		$buzzstone_post_header_align    = buzzstone_get_theme_option( 'post_header_align' );

		if ( 'default' === $buzzstone_post_thumbnail_type ) {
			?>
			<div class="header_content_wrap header_align_<?php echo esc_attr( $buzzstone_post_header_align ); ?>">
				<?php
				// Post title and meta
				if ( 'above' === $buzzstone_post_header_position ) {
					buzzstone_show_post_title_and_meta();
				}

				// Featured image
				buzzstone_show_post_featured_image();

				// Post title and meta
				if ( 'above' !== $buzzstone_post_header_position ) {
					buzzstone_show_post_title_and_meta();
				}
				?>
			</div>
			<?php
		} elseif ( 'default' === $buzzstone_post_header_position ) {
			// Post title and meta
			buzzstone_show_post_title_and_meta();
		}
	}

	do_action( 'buzzstone_action_before_post_content' );

	// Post content
	?>
	<div class="post_content post_content_single entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content();

		do_action( 'buzzstone_action_before_post_pagination' );

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

		// Taxonomies and share
		if ( is_single() && ! is_attachment() ) {

			do_action( 'buzzstone_action_before_post_meta' );

			// Post rating
			do_action(
				'trx_addons_action_post_rating', array(
					'class'                => 'single_post_rating',
					'rating_text_template' => esc_html__( 'Post rating: {{X}} from {{Y}} (according {{V}})', 'buzzstone' ),
				)
			);

			?>
			<div class="post_meta post_meta_single">
				<?php

				// Post taxonomies
				the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">' . esc_html__( 'Tags:', 'buzzstone' ) . '</span> ', '', '</span>' );

				// Share
				if ( buzzstone_is_on( buzzstone_get_theme_option( 'show_share_links' ) ) ) {
					buzzstone_show_share_links(
						array(
							'type'    => 'block',
							'caption' => '',
							'before'  => '<div class="post_meta_item post_share"><span class="post_meta_label">'.esc_html__( 'Share this post:', 'buzzstone' ).'</span>',
							'after'   => '</div>',
						)
					);
				}
				?>
			</div>
			<?php

			do_action( 'buzzstone_action_after_post_meta' );
		}
		?>
	</div><!-- .entry-content -->


	<?php
	do_action( 'buzzstone_action_after_post_content' );

	// Author bio
	if ( buzzstone_get_theme_option( 'show_author_info' ) == 1 && is_single() && ! is_attachment() && get_the_author_meta( 'description' ) ) {
		do_action( 'buzzstone_action_before_post_author' );
		get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/author-bio' ) );
		do_action( 'buzzstone_action_after_post_author' );
	}

	do_action( 'buzzstone_action_after_post_data' );
	?>
</article>
