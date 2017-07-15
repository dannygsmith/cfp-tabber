;(function ($, window, document, undefined) {
   'use strict';

   var $tabberContainer;
   var $tabberTabs;      // array of cached tab labels
   var $tabberContents;  // array of cached contents
   var $theIcons;

   /**
    * Initializes all scripts via document ready function
    */
   var init=function () {
      $tabberContainer = jQuery( '.tabber--container' );
      $tabberTabs      = jQuery( '.tabber--tab' );
      $tabberContents  = $tabberTabs.next();
      $theIcons        = $tabberTabs.find('.tabber-content--icon');

      $tabberTabs.on('click',
         { contentType: 'tabber' },    // pass type
         clickHandler                  // named function
      );

      // open first tab content on document ready
      var index = 0;
      $( $tabberContents[ index ] ).css( "display", "block");
      $( $theIcons[ index ] )
         .removeClass( $( $theIcons[ index ] ).data( 'showIcon' ) )
         .addClass(    $( $theIcons[ index ] ).data( 'hideIcon' ) );

      // wrap shortcodes with div wrapper
      $( $tabberContainer ).wrapAll( '<div class="tabber-wrapper">' );
   };

   var clickHandler = function ( event ) {

      var index                   = $tabberTabs.index ( this ),  // current index
          $tabberContent          = $( $tabberContents[ index ] ),
          isTabberContentsShowing = $tabberContent.is(':visible'),
          k                       = 0,                           // var used as index into tabs
          length                  = $tabberTabs.length,          // number of tabs
          query                   = Modernizr.mq( '( max-width: 767px )' );

      // start by hiding all content
      for ( k = 0; k < length; k++ ) {

         // check for an accordion
         if ( query ) {
            //changeIcon( index, isTabberContentsShowing );
            $( $tabberContents[ k ] ).slideUp();

         } else {
            $( $tabberContents[ k ] ).css( "display", "none");
         }
      }

      if ( query ) { //  it is an accordion

         if ( isTabberContentsShowing ) {
            $( $tabberContents[ index ] ).slideUp();
            //changeIcon( index, isTabberContentsShowing );

         } else {
            $( $tabberContents[ index ] ).slideDown();
            //changeIcon( index, isTabberContentsShowing );
         }

         changeIcon( index, isTabberContentsShowing );

      } else {
         $( $tabberContents[ index ] ).css( "display", "block");
      }

   };

   function changeIcon( index, isTabberContentsShowing ) {
      var $iconElement = $( $theIcons[ index ] ),
         show_icon     = $iconElement.data( 'showIcon' ),
         hide_icon     = $iconElement.data( 'hideIcon' ),
         length                  = $tabberTabs.length,          // number of tabs
         removeClass,
         addClass,
         k;
      //console.log( 'hello Danny!' );
      //console.log( $( $theIcons[ index ] ).data( 'showIcon' ) );
      for ( k = 0; k < length; k++ ) {
         //console.log(  $( $theIcons[ k ] ).data( 'showIcon' ) );

         if ( $( $theIcons[ k ] ).data( 'showIcon' ) === 'fa fa-caret-left' ) {
            $( $theIcons[ k ] )
            .removeClass( $( $theIcons[ k ] ).data( 'hideIcon' ) )
            .addClass(    $( $theIcons[ k ] ).data( 'showIcon' ) );
            //console.log(  $( $theIcons[ k ] ).data( 'showIcon' ) );

         }
      }

      if ( isTabberContentsShowing ) {
         //console.log( 'isTabberContentsShowing' );

         removeClass = hide_icon;
         addClass    = show_icon;

      } else {
         //console.log( 'not isTabberContentsShowing' );

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
