jQuery(function( $ ){

    $('#menu-toggle').sidr({
      name: 'sidr-right',
      side: 'right',
      source: '#mobile-menu',
      renaming: false,
    });

	$('.page_item_has_children').children('.children').hide();
	$('.menu-item-has-children').children('.sub-menu').hide();

	$(".page_item_has_children").click(function(){
		if (event.target !== this)
		return;
			$(this).children('.children').slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});
	$(".menu-item-has-children").click(function(){
		if (event.target !== this)
		return;
			$(this).children('.sub-menu').slideToggle(function() {
			$(this).parent().toggleClass("menu-open");
		});
	});

	// $('.sidr-class-page_item_has_children::after').click(function(event){
		// if (event.target !== this)
		// return;
			// $(this).find(".sidr-class-children").slideToggle(function() {
			// $(this).parent().toggleClass("menu-open");
		// });
	// });

});