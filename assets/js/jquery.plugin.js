;(function ($, window, document, undefined) {
   'use strict';

   var $tabberContainer;
   var $tabberTabs;      // array of cached tab labels
   var $tabberContents;  // array of cached contents
   var $theIcons;
   var k;

   /**
    * Initializes all scripts via document ready function
    */
   var init = function () {
      $tabberContainer = jQuery( '.tabber--container' );
      $tabberTabs      = jQuery( '.tabber--tab' );
      $tabberContents  = $tabberTabs.next();

      $tabberTabs.on( 'click',
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

      //  loops through each group of tabbers
      for ( k = 0; k < jQuery('div.tabber--wrapper').length; k++ ) {

         var $wrapperId        = $( $tabberContents[ k ] ).closest( "div" ).prop( "id" );
         var $tabberContainer2 = jQuery( '#tabber--wrapper-' + k + ' .tabber--container' );
         var $tabberTabs2      = jQuery( '#' + $wrapperId + ' .tabber--tab' );
         var index             = $tabberTabs2.index ( this );  // current index
         var $tabberContents2  = $tabberTabs2.next();
         var $theIcons         = $tabberTabs2.find('.tabber-content--icon');

         // open first tab content on load
         //$( $tabberContents[ index ] ).css( "display", "block");

         $( $theIcons[ index ] )
            .removeClass( $( $theIcons[ index ] ).data( 'showIcon' ) )
            .addClass(    $( $theIcons[ index ] ).data( 'hideIcon' ) );

         $( $tabberContainer2[ 0 ] ).addClass( 'activated' );
         $( $tabberContents2[ 0 ] ).css( "display", "block" );

         console.log( 'k: ' + k );
      }
   };

   /**
    * Click event handler
    *
    * @param event
    */
   var clickHandler = function ( event ) {

      var index;
      var $tabberContent;
      var isTabberContentsShowing;
      var isMobile;
      var $wrapperId;

      index                   = $tabberTabs.index ( this );  // current index
      $tabberContent          = $( $tabberContents[ index ] );
      isTabberContentsShowing = $tabberContent.is(':visible');
      isMobile                = Modernizr.mq( '( max-width: 767px )' );
      $wrapperId              = $( $tabberContents[ index ] ).closest("div").prop("id");

      // Temporarily add class to the outer wrapper
      $( '#' + $wrapperId ).addClass( 'selected' );

      if ( isMobile ) { //  it is an accordion

         // remove old content
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).slideUp();

      } else {
         // remove old content
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).css( "display", "none");
      }

      changeIcon( index, isTabberContentsShowing );

      jQuery( '.tabber--wrapper.selected .tabber--container.activated' ).removeClass( 'activated' );

      // activate new tab
      $( $tabberContainer[ $tabberTabs.index( this ) ] ).addClass( 'activated' );

      if ( isMobile ) { //  it is an accordion

         $( $tabberContents[ index ] ).slideDown();
      } else {

         $( $tabberContents[ index ] ).css( "display", "block");
      }

      changeIcon( index, isTabberContentsShowing );

      // remove Temporarily class to the outer wrapper
      $( '#' + $wrapperId ).removeClass( 'selected' );
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