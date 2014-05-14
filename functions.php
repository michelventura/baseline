<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Local Biz' );
define( 'CHILD_THEME_URL', 'http://thestizmedia.com/' );
define( 'CHILD_THEME_VERSION', '1.0.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

//* Enqueue Javascript files
add_action( 'wp_enqueue_scripts', 'baseline_enqueue_scripts' );
function baseline_enqueue_scripts() {
	wp_enqueue_script( 'baseline-responsive-menu', get_stylesheet_directory_uri() . '/assets/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
}

//* Enqueue CSS files
add_action( 'wp_enqueue_scripts', 'baseline_enqueue_styles' );
function baseline_enqueue_styles() {
	wp_enqueue_style( 'google-font-roboto', '//fonts.googleapis.com/css?family=Roboto:300,300italic,400,400italic,700,700italic|Roboto+Condensed:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'baseline-responsive-menu-style', get_stylesheet_directory_uri() . '/assets/css/responsive-menu.css', array(), '1.0.0' );
	wp_enqueue_style( 'baseline-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
}

// Add new image size
// add_image_size( 'one-half', 565, 275, TRUE );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home Top', 'home-top' ),
	'description' => __( 'This is the welcome widget that appears at the top of the front page', 'baseline' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-left',
	'name'        => __( 'Home Left', 'home-left' ),
	'description' => __( 'This is the home left widget area', 'baseline' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-right',
	'name'        => __( 'Home Right', 'home-right' ),
	'description' => __( 'This is the home right widget area', 'baseline' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home Middle', 'home-middle' ),
	'description' => __( 'This is the home middle widget area', 'baseline' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'baseline' ),
	'description' => __( 'This is the widget that appears after a single posts.', 'baseline' ),
) );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 5 );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'baseline_post_info_filter' );
function baseline_post_info_filter($post_info) {
	$post_info = '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
}

//* Hook after post widget after the entry content
add_action( 'genesis_after_entry', 'bl_after_entry', 5 );
function bl_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
		) );

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
add_filter( 'genesis_footer_creds_text', 'bl_custom_footer_creds_text' );
function bl_custom_footer_creds_text() {
?>
    <div class="creds">
    	<p>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &middot; All Rights Reserved &middot; Website by <a href="#" title="Marketing Company">Marketing Company</a>
		</p>
	</div>
<?php
}

// Change login logo
add_action('login_head',  'bl_custom_dashboard_logo');
function bl_custom_dashboard_logo() {

	if ( 'image' === genesis_get_option( 'blog_title' ) ) {

		echo '<style  type="text/css">
			.login h1 a {
			background-image:url('.get_stylesheet_directory_uri().'/images/logo.png)  !important;
			background-size: 300px 123px  !important;
			width: 300px  !important;
			height: 123px  !important;
			}
		</style>';

	}
}

// Change login link
add_filter('login_headerurl','bl_loginpage_custom_link');
function bl_loginpage_custom_link() {
	return get_site_url();
}