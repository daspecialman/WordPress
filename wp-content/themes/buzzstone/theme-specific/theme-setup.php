<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'BUZZSTONE_THEME_FREE' ) ) {
	define( 'BUZZSTONE_THEME_FREE', false );
}
if ( ! defined( 'BUZZSTONE_THEME_FREE_WP' ) ) {
	define( 'BUZZSTONE_THEME_FREE_WP', false );
}

// If this theme uses multiple skins
if ( ! defined( 'BUZZSTONE_ALLOW_SKINS' ) ) {
	define( 'BUZZSTONE_ALLOW_SKINS', false );
}
if ( ! defined( 'BUZZSTONE_DEFAULT_SKIN' ) ) {
	define( 'BUZZSTONE_DEFAULT_SKIN', 'default' );
}

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
$GLOBALS['BUZZSTONE_STORAGE'] = array(

	// Theme required plugin's slugs
	'required_plugins'   => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'         => esc_html__( 'ThemeREX Addons', 'buzzstone' ),

    		// Recommended (supported) plugins for both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'contact-form-7'     => esc_html__( 'Contact Form 7', 'buzzstone' ),
			'instagram-feed'     => esc_html__( 'Instagram Feed', 'buzzstone' ),
			'mailchimp-for-wp'   => esc_html__( 'MailChimp for WP', 'buzzstone' ),
			'woocommerce'        => esc_html__( 'WooCommerce', 'buzzstone' ),
			'social-pug'        => esc_html__( 'Social Sharing WordPress Plugin – Social Pug', 'buzzstone' ),
			// GDPR Support: uncomment only one of two following plugins
			'wp-gdpr-compliance' => esc_html__( 'WP GDPR Compliance', 'buzzstone' ),
		),
		// List of plugins for the FREE version only
		//-----------------------------------------------------
		BUZZSTONE_THEME_FREE
			? array(
				// Recommended (supported) plugins for the FREE (lite) version
			)

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array(
				// Recommended (supported) plugins for the PRO (full) version
				// If plugin not need - comment (or remove) it
				'essential-grid'             => esc_html__( 'Essential Grid', 'buzzstone' ),
				'js_composer'                => esc_html__( 'WPBakery PageBuilder', 'buzzstone' ),
			)
	),

	// Theme-specific blog layouts
	'blog_styles'        => array_merge(
		// Layouts for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			'excerpt' => array(
				'title'   => esc_html__( 'Standard', 'buzzstone' ),
				'archive' => 'index-excerpt',
				'item'    => 'content-excerpt',
				'styles'  => 'excerpt',
			),
			'classic' => array(
				'title'   => esc_html__( 'Classic', 'buzzstone' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'classic',
			),
		),
		// Layouts for the FREE version only
		//-----------------------------------------------------
		BUZZSTONE_THEME_FREE
		? array()

		// Layouts for the PREMIUM version only
		//-----------------------------------------------------
		: array(
			'masonry'   => array(
				'title'   => esc_html__( 'Masonry', 'buzzstone' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'masonry',
			),
			'portfolio' => array(
				'title'   => esc_html__( 'Portfolio', 'buzzstone' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio',
				'columns' => array( 2, 3, 4 ),
				'styles'  => 'portfolio',
			),
			'gallery'   => array(
				'title'   => esc_html__( 'Gallery', 'buzzstone' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio-gallery',
				'columns' => array( 2, 3, 4 ),
				'styles'  => array( 'portfolio', 'gallery' ),
			),
			'chess'     => array(
				'title'   => esc_html__( 'Chess', 'buzzstone' ),
				'archive' => 'index-chess',
				'item'    => 'content-chess',
				'columns' => array( 1, 2, 3 ),
				'styles'  => 'chess',
			),
            'extra'     => array(
                'title'   => esc_html__( 'Extra', 'buzzstone' ),
                'archive' => 'index-extra',
                'item'    => 'content-extra',
                'styles'  => 'extra',
            ),
		)
	),

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'      => 'env-ancora',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => 'http://buzzstone.ancorathemes.com',
	'theme_doc_url'      => 'http://buzzstone.ancorathemes.com/doc',
	'theme_download_url' => 'https://themeforest.net/downloads',

	'theme_support_url'  => 'http://ancorathemes.com/theme-support/',                    // Ancora

	'theme_video_url'    => 'https://www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',  // Ancora

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By device
		'wide'     => array(
			'min' => 2160
		),
		'desktop'  => array(
			'min' => 1680,
			'max' => 2159,
		),
		'notebook' => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'   => array(
			'min' => 768,
			'max' => 1279,
		),
		'mobile'   => array( 'max' => 767 ),
		// By size
		'xxl'      => array( 'max' => 1679 ),
		'xl'       => array( 'max' => 1439 ),
		'lg'       => array( 'max' => 1279 ),
		'md'       => array( 'max' => 1023 ),
		'sm'       => array( 'max' => 767 ),
		'sm_wp'    => array( 'max' => 600 ),
		'xs'       => array( 'max' => 479 ),
	),
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'buzzstone_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'buzzstone_customizer_theme_setup1', 1 );
	function buzzstone_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		buzzstone_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',            // none  - use separate options for the main and the child-theme
																// child - duplicate theme options from the main theme to the child-theme only
																// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',             // Refresh method for preview area in the Appearance - Customize:
																// auto - refresh preview area on change each field with Theme Options
																// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                  // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,               // Place 'comment' field after the 'name' and 'email'

				'icons_selector'         => 'internal',         // Icons selector in the shortcodes:
																// vc default - standard VC (very slow) or Elementor's icons selector (not support images and svg)
																// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',            // Type of icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present icons
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',            // Type of socials icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present social networks
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,               // Check if exists a .min version of .css and .js and return path to it
																// instead the path to the original file
																// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => false,              // Show any menu if no menu selected in the location 'main_menu'
																// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,              // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,               // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,              // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,              // Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,               // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,              // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																// In the Page Options this styles are present always
																// (can be removed if filter 'buzzstone_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,              // Add arrows on the single attachment page to navigate to the prev/next attachment
				
				'gutenberg_safe_mode'    => array('vc'), // vc,elementor - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)

				'allow_gutenberg_blocks' => false,              // Allow our shortcodes and widgets as blocks in the Gutenberg (not ready yet - in the development now)

                'gutenberg_add_context'  => false,              // Add context to the Gutenberg editor styles with our method (if true - use if any problem with editor styles) or use native Gutenberg way via add_editor_style() (if false - used by default)

				'subtitle_above_title'   => true,               // Put subtitle above the title in the shortcodes

				'add_hide_on_xxx' => 'replace',                 // Add our breakpoints to the Responsive section of each element
																// 'add' - add our breakpoints after Elementor's
																// 'replace' - add our breakpoints instead Elementor's
																// 'none' - don't add our breakpoints (using only Elementor's)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		buzzstone_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Poppins',
					'family' => 'sans-serif',
					'styles' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',     // Parameter 'style' used only for the Google fonts
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		buzzstone_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!

		buzzstone_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'buzzstone' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.658em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.7em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '3.429em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.1em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.35em',
					'margin-bottom'   => '0.65em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '2.571em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.275em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.62em',
					'margin-bottom'   => '0.6em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '2.143em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.27em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.94em',
					'margin-bottom'   => '0.75em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.714em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.36em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '2.13em',
					'margin-bottom'   => '0.78em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.286em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.3em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '2.6em',
					'margin-bottom'   => '0.8em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.143em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.4em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '2.72em',
					'margin-bottom'   => '0.68em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'buzzstone' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.6em',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.3px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '16px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '18px',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.5px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'buzzstone' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'buzzstone' ),
					'font-family'     => 'inherit',
					'font-size'       => '1.143rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.4em', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'buzzstone' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'buzzstone' ),
					'font-family'     => 'inherit',
					'font-size'       => '12px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'buzzstone' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '16px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'buzzstone' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'buzzstone' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '16px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.3em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
			)
		);

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		buzzstone_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'buzzstone' ),
					'description' => esc_html__( 'Colors of the main content area', 'buzzstone' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'buzzstone' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'buzzstone' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'buzzstone' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'buzzstone' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'buzzstone' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'buzzstone' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'buzzstone' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'buzzstone' ),
				),
			)
		);
		buzzstone_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'buzzstone' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'buzzstone' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'buzzstone' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'buzzstone' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'buzzstone' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'buzzstone' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'buzzstone' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'buzzstone' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'buzzstone' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'buzzstone' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'buzzstone' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'buzzstone' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'buzzstone' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'buzzstone' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'buzzstone' ),
					'description' => esc_html__( 'Color of the links inside this block', 'buzzstone' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'buzzstone' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'buzzstone' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'buzzstone' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'buzzstone' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'buzzstone' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'buzzstone' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'buzzstone' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'buzzstone' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'buzzstone' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'buzzstone' ),
				),
			)
		);
		buzzstone_storage_set(
			'schemes', array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'buzzstone' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#f2f2f2', //ok
						'bd_color'         => '#e9e9e9', //ok

						// Text and links colors
						'text'             => '#646464', //ok
						'text_light'       => '#999999', //ok
						'text_dark'        => '#252525', //ok
						'text_link'        => '#ed2d30', //ok
						'text_hover'       => '#252525', //ok
						'text_link2'       => '#ed1756', //ok
						'text_hover2'      => '#252525',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#ffffff', //ok for bg
                        'alter_bg_hover'   => '#e9e9e9', //ok
						'alter_bd_color'   => '#e1e1e1', //ok
						'alter_bd_hover'   => '#dedede', //ok
						'alter_text'       => '#333333',
						'alter_light'      => '#b7b7b7',
						'alter_dark'       => '#1d1d1d',
						'alter_link'       => '#ed2d30',
						'alter_hover'      => '#72cfd5',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#252525', //ok
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#313131',
						'extra_bd_hover'   => '#3d3d3d',
						'extra_text'       => '#7f7f7f', //ok
						'extra_light'      => '#afafaf',
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#72cfd5',
						'extra_hover'      => '#fe7259',
						'extra_link2'      => '#80d572',
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#eec432',

						// Input fields (form's fields and textarea)
                        'input_bg_color'   => '#f2f2f2',
                        'input_bg_hover'   => '#f2f2f2',
                        'input_bd_color'   => '#e1e1e1',
                        'input_bd_hover'   => '#959595',
                        'input_text'       => '#7f7f7f',
                        'input_light'      => '#7f7f7f',
                        'input_dark'       => '#252525',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#67bcc1',
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#1d1d1d',
						'inverse_light'    => '#333333',
						'inverse_dark'     => '#252525', //ok
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#1d1d1d',
					),
				),

				// Color scheme: 'dark'
				'dark'    => array(
					'title'    => esc_html__( 'Dark', 'buzzstone' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#252525', //ok
						'bd_color'         => '#3b3b3b', //ok

						// Text and links colors
						'text'             => '#959595', //ok
						'text_light'       => '#6f6f6f',
						'text_dark'        => '#ffffff',
						'text_link'        => '#ed2d30', //ok
						'text_hover'       => '#ffffff', //ok
						'text_link2'       => '#ed1756', //ok
						'text_hover2'      => '#8be77c',
						'text_link3'       => '#ddb837',
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#1e1e1e', //ok
						'alter_bg_hover'   => '#1e1e1e', //ok
						'alter_bd_color'   => '#3b3b3b', //ok
						'alter_bd_hover'   => '#4a4a4a',
						'alter_text'       => '#7f7f7f', //ok
						'alter_light'      => '#6f6f6f',
						'alter_dark'       => '#ffffff',
						'alter_link'       => '#ed2d30',
						'alter_hover'      => '#fe7259',
						'alter_link2'      => '#8be77c',
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#1e1e1e', //ok ?
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#464646',
						'extra_bd_hover'   => '#4a4a4a',
						'extra_text'       => '#a6a6a6',
						'extra_light'      => '#6f6f6f',
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#ffaa5f',
						'extra_hover'      => '#fe7259',
						'extra_link2'      => '#80d572',
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#eec432',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#2e2d32',
						'input_bg_hover'   => '#2e2d32',
						'input_bd_color'   => '#2e2d32',
						'input_bd_hover'   => '#353535',
						'input_text'       => '#7f7f7f', //ok?
						'input_light'      => '#7f7f7f', //ok?
						'input_dark'       => '#ffffff',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#e36650',
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#1d1d1d',
						'inverse_light'    => '#6f6f6f',
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#1d1d1d',
					),
				),

                'extra' => array(
                    'title'    => esc_html__( 'Extra', 'buzzstone' ),
                    'internal' => true,
                    'colors'   => array(

                        // Whole block border and background
                        'bg_color'         => '#f2f2f2', //ok
                        'bd_color'         => '#e9e9e9', //ok

                        // Text and links colors
                        'text'             => '#646464', //ok
                        'text_light'       => '#999999', //ok
                        'text_dark'        => '#252525', //ok
                        'text_link'        => '#20a818', //ok
                        'text_hover'       => '#252525', //ok
                        'text_link2'       => '#1fa817', //ok
                        'text_hover2'      => '#252525',
                        'text_link3'       => '#ddb837',
                        'text_hover3'      => '#eec432',

                        // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                        'alter_bg_color'   => '#ffffff', //ok for bg
                        'alter_bg_hover'   => '#e9e9e9', //ok
                        'alter_bd_color'   => '#e1e1e1', //ok
                        'alter_bd_hover'   => '#dedede', //ok
                        'alter_text'       => '#333333',
                        'alter_light'      => '#b7b7b7',
                        'alter_dark'       => '#1d1d1d',
                        'alter_link'       => '#20a818',
                        'alter_hover'      => '#72cfd5',
                        'alter_link2'      => '#8be77c',
                        'alter_hover2'     => '#80d572',
                        'alter_link3'      => '#eec432',
                        'alter_hover3'     => '#ddb837',

                        // Extra blocks (submenu, tabs, color blocks, etc.)
                        'extra_bg_color'   => '#252525', //ok
                        'extra_bg_hover'   => '#28272e',
                        'extra_bd_color'   => '#313131',
                        'extra_bd_hover'   => '#3d3d3d',
                        'extra_text'       => '#7f7f7f', //ok
                        'extra_light'      => '#afafaf',
                        'extra_dark'       => '#ffffff',
                        'extra_link'       => '#72cfd5',
                        'extra_hover'      => '#fe7259',
                        'extra_link2'      => '#80d572',
                        'extra_hover2'     => '#8be77c',
                        'extra_link3'      => '#ddb837',
                        'extra_hover3'     => '#eec432',

                        // Input fields (form's fields and textarea)
                        'input_bg_color'   => '#f2f2f2',
                        'input_bg_hover'   => '#f2f2f2',
                        'input_bd_color'   => '#e1e1e1',
                        'input_bd_hover'   => '#959595',
                        'input_text'       => '#7f7f7f',
                        'input_light'      => '#7f7f7f',
                        'input_dark'       => '#252525',

                        // Inverse blocks (text and links on the 'text_link' background)
                        'inverse_bd_color' => '#67bcc1',
                        'inverse_bd_hover' => '#5aa4a9',
                        'inverse_text'     => '#1d1d1d',
                        'inverse_light'    => '#333333',
                        'inverse_dark'     => '#252525', //ok
                        'inverse_link'     => '#ffffff',
                        'inverse_hover'    => '#1d1d1d',
                    ),
                ),


                // Color scheme: 'dark'
                'deep'    => array(
                    'title'    => esc_html__( 'Deep', 'buzzstone' ),
                    'internal' => true,
                    'colors'   => array(

                        // Whole block border and background
                        'bg_color'         => '#20a818', //ok
                        'bd_color'         => '#3b3b3b', //ok

                        // Text and links colors
                        'text'             => '#f2f2f2', //ok
                        'text_light'       => '#6f6f6f',
                        'text_dark'        => '#252525',
                        'text_link'        => '#ed2d30', //ok
                        'text_hover'       => '#252525', //ok
                        'text_link2'       => '#ed1756', //ok
                        'text_hover2'      => '#8be77c',
                        'text_link3'       => '#ddb837',
                        'text_hover3'      => '#eec432',

                        // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                        'alter_bg_color'   => '#20a818', //ok
                        'alter_bg_hover'   => '#20a818', //ok
                        'alter_bd_color'   => '#3b3b3b', //ok
                        'alter_bd_hover'   => '#4a4a4a',
                        'alter_text'       => '#f2f2f2', //ok
                        'alter_light'      => '#6f6f6f',
                        'alter_dark'       => '#ffffff',
                        'alter_link'       => '#ed2d30',
                        'alter_hover'      => '#fe7259',
                        'alter_link2'      => '#8be77c',
                        'alter_hover2'     => '#80d572',
                        'alter_link3'      => '#eec432',
                        'alter_hover3'     => '#ddb837',

                        // Extra blocks (submenu, tabs, color blocks, etc.)
                        'extra_bg_color'   => '#36b32f', //ok ?
                        'extra_bg_hover'   => '#28272e',
                        'extra_bd_color'   => '#464646',
                        'extra_bd_hover'   => '#4a4a4a',
                        'extra_text'       => '#f2f2f2', //ok
                        'extra_light'      => '#6f6f6f',
                        'extra_dark'       => '#252525',
                        'extra_link'       => '#ffaa5f',
                        'extra_hover'      => '#fe7259',
                        'extra_link2'      => '#80d572',
                        'extra_hover2'     => '#8be77c',
                        'extra_link3'      => '#ddb837',
                        'extra_hover3'     => '#eec432',

                        // Input fields (form's fields and textarea)
                        'input_bg_color'   => '#f2f2f2',
                        'input_bg_hover'   => '#f2f2f2',
                        'input_bd_color'   => '#f2f2f2',
                        'input_bd_hover'   => '#353535',
                        'input_text'       => '#7f7f7f', //ok?
                        'input_light'      => '#7f7f7f', //ok?
                        'input_dark'       => '#252525',

                        // Inverse blocks (text and links on the 'text_link' background)
                        'inverse_bd_color' => '#e36650',
                        'inverse_bd_hover' => '#cb5b47',
                        'inverse_text'     => '#1d1d1d',
                        'inverse_light'    => '#6f6f6f',
                        'inverse_dark'     => '#000000',
                        'inverse_link'     => '#ffffff',
                        'inverse_hover'    => '#1d1d1d',
                    ),
                ),


			)
		);

		// Simple schemes substitution
		// Lists the colors and brightness factors that are used to generate other colors in the color scheme
		// Leave this array empty if your scheme does not have a color dependency
		buzzstone_storage_set(
			'schemes_simple', array(
				// Main color => List the slave elements and it's brightness factors
				'text_link'   => array(),
				'text_hover'  => array(),
				'text_link2'  => array(),
				'text_hover2' => array(),
				'text_link3'  => array(),
				'text_hover3' => array(),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		buzzstone_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
				'text_link_06'      => array(
					'color' => 'text_link',
					'alpha' => 0.6,
				),
                'text_link_07'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.7,
                ),
                'text_link_08'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.8,
                ),
                'text_link2_06'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.6,
                ),
                'text_link2_08'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.8,
                ),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		buzzstone_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		buzzstone_storage_set(
			'theme_thumbs', apply_filters(
				'buzzstone_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'buzzstone-thumb-huge'        => array(
						'size'  => array( 1170, 658, true ),
						'title' => esc_html__( 'Huge image', 'buzzstone' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'buzzstone-thumb-big'         => array(
						'size'  => array( 842, 474, true ),
						'title' => esc_html__( 'Large image', 'buzzstone' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'buzzstone-thumb-med'         => array(
						'size'  => array( 406, 258, true ),
						'title' => esc_html__( 'Medium image', 'buzzstone' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'buzzstone-thumb-tiny'        => array(
						'size'  => array( 110, 110, true ),
						'title' => esc_html__( 'Small square avatar', 'buzzstone' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'buzzstone-thumb-masonry-big' => array(
						'size'  => array( 842, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'buzzstone' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'buzzstone-thumb-masonry'     => array(
						'size'  => array( 406, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'buzzstone' ),
						'subst' => 'trx_addons-thumb-masonry',
					),

                    'buzzstone-thumb-simple'     => array(
                        'size'  => array( 406, 166, true ),     // Only downscale, not crop
                        'title' => esc_html__( 'Simple', 'buzzstone' ),
                        'subst' => 'trx_addons-thumb-simple',
                    ),

                    'buzzstone-thumb-square'     => array(
                        'size'  => array( 500, 500, true ),
                        'title' => esc_html__( 'Square', 'buzzstone' ),
                        'subst' => 'trx_addons-thumb-square',
                    ),

                    'buzzstone-thumb-extra'     => array(
                        'size'  => array( 630, 400, true ),
                        'title' => esc_html__( 'Extra', 'buzzstone' ),
                        'subst' => 'trx_addons-thumb-extra',
                    ),


				)
			)
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'buzzstone_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'buzzstone_importer_set_options', 9 );
	function buzzstone_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( buzzstone_get_protocol() . '://demofiles.ancorathemes.com/buzzstone/' );
			// Required plugins
			$options['required_plugins'] = array_keys( buzzstone_storage_get( 'required_plugins' ) );
			// Set number of thumbnails (usually 3 - 5) to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 1;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'Buzzstone Demo', 'buzzstone' );
			$options['files']['default']['domain_dev']  = '';       // Developers domain
			$options['files']['default']['domain_demo'] = esc_url( buzzstone_get_protocol() . '://buzzstone.ancorathemes.com' );       // Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// Banners
			$options['banners'] = array(
				array(
					'image'        => buzzstone_get_file_url( 'theme-specific/theme-about/images/frontpage.png' ),
					'title'        => esc_html__( 'Front Page Builder', 'buzzstone' ),
					'content'      => wp_kses_post( __( "Create your front page right in the WordPress Customizer. There's no need in any page builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'buzzstone' ) ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=VT0AUbMl_KA' ),
					'link_caption' => esc_html__( 'Watch Video Introduction', 'buzzstone' ),
					'duration'     => 20,
				),
				array(
					'image'        => buzzstone_get_file_url( 'theme-specific/theme-about/images/layouts.png' ),
					'title'        => esc_html__( 'Layouts Builder', 'buzzstone' ),
					'content'      => wp_kses_post( __( 'Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'buzzstone' ) ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=pYhdFVLd7y4' ),
					'link_caption' => esc_html__( 'Learn More', 'buzzstone' ),
					'duration'     => 20,
				),
				array(
					'image'        => buzzstone_get_file_url( 'theme-specific/theme-about/images/documentation.png' ),
					'title'        => esc_html__( 'Read Full Documentation', 'buzzstone' ),
					'content'      => wp_kses_post( __( 'Need more details? Please check our full online documentation for detailed information on how to use Buzzstone.', 'buzzstone' ) ),
					'link_url'     => esc_url( buzzstone_storage_get( 'theme_doc_url' ) ),
					'link_caption' => esc_html__( 'Online Documentation', 'buzzstone' ),
					'duration'     => 15,
				),
				array(
					'image'        => buzzstone_get_file_url( 'theme-specific/theme-about/images/video-tutorials.png' ),
					'title'        => esc_html__( 'Video Tutorials', 'buzzstone' ),
					'content'      => wp_kses_post( __( 'No time for reading documentation? Check out our video tutorials and learn how to customize Buzzstone in detail.', 'buzzstone' ) ),
					'link_url'     => esc_url( buzzstone_storage_get( 'theme_video_url' ) ),
					'link_caption' => esc_html__( 'Video Tutorials', 'buzzstone' ),
					'duration'     => 15,
				),
				array(
					'image'        => buzzstone_get_file_url( 'theme-specific/theme-about/images/studio.png' ),
					'title'        => esc_html__( 'Website Customization', 'buzzstone' ),
					'content'      => wp_kses_post( __( "Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'buzzstone' ) ),
					'link_url'     => esc_url( '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash/' ),
					'link_caption' => esc_html__( 'Contact Us', 'buzzstone' ),
					'duration'     => 25,
				),
			);
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'buzzstone_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'buzzstone_ocdi_set_options', 9 );
	function buzzstone_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Prepare demo data
			$options['demo_url'] = esc_url( buzzstone_get_protocol() . '://demofiles.ancorathemes.com/buzzstone/' );
			// Required plugins
			$options['required_plugins'] = array_keys( buzzstone_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'Buzzstone OCDI Demo', 'buzzstone' );
			$options['files']['ocdi']['domain_demo'] = esc_url( buzzstone_get_protocol() . '://buzzstone.ancorathemes.com' );
			// If theme need more demo - just copy 'default' and change required parameter
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'buzzstone_create_theme_options' ) ) {

	function buzzstone_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'buzzstone' );

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( buzzstone_storage_get( 'schemes' ) ) < 2;

		buzzstone_storage_set(
			'options', array(

				// 'Logo & Site Identity'
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'buzzstone' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'buzzstone' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'buzzstone' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Use the site title and tagline as a text logo if no image is selected', 'buzzstone' ) ),
					'class'    => 'buzzstone_column-1_2 buzzstone_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'buzzstone' ),
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'buzzstone' ) ),
					'class'    => 'buzzstone_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Zoom the logo. 1 - original size. Maximum size of logo depends on the actual size of the picture', 'buzzstone' ) ),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'buzzstone' ) ),
					'class'      => 'buzzstone_column-1_2',
					'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'buzzstone' ) ),
					'class' => 'buzzstone_column-1_2 buzzstone_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'buzzstone' ) ),
					'class'      => 'buzzstone_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'buzzstone' ) ),
					'class' => 'buzzstone_column-1_2 buzzstone_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'buzzstone' ) ),
					'class'      => 'buzzstone_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'buzzstone' ) ),
					'class' => 'buzzstone_column-1_2 buzzstone_new_row',
					'std'   => '',
					'type'  => 'hidden',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'buzzstone' ) ),
					'class'      => 'buzzstone_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'hidden',
				),

				// 'General settings'
				'general'                       => array(
					'title'    => esc_html__( 'General Settings', 'buzzstone' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'buzzstone' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'buzzstone' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'post,page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'qsetup'   => esc_html__( 'General', 'buzzstone' ),
					'refresh'  => false,
					'std'      => 'wide',
					'options'  => buzzstone_get_list_body_styles( false ),
					'type'     => 'select',
				),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'buzzstone' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1278,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',         // SASS variable's name to preview changes 'on fly'
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'buzzstone' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'post,page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'buzzstone' ),
					'type'       => 'image',
				),
				'remove_margins'                => array(
					'title'    => esc_html__( 'Remove margins', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'refresh'  => false,
					'std'      => 0,
					'type'     => 'checkbox',
				),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'buzzstone' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,post,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'buzzstone' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'buzzstone' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'buzzstone' ),
					),
					'dependency' => array(
						'sidebar_position' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'buzzstone' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'buzzstone' ) ),
					'std'        => 406,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',      // SASS variable's name to preview changes 'on fly'
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'buzzstone' ) ),
					'std'        => 30,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',          // SASS variable's name to preview changes 'on fly'
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'buzzstone' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'buzzstone' ),
					'desc'  => '',
					'type'  => BUZZSTONE_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'buzzstone' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'buzzstone' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'buzzstone' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'buzzstone' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),

				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'buzzstone' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'buzzstone' ) ),
					'std'        => 0,
					'min'        => 0,
					'max'        => 20,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',      // SASS name to preview changes 'on fly'
					'type'       =>  'hidden',
				),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'buzzstone' ),
					'desc'  => '',
					'type'  => BUZZSTONE_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'buzzstone' ) ),
					'std'   => 0,
					'type'  => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'privacy_text' => array(
					"title" => esc_html__("Text with Privacy Policy link", 'buzzstone'),
					"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'buzzstone') ),
					"std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'buzzstone') ),
					"type"  => "text"
				),

				// 'Header'
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'buzzstone' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'buzzstone' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'post,page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'std'      => 'default',
					'options'  => buzzstone_get_list_header_footer_types(),
					'type'     => BUZZSTONE_THEME_FREE || ! buzzstone_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'buzzstone' ),
					'desc'       => wp_kses_post( __( 'Select custom header from Layouts Builder', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'post,page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => BUZZSTONE_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'switch',
				),
                'header_fullheight'             => array(
                    'title'    => esc_html__( 'Header fullheight', 'buzzstone' ),
                    'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'buzzstone' ) ),
                    'override' => array(
                        'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
                        'section' => esc_html__( 'Header', 'buzzstone' ),
                    ),
                    'std'      => 0,
                    'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
                ),
				'top_title'             => array(
					'title'    => esc_html__( 'Header Title', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Show Header Title', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'std'      => 1,
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
                'top_title_big'             => array(
                    'title'    => esc_html__( 'Header Title "Bigger"', 'buzzstone' ),
                    'desc'     => wp_kses_data( __( 'Header Title Bigger (without icon)', 'buzzstone' ) ),
                    'override' => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Header', 'buzzstone' ),
                    ),
                    'dependency' => array(
                        'top_title' => array( 1 ),
                    ),
                    'std'      => 1,
                    'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
                ),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'buzzstone' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'slider',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'buzzstone' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'buzzstone' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'dependency' => array(
						'header_type'    => array( 'default' ),
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => buzzstone_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'buzzstone' ) ),
					'type'  => BUZZSTONE_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'buzzstone' ),
					),
					'type'     => BUZZSTONE_THEME_FREE || ! buzzstone_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 0,
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'buzzstone' ) ),
					'std'   => 1,
					'type'  => 'hidden',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'buzzstone' ),
					'desc'  => '',
					'type'  => BUZZSTONE_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'buzzstone' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'std'      => 0,
					'type'     => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'buzzstone' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'info',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'buzzstone' ) ),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'buzzstone' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'text_editor',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'buzzstone' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'buzzstone' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'buzzstone' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'buzzstone' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'buzzstone' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),

				// 'Footer'
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'buzzstone' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'buzzstone' ),
					),
					'std'      => 'default',
					'options'  => buzzstone_get_list_header_footer_types(),
					'type'     => BUZZSTONE_THEME_FREE || ! buzzstone_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'buzzstone' ),
					'desc'       => wp_kses_post( __( 'Select custom footer from Layouts Builder', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'buzzstone' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => BUZZSTONE_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'buzzstone' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'buzzstone' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => buzzstone_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'buzzstone' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'buzzstone' ) ),
					'refresh'    => false,
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'buzzstone' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'logo_in_footer' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'buzzstone' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'buzzstone' ) ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => ! buzzstone_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'buzzstone' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'Copyright &copy; {Y} by AncoraThemes. All rights reserved.', 'buzzstone' ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),

				// 'Blog'
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'buzzstone' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),

				// Blog - Posts page
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'buzzstone' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'buzzstone' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'buzzstone' ),
					'type'   => 'info',
				),


                'title_icon'              => array(
                    'title'      => esc_html__( 'Title Icon', 'buzzstone' ),
                    'desc'       => wp_kses_data( __( 'Select icon for title', 'buzzstone' ) ),
                    'override'   => array(
                        'mode'    => 'page',
                        'section' => esc_html__( 'Content', 'buzzstone' ),
                    ),
                    'std'        => 'icon-icon_1',
                    'type'       => 'icon',
                ),


				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'buzzstone' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'buzzstone' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or the full post content', 'buzzstone' ) ),
					'std'        => 'excerpt',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'buzzstone' ),
						'fullpost' => esc_html__( 'Full post', 'buzzstone' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'buzzstone' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 28,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'buzzstone' ) ),
					'std'     => 2,
					'options' => buzzstone_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0',
					'options'    => array(),
					'type'       => 'select',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'buzzstone' ),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'buzzstone' ),
						'links'    => esc_html__( 'Older/Newest', 'buzzstone' ),
						'more'     => esc_html__( 'Load more', 'buzzstone' ),
						'infinite' => esc_html__( 'Infinite scroll', 'buzzstone' ),
					),
					'type'       => 'select',
				),
				'blog_animation'                => array(
					'title'      => esc_html__( 'Animation for the posts', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'none',
					'options'    => array(),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio', 'gallery' ),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'buzzstone' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'buzzstone' ) ),
					'std'     => 'right',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'buzzstone' ),
					'type'    => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'buzzstone' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'buzzstone' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'buzzstone' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'buzzstone' ),
					'desc'  => '',
					'type'  => BUZZSTONE_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'buzzstone' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'buzzstone' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'buzzstone' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'buzzstone' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'buzzstone' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'buzzstone' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'buzzstone' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'buzzstone' ) ),
					'std'   => 5,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'buzzstone' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'buzzstone' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'buzzstone' ),
						'columns' => esc_html__( 'Mini-cards', 'buzzstone' ),
					),
					'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'buzzstone' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'buzzstone' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=0|author=1|counters=1|share=0|edit=0',
					'options'    => buzzstone_get_list_meta_parts(),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters'                      => array(
					'title'      => esc_html__( 'Post counters', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if ThemeREX Addons is active', 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=0|likes=0|comments=1',
					'options'    => buzzstone_get_list_counters(),
					'type'       => BUZZSTONE_THEME_FREE || ! buzzstone_exists_trx_addons() ? 'hidden' : 'checklist',
				),

				// Blog - Single posts
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'buzzstone' ) ),
					'type'  => 'section',
				),
				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'buzzstone' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'post_thumbnail_type'      => array(
					'title'      => esc_html__( 'Type of post thumbnail', 'buzzstone' ),
					'desc'       => wp_kses_data( __( "Select type of post thumbnail on the single post's pages", 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 0 ),
					),
					'std'        => 'default',
					'options'    => array(
						'fullwidth'   => esc_html__( 'Fullwidth', 'buzzstone' ),
						'boxed'       => esc_html__( 'Boxed', 'buzzstone' ),
						'default'     => esc_html__( 'Default', 'buzzstone' ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_position'          => array(
					'title'      => esc_html__( 'Post title position', 'buzzstone' ),
					'desc'       => wp_kses_data( __( "Select post header position on the single post's pages", 'buzzstone' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 0 ),
					),
					'std'        => 'under',
					'options'    => array(
						'under'      => esc_html__( 'Under the post thumbnail', 'buzzstone' ),
						'on_thumb'   => esc_html__( 'On the post thumbnail', 'buzzstone' ),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_align'             => array(
					'title'      => esc_html__( 'Align of the post header', 'buzzstone' ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'post_header_position' => array( 'on_thumb' ),
					),
					'std'        => 'mc',
					'options'    => array(
						'bl' => esc_html__('Bottom Left', 'buzzstone'),
						'bc' => esc_html__('Bottom Center', 'buzzstone'),
						'br' => esc_html__('Bottom Right', 'buzzstone'),
						'bs' => esc_html__('Bottom Stick Out', 'buzzstone'),
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'hide_sidebar_on_single'        => array(
					'title' => esc_html__( 'Hide sidebar on the single post', 'buzzstone' ),
					'desc'  => wp_kses_data( __( "Hide sidebar on the single post's pages", 'buzzstone' ) ),
					'std'   => 0,
					'type'  => 'checkbox',
				),
				'show_post_excerpt'              => array(
					'title' => esc_html__( 'Show post excerpt', 'buzzstone' ),
					'desc'  => wp_kses_data( __( "Display post excerpt under post title.", 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 0 ),
					),
					'std'   => 0,
					'type'  => 'checkbox',
				),
				'show_post_meta'                => array(
					'title' => esc_html__( 'Show post meta', 'buzzstone' ),
					'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'buzzstone' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'meta_parts_post'               => array(
					'title'      => esc_html__( 'Post meta', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'buzzstone' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'buzzstone' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=0|author=1|counters=1|share=0|edit=0',
					'options'    => buzzstone_get_list_meta_parts(),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters_post'                 => array(
					'title'      => esc_html__( 'Post counters', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if plugin ThemeREX Addons is active', 'buzzstone' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=0|likes=0|comments=1',
					'options'    => buzzstone_get_list_counters(),
					'type'       => BUZZSTONE_THEME_FREE || ! buzzstone_exists_trx_addons() ? 'hidden' : 'checklist',
				),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'buzzstone' ) ),
					'std'   => 1,
					'type'  => ! buzzstone_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'buzzstone' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'buzzstone' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'buzzstone' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'buzzstone' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'buzzstone' ),
					),
					'std'      => 1,
					'type'     => 'checkbox',
				),
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => buzzstone_get_list_range( 1, 9 ),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page (from 2 to 4)?', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => buzzstone_get_list_range( 1, 3 ),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => buzzstone_get_list_styles( 1, 3 ),
					'type'       => 'hidden',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
					'type'       => 'hidden',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'buzzstone'),
						'side'    => esc_html__('Side', 'buzzstone'),
						'outside' => esc_html__('Outside', 'buzzstone'),
						'top'     => esc_html__('Top', 'buzzstone'),
						'bottom'  => esc_html__('Bottom', 'buzzstone')
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'buzzstone'),
						'bottom'  => esc_html__('Bottom', 'buzzstone')
					),
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
					'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'text',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'buzzstone' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'buzzstone' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'below_content',
					'options'    => array (
						'below_content' => esc_html__( 'After content', 'buzzstone' ),
						'below_page'    => esc_html__( 'After content & sidebar', 'buzzstone' ),
					),
					'type'       => 'hidden',
				),
				'posts_navigation_info'      => array(
					'title' => esc_html__( 'Posts navigation', 'buzzstone' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_posts_navigation'		=> array(
					'title'    => esc_html__( 'Show posts navigation', 'buzzstone' ),
					'desc'     => wp_kses_data( __( "Show posts navigation on the single post's pages", 'buzzstone' ) ),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'fixed_posts_navigation'		=> array(
					'title'    => esc_html__( 'Fixed posts navigation', 'buzzstone' ),
					'desc'     => wp_kses_data( __( "Make posts navigation fixed position. Display them at the bottom of the window.", 'buzzstone' ) ),
					'dependency' => array(
						'show_posts_navigation' => array( 1 ),
					),
					'std'      => 0,
					'type'     => 'hidden',
				),


				'blog_end'                      => array(
					'type' => 'panel_end',
				),

				// 'Colors'
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'buzzstone' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'buzzstone' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'buzzstone' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'buzzstone' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'buzzstone' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'buzzstone' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'buzzstone' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'buzzstone' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'buzzstone' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => 'hidden',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'buzzstone' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'buzzstone' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'buzzstone' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'buzzstone' ),
					),
					'std'      => 'dark',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'buzzstone' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'buzzstone' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'buzzstone' ),
					'desc'        => '',
					'std'         => '$buzzstone_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);

		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'buzzstone' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'buzzstone' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'buzzstone' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'buzzstone' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'buzzstone' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'buzzstone' ) ),
				'class'   => 'buzzstone_column-1_3 buzzstone_new_row',
				'refresh' => false,
				'std'     => '$buzzstone_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= buzzstone_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( buzzstone_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'buzzstone' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'buzzstone' ),
				'desc'    => '',
				'class'   => 'buzzstone_column-1_3 buzzstone_new_row',
				'refresh' => false,
				'std'     => '$buzzstone_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'buzzstone' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'buzzstone' ) )
							: '',
				'class'   => 'buzzstone_column-1_3',
				'refresh' => false,
				'std'     => '$buzzstone_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'buzzstone' ),
					'serif'      => esc_html__( 'serif', 'buzzstone' ),
					'sans-serif' => esc_html__( 'sans-serif', 'buzzstone' ),
					'monospace'  => esc_html__( 'monospace', 'buzzstone' ),
					'cursive'    => esc_html__( 'cursive', 'buzzstone' ),
					'fantasy'    => esc_html__( 'fantasy', 'buzzstone' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'buzzstone' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'buzzstone' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'buzzstone' ) )
							: '',
				'class'   => 'buzzstone_column-1_3',
				'refresh' => false,
				'std'     => '$buzzstone_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = buzzstone_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'buzzstone' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf( __( 'Font settings of the "%s" tag.', 'buzzstone' ), $tag ) ),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'buzzstone' ),
						'100'     => esc_html__( '100 (Light)', 'buzzstone' ),
						'200'     => esc_html__( '200 (Light)', 'buzzstone' ),
						'300'     => esc_html__( '300 (Thin)', 'buzzstone' ),
						'400'     => esc_html__( '400 (Normal)', 'buzzstone' ),
						'500'     => esc_html__( '500 (Semibold)', 'buzzstone' ),
						'600'     => esc_html__( '600 (Semibold)', 'buzzstone' ),
						'700'     => esc_html__( '700 (Bold)', 'buzzstone' ),
						'800'     => esc_html__( '800 (Black)', 'buzzstone' ),
						'900'     => esc_html__( '900 (Black)', 'buzzstone' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'buzzstone' ),
						'normal'  => esc_html__( 'Normal', 'buzzstone' ),
						'italic'  => esc_html__( 'Italic', 'buzzstone' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'buzzstone' ),
						'none'         => esc_html__( 'None', 'buzzstone' ),
						'underline'    => esc_html__( 'Underline', 'buzzstone' ),
						'overline'     => esc_html__( 'Overline', 'buzzstone' ),
						'line-through' => esc_html__( 'Line-through', 'buzzstone' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'buzzstone' ),
						'none'       => esc_html__( 'None', 'buzzstone' ),
						'uppercase'  => esc_html__( 'Uppercase', 'buzzstone' ),
						'lowercase'  => esc_html__( 'Lowercase', 'buzzstone' ),
						'capitalize' => esc_html__( 'Capitalize', 'buzzstone' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'buzzstone_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$buzzstone_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		buzzstone_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			buzzstone_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'buzzstone' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'buzzstone' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ( isset( $_REQUEST['page'] ) && in_array( $_REQUEST['page'], array( 'theme_options', 'trx_addons_theme_panel' ) ) ) ) {
			buzzstone_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'buzzstone' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'buzzstone' ) ),
					'class'    => 'buzzstone_column-1_2 buzzstone_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'buzzstone' ),
					'type'     => 'image',
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'buzzstone_options_get_list_cpt_options' ) ) {
	function buzzstone_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'buzzstone' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'buzzstone' ) ),
				'std'     => 'inherit',
				'options' => buzzstone_get_list_header_footer_types( true ),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'buzzstone' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'buzzstone' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'buzzstone' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'buzzstone' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'buzzstone' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'buzzstone' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'buzzstone' ),
					1         => esc_html__( 'Yes', 'buzzstone' ),
					0         => esc_html__( 'No', 'buzzstone' ),
				),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'buzzstone' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'buzzstone' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'buzzstone' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => esc_html__( 'Sidebar position', 'buzzstone' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the %s pages', 'buzzstone' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => esc_html__( 'Sidebar widgets', 'buzzstone' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s pages', 'buzzstone' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( 'left', 'right' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"hide_sidebar_on_single_{$cpt}" => array(
				'title'   => esc_html__( 'Hide sidebar on the single pages', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Hide sidebar on the single page', 'buzzstone' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'buzzstone' ),
					1         => esc_html__( 'Hide', 'buzzstone' ),
					0         => esc_html__( 'Show', 'buzzstone' ),
				),
				'type'    => 'switch',
			),

			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'buzzstone' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'buzzstone' ) ),
				'std'     => 'inherit',
				'options' => buzzstone_get_list_header_footer_types( true ),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'buzzstone' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'buzzstone' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'buzzstone' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'buzzstone' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'buzzstone' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'buzzstone' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => buzzstone_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'buzzstone' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'buzzstone' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),

			"widgets_info_{$cpt}"           => array(
				'title' => esc_html__( 'Additional panels', 'buzzstone' ),
				'desc'  => '',
				'type'  => BUZZSTONE_THEME_FREE ? 'hidden' : 'info',
			),
			"widgets_above_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the top of the page', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'buzzstone' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_above_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets above the content', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'buzzstone' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets below the content', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'buzzstone' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the bottom of the page', 'buzzstone' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'buzzstone' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BUZZSTONE_THEME_FREE ? 'hidden' : 'select',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'buzzstone_options_get_list_choises' ) ) {
	add_filter( 'buzzstone_filter_options_get_list_choises', 'buzzstone_options_get_list_choises', 10, 2 );
	function buzzstone_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = buzzstone_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = buzzstone_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = buzzstone_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = buzzstone_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = buzzstone_get_list_sidebars( strpos( $id, 'sidebar_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = buzzstone_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = buzzstone_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = buzzstone_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = buzzstone_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = buzzstone_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = buzzstone_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = buzzstone_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = buzzstone_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = buzzstone_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = buzzstone_array_merge( array( 0 => esc_html__( '- Select category -', 'buzzstone' ) ), buzzstone_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = buzzstone_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = buzzstone_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = buzzstone_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}
