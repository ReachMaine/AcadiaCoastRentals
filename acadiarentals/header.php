<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!-->
<?php /*
	1Nov16 - zig add gtm function after opening body tag
*/ ?>
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
	<?php
	global $be_themes_data; // Get Backend Options
		if(isset($be_themes_data['favicon']['url']) && !empty($be_themes_data['favicon']['url']) && $be_themes_data['favicon']['url']) {
			echo '<link rel="icon" type="image/png" href="'.$be_themes_data['favicon']['url'].'">';
		}
	?>

    <?php
    	if ( is_singular() ) {
    		wp_enqueue_script( 'comment-reply' );
    	}
    	wp_head();
    ?>
</head>
<?php
	$sidebar_class = 'sb-right';
	if ( isset($be_themes_data['opt-header-type']) && ('left' == $be_themes_data['opt-header-type'] ) ) {
		$sidebar_class = 'sb-left';
	}
	$show_sidebar = 0;
	$header_right_widgets = isset($be_themes_data['opt-header-pos']['right']) ? $be_themes_data['opt-header-pos']['right'] :  array() ;
	if (isset($be_themes_data['opt-header-type'])){
		if ('left' == $be_themes_data['opt-header-type'] ) {
			$show_sidebar = 1;
		}else if ('top' == $be_themes_data['opt-header-type'] ) {
			if( array_key_exists('smenu',$header_right_widgets) || ('top-overlay-menu' == ($be_themes_data['top-menu-style'])) ){
				$show_sidebar = 1;
			}
		}
	}
	$strip_flag = (('strip' == $be_themes_data['left-header-style'] ) || ('overlay' == $be_themes_data['left-header-style'] )) ? 'on' : 'off' ;
	$strip_menu_class = isset($be_themes_data['left-header-style']) && !empty($be_themes_data['left-header-style']) ? $be_themes_data['left-header-style'] : '' ;
	$left_strip_animation = isset($be_themes_data['left-strip-animation']) && !empty($be_themes_data['left-strip-animation']) ? $be_themes_data['left-strip-animation'] : 'menu_push_main' ;
?>
<body <?php body_class(); ?> data-be-site-layout='<?php echo $be_themes_data['layout']; ?>' data-be-page-template = '<?php echo basename(get_page_template(),".php"); ?>'>
	<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
	<?php if ( $show_sidebar == 1 ) {?>
		<div class="sb-slidebar <?php echo $sidebar_class; ?>">
			<i class="overlay-menu-close font-icon icon-icon_close"></i>
			<div class="display-table">
				<div id="sb-slidebar-content" class="sb-slidebar-content ajaxable">
					<?php
					if((!isset($be_themes_data['disable_logo']) || empty($be_themes_data['disable_logo'])) || (isset($be_themes_data['disable_logo']) && (0 == $be_themes_data['disable_logo'])) ){
						if( ! empty( $be_themes_data['logo_sidebar']['url'] )) {
							$logo_sidebar = $be_themes_data['logo_sidebar']['url'];
						}else{
							if( array_key_exists('logo', $be_themes_data) && ! empty( $be_themes_data['logo']['url'] ) ) {
								$logo_sidebar = $be_themes_data['logo']['url'];
							}
							else {
								$logo_sidebar = get_template_directory_uri().'/img/logo.png';
							}
						}
					}
						echo '<div id="logo-sidebar"><a href="'.home_url().'"><img class="transparent-logo dark-scheme-logo" src="'.$logo_sidebar.'" alt="'.esc_attr(get_bloginfo('name')).'" /></a></div>';
						be_themes_get_header_sidebar_navigation();
						if (is_active_sidebar( 'sliderbar-area' ) ) {
							dynamic_sidebar( 'sliderbar-area' );
						}
					?>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php
	$widget_style = (isset($be_themes_data['seach_widget_style']) && !empty($be_themes_data['seach_widget_style'])) ? $be_themes_data['seach_widget_style'] : 'style1-header-search-widget';
	if($widget_style == 'style2-header-search-widget') {
		be_themes_get_header_search_form_widget( false, true);
	}
	if ( ('left' == $be_themes_data['opt-header-type'] ) && isset($be_themes_data['left-header-style']) && ('on' == $strip_flag)) {?>
	<div class="left-strip-wrapper">
		<div id="sb-left-strip" class="leftside-menu-controller ajaxable <?php echo $strip_menu_class.' '; echo $left_strip_animation; ?>">
		<?php
			if ( ! empty( $be_themes_data['left-strip-logo']['url'])){
				$logo_strip = $be_themes_data['left-strip-logo']['url'];
				// echo '<div id="logo-strip-bar"><a href="'.home_url().'"><img class="" src="'.$logo_strip.'" alt="" /></a></div>';
				echo '<div id="logo-strip-bar"><img class="" src="'.$logo_strip.'" alt="" /></div>';
			}
			be_themes_get_left_header_woocommerce_cart_widget();?>
			<i class="font-icon icon-icon_menu leftside-menu-controller"></i>

		</div>
	</div><?php
	}?>

	<div id="main-wrapper">
		<?php
			if($be_themes_data['layout'] == 'layout-border-header-top') {
				$layout = 'layout-border layout-border-header-top';
			} else {
				$layout = $be_themes_data['layout'];
			}
		?>
		<div id="main" class="ajaxable <?php echo $layout; ?>" >
			<?php
				$post_id = be_get_page_id();
				if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
					if(!empty($be_themes_data['single_blog_hero_section_position']) && isset($be_themes_data['single_blog_hero_section_position']) && $be_themes_data['single_blog_hero_section_position'] ) {
						$top_section_position = $be_themes_data['single_blog_hero_section_position'];
					} else {
						$top_section_position = 'after';
					}
					if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && $be_themes_data['single_blog_header_transparent'] ) {
						$header_transparent = $be_themes_data['single_blog_header_transparent'];
					} else {
						$header_transparent = 0;
					}
				} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
					if(!empty($be_themes_data['single_shop_hero_section_position']) && isset($be_themes_data['single_shop_hero_section_position']) && $be_themes_data['single_shop_hero_section_position'] ) {
						$top_section_position = $be_themes_data['single_shop_hero_section_position'];
					} else {
						$top_section_position = 'after';
					}
					if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && $be_themes_data['single_shop_header_transparent'] ) {
						$header_transparent = $be_themes_data['single_shop_header_transparent'];
					} else {
						$header_transparent = 0;
					}
				} else {
					$top_section_position = get_post_meta($post_id, 'be_themes_hero_section_position', true);
					$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
				}
				if($top_section_position == 'before' && !(!empty($header_transparent) && isset($header_transparent) && $header_transparent && $header_transparent != 'none')) {
					get_template_part( 'headers/top', 'section' );
				}
				get_template_part( 'headers/content', 'header' );
				if($top_section_position != 'before' || (!empty($header_transparent) && isset($header_transparent) && $header_transparent && $header_transparent != 'none')) {
					get_template_part( 'headers/top', 'section' );
				}
			?>
