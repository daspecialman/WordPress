<?php
/**
 * WP tags and utils
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

// Theme init
if ( ! function_exists( 'buzzstone_wp_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'buzzstone_wp_theme_setup' );
	function buzzstone_wp_theme_setup() {

		// Remove macros from title
		add_filter( 'wp_title', 'buzzstone_wp_title' );
		add_filter( 'wp_title_parts', 'buzzstone_wp_title' );
		add_filter( 'document_title_parts', 'buzzstone_wp_title' );

		// Breadcrumbs link 'All posts'
		add_filter( 'post_type_archive_link', 'buzzstone_get_template_page_link', 10, 2 );
	}
}


/* Blog utilities
-------------------------------------------------------------------------------- */

// Detect current blog mode to get correspond options (post | page | search | blog | front)
if ( ! function_exists( 'buzzstone_detect_blog_mode' ) ) {
	function buzzstone_detect_blog_mode() {
		if ( is_front_page() && ! is_home() ) {
			$mode = 'front';
		} elseif ( is_home() ) {
			$mode = 'home';     // Specify 'blog' if you don't need a separate options for the homepage
		} elseif ( is_single() ) {
			$mode = 'post';
		} elseif ( is_page() && ! buzzstone_storage_isset( 'blog_archive' ) ) {
			$mode = 'page';
		} else {
			$mode = 'blog';
		}
		return apply_filters( 'buzzstone_filter_detect_blog_mode', $mode );
	}
}

// Return image of current post/page/category/blog mode
if ( ! function_exists( 'buzzstone_get_current_mode_image' ) ) {
	function buzzstone_get_current_mode_image( $default = '' ) {
		if ( is_category() ) {
			$img = buzzstone_get_category_image();
			if ( '' != $img ) {
				$default = $img;
			}
		} elseif ( is_singular() || buzzstone_storage_isset( 'blog_archive' ) ) {
			if ( has_post_thumbnail() ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if ( is_array( $img ) ) {
					$default = $img[0];
				}
			} else {
				$default = '';
			}
		}
		return $default;
	}
}

// Start blog archive template
if ( ! function_exists( 'buzzstone_blog_archive_start' ) ) {
	function buzzstone_blog_archive_start() {
		$main_post = buzzstone_storage_get( 'blog_archive_template_post' );
		if ( is_object( $main_post ) ) {
			// Prepare post with template content
			$GLOBALS['post'] = $main_post;
			setup_postdata( $main_post );
			// Get template content
			$buzzstone_content            = '';
			$buzzstone_blog_archive_mask  = '%%CONTENT%%';
			$buzzstone_blog_archive_subst = sprintf( '<div class="blog_archive">%s</div>', $buzzstone_blog_archive_mask );
			$buzzstone_content            = apply_filters( 'the_content', get_the_content() );
			// Destroy sc parameters from the content of the template
			set_query_var( 'buzzstone_template_args', false );
			// Display parts of the template
			if ( '' != $buzzstone_content ) {
				$buzzstone_pos = strpos( $buzzstone_content, $buzzstone_blog_archive_mask );
				if ( false !== $buzzstone_pos ) {
					$buzzstone_content = preg_replace( '/(\<p\>\s*)?' . $buzzstone_blog_archive_mask . '(\s*\<\/p\>)/i', $buzzstone_blog_archive_subst, $buzzstone_content );
				} else {
					$buzzstone_content .= $buzzstone_blog_archive_subst;
				}
				$buzzstone_content = explode( $buzzstone_blog_archive_mask, $buzzstone_content );
				// Display first part
				buzzstone_show_layout( apply_filters( 'buzzstone_filter_blog_archive_start', $buzzstone_content[0] ) );
				// And store second part
				buzzstone_storage_set( 'blog_archive_end', $buzzstone_content[1] );
			}
			wp_reset_postdata();
		}
	}
}

