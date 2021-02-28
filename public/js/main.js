$(function(){
	$('.bxslider').bxSlider({
		pager:false,
	});
	
	// projects slider on home page
	$('#projects-slider').bxSlider({
		minSlides: 1,
		maxSlides: 4,
		slideWidth: 247,
		nextSelector: '#right-btn',
		prevSelector: '#left-btn',
		nextText: '<i class="fa fa-angle-right"></i>',
		prevText: '<i class="fa fa-angle-left"></i>',
		slideMargin: 15,
		pager: false,
	});
});
