jQuery(document).ready(function($){

	$('.search a').click(function(event){
		event.preventDefault();
		$('#searchform').slideToggle();
		$(this).children( 'i' ).toggleClass('fa-search fa-times');
	});

});