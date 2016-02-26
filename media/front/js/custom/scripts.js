$(document).ready(function() {
	if($(".container_top_slideshow").length > 0) {
		$(".container_top_slideshow").owlCarousel({
			navigation : true,
			pagination: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			navigationText: false,
			singleItem: true			
		});
	}

	
	if($('.leftbar_images_slider').length > 0) {
		$(".leftbar_images_slider").owlCarousel({
			navigation : false,
			pagination: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			navigationText: false,
			singleItem: true			
		});
	}

	if($('.news_slider').length > 0) {
		$(".news_slider").owlCarousel({
			navigation : false,
			pagination: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			navigationText: false,
			singleItem: true			
		});
	}

	if($('.tournament_slider').length > 0) {
		$(".tournament_slider").owlCarousel({
			navigation : true,
			pagination: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			navigationText: false,
			singleItem: true,
			afterInit : attachEvent
		});
	}

	if($('.shooter_slider').length > 0) {
		$(".shooter_slider").owlCarousel({
			navigation : true,
			pagination: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			navigationText: false,
			singleItem: true,
			afterInit : attachEvent
		});
	}

	function attachEvent(elem){
		elem.parent().find('.tournament_slider_next').on('click',function(){
			elem.trigger('owl.next')
		})

		elem.parent().find('.tournament_slider_prev').on('click',function(){
			elem.trigger('owl.prev')
		})
	} 		

	if($('.carousel_slider').length) {
		$('.carousel_slider').owlCarousel({
			//autoPlay: 3000,
			items : 3,
			navigation : false,
			pagination: true,
			navigationText: false,
			responsive: false
		});
	}		

	if($('.leftbar_images_slider_item').length && $('.content_middle_slider_item').length) {			
		var $container = ['.leftbar_images_slider_item', '.content_middle_slider_item'];
		var itemSelector = ['.leftbar_slider_images', '.content_slider_images'];

		$container.forEach(function(item, key) {
			$(item).imagesLoaded(function(){
		    	$(item).masonry({
		        	itemSelector: itemSelector[key],
		        	columnWidth: 1
		      	});
		    });
		});		    
	}		


	if($(".content_middle_slider").length > 0) {
		$(".content_middle_slider").owlCarousel({
			navigation : false,
			pagination: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			navigationText: false,
			singleItem: true			
		});
	}

})