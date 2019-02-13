<?php
/**
 * Login Logo
 *
 * @package      WildGenesisChild
 * @author       Y Leventhal
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Login Logo URL
 *
 */
function wild_login_header_url( $url ) {
    return esc_url( home_url() );
}
add_filter( 'login_headerurl', 'wild_login_header_url' );
add_filter( 'login_headertitle', '__return_empty_string' );

/**
 * Login Logo
 *
 */
function wild_login_logo() {

	$logo_path = '/assets/images/logo.svg';
	if( ! file_exists( get_stylesheet_directory() . $logo_path ) )
		return;

	$logo = get_stylesheet_directory_uri() . $logo_path;
    ?>
    <style type="text/css">
    .login h1 a {
        background-image: url(<?php echo $logo;?>);
        background-size: contain;
        background-repeat: no-repeat;
		background-position: center center;
        display: block;
        overflow: hidden;
        text-indent: -9999em;
        width: 312px;
        height: 100px;
    }
    </style>
    <?php
}
add_action( 'login_head', 'wild_login_logo' );
