jQuery(document).ready(function($){

	// SEARCH CLICK FUNCTION
	$('.search-toggle a').click(function(event){
		event.preventDefault();
		$('#searchform').slideToggle();
		$(this).toggleClass('active');
		$(this).children( 'i' ).toggleClass('fa-search fa-times');
	});

	// FLYOUT CLICK FUNCTION
	$('.toggle-nav').click(function(){
		$('.flyout-nav').animate({
            right:0
        }, 500, function(){
        });
	});

	// PAGE NAVIGATION SMOOTHSCROLL
  	$('.our-menus a').smoothScroll();

});