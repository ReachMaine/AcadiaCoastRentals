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
    $contact_email = get_post_meta( get_the_ID(), 'property_contact_email', true);
    if ($contact_email) {
      $email_cc = "abitofmaine@gmail.com";
      $email_subject = rawurlencode(get_the_title());
      echo '<div class="reach-contact-email hide-tablet"><a target="_blank" href="mailto:'.$contact_email.'?cc='.$email_cc.'&subject='.$email_subject.'">'.$contact_email.'</a></div>';
    }
    $contact_phone = get_post_meta( get_the_ID(), 'property_contact_phone', true);
    if ($contact_phone) {
      $phone_link = preg_replace('/\D+/', '', $contact_phone);
      echo '<div class="reach-contact-phone hide-tablet"><a target="_blank" href="tel:'.$phone_link.'">'.$contact_phone.'</a></div>';
    } else {
      //echo 'no phone.';
    }
  }
?>
<?php /* <nav class="post-nav meta-font secondary_text">
	<ul class="clearfix">
		<li class="post-meta post-category"><?php _e('Under :','be-themes'); ?><?php be_themes_category_list($id); ?></li>
	</ul>
</nav> */ ?>