// End blog archive template
if ( ! function_exists( 'buzzstone_blog_archive_end' ) ) {
	function buzzstone_blog_archive_end() {
		$html = buzzstone_storage_get( 'blog_archive_end' );
		if ( '' != $html ) {
			// Display second part of template content
			buzzstone_show_layout( apply_filters( 'buzzstone_filter_blog_archive_end', $html ) );
		}
	}
}

// Return name of the archive template for current blog style
if ( ! function_exists( 'buzzstone_blog_archive_get_template' ) ) {
	function buzzstone_blog_archive_get_template( $blog_style = '' ) {
		if ( empty( $blog_style ) ) {
			$blog_style = buzzstone_get_theme_option( 'blog_style' );
		}
		$parts   = explode( '_', $blog_style );
		$archive = '';
		if ( strpos( $parts[0], 'blog-custom-' ) === 0 ) {
			$archive = 'index-custom';
		} elseif ( buzzstone_storage_isset( 'blog_styles', $parts[0], 'archive' ) ) {
			$archive = buzzstone_storage_get_array( 'blog_styles', $parts[0], 'archive' );
		}
		return apply_filters( 'buzzstone_filter_blog_archive_template', $archive, $blog_style);
	}
}

// Return name of the item template for current blog style
if ( ! function_exists( 'buzzstone_blog_item_get_template' ) ) {
	function buzzstone_blog_item_get_template( $blog_style = '' ) {
		if ( empty( $blog_style ) ) {
			$blog_style = buzzstone_get_theme_option( 'blog_style' );
		}
		$parts = explode( '_', $blog_style );
		$item  = '';
		if ( buzzstone_storage_isset( 'blog_styles', $parts[0], 'item' ) ) {
			$item = buzzstone_storage_get_array( 'blog_styles', $parts[0], 'item' );
		} elseif ( strpos( $parts[0], 'blog-custom-' ) === 0 ) {
			$item = 'content-custom';
		}
		return $item;
	}
}


// Return ID of the post/page
if ( ! function_exists( 'buzzstone_get_post_id' ) ) {
	function buzzstone_get_post_id( $args = array() ) {
		$args  = array_merge(
			array(
				'posts_per_page' => 1,
			), $args
		);
		$id    = 0;
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$id = ! empty( $query->posts[0]->ID )
				? $query->posts[0]->ID
				: ( ! empty( $query->post->ID )
					? $query->post->ID
					: 0
					);
		}
		return $id;
	}
}


// Return full content of the post/page
if ( ! function_exists( 'buzzstone_get_post_content' ) ) {
	function buzzstone_get_post_content( $apply_filters=false ) {
		global $post;
		return $apply_filters ? apply_filters( 'the_content', $post->post_content ) : $post->post_content;
	}
}

// Return ID for the page with specified template
if ( ! function_exists( 'buzzstone_get_template_page_id' ) ) {
	function buzzstone_get_template_page_id( $args = array() ) {
		$args   = array_merge(
			array(
				'template'   => 'blog.php',
				'post_type'  => 'post',
				'parent_cat' => '',
			), $args
		);
		$q_args = array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'orderby'        => 'id',
			'order'          => 'asc',
			'meta_query'     => array( 'relation' => 'AND' ),
		);
		if ( ! empty( $args['template'] ) ) {
			$q_args['meta_query'][] = array(
				'key'     => '_wp_page_template',
				'value'   => $args['template'],
				'compare' => '=',
			);
		}
		if ( ! empty( $args['post_type'] ) ) {
			$q_args['meta_query'][] = array(
				'key'     => 'buzzstone_options_post_type',
				'value'   => $args['post_type'],
				'compare' => '=',
			);
		}
		if ( '' !== $args['parent_cat'] ) {
			$q_args['meta_query'][] = array(
				'key'     => 'buzzstone_options_parent_cat',
				'value'   => $args['parent_cat'] > 0 ? $args['parent_cat'] : 1,
				'compare' => $args['parent_cat'] > 0 ? '=' : '<',
			);
		}
		return buzzstone_get_post_id( $q_args );
	}
}

