<?php
/* custom functions for booking calendar */
add_filter('wpsbc_calendar_overview_output_calendar_name', 'wpsbc_custom_calendar_titles', 10, 4);
function wpsbc_custom_calendar_titles($calendar_name, $calendar_id, $calendar_post_id ){
 // get featured image
 if($calendar_post_id){
 $image = wp_get_attachment_image_src( get_post_thumbnail_id($calendar_post_id),array( 60, 60 ) );
 return '<div class="custom-tooltip"><img src="'.$image[0].'" /></div>'.$calendar_name;
    }
 // if there is no featured image, we just return the calendar name
 return $calendar_name;
}
