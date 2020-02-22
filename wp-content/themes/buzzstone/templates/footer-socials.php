<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.10
 */


// Socials
if ( buzzstone_is_on( buzzstone_get_theme_option( 'socials_in_footer' ) ) ) {
	$buzzstone_output = buzzstone_get_socials_links();
	if ( '' != $buzzstone_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php buzzstone_show_layout( $buzzstone_output ); ?>
			</div>
		</div>
		<?php
	}
}
