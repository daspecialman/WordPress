<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.10
 */

// Logo
if ( buzzstone_is_on( buzzstone_get_theme_option( 'logo_in_footer' ) ) ) {
	$buzzstone_logo_image = buzzstone_get_logo_image( 'footer' );
	$buzzstone_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $buzzstone_logo_image ) || ! empty( $buzzstone_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $buzzstone_logo_image ) ) {
					$buzzstone_attr = buzzstone_getimagesize( $buzzstone_logo_image );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $buzzstone_logo_image ) . '"'
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'buzzstone' ) . '"'
								. ( ! empty( $buzzstone_attr[3] ) ? ' ' . wp_kses_data( $buzzstone_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $buzzstone_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $buzzstone_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
