<?php

/**
 * Enqueue an admin script, for custom editor styles and other stuff
 *
 * @return void
 */
add_action( 'admin_enqueue_scripts', 'prefix_enqueue_admin_scripts' );
function prefix_enqueue_admin_scripts() {
	add_editor_style( '/assets/css/editor-style.css' );
}

/**
 * Adds a new select bar to the WP editor
 * Insert 'styleselect' into the $buttons array
 * _2 places the new button on the second line
 *
 * @return  array
 */
add_filter( 'mce_buttons_2', 'prefix_add_styleselect_dropdown' );
function prefix_add_styleselect_dropdown( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

/**
 * Add a new full width wrap span to elements
 *
 * @param   array  $init_array
 *
 * @return  array
 */
add_filter( 'tiny_mce_before_init', 'prefix_add_style_format_options_to_editor' );
function prefix_add_style_format_options_to_editor( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title'		=> 'Button',
			'selector'	=> 'a',
			'classes'	=> 'button',
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;
}
