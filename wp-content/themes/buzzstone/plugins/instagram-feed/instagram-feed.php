<?php
/* Instagram Feed support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'buzzstone_instagram_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'buzzstone_instagram_feed_theme_setup9', 9 );
	function buzzstone_instagram_feed_theme_setup9() {

		add_filter( 'buzzstone_filter_merge_styles_responsive', 'buzzstone_instagram_merge_styles_responsive' );

		if ( is_admin() ) {
			add_filter( 'buzzstone_filter_tgmpa_required_plugins', 'buzzstone_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'buzzstone_instagram_feed_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('buzzstone_filter_tgmpa_required_plugins',	'buzzstone_instagram_feed_tgmpa_required_plugins');
	function buzzstone_instagram_feed_tgmpa_required_plugins( $list = array() ) {
		if ( buzzstone_storage_isset( 'required_plugins', 'instagram-feed' ) ) {
			$list[] = array(
				'name'     => buzzstone_storage_get_array( 'required_plugins', 'instagram-feed' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if Instagram Feed installed and activated
if ( ! function_exists( 'buzzstone_exists_instagram_feed' ) ) {
	function buzzstone_exists_instagram_feed() {
		return defined( 'SBIVER' );
	}
}


// Merge responsive styles
if ( ! function_exists( 'buzzstone_instagram_merge_styles_responsive' ) ) {
	//Handler of the add_filter('buzzstone_filter_merge_styles_responsive', 'buzzstone_instagram_merge_styles_responsive');
	function buzzstone_instagram_merge_styles_responsive( $list ) {
		if ( buzzstone_exists_instagram_feed() ) {
			$list[] = 'plugins/instagram/_instagram-responsive.scss';
		}
		return $list;
	}
}

