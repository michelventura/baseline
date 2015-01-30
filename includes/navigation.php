<?php

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 5 );

// Add mobile nav button
add_action( 'genesis_header', 'spears_do_primary_nav' );
function spears_do_primary_nav() {
	echo '<a id="menu-toggle" href="#mobile-menu"><i class="fa fa-bars"></i></a>';
}

// Add custom mobile menu
add_action( 'genesis_after_footer', 'spears_do_mobilenav' );
function spears_do_mobilenav() {

	echo '<nav id="mobile-menu" style="display:none;" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">';
		echo get_search_form();
		$args_1 = array(
			'theme_location' => 'header',
		);
		echo '<div class="nav-mobile-heading">Header</div>';
		echo wp_nav_menu( $args_1 );
		$args_2 = array(
			'theme_location' => 'primary',
		);
		echo '<div class="nav-mobile-heading">Primary</div>';
		echo wp_nav_menu( $args_2 );
	echo '</nav>';

}