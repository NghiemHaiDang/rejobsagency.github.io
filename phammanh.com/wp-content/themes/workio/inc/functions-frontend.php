<?php

if ( ! function_exists( 'workio_post_tags' ) ) {
	function workio_post_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			echo '<span class="entry-tags-list"><strong>'.esc_html__( 'Tags: ' , 'workio' ).'</strong> ';
			$i = 1;
			$size = count( $posttags );
			foreach ( $posttags as $tag ) {
				echo '<a href="' . get_tag_link( $tag->term_id ) . '">';
				echo esc_attr($tag->name);
				echo '</a>';
				$i ++;
			}
			echo '</span>';
		}
	}
}

if ( !function_exists('workio_get_page_title') ) {
	function workio_get_page_title() {
		$title = '';
		if ( !is_front_page() || is_paged() ) {
			global $post;
			$homeLink = esc_url( home_url() );

			if ( is_home() ) {
				$title = esc_html__( 'Blog', 'workio' );
			} elseif (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$title = $cat_obj->name;
			} elseif (is_day()) {
				$title = get_the_time('d F Y');
			} elseif (is_month()) {
				$title = get_the_time('F Y');
			} elseif (is_year()) {
				$title = get_the_time('Y');
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$title = get_the_title();
				} else {
					$title = '';
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() && !is_search() ) {
				$post_type = get_post_type_object(get_post_type());

				if ( is_tax('job_listing_category') || is_tax('job_listing_type') || is_tax('job_listing_location') || is_tax('job_listing_tag')  || is_tax('candidate_category') || is_tax('candidate_location') || is_tax('candidate_tag') || is_tax('employer_category') || is_tax('employer_location') ) {
					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$title = $cat_obj->name;
				} elseif ( is_object($post_type) ) {
					$title = $post_type->labels->singular_name;
				}
			} elseif (is_attachment()) {
				$title = get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_page() && $post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_search() ) {
				$title = sprintf(esc_html__('Search results for "%s"', 'workio'), get_search_query());
			} elseif ( is_tag() ) {
				$title = sprintf(esc_html__('Posts tagged "%s"', 'workio'), single_tag_title('', false) );
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$title = $userdata->display_name;
			} elseif ( is_404() ) {
				$title = esc_html__('Error 404', 'workio');
			}
		}else{
			$title = get_the_title();
		}
		return $title;
	}
}

