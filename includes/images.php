<?php

// Add new image sizes
add_image_size( 'featured', 700, 400, TRUE );
// add_image_size( 'one-half', 565, 424, TRUE );
// add_image_size( 'one-third', 365, 274, TRUE );
// add_image_size( 'one-fourth', 275, 206, TRUE );

// Add our image sizes to the media chooser
add_filter('image_size_names_choose', 'applegate_do_media_chooser_sizes');
function applegate_do_media_chooser_sizes( $sizes ) {
	$addsizes = array(
		'featured'  => __( 'Featured'),
	);
	$newsizes = array_merge( $sizes, $addsizes );
	return $newsizes;
}

// Add featured image to single posts
add_action( 'genesis_before_entry', 'baseline_entry_featured_image', 8 );
function baseline_entry_featured_image() {
    if ( ! ( is_singular( array('page','post') ) && has_post_thumbnail() ) ) {
    	return;
    }
	the_post_thumbnail( 'featured' );
}

// Turn off gallery CSS
add_filter( 'use_default_gallery_style', '__return_false' );
