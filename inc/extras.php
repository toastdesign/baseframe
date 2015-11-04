<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Toasttheme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function toasttheme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'toasttheme_body_classes' );

/* ==========================================================================
BFI Function
<img src="<?php echo toast_img('full', 300, 400);?>" />
style="background-image:url('<?php echo toast_img('full', 300, 400); ?>');"
========================================================================== */

function toast_img( $thumb_size, $image_width, $image_height ) {
 
  global $post;
 
  $params = array( 'width' => $image_width, 'height' => $image_height );
   
  $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID, '' ), $thumb_size );
  $custom_img_src = bfi_thumb( $imgsrc[0], $params );
   
  return $custom_img_src;
   
}
