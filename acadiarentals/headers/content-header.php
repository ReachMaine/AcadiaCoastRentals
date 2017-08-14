<?php /* Mons
* 6Jan16 zig - not useing main menu so dont need mobile menu
*/
global $be_themes_data;
$post_id = be_get_page_id();
if(is_singular( 'post' ) && is_single($post_id) && isset($be_themes_data['single_blog_hero_section_from']) && $be_themes_data['single_blog_hero_section_from'] == 'inherit_option_panel') {
	if(!empty($be_themes_data['single_blog_header_transparent']) && isset($be_themes_data['single_blog_header_transparent']) && 'none' != $be_themes_data['single_blog_header_transparent'] ) {
		$header_transparent = $be_themes_data['single_blog_header_transparent'];
	} else {
		$header_transparent = 0;
	}
	if(!empty($be_themes_data['single_blog_header_transparent_color_scheme']) && isset($be_themes_data['single_blog_header_transparent_color_scheme']) && 'none' != $be_themes_data['single_blog_header_transparent_color_scheme'] ) {
		$color_scheme = $be_themes_data['single_blog_header_transparent_color_scheme'];
	} else {
		$color_scheme = 'dark';
	}
	$hero_section = $be_themes_data['single_blog_hero_section'];
} else if((in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && is_product($post_id)) && isset($be_themes_data['single_shop_hero_section_from']) && $be_themes_data['single_shop_hero_section_from'] == 'inherit_option_panel') {
	if(!empty($be_themes_data['single_shop_header_transparent']) && isset($be_themes_data['single_shop_header_transparent']) && ('none' !=  $be_themes_data['single_shop_header_transparent']) ) {
		$header_transparent = $be_themes_data['single_shop_header_transparent'];
	} else {
		$header_transparent = 0;
	}
	if(!empty($be_themes_data['single_shop_header_transparent_color_scheme']) && isset($be_themes_data['single_shop_header_transparent_color_scheme']) && ('none' !=  $be_themes_data['single_shop_header_transparent_color_scheme']) ) {
		$color_scheme = $be_themes_data['single_shop_header_transparent_color_scheme'];
	} else {
		$color_scheme = 'dark';
	}
	$hero_section = $be_themes_data['single_shop_hero_section'];
} else {
	$header_transparent = get_post_meta($post_id, 'be_themes_header_transparent', true);
	$hero_section = get_post_meta($post_id, 'be_themes_hero_section', true);
	$color_scheme = get_post_meta($post_id, 'be_themes_header_transparent_color_scheme', true);
}
$header_class = $full_screen_header_scheme = '';

if(!empty($header_transparent) && isset($header_transparent) && 'none' != $header_transparent) {
	if($be_themes_data['layout'] == 'layout-border-header-top') {
		$header_class = 'no-transparent';
	} elseif ('transparent' == $header_transparent) {
		$header_class = 'transparent';
	} elseif ('semitransparent' == $header_transparent) {
		$header_class = 'semi-transparent';
	}
}
if((!empty($header_transparent) && isset($header_transparent) && 'none' != $header_transparent) && (!empty($hero_section) && isset($hero_section) && $hero_section != 'none')) {
	if(!empty($color_scheme) && isset($color_scheme) && $color_scheme) {
		if($color_scheme == 'dark') {
			$header_class .= ' background--light';
			$full_screen_header_scheme = 'data-headerscheme="background--light"';
		} elseif($color_scheme == 'light') {
			$header_class .= ' background--dark';
			$full_screen_header_scheme = 'data-headerscheme="background--dark"';
		}
	}
}

if ( isset($be_themes_data['opt-header-type']) && ('top' == $be_themes_data['opt-header-type'] ) ) {
	$header_style = basename($be_themes_data['opt-header-style'],'.png') ;
} else {
	$header_style = '';
}

if ( isset($be_themes_data['mobile_bg_controller']) && !empty($be_themes_data['mobile_bg_controller']) ){
	$header_class .= ' exclusive-mobile-bg';
}

