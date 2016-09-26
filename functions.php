<?php
// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Baseline' );
define( 'CHILD_THEME_URL', 'http://thestizmedia.com/' );
define( 'CHILD_THEME_VERSION', '2.4.0' );

// Add HTML5 markup structure
add_theme_support( 'html5' );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'search-form',
	'skip-links',
) );

// Enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_scripts' );
function prefix_enqueue_scripts() {
	// wp_enqueue_script( 'prefix-global', get_stylesheet_directory_uri() . '/assets/js/global.js', array('jquery'), '1.0.0',  true );
}

// Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_styles' );
function prefix_enqueue_styles() {
	wp_enqueue_style( 'prefix-google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,700,700italic|Roboto+Condensed:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0' );
	wp_enqueue_style( 'flexgrid', get_stylesheet_directory_uri() . '/assets/css/flexgrid.min.css', array(), '2.0.0' );
}

/**
 * Add custom body class to the head
 */
add_filter( 'body_class', 'prefix_global_body_class' );
function prefix_global_body_class( $classes ) {
	$classes[] = 'no-js';
	return $classes;
}

/**
 * Include all php files in the /includes/ directory
 *
 * https://gist.github.com/theandystratton/5924570
 */
foreach ( glob( dirname( __FILE__ ) . '/includes/*.php' ) as $file ) { include $file; }

// Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'prefix_post_info_filter' );
function prefix_post_info_filter($post_info) {
	$post_info = '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

// Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'prefix_author_box_gravatar_size' );
function prefix_author_box_gravatar_size( $size ) {
	return '200';
}

// Modify the size of the Gravatar in comments
add_filter( 'genesis_comment_list_args', 'prefix_comments_gravatar' );
function prefix_comments_gravatar( $args ) {
	$args['avatar_size'] = 160;
	return $args;
}

// Customize the credits
add_filter( 'genesis_footer_creds_text', 'prefix_custom_footer_creds_text' );
function prefix_custom_footer_creds_text( $text ) {
    $text = '';
    $text .= '<div class="creds">';
    	$text .= '<p>Copyright &copy; ' . date('Y') . ' <a href="' . get_bloginfo('url') . '" title="' . get_bloginfo('name') . '">' . get_bloginfo('name') . '</a> &middot; All Rights Reserved &middot; Website by <a rel="nofollow" href="http://bizbudding.com" title="BizBudding Inc.">BizBudding Inc.</a></p>';
	$text .= '</div>';
	return $text;
}

// Change login logo
add_action('login_head',  'prefix_custom_dashboard_logo');
function prefix_custom_dashboard_logo() {
	echo '<style  type="text/css">
		.login h1 a {
			background-image:url(' . get_stylesheet_directory_uri() . '/images/logo@2x.png)  !important;
			background-size: contain !important;
			width: 100% !important;
			max-width: 300px !important;
			min-height: 100px !important;
		}
	</style>';
}

// Change login link
add_filter('login_headerurl','prefix_loginpage_custom_link');
function prefix_loginpage_custom_link() {
	return get_site_url();
}
