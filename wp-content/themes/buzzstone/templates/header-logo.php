<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_args = get_query_var( 'buzzstone_logo_args' );

// Site logo
$buzzstone_logo_type   = isset( $buzzstone_args['type'] ) ? $buzzstone_args['type'] : '';
$buzzstone_logo_image  = buzzstone_get_logo_image( $buzzstone_logo_type );
$buzzstone_logo_text   = buzzstone_is_on( buzzstone_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$buzzstone_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $buzzstone_logo_image ) || ! empty( $buzzstone_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
        if ( ! empty( $buzzstone_logo_image['logo'] ) ) {
            if ( empty( $buzzstone_logo_type ) && function_exists( 'the_custom_logo' ) && (int) $buzzstone_logo_image['logo'] > 0 ) {
                the_custom_logo();
            } else {
                $buzzstone_attr = buzzstone_getimagesize( $buzzstone_logo_image['logo'] );
                echo '<img src="' . esc_url( $buzzstone_logo_image['logo'] ) . '"'
                    . ( ! empty( $buzzstone_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $buzzstone_logo_image['logo_retina'] ) . ' 2x"' : '' )
                    . ' alt="' . esc_attr( $buzzstone_logo_text ) . '"'
                    . ( ! empty( $buzzstone_attr[3] ) ? ' ' . wp_kses_data( $buzzstone_attr[3] ) : '' )
                    . '>';
            }
        } else {
			buzzstone_show_layout( buzzstone_prepare_macros( $buzzstone_logo_text ), '<span class="logo_text">', '</span>' );
			buzzstone_show_layout( buzzstone_prepare_macros( $buzzstone_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}