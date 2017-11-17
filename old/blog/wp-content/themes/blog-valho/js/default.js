$(document).ready(function() {
	
	

  
  
  $('#carousel-depoimentos').owlCarousel({
    autoplay:true,
    margin:15,
	smartSpeed:1200,
	//autoplayTimeout:100,
	loop:true,
	dotsEach: true,
	
    nav:false,
	
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:2
        }
    }
})



$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});


 $(".phone").mask("(99) 9999-9999");

  $('.carousel-data').owlCarousel({

    margin:15,

	
    nav:true,
	dots:false,
	loop:true,
	navText: ["←", "→"],
	
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        1000:{
            items:5
        }
    }
})
  
  
  
  

  
	});