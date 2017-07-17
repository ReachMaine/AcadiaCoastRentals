<?php global $meta_sep; ?>
<?php /* mods
8Dec16 zig - dont show categories
*/ ?>
<?php /* on shortcode a/o archive */
  if ( !is_single() ) {
    $pet_friendly = get_post_meta( get_the_ID(), 'property_options_pet_friendly', true);
    if($pet_friendly) {
      echo '<div class="reach-post-props"><i class="fa fa-paw" aria-hidden="true"></i></div>';
    }

  }
?>
<?php /* <nav class="post-nav meta-font secondary_text">
	<ul class="clearfix">
		<li class="post-meta post-category"><?php _e('Under :','be-themes'); ?><?php be_themes_category_list($id); ?></li>
	</ul>
</nav> */ ?>