// Return link to the page with theme specific $post_type archive template page:
if ( ! function_exists( 'buzzstone_get_template_page_link' ) ) {
	//Handler of the add_filter('post_type_archive_link', 'buzzstone_get_template_page_link', 10, 2 );
	function buzzstone_get_template_page_link( $link = '', $post_type = '' ) {
		if ( ! empty( $post_type ) ) {
			$id = buzzstone_get_template_page_id(
				array(
					'post_type'  => $post_type,
					'parent_cat' => 0,
				)
			);
			if ( $id > 0 ) {
				$link = get_permalink( $id );
			}
		}
		return $link;
	}
}


// Return current site protocol
if ( ! function_exists( 'buzzstone_get_protocol' ) ) {
	function buzzstone_get_protocol() {
		return is_ssl() ? 'https' : 'http';
	}
}

// Return internal page link - if is customize mode - full url else only hash part
if ( ! function_exists( 'buzzstone_get_hash_link' ) ) {
	function buzzstone_get_hash_link( $hash ) {
		if ( 0 !== strpos( $hash, 'http' ) ) {
			if ( '#' != $hash[0] ) {
				$hash = '#' . $hash;
			}
			if ( is_customize_preview() ) {
				$url = buzzstone_get_current_url();
				$pos = strpos( $url, '#' );
				if ( false !== $pos ) {
					$url = substr( $url, 0, $pos );
				}
				$hash = $url . $hash;
			}
		}
		return $hash;
	}
}

// Return URL to the current page
if ( ! function_exists( 'buzzstone_get_current_url' ) ) {
	function buzzstone_get_current_url() {
		return add_query_arg( array() );
	}
}

// Remove macros from the title
if ( ! function_exists( 'buzzstone_wp_title' ) ) {
	// Handler of the add_filter( 'wp_title', 'buzzstone_wp_title');
	// Handler of the add_filter( 'wp_title_parts', 'buzzstone_wp_title');
	// Handler of the add_filter( 'document_title_parts', 'buzzstone_wp_title');
	function buzzstone_wp_title( $title ) {
		if ( is_array( $title ) ) {
			foreach ( $title as $k => $v ) {
				$title[ $k ] = buzzstone_remove_macros( $v );
			}
		} else {
			$title = buzzstone_remove_macros( $title );
		}
		return $title;
	}
}

// Return blog title
if ( ! function_exists( 'buzzstone_get_blog_title' ) ) {
	function buzzstone_get_blog_title() {

		if ( is_front_page() ) {
			$title = esc_html__( 'Home', 'buzzstone' );
		} elseif ( is_home() ) {
			$title = esc_html__( 'All Posts', 'buzzstone' );
		} elseif ( is_author() ) {
			$curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
			// Translators: Add the author's name to the title
			$title = sprintf( esc_html__( 'Author page: %s', 'buzzstone' ), $curauth->display_name );
		} elseif ( is_404() ) {
			$title = esc_html__( 'URL not found', 'buzzstone' );
		} elseif ( is_search() ) {
			// Translators: Add the author's name to the title
			$title = sprintf( esc_html__( 'Search: %s', 'buzzstone' ), get_search_query() );
		} elseif ( is_day() ) {
			// Translators: Add the queried date to the title
			$title = sprintf( esc_html__( 'Daily Archives: %s', 'buzzstone' ), get_the_date() );
		} elseif ( is_month() ) {
			// Translators: Add the queried month to the title
			$title = sprintf( esc_html__( 'Monthly Archives: %s', 'buzzstone' ), get_the_date( 'F Y' ) );
		} elseif ( is_year() ) {
			// Translators: Add the queried year to the title
			$title = sprintf( esc_html__( 'Yearly Archives: %s', 'buzzstone' ), get_the_date( 'Y' ) );
		} elseif ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			// Translators: Add the tag's name to the title
			$title = sprintf( esc_html__( 'Tag: %s', 'buzzstone' ), single_tag_title( '', false ) );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		} elseif ( is_post_type_archive() ) {
			$obj   = get_queried_object();
			$title = ! empty( $obj->labels->all_items ) ? $obj->labels->all_items : '';
		} elseif ( is_attachment() ) {
			// Translators: Add the attachment's name to the title
			$title = sprintf( esc_html__( 'Attachment: %s', 'buzzstone' ), get_the_title() );
		} elseif ( is_single() || is_page() ) {
			$title = get_the_title();
		} else {
			$title = get_the_title();
		}
		return apply_filters( 'buzzstone_filter_get_blog_title', $title );
	}
}

