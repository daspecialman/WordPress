<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
if ( ! buzzstone_is_inherit( buzzstone_get_theme_option( 'copyright_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( buzzstone_get_theme_option( 'copyright_scheme' ) );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$buzzstone_copyright = buzzstone_get_theme_option( 'copyright' );
			if ( ! empty( $buzzstone_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$buzzstone_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $buzzstone_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$buzzstone_copyright = buzzstone_prepare_macros( $buzzstone_copyright );
				// Display copyright
				echo wp_kses_post( nl2br( $buzzstone_copyright ) );
			}
			?>
			</div>
		</div>
	</div>
</div>
