<?php
/**
 * Controls the homepage output.
 */

/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
add_action( 'genesis_meta', 'lb_home_genesis_meta' );
function lb_home_genesis_meta() {

	// remove the page title
	remove_action('genesis_entry_header', 'genesis_do_post_title');

	if ( is_active_sidebar( 'home-welcome' ) ) {

		// Force content-sidebar layout setting
		// add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// Add lb-home body class
		// add_filter( 'body_class', 'lb_home_body_class' );

		// Remove the default Genesis loop
		// remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add homepage widgets
		// add_action( 'genesis_loop', 'lb_homepage_widgets' );

	}

	if ( is_active_sidebar( 'home-welcome' ) ) {

		//* Hook home welcome widget after header
		add_action( 'genesis_after_header', 'lb_do_home_welcome' );

	}

	if ( is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-right' ) ) {

		//* Hook home left and right widgets after header
		add_action( 'genesis_after_header', 'lb_do_home_left_right' );

	}

	if ( is_active_sidebar( 'home-middle' ) ) {

		//* Hook home left and right widgets after header
		add_action( 'genesis_after_header', 'lb_do_home_middle' );

	}

}

// function lb_home_body_class( $classes ) {

// 	$classes[] = 'lb-home';
// 	return $classes;
	
// }

function lb_do_home_welcome() {

	genesis_widget_area( 'home-welcome', array(
		'before' => '<div class="home-welcome"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

function lb_do_home_left_right() {

	echo '<div class="home-left-right"><div class="wrap">';

		genesis_widget_area( 'home-left', array(
			'before' => '<div class="home-left">',
			'after'  => '</div>',
		) );
		genesis_widget_area( 'home-right', array(
			'before' => '<div class="home-right">',
			'after'  => '</div>',
		) );

	echo '</div></div>';	

}

function lb_do_home_middle() {

	genesis_widget_area( 'home-middle', array(
		'before' => '<div class="home-middle"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

//* Run the Genesis loop
genesis();
