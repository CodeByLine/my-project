<?php
/**
 * Archive
 *
 * @package      WildGenesisChild
 * @author       Y Leventhal
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Blog Archive Body Class
 *
 */
function wild_blog_archive_body_class( $classes ) {
	$classes[] = 'archive';
	return $classes;
}
add_filter( 'body_class', 'wild_blog_archive_body_class' );

genesis();
