<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'buzzstone_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'buzzstone_essential_grid_theme_setup9', 9 );
	function buzzstone_essential_grid_theme_setup9() {

		add_filter( 'buzzstone_filter_merge_styles', 'buzzstone_essential_grid_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'buzzstone_filter_tgmpa_required_plugins', 'buzzstone_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'buzzstone_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('buzzstone_filter_tgmpa_required_plugins',	'buzzstone_essential_grid_tgmpa_required_plugins');
	function buzzstone_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( buzzstone_storage_isset( 'required_plugins', 'essential-grid' ) && buzzstone_is_theme_activated() ) {
			$path = buzzstone_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || buzzstone_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => buzzstone_storage_get_array( 'required_plugins', 'essential-grid' ),
					'slug'     => 'essential-grid',
                    'version'   => '2.3.6',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'buzzstone_exists_essential_grid' ) ) {
	function buzzstone_exists_essential_grid() {
		return defined( 'EG_PLUGIN_PATH' );
	}
}

// Merge custom styles
if ( ! function_exists( 'buzzstone_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_styles', 'buzzstone_essential_grid_merge_styles');
	function buzzstone_essential_grid_merge_styles( $list ) {
		if ( buzzstone_exists_essential_grid() ) {
			$list[] = 'plugins/essential-grid/_essential-grid.scss';
		}
		return $list;
	}
}