// Return nav menu html
if ( ! function_exists( 'buzzstone_get_nav_menu' ) ) {
	function buzzstone_get_nav_menu( $location = '', $menu = '', $depth = 11, $custom_walker = false ) {
		static $list = array();
		$class       = '';
		if ( is_array( $location ) ) {
			$loc      = $location;
			$location = '';
			if ( ! empty( $loc['location'] ) ) {
				$location = $loc['location'];
			}
			if ( ! empty( $loc['class'] ) ) {
				$class = $loc['class'];
			}
		}
		$slug = $location . '_' . $menu;
		if ( empty( $list[ $slug ] ) ) {
			$list[ $slug ] = esc_html__( 'You are trying to use a menu inserted in himself!', 'buzzstone' );
			$args          = array(
				'menu'            => empty( $menu ) || 'default' == $menu || buzzstone_is_inherit( $menu ) ? '' : $menu,
				'container'       => 'nav',
				'container_class' => ( ! empty( $location ) ? esc_attr( $location ) : 'menu_main' ) . '_nav_area'
										. ( ! empty( $class ) ? ' ' . esc_attr( $class ) : '' ),
				'container_id'    => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'menu_class'      => 'sc_layouts_menu_nav ' . ( ! empty( $location ) ? esc_attr( $location ) : 'menu_main' ) . '_nav',
				'menu_id'         => ( ! empty( $location ) ? esc_attr( $location ) : 'menu_main' ),
				'echo'            => false,
				'fallback_cb'     => '',
				'before'          => '',
				'after'           => '',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'depth'           => $depth,
			);
			if ( ! empty( $location ) ) {
				$args['theme_location'] = $location;
			}
			if ( $custom_walker && class_exists( 'buzzstone_custom_menu_walker' ) ) {
				$args['walker'] = new buzzstone_custom_menu_walker;
			}
			// Remove spaces between menu items
			$list[ $slug ] = preg_replace(
				array( "/>[\r\n\s]*<li/", "/>[\r\n\s]*<\\/ul>/" ),
				array( '><li', '></ul>' ),
				wp_nav_menu( apply_filters( 'buzzstone_filter_get_nav_menu_args', $args ) )
			);
			// Add Structured Data Snippet
			$list[ $slug ] = str_replace( '<nav', '<nav itemscope itemtype="http://schema.org/SiteNavigationElement"', $list[ $slug ] );
		}
		return apply_filters( 'buzzstone_filter_get_nav_menu', $list[ $slug ], $location, $menu );
	}
}

// Return string with categories links
if ( ! function_exists( 'buzzstone_get_post_categories' ) ) {
	function buzzstone_get_post_categories( $delimiter = ', ', $id = false, $links = true ) {
		return buzzstone_get_post_terms( $delimiter, $id, 'category', $links );
	}
}

