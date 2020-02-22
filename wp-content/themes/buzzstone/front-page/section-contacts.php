<div class="front_page_section front_page_section_contacts<?php
	$buzzstone_scheme = buzzstone_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! buzzstone_is_inherit( $buzzstone_scheme ) ) {
		echo ' scheme_' . esc_attr( $buzzstone_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( buzzstone_get_theme_option( 'front_page_contacts_paddings' ) );
?>"
		<?php
		$buzzstone_css      = '';
		$buzzstone_bg_image = buzzstone_get_theme_option( 'front_page_contacts_bg_image' );
		if ( ! empty( $buzzstone_bg_image ) ) {
			$buzzstone_css .= 'background-image: url(' . esc_url( buzzstone_get_attachment_url( $buzzstone_bg_image ) ) . ');';
		}
		if ( ! empty( $buzzstone_css ) ) {
			echo ' style="' . esc_attr( $buzzstone_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$buzzstone_anchor_icon = buzzstone_get_theme_option( 'front_page_contacts_anchor_icon' );
	$buzzstone_anchor_text = buzzstone_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $buzzstone_anchor_icon ) || ! empty( $buzzstone_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $buzzstone_anchor_icon ) ? ' icon="' . esc_attr( $buzzstone_anchor_icon ) . '"' : '' )
									. ( ! empty( $buzzstone_anchor_text ) ? ' title="' . esc_attr( $buzzstone_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( buzzstone_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' buzzstone-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$buzzstone_css      = '';
			$buzzstone_bg_mask  = buzzstone_get_theme_option( 'front_page_contacts_bg_mask' );
			$buzzstone_bg_color_type = buzzstone_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $buzzstone_bg_color_type ) {
				$buzzstone_bg_color = buzzstone_get_theme_option( 'front_page_contacts_bg_color' );
			} elseif ( 'scheme_bg_color' == $buzzstone_bg_color_type ) {
				$buzzstone_bg_color = buzzstone_get_scheme_color( 'bg_color', $buzzstone_scheme );
			} else {
				$buzzstone_bg_color = '';
			}
			if ( ! empty( $buzzstone_bg_color ) && $buzzstone_bg_mask > 0 ) {
				$buzzstone_css .= 'background-color: ' . esc_attr(
					1 == $buzzstone_bg_mask ? $buzzstone_bg_color : buzzstone_hex2rgba( $buzzstone_bg_color, $buzzstone_bg_mask )
				) . ';';
			}
			if ( ! empty( $buzzstone_css ) ) {
				echo ' style="' . esc_attr( $buzzstone_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$buzzstone_caption     = buzzstone_get_theme_option( 'front_page_contacts_caption' );
			$buzzstone_description = buzzstone_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $buzzstone_caption ) || ! empty( $buzzstone_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $buzzstone_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $buzzstone_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses_post( $buzzstone_caption );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $buzzstone_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $buzzstone_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses_post( wpautop( $buzzstone_description ) );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$buzzstone_content = buzzstone_get_theme_option( 'front_page_contacts_content' );
			$buzzstone_layout  = buzzstone_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $buzzstone_layout && ( ! empty( $buzzstone_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $buzzstone_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $buzzstone_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses_post( $buzzstone_content );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $buzzstone_layout && ( ! empty( $buzzstone_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$buzzstone_sc = buzzstone_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $buzzstone_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $buzzstone_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					buzzstone_show_layout( do_shortcode( $buzzstone_sc ) );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $buzzstone_layout && ( ! empty( $buzzstone_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
