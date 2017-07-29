;(function ($, window, document, undefined) {
   'use strict';

   document.body.className = document.body.className.replace("no-js","js");

   var $tabberContainer = jQuery( '.tabber--container' );
   var $tabberTabs      = jQuery( '.tabber--tab' );
   var $tabberContents  = $tabberTabs.next();

   /**
    * Initializes all scripts via document ready function
    */
   var init = function () {
      var j = 0
      var k = 0;

      $tabberTabs.on(   'click',
         { contentType: 'tabber' },    // pass type
         clickHandler                  // named function
      );

      // strip <br /> out thank you wpautop!!!!!!!!
      $( 'br' ).remove();

      // Wrap each contiguous tabber with a div wrapper
      var $counter = 0;
      $( ':not( .tabber--container ) + .tabber--container, * > .tabber--container:first-of-type' ).
      each( function() {
         $( this ).
         nextUntil( ':not( .tabber--container )' ).
         addBack().
         wrapAll('<div class="tabber--wrapper" id="tabber--wrapper-' + $counter++ + '">');
      });

      var $tabbers = jQuery('.tabber--container .tabber--tab');

      for ( j = 0; j < $('.tabber--container').length; j++, k++ ) {
         $( $tabbers[ k ] ) .attr( 'id', 'tabber--tab-' + j );
      }

      //  loops through each group of tabbers
      for ( var z = 0; z < jQuery('div.tabber--wrapper').length; z++ ) {

         jQuery( '#tabber--wrapper-' + z + ' .tabber--tab:first' ).trigger('click');
      }
   };

   /**
    * Click event handler
    *
    * @param event
    */
   var clickHandler = function ( event ) {

      var $tabber;
      var $wrapperId;
      var index;
      var isMobile;
      var k;

      $tabberContainer        = jQuery( '.tabber--container' );
      index                   = $tabberTabs.index ( this );  // current index
      isMobile                = Modernizr.mq( '( max-width: 767px )' );
      $wrapperId              = $( $tabberContents[ index ] ).closest("div").prop("id");

      // Temporarily add class to the outer wrapper
      $( '#' + $wrapperId ).addClass( 'selected' );

      if ( isMobile ) { //  it is an accordion

         // remove old content
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber-title--icon' ).removeClass( 'rotate-down' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).slideUp();

      } else {
         $tabber = $( '#' + $wrapperId + ' .tabber--tab.current--tab' ).closest("dt").prop("id");

         // remove old content
         jQuery( '#' + $tabber ).removeClass( 'current--tab' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).css( "display", "none");
      }

      jQuery( '.tabber--wrapper.selected .tabber--container.activated' ).removeClass( 'activated' );

      // activate new tab
      $( $tabberContainer[ $tabberTabs.index( this ) ] ).addClass( 'activated' );
      var $tabberId = $( '.tabber--wrapper.selected .tabber--container.activated .tabber--tab' ).closest("dt").prop("id");

      jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--tab' ).addClass( 'current--tab' );

      //  add a margin-bottom of 20px to each div wrapper to get around the absolute positioning
      // this only occurs when screen is greater than 768 or in tabber mode
      for ( k = 0; k < jQuery('div.tabber--wrapper').length; k++ ) {

         var query = Modernizr.mq('(min-width: 768px)');
         if ( query ) {
            var wrapperIndex = '#tabber--wrapper-' + k;
            var wrapper = jQuery( wrapperIndex + ' .tabber--tab.current--tab' ).next();
            var offset = wrapper.outerHeight(true);
            offset += 22;
            jQuery( wrapperIndex ).css( 'margin-bottom', offset );         }
      }

      if ( isMobile ) { //  it is an accordion
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber-title--icon' ).addClass( 'rotate-down' );

         $( $tabberContents[ index ] ).slideDown();
      } else {

         $( $tabberContents[ index ] ).css( "display", "block");
      }

      // remove Temporarily class to the outer wrapper
      $( '#' + $wrapperId ).removeClass( 'selected' );
   };

   $(document).ready(function () {
      init();

   });

})(jQuery, window, document);
