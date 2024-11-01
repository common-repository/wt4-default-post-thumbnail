<?php
/*
 Plugin Name: WT4 Default Post Thumbnail
 Plugin URI: 
 Description: Default Post Thumbnail
 Version: 1.0.
 Author: Gareth Gillman
 Author URI: http://www.garethgillman.co.uk
 Text Domain: wt4-dpt
*/

// customizer image upload

function wt4_dpt_customizer( $wp_customize ) {
 $wp_customize->add_setting(
  'wt4_dtp_thumb_upload',
  array(
   'sanitize_callback' => 'esc_url_raw',
  )
 );
 $wp_customize->add_control(
  new WP_Customize_Image_Control(
   $wp_customize,
   'wt4_dtp_thumb_upload',
   array(
    'label' => 'Post Thumbnail Upload',
    'section' => 'title_tagline',
    'settings' => 'wt4_dtp_thumb_upload'
   )
  )
 );
}
add_action( 'customize_register', 'wt4_dpt_customizer' );

function wt4_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
  $wt4_dpt_thumb = get_theme_mod('wt4_dtp_thumb_upload');
  if( empty($html) && !empty($wt4_dpt_thumb) ) {
   return sprintf(
    '<img src="%s" height="%s" width="%s" />',
    $wt4_dpt_thumb,
    get_option( 'thumbnail_size_w' ),
    get_option( 'thumbnail_size_h' )
   );
  }
  return $html;
}
add_filter( 'post_thumbnail_html', 'wt4_post_thumbnail_html', 20, 5 );