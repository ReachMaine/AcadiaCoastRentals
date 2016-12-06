<?php

//add_action( 'after_setup_theme', 'be_themes_child_theme_setup' );
//function be_themes_child_theme_setup() {
    load_child_theme_textdomain( 'be-themes', get_stylesheet_directory() . '/languages' );
//}



  require_once(get_stylesheet_directory().'/custom/branding.php');
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
  }
  add_action( 'widgets_init', 'reach_widgets_init' );

?>
