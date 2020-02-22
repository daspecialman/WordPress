<?php
/* WPBakery PageBuilder support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'buzzstone_vc_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'buzzstone_vc_theme_setup9', 9 );
	function buzzstone_vc_theme_setup9() {

		add_filter( 'buzzstone_filter_merge_styles', 'buzzstone_vc_merge_styles' );
		add_filter( 'buzzstone_filter_merge_styles_responsive', 'buzzstone_vc_merge_styles_responsive' );

		if ( buzzstone_exists_vc() ) {

			// Add/Remove params in the standard VC shortcodes
			//-----------------------------------------------------
			add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'buzzstone_vc_add_params_classes', 10, 3 );
			add_filter( 'vc_iconpicker-type-fontawesome', 'buzzstone_vc_iconpicker_type_fontawesome' );

			// Color scheme
			$scheme  = array(
				'param_name'  => 'scheme',
				'heading'     => esc_html__( 'Color scheme', 'buzzstone' ),
				'description' => wp_kses_data( __( 'Select color scheme to decorate this block', 'buzzstone' ) ),
				'group'       => esc_html__( 'Colors', 'buzzstone' ),
				'admin_label' => true,
				'value'       => array_flip( buzzstone_get_list_schemes( true ) ),
				'type'        => 'dropdown',
			);
			$sc_list = apply_filters( 'buzzstone_filter_add_scheme_in_vc', array( 'vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text' ) );
			foreach ( $sc_list as $sc ) {
				vc_add_param( $sc, $scheme );
			}

			// Load custom VC styles for blog archive page
			add_filter( 'buzzstone_filter_blog_archive_start', 'buzzstone_vc_add_inline_css' );
		}

		if ( is_admin() ) {
			add_filter( 'buzzstone_filter_tgmpa_required_plugins', 'buzzstone_vc_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'buzzstone_vc_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('buzzstone_filter_tgmpa_required_plugins',	'buzzstone_vc_tgmpa_required_plugins');
	function buzzstone_vc_tgmpa_required_plugins( $list = array() ) {
		if ( buzzstone_storage_isset( 'required_plugins', 'js_composer' ) && buzzstone_is_theme_activated() ) {
			$path = buzzstone_get_plugin_source_path( 'plugins/js_composer/js_composer.zip' );
			if ( ! empty( $path ) || buzzstone_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => buzzstone_storage_get_array( 'required_plugins', 'js_composer' ),
					'slug'     => 'js_composer',
                    'version'   => '6.1',
					'source'   => ! empty( $path ) ? $path : 'upload://js_composer.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'buzzstone_exists_vc' ) ) {
	function buzzstone_exists_vc() {
		return class_exists( 'Vc_Manager' );
	}
}

// Check if plugin in frontend editor mode
if ( ! function_exists( 'buzzstone_vc_is_frontend' ) ) {
	function buzzstone_vc_is_frontend() {
		return ( isset( $_GET['vc_editable'] ) && 'true' == $_GET['vc_editable'] )
			|| ( isset( $_GET['vc_action'] ) && 'vc_inline' == $_GET['vc_action'] );
	}
}

// Merge custom styles
if ( ! function_exists( 'buzzstone_vc_merge_styles' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_styles', 'buzzstone_vc_merge_styles');
	function buzzstone_vc_merge_styles( $list ) {
		if ( buzzstone_exists_vc() ) {
			$list[] = 'plugins/js_composer/_js_composer.scss';
		}
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'buzzstone_vc_merge_styles_responsive' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_styles_responsive', 'buzzstone_vc_merge_styles_responsive');
	function buzzstone_vc_merge_styles_responsive( $list ) {
		if ( buzzstone_exists_vc() ) {
			$list[] = 'plugins/js_composer/_js_composer-responsive.scss';
		}
		return $list;
	}
}

// Add VC custom styles to the inline CSS
if ( ! function_exists( 'buzzstone_vc_add_inline_css' ) ) {
	//Handler of the add_filter('buzzstone_filter_blog_archive_start', 'buzzstone_vc_add_inline_css');
	function buzzstone_vc_add_inline_css( $html ) {
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $vc_custom_css ) ) {
			buzzstone_add_inline_css( strip_tags( $vc_custom_css ) );
		}
		return $html;
	}
}



// Shortcodes support
//------------------------------------------------------------------------

// Add params to the standard VC shortcodes
if ( ! function_exists( 'buzzstone_vc_add_params_classes' ) ) {
	//Handler of the add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'buzzstone_vc_add_params_classes', 10, 3 );
	function buzzstone_vc_add_params_classes( $classes, $sc, $atts ) {
		// Add color scheme
		if ( in_array( $sc, apply_filters( 'buzzstone_filter_add_scheme_in_vc', array( 'vc_section', 'vc_row', 'vc_row_inner', 'vc_column', 'vc_column_inner', 'vc_column_text' ) ) ) ) {
			if ( ! empty( $atts['scheme'] ) && ! buzzstone_is_inherit( $atts['scheme'] ) ) {
				$classes .= ( $classes ? ' ' : '' ) . 'scheme_' . $atts['scheme'];
			}
		}
		return $classes;
	}
}

// Add theme icons to the VC iconpicker list
if ( ! function_exists( 'buzzstone_vc_iconpicker_type_fontawesome' ) ) {
	//Handler of the add_filter( 'vc_iconpicker-type-fontawesome',	'buzzstone_vc_iconpicker_type_fontawesome' );
	function buzzstone_vc_iconpicker_type_fontawesome( $icons ) {
		$list = buzzstone_get_list_icons_classes();
		if ( ! is_array( $list ) || count( $list ) == 0 ) {
			return $icons;
		}
		$rez = array();
		foreach ( $list as $icon ) {
			$rez[] = array( $icon => str_replace( 'icon-', '', $icon ) );
		}
		return array_merge( $icons, array( esc_html__( 'Theme Icons', 'buzzstone' ) => $rez ) );
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( buzzstone_exists_vc() ) {
	require_once BUZZSTONE_THEME_DIR . 'plugins/js_composer/js_composer-styles.php'; }

