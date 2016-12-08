<?php /*  Mods
8Dec16 zig - remove post bottom tags
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
							echo '<h5 class="post-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></h5>';
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
		<div class="clearfix single-post-share single-page-atts">
			<div class="clearfix single-page-att">
				<h6><?php echo __('Share This : ','be-themes'); ?></h6> <div class="share-links clearfix"><?php echo be_get_share_button(get_the_permalink(), get_the_title(), get_the_ID() ); ?></div>
			</div>
		<?php /* 	<div class="clearfix single-post-tags single-page-att">
				<h6><?php echo __('Tags : ','be-themes'); ?></h6> <?php echo get_the_tag_list('<div class="tagcloud">','','</div>'); ?>
			</div> */ ?>
		</div>
	<?php } ?>
	<div class="blog-separator clearfix"><hr class="separator"></div>
</article>