if ( ! function_exists( 'workio_breadcrumbs' ) ) {
	function workio_breadcrumbs() {

		$delimiter = ' ';
		$home = esc_html__('Home', 'workio');
		$before = '<li><span class="active">';
		$after = '</span></li>';
		
		if ( !is_front_page() || is_paged()) {
			global $post;
			$homeLink = esc_url( home_url() );
			
			echo '<div class="left-inner"><ol class="breadcrumb">';
			echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

			if (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				echo '<li>';
				if ($thisCat->parent != 0)
					echo get_category_parents($parentCat, TRUE, '</li><li>');
				echo '<span class="active">'.single_cat_title('', false) . $after;
			} elseif (is_day()) {
				echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('d') . $after;
			} elseif (is_month()) {
				echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('F') . $after;
			} elseif (is_year()) {
				echo trim($before) . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() == 'job_listing' ) {
					if ( class_exists('WP_Job_Board_Mixes') ) {
						$url = WP_Job_Board_Mixes::get_jobs_page_url();
						echo '<li><a href="' . esc_url($url) . '">' . esc_html__('Jobs', 'workio') . '</a></li> ' . $delimiter . ' ';
					}
					echo trim($before) . esc_html__('Job Details', 'workio') . $after;
				} elseif ( get_post_type() == 'employer' ) {
					if ( class_exists('WP_Job_Board_Mixes') ) {
						$url = WP_Job_Board_Mixes::get_employers_page_url();
						echo '<li><a href="' . esc_url($url) . '">' . esc_html__('Employers', 'workio') . '</a></li> ' . $delimiter . ' ';
					}
					echo trim($before) . get_the_title() . $after;
				} elseif ( get_post_type() == 'candidate' ) {
					if ( class_exists('WP_Job_Board_Mixes') ) {
						$url = WP_Job_Board_Mixes::get_candidates_page_url();
						echo '<li><a href="' . esc_url($url) . '">' . esc_html__('Candidates', 'workio') . '</a></li> ' . $delimiter . ' ';
					}
					echo trim($before) . get_the_title() . $after;
				} elseif ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					
					echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
					echo trim($before) . get_the_title() . $after;
				} elseif ( get_post_type() == 'post' ) {
					global $post;
					$cat = get_the_category(); $cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, '</li><li>');
					echo '<span class="active">'. $post->post_title . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, '</li>');
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() && !is_search()) {
				$post_type = get_post_type_object(get_post_type());
				if ( is_tax('job_listing_category') || is_tax('job_listing_type') || is_tax('job_listing_location') || is_tax('job_listing_tag') ) {
					if ( class_exists('WP_Job_Board_Mixes') ) {
						$url = WP_Job_Board_Mixes::get_jobs_page_url();
						echo '<li><a href="' . esc_url($url) . '">' . esc_html__('Jobs', 'workio') . '</a></li> ' . $delimiter . ' ';
					}

					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$parentCat = get_term($cat_obj->parent, $cat_obj->taxonomy);
					echo '<li>';
					if ( ! empty( $parentCat ) && ! is_wp_error( $parentCat ) ) {
						echo workio_get_taxonomy_parents($parentCat->term_id, $cat_obj->taxonomy, TRUE, '</li><li>');
					}

					echo '<span class="active">'.single_cat_title('', false) . $after;
				} elseif ( is_tax('employer_category') || is_tax('employer_location') ) {
					if ( class_exists('WP_Job_Board_Mixes') ) {
						$url = WP_Job_Board_Mixes::get_employers_page_url();
						echo '<li><a href="' . esc_url($url) . '">' . esc_html__('Employers', 'workio') . '</a></li> ' . $delimiter . ' ';
					}

					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$parentCat = get_term($cat_obj->parent, $cat_obj->taxonomy);
					echo '<li>';
					if ( ! empty( $parentCat ) && ! is_wp_error( $parentCat ) ) {
						echo workio_get_taxonomy_parents($parentCat->term_id, $cat_obj->taxonomy, TRUE, '</li><li>');
					}

					echo '<span class="active">'.single_cat_title('', false) . $after;
				} elseif ( is_tax('candidate_category') || is_tax('candidate_location') || is_tax('candidate_tag') ) {
					if ( class_exists('WP_Job_Board_Mixes') ) {
						$url = WP_Job_Board_Mixes::get_candidates_page_url();
						echo '<li><a href="' . esc_url($url) . '">' . esc_html__('Candidates', 'workio') . '</a></li> ' . $delimiter . ' ';
					}

					global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
					$parentCat = get_term($cat_obj->parent, $cat_obj->taxonomy);
					echo '<li>';
					if ( ! empty( $parentCat ) && ! is_wp_error( $parentCat ) ) {
						echo workio_get_taxonomy_parents($parentCat->term_id, $cat_obj->taxonomy, TRUE, '</li><li>');
					}

					echo '<span class="active">'.single_cat_title('', false) . $after;
				}
				elseif (is_object($post_type)) {
					echo trim($before) . $post_type->labels->singular_name . $after;
				}
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				echo '<li>';
				if ( !empty($cat) ) {
					$cat = $cat[0];
					echo get_category_parents($cat, TRUE, '</li><li>');
				}
				if ( !empty($parent) ) {
					echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a></li><li>';
				}
				echo '<span class="active">'.get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) {
					echo trim($crumb) . ' ' . $delimiter . ' ';
				}
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_search() ) {
				echo trim($before) . sprintf(esc_html__('Search results for "%s"','workio'), get_search_query()) . $after;
			} elseif ( is_tag() ) {
				echo trim($before) . sprintf(esc_html__('Posts tagged "%s"', 'workio'), single_tag_title('', false)) . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo trim($before) . esc_html__('Articles posted by ', 'workio') . $userdata->display_name . $after;
			} elseif ( is_404() ) {
				echo trim($before) . esc_html__('Error 404', 'workio') . $after;
			} elseif ( is_home() ) {
				echo trim($before) . esc_html__('Blog', 'workio') . $after;
			}

			echo '</ol></div>';
		}
	}
}

