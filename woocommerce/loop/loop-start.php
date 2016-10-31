<?php
/**
 * *********************************************************
 * Added post_class filter
 * Added product-wrap
 * Changed products to a <div> and added flexington classes
 * *********************************************************
 *
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

// Add Flexington column classes any time this template is used
add_filter( 'post_class', function( $classes ) {
    global $wp_query;
    if (  ! $wp_query->is_main_query() ) {
        return $classes;
    }
    $classes[] = 'col col-xs-6 col-sm-4 col-md-3 center-xs';
    return $classes;
});

// Add Flexington classes to [product_categories] shortcode
add_filter( 'product_cat_class', function( $classes, $class, $category ) {
	$classes[] = 'col col-xs-12 col-sm-6 col-md-4';
	return $classes;
}, 10, 3 );
?>
<div class="product-wrap"><div class="products row gutter-20">
