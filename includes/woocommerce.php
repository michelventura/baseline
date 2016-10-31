<?php

// Genesis Connect for WooCommerce
add_theme_support( 'genesis-connect-woocommerce' );

// Enqueue WooCommerce styles
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_woocommerce_scripts' );
function prefix_enqueue_woocommerce_scripts() {
	// Bail if WooCommerce is not active
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	wp_enqueue_style( 'prefix-woocommerce', get_stylesheet_directory_uri() . '/assets/css/woocommerce.css', array(), CHILD_THEME_VERSION );
}

// Remove titles on archive pages
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );

// Replace Woocommerce Default pagination with Genesis Framework Pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'genesis_posts_nav', 10 );

// Remove coupons case-insensitive filter
remove_filter( 'woocommerce_coupon_code', 'strtolower' );

/**
 * Manage WooCommerce styles and scripts.
 * @link https://gregrickaby.com/remove-woocommerce-styles-and-scripts/
 */
add_action( 'wp_enqueue_scripts', 'prefix_woocommerce_script_cleaner', 99 );
function prefix_woocommerce_script_cleaner() {
	// Bail if WooCommerce is not active
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	// Bail if Cart or Checkout pages. We need layout stuff here
	if ( is_page( array('cart','checkout') ) ) {
		return;
	}
	wp_dequeue_style( 'woocommerce-layout' );
}