function workio_get_taxonomy_parents( $id, $taxonomy = 'category', $link = false, $separator = '/', $nicename = false, $visited = array() ) {
    $chain = '';
    $parent = get_term( $id, $taxonomy );
    if ( is_wp_error( $parent ) ) {
        return $parent;
    }
    if ( $nicename ) {
        $name = $parent->slug;
    } else {
        $name = $parent->name;
    }

    if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
        $visited[] = $parent->parent;
        $chain .= workio_get_taxonomy_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );
    }

    if ( $link ) {
        $chain .= '<a href="' . esc_url( get_term_link( $parent,$taxonomy ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'workio' ), $parent->name ) ) . '">'.$name.'</a>' . $separator;
 	} else {
        $chain .= $name.$separator;
    }
    return $chain;
}

if ( ! function_exists( 'workio_render_breadcrumbs' ) ) {
	function workio_render_breadcrumbs() {
		global $post;
		$has_bg = '';
		$show = true;
		$style = $classes = array();
		$full_width = 'container';
		if ( is_page('221') || is_post_type_archive('job_listing') || is_tax('job_listing_type') || is_tax('job_listing_category') || is_tax('job_listing_location') || is_tax('job_listing_tag') ) {
			echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_vieclam', 'option').'"]');
			echo '</div></section>';
		} elseif ( is_page('409') || is_post_type_archive('employer') || is_tax('employer_category') || is_tax('employer_location') ) {
			echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_congty', 'option').'"]');
			echo '</div></section>';
		} elseif ( is_page('373') || is_post_type_archive('candidate') || is_tax('candidate_category') || is_tax('candidate_location') || is_tax('candidate_tag') ) {
			echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_ungvien', 'option').'"]');
			echo '</div></section>';
		} elseif(is_page('461')) {
		    echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_blog', 'option').'"]');
			echo '</div></section>';
		} elseif(is_page('1659')) {
		    echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_aboutus', 'option').'"]');
			echo '</div></section>';
		} elseif(is_page('1770')) {
		    echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_contact', 'option').'"]');
			echo '</div></section>';
		} elseif(is_page('767')) {
		    echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_home', 'option').'"]');
			echo '</div></section>';
		} elseif(is_page('454')) {
		    echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_login', 'option').'"]');
			echo '</div></section>';
		} elseif(is_search()) {
		    echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb" style="margin: 0;"><div>';
			echo do_shortcode('[INSERT_ELEMENTOR id="'.get_field('banner_search', 'option').'"]');
			echo '</div></section>';
		}
		
		elseif ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'apus_page_show_breadcrumb', true );
			if ( $show == 'no' ) {
				return ''; 
			}
			$bgimage = get_post_meta( $post->ID, 'apus_page_breadcrumb_image', true );
			$bgcolor = get_post_meta( $post->ID, 'apus_page_breadcrumb_color', true );
			$style = array();
			if ( $bgcolor ) {
				$style[] = 'background-color:'.$bgcolor;
			}
			if ( $bgimage ) { 
				$style[] = 'background-image:url(\''.esc_url($bgimage).'\')';
				$has_bg = 1;
			}
			$full_width = apply_filters('workio_page_content_class', 'container');
			$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";
    		$classes[] = $has_bg ? 'has_bg' :'';
    
    		$title = workio_get_page_title();
    		echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb x '.implode(' ', $classes).'"'.$estyle.'><div class="'.$full_width.'"><div class="wrapper-breads"><div class="wrapper-breads-inner">';
    			workio_breadcrumbs();
    
    			echo '<div class="breadscrumb-inner clearfix">';
    			if(!empty($title)){
    				echo '<h2 class="bread-title">'.$title.'</h2>';
    			}
    			echo '</div>';

    		echo '</div></div></div></section>';
		} elseif ( is_search() ) {
			$show = workio_get_config('show_blog_breadcrumbs', true);
			if ( !$show || is_front_page() ) {
				return ''; 
			}
			$breadcrumb_img = workio_get_config('blog_breadcrumb_image');
	        $breadcrumb_color = workio_get_config('blog_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $has_bg = 1;
	        }
	        $full_width = apply_filters('workio_blog_content_class', 'container');
	        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";
    		$classes[] = $has_bg ? 'has_bg' :'';
    
    		$title = workio_get_page_title();
    		echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb '.implode(' ', $classes).'"'.$estyle.'><div class="'.$full_width.'"><div class="wrapper-breads"><div class="wrapper-breads-inner">';
    			workio_breadcrumbs();
    
    			echo '<div class="breadscrumb-inner clearfix">';
    			if(!empty($title)){
    				echo '<h2 class="bread-title">'.$title.'</h2>';
    			}
    			echo '</div>';
    			
    
    		echo '</div></div></div></section>';
		} 

	}
}

