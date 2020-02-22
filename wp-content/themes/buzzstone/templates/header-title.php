<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

// Page (category, tag, archive, author) title
if ( buzzstone_need_page_title() && buzzstone_is_on( buzzstone_get_theme_option( 'top_title' ) ) ) {
	buzzstone_sc_layouts_showed( 'title', true );
	buzzstone_sc_layouts_showed( 'postmeta', false );
	?>
	<div class="top_panel_title">
		<div class="content_wrap_go <?php echo esc_attr(buzzstone_is_on( buzzstone_get_theme_option( 'top_title_big' ) ) ? ' bigger' : '' ); ?>">
			<div class="sc_layouts_column sc_layouts_column_align_left">
					<div class="sc_layouts_title sc_align_left">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								buzzstone_show_post_meta(
									apply_filters(
										'buzzstone_filter_post_meta_args', array(
											'components' => buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'meta_parts' ) ),
											'counters'   => buzzstone_array_get_keys_by_value( buzzstone_get_theme_option( 'counters' ) ),
											'seo'        => buzzstone_is_on( buzzstone_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$buzzstone_blog_title           = buzzstone_get_blog_title();
							$buzzstone_blog_title_text      = '';
							$buzzstone_blog_title_class     = '';
							$buzzstone_blog_title_link      = '';
							$buzzstone_blog_title_link_text = '';
							if ( is_array( $buzzstone_blog_title ) ) {
								$buzzstone_blog_title_text      = $buzzstone_blog_title['text'];
								$buzzstone_blog_title_class     = ! empty( $buzzstone_blog_title['class'] ) ? ' ' . $buzzstone_blog_title['class'] : '';
								$buzzstone_blog_title_link      = ! empty( $buzzstone_blog_title['link'] ) ? $buzzstone_blog_title['link'] : '';
								$buzzstone_blog_title_link_text = ! empty( $buzzstone_blog_title['link_text'] ) ? $buzzstone_blog_title['link_text'] : '';
							} else {
								$buzzstone_blog_title_text = $buzzstone_blog_title;
							}
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr( $buzzstone_blog_title_class ); ?>">
								<?php
                                $title_top_icon = buzzstone_get_theme_option('title_icon');
                                if ( ! empty( $title_top_icon ) ) {
                                    echo '<span class="title_top_icon '.esc_attr($title_top_icon).'"></span>';
                                }
								$buzzstone_top_icon = buzzstone_get_category_icon();
								if ( ! empty( $buzzstone_top_icon ) ) {
									$buzzstone_attr = buzzstone_getimagesize( $buzzstone_top_icon );
									?>
									<img src="<?php echo esc_url( $buzzstone_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'buzzstone' ); ?>"
										<?php
										if ( ! empty( $buzzstone_attr[3] ) ) {
											buzzstone_show_layout( $buzzstone_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_post( $buzzstone_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $buzzstone_blog_title_link ) && ! empty( $buzzstone_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $buzzstone_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $buzzstone_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
                        if(false){
						?>
						<div class="sc_layouts_title_breadcrumbs">
							<?php
							do_action( 'buzzstone_action_breadcrumbs' );
							?>
						</div>
                        <?php } ?>
					</div>
			</div>
		</div>
	</div>
	<?php
}
?>