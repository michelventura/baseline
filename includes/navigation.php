<?php

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 5 );

add_action( 'genesis_after', 'baseline_sidr_testing' );
function baseline_sidr_testing() {
?>
	<nav id="side-menu" style="display:none;" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

    	<button class="menu-close" role="button" aria-pressed="false"><i class="fa fa-times"></i><?php echo __( ' Close', 'baseline' ); ?></button>

		<?php get_search_form(); ?>

		<?php
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
			echo '<div class="sidr-heading">' . __( 'Header Menu', 'baseline' ) . '</div>';
			echo $header;
		}
		if ( ! empty( $primary ) ) {
			echo '<div class="sidr-heading">' . __( 'Primary Menu', 'baseline' ) . '</div>';
			echo $primary;
		}
		if ( ! empty( $secondary ) ) {
			echo '<div class="sidr-heading">' . __( 'Secondary Menu', 'baseline' ) . '</div>';
			echo $secondary;
		}
		?>

	</nav>
<?php
}
