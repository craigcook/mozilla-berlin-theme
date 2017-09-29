jQuery(document).ready(function () {
	(function ($) {

		/**********
        / Slider 
        / Slick Slider
        **********/
		$('.toggle-nav').click(function () {
			$('.nav-wrappper').toggleClass('active')
		});


		$(document).ready(function () {
			$('.slider-featured').slick({
				dots: true,
				centerMode: true,
				centerPadding: '140px',
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							
						}
    				},
					{
						breakpoint: 764,
						settings: {
							centerPadding: '0px',
							arrows: false
						}
					}
  				]
			});

			$('.slider-products').slick({
				slidesToShow: 4,
				slidesToScroll: 4,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						}
    				},
					{
						breakpoint: 764,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					}
  				]
			});

			$('.page-slider').slick({
				slidesToShow: 3,
				slidesToScroll: 3,
                arrows: false,
                dots: true,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						}
    				},
					{
						breakpoint: 764,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					}
  				]
			});

			$('.page-slider-large').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
                arrows: true,
                dots: false
			});
		});
		
		$('.slider-featured').on('afterChange', function(event, slick, currentSlide, nextSlide){
			$(this).find('.slide').each(function(){
				$(this).removeClass('ani');
				if ( $(this).hasClass('slick-current') ){
					$(this).addClass('ani');
				}
			});
			$('iframe').each(function(){
				$(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
			});
			$('.vimeo').each(function(){
				var vimeoWrap = $(this);
   				vimeoWrap.html( vimeoWrap.html() );
			});
		});

		$('.filter li').click(function () {
			var filter = $(this).data('filter');

			$('.slider-products-wrapper').each(function () {
				$(this).removeClass('active');
			});
			$('#' + filter).toggleClass('active');

			$('.filter li').each(function () {
				$(this).removeClass('active');
			});
			$(this).addClass('active');

			$('.slider-products').slick('unslick');

			$('.slider-products').slick({
				slidesToShow: 4,
				slidesToScroll: 4,
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						}
    				},
					{
						breakpoint: 764,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					}
  				]
			});

		});
        
        /**********
        / Homepage 
        / More People Animation
        **********/
        
        $('.show-more-people').click(function() {
			$('.more-people').toggleClass('active');
			$(this).toggleClass('active');
		});
        
        /**********
        / Experts (white) 
        / More Text Animation
        **********/
		
		$('.show-more-wrapper').click(function() {
			if ( $(this).hasClass('active') ) {
				$(this).removeClass('active');
				$(this).parent('.overlay').css('height','180px');
			} else {
				$(this).addClass('active');
				$(this).parent('.overlay').css('height','auto');
			}
		});
		
		function experts() {
			if( window.innerWidth < 992) {
				$('.expert-row').each(function(){
					$(this).find('.column').css('margin-top','0');
					$(this).find('.expert-wrapper').css('margin-right','0');
					$(this).find('.expert-wrapper').css('margin-left','0');
				});
			} else if( window.innerWidth < 1240 ) {
				$('.expert-row').each(function(){
					var margin_top = $(this).find('.column').data('margintop');
					var margin_left = $(this).find('.expert-wrapper').data('marginleft');
					var margin_right = $(this).find('.expert-wrapper').data('marginright');
					$(this).find('.column').css('margin-top',margin_top/1.5+'px');
					$(this).find('.expert-wrapper').css('margin-left',+margin_left/1.5+'px');
					$(this).find('.expert-wrapper').css('margin-right',+margin_right/1.5+'px');
				});
			} else {
				$('.expert-row').each(function(){
					var margin_top = $(this).find('.column').data('margintop');
					var margin_left = $(this).find('.expert-wrapper').data('marginleft');
					var margin_right = $(this).find('.expert-wrapper').data('marginright');
					$(this).find('.column').css('margin-top',margin_top+'px');
					$(this).find('.expert-wrapper').css('margin-left',+margin_left+'px');
					$(this).find('.expert-wrapper').css('margin-right',+margin_right+'px');
				});
			}
		}
		
		experts();
		window.addEventListener('resize', function(event){
			experts();
		});
		
        /**********
        / Language Switch 
        / 
        **********/
		
		$('#lang-select').on('change', function () {
			var url = $(this).val(); // get selected value
			if (url) { // require a URL
            	window.location = url; // redirect
			}
			return false;
    	});


	})(jQuery);


});