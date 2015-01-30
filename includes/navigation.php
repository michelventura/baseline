<?php

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 5 );

// Add mobile nav button
add_action( 'genesis_header', 'tsm_do_menu_toggle' );
function tsm_do_menu_toggle() {
	echo '<a id="menu-toggle" href="#mobile-menu"><i class="fa fa-bars"></i></a>';
}

// Add custom mobile menu
add_action( 'genesis_after_footer', 'tsm_do_mobile_menu' );
function tsm_do_mobile_menu() {

	echo '<nav id="mobile-menu" style="display:none;" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">';

		echo get_search_form();

		$header = array(
			'theme_location' => 'header',
			'fallback_cb'	 => false,
			'echo'			 => false,
		);
		$primary = array(
			'theme_location' => 'primary',
			'fallback_cb'	 => false,
			'echo'			 => false,
		);
		$primary_nav = wp_nav_menu( $primary );
		$header_nav  = wp_nav_menu( $header );

		if ( ! empty( $header_nav ) ) {
			echo '<div class="sidr-heading">Header Menu</div>';
			echo $header_nav;
		}
		if ( ! empty( $primary_nav ) ) {
			echo '<div class="sidr-heading">Primary Menu</div>';
			echo $primary_nav;
		}

	echo '</nav>';

}