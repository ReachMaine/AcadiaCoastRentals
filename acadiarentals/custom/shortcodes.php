<?php /*  */

if ( ! function_exists( 'reach_recent_posts' ) ) {
	function reach_recent_posts( $atts, $content ) {
		extract( shortcode_atts( array (
			'number'=>'four',
			'hide_excerpt' => '',
			'category' => '',
	    ), $atts ) );
		if( $number == 'three' ) {
			$posts_per_page = 3;
			$column = 'third';
		} else {
			$posts_per_page = 4;
			$column = 'fourth';
		}
		$post_per_page = 20;
		$hide_excerpt = (isset($hide_excerpt) && ($hide_excerpt)) ? 'hide-excerpt' : '' ;
		$args=array (
			'post_type' => 'post',
			//'posts_per_page'=> $posts_per_page,
			'orderby'=>'date',
			'ignore_sticky_posts'=>1,
			/* 'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-quote' ),
					'operator' => 'NOT IN',
				)
			), */
		);
		if ($category) {
			$args['category_name'] = $category;
		}
		$output = '';
		global $meta_sep, $blog_attr;
		$my_query = new WP_Query( $args  );
		if( $my_query->have_posts() ) {
			$output .= '<div class="clearfix related-items style3-blog reach-blog'.$hide_excerpt.'">';
			$blog_attr['style'] = 'shortcodes';
			$blog_attr['gutter_width'] = 0;
			while ( $my_query->have_posts() ) : $my_query->the_post();
				$output .= '<div class="one-'.$column.' column-block be-hoverlay">';
				ob_start();
				get_template_part( 'blog/loop', $blog_attr['style'] );
				$post_format_content = ob_get_clean();
				$output .= $post_format_content;
				$output .= '</div>'; // end column block
			endwhile;
			$output .= '</div>';
		}
		wp_reset_query();
		return $output;
	}
	add_shortcode( 'reach_recent_posts', 'reach_recent_posts' );
}

if ( ! function_exists( 'reach_share_buttons' ) ) {
	function reach_share_buttons( $atts, $content ) {
		$html_ret = "";
		$html_ret .= '<div class="reach-share-wrap">';
		$html_ret .= 	'<h6>';
		$html_ret .= 	  __('Share : ','be-themes');
		$html_ret .= 	'</h6>';
		$html_ret .=   '<div class="share-links clearfix reach-share">';
		$html_ret .= 	  be_get_share_button(get_the_permalink(), get_the_title(), get_the_ID() );
		$html_ret .=   '</div>';
		$html_ret .= '</div>';
		return $html_ret;
	}
	add_shortcode('reach_share_buttons', 'reach_share_buttons');
}

if ( ! function_exists( 'reach_property_options' ) ) {
	function reach_property_options( $atts, $content ) {
		$pet_friendly = get_post_meta( get_the_ID(), 'property_options_pet_friendly', true);
		if($pet_friendly) {
				$html_ret .= '<div class="reach-post-props">';
				$html_ret .= '<i class="fa fa-paw" aria-hidden="true"></i> Pet Friendly';
				$html_ret .= '</div>';
		}
		return $html_ret;
	}
	add_shortcode('reach_property_options', 'reach_property_options');
}