if ( ! function_exists( 'workio_paging_nav' ) ) {
	function workio_paging_nav() {
		global $wp_query, $wp_rewrite;

		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="ti-angle-left"></i>',
			'next_text' => '<i class="ti-angle-right"></i>',
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text hidden"><?php esc_html_e( 'Posts navigation', 'workio' ); ?></h1>
			<div class="apus-pagination">
				<?php echo trim($links); ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}

if ( !function_exists('workio_comment_form') ) {
	function workio_comment_form($arg, $class = 'btn-theme ') {
		global $post;
		if ('open' == $post->comment_status) {
			ob_start();
	      	comment_form($arg);
	      	$form = ob_get_clean();
	      	?>
	      	<div class="commentform reset-button-default">
		    	<div class="clearfix">
			    	<?php
			      	echo str_replace('id="submit"','id="submit" class="btn '.$class.'"', $form);
			      	?>
		      	</div>
	      	</div>
	      	<?php
	      }
	}
}

if (!function_exists('workio_comment_item') ) {
	function workio_comment_item($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		ob_start();
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

			<div class="the-comment">
				<?php
					$avatar = get_avatar($comment, 70);
					if ( $avatar ) {
				?>
					<div class="avatar">
						<?php echo trim($avatar); ?>
					</div>
				<?php } ?>
				<div class="comment-box">
					<div class="comment-author flex-middle-sm">
						<div class="clearfix">
							<div class="name-comment"><?php echo get_comment_author_link() ?></div>
							<span class="entry-date"><?php printf(esc_html__('%1$s', 'workio'), get_comment_date()) ?></span>
						</div>
						<div class="ali-right">
						<?php edit_comment_link(esc_html__('Edit', 'workio'),'','') ?>
							<span class="reply">
								<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__(' Reply', 'workio'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
							</span>
						</div>
					</div>
					<div class="comment-text">
						<?php if ($comment->comment_approved == '0') : ?>
						<em><?php esc_html_e('Your comment is awaiting moderation.', 'workio') ?></em>
						<br />
						<?php endif; ?>
						<?php comment_text() ?>
					</div>
				</div>
			</div>
		</li>
		<?php
		$output = ob_get_clean();
		echo apply_filters('workio_comment_item', $output, $comment, $args, $depth);
	}
}

function workio_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'workio_comment_field_to_bottom' );


function workio_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'workio_pingback_header' );

function workio_create_placeholder($size) {
	return "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 ".$size[0]." ".$size[1]."'%2F%3E";
}

function workio_display_sidebar_left( $sidebar_configs ) {
	if ( isset($sidebar_configs['left']) ) : ?>
		<div class="sidebar-wrapper <?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
		  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		  		<div class="close-sidebar-btn hidden-lg hidden-md"> <i class="ti-close"></i> <span><?php esc_html_e('Close', 'workio'); ?></span></div>
		   		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
		   			<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
		   		<?php endif; ?>
		  	</aside>
		</div>
	<?php endif;
}

function workio_display_sidebar_right( $sidebar_configs ) {
	if ( isset($sidebar_configs['right']) ) : ?>
		<div class="sidebar-wrapper <?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
		  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		  		<div class="close-sidebar-btn hidden-lg hidden-md"><i class="ti-close"></i> <span><?php esc_html_e('Close', 'workio'); ?></span></div>
		   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
			   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
			   	<?php endif; ?>
		  	</aside>
		</div>
	<?php endif;
}

function workio_before_content( $sidebar_configs ) {
	if ( isset($sidebar_configs['left']) || isset($sidebar_configs['right']) ) : ?>
		<a href="javascript:void(0)" class="mobile-sidebar-btn mobile-sidebar-btn-default hidden-lg hidden-md <?php echo esc_attr( (isset($sidebar_configs['left']))?'mobile-left':'mobile-right' ); ?>"> <i class="fa fa-bars"></i><?php echo esc_html__('Show Sidebar','workio'); ?></a>
		<div class="mobile-sidebar-panel-overlay"></div>
	<?php endif;
}
