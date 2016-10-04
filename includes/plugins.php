<?php

// Lower the priority of Yoast SEO metabox
add_filter( 'wpseo_metabox_prio', function() { return 'low'; });

// SuperSide Me button options
add_filter( 'supersideme_button_options', 'prefix_modify_button_options' );
function prefix_modify_button_options( $button ) {
	$button['button_color'] = '';
	$button['function']		= 'append';
	$button['location']     = '.header-content';
	$button['position']     = 'relative';
	$button['width']        = 'auto';
	return $button;
}

// SuperSide Me panel options
add_filter( 'supersideme_panel_options', 'prefix_modify_panel_options' );
function prefix_modify_panel_options( $options ) {
	$options['maxwidth'] = '768px';
	return $options;
}
