<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'buzzstone_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'buzzstone_cf7_theme_setup9', 9 );
	function buzzstone_cf7_theme_setup9() {

		add_filter( 'buzzstone_filter_merge_scripts', 'buzzstone_cf7_merge_scripts' );
		add_filter( 'buzzstone_filter_merge_styles', 'buzzstone_cf7_merge_styles' );

		if ( buzzstone_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'buzzstone_cf7_frontend_scripts', 1100 );
		}

		if ( is_admin() ) {
			add_filter( 'buzzstone_filter_tgmpa_required_plugins', 'buzzstone_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'buzzstone_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('buzzstone_filter_tgmpa_required_plugins',	'buzzstone_cf7_tgmpa_required_plugins');
	function buzzstone_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( buzzstone_storage_isset( 'required_plugins', 'contact-form-7' ) ) {
			// CF7 plugin
			$list[] = array(
				'name'     => buzzstone_storage_get_array( 'required_plugins', 'contact-form-7' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'buzzstone_exists_cf7' ) ) {
	function buzzstone_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'buzzstone_cf7_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'buzzstone_cf7_frontend_scripts', 1100 );
	function buzzstone_cf7_frontend_scripts() {
		if ( buzzstone_exists_cf7() ) {
			if ( buzzstone_is_on( buzzstone_get_theme_option( 'debug_mode' ) ) ) {
				$buzzstone_url = buzzstone_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
				if ( '' != $buzzstone_url ) {
					wp_enqueue_script( 'buzzstone-cf7', $buzzstone_url, array( 'jquery' ), null, true );
				}
			}
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'buzzstone_cf7_merge_scripts' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_scripts', 'buzzstone_cf7_merge_scripts');
	function buzzstone_cf7_merge_scripts( $list ) {
		if ( buzzstone_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/contact-form-7.js';
		}
		return $list;
	}
}

// Merge custom styles
if ( ! function_exists( 'buzzstone_cf7_merge_styles' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_styles', 'buzzstone_cf7_merge_styles');
	function buzzstone_cf7_merge_styles( $list ) {
		if ( buzzstone_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}

