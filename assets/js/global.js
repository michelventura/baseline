/*!
 * Swap out no-js for js body class
 */
( function() {
    var c = document.body.className;
    c = c.replace( /no-js/, 'js' );
    document.body.className = c;
})();

jQuery(function( $ ) {
	'use strict';

	// Add the search button and search box HTML
	$( '.menu-primary' ).append( prefix_global_vars.search_btn );
	$( '.nav-primary' ).after( prefix_global_vars.search_box );

    // On click of the search button
    $('body').on( 'click', '#search-btn', function(e){
        // Close if the button has open class, otherwise open
    	if ( $(this).hasClass('search-btn-open') ) {
			searchClose();
		} else {
			searchOpen();
		}
	});

    // Close search if close button clicked
    $('#search-box').on( 'click', '.search-close', function(e){
        searchClose();
    });

    // Close search listener
    $('body').mouseup(function(e){
        // Set our search box container as a variable
        var search = $("#search-box");
        /**
         * If click is not on our search container
         * If click is not on a child of our search container
         * If click is not another link (stays open while new page opens)
         */
        if( e.target.id != search.attr('id') && ! search.has(e.target).length && ! $(e.target).closest('a').length ) {
            searchClose();
        }
    });

    // Helper function to open search form and add class to search button
    function searchOpen() {
		$('#search-btn').addClass('search-btn-open');
		$('#search-box').slideDown('fast', function() {
			$(this).find('input[type="search"]').focus();
		});
	}

    // Helper function to close search form and remove class to search button
	function searchClose() {
		$('#search-btn').removeClass('search-btn-open');
		$('#search-box').slideUp('fast');
	}

});