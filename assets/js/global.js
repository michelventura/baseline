( function ( document, $, undefined ) {
	'use strict';

    $('#menu-toggle').sidr({
      name: 'sidr-right',
      side: 'right',
      source: '#mobile-menu',
      renaming: false,
    });

	// Add menu toggle button
	$( '.sidr .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to sub menus

    // Hide all sub menus
	$('.sidr .menu-item-has-children').children('.sub-menu').hide();

	// Show/hide the navigation
	$( '.sub-menu-toggle' ).on( 'click', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});
		// Add class to menu toggle when menu is dropped down
		$this.toggleClass( 'activated' );
		// Slide up or down the sub menu
		$this.next( '.sub-menu' ).slideToggle();
		// Find the closest top level menu item, then close the sub menu of all the siblings
		var $others = $this.closest( '.menu > .menu-item' ).siblings( '.menu-item' );
		$others.find( '.sub-menu-toggle' ).removeClass( 'activated' ).attr( 'aria-pressed', 'false' );
		$others.find( '.sub-menu' ).slideUp();

	});

})( this, jQuery );