<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js
									<?php
										// Class scheme_xxx need in the <html> as context for the <body>!
										echo ' scheme_' . esc_attr( buzzstone_get_theme_option( 'color_scheme' ) );
									?>
										">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php do_action( 'buzzstone_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">
			<?php
			// Desktop header
			$buzzstone_header_type = buzzstone_get_theme_option( 'header_type' );
			if ( 'custom' == $buzzstone_header_type && ! buzzstone_is_layouts_available() ) {
				$buzzstone_header_type = 'default';
			}
			get_template_part( apply_filters( 'buzzstone_filter_get_template_part', "templates/header-{$buzzstone_header_type}" ) );

			// Side menu
			if ( in_array( buzzstone_get_theme_option( 'menu_style' ), array( 'left', 'right' ) ) ) {
				get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-navi-side' ) );
			}

			// Mobile menu
			get_template_part( apply_filters( 'buzzstone_filter_get_template_part', 'templates/header-navi-mobile' ) );
			
			// Single posts banner after header
			buzzstone_show_post_banner( 'header' );
			?>

			<div class="page_content_wrap">
				<?php
				// Single posts banner on the background
				if ( is_singular( 'post' ) ) {

					buzzstone_show_post_banner( 'background' );

					$buzzstone_post_thumbnail_type  = buzzstone_get_theme_option( 'post_thumbnail_type' );
					$buzzstone_post_header_position = buzzstone_get_theme_option( 'post_header_position' );
					$buzzstone_post_header_align    = buzzstone_get_theme_option( 'post_header_align' );

					// Boxed post thumbnail
					if ( in_array( $buzzstone_post_thumbnail_type, array( 'boxed', 'fullwidth') ) ) {
						?>
						<div class="header_content_wrap header_align_<?php echo esc_attr( $buzzstone_post_header_align ); ?>">
							<?php
							if ( 'boxed' === $buzzstone_post_thumbnail_type ) {
								?>
								<div class="content_wrap">
								<?php
							}

							// Post title and meta
							if ( 'above' === $buzzstone_post_header_position ) {
								buzzstone_show_post_title_and_meta();
							}

							// Featured image
							buzzstone_show_post_featured_image();

							// Post title and meta
							if ( in_array( $buzzstone_post_header_position, array( 'under', 'on_thumb' ) ) ) {
								buzzstone_show_post_title_and_meta();
							}

							if ( 'boxed' === $buzzstone_post_thumbnail_type ) {
								?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
				}

				if ( 'fullscreen' != buzzstone_get_theme_option( 'body_style' ) ) {
					?>
					<div class="content_wrap">
						<?php
				}

				// Widgets area above page content
				buzzstone_create_widgets_area( 'widgets_above_page' );
				?>

				<div class="content">
					<?php
					// Widgets area inside page content
					buzzstone_create_widgets_area( 'widgets_above_content' );

                    // Page title and breadcrumbs area
                    if(!is_single()) {
                        get_template_part(apply_filters('buzzstone_filter_get_template_part', 'templates/header-title'));
                    }