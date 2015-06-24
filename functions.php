<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Baseline' );
define( 'CHILD_THEME_URL', 'http://thestizmedia.com/' );
define( 'CHILD_THEME_VERSION', '2.0.5' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

//* Enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'baseline_enqueue_scripts' );
function baseline_enqueue_scripts() {
	// Sidr slide out menu
	wp_enqueue_script( 'sidr',  get_stylesheet_directory_uri() . '/assets/js/jquery.sidr.min.js', array( 'jquery' ), '1.2.1', true );
	wp_enqueue_script( 'baseline-global', get_stylesheet_directory_uri() . '/assets/js/global.js', array( 'sidr' ), '1.0.0', true );
}

//* Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'baseline_enqueue_styles' );
function baseline_enqueue_styles() {
	wp_enqueue_style( 'baseline-google-fonts', '//fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,700,700italic|Roboto+Condensed:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.3.0' );
}

/**
 * Filter Genesis favicon location and add touch icons
 * @link http://realfavicongenerator.net/ to generate icons
 */
add_filter( 'genesis_pre_load_favicon', 'baseline_favicon_filter' );
function baseline_favicon_filter( $favicon ) {
?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-180x180.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-57x57.png">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="Shortcut Icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon.png" type="image/x-icon">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/mstile-144x144.png">
<?php
}

/**
 * Add custom body class to the head
 */
add_filter( 'body_class', 'baseline_global_body_class' );
function baseline_global_body_class( $classes ) {
	$classes[] = 'no-js';
	return $classes;
}

// Include our extra files to stay organized
include_once('includes/navigation.php');
include_once('includes/remove.php');

// Add new image size 4 x 3 ratio
add_image_size( 'one-half', 565, 424, TRUE );
add_image_size( 'one-third', 365, 274, TRUE );
add_image_size( 'one-fourth', 275, 206, TRUE );

//* Activate After Entry widget area and display it on single posts
add_theme_support( 'genesis-after-entry-widget-area' );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'baseline_post_info_filter' );
function baseline_post_info_filter($post_info) {
	$post_info = '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'author_box_gravatar_size' );
function author_box_gravatar_size( $size ) {
	return '200';
}

//* Modify the size of the Gravatar in comments
add_filter( 'genesis_comment_list_args', 'sp_comments_gravatar' );
function sp_comments_gravatar( $args ) {
	$args['avatar_size'] = 160;
	return $args;
}

// Change breadcrumb text/args
add_filter( 'genesis_breadcrumb_args', 'bl_breadcrumb_args' );
function bl_breadcrumb_args( $args ) {
    $args['home']                    = 'Home';
    $args['sep']                     = ' <div class="dashicons dashicons-arrow-right-alt2"></div> ';
    $args['list_sep']                = ', '; // Genesis 1.5 and later
    $args['prefix']                  = '<div class="breadcrumb">';
    $args['suffix']                  = '</div>';
    $args['heirarchial_attachments'] = true; // Genesis 1.5 and later
    $args['heirarchial_categories']  = true; // Genesis 1.5 and later
    $args['display']                 = true;
    $args['labels']['prefix']        = '';
    $args['labels']['author']        = '';
    $args['labels']['category']      = ''; // Genesis 1.6 and later
    $args['labels']['tag']           = '';
    $args['labels']['date']          = '';
    $args['labels']['search']        = 'Search for ';
    $args['labels']['tax']           = '';
    $args['labels']['post_type']     = '';
    $args['labels']['404']           = 'Not found: '; // Genesis 1.5 and later
    return $args;
}

// Customize the credits
add_filter( 'genesis_footer_creds_text', 'tsm_custom_footer_creds_text' );
function tsm_custom_footer_creds_text() {
?>
    <div class="creds">
    	<p>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &middot; All Rights Reserved &middot; Website by <a href="http://thestizmedia.com" title="The Stiz Media, LLC">The Stiz Media, LLC</a>
		</p>
	</div>
<?php
}

/**
 * Change login logo
 * Max image width should be 320px
 * @link http://andrew.hedges.name/experiments/aspect_ratio/
 */
add_action('login_head',  'tsm_custom_dashboard_logo');
function tsm_custom_dashboard_logo() {
	echo '<style  type="text/css">
		.login h1 a {
			background-image:url(' . get_stylesheet_directory_uri() . '/images/logo@2x.png)  !important;
			background-size: 300px auto !important;
			width: 100% !important;
			height: 120px !important;
		}
	</style>';
}

// Change login link
add_filter('login_headerurl','tsm_loginpage_custom_link');
function tsm_loginpage_custom_link() {
	return get_site_url();
}
