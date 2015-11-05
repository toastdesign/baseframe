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

/* ==========================================================================
Custom exerpt lenght (return with <?php echo excerpt(25); ?>)
========================================================================== */
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

/* ==========================================================================
Function to include count inside link tag
========================================================================== */
/* This code filters the Categories archive widget to include the post count inside the link */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
  $links = str_replace('</a> (', ' (', $links);
  $links = str_replace(')', ')</a>', $links);
  return $links;
}
/* This code filters the Archive widget to include the post count inside the link */
add_filter('get_archives_link', 'archive_count_span');
function archive_count_span($links) {
  $links = str_replace('</a>&nbsp;(', ' (', $links);
  $links = str_replace(')', ')</a>', $links);
  return $links;
}