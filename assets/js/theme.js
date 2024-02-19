
jQuery(document).ready(function($) {
//--------------------- / search category -------------------------//  
    jQuery('#catsearch').ddslick(); 
    // tooltips on hover
  $('[data-toggle="tooltip"]').tooltip();  
//--------------------- / Slider  -------------------------//  
$('#nivoparrallax').nivoSlider({
  slices: 15,
          boxCols: 8,
          boxRows: 4,
          startSlide: 0,
          controlNavThumbs: false,
          pauseOnHover: true,
          manualAdvance: false,
           prevText: '<i class="fa fa-long-arrow-left icon left"></i>',
          nextText: '<i class="fa fa-long-arrow-right icon"></i>',
          effect: 'fade',
          animSpeed: 500,
          pauseTime: 30000,
          controlNav:1,
          directionNav: 1,
  });
 /**** end slider function*****/ 
    /* featured product */
$('.featured-prodcuts,.latest-prodcuts,.related-prodcuts,.our-team-inner').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:12
         }
         , 768: {
             items: 3,
             margin:16
         }
         , 992: {
             items: 4,
             margin:16
         }
         , 1200: {
             items: 4
         }
     }
     , margin: 29, //padding: 10 
 });
    
    /* featured product home 2 */
$('.featured-prodcuts2,.special-products,.related-prodcuts2').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:12
         }
         , 768: {
             items: 2,
             margin:16
         }
         , 992: {
             items: 3,
             margin:16
         }
         , 1200: {
             items: 3
         }
     }
     , margin: 29, //padding: 10 
 });
    
    
   /* our  product */
$('.our-product').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:12
         }
         , 768: {
             items: 3,
             margin:16
         }
         , 992: {
             items: 4,
             margin:16
         }
         , 1200: {
             items: 4
         }
     }
     , margin: 29, //padding: 10 
 });  
    /* our  product 2 */
$('.our-product2').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:12
         }
         , 768: {
             items: 2,
             margin:16
         }
         , 992: {
             items: 3,
             margin:16
         }
         , 1200: {
             items: 3
         }
     }
     , margin: 29, //padding: 10 
 });  
   /* bestsale  product */
$('.bestsale-prodcuts').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:12
         }
         , 768: {
             items: 3,
             margin:16
         }
         , 992: {
             items: 4,
             margin:16
         }
         , 1200: {
             items: 4
         }
     }
     , margin: 29, //padding: 10 
 });  
 
 
  /* Latest blog   */
$('.latest-blog').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:12
         }
         , 768: {
             items: 2,
             margin:16
         }
         , 992: {
             items: 3,
             margin:16
         }
         , 1200: {
             items: 3
         }
     }
     , margin: 30, //padding: 10 
 });  
 
    
  /* testimonial    */
$('.testimonial-slide').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
            items: 1
         }
         , 480: {
             items: 1
         }
         , 768: {
             items: 1
         }
         , 992: {
             items: 1
         }
         , 1200: {
             items: 1
         }
     }
     , margin: 0, //padding: 10 
 });  
    
/* brand    */
$('#brand-logo').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 2
         }
         , 480: {
             items: 4,
                margin:12
         }
         , 768: {
             items: 5,
             margin:16
         }
         , 992: {
             items: 6,
             margin:15
         }
         , 1200: {
             items: 6
         }
     }
     , margin:15, //padding: 10 
 });  

   
/* brand    */
$('.toprate-product,.mostview-product').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
           items: 2,
           margin:12
         }
         , 768: {
             items: 1,
         }
         , 992: {
             items: 1,
         }
         , 1200: {
             items: 1
         }
     }
     , margin:0, //padding: 10 
 });  



 if (window.matchMedia('(min-width: 992px)').matches) {
     /* light box */
$('a.button-search').magnificPopup({
		type: 'iframe'
	});
jQuery("#zoom_image").elevateZoom({
cursor: 'crosshair',
        borderColour:"#e4dddd",
        zoomType: "window",
        lensShape : "round",
        lensSize    : 200,
        lensOpacity:0,
        gallery:'more',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        easing: false,
        loadingIcon: "../image/loader.gif"
});
};
/* light box */
$('.colorbox').magnificPopup({
type:'image',
        delegate: 'a',
        gallery: {
        enabled:true
        }
});
/* thamvanil products */
 // start brand logo functin
$('#more').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 3
         }
         , 480: {
             items: 3
         }
         , 768: {
             items: 3
         }
         , 992: {
             items: 3
         }
         , 1200: {
             items: 3
         }
     }
          , margin: 6 //padding: 10 
 });
 /* related product leftsidebar */
    $('.related-prodcuts2').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
              margin: 12
         }
         , 768: {
             items: 3,
              margin: 16
             
         }
         , 992: {
             items: 3,
             margin: 16
         }
         , 1200: {
             items: 3
         }
     }
          , margin: 29 //padding: 10 
 });
 /* related product leftsidebar */
    $('.related-prodcuts3').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
              margin: 12
         }
         , 768: {
             items: 3,
               margin: 16
             
         }
         , 992: {
             items: 3,
             margin: 16
         }
         , 1200: {
             items: 3
         }
     }
          , margin: 29 //padding: 10 
 });

/* mobile menu */
$('.toggle-icon').click(function(e) {
    if ($('.mobile-main-menu').is(":hidden")) {
       $('.mobile-main-menu').fadeIn("fast");
    } else {
        $('.mobile-main-menu').fadeOut("fast");
    }
    return false;
});  
//--------------------- list view show -------------------------// 

$("#listview").click(function(){
    $("#products-grid").fadeOut("slow");
   $("#products-list").fadeIn("slow");
});
$("#gridview").click(function(){
    $("#products-grid").fadeIn("slow");
   $("#products-list").fadeOut("slow");
});

//--------------------- / list view show -------------------------//  
   
   $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#top-buttom').fadeIn();
        } else {
            $('#top-buttom').fadeOut();
        }
    });
    //Click event to scroll to top
    $('#top-buttom').click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });   
});

// end brand logo functin