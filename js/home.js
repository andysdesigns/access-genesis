jQuery(function( $ ){
	
    $('.home-full-featured-container .wrap') .css({'height': (($(window).height()))+'px'});
    $(window).resize(function(){
        $('.home-full-featured-container .wrap') .css({'height': (($(window).height()))+'px'});
    });
    
	
});