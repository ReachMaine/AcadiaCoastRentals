<?php  /* Mods
8Dec16 zig - dont show featured image on single post
*/
global $be_themes_data, $blog_attr;
if( has_post_thumbnail()  ) :
	$blog_image_size = 'blog-image';
    if( $blog_attr['style'] == 'style3' ) {
    	$blog_image_size = 'portfolio-masonry';
    }
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $blog_image_size );
    $thumb_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	$url = $thumb['0'];
	$attachment_full_url = $thumb_full[0];
	$link = $attachment_full_url;
endif;
$class = '';
if((isset($be_themes_data['open_to_lightbox']) && 1 == $be_themes_data['open_to_lightbox']) ) { //|| is_single()
	$class = 'image-popup-vertical-fit mfp-image';
} else {
	if(!is_single()){
		$link = get_permalink();
	}else{
		$link = '#';
	}
}
if( !empty( $url ) && !is_single() ) : ?>
<div class="post-thumb">
	<div class="">
		<a href="<?php echo esc_url( $link ) ?>" class="<?php echo $class; ?> thumb-wrap">
			<?php the_post_thumbnail( $blog_image_size ); ?>
			<div class="thumb-overlay">
				<div class="thumb-bg">
					<div class="thumb-title fadeIn animated">
						<i class="portfolio-ovelay-icon"></i>
					</div>
				</div>
			</div>
		</a>
	</div>
</div>
<?php

	$contact_email = get_post_meta( get_the_ID(), 'property_contact_email', true);
	$contact_phone = get_post_meta( get_the_ID(), 'property_contact_phone', true);
	if ( ($contact_email) || ($contact_phone) ) {
		echo '<div class="reach-contact-details">';
	}
	if ($contact_email) {
		$email_display = "Email Owner";
		$email_cc = "abitofmaine@gmail.com";
		$email_subject = rawurlencode(get_the_title());
		echo '<div class="reach-contact-email hide-tablet"><a target="_blank" href="mailto:'.$contact_email.'?cc='.$email_cc.'&subject='.$email_subject.'">'.$email_display.'</a></div>';
	}
	if ($contact_phone) {
		$phone_link = preg_replace('/\D+/', '', $contact_phone);
		echo '<div class="reach-contact-phone hide-tablet"><a target="_blank" href="tel:'.$phone_link.'">'.$contact_phone.'</a></div>';
	}
	if ( ($contact_email) || ($contact_phone) ) {
		echo '</div>';
	}
endif; ?>
