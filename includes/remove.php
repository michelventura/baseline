<?php

// Unregister layout settings
// genesis_unregister_layout( 'content-sidebar-sidebar' );
// genesis_unregister_layout( 'sidebar-content-sidebar' );
// genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregister secondary sidebar
// unregister_sidebar( 'sidebar-alt' );
unregister_sidebar( 'header-right' );

// Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

// Remove Blog & Archive Template From Genesis
add_filter( 'theme_page_templates', 'prefix_remove_page_templates' );
function prefix_remove_page_templates( $templates ) {
	unset( $templates['page_blog.php'] );
	unset( $templates['page_archive.php'] );
	return $templates;
}

// Disable the Genesis Favicon
remove_action( 'wp_head', 'genesis_load_favicon' );

/**
 * Remove default Superfish arguments
 * They are now added in global.js
 *
 * @author Gary Jones
 * @link   http://code.garyjones.co.uk/change-superfish-arguments
 *
 * @param string $url Existing URL.
 *
 * @return string Amended URL.
 */
add_filter( 'genesis_superfish_args_url', '__return_false' );
