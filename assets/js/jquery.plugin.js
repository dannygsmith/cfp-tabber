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

      console.log( $tabberContents );


      // wrap shortcodes with div wrapper
      $( '<div class="tabber-wrapper">' ).insertBefore( $( $tabberContainer ) );
      $( '</div>' ).insertAfter( $( $tabberContainer ) );
   };


   var clickHandler = function ( event ) {

      var index                 = $tabberTabs.index ( this ),  // current index
         k                      = 0,                           // var used as index into tabs
         length                 = $tabberTabs.length,          // number of tabs
         $hiddenContent         = $( $tabberContents[ index ].innerHTML );
         //isHiddenContentShowing = $tabberContents.is( ':visible' );

      console.log( $tabberTabs );

      // start by hiding all content
      for ( k = 0; k < length; k++ ) {
         // hide
         $( $tabberContents[ k ] ).css( "display", "none");
      }

      // display current content of selected tab
      $( $tabberContents[ index ] ).css( "display", "block");
   };

   /**
    * Get the index into the array
    */
   function getIndex( element ) {

   }

   /**
    * Get the singular content
    */
   function getContent( index ) {

   }

   $(document).ready(function () {
      init();
   });

})(jQuery, window, document);
