<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.10
 */

// Footer sidebar
$buzzstone_footer_name    = buzzstone_get_theme_option( 'footer_widgets' );
$buzzstone_footer_present = ! buzzstone_is_off( $buzzstone_footer_name ) && is_active_sidebar( $buzzstone_footer_name );
if ( $buzzstone_footer_present ) {
	buzzstone_storage_set( 'current_sidebar', 'footer' );
	$buzzstone_footer_wide = buzzstone_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $buzzstone_footer_name ) ) {
		dynamic_sidebar( $buzzstone_footer_name );
	}
	$buzzstone_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $buzzstone_out ) ) {
		$buzzstone_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $buzzstone_out );
		$buzzstone_need_columns = true;  
		if ( $buzzstone_need_columns ) {
			$buzzstone_columns = max( 0, (int) buzzstone_get_theme_option( 'footer_columns' ) );
			if ( 0 == $buzzstone_columns ) {
				$buzzstone_columns = min( 4, max( 1, substr_count( $buzzstone_out, '<aside ' ) ) );
			}
			if ( $buzzstone_columns > 1 ) {
				$buzzstone_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $buzzstone_columns ) . ' widget', $buzzstone_out );
			} else {
				$buzzstone_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $buzzstone_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $buzzstone_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $buzzstone_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'buzzstone_action_before_sidebar' );
				buzzstone_show_layout( $buzzstone_out );
				do_action( 'buzzstone_action_after_sidebar' );
				if ( $buzzstone_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $buzzstone_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
