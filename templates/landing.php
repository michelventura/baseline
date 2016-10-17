<?php
/**
 * Template Name: Landing Page
 */

// Remove SuperSide Me mobile menu
add_filter( 'supersideme_override_output', '__return_false' );

// Add custom body class to the head
add_filter( 'body_class', 'prefix_add_body_class' );
function prefix_add_body_class( $classes ) {
   $classes[] = 'prefix-landing';
   return $classes;
}

// Remove site header elements
remove_action( 'genesis_header', 'prefix_do_header_nav', 12 );

// Remove navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_before_footer', 'genesis_do_subnav' );

// Remove breadcrumbs
remove_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );

// Remove page title
remove_action('genesis_entry_header', 'genesis_do_post_title');

// Remove site footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Run the Genesis loop
genesis();
