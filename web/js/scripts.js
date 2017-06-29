;(function($) {

"use strict";

var $body = $('body');
// var $head = $('head');
// var $mainWrapper = $('#main-wrapper');

$(document).ready(function () {

	/* -------------------------------------------------------------------------
    SELECT BOX 
  ------------------------------------------------------------------------- */
  $.fn.uouSelectBox = function() {

    var self = $(this),
      select = self.find('select');
    self.prepend('<ul class="select-clone custom-list"></ul>');

    var selected = select.find('option:selected').text();
    //alert();
    var placeholder = select.data('placeholder') ? select.data('placeholder') : select.find('option:eq(0)').text(),
      clone = self.find('.select-clone');
    self.prepend('<input class="value-holder" type="text" disabled="disabled" value="'+selected+'" placeholder="' + placeholder + '"><i class="fa fa-sort arrow-down"></i>');
    var value_holder = self.find('.value-holder');

    // INPUT PLACEHOLDER FIX FOR IE
    if ($.fn.placeholder) {
      self.find('input, textarea').placeholder();
    }

    // CREATE CLONE LIST
    select.find('option').each(function() {
      if ($(this).attr('value')) {
        clone.append('<li data-value="' + $(this).val() + '">' + $(this).text() + '</li>');
      }
    });

    // TOGGLE LIST
    self.click(function() {
    	//alert('hi');
      var media_query_breakpoint = uouMediaQueryBreakpoint();
     // if (media_query_breakpoint > 991) {
        clone.slideToggle(100);
        self.toggleClass('active');
      //}
    });

    // CLICK
    clone.find('li').click(function() {
    	 $("#hotel_search_checkIn").focus();
      value_holder.val($(this).text());
      select.find('option[value="' + $(this).attr('data-value') + '"]').attr('selected', 'selected');

      // IF LIST OF LINKS
      if (self.hasClass('links')) {
        window.location.href = select.val();
      }

    });
    

    // HIDE LIST
    self.bind('clickoutside', function(event) {
      clone.slideUp(100);
    });

    // LIST OF LINKS
    if (self.hasClass('links')) {
      select.change(function() {
        window.location.href = select.val();
      });
    }

  };

  /* -------------------------------------------------------------------------
    MEDIA QUERY BREAKPOINT
  ------------------------------------------------------------------------- */
  var uouMediaQueryBreakpoint = function() {

    if ($('#media-query-breakpoint').length < 1) {
      $('body').append('<var id="media-query-breakpoint"><span></span></var>');
    }
    var value = $('#media-query-breakpoint').css('content');
    if (typeof value !== 'undefined') {
      value = value.replace("\"", "").replace("\"", "").replace("\'", "").replace("\'", "");
      if (isNaN(parseInt(value, 10))) {
        $('#media-query-breakpoint span').each(function() {
          value = window.getComputedStyle(this, ':before').content;
        });
        value = value.replace("\"", "").replace("\"", "").replace("\'", "").replace("\'", "");
      }
      if (isNaN(parseInt(value, 10))) {
        value = 1199;
      }
    } else {
      value = 1199;
    }
    return value;

  };

  /* -------------------------------------------------------------------------
    PRICE FILTER
  ------------------------------------------------------------------------- */
  $( '.slider-range-container' ).each(function(){
    if ( $.fn.slider ) {

      var self = $(this),
      slider = self.find( '.slider-range' ),
      min = slider.data( 'min' ) ? slider.data( 'min' ) : 100,
      max = slider.data( 'max' ) ? slider.data( 'max' ) : 2000,
      step = slider.data( 'step' ) ? slider.data( 'step' ) : 100,
      default_min = slider.data( 'default-min' ) ? slider.data( 'default-min' ) : 100,
      default_max = slider.data( 'default-max' ) ? slider.data( 'default-max' ) : 500,
      currency = slider.data( 'currency' ) ? slider.data( 'currency' ) : '$',
      input_from = self.find( '.range-from' ),
      input_to = self.find( '.range-to' );

      input_from.val( currency + ' ' + default_min );
      input_to.val( currency + ' ' + default_max );

      slider.slider({
        range: true,
        min: min,
        max: max,
        step: step,
        values: [ default_min, default_max ],
        slide: function( event, ui ) {
          input_from.val( currency + ' ' + ui.values[0] );
          input_to.val( currency + ' ' + ui.values[1] );
        }
      });

    }
  });

  /* -------------------------------------------------------------------------
    DATEPICKER 
  ------------------------------------------------------------------------- */
  
  
  
  $('.calendar').each(function() {

    var input = $(this).find('input'),
      dateformat = input.data('dateformat') ? input.data('dateformat') : 'm/d/y',
      icon = $(this).find('.fa'),
      widget = input.datepicker('widget');
      
      var id = input.attr('id');
     if(id=='hotel_search_checkIn'){
    	 input.datepicker({
	      dateFormat: "dd/mm/yy",
	      numberOfMonths: 2,
	      minDate: 0,
	      beforeShow: function() {
	        input.addClass('active');
	      },
	      onSelect: function(t) {
	          var a = $("#hotel_search_checkIn").datepicker("getDate");
	          a.setDate(a.getDate() + 1);
	          $("#hotel_search_checkOut").datepicker("option", "minDate", a);
	          $("#hotel_search_checkOut").focus();
	      },
	      onClose: function() {
	        input.removeClass('active');
	        // TRANSPLANT WIDGET BACK TO THE END OF BODY IF NEEDED
	        widget.hide();
	        if (!widget.parent().is('body')) {
	          widget.detach().appendTo($('body'));
	        }
	      }
	    });
     }else{
    	 input.datepicker({
    	      dateFormat: "dd/mm/yy",
    	      numberOfMonths: 2,
    	      minDate: 0,
    	      beforeShow: function() {
    	        input.addClass('active');
    	      },
    	      onClose: function() {
    	        input.removeClass('active');
    	        // TRANSPLANT WIDGET BACK TO THE END OF BODY IF NEEDED
    	        widget.hide();
    	        if (!widget.parent().is('body')) {
    	          widget.detach().appendTo($('body'));
    	        }
    	      }
    	    });
     }
    icon.click(function() {
      input.focus();
    });

  });
  

  /* -------------------------------------------------------------------------
    TOGGLE
  ------------------------------------------------------------------------- */
  $.fn.uouToggle = function(){
    var self = $(this),
    title = self.find( '.toggle-title' ),
    content = self.find( '.toggle-content' );
    title.click(function(){
      self.toggleClass( 'closed' );
      content.slideToggle(400);
    });
  };
  
  // NAVBAR TOGGLE
  $( '.toggleMenu' ).click(function(){
    $( '.navbar-nav' ).slideToggle(300);
  });

  /* -------------------------------------------------------------------------
    HEADER BOOKING
  ------------------------------------------------------------------------- */

  $( '.header-booking' ).each(function(){

    var self = $(this),
    form_holder = self.find( '.booking-form' ),
    btn = self.find( '.header-btn' );

    // TOGGLE
    btn.click(function(){
      self.find( '.header-btn' ).toggleClass( 'hover' );
      form_holder.stop( true, true ).slideToggle(200);
    });

    // HIDE LIST
    self.bind('clickoutside', function(event) {
      form_holder.slideUp(100);
      btn.removeClass('hover');
    });

  });

  /* -------------------------------------------------------------------------
		HEADER LOGIN
	------------------------------------------------------------------------- */

	$( '.header-login' ).each(function(){

		var self = $(this),
		form_holder = self.find( '.header-form' ),
		btn = self.find( '.header-btn' );

		// TOGGLE
		btn.click(function(){
				self.find( '.header-btn' ).toggleClass( 'hover' );
				form_holder.stop( true, true ).slideToggle(200);
		});

    // HIDE LIST
    self.bind('clickoutside', function(event) {
      form_holder.slideUp(100);
      btn.removeClass('hover');
    });

	});

  /* -------------------------------------------------------------------------
    HEADER LANGUAGE
  ------------------------------------------------------------------------- */

  $( '.header-social' ).each(function(){

    var self = $(this);
    var form_holder = self.find( '.header-nav' );
    var btn = self.find( '.header-btn' );

    // TOGGLE
    btn.click(function(){
      self.find( '.header-btn' ).toggleClass( 'hover' );
      form_holder.stop( true, true ).slideToggle(200);
    });

    // HIDE LIST
    self.bind('clickoutside', function(event) {
      form_holder.slideUp(100);
      btn.removeClass('hover');
    });

  });

	/* -------------------------------------------------------------------------
    HEADER MENU
  ------------------------------------------------------------------------- */
  $( '.header-menu' ).each(function(){

    var self = $(this),
    form_holder = self.find( '.navbar-nav' ),
    btn = self.find( '.header-btn' );

    // TOGGLE
    btn.click(function(){
      self.find( '.header-btn' ).toggleClass( 'hover' );
      form_holder.stop( true, true ).slideToggle(200);
    });

    // HIDE LIST
    self.bind('clickoutside', function(event) {
      form_holder.slideUp(100);
      btn.removeClass('hover');
    });

  });

  $('.navbar-nav').each(function() {

    var self = $(this);

    // HOVER SUBMENU
    self.find('li.has-submenu').hover(function() {
      if (media_query_breakpoint > 991) {
        $(this).addClass('hover');
        $(this).find('> ul').stop(true, true).fadeIn(200);
      }
    }, function() {
      if (media_query_breakpoint > 991) {
        $(this).removeClass('hover');
        $(this).find('> ul').stop(true, true).delay(10).fadeOut(200);
      }
    });

  });

/* -------------------------------------------------------------------------
    CHECKBOX INPUT
  ------------------------------------------------------------------------- */
  $.fn.uouCheckboxInput = function(){

    var self = $(this),
    input = self.find( 'input' );

    // INITIAL STATE
    if ( input.is( ':checked' ) ) {
      self.addClass( 'active' );
    }
    else {
      self.removeClass( 'active' );
    }

    // CHANGE STATE
    input.change(function(){
      if ( input.is( ':checked' ) ) {
        self.addClass( 'active' );
      }
      else {
        self.removeClass( 'active' );
      }
    });

  };

  /* -------------------------------------------------------------------------
    MAPS
  ------------------------------------------------------------------------- */

  // MAP ROOM
  $("#map").gmap3({
    marker: {
      values: [{
        latLng: [44.28952958093682, 6.152559438984804],
        options: {
            icon: "img/marker.png"
        }
    }, ],
    },
    map:{
      options:{
        zoom:6,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        navigationControl: true,
        scrollwheel: true,
        streetViewControl: true
      }
    }
  });

  // MAP LOCATIONS
  $("#location-map").gmap3({
    marker: {
      values: [{
        latLng: [44.28952958093682, 6.152559438984804],
        options: {
            icon: "img/marker.png"
        }
    }, ],
    },
    map:{
      options:{
        zoom:6,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        navigationControl: false,
        scrollwheel: false,
        streetViewControl: true,
        styles: [{
          featureType: "all",
          elementType: "all",
          stylers: [
            {"saturation":-800},{"lightness":25},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}
          ]
        }]
      }
    }
  });

  // MAP CONTACT
  $("#contact-map").gmap3({
    marker: {
      values: [{
        latLng: [44.28952958093682, 6.152559438984804],
        options: {
            icon: "img/marker.png"
        }
    }, ],
    },
    map:{
      options:{
        zoom:6,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        navigationControl: false,
        scrollwheel: false,
        streetViewControl: true,
        styles: [{
          featureType: "all",
          elementType: "all",
          stylers: [
            {"saturation":-800},{"lightness":25},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}
          ]
        }]
      }
    }
  });

  $('.contact-box, #contact-map').matchHeight();

  /* -------------------------------------------------------------------------
    TABS
  ------------------------------------------------------------------------- */
  $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
  });

  /* -------------------------------------------------------------------------
    GENERAL
  ------------------------------------------------------------------------- */
  // GET ACTUAL MEDIA QUERY BREAKPOINT
  var media_query_breakpoint = uouMediaQueryBreakpoint();

  // SELECT BOX
  $( '.select-box' ).each(function(){
    $(this).uouSelectBox();
  });

  // TOGGLES
  $( '.toggle-container' ).each(function(){
    $(this).uouToggle();
  });

  // CHECKBOX INPUT
  $( '.checkbox-input' ).each(function(){
    $(this).uouCheckboxInput();
  });

  $('#room .sidebar, #room .room-content').matchHeight();

  // TESTIMONIALS SLIDER
  $("#owl-testimonials").owlCarousel({
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true
  });

  // TESTIMONIALS SLIDER
  $(".thumbnail-slider").owlCarousel({
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true,
    navigation: true,
    navigationText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
    ]
  });

  // HEADER BG SLIDER
  $(".background-slider").owlCarousel({
    slideSpeed: 300,
    paginationSpeed: 400,
    singleItem: true,
    navigation: true,
    navigationText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
    ]
  });

  $("#clients-slider").owlCarousel({
		items: 5,
		navigation: false,
    autoPlay: true
	});

  $(".background-slider .owl-item").each(function(){
    $(this).css("height",  $("#banner .background-slider, .header-slider .background-slider").height());
  });

  // BACKGROUND FOR EACH SLIDE
  $( '.background-slider' ).each(function(){

    var self = $(this),
    images = self.find( '.owl-item' );

    // SET BG IMAGES
    images.each(function(){
      var img =  $(this).find( 'img' );
      if ( img.length > 0 ) {
        $(this).css( 'background-image', 'url(' + img.attr( 'src' ) + ')' );
        img.hide();
      }
    });
  });

  // BACKGROUND FOR EACH SLIDE
  $( '.supertabs .tab-content' ).each(function(){

    var self = $(this),
    images = self.find( '.tab-pane' );

    // SET BG IMAGES
    images.each(function(){
      var img =  $(this).find( 'img' );
      if ( img.length > 0 ) {
        $(this).css( 'background-image', 'url(' + img.attr( 'src' ) + ')' );
        img.hide();
      }
    });
  });
  
  // SUPERTABS
  $(".supertabs .tab-content, .supertabs .tab-navigation ul, .supertabs .tab-pane").each(function(){
    $(this).css("height",  $(".supertabs .tab-navigation").height());
  });

  $(window).resize(function(){
    if ( uouMediaQueryBreakpoint() !== media_query_breakpoint ) {
      media_query_breakpoint = uouMediaQueryBreakpoint();
      $('.navbar-nav').removeAttr( 'style' );
    }

   /* $(".background-slider .owl-item").each(function(){
      $(this).css("height",  $("#banner .background-slider, .header-slider .background-slider").height());
    });*/
  });


});


