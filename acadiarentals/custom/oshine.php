<?php /* customizing of oshine */

function be_themes_fallback_nav_menu(){
    // empty function to stop display of "SET THE MAIN MANU"
	}

	/***************************************
				Add Body Class
	***************************************/
	if ( ! function_exists( 'be_themes_add_body_class' ) ) {
		function be_themes_add_body_class( $classes ) {
			global $post;
			global $be_themes_data;

			$post_id = be_get_page_id();
			if ( ( (is_singular( 'post' ) && is_single($post_id) ) || is_archive() ) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
				if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && $be_themes_data['single_blog_header_transparent'] ) {
					$header_transparent = $be_themes_data['single_blog_header_transparent'];
					$header_sticky = $be_themes_data['single_blog_header_sticky'];
				} else {
					$header_transparent = 0;
					$header_sticky = 0;
				}
			} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
				if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && $be_themes_data['single_shop_header_transparent'] ) {
					$header_transparent = $be_themes_data['single_shop_header_transparent'];
					$header_sticky = $be_themes_data['single_shop_header_sticky'];
				} else {
					$header_transparent = 0;
					$header_sticky = 0;
				}
			} else {
				$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
				$header_sticky = get_post_meta($post_id, 'be_themes_sticky_header', true);
			}
			if ( isset($be_themes_data['opt-header-type']) && ('top' == $be_themes_data['opt-header-type'] ) ){
				if($header_sticky == 'inherit' || empty($header_sticky)) {
					if(!empty($header_transparent) && isset($header_transparent) && ('none' != $header_transparent) )  {
						if( isset( $be_themes_data['sticky_header'] ) && 1 == $be_themes_data['sticky_header'] )  {
							$classes[] = 'transparent-sticky';
						}
					} else {
						if( isset( $be_themes_data['sticky_header'] ) && 1 == $be_themes_data['sticky_header'] )  {
							$classes[] = 'sticky-header';
						}
					}
				} else if($header_sticky == 'yes') {
					if(!empty($header_transparent) && isset($header_transparent) && ('none' != $header_transparent)) {
						$classes[] = 'transparent-sticky';
					} else {
						$classes[] = 'sticky-header';
					}
				}
			}
			if ( isset($be_themes_data['opt-header-type']) && ('top' == $be_themes_data['opt-header-type'] ) ){
				if($post_id == 0) {
					if( (isset( $be_themes_data['sticky_header'] ) && 1 == $be_themes_data['sticky_header'] ) ) {
						$classes[] = 'sticky-header';
					}
				}
			}
			if(!empty($header_transparent) && isset($header_transparent)) {
				if ('transparent' == $header_transparent){
					$classes[] = 'header-transparent';
				}
				if ('semitransparent' == $header_transparent){
					$classes[] = 'header-transparent';
					$classes[] = 'semi';
				}
			}
			$section_scroll = get_post_meta($post_id, 'be_themes_section_scroll', true);
			if(!empty($section_scroll) && isset($section_scroll) && $section_scroll) {
				$classes[] = 'section-scroll';
			} else {
				$classes[] = 'no-section-scroll';
			}
			$single_page_version = get_post_meta($post_id, 'be_themes_single_page_version', true);
			if(!empty($single_page_version) && isset($single_page_version) && $single_page_version) {
				$classes[] = 'single-page-version';
			}
			if ( isset($be_themes_data['opt-header-type']) && ('left' == $be_themes_data['opt-header-type'] ) ) {
				$classes[] = 'left-header';
				if ( isset($be_themes_data['left-header-style']) && ('strip' == $be_themes_data['left-header-style'] ) ) {
					$classes[] = 'left-sliding';
					$classes[] = 'left-bar-menu';
				}elseif ( isset($be_themes_data['left-header-style']) && ('overlay' == $be_themes_data['left-header-style'] ) ) {
					$classes[] = 'left-sliding';
					$classes[] = 'left-overlay-menu';
				}
				else{
					$classes[] = 'left-static';
				}
			}elseif ( isset($be_themes_data['opt-header-type']) && ('top' == $be_themes_data['opt-header-type'] ) ) {
					$classes[] = 'top-header';
				if ( isset($be_themes_data['top-menu-style']) && !empty($be_themes_data['top-menu-style']) ) {
					$classes[] = $be_themes_data['top-menu-style'];
				} else{
					$classes[] = 'top-right-sliding-menu';
				}
			}
			if ( is_singular( 'portfolio' ) || is_page_template( 'gallery.php' ) || is_page_template( 'portfolio.php' )) {
				$single_portfolio_style = get_post_meta(get_the_ID(), 'be_themes_portfolio_single_page_style', true);
				if ($single_portfolio_style == 'style1' || $single_portfolio_style == 'style2' || $single_portfolio_style == 'style3' || $single_portfolio_style == 'style4') {
					$classes[] = 'custom-gallery-page';
				}
			}
			if( isset( $be_themes_data['all_ajax'] ) && 1 == $be_themes_data['all_ajax'] && !(in_array( 'revslider/revslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) && !(in_array( 'masterslider/masterslider.php', apply_filters( 'active_plugins', get_option( 'active_plugins' )))) ) {
				$classes[] = 'all-ajax-content';
			}
			if(isset($be_themes_data['layout']) && !empty($be_themes_data['layout'])) {
				if('left' == $be_themes_data['opt-header-type'] && 'layout-box' == $be_themes_data['layout']){
					$classes[] = 'be-themes-layout-layout-wide'; //Overriding Box Layout setting for Left Header
				}else{
					$classes[] = 'be-themes-layout-'.$be_themes_data['layout'];
				}
			}
			if(isset($be_themes_data['rev_slider_bg_check']) && !empty($be_themes_data['rev_slider_bg_check']) && 1 == $be_themes_data['rev_slider_bg_check']) {
				$classes[] = 'disable_rev_slider_bg_check';
			}
			if(isset($be_themes_data['disable_css_animation_mobile']) && !empty($be_themes_data['disable_css_animation_mobile']) && 1 == $be_themes_data['disable_css_animation_mobile']) {
				$classes[] = 'disable-css-animation-mobile';
			}
			if(isset($be_themes_data['button_shape']) && !empty($be_themes_data['button_shape']) && $be_themes_data['button_shape'] != 'none' ) {
				$classes[] = 'button-shape-'.$be_themes_data['button_shape'];
			}
			if( !$be_themes_data['site_status'] ) {
				$classes[] = 'opt-panel-cache-off';
			}else{
				$classes[] = 'opt-panel-cache-on';
			}
			return $classes;
		}
		add_filter('body_class','be_themes_add_body_class');
	}

	if (!function_exists( 'be_themes_calculate_logo_height' )) {
		function be_themes_calculate_logo_height(){
			global $be_themes_data;
			$padding = ('' != $be_themes_data['opt-logo-padding']) ? 2*(str_replace('px', '', $be_themes_data['opt-logo-padding']) ) : 40;
			$result = array();
			$logo_height = $logo_sticky_height = $logo_transparent_height = 50;
			if((!isset($be_themes_data['disable_logo']) || empty($be_themes_data['disable_logo'])) || (isset($be_themes_data['disable_logo']) && (0 == $be_themes_data['disable_logo'])) ){
				$logo_src = (isset($be_themes_data['logo']['url']) && !empty($be_themes_data['logo']['url'])) ? $be_themes_data['logo']['url'] : get_template_directory_uri().'/img/logo.png';
				$logo_sticky_src = (isset($be_themes_data['logo_sticky']['url']) && !empty($be_themes_data['logo_sticky']['url'])) ? $be_themes_data['logo_sticky']['url'] : $logo_src;
				$logo_transparent_src = (isset($be_themes_data['logo_transparent']['url']) && !empty($be_themes_data['logo_transparent']['url'])) ? $be_themes_data['logo_transparent']['url'] : $logo_src;

				$logo_id = get_attachment_id_from_src($logo_src);
				$logo = wp_get_attachment_image_src($logo_id, 'full');
				$logo_sticky_id = get_attachment_id_from_src($logo_sticky_src);
				$logo_sticky = wp_get_attachment_image_src($logo_sticky_id, 'full');
				$logo_transparent_id = get_attachment_id_from_src($logo_transparent_src);
				$logo_transparent = wp_get_attachment_image_src($logo_transparent_id, 'full');

				if( isset( $logo[2] ) || !empty( $logo[2] ) ) {
				  $logo_height = $logo[2];
				}
				if( isset( $logo_sticky[2] ) || !empty( $logo_sticky[2] ) ) {
				  $logo_sticky_height = $logo_sticky[2];
				}
				if( isset( $logo_transparent[2] ) || !empty( $logo_transparent[2] ) ) {
				  $logo_transparent_height = $logo_transparent[2];
				}
			}else{
				$nav_text_height = $be_themes_data['navigation_text']['font-size'];
				$logo_height = $logo_sticky_height = $logo_transparent_height = $nav_text_height;
			}

			$result['logo_sticky_height'] = $padding + $logo_sticky_height;
			$result['logo_height'] = $padding + $logo_height;
			$result['logo_height_original'] = $logo_height;
			$result['logo_transparent_height'] = $padding + $logo_transparent_height;
			return $result;
		}
	}

	if (!function_exists( 'be_themes_calculate_logo_width' )) {
		function be_themes_calculate_logo_width(){
			global $be_themes_data;
			$result = array();
			$logo_src = (! empty($be_themes_data['logo']['url'])) ? $be_themes_data['logo']['url'] : get_template_directory_uri().'/img/logo.png';;
			//$logo_transparent_src = $be_themes_data['logo_transparent']['url'];
			if( array_key_exists( 'logo_transparent', $be_themes_data ) ) {
				$logo_transparent_src = $be_themes_data['logo_transparent']['url'];
			}
			if( empty( $logo_transparent_src ) ) {
				$logo_transparent_src = $logo_src;
			}
			$logo_id = get_attachment_id_from_src($logo_src);
			$logo_transparent_id = get_attachment_id_from_src($logo_transparent_src);
			$logo = wp_get_attachment_image_src($logo_id, 'full');
			$logo_transparent = wp_get_attachment_image_src($logo_transparent_id, 'full');
			$logo_width = $logo_transparent_width = 250;
			$logo_attachment_flag = 0;
			if( isset( $logo[1] ) || !empty( $logo[1] ) ) {
			  $logo_width = $logo[1];
			  $logo_attachment_flag = 1;
			}
			if( isset( $logo_transparent[1] ) || !empty( $logo_transparent[1] ) ) {
			  $logo_transparent_width = $logo_transparent[1];
			}
			$result['logo_attachment_flag'] = $logo_attachment_flag;
			$result['logo_width'] = $logo_width;
			$result['logo_transparent_width'] = $logo_transparent_width;
			return $result;
		}
	}

	/***************************************
					SITE LOGO
	***************************************/
	if ( !function_exists( 'be_themes_get_header_logo_image' ) ) {
		function be_themes_get_header_logo_image() {
			global $be_themes_data;
			$logo_alt_text = esc_attr(get_bloginfo('name'));
			$logo = get_template_directory_uri().'/img/logo.png';
			if( ! empty( $be_themes_data['logo']['url'] ) ) {
				$logo = be_themes_protocol_based_urls( $be_themes_data['logo']['url'] );
			}
			if( ! empty( $be_themes_data['logo_sticky']['url'] ) ) {
				$logo_sticky = be_themes_protocol_based_urls( $be_themes_data['logo_sticky']['url'] );
			} else {
				$logo_sticky = $logo;
			}
			if( ! empty( $be_themes_data['logo_transparent']['url'] )) {
				$logo_transparent = be_themes_protocol_based_urls( $be_themes_data['logo_transparent']['url'] );
			} else {
				$logo_transparent = $logo;
			}
			if( ! empty( $be_themes_data['logo_transparent_light']['url'] )) {
				$logo_transparent_light = be_themes_protocol_based_urls( $be_themes_data['logo_transparent_light']['url'] );
			} else {
				$logo_transparent_light = $logo_transparent;
			}
			echo '<a href="'.home_url().'">';
				$post_id = be_get_page_id();
				if ( ( (is_singular( 'post' ) && is_single($post_id)) || is_archive() ) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
					$header_transparent = $be_themes_data['single_blog_header_transparent'];
				} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
					$header_transparent = $be_themes_data['single_shop_header_transparent'];
				} else {
					$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
				}
				if(!empty($header_transparent) && isset($header_transparent) && ('none' != $header_transparent)) {
					echo '<img class="transparent-logo dark-scheme-logo" src="'.apply_filters('be_themes_dark_scheme_logo', $logo_transparent ).'" alt="'.$logo_alt_text.'" />';
					echo '<img class="transparent-logo light-scheme-logo" src="'.apply_filters('be_themes_light_scheme_logo', $logo_transparent_light ).'" alt="'.$logo_alt_text.'" />';
					echo '<img class="normal-logo" src="'.apply_filters('be_themes_normal_logo', $logo ).'" alt="'.$logo_alt_text.'" />';
					echo '<img class="sticky-logo" src="'.apply_filters('be_themes_sticky_logo', $logo_sticky ).'" alt="'.$logo_alt_text.'" />';
				} else {
					echo '<img class="normal-logo" src="'.apply_filters('be_themes_normal_logo', $logo ).'" alt="'.$logo_alt_text.'" />';
					echo '<img class="sticky-logo" src="'.apply_filters('be_themes_sticky_logo', $logo_sticky ).'" alt="'.$logo_alt_text.'" />';
				}
			echo '</a>';
		}
	}

	/***************************************
				Navigations
	***************************************/
	// MAIN NAVIGATION
	if ( ! function_exists( 'be_themes_get_header_navigation' ) ) {
		function be_themes_get_header_navigation() {
			$be_themes_enable_main_nav = apply_filters('be_themes_enable_main_nav', true );
			if( $be_themes_enable_main_nav ) {
				global $be_themes_data;
				$nav_link_style = (isset($be_themes_data['nav_link_style']) && !empty($be_themes_data['nav_link_style'])) ? $be_themes_data['nav_link_style'] : '';
				$menu_class = 'clearfix ' . $nav_link_style ;
				$defaults = array (
					'theme_location'=>'main_nav',
					'depth'=>3,
					'container_class'=>'menu',
					'menu_id' => 'menu',
					'menu_class' => $menu_class,
					'echo' => true,
					'fallback_cb' => 'be_themes_fallback_nav_menu',
					'walker' => new Be_Themes_Walker_Nav_Menu()
				);
				wp_nav_menu( $defaults );
			}
		}
	}
