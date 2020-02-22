<?php
/* Social Pug Support support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'buzzstone_social_pug_support_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'buzzstone_social_pug_support_theme_setup9', 9 );
    function buzzstone_social_pug_support_theme_setup9() {

        if ( is_admin() ) {
            add_filter( 'buzzstone_filter_tgmpa_required_plugins', 'buzzstone_social_pug_support_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'buzzstone_social_pug_support_tgmpa_required_plugins' ) ) {
    //Handler of the add_filter('buzzstone_filter_tgmpa_required_plugins',	'buzzstone_social_pug_supportd_tgmpa_required_plugins');
    function buzzstone_social_pug_support_tgmpa_required_plugins( $list = array() ) {
        if ( buzzstone_storage_isset( 'required_plugins', 'social-pug' ) ) {
            $list[] = array(
                'name'     => buzzstone_storage_get_array( 'required_plugins', 'social-pug' ),
                'slug'     => 'social-pug',
                'required' => false,
            );
        }
        return $list;
    }
}