// Return string with terms links
if ( ! function_exists( 'buzzstone_get_post_terms' ) ) {
	function buzzstone_get_post_terms( $delimiter = ', ', $id = false, $taxonomy = 'category', $links = true ) {
		$output = '';
		if ( empty( $id ) ) {
			$id = get_the_ID();
		}
		if ( empty( $taxonomy ) ) {
			$taxonomy = buzzstone_get_post_type_taxonomy( get_post_type( $id ) );
		}
		$terms = get_the_terms( $id, $taxonomy );
		if ( ! empty( $terms ) && is_array( $terms ) ) {
			$cnt = count( $terms );
			$i   = 0;
			foreach ( $terms as $term ) {
				if ( empty( $term->term_id ) ) {
					continue;
				}
				$i++;
				$output .= ( $links
									? '<a href="' . esc_url( get_term_link( $term->term_id, $taxonomy ) ) . '"'
											// Translators: Add the term's name to the title
											. ' title="' . sprintf( esc_attr__( 'View all posts in %s', 'buzzstone' ), $term->name ) . '"'
											. '>'
									: '<span>'
								)
								. apply_filters( 'buzzstone_filter_term_name', $term->name, $term )
								. ( $i < $cnt ? $delimiter : '' )
							. ( $links ? '</a>' : '</span>' );
			}
		}
		return $output;
	}
}

// Return taxonomy for current post type
if ( ! function_exists( 'buzzstone_get_post_type_taxonomy' ) ) {
	function buzzstone_get_post_type_taxonomy( $post_type = '' ) {
		if ( empty( $post_type ) ) {
			$post_type = get_post_type();
		}
		if ( 'post' == $post_type ) {
			$tax = 'category';
		} else {
			$taxonomy_names = get_object_taxonomies( $post_type );
			$tax            = ! empty( $taxonomy_names[0] ) ? $taxonomy_names[0] : '';
		}
		return apply_filters( 'buzzstone_filter_post_type_taxonomy', $tax, $post_type );
	}
}

// Return editing post type or empty string if not edit mode
if ( ! function_exists( 'buzzstone_get_edited_post_type' ) ) {
	function buzzstone_get_edited_post_type() {
		$pt = '';
		if ( is_admin() ) {
			$url = buzzstone_get_current_url();
			if ( strpos( $url, 'post.php' ) !== false ) {
				if ( buzzstone_get_value_gp( 'action' ) == 'edit' ) {
					$id = buzzstone_get_value_gp( 'post' );
					if ( 0 < $id ) {
						$post = get_post( (int) $id );
						if ( is_object( $post ) && ! empty( $post->post_type ) ) {
							$pt = $post->post_type;
						}
					}
				}
			} elseif ( strpos( $url, 'post-new.php' ) !== false ) {
				$pt = buzzstone_get_value_gp( 'post_type' );
			}
		}
		return $pt;
	}
}


/* Query manipulations
-------------------------------------------------------------------------------- */

// Add sorting parameter in query arguments
if ( ! function_exists( 'buzzstone_query_add_sort_order' ) ) {
	function buzzstone_query_add_sort_order( $args, $orderby = 'date', $order = 'desc' ) {
		if ( ! empty( $orderby ) && ( empty( $args['orderby'] ) || 'none' != $orderby ) ) {
			$q          = apply_filters( 'buzzstone_filter_query_sort_order', array(), $orderby, $order );
			$q['order'] = 'asc' == $order ? 'asc' : 'desc';
			if ( empty( $q['orderby'] ) ) {
				if ( 'none' == $orderby ) {
					$q['orderby'] = 'none';
				} elseif ( 'ID' == $orderby ) {
					$q['orderby'] = 'ID';
				} elseif ( 'comments' == $orderby ) {
					$q['orderby'] = 'comment_count';
				} elseif ( 'title' == $orderby || 'alpha' == $orderby ) {
					$q['orderby'] = 'title';
				} elseif ( 'rand' == $orderby || 'random' == $orderby ) {
					$q['orderby'] = 'rand';
				} else {
					$q['orderby'] = 'post_date';
				}
			}
			foreach ( $q as $mk => $mv ) {
				if ( is_array( $args ) ) {
					$args[ $mk ] = $mv;
				} else {
					$args->set( $mk, $mv );
				}
			}
		}
		return $args;
	}
}

