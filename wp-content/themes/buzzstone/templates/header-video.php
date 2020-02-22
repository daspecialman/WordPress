<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0.14
 */
$buzzstone_header_video = buzzstone_get_header_video();
$buzzstone_embed_video  = '';
if ( ! empty( $buzzstone_header_video ) && ! buzzstone_is_from_uploads( $buzzstone_header_video ) ) {
	if ( buzzstone_is_youtube_url( $buzzstone_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $buzzstone_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		global $wp_embed;
		if ( false && is_object( $wp_embed ) ) {
			$buzzstone_embed_video = do_shortcode( $wp_embed->run_shortcode( '[embed]' . trim( $buzzstone_header_video ) . '[/embed]' ) );
			$buzzstone_embed_video = buzzstone_make_video_autoplay( $buzzstone_embed_video );
		} else {
			$buzzstone_header_video = str_replace( '/watch?v=', '/embed/', $buzzstone_header_video );
			$buzzstone_header_video = buzzstone_add_to_url(
				$buzzstone_header_video, array(
					'feature'        => 'oembed',
					'controls'       => 0,
					'autoplay'       => 1,
					'showinfo'       => 0,
					'modestbranding' => 1,
					'wmode'          => 'transparent',
					'enablejsapi'    => 1,
					'origin'         => home_url(),
					'widgetid'       => 1,
				)
			);
			$buzzstone_embed_video  = '<iframe src="' . esc_url( $buzzstone_header_video ) . '" width="1278" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?>
		<div id="background_video"><?php buzzstone_show_layout( $buzzstone_embed_video ); ?></div>
		<?php
	}
}
