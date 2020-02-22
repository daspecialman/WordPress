<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

// Header sidebar
$buzzstone_header_name    = buzzstone_get_theme_option( 'header_widgets' );
$buzzstone_header_present = ! buzzstone_is_off( $buzzstone_header_name ) && is_active_sidebar( $buzzstone_header_name );
if ( $buzzstone_header_present ) {
	buzzstone_storage_set( 'current_sidebar', 'header' );
	$buzzstone_header_wide = buzzstone_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $buzzstone_header_name ) ) {
		dynamic_sidebar( $buzzstone_header_name );
	}
	$buzzstone_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $buzzstone_widgets_output ) ) {
		$buzzstone_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $buzzstone_widgets_output );
		$buzzstone_need_columns   = strpos( $buzzstone_widgets_output, 'columns_wrap' ) === false;
		if ( $buzzstone_need_columns ) {
			$buzzstone_columns = max( 0, (int) buzzstone_get_theme_option( 'header_columns' ) );
			if ( 0 == $buzzstone_columns ) {
				$buzzstone_columns = min( 6, max( 1, substr_count( $buzzstone_widgets_output, '<aside ' ) ) );
			}
			if ( $buzzstone_columns > 1 ) {
				$buzzstone_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $buzzstone_columns ) . ' widget', $buzzstone_widgets_output );
			} else {
				$buzzstone_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $buzzstone_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $buzzstone_header_wide ) {
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
				buzzstone_show_layout( $buzzstone_widgets_output );
				do_action( 'buzzstone_action_after_sidebar' );
				if ( $buzzstone_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $buzzstone_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