// Add post type and posts list or categories list in query arguments
if ( ! function_exists( 'buzzstone_query_add_posts_and_cats' ) ) {
	function buzzstone_query_add_posts_and_cats( $args, $ids = '', $post_type = '', $cat = '', $taxonomy = '' ) {
		if ( ! empty( $ids ) ) {
			$args['post_type'] = empty( $args['post_type'] )
									? ( empty( $post_type ) ? array( 'post', 'page' ) : $post_type )
									: $args['post_type'];
			$args['post__in']  = explode( ',', str_replace( ' ', '', $ids ) );
			if ( empty( $args['orderby'] ) || 'none' == $args['orderby'] ) {
				$args['orderby'] = 'post__in';
				if ( isset( $args['order'] ) ) {
					unset( $args['order'] );
				}
			}
		} else {
			$args['post_type'] = empty( $args['post_type'] )
									? ( empty( $post_type ) ? 'post' : $post_type )
									: $args['post_type'];
			$post_type         = is_array( $args['post_type'] ) ? $args['post_type'][0] : $args['post_type'];
			if ( ! empty( $cat ) ) {
				$cats = ! is_array( $cat ) ? explode( ',', $cat ) : $cat;
				if ( empty( $taxonomy ) ) {
					$taxonomy = buzzstone_get_post_type_taxonomy( $post_type );
				}
				if ( 'category' == $taxonomy ) {              // Add standard categories
					if ( is_array( $cats ) && count( $cats ) > 1 ) {
						$cats_ids = array();
						foreach ( $cats as $c ) {
							$c = trim( $c );
							if ( empty( $c ) ) {
								continue;
							}
							if ( 0 == (int) $c ) {
								$cat_term = get_term_by( 'slug', $c, $taxonomy, OBJECT );
								if ( $cat_term ) {
									$c = $cat_term->term_id;
								}
							}
							if ( 0 == $c ) {
								continue;
							}
							$cats_ids[] = (int) $c;
							$children   = get_categories(
								array(
									'type'         => $post_type,
									'child_of'     => $c,
									'hide_empty'   => 0,
									'hierarchical' => 0,
									'taxonomy'     => $taxonomy,
									'pad_counts'   => false,
								)
							);
							if ( is_array( $children ) && count( $children ) > 0 ) {
								foreach ( $children as $c ) {
									if ( ! in_array( (int) $c->term_id, $cats_ids ) ) {
										$cats_ids[] = (int) $c->term_id;
									}
								}
							}
						}
						if ( count( $cats_ids ) > 0 ) {
							$args['category__in'] = $cats_ids;
						}
					} else {
						if ( 0 < (int) $cat ) {
							$args['cat'] = (int) $cat;
						} else {
							$args['category_name'] = $cat;
						}
					}
				} else {                                    // Add custom taxonomies
					if ( ! isset( $args['tax_query'] ) ) {
						$args['tax_query'] = array();
					}
					$args['tax_query']['relation'] = 'AND';
					$args['tax_query'][]           = array(
						'taxonomy'         => $taxonomy,
						'include_children' => true,
						'field'            => (int) $cats[0] > 0 ? 'id' : 'slug',
						'terms'            => $cats,
					);
				}
			}
		}
		return $args;
	}
}

