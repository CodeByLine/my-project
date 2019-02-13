<?php
/**
 * Functions
 * @package		 WildGenesisChild 
 * @author       YLeventhal
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/*

This theme is modified from Bill Erickson's EAGenesisChild theme.

BEFORE MODIFYING THIS THEME:
Please read the instructions here (private repo): https://github.com/billerickson/wild-Starter/wiki
Devs, contact me if you need access
*/

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
    $content_width = 1024;

/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function wild_genesis_child_setup() {

	define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );

	// Includes
	include_once( get_stylesheet_directory() . '/inc/wordpress-cleanup.php' );
	include_once( get_stylesheet_directory() . '/inc/genesis-changes.php' );
	include_once( get_stylesheet_directory() . '/inc/markup.php' );
	include_once( get_stylesheet_directory() . '/inc/login-logo.php' );
    include_once( get_stylesheet_directory() . '/inc/tinymce.php' );
	include_once( get_stylesheet_directory() . '/inc/disable-editor.php' );
	include_once( get_stylesheet_directory() . '/inc/helper-functions.php' );
	include_once( get_stylesheet_directory() . '/inc/navigation.php' );
	include_once( get_stylesheet_directory() . '/inc/loop.php' );
	include_once( get_stylesheet_directory() . '/inc/custom-logo.php' );

	// Editor Styles
	add_theme_support( 'editor-styles' );

	/** below from https://www.cloudways.com/blog/create-wordpress-genesis-child-theme-from-scratch/ */

	// Add HTML5 markup structure.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'  ) );
		
	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'Genesis-responsive-viewport' );

	// Add theme support for accessibility.
	add_theme_support( 'Genesis-accessibility', array(
		'404-page',
		'drop-down-menu',
		'headings',
		'rems',
		'search-form',
		'skip-links',
	) );

	// Add theme support for footer widgets.
	add_theme_support( 'Genesis-footer-widgets', 3 );

	// Unregister layouts that use a secondary sidebar.
	// Genesis_unregister_layout( 'content-sidebar-sidebar' );
	// Genesis_unregister_layout( 'sidebar-content-sidebar' );
	// Genesis_unregister_layout( 'sidebar-sidebar-content' );

	// Unregister secondary sidebar.
	// unregister_sidebar( 'sidebar-alt' );

/** above from https://www.cloudways.com/blog/create-wordpress-genesis-child-theme-from-scratch/ */


	add_editor_style( 'assets/css/editor-style.css' );

	// Image Sizes
	// add_image_size( 'wild_featured', 400, 100, true );

	// Gutenberg

	// -- Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// -- Wide Images
	add_theme_support( 'align-wide' );

	// -- Disable custom font sizes
	// add_theme_support( 'disable-custom-font-sizes' );

	// -- Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'small', 'wild_genesis_child' ),
			'shortName' => __( 'S', 'wild_genesis_child' ),
			'size'      => 12,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'regular', 'wild_genesis_child' ),
			'shortName' => __( 'M', 'wild_genesis_child' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => __( 'large', 'wild_genesis_child' ),
			'shortName' => __( 'L', 'wild_genesis_child' ),
			'size'      => 20,
			'slug'      => 'large'
		),
	) );

	// -- Disable Custom Colors
	// add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blue', 'wild_genesis_child' ),
			'slug'  => 'blue',
			'color'	=> '#59BACC',
		),
		array(
			'name'  => __( 'Green', 'wild_genesis_child' ),
			'slug'  => 'green',
			'color' => '#58AD69',
		),
		array(
			'name'  => __( 'Orange', 'wild_genesis_child' ),
			'slug'  => 'orange',
			'color' => '#FFBC49',
		),
		array(
			'name'	=> __( 'Red', 'wild_genesis_child' ),
			'slug'	=> 'red',
			'color'	=> '#E2574C',
		),
	) );

}
add_action( 'genesis_setup', 'wild_genesis_child_theme_setup', 15 );

/**
 * Change the comment area text
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
function wild_comment_text( $args ) {
	$args['title_reply']          = __( 'Leave A Reply', 'wild_genesis_child' );
	$args['label_submit']         = __( 'Post Comment',  'wild_genesis_child' );
	$args['comment_notes_before'] = '';
	$args['comment_notes_after']  = '';
	return $args;
}
add_filter( 'comment_form_defaults', 'wild_comment_text' );

/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function wild_global_enqueues() {

	// javascript
	wp_enqueue_script( 'wild-global', get_stylesheet_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/global-min.js' ), true );

	// css
    wp_dequeue_style( 'child-theme' );
	wp_enqueue_style( 'wild-fonts', wild_theme_fonts_url() );
    wp_enqueue_style( 'wild-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), CHILD_THEME_VERSION );

	// Move jQuery to footer
	if( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
		wp_enqueue_script( 'jquery' );
	}
}
add_action( 'wp_enqueue_scripts', 'wild_global_enqueues' );

/**
 * Gutenberg scripts and styles
 *
 */
function wild_gutenberg_scripts() {
	wp_enqueue_style( 'wild-fonts', wild_theme_fonts_url() );
}
add_action( 'enqueue_block_editor_assets', 'wild_gutenberg_scripts' );


/**
 * Theme Fonts URL
 *
 */
function wild_theme_fonts_url() {
	$font_families = apply_filters( 'wild_theme_fonts', array( 'Source+Sans+Pro:400,400i,700,700i' ) );
	$query_args = array(
		'family' => implode( '|', $font_families ),
		'subset' => 'latin,latin-ext',
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}

/**
 * Template Hierarchy
 *
 */
function wild_template_hierarchy( $template ) {
	if( is_home() || is_search() )
		$template = get_query_template( 'archive' );
	return $template;
}
add_filter( 'template_include', 'wild_template_hierarchy' );
