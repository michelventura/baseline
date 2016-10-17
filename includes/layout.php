<?php

// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );
// add_action( 'genesis_after_header', 'genesis_do_breadcrumbs', 50 );

// Reposition secondary sidebar inside .content
remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
add_action( 'genesis_after_content', 'genesis_get_sidebar_alt', 11 );

// Add new layout options
add_action( 'init', 'prefix_add_genesis_layouts' );
function prefix_add_genesis_layouts() {
    // Medium Content
    genesis_register_layout( 'md-content', array(
        'label' => __( 'Medium Content', 'baseline' ),
        'img'   => get_stylesheet_directory_uri() . '/assets/images/layouts/mdc.gif'
    ) );
    // Small Content
    genesis_register_layout( 'sm-content', array(
        'label' => __( 'Small Content', 'baseline' ),
        'img'   => get_stylesheet_directory_uri() . '/assets/images/layouts/smc.gif'
    ) );
    // Extra Small Content
    genesis_register_layout( 'xs-content', array(
        'label' => __( 'Extra Small Content', 'baseline' ),
        'img'   => get_stylesheet_directory_uri() . '/assets/images/layouts/xsc.gif'
    ) );
}

// Add flexington row classes to the content sidebar wrap
add_filter( 'genesis_attr_content-sidebar-wrap', 'prefix_content_sidebar_wrap_flexington_row' );
function prefix_content_sidebar_wrap_flexington_row( $attributes ) {
    $align  = '';
    $gutter = ' gutter-30';
    // New layouts and templates
    $layouts   = array( 'md-content', 'sm-content', 'xs-content' );
    $templates = array( 'landing.php' );
    // Center and remove gutter
    if ( in_array( genesis_site_layout(), $layouts ) || in_array( basename( get_page_template() ), $templates ) ) {
        $align  = ' around-xs';
        $gutter = '';
    }

    $attributes['class'] .= ' row' . $align . $gutter;

    return $attributes;
}

// Add flexington column classes to the content
add_filter( 'genesis_attr_content', 'prefix_content_flexington_cols' );
function prefix_content_flexington_cols( $attributes ) {

    $classes = ' col col-xs';

    $layout  = genesis_site_layout();
    if ( 'sidebar-sidebar-content' == $layout ) {
        $classes .= ' last-lg';
    }

    $attributes['class'] .= $classes;
    return $attributes;
}

// Add flexington column classes to the primary sidebar
add_filter( 'genesis_attr_sidebar-primary', 'prefix_sidebar_primary_flexington_cols' );
function prefix_sidebar_primary_flexington_cols( $attributes ) {

    $layouts = array( 'content-sidebar-sidebar', 'sidebar-content-sidebar', 'sidebar-sidebar-content' );
    $layout  = genesis_site_layout();

    $classes = ' col col-xs-12 col-md-4';

    if ( in_array( $layout, $layouts ) ) {
        $classes = ' col col-xs-12 col-lg-4';
    }

    if ( 'sidebar-content' == $layout ) {
        $classes .= ' first-md';
    }

    $attributes['class'] .= $classes;
    return $attributes;
}

// Add flexington column classes to the secondary sidebar
add_filter( 'genesis_attr_sidebar-secondary', 'prefix_sidebar_secondary_flexington_cols' );
function prefix_sidebar_secondary_flexington_cols( $attributes ) {

    $layouts = array( 'sidebar-content-sidebar', 'sidebar-sidebar-content' );
    $layout  = genesis_site_layout();

    $classes = ' col col-xs-12 col-lg-2';

    if ( in_array( $layout, $layouts ) ) {
        $classes .= ' first-lg';
    }

    $attributes['class'] .= $classes;
    return $attributes;
}

// Remove the sidebar for our custom content layouts
add_action( 'genesis_before', 'prefix_maybe_remove_sidebar' );
function prefix_maybe_remove_sidebar() {

    $custom_layouts = array( 'md-content', 'sm-content', 'xs-content' );

    if ( ! in_array( genesis_site_layout(), $custom_layouts ) ) {
        return;
    }
    // Remove sidebars
    remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
    remove_action( 'genesis_after_content', 'genesis_get_sidebar_alt', 11 );
}

/**
 * Filter the footer-widgets context of the genesis_structural_wrap to add a div before the closing wrap div.
 *
 * @param  	string  $output 		 	The markup to be returned
 * @param  	string  $original_output 	Set to either 'open' or 'close'
 *
 * @return  string 	The footer markup
 */
add_filter( 'genesis_structural_wrap-footer-widgets', 'prefix_footer_widgets_flexington_row', 10, 2 );
function prefix_footer_widgets_flexington_row( $output, $original_output ) {
    if ( 'open' == $original_output ) {
    	$output = $output . '<div class="row gutter-30">';
    }
    elseif ( 'close' == $original_output ) {
    	$output = '</div>' . $output;
    }
    return $output;
}

/**
 * Filter the footer-widget markup to add flexington column classes
 *
 * @param  	string  $output 		 	The markup to be returned
 * @param  	int 	$footer_widgets 	The number of footer widgets via add_theme_support( 'genesis-footer-widgets', 4 );
 *
 * @return  string 	The footer markup
 */
add_filter( 'genesis_footer_widget_areas', 'prefix_footer_widget_flexington_cols', 10, 2 );
function prefix_footer_widget_flexington_cols( $output, $footer_widgets ) {
    switch ( $footer_widgets ) {
        case '1':
            $classes = 'widget-area col col-xs-12 center-xs"';
            break;
        case '2':
            $classes = 'widget-area col col-xs-12 col-sm-6"';
            break;
        case '3':
            $classes = 'widget-area col col-xs-12 col-sm-6 col-md-4"';
            break;
        case '4':
            $classes = 'widget-area col col-xs-12 col-sm-6 col-md-3"';
            break;
        case '6':
            $classes = 'widget-area col col-xs-6 col-sm-4 col-md-2"';
            break;
    }
	$output = str_replace( 'widget-area"', $classes, $output );
	return $output;
}
