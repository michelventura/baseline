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
	wp_enqueue_style( 'prefix-woocommerce', get_stylesheet_directory_uri() . '/assets/css/woo.css', array(), CHILD_THEME_VERSION );

	// Bail if Cart or Checkout pages. We need layout stuff here
	if ( is_page( array('cart','checkout') ) ) {
		return;
	}

	/**
	 * Remove Woo layout script
	 * @link https://gregrickaby.com/remove-woocommerce-styles-and-scripts/
	 */
	wp_dequeue_style( 'woocommerce-layout' );
}

// Remove titles on archive pages
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Add shop page title and description
add_action( 'genesis_before_loop', 'prefix_do_woocommerce_shop_title' );
function prefix_do_woocommerce_shop_title() {
	// Bail if WooCommerce is not active
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	// Bail if not on the Woo Shop page
    if ( ! is_shop() ) {
    	return;
    }
    // Remove Woo shop page default description
    remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );
    // Get our new data
    $shop_id 	= get_option( 'woocommerce_shop_page_id' );
	$post		= get_post( $shop_id );
	$headline	= $post->post_title;
	$intro_text = $post->post_content;
	$headline	= $headline ? sprintf( '<h1 %s>%s</h1>', genesis_attr( 'archive-title' ), strip_tags( $headline ) ) : '';
	$intro_text = $intro_text ? $intro_text : '';
    printf( '<div %s>%s</div>', genesis_attr( 'cpt-archive-description' ), $headline . $intro_text );
}

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );

// Replace Woocommerce Default pagination with Genesis Framework Pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'genesis_posts_nav', 10 );

// Remove coupons case-insensitive filter
remove_filter( 'woocommerce_coupon_code', 'strtolower' );
