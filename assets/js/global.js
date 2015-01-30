jQuery(function( $ ){

    $('#menu-toggle').sidr({
      name: 'sidr-right',
      side: 'right',
      source: '#mobile-menu',
      renaming: false,
    });

	$('.menu-item-has-children').children('.sub-menu').hide();

	$('.menu-item-has-children').click(function(){
		if (event.target !== this) {
			return;
		}
		$(this).children('.sub-menu').slideToggle(function() {
			$(this).parent().toggleClass('menu-open');
		});
		$(this).siblings('.menu-item').children('.sub-menu').slideUp(function() {
			$(this).parent().removeClass('menu-open');
		});
	});

});