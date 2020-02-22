<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

if ( buzzstone_sidebar_present() ) {
	ob_start();
	$buzzstone_sidebar_name = buzzstone_get_theme_option( 'sidebar_widgets' );
	buzzstone_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $buzzstone_sidebar_name ) ) {
		dynamic_sidebar( $buzzstone_sidebar_name );
	}
	$buzzstone_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $buzzstone_out ) ) {
		$buzzstone_sidebar_position = buzzstone_get_theme_option( 'sidebar_position' );
		?>
		<div class="sidebar widget_area
			<?php
			echo esc_attr( $buzzstone_sidebar_position );
			if ( ! buzzstone_is_inherit( buzzstone_get_theme_option( 'sidebar_scheme' ) ) ) {
				echo ' scheme_' . esc_attr( buzzstone_get_theme_option( 'sidebar_scheme' ) );
			}
			?>
		" role="complementary">
		<?php
			// Single posts banner before sidebar
			buzzstone_show_post_banner( 'sidebar' ); ?>
			<div class="sidebar_inner">
				<?php
				do_action( 'buzzstone_action_before_sidebar' );
				buzzstone_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $buzzstone_out ) );
				do_action( 'buzzstone_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