?>

	<header id="header">
		<?php /* 14Aug17 zig - dont show topbar for singele site page template */
			if ( !is_page_template('page-singlesite.php') && isset($be_themes_data['opt-header-type']) && ('top' == $be_themes_data['opt-header-type'] ) ) {
				if(isset($be_themes_data['opt-noshow-topbar']) && $be_themes_data['opt-noshow-topbar'] == 1){
					if(count($be_themes_data['opt-topbar-widgets-pos']['left']) > 1 || count($be_themes_data['opt-topbar-widgets-pos']['right']) > 1 ) {?>
						<div id="header-top-bar">
							<div id="header-top-bar-wrap" class="<?php if(true == $be_themes_data['opt-header-wrap']){?> be-wrap<?php } ?> clearfix">
								<?php
								if(count($be_themes_data['opt-topbar-widgets-pos']['left']) > 1) {?>
									<div id="header-top-bar-left"><?php
											foreach ($be_themes_data['opt-topbar-widgets-pos']['left'] as $key => $value) {
												be_themes_get_topbar_widgets($key);
											}?>
									</div><?php
									}
								?>
								<?php
								if(count($be_themes_data['opt-topbar-widgets-pos']['right']) > 1) {?>
									<div id="header-top-bar-right"><?php
											foreach ($be_themes_data['opt-topbar-widgets-pos']['right'] as $key => $value) {
												be_themes_get_topbar_widgets($key);
											}?>
									</div><?php
									}
								?>
							</div>
						</div><?php
					}
				}
		}?>
		<?php if (!is_page_template('page-singlesite.php') ) { /* 14Aug17 zig - dont show logo or widgets */ ?>
		<div id="header-inner-wrap" class="<?php echo $header_class; echo ' '.$header_style; ?>" <?php echo ' '.$full_screen_header_scheme; ?>>
			<?php
				extract(be_themes_calculate_logo_height());
				if((!empty($header_transparent) && isset($header_transparent) && $header_transparent)) {
					$default_header_height = $logo_transparent_height;
				} else {
					$default_header_height = $logo_height;
				}
			?>
			<?php if ( isset($be_themes_data['opt-header-type']) && ('left' == $be_themes_data['opt-header-type'] ) ) {?>
				<div id = "left-header-mobile" class="clearfix"><?php
					if((!isset($be_themes_data['disable_logo']) || empty($be_themes_data['disable_logo'])) || (isset($be_themes_data['disable_logo']) && (0 == $be_themes_data['disable_logo'])) ){
					?>
					<div class="logo">
						<?php be_themes_get_header_logo_image(); ?>
					</div>
					<?php
					}?>
					<div class="mobile-nav-controller-wrap">
						<!-- <div class="menu-controls mobile-nav-controller" title="Mobile Menu Controller"><i class="font-icon icon-list2"></i></div> -->
						<div class="menu-controls mobile-nav-controller" title="Mobile Menu Controller"><span class="be-mobile-menu-icon"></span></div>
					</div>
					<?php
					be_themes_get_header_woocommerce_cart_widget();?>
				</div>
			<?php }
			if ( isset($be_themes_data['opt-header-type']) && ('top' == $be_themes_data['opt-header-type'] ) ) {?>
				<div id="header-wrap" class="<?php if($be_themes_data['opt-header-wrap']){?>be-wrap<?php } ?> clearfix" data-default-height="<?php echo $default_header_height; ?>" data-sticky-height="<?php echo $logo_sticky_height; ?>">
					<?php
						if (basename($be_themes_data['opt-header-style'],'.png') == 'style2' ) { ?>
							<div id="header-controls-left">
								<?php
									if($be_themes_data['opt-header-pos']['left']) {
										foreach ($be_themes_data['opt-header-pos']['left'] as $key => $value) {
											be_themes_get_header_widgets($key);
										}
									}
								?>
							</div><?php
						}
						if((!isset($be_themes_data['disable_logo']) || empty($be_themes_data['disable_logo'])) || (isset($be_themes_data['disable_logo']) && (0 == $be_themes_data['disable_logo'])) ){
						?>
						<div class="logo">
							<?php be_themes_get_header_logo_image(); ?>
						</div>
						<?php } ?>
						<div id="header-controls-right">
							<?php /* zig xout <div class="mobile-nav-controller-wrap">
								<!-- <div class="menu-controls mobile-nav-controller"><div class="font-icon custom-font-icon"><span class="menu-icon menu-icon-first"></span><span class="menu-icon menu-icon-second"></span><span class="menu-icon menu-icon-third"></span></div></div> -->
								<div class="menu-controls mobile-nav-controller" title="Mobile Menu Controller"><span class="be-mobile-menu-icon"></span></div>
							</div> */ ?>
							<?php
								if(isset($be_themes_data['top-menu-style']) && !empty($be_themes_data['top-menu-style']) && $be_themes_data['top-menu-style'] == 'menu-animate-fall') { ?>
									<div class="menu-controls menu-falling-animate-controller"><span class="be-mobile-menu-icon"></span></div>
								<?php }
								if($be_themes_data['opt-header-pos']['right']) {
									foreach ($be_themes_data['opt-header-pos']['right'] as $key => $value) {
										be_themes_get_header_widgets($key);
									}
								}
								// var_dump(array_key_exists("cart", $be_themes_data['opt-header-pos']['right']))		;
								if(isset($be_themes_data['top-menu-style']) && ('top-overlay-menu' == ($be_themes_data['top-menu-style'])) && !( array_key_exists("smenu", $be_themes_data['opt-header-pos']['right'])) ) {
									be_themes_get_header_widgets('smenu');
								}
							?>
						</div><?php
					if ((basename($be_themes_data['opt-header-style'], '.png') != 'style2' ) && (basename($be_themes_data['opt-header-style'], '.png') != 'style6' )){
						if (((basename($be_themes_data['opt-header-style'], '.png') != 'style2' ) && (basename($be_themes_data['opt-header-style'], '.png') != 'style6' )) || (isset($be_themes_data['top-menu-style']) && !empty($be_themes_data['top-menu-style']) && $be_themes_data['top-menu-style'] == 'menu-animate-fall')) {?>
						<!-- if (((basename($be_themes_data['opt-header-style'], '.png') != 'style2' ) && (basename($be_themes_data['opt-header-style'], '.png') != 'style4' ) && (basename($be_themes_data['opt-header-style'], '.png') != 'style6' ) && (basename($be_themes_data['opt-header-style'], '.png') != 'style5' )) || (isset($be_themes_data['top-menu-style']) && !empty($be_themes_data['top-menu-style']) && $be_themes_data['top-menu-style'] == 'menu-animate-fall')) {?> -->
							<nav id="navigation" class="clearfix">	<?php
								be_themes_get_header_navigation();?>
							</nav><!-- End Navigation --><?php
						}
					}
					if(basename($be_themes_data['opt-header-style'], '.png') == 'style6' ) {
						echo '<nav id="navigation-left-side" class="clearfix">';
							be_themes_get_header_left_navigation();
						echo '</nav>';
						echo '<nav id="navigation-right-side" class="clearfix">';
							be_themes_get_header_right_navigation();
						echo '</nav>';
					} ?>
				</div>

				<?php
				if ( isset($be_themes_data['opt-header-type']) && ($be_themes_data['opt-header-border-color']['border-style'] != 'none') && ('top' == $be_themes_data['opt-header-type'] ) ) { ?>
					<span class="header-border <?php echo (($be_themes_data['opt-header-border-wrap']) ? 'be-wrap ' : '' );?>"></span><?php
				}?>
				<?php
				if((basename($be_themes_data['opt-header-style'],'.png') == 'style2' ) ) { // || (basename($be_themes_data['opt-header-style'],'.png') == 'style4' )) {
					?>
					<div id="header-bottom-bar">
						<div id="header-bottom-bar-wrap" class="<?php if($be_themes_data['opt-header-wrap']){?>be-wrap<?php } ?> clearfix">
							<nav id="navigation" class="clearfix">	<?php
							be_themes_get_header_navigation();?>
							</nav><!-- End Navigation -->
						</div>
					</div><?php
				}?>
			<?php }?>
			<div class="clearfix"><?php
				be_themes_get_header_mobile_navigation();?>
			</div>
		</div> <!-- inner-header-wrap -->
	<?php } ?>
	</header> <!-- END HEADER -->
