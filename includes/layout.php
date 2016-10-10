<?php

// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );
// add_action( 'genesis_after_header', 'genesis_do_breadcrumbs', 50 );

// Reposition secondary sidebar inside .content
remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
add_action( 'genesis_after_content', 'genesis_get_sidebar_alt', 11 );

/**
 * Filter the footer-widgets context of the genesis_structural_wrap to add a div before the closing wrap div.
 *
 * @param  string  $output 		 	The markup to be returned
 * @param  string  $original_output 	Set to either 'open' or 'close'
 */
add_filter( 'genesis_structural_wrap-footer-widgets', 'prefix_footer_widgets_flexbox_wrap', 10, 2 );
function prefix_footer_widgets_flexbox_wrap( $output, $original_output ) {
    if ( 'open' == $original_output ) {
    	$output = $output . '<div class="row gutter-30">';
    }
    elseif ( 'close' == $original_output ) {
    	$output = '</div>' . $output;
    }
    return $output;
}
