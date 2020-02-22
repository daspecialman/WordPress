<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.1
 */

$buzzstone_theme_obj = wp_get_theme();
?>
<div class="buzzstone_admin_notice buzzstone_welcome_notice update-nag">
	<?php
	// Theme image
	$buzzstone_theme_img = buzzstone_get_file_url( 'screenshot.jpg' );
	if ( '' != $buzzstone_theme_img ) {
		?>
		<div class="buzzstone_notice_image"><img src="<?php echo esc_url( $buzzstone_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'buzzstone' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="buzzstone_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'buzzstone' ),
				$buzzstone_theme_obj->name . ( BUZZSTONE_THEME_FREE ? ' ' . __( 'Free', 'buzzstone' ) : '' ),
				$buzzstone_theme_obj->version
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="buzzstone_notice_text">
		<p class="buzzstone_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $buzzstone_theme_obj->description ) );
			?>
		</p>
		<p class="buzzstone_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'buzzstone' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="buzzstone_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=buzzstone_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'buzzstone' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="buzzstone_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="buzzstone_hide_notice_text"><?php esc_html_e( 'Dismiss', 'buzzstone' ); ?></span></a>
	</div>
</div>