/* -------------------------------------------------------------------------
BANNER
------------------------------------------------------------------------- */

$('#banner .banner-bg').each(function() {

var self = $(this),
  images = self.find('.banner-bg-item');

// SET BG IMAGES
images.each(function() {
  var img = $(this).find('img');
  if (img.length > 0) {
    $(this).css('background-image', 'url(' + img.attr('src') + ')');
    img.hide();
  }
});

// INIT SLIDER
if ($.fn.owlCarousel) {
  self.owlCarousel({
    slideSpeed: 300,
    pagination: true,
    navigation: true,
    paginationSpeed: 400,
    singleItem: true,
    navigationText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ],
    addClassActive: true,
    afterMove: function() {
      // ACTIVATE TAB
      var active_index = self.find('.owl-item.active').index();
      $('.banner-search-inner .tab-title:eq(' + active_index + ')').trigger('click');
    }
  });
}

// SET DEFAULT IF NEEDED
var active_tab_index = $('.banner-bg-item.active, .banner-search-inner .tab-title.active').index();
if (active_tab_index !== 0) {
  self.trigger('owl.jumpTo', active_tab_index);
}

});

$('.banner-search-inner').each(function() {

var self = $(this),
  tabs = self.find('.tab-title'),
  contents = self.find('.tab-content');

// TAB CLICK
tabs.click(function() {
  if (!$(this).hasClass('active')) {
    var index = $(this).index();
    tabs.filter('.active').removeClass('active');
    $(this).addClass('active');
    contents.filter('.active').hide().removeClass('active');
    contents.filter(':eq(' + index + ')').fadeToggle().addClass('active');

    // CHANGE BG
    if ($.fn.owlCarousel) {
      $('#banner .banner-bg').trigger('owl.goTo', index);
    }

  }
});

});



// Touch
// ---------------------------------------------------------
var dragging = false;

$body.on('touchmove', function() {
	dragging = true;
});

$body.on('touchstart', function() {
	dragging = false;
});



}(jQuery));
