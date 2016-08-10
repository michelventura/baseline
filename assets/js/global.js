/*!
 * Swap out no-js for js body class
 */
( function() {
    var c = document.body.className;
    c = c.replace( /no-js/, 'js' );
    document.body.className = c;
})();

/*!
 * Sidr all the things
 */
( function ( document, $, undefined ) {
	'use strict';

	// Main menu toggle button
	$( '.title-area' ).after( '<button id="menu-toggle"><span class="fa fa-bars" aria-hidden="true"></span><span class="screen-reader-text">Menu</span></button>' );

	// Initiate side menu
	$( '#menu-toggle' ).sidr({
		name: 'side-menu',
		side: 'right',
		renaming: false,
		// displace: false,
		onOpen: function() {
			// Set aria-pressed is true
			$( '#menu-toggle' ).attr( 'aria-pressed', function() {
				return 'true';
			});
		},
		onClose: function() {
			// Set aria-pressed to false
			$( '#menu-toggle' ).attr( 'aria-pressed', function() {
				return 'false';
			});
		},
	});

    // Hide all sub menus
	$( '.sidr .menu-item-has-children' ).children( '.sub-menu' ).hide();

	// Add a dropdown menu button
	$( '.sidr .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false" aria-label="Sub Menu Button"><span class="screen-reader-text">Sub Menu Button</span></button>' );

	// Aria-pressed settings for buttons
	$( '.sub-menu-toggle' ).on( 'click.menu-button', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});
	});

	// Show/hide submenus
	$( '.sub-menu-toggle' ).on( 'click.sub-menu-button', function() {

		// Set our variable for this button click
		var $this = $( this );
		// Aria-pressed settings for buttons
		$this.attr( 'aria-pressed', function( index, value ) {
			return 'false' === value ? 'true' : 'false';
		});
		// Toggle .menu-open class if open
		$this.toggleClass( 'menu-open' );
		// Toggle .sub-menu
		$this.next( '.sub-menu' ).slideToggle( 'fast' );
		// Set our variable for other menu items
		var $others = $this.closest( '.menu-item' ).siblings();
		// Remove .menu-open class and slide up all sub-menus
		$others.find( '.sub-menu-toggle' ).removeClass( 'menu-open' ).attr( 'aria-pressed', 'false' );
		$others.find( '.sub-menu' ).slideUp( 'fast' );

	});

	// Close the navigation if close link is clicked
	$( '.menu-close' ).on( 'click', function() {
		var $this = $( this );
		$this.attr( 'aria-pressed', function() {
			return 'false';
		});
		$.sidr( 'close' , 'side-menu' );
	});

	// Close the menu if the window is resized larger
	$( window ).resize( function() {
		if( window.innerWidth > 800 ) {
			$.sidr( 'close', 'side-menu' );
		}
	});

})( this, jQuery );
