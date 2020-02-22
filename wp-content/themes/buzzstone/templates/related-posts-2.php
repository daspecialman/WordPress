<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

$buzzstone_link        = get_permalink();
$buzzstone_post_format = get_post_format();
$buzzstone_post_format = empty( $buzzstone_post_format ) ? 'standard' : str_replace( 'post-format-', '', $buzzstone_post_format );
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_' . esc_attr( $buzzstone_post_format ) ); ?>>
						<?php
						buzzstone_show_post_featured(
							array(
								'thumb_size'    => apply_filters( 'buzzstone_filter_related_thumb_size', buzzstone_get_thumb_size( (int) buzzstone_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'med' ) ),
								'show_no_image' => buzzstone_get_theme_setting( 'allow_no_image' ),
								'singular'      => false,
                                'thumb_ratio' => ((int) buzzstone_get_theme_option( 'related_posts' ) == 1 ? '1170:658' : '406:258' )
							)
						);
						?>
	<div class="post_header entry-header">
        <?php
        if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
            buzzstone_show_post_meta(
                apply_filters(
                    'buzzstone_filter_post_meta_args', array(
                    'components' => 'categories',
                    'counters'   => '',
                    'seo'        => false,
                ), 'extra', 1
                )
            );
        }
        ?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $buzzstone_link ); ?>"><?php the_title(); ?></a></h6>
        <?php
        if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
            buzzstone_show_post_meta(
                apply_filters(
                    'buzzstone_filter_post_meta_args', array(
                    'components' => 'author,counters',
                    'counters'   => 'comments',
                    'seo'        => false,
                ), 'extra', 1
                )
            );
        }
        ?>
	</div>
</div>
