<?php

/**
 * Default term archive descriptions
 */
add_filter( 'get_term_metadata', 'prefix_genesis_default_term_archive_intro', 10, 4 );
function prefix_genesis_default_term_archive_intro( $value, $term_id, $meta_key, $single ) {
    $options = array(
        'headline'   => 'name',
        'intro_text' => 'description',
    );
    // Bail if admin
    if ( is_admin() ) {
        return $value;
    }
    if ( ( is_category() || is_tag() || is_tax() ) && array_key_exists( $meta_key, $options ) ) {
        // Grab the current value, be sure to remove and re-add the hook to avoid infinite loops
        remove_action( 'get_term_metadata', 'prefix_genesis_default_term_archive_intro', 10 );
        $value = get_term_meta( $term_id, $meta_key, true );
        add_action( 'get_term_metadata', 'prefix_genesis_default_term_archive_intro', 10, 4 );
        // Use fallback if empty
        if ( empty( $value ) ) {
            $term  = get_term_by( 'term_taxonomy_id', $term_id );
            $value = $term->$options[$meta_key];
        }
    }
    return $value;
}