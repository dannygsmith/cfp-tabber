;(function ($, window, document, undefined) {
   'use strict';

   var $tabberContainer;
   var $tabberTabs;      // array of cached tab labels
   var $tabberContents;  // array of cached contents

   /**
    * Initializes all scripts via document ready function
    */
   var init=function () {
      $tabberContainer = jQuery( '.tabber--container' );
      $tabberTabs      = jQuery( '.tabber--tab' );
      $tabberContents  = $tabberTabs.next();

      $tabberTabs.on('click',
         { contentType: 'tabber' },    // pass type
         clickHandler                  // named function
      );

      // open first tab content on document ready
      var index = 0;
      $( $tabberContents[ index ] ).css( "display", "block");

      // wrap shortcodes with div wrapper
      $( $tabberContainer ).wrapAll( '<div class="tabber-wrapper">' );
   };

   var clickHandler = function ( event ) {

      var index                 = $tabberTabs.index ( this ),  // current index
          k                     = 0,                           // var used as index into tabs
          length                = $tabberTabs.length;          // number of tabs

      // start by hiding all content
      for ( k = 0; k < length; k++ ) {
         // hide

         if ( isMobile() === true) {
            $( $tabberContents[ k ] ).slideUp();

         } else {
            $( $tabberContents[ k ] ).css( "display", "none");
         }
      }

      if ( isMobile() === true ) {
         // display current content of selected tab
         $($tabberContents[index]).slideDown();

      } else {
         $( $tabberContents[ index ] ).css( "display", "block");
      }
   };

   //Function to the css rule
   function isMobile() {

      if ( window.matchMedia( '(max-width: 767px)' ).matches ) {
         //console.log ( true );
         return true;

      } else {
         //console.log ( false );
         return false;
      }
   }

   $(document).ready(function () {
      init();
   });

})(jQuery, window, document);
