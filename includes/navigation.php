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

// Get the search button
function prefix_get_search_btn() {
	$search_btn = '<li class="menu-item search">';
		$search_btn .= '<a href="#0" id="search-btn" class="search-btn">&nbsp;';
			$search_btn .= '<span class="screen-reader-text">Search</span>';
		$search_btn .= '</a>';
	$search_btn .= '</li>';
	return $search_btn;
}

// Get the search box
function prefix_get_search_box() {
	$search_box = '<div id="search-box" style="display:none;">';
		$search_box .= '<div class="wrap">';
			$search_box .= '<p class="search-desc">Search ' . get_bloginfo('name') . ' ...</p>';
			$search_box .= get_search_form(false);
			$search_box .= '<a class="search-close" href="#0"><span class="screen-reader-text">Close</span><span class="fa fa-times" aria-hidden="true"></span></a>';
		$search_box .= '</div>';
	$search_box .= '</div>';
	return $search_box;
}