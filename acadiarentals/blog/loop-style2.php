<?php /*  Mods
8Dec16 zig - remove post bottom tags
13Dec16 zig - remove social share (put into content)
17Deec17 zig - use h1 tag for single posts
14Aug19 zig - follow category
*/

$page_id = be_get_page_id();
global $blog_attr;
global $more_text;
$post_classes = get_post_class();
$post_classes = implode( ' ', $post_classes );
if($blog_attr['style'] == 'style3') {
	$post_classes .= ' element not-wide';
	$article_gutter = 'style="margin-bottom: '.esc_attr( $blog_attr['gutter_width'] ).'px !important;"';
} else {
	$article_gutter = '';
}
$post_format = get_post_format();
?>
<article id="post-<?php the_ID(); ?>" class="element not-wide blog-post clearfix <?php echo esc_attr( $post_classes ); ?>" <?php echo $article_gutter; ?>>
	<div class="element-inner" style="<?php echo ($blog_attr['style'] == 'style3') ? 'margin-left:'.$blog_attr['gutter_width'].'px' : ''; ?>">
		<div class="post-content-wrap">
			<?php
				if( $post_format != 'quote' && $post_format != 'link' ) {
					get_template_part( 'content', $post_format );
				}
			?>
			<div class="article-details clearfix">
				<header class="post-header clearfix">
					<?php
						if( $post_format == 'quote' || $post_format == 'link' ) :
							echo '<div class="post-top-details clearfix">';
								get_template_part( 'blog/post', 'top-details' );
							echo '</div>';
							get_template_part( 'content', $post_format );
						else :
							if ( is_single() ) { /* zig use h1 for single posts */
								echo '<h1 class="post-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h5>';
							} else {
								echo '<h5 class="post-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h5>';
							}
							$subtitle = get_post_meta(get_the_ID(),"property_options_subtitle", true);
					    if ($subtitle) {
					      echo '<h6 class="acr-subtitle">'.$subtitle."</h6>";
					    }
							// display all category
							$categories = get_the_category();
							$cat_ids = array();
 							if ( ! empty( $categories ) ) {
							    echo '<div class="acr-prop-category">';
									foreach( $categories as $category ) {
									    echo $category->name.'<br />';
											$cat_ids[] = $category->id;
									}
									echo '</div>';
							}
						endif;
					?>
				</header>
				<?php if( $post_format != 'quote' && $post_format != 'link' ): ?>
					<div class="post-top-details clearfix"><?php get_template_part( 'blog/post', 'top-details' ); ?></div>
					<div class="post-details clearfix">
						<div class="post-content clearfix">
							<?php
								if( !is_search() ) {
									global $be_themes_data;
									$be_pb_disabled = get_post_meta( get_the_ID(), '_be_pb_disable', true );

									if ( isset($be_themes_data['enable_pb_blog_posts']) && 1 == $be_themes_data['enable_pb_blog_posts'] && 'yes' != $be_pb_disabled && !is_single() ) {
										// the_excerpt();
										if ( post_password_required() ) {
					       	 				$content  = get_the_password_form();

					       	 			    echo '<div class="be-wrap clearfix be-section-pad">'.$content.'</div>';
					       	 			} else {
											the_excerpt();
										}
									} else {
										// the_content( __('Read More','be-themes') );
										if ( post_password_required() ) {
					       	 				$content  = get_the_password_form();

					       	 			    echo '<div class="be-wrap clearfix be-section-pad">'.$content.'</div>';
					       	 			} else {
											the_content( __('Read More','be-themes') );
										}
									}
								}
								if( is_single() ):
									$args = array (
										'before'           => '<div class="pages_list margin-40">',
										'after'            => '</div>',
										'link_before'      => '',
										'link_after'       => '',
										'next_or_number'   => 'next',
										'nextpagelink'     => __('Next >','be-themes'),
										'previouspagelink' => __('< Prev','be-themes'),
										'pagelink'         => '%',
										'echo'             => 1
									);
									wp_link_pages( $args );
								endif;
							?>
						</div>
					</div>
				<?php endif; ?>
				<div class="post-bottom-details clearfix"><?php get_template_part( 'blog/post', 'bottom-details' ); ?></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>


	<?php if(is_single()) { ?>
		<?php /* <div class="clearfix single-post-share single-page-atts">
			<div class="clearfix single-page-att">
				<h6><?php echo __('Share This : ','be-themes'); ?></h6> <div class="share-links clearfix"><?php echo be_get_share_button(get_the_permalink(), get_the_title(), get_the_ID() ); ?></div>
			</div> */ ?>
		<?php /* 	<div class="clearfix single-post-tags single-page-att">
				<h6><?php echo __('Tags : ','be-themes'); ?></h6> <?php echo get_the_tag_list('<div class="tagcloud">','','</div>'); ?>
			</div> */ ?>
		</div>
	<?php } ?>
	<?php /* <div class="blog-separator clearfix"><hr class="separator"></div> */ ?>
