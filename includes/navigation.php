<?php

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 5 );

add_action( 'wp_print_scripts', 'baseline_sidr_testing' );
function baseline_sidr_testing() {

	$menu_open = '<nav class="nav-sidr" style="display:none;" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">';

    	$close = '<button class="menu-close" role="button" aria-pressed="false"><i class="fa fa-times"></i> Close</button>';

		ob_start();
		get_search_form();
		$search = ob_get_contents();
		ob_end_clean();

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

		$menu = '<div class="sidr-menu-wrap">';

			if ( ! empty( $header_nav ) ) {
				$menu .= '<div class="sidr-heading">' . __( 'Header Menu', 'baseline' ) . '</div>';
				$menu .= $header_nav;
			}
			if ( ! empty( $primary_nav ) ) {
				$menu .= '<div class="sidr-heading">' . __( 'Primary Menu', 'baseline' ) . '</div>';
				$menu .= $primary_nav;
			}

		$menu .= '</div>';

	$menu_close = '</nav>';

	// Set up variables to pass to our js
	$output = array(
		'menu_open'  => $menu_open,
		'close'      => $close,
		'search'     => $search,
		'menu'       => $menu,
		'menu_close' => $menu_close,
	);

	// Localize variables to send over
	wp_localize_script( 'baseline-global', 'BaselineVar', $output );

}

// Add the markup that sidr will populate with our menu(s)
add_action( 'genesis_after', 'baseline_do_mobile_nav_div' );
function baseline_do_mobile_nav_div() {
?>
    <div id="mobile-menu">
    	<div class="sidr-append"></div>
	</div>
<?php
}