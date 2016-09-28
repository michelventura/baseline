<?php

// Register header nav menu
add_action( 'init', 'prefix_register_header_nav' );
function prefix_register_header_nav() {
	register_nav_menu( 'header', __( 'Header Navigation Menu', 'prefix' ) );
}

// Display header nav
add_action( 'genesis_header', 'prefix_do_header_nav', 12 );
function prefix_do_header_nav() {
	echo '<div class="header-content">';
		genesis_nav_menu( array( 'theme_location' => 'header' ) );
	echo '</div>';
}

// Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 5 );