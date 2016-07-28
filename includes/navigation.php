<?php

// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );

// Register header nav menu
add_action( 'init', 'prefix_register_header_nav' );
function prefix_register_header_nav() {
	register_nav_menu( 'header', __( 'Header Navigation', 'prefix' ) );
}

// Display header nav
add_action( 'genesis_header', 'prefix_do_header_nav', 12 );
function prefix_do_header_nav() {
	echo '<div class="header-content">';
		// echo get_search_form();
		genesis_nav_menu( array( 'theme_location' => 'header' ) );
	echo '</div>';
}

// Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 5 );

// Add side menu after site-container
add_action( 'genesis_after', 'prefix_sidr_navigation' );
function prefix_sidr_navigation() {

	echo '<nav id="side-menu" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">';

    	echo '<button class="menu-close" role="button" aria-pressed="false"><span class="fa fa-times" aria-hidden="true"></span>' . __( ' Close', 'prefix' ) . '</button>';

		get_search_form();

		// Header nav
		$header = wp_nav_menu( array(
			'theme_location' => 'header',
			'echo'           => false,
			'fallback_cb'    => false,
		) );
		// Primary nav
		$primary = wp_nav_menu( array(
			'theme_location' => 'primary',
			'echo'           => false,
			'fallback_cb'    => false,
		) );
		// Secondary nav
		$secondary = wp_nav_menu( array(
			'theme_location' => 'secondary',
			'echo'           => false,
			'fallback_cb'    => false,
		) );
		// Display menus if they are active
		if ( ! empty( $header ) ) {
			// echo '<div class="sidr-heading">' . __( 'Header Menu', 'prefix' ) . '</div>';
			echo $header;
		}
		if ( ! empty( $primary ) ) {
			// echo '<div class="sidr-heading">' . __( 'Primary Menu', 'prefix' ) . '</div>';
			echo $primary;
		}
		if ( ! empty( $secondary ) ) {
			// echo '<div class="sidr-heading">' . __( 'Secondary Menu', 'prefix' ) . '</div>';
			echo $secondary;
		}

	echo '</nav>';
}
