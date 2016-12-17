jQuery(document).ready(function($){

	// SEARCH CLICK FUNCTION
	$('.search a').click(function(event){
		event.preventDefault();
		$('#searchform').slideToggle();
		$(this).children( 'i' ).toggleClass('fa-search fa-times');
	});

	// FLYOUT CLICK FUNCTION
	$('.toggle-nav').click(function(){
		$('.flyout-nav').animate({
            right:0
        }, 500, function(){
        });
	});

	// PAGE NAVIGATION SCROLL
  	$('.our-menus a').click(function(){
    	var $link = $(this).attr('href');
      	$("html, body").animate({ scrollTop: $($link).offset().top }, 600);
      	return false;
  	});

});