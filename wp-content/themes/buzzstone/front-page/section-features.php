<div class="front_page_section front_page_section_features<?php
	$buzzstone_scheme = buzzstone_get_theme_option( 'front_page_features_scheme' );
	if ( ! buzzstone_is_inherit( $buzzstone_scheme ) ) {
		echo ' scheme_' . esc_attr( $buzzstone_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( buzzstone_get_theme_option( 'front_page_features_paddings' ) );
?>"
		<?php
		$buzzstone_css      = '';
		$buzzstone_bg_image = buzzstone_get_theme_option( 'front_page_features_bg_image' );
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
	$buzzstone_anchor_icon = buzzstone_get_theme_option( 'front_page_features_anchor_icon' );
	$buzzstone_anchor_text = buzzstone_get_theme_option( 'front_page_features_anchor_text' );
if ( ( ! empty( $buzzstone_anchor_icon ) || ! empty( $buzzstone_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_features"'
									. ( ! empty( $buzzstone_anchor_icon ) ? ' icon="' . esc_attr( $buzzstone_anchor_icon ) . '"' : '' )
									. ( ! empty( $buzzstone_anchor_text ) ? ' title="' . esc_attr( $buzzstone_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_features_inner
	<?php
	if ( buzzstone_get_theme_option( 'front_page_features_fullheight' ) ) {
		echo ' buzzstone-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$buzzstone_css      = '';
			$buzzstone_bg_mask  = buzzstone_get_theme_option( 'front_page_features_bg_mask' );
			$buzzstone_bg_color_type = buzzstone_get_theme_option( 'front_page_features_bg_color_type' );
			if ( 'custom' == $buzzstone_bg_color_type ) {
				$buzzstone_bg_color = buzzstone_get_theme_option( 'front_page_features_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_features_content_wrap content_wrap">
			<?php
			// Caption
			$buzzstone_caption = buzzstone_get_theme_option( 'front_page_features_caption' );
			if ( ! empty( $buzzstone_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_features_caption front_page_block_<?php echo ! empty( $buzzstone_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post( $buzzstone_caption ); ?></h2>
				<?php
			}

			// Description (text)
			$buzzstone_description = buzzstone_get_theme_option( 'front_page_features_description' );
			if ( ! empty( $buzzstone_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_features_description front_page_block_<?php echo ! empty( $buzzstone_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post( wpautop( $buzzstone_description ) ); ?></div>
				<?php
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_features_output">
			<?php
			if ( is_active_sidebar( 'front_page_features_widgets' ) ) {
				dynamic_sidebar( 'front_page_features_widgets' );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {
				if ( ! buzzstone_exists_trx_addons() ) {
					buzzstone_customizer_need_trx_addons_message();
				} else {
					buzzstone_customizer_need_widgets_message( 'front_page_features_caption', 'ThemeREX Addons - Services' );
				}
			}
			?>
			</div>
		</div>
	</div>
</div>
