<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

						// Widgets area inside page content
						buzzstone_create_widgets_area( 'widgets_below_content' );
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					$buzzstone_body_style = buzzstone_get_theme_option( 'body_style' );
					if ( 'fullscreen' != $buzzstone_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}

					// Widgets area below page content and related posts below page content
					$buzzstone_widgets_name = buzzstone_get_theme_option( 'widgets_below_page' );
					$buzzstone_show_widgets = ! buzzstone_is_off( $buzzstone_widgets_name ) && is_active_sidebar( $buzzstone_widgets_name );
					$buzzstone_show_related = is_single() && buzzstone_get_theme_option( 'related_position' ) == 'below_page';
					if ( $buzzstone_show_widgets || $buzzstone_show_related ) {
						if ( 'fullscreen' != $buzzstone_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $buzzstone_show_related ) {
							do_action( 'buzzstone_action_related_posts' );
						}

						// Widgets area below page content
						if ( $buzzstone_show_widgets ) {
							buzzstone_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $buzzstone_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Single posts banner before footer
			if ( is_singular( 'post' ) ) {
				buzzstone_show_post_banner('footer');
			}
			// Footer
			$buzzstone_footer_type = buzzstone_get_theme_option( 'footer_type' );
			if ( 'custom' == $buzzstone_footer_type && ! buzzstone_is_layouts_available() ) {
				$buzzstone_footer_type = 'default';
			}
			get_template_part( apply_filters( 'buzzstone_filter_get_template_part', "templates/footer-{$buzzstone_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>