<?php

// Add new image size 4 x 3 ratio
add_image_size( 'one-half', 565, 424, TRUE );
add_image_size( 'one-third', 365, 274, TRUE );
add_image_size( 'one-fourth', 275, 206, TRUE );

// Add our image sizes to the media chooser
add_filter('image_size_names_choose', 'applegate_do_media_chooser_sizes');
function applegate_do_media_chooser_sizes( $sizes ) {
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
 * Filter Genesis favicon location and add touch icons
 * @link http://realfavicongenerator.net/ to generate icons
 */
add_filter( 'genesis_pre_load_favicon', 'baseline_favicon_filter' );
function baseline_favicon_filter( $favicon ) {
?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-180x180.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/apple-touch-icon-57x57.png">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="Shortcut Icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/favicon.png" type="image/x-icon">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri(); ?>/images/favicons/mstile-144x144.png">
<?php
}
