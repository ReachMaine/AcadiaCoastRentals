<?php

//add_action( 'after_setup_theme', 'be_themes_child_theme_setup' );
//function be_themes_child_theme_setup() {
    load_child_theme_textdomain( 'be-themes', get_stylesheet_directory() . '/languages' );
//}
require_once(get_stylesheet_directory().'/custom/branding.php');
require_once(get_stylesheet_directory().'/custom/property_metabox.php');
require_once(get_stylesheet_directory().'/custom/shortcodes.php');
require_once(get_stylesheet_directory().'/custom/oshine.php');
//enqueues our external font awesome stylesheet
function enqueue_our_required_stylesheets(){
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');


  function reach_widgets_init() {
    register_sidebar(
      array(
           'name' => __( 'Bottom Call to Action ', 'be-themes' ),
           'id'   => 'reach-bottom-cta',
           'description'   => __( 'Widget area (above footer)', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">',
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
      )
    );

    register_sidebar(
      array(
           'name' => __( 'Under Content ', 'be-themes' ),
           'id'   => 'reach-under-content',
           'description'   => __( 'Widget area under content area', 'be-themes' ),
           'before_widget' => '<div class="%2$s widget">',
           'after_widget'  => '</div>',
           'before_title'  => '<h6>',
           'after_title'   => '</h6>',
      )
    );
  }
  add_action( 'widgets_init', 'reach_widgets_init' );


/* not using filter any more
add_filter ('the_title', 'reach_subtitle_to_post', 10, 2);
function reach_subtitle_to_post($title, $id) {
  global $post;
  if ( ($post->post_type == 'post')  && (!is_admin()) ) {
    $subtitle = get_post_meta($id,"property_options_subtitle", true);
    if ($subtitle) {
      $title = $title.'<br><span class="acr-subtitle zig">'.$subtitle."</span>";
    }

  }
  return $title;
} */
?>
