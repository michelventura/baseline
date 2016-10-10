<?php

// Get the search button
function prefix_get_search_btn() {
	$search_btn = '<li class="menu-item search">';
		$search_btn .= '<a href="#0" id="search-btn" class="search-btn">&nbsp;';
			$search_btn .= '<span class="screen-reader-text">Search</span>';
		$search_btn .= '</a>';
	$search_btn .= '</li>';
	return $search_btn;
}

// Get the search box
function prefix_get_search_box() {
	$search_box = '<div id="search-box" style="display:none;">';
		$search_box .= '<div class="wrap">';
			$search_box .= '<p class="search-desc">Search ' . get_bloginfo('name') . ' ...</p>';
			$search_box .= get_search_form(false);
			$search_box .= '<a class="search-close" href="#0"><span class="screen-reader-text">Close</span><span class="fa fa-times" aria-hidden="true"></span></a>';
		$search_box .= '</div>';
	$search_box .= '</div>';
	return $search_box;
}
