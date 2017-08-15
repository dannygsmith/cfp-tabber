;(function ( $, window, document, undefined ) {
   'use strict';

   document.body.className = document.body.className.replace( "no-js", "js" );

   var $tabberContainer = $( '.tabber--container' ),
      $tabberTabs = $( '.tabber--tab' ),
      $tabberContents = $tabberTabs.next();

   /**
    * Initializes all scripts via document ready function
    */
   var init = function () {
      var j = 0,
          k = 0;

      $tabberTabs.on( 'click',
         { contentType: 'tabber' },    // pass type
         clickHandler                  // named function
      );

      // strip <br /> out thank you wpautop!!!!!!!!
      //$( 'br' ).remove();

      // Wrap each contiguous tabber with a div wrapper
      $( ':not( .tabber--container ) + .tabber--container, * > .tabber--container:first-of-type' )
         .each( function ( $index ) {
            $( this ).nextUntil( ':not( .tabber--container )' ).addBack().wrapAll( '<div class="tabber--wrapper" id="tabber--wrapper-' + $index + '">' );
         } );

      var $tabbers = $( '.tabber--container .tabber--tab' );

      for ( j = 0; j < $( '.tabber--container' ).length; j++, k++ ) {
         $( $tabbers[k] ).attr( 'id', 'tabber--tab-' + j );
      }

      //  loops through each group of tabbers
      for ( var z = 0; z < $( 'div.tabber--wrapper' ).length; z++ ) {

         $( '#tabber--wrapper-' + z + ' .tabber--tab:first' ).trigger( 'click' );
      }
   };

   /**
    * Click event handler
    *
    * @param event
    */
   var clickHandler = function ( event ) {

      var $tabber,
          $wrapperId,
          index,
          isMobile,
          k;

      $tabberContainer = $( '.tabber--container' );
      index = $tabberTabs.index( this );  // current index
      isMobile = Modernizr.mq( '( max-width: 767px )' );
      $wrapperId = $( $tabberContents[index] ).closest( "div" ).prop( "id" );

      // Temporarily add class to the outer wrapper
      $( '#' + $wrapperId ).addClass( 'selected' );

      if ( isMobile ) { //  it is an accordion

         // remove old content
         $( '.tabber--wrapper.selected .tabber--container.activated .tabber-title--icon' ).removeClass( 'rotate-down' );
         $( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).slideUp();

      } else {
         $tabber = $( '#' + $wrapperId + ' .tabber--tab.current--tab' ).closest( "dt" ).prop( "id" );

         // remove old content
         $( '#' + $tabber ).removeClass( 'current--tab' );
         $( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).css( "display", "none" );
      }

      $( '.tabber--wrapper.selected .tabber--container.activated' ).removeClass( 'activated' );

      // activate new tab
      $( $tabberContainer[$tabberTabs.index( this )] ).addClass( 'activated' );
      var $tabberId = $( '.tabber--wrapper.selected .tabber--container.activated .tabber--tab' ).closest( "dt" ).prop( "id" );

      $( '.tabber--wrapper.selected .tabber--container.activated .tabber--tab' ).addClass( 'current--tab' );

      //  add a margin-bottom of 20px to each div wrapper to get around the absolute positioning
      // this only occurs when screen is greater than 768 or in tabber mode
      for ( k = 0; k < $( 'div.tabber--wrapper' ).length; k++ ) {

         var query = Modernizr.mq( '(min-width: 768px)' );
         if ( query ) {
            var wrapperIndex = '#tabber--wrapper-' + k;
            var wrapper = $( wrapperIndex + ' .tabber--tab.current--tab' ).next();
            var offset = wrapper.outerHeight( true );
            offset += 22;
            $( wrapperIndex ).css( 'margin-bottom', offset );
         } else {
            offset = 22;
         }
      }

      if ( isMobile ) { //  it is an accordion
         $( '.tabber--wrapper.selected .tabber--container.activated .tabber-title--icon' ).addClass( 'rotate-down' );

         $( $tabberContents[index] ).slideDown();
      } else {

         $( $tabberContents[index] ).css( "display", "block" );
      }

      // remove Temporarily class to the outer wrapper
      $( '#' + $wrapperId ).removeClass( 'selected' );
   };

   $( document ).ready( function () {
      init();

   } );

})( jQuery, window, document );
