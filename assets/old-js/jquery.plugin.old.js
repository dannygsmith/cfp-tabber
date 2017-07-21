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
      //$icons = $visibleContents.find('.collapsible-content--icon');
      $theIcons        = $tabberTabs.find('.tabber-content--icon');

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

      var j = 0;

      console.log( 'jQuery(".tabber--container").length: ' + jQuery(".tabber--container").length );
      for ( j = 0; j < $('.tabber--container').length; j++ ) {
         $('.tabber--container')[ k ].attr( 'id', 'tabber--container-' + j );
         console.log( 'j: ' + j );
      }
      //for ( var j = 0; j < jQuery('.tabber--container').length;  ) {
      //   $( '.tabber--container' ).attr( 'id', 'tabber--container-' + j++ );
      //}

      console.log( jQuery('.tabber--container').length );

      //  loops through each group of tabbers
      for ( k = 0; k < jQuery('div.tabber--wrapper').length; k++ ) {

         jQuery( '#tabber--wrapper-' + k + ' .tabber--tab:first' ).trigger('click');
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
      var $iconElement;
      var showIcon;
      var hideIcon;

      index                   = $tabberTabs.index ( this );  // current index
      $tabberContent          = $( $tabberContents[ index ] );
      isTabberContentsShowing = $tabberContent.is(':visible');
      isMobile                = Modernizr.mq( '( max-width: 767px )' );
      $wrapperId              = $( $tabberContents[ index ] ).closest("div").prop("id");
      $iconElement            = $( $theIcons[ index ] );
      showIcon                = $iconElement.data( 'showIcon' );
      hideIcon                = $iconElement.data( 'hideIcon' );

      // Temporarily add class to the outer wrapper
      $( '#' + $wrapperId ).addClass( 'selected' );

      if ( isMobile ) { //  it is an accordion
         changeIcon( index, isTabberContentsShowing );

         // remove old content
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber-content--icon' ).removeClass( 'fa-caret-down' ).addClass( 'fa-caret-left' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).slideUp();

      } else {

         // remove old content
         jQuery( '.tabber--wrapper .tabber--container.activated .tabber--tab.current--tab' ).removeClass( 'current--tab' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).css( "display", "none");
      }

      jQuery( '.tabber--wrapper.selected .tabber--container.activated' ).removeClass( 'activated' );

      // activate new tab
      $( $tabberContainer[ $tabberTabs.index( this ) ] ).addClass( 'activated' );
      jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--tab' ).addClass( 'current--tab' );

      if ( isMobile ) { //  it is an accordion

         $( $tabberContents[ index ] ).slideDown();
      } else {

         $( $tabberContents[ index ] ).css( "display", "block");
      }

      // remove Temporarily class to the outer wrapper
      $( '#' + $wrapperId ).removeClass( 'selected' );
   };


   /*******************
    * Helper Functions
    ******************/

   /**
    * Change the Icon Handler
    */
   function changeIcon( index, isHiddenContentShowing ) {
      var $iconElement = $( $theIcons[ index ] ),
         showIcon = $iconElement.data( 'showIcon' ),
         hideIcon = $iconElement.data( 'hideIcon' ),
         removeClass, addClass,
         isMobile = Modernizr.mq( '( max-width: 767px )' );

      console.log ( 'isHiddenContentShowing: ' + isHiddenContentShowing );

      if ( isHiddenContentShowing ) {
         addClass    = showIcon;
         removeClass = hideIcon;

      } else {
         addClass    = hideIcon;
         removeClass = showIcon;
      }

      $iconElement
         .removeClass( removeClass )
         .addClass(    addClass    );
   }


   $(document).ready(function () {
      init();

   });

})(jQuery, window, document);
