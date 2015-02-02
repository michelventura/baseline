( function() {
    var c = document.body.className;
    c = c.replace( /no-js/, 'js' );
    document.body.className = c;
})();

( function ( document, $, undefined ) {
	'use strict';

	// Main Navigation button
	$( '.title-area' ).before( '<button id="menu-toggle" aria-label="Navigation Menu" aria-pressed="false"><i class="fa fa-bars"></i></button>' ); // Add toggle to site-header

	// Mobile navigation
	$( '#menu-toggle' ).sidr( {
		name: 'sidr-right',
		side: 'right',
		source: '#mobile-menu',
		renaming: false,
	});

	// Add navigation contents
	$( '.sidr .sidr-append' ).after( BaselineVar.menu_open, BaselineVar.close, BaselineVar.search, BaselineVar.menu, BaselineVar.menu_close );

    // Hide all sub menus
	$( '.sidr .menu-item-has-children' ).children( '.sub-menu' ).hide();

	// Add a dropdown menu button
	$( '.sidr .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false" aria-label="Sub Navigation Menu"></button>' );

	// Aria-pressed settings for buttons
	$( '#menu-toggle, .menu-close, .sub-menu-toggle' ).on( 'click.menu-button', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});
	});

	// Show/hide submenus
	$( '.sub-menu-toggle' ).on( 'click.sub-menu-button', function() {

		var $this = $( this );
		$this.toggleClass( 'menu-open' );
		$this.next( '.sub-menu, .sub-menu' ).slideToggle( 'fast' );

		var $others = $this.closest( '.menu-item, .menu-item' ).siblings();
		$others.find( '.sub-menu-toggle' ).removeClass( 'menu-open' ).attr( 'aria-pressed', 'false' );
		$others.find( '.sub-menu, .sub-menu' ).slideUp( 'fast' );

	});

	// Close the navigation if close link is clicked
	$( '.menu-close' ).on( 'click', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});
		$.sidr('close','sidr-right');
	});

	// Close the menu if the window is resized larger
	$( window ).resize( function() {
		$.sidr( 'close', 'sidr-right' );
	});

})( this, jQuery );