// Add filters (meta parameters) in query arguments
if ( ! function_exists( 'buzzstone_query_add_filters' ) ) {
	function buzzstone_query_add_filters( $args, $filters = false ) {
		if ( ! empty( $filters ) ) {
			if ( ! is_array( $filters ) ) {
				$filters = array( $filters );
			}
			foreach ( $filters as $v ) {
				$found = false;
				if ( 'thumbs' == $v ) {                                                      // Filter with meta_query
					if ( ! isset( $args['meta_query'] ) ) {
						$args['meta_query'] = array();
					} else {
						for ( $i = 0; $i < count( $args['meta_query'] ); $i++ ) {
							if ( $args['meta_query'][ $i ]['meta_filter'] == $v ) {
								$found = true;
								break;
							}
						}
					}
					if ( ! $found ) {
						$args['meta_query']['relation'] = 'AND';
						if ( 'thumbs' == $v ) {
							$args['meta_query'][] = array(
								'meta_filter' => $v,
								'key'         => '_thumbnail_id',
								'value'       => false,
								'compare'     => '!=',
							);
						}
					}
				} elseif ( in_array( $v, array( 'video', 'audio', 'gallery' ) ) ) {          // Filter with tax_query
					if ( ! isset( $args['tax_query'] ) ) {
						$args['tax_query'] = array();
					} else {
						for ( $i = 0; $i < count( $args['tax_query'] ); $i++ ) {
							if ( $args['tax_query'][ $i ]['tax_filter'] == $v ) {
								$found = true;
								break;
							}
						}
					}
					if ( ! $found ) {
						$args['tax_query']['relation'] = 'AND';
						if ( 'video' == $v ) {
							$args['tax_query'][] = array(
								'tax_filter' => $v,
								'taxonomy'   => 'post_format',
								'field'      => 'slug',
								'terms'      => array( 'post-format-video' ),
							);
						} elseif ( 'audio' == $v ) {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy'   => 'post_format',
								'field'      => 'slug',
								'terms'      => array( 'post-format-audio' ),
							);
						} elseif ( 'gallery' == $v ) {
							$args['tax_query'] = array(
								'tax_filter' => $v,
								'taxonomy'   => 'post_format',
								'field'      => 'slug',
								'terms'      => array( 'post-format-gallery' ),
							);
						}
					}
				}
			}
		}
		return $args;
	}
}




/* Widgets utils
------------------------------------------------------------------------------------- */

// Create widgets area
if ( ! function_exists( 'buzzstone_create_widgets_area' ) ) {
	function buzzstone_create_widgets_area( $name, $add_classes = '' ) {
		$widgets_name = buzzstone_get_theme_option( $name );
		if ( ! buzzstone_is_off( $widgets_name ) && is_active_sidebar( $widgets_name ) ) {
			buzzstone_storage_set( 'current_sidebar', $name );
			ob_start();
			dynamic_sidebar( $widgets_name );
			$out = trim( ob_get_contents() );
			ob_end_clean();
			if ( ! empty( $out ) ) {
				$out          = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $out );
				$need_columns = strpos( $out, 'columns_wrap' ) === false;
				if ( $need_columns ) {
					$columns = apply_filters( 'buzzstone_filter_widgets_area_columns', min( 4, max( 1, substr_count( $out, '<aside ' ) ) ), $name );
					$out     = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $columns ) . ' widget', $out );
				}
				?>
				<div class="<?php echo esc_attr( $name ); ?> <?php echo esc_attr( $name ); ?>_wrap widget_area">
					<div class="<?php echo esc_attr( $name ); ?>_inner <?php echo esc_attr( $name ); ?>_inner widget_area_inner">
						<?php
						do_action( 'buzzstone_action_before_sidebar' );
						buzzstone_show_layout(
							$out,
							true == $need_columns ? '<div class="columns_wrap">' : '',
							true == $need_columns ? '</div>' : ''
						);
						do_action( 'buzzstone_action_after_sidebar' );
						?>
					</div> <!-- /.widget_area_inner -->
				</div> <!-- /.widget_area -->
				<?php
			}
		}
	}
}

// Check if sidebar present
if ( ! function_exists( 'buzzstone_sidebar_present' ) ) {
	function buzzstone_sidebar_present() {
		global $wp_query;
		$sidebar_position = buzzstone_get_theme_option( 'sidebar_position' );
		$sidebar_name     = buzzstone_get_theme_option( 'sidebar_widgets' );
		return apply_filters(
			'buzzstone_filter_sidebar_present',
			! buzzstone_is_off( $sidebar_position )
					&& ! buzzstone_is_off( $sidebar_name )
					&& is_active_sidebar( $sidebar_name )
					&& ! is_404()
					&& ( ! is_search() || $wp_query->found_posts > 0 )
					&& ( ! is_single() || buzzstone_is_off( buzzstone_get_theme_option( 'hide_sidebar_on_single' ) ) )
		);
	}
}




