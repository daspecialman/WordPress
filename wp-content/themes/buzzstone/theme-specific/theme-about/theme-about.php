<?php
/**
 * Information about this theme
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.30
 */


// Redirect to the 'About Theme' page after switch theme
if ( ! function_exists( 'buzzstone_about_after_switch_theme' ) ) {
	add_action( 'after_switch_theme', 'buzzstone_about_after_switch_theme', 1000 );
	function buzzstone_about_after_switch_theme() {
		update_option( 'buzzstone_about_page', 1 );
	}
}
if ( ! function_exists( 'buzzstone_about_after_setup_theme' ) ) {
	add_action( 'init', 'buzzstone_about_after_setup_theme', 1000 );
	function buzzstone_about_after_setup_theme() {
		if ( ! defined( 'WP_CLI' ) && get_option( 'buzzstone_about_page' ) == 1 ) {
			update_option( 'buzzstone_about_page', 0 );
			wp_safe_redirect( admin_url() . 'themes.php?page=buzzstone_about' );
			exit();
		} else {
			if ( buzzstone_get_value_gp( 'page' ) == 'buzzstone_about' && buzzstone_exists_trx_addons() ) {
				wp_safe_redirect( admin_url() . 'admin.php?page=trx_addons_theme_panel' );
				exit();
			}
		}
	}
}


// Add 'About Theme' item in the Appearance menu
if ( ! function_exists( 'buzzstone_about_add_menu_items' ) ) {
	add_action( 'admin_menu', 'buzzstone_about_add_menu_items' );
	function buzzstone_about_add_menu_items() {
		if ( ! buzzstone_exists_trx_addons() ) {
			$theme      = wp_get_theme();
			$theme_name = $theme->name . ( BUZZSTONE_THEME_FREE ? ' ' . esc_html__( 'Free', 'buzzstone' ) : '' );
			add_theme_page(
				// Translators: Add theme name to the page title
				sprintf( esc_html__( 'About %s', 'buzzstone' ), $theme_name ),    //page title
				// Translators: Add theme name to the menu title
				sprintf( esc_html__( 'About %s', 'buzzstone' ), $theme_name ),    //menu title
				'manage_options',                                               //capability
				'buzzstone_about',                                                //menu slug
				'buzzstone_about_page_builder'                                   //callback
			);
		}
	}
}


// Load page-specific scripts and styles
if ( ! function_exists( 'buzzstone_about_enqueue_scripts' ) ) {
	add_action( 'admin_enqueue_scripts', 'buzzstone_about_enqueue_scripts' );
	function buzzstone_about_enqueue_scripts() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
		if ( ! empty( $screen->id ) && false !== strpos( $screen->id, '_page_buzzstone_about' ) ) {
			// Scripts
			if ( ! buzzstone_exists_trx_addons() && function_exists( 'buzzstone_plugins_installer_enqueue_scripts' ) ) {
				buzzstone_plugins_installer_enqueue_scripts();
			}
			// Styles
			$fdir = buzzstone_get_file_url( 'theme-specific/theme-about/theme-about.css' );
			if ( '' != $fdir ) {
				wp_enqueue_style( 'buzzstone-about', $fdir, array(), null );
			}
		}
	}
}


// Build 'About Theme' page
if ( ! function_exists( 'buzzstone_about_page_builder' ) ) {
	function buzzstone_about_page_builder() {
		$theme = wp_get_theme();
		?>
		<div class="buzzstone_about">

			<?php do_action( 'buzzstone_action_theme_about_start', $theme ); ?>

			<?php do_action( 'buzzstone_action_theme_about_before_logo', $theme ); ?>

			<div class="buzzstone_about_logo">
				<?php
				$logo = buzzstone_get_file_url( 'theme-specific/theme-about/icon.jpg' );
				if ( empty( $logo ) ) {
					$logo = buzzstone_get_file_url( 'screenshot.jpg' );
				}
				if ( ! empty( $logo ) ) {
					?>
					<img src="<?php echo esc_url( $logo ); ?>">
					<?php
				}
				?>
			</div>

			<?php do_action( 'buzzstone_action_theme_about_before_title', $theme ); ?>

			<h1 class="buzzstone_about_title">
			<?php
				echo esc_html(
					sprintf(
						// Translators: Add theme name and version to the 'Welcome' message
						__( 'Welcome to %1$s %2$s v.%3$s', 'buzzstone' ),
						$theme->name,
						BUZZSTONE_THEME_FREE ? __( 'Free', 'buzzstone' ) : '',
						$theme->version
					)
				);
			?>
			</h1>

			<?php do_action( 'buzzstone_action_theme_about_before_description', $theme ); ?>

			<div class="buzzstone_about_description">
				<p>
					<?php
					echo wp_kses_data( __( 'In order to continue, please install and activate the <b>ThemeREX Addons plugin</b>', 'buzzstone' ) );
					?>
					<sup>*</sup>
				</p>
			</div>

			<?php do_action( 'buzzstone_action_theme_about_before_buttons', $theme ); ?>

			<div class="buzzstone_about_buttons">
				<?php buzzstone_plugins_installer_get_button_html( 'trx_addons' ); ?>
			</div>

			<?php do_action( 'buzzstone_action_theme_about_before_buttons', $theme ); ?>

			<div class="buzzstone_about_notes">
				<p>
					<sup>*</sup>
					<?php
					echo wp_kses_data( __( "<i>ThemeREX Addons plugin</i> will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'buzzstone' ) );
					?>
				</p>
			</div>

			<?php do_action( 'buzzstone_action_theme_about_end', $theme ); ?>

		</div>
		<?php
	}
}


// Hide TGMPA notice on the page 'About Theme'
if ( ! function_exists( 'buzzstone_about_page_disable_tgmpa_notice' ) ) {
	add_filter( 'tgmpa_show_admin_notice_capability', 'buzzstone_about_page_disable_tgmpa_notice' );
	function buzzstone_about_page_disable_tgmpa_notice($cap) {
		if ( buzzstone_get_value_gp( 'page' ) == 'buzzstone_about' ) {
			$cap = 'unfiltered_upload';
		}
		return $cap;
	}
}

require_once BUZZSTONE_THEME_DIR . 'includes/plugins-installer/plugins-installer.php';
