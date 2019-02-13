<?php
/**
 * Front Page
 *
 * @package      WildGenesisChild
 * @author       Y Leventhal
 * @since        1.0.0
 * @license      GPL-2.0+
**/


/* Additional code from https://www.cloudways.com/blog/wordpress-genesis-child-theme-custom-widget/ */

// Full width layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove post title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title'                 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open',  5  );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

/**
 * Use h1 for site title
 *
 */
function wild_h1_for_site_title( $wrap ) {
	return 'h1';
}
add_filter( 'genesis_site_title_wrap', 'wild_h1_for_site_title' );

genesis_register_sidebar( array(
           'id'       => 'front-page-1',
           'name'     => __( 'Homepage Slider Widget', 'wild-genesis-child' ),
           'description' => __( 'This is a widget that goes on the front page.', 'wild-genesis-child' ),
) );

genesis_register_sidebar( array(
	   'name'       => __( 'Home Content Top Left', 'wild-genesis-child' ),
	   'id'         => 'content-1',
	   'description'   => __( 'Top Left Home', 'wild-genesis-child' ),
	 ) );


 genesis_register_sidebar( array(
   'name'       => __( 'Home Content Top Middle', 'wild-genesis-child' ),
   'id'         => 'content-2',
   'description'   => __( 'Top Middle Home', 'wild-genesis-child' ),
 ) );

 genesis_register_sidebar( array(
	   'name'       => __( 'Home Content Top Right', 'wild-genesis-child' ),
	   'id'         => 'content-3',
	   'description'   => __( 'Top Right Home', 'wild-genesis-child' ),
	 ) );

add_action( 'genesis_meta', 'my_homepage_setup' );

function my_homepage_setup() {

     if ( is_active_sidebar( 'front-page-1' ) )  {
            //* Add slider widget
           add_action( 'genesis_after_header', 'display_front_page_1_widget' );
     }
}

// Add markup to display slider widgets.

function display_front_page_1_widget() {
     genesis_widget_area( 'front-page-1', array(
           'before' => '<div class="front-page-1-widget"><div class="wrap">',
           'after'  => '</div></div>',
     ) );
}


add_action( 'genesis_before_content', 'ng_home_page_widgets' );

//* Add the home widgets in place

function ng_home_page_widgets() {
           if ( is_front_page('') )
           genesis_widget_area ('content-1', array(
                'before' => '<div class="one-third first hometopcol toplefthome">',
                'after' => '</div>',));
           if ( is_front_page('') )
           genesis_widget_area ('content-2', array(
                'before' => '<div class="one-third  hometopcol topmiddlehome">',
                'after' => '</div>',));
           if ( is_front_page('') )
           genesis_widget_area ('content-3', array(
                'before' => '<div class="one-third  hometopcol toprighthome">',
                'after' => '</div>',));
           }

genesis();
