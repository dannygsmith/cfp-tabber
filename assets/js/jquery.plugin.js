;(function ($, window, document, undefined) {
   'use strict';

   var $tabberWrapper;
   var $tabberContainer;
   var $tabberTabs;      // array of cached tab labels
   var $tabberContents;  // array of cached contents
   var $theIcons;
   var $tabLength;
   var k;

   /**
    * Initializes all scripts via document ready function
    */
   var init = function () {
      $tabberContainer = jQuery( '.tabber--container' );
      $tabberTabs      = jQuery( '.tabber--tab' );
      $tabberContents  = $tabberTabs.next();
      $tabLength       = $tabberTabs.length;          // number of tabs
      $theIcons        = $tabberTabs.find( '.tabber-content--icon' );

      $tabberTabs.on( 'click',
         { contentType: 'tabber' },    // pass type
         clickHandler                  // named function
      );

      // strip <br /> out thank you wpautop!!!!!!!!
      $( 'br' ).remove();

      var $counter = 1;
      $( ':not( .tabber--container ) + .tabber--container, * > .tabber--container:first-of-type' ).
      each( function() {
         $( this ).
         nextUntil( ':not( .tabber--container )' ).
         addBack().
         wrapAll('<div class="tabber--wrapper" id="tabber--wrapper-' + $counter++ + '">');
      });

      for ( k = 0; k < $tabLength; k++ ) {

         var $wrapperId        = $( $tabberContents[ k ] ).closest( "div" ).prop( "id" );
         var $tabberTabs2      = jQuery( '#' + $wrapperId + ' .tabber--tab' );
         var index             = $tabberTabs2.index ( this );  // current index
         var $tabberContents2  = $tabberTabs2.next();
         var $theIcons         = $tabberTabs2.find('.tabber-content--icon');

         //console.log( "tabLength: " + $tabLength );
         //console.log( 'wrapperId: ' + $wrapperId );
         //console.log( $theIcons );

         // open first tab content on document ready
         $( $tabberContents2[ 0 ] ).css( "display", "block" );
         $( $theIcons[ index ] )
            .removeClass( $( $theIcons[ index ] ).data( 'showIcon' ) )
            .addClass(    $( $theIcons[ index ] ).data( 'hideIcon' ) );
      }
   };

   /**
    * Click event handler
    *
    * @param event
    */
   var clickHandler = function ( event ) {

      var index                   = $tabberTabs.index ( this ),  // current index
          $tabberContent          = $( $tabberContents[ index ] ),
          isTabberContentsShowing = $tabberContent.is(':visible'),
          k                       = 0,                           // var used as index into tabs
          length                  = $tabberTabs.length,          // number of tabs
          isMobile                = Modernizr.mq( '( max-width: 767px )' );

      //console.log( this );

      var $wrapperId        = $( $tabberContents[ index ] ).closest("div").prop("id");
      var $tabberTabs2      = jQuery( '#' + $wrapperId + ' .tabber--tab' );
      var tabLength         = $tabberTabs2.length;          // number of tabs
      var $tabberContents2  = $tabberTabs2.next();

      // start by hiding all content
      for ( k = 0; k < tabLength; k++ ) {

         // check for an accordion
         if ( isMobile ) {
            $( $tabberContents2[ k ] ).slideUp();

         } else {
            $( $tabberContents2[ k ] ).css( "display", "none");
         }
      }

      if ( isMobile ) { //  it is an accordion

         if ( isTabberContentsShowing ) {
            $( $tabberContents[ index ] ).slideUp();

         } else {
            $( $tabberContents[ index ] ).slideDown();
         }

         changeIcon( index, isTabberContentsShowing );

      } else {

         $( $tabberContents[ index ] ).css( "display", "block");
      }
   };


   /*******************
    * Helper Functions
    ******************/

   /**
    * Change the Icon Handler
    */
   function changeIcon( index, isTabberContentsShowing ) {
      $theIcons        = $tabberTabs.find('.tabber-content--icon');

      var $iconElement = $( $theIcons[ index ] ),
         show_icon     = $iconElement.data( 'showIcon' ),
         hide_icon     = $iconElement.data( 'hideIcon' ),
         length        = $tabberTabs.length,          // number of tabs
         removeClass,
         addClass,
         k;

      for ( k = 0; k < length; k++ ) {
         if ( $( $theIcons[ k ] ).data( 'showIcon' ) === 'fa fa-caret-left' ) {
            $( $theIcons[ k ] )
            .removeClass( $( $theIcons[ k ] ).data( 'hideIcon' ) )
            .addClass(    $( $theIcons[ k ] ).data( 'showIcon' ) );
         }
      }

      if ( isTabberContentsShowing ) {
         removeClass = hide_icon;
         addClass    = show_icon;

      } else {
         addClass    = hide_icon;
         removeClass = show_icon;
      }

      $iconElement
         .removeClass( removeClass )
         .addClass(    addClass    );
   }

   $(document).ready(function () {
      init();

   });

})(jQuery, window, document);