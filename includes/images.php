<?php

/**
 * Add new image sizes
 * @link http://andrew.hedges.name/experiments/aspect_ratio/
 */
// add_image_size( 'one-half', 565, 424, TRUE );
// add_image_size( 'one-third', 365, 274, TRUE );
// add_image_size( 'one-fourth', 275, 206, TRUE );
// add_image_size( 'featured', 800, 600, TRUE );
// add_image_size( 'banner', 1200, 400, TRUE );

// Add our image sizes to the media chooser
// add_filter( 'image_size_names_choose', 'prefix_do_media_chooser_sizes' );
function prefix_do_media_chooser_sizes( $sizes ) {
	$addsizes = array(
		'one-third'  => __( 'One Third'),
		'one-fourth' => __( 'One Fourth'),
	);
	$newsizes = array_merge( $sizes, $addsizes );
	return $newsizes;
}

// Turn off gallery CSS
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Remove unsupported FlexGrid gallery options from admin
 *
 * @return void
 */
add_action( 'admin_head', 'prefix_remove_unsupported_flexgrid_gallery_options' );
function prefix_remove_unsupported_flexgrid_gallery_options() {
    echo '<style type="text/css">
        .gallery-settings .columns option[value="5"],
        .gallery-settings .columns option[value="7"],
        .gallery-settings .columns option[value="8"],
        .gallery-settings .columns option[value="9"] {
            display:none !important;
            visibility: hidden !important;
        }
        </style>';
}

// Add featured image to single posts
// add_action( 'genesis_entry_content', 'prefix_do_entry_featured_image', 8 );
function prefix_do_entry_featured_image() {
    if ( ! ( is_singular( array('post') ) && has_post_thumbnail() ) ) {
    	return;
    }
    echo '<div class="featured-image">';
	the_post_thumbnail( 'featured' );
	echo '</div>';
	$caption = get_post(get_post_thumbnail_id())->post_excerpt;
	if ( $caption ) {
		echo '<span class="image-caption">' . $caption . '</span>';
	}
}
