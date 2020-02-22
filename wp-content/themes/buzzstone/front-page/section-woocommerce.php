<div class="front_page_section front_page_section_woocommerce<?php
	$buzzstone_scheme = buzzstone_get_theme_option( 'front_page_woocommerce_scheme' );
	if ( ! buzzstone_is_inherit( $buzzstone_scheme ) ) {
		echo ' scheme_' . esc_attr( $buzzstone_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( buzzstone_get_theme_option( 'front_page_woocommerce_paddings' ) );
?>"
		<?php
		$buzzstone_css      = '';
		$buzzstone_bg_image = buzzstone_get_theme_option( 'front_page_woocommerce_bg_image' );
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
	$buzzstone_anchor_icon = buzzstone_get_theme_option( 'front_page_woocommerce_anchor_icon' );
	$buzzstone_anchor_text = buzzstone_get_theme_option( 'front_page_woocommerce_anchor_text' );
if ( ( ! empty( $buzzstone_anchor_icon ) || ! empty( $buzzstone_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_woocommerce"'
									. ( ! empty( $buzzstone_anchor_icon ) ? ' icon="' . esc_attr( $buzzstone_anchor_icon ) . '"' : '' )
									. ( ! empty( $buzzstone_anchor_text ) ? ' title="' . esc_attr( $buzzstone_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner
	<?php
	if ( buzzstone_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
		echo ' buzzstone-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$buzzstone_css      = '';
			$buzzstone_bg_mask  = buzzstone_get_theme_option( 'front_page_woocommerce_bg_mask' );
			$buzzstone_bg_color_type = buzzstone_get_theme_option( 'front_page_woocommerce_bg_color_type' );
			if ( 'custom' == $buzzstone_bg_color_type ) {
				$buzzstone_bg_color = buzzstone_get_theme_option( 'front_page_woocommerce_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$buzzstone_caption     = buzzstone_get_theme_option( 'front_page_woocommerce_caption' );
			$buzzstone_description = buzzstone_get_theme_option( 'front_page_woocommerce_description' );
			if ( ! empty( $buzzstone_caption ) || ! empty( $buzzstone_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $buzzstone_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $buzzstone_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses_post( $buzzstone_caption );
					?>
					</h2>
					<?php
				}

				// Description (text)
				if ( ! empty( $buzzstone_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $buzzstone_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses_post( wpautop( $buzzstone_description ) );
					?>
					</div>
					<?php
				}
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
			<?php
				$buzzstone_woocommerce_sc = buzzstone_get_theme_option( 'front_page_woocommerce_products' );
			if ( 'products' == $buzzstone_woocommerce_sc ) {
				$buzzstone_woocommerce_sc_ids      = buzzstone_get_theme_option( 'front_page_woocommerce_products_per_page' );
				$buzzstone_woocommerce_sc_per_page = count( explode( ',', $buzzstone_woocommerce_sc_ids ) );
			} else {
				$buzzstone_woocommerce_sc_per_page = max( 1, (int) buzzstone_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
			}
				$buzzstone_woocommerce_sc_columns = max( 1, min( $buzzstone_woocommerce_sc_per_page, (int) buzzstone_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
				echo do_shortcode(
					"[{$buzzstone_woocommerce_sc}"
									. ( 'products' == $buzzstone_woocommerce_sc
											? ' ids="' . esc_attr( $buzzstone_woocommerce_sc_ids ) . '"'
											: '' )
									. ( 'product_category' == $buzzstone_woocommerce_sc
											? ' category="' . esc_attr( buzzstone_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
											: '' )
									. ( 'best_selling_products' != $buzzstone_woocommerce_sc
											? ' orderby="' . esc_attr( buzzstone_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
												. ' order="' . esc_attr( buzzstone_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
											: '' )
									. ' per_page="' . esc_attr( $buzzstone_woocommerce_sc_per_page ) . '"'
									. ' columns="' . esc_attr( $buzzstone_woocommerce_sc_columns ) . '"'
					. ']'
				);
				?>
			</div>
		</div>
	</div>
</div>
