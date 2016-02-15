//(function ($, Drupal) {
jQuery(document).ready(function(){
  
  jQuery('.flexslider').flexslider({
    animation: "slides"
    
  });
  
  
  //
  jQuery(".view").each(function() {
	 var getCol=jQuery(this).find(".views-row").length; 
	 jQuery(this).addClass("col-"+getCol);
	});
  
  
  //
  jQuery('.btn-btt').smoothScroll({speed: 500});
  
  jQuery('#block-mipl-business-views-block-our-team-block-1-2 .view-content').slick({
      dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  });

  jQuery('#block-views-block-testimonials-block-1 .view-content').slick({
      dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  });



  })
  
  

//})(jQuery, Drupal);

