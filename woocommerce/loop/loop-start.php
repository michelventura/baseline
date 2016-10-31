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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

// Do Flexington column classes any time this template is used
add_filter( 'post_class', function( $classes ) {
    global $wp_query;
    if (  ! $wp_query->is_main_query() ) {
        return $classes;
    }
    $classes[] = 'col col-xs-12 col-sm-6 col-md-4';
    return $classes;
});
?>
<div class="product-wrap"><div class="products row gutter-20">