/* Inline styles and scripts
------------------------------------------------------------------------------------- */

// Add inline styles and return class for it
if ( ! function_exists( 'buzzstone_add_inline_css_class' ) ) {
	function buzzstone_add_inline_css_class( $css, $suffix = '' ) {
		$class_name = sprintf( 'buzzstone_inline_%d', mt_rand() );
		buzzstone_add_inline_css( sprintf( '.%s%s{%s}', $class_name, ! empty( $suffix ) ? ( substr( $suffix, 0, 1 ) != ':' ? ' ' : '' ) . esc_attr( $suffix ) : '', $css ) );
		return $class_name;
	}
}

// Add inline styles
if ( ! function_exists( 'buzzstone_add_inline_css' ) ) {
	function buzzstone_add_inline_css( $css ) {
		if ( function_exists( 'trx_addons_add_inline_css' ) ) {
			trx_addons_add_inline_css( $css );
		} else {
			buzzstone_storage_concat( 'inline_styles', $css );
		}
	}
}

// Return inline styles
if ( ! function_exists( 'buzzstone_get_inline_css' ) ) {
	function buzzstone_get_inline_css() {
		return buzzstone_storage_get( 'inline_styles' );
	}
}



/* Date & Time
----------------------------------------------------------------------------------------------------- */

// Return post date
if ( ! function_exists( 'buzzstone_get_date' ) ) {
	function buzzstone_get_date( $dt = '', $format = '' ) {
		global $wp_query;
		if ( '' == $dt ) {
			$dt = get_the_time( 'U', ! is_object( $wp_query ) || ! is_object( $wp_query->post ) || $wp_query->current_post >= 0 ? null : $wp_query->post->ID );
		}
		if ( date( 'U' ) - $dt > intval( buzzstone_get_theme_option( 'time_diff_before' ) ) * 24 * 3600 ) {
			$dt = date_i18n( '' == $format ? get_option( 'date_format' ) : $format, $dt );
		} else {
			// Translators: Add the human-friendly date difference
			$dt = sprintf( esc_html__( '%s ago', 'buzzstone' ), human_time_diff( $dt, current_time( 'timestamp' ) ) );
		}
		return $dt;
	}
}



/* Structured Data
----------------------------------------------------------------------------------------------------- */

// Return markup schema
if ( ! function_exists( 'buzzstone_get_markup_schema' ) ) {
	function buzzstone_get_markup_schema() {
		if ( is_single() ) {                                        // Is single post
			$type = 'Article';
		} elseif ( is_home() || is_archive() || is_category() ) {    // Is blog home, archive or category
			$type = 'Blog';
		} elseif ( is_front_page() ) {                                // Is static front page
			$type = 'Website';
		} else { // Is a general page
			$type = 'WebPage';
		}
		return $type;
	}
}


// Return text for the Privacy Policy checkbox
if ( ! function_exists('buzzstone_get_privacy_text' ) ) {
	function buzzstone_get_privacy_text() {
		$page = get_option( 'wp_page_for_privacy_policy' );
		$privacy_text = buzzstone_get_theme_option( 'privacy_text' );
		return apply_filters( 'buzzstone_filter_privacy_text', wp_kses_post( 
			$privacy_text
			. ( ! empty( $page ) && ! empty( $privacy_text )
				// Translators: Add url to the Privacy Policy page
				? ' ' . sprintf( __( 'For further details on handling user data, see our %s', 'buzzstone' ),
						'<a href="' . esc_url( get_permalink( $page ) ) . '" target="_blank">'
							. __( 'Privacy Policy', 'buzzstone' )
						. '</a>' )
				: ''
				)
			)
		);
	}
}
