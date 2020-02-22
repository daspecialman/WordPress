<?php
/* Gutenberg support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'buzzstone_gutenberg_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'buzzstone_gutenberg_theme_setup9', 9 );
	function buzzstone_gutenberg_theme_setup9() {

		// Add editor styles to backend
		add_theme_support( 'editor-styles' );
		if (buzzstone_exists_gutenberg()) {
			if ( ! buzzstone_get_theme_setting( 'gutenberg_add_context' ) ) {
				add_editor_style( buzzstone_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ) );
			}
		} else {
			add_editor_style( buzzstone_get_file_url('css/editor-style.css') );
		}

		
		add_filter( 'buzzstone_filter_merge_styles', 'buzzstone_gutenberg_merge_styles' );
		add_filter( 'buzzstone_filter_merge_styles_responsive', 'buzzstone_gutenberg_merge_styles_responsive' );
		add_action( 'enqueue_block_editor_assets', 'buzzstone_gutenberg_editor_scripts' );
		add_filter( 'buzzstone_filter_localize_script_admin',	'buzzstone_gutenberg_localize_script');
		add_action( 'after_setup_theme', 'buzzstone_gutenberg_add_editor_colors' );
	}
}


// Check if Gutenberg is installed and activated
if ( ! function_exists( 'buzzstone_exists_gutenberg' ) ) {
	function buzzstone_exists_gutenberg() {
		return function_exists( 'register_block_type' );
	}
}

// Return true if Gutenberg exists and current mode is preview
if ( ! function_exists( 'buzzstone_gutenberg_is_preview' ) ) {
	function buzzstone_gutenberg_is_preview() {
		return false;
	}
}

// Merge custom styles
if ( ! function_exists( 'buzzstone_gutenberg_merge_styles' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_styles', 'buzzstone_gutenberg_merge_styles');
	function buzzstone_gutenberg_merge_styles( $list ) {
		if ( buzzstone_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg.scss';
		}
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'buzzstone_gutenberg_merge_styles_responsive' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_styles_responsive', 'buzzstone_gutenberg_merge_styles_responsive');
	function buzzstone_gutenberg_merge_styles_responsive( $list ) {
		if ( buzzstone_exists_gutenberg() ) {
			$list[] = 'plugins/gutenberg/_gutenberg-responsive.scss';
		}
		return $list;
	}
}


// Load required styles and scripts for Gutenberg Editor mode
if ( ! function_exists( 'buzzstone_gutenberg_editor_scripts' ) ) {
	//Handler of the add_action( 'enqueue_block_editor_assets', 'buzzstone_gutenberg_editor_scripts');
	function buzzstone_gutenberg_editor_scripts() {

		buzzstone_admin_scripts();
		buzzstone_admin_localize_scripts();
		
		// Editor styles
		if ( buzzstone_get_theme_setting( 'gutenberg_add_context' ) ) {
			wp_enqueue_style( 'buzzstone-gutenberg-preview', buzzstone_get_file_url( 'plugins/gutenberg/gutenberg-preview.css' ), array(), null );
		}
		// Editor scripts
		wp_enqueue_script( 'buzzstone-gutenberg-preview', buzzstone_get_file_url( 'plugins/gutenberg/gutenberg-preview.js' ), array( 'jquery' ), null, true );

	}
}

// Add plugin's specific variables to the scripts
if ( ! function_exists( 'buzzstone_gutenberg_localize_script' ) ) {
	//Handler of the add_filter( 'buzzstone_filter_localize_script_admin',	'buzzstone_gutenberg_localize_script');
	function buzzstone_gutenberg_localize_script( $arr ) {
		$arr['color_scheme']  = buzzstone_get_theme_option( 'color_scheme' );
		return $arr;
	}
}

// Save CSS with custom colors and fonts to the gutenberg-editor-style.css
if ( ! function_exists( 'buzzstone_gutenberg_save_css' ) ) {
	add_action( 'buzzstone_action_save_options', 'buzzstone_gutenberg_save_css', 21 );
	add_action( 'trx_addons_action_save_options', 'buzzstone_gutenberg_save_css', 21 );
	function buzzstone_gutenberg_save_css() {
		$msg = '/* ' . esc_html__( "ATTENTION! This file was generated automatically! Don't change it!!!", 'buzzstone' )
			. "\n----------------------------------------------------------------------- */\n";

		// Get main styles
		$css = buzzstone_fgc( buzzstone_get_file_dir( 'style.css' ) );

		// Append theme-vars styles
		$css .= buzzstone_customizer_get_css(
			array(
				'colors' => buzzstone_get_theme_setting( 'separate_schemes' ) ? false : null,
			)
		);

		// Append color schemes
		if ( buzzstone_get_theme_setting( 'separate_schemes' ) ) {
			$schemes = buzzstone_get_sorted_schemes();
			if ( is_array( $schemes ) ) {
				foreach ( $schemes as $scheme => $data ) {
					$css .= buzzstone_customizer_get_css(
						array(
							'fonts'  => false,
							'colors' => $data['colors'],
							'scheme' => $scheme,
						)
					);
				}
			}
		}

		// Add context class to each selector
		if ( buzzstone_get_theme_setting( 'gutenberg_add_context' ) && function_exists( 'trx_addons_css_add_context' ) ) {
			$css = trx_addons_css_add_context(
				$css,
				array(
					'context' => '.edit-post-visual-editor ',
					'context_self' => array( 'html', 'body', '.edit-post-visual-editor' )
				)
			);
		} else {
			$css = apply_filters( 'buzzstone_filter_prepare_css', $css );
		}

		// Save styles to the file
		buzzstone_fpc( buzzstone_get_file_dir( 'plugins/gutenberg/gutenberg-preview.css' ), $msg . $css );
	}
}

// Add theme-specific colors to the Gutenberg color picker
if ( ! function_exists( 'buzzstone_gutenberg_add_editor_colors' ) ) {
	//Hamdler of the add_action( 'after_setup_theme', 'buzzstone_gutenberg_add_editor_colors' );
	function buzzstone_gutenberg_add_editor_colors() {
		$scheme = buzzstone_get_scheme_colors();
		$groups = buzzstone_storage_get( 'scheme_color_groups' );
		$names  = buzzstone_storage_get( 'scheme_color_names' );
		$colors = array();
		foreach( $groups as $g => $group ) {
			foreach( $names as $n => $name ) {
				$c = 'main' == $g ? $n : $g . '_' . str_replace( 'text_', '', $n );
				if ( isset( $scheme[ $c ] ) ) {
					$colors[] = array(
						'name'  => ( 'main' == $g ? '' : $group['title'] . ' ' ) . $name['title'],
						'slug'  => $c,
						'color' => $scheme[ $c ]
					);
				}
			}
			// Add only one group of colors
			// Delete next condition (or add false && to them) to add all groups
			if ( 'main' == $g ) {
				break;
			}
		}
		add_theme_support( 'editor-color-palette', $colors );
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( buzzstone_exists_gutenberg() ) {
	require_once BUZZSTONE_THEME_DIR . 'plugins/gutenberg/gutenberg-styles.php';
}