</article>
<?php /* adding naviation */ ?>
<?php if (is_single()) { ?>
<div id="cooler-nav" class="navigation">
	<?php
		$cat_to_follow = "";
		$cat_to_followid = "";
		if (count($categories) == 1) { // only one category, no question....
			$cat_to_follow = $categories[0]->slug;
			$cat_to_followid = $categories[0]->id;
			$exclude_catids = array();
		} else { // need figure out the category we need to follow....
				$cat_referer = wp_get_referer();
				switch ($cat_referer) {
					case site_url().'/acadia-coastal-rentals-region/':
							$cat_to_follow = 'acadia';
							break;
					case site_url().'/downeast-maine-rentals/':
							$cat_to_follow = 'downeast';
							break;
					case site_url().'/coastal-maine-vacation-rentals/':
							$cat_to_follow = 'beaches-portland';
							break;
					case site_url().'/lakes-and-mountains-region-rentals/':
							$cat_to_follow = 'lakes-and-mountains';
							break;
					case site_url().'/maine-highlands-and-katahdin-rentals/':
							$cat_to_follow = 'maine-higlands';
							break;
				}
				if ($cat_to_follow == "") {
					// check url paramater
					if (isset($_GET['area'])) {

					  $cat_to_follow = $_GET['area'];
						}
				}
				if ($cat_to_follow == "") { // try for SEO primary category
					$primary_seo_catid = get_post_meta(get_the_ID(),"_yoast_wpseo_primary_category", true);
					if ($primary_seo_catid) {

						$primary_cat = get_category($primary_seo_catid);
						$cat_to_follow = $primary_cat->slug;
					}
				}


				if ($cat_to_follow != "") { // we have a cat to follow, exlude others
					foreach( $categories as $category ) {
							if ($category->slug != $cat_to_follow) {
								$exclude_catids[] = $category->term_id;
							}
					}
				}
		} // end checking for cat to follow
		//echo "categories: <hr><pre>"; var_dump($categories); echo "</pre>";
		//echo '<p>category to follow is: {'.$cat_to_follow.'}</p>';
		//echo "exluded ids:<hr><pre>"; var_dump($exclude_catids); echo "</pre>";
		/* zig - next & previous are backwards up due to ascending/descending */
		$urlparm = "";
		if ($cat_to_follow != "") {
			$urlparm = "?area=".$cat_to_follow;
		}
		$prevPost = get_previous_post(true, $exclude_catids);
		//echo "<!--<p>prev is: ".$prevPost->ID."</p>-->";
		if ($prevPost) { ?>
			<div class="nav-box previous">
				<?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(100,100) );
 					// build the linke
					echo '<a href="'.get_permalink($prevPost).$urlparm.'">';
					echo 		$prevthumbnail.'<h6>'.get_the_title($prevPost).'</h6><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>';
					echo '</a>';
				?>
			</div>

		<?php } ?>

		<?php
		//echo "<!-- <p>next is: ".$nextPost->ID."</p> -->";
		$nextPost = get_next_post(true, $exclude_catids);
		if ($nextPost) {  ?>
				<div class="nav-box next" style="float:right;">
					<?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(100,100) );
							echo '<a href="'.get_permalink($nextPost).$urlparm.'">';
							echo 		$nextthumbnail.'<h6>'.get_the_title($nextPost).'</h6><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>';
							echo '</a>';
					?>
				</div>
		<?php  }  ?>
	</div><!--#cooler-nav div -->
	<?php } ?>
