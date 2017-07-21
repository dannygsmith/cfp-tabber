;(function ($, window, document, undefined) {
   'use strict';

   var $tabberContainer;
   var $tabberTabs;      // array of cached tab labels
   var $tabberContents;  // array of cached contents
   var $theIcons;
   var j, k;

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

      j = 0;
      k = 0;

      var $tabbers = jQuery('.tabber--container .tabber--tab');

      for ( j = 0; j < $('.tabber--container').length; j++, k++ ) {
         $( $tabbers[ k ] ) .attr( 'id', 'tabber--tab-' + j );
      }

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
      var $tabber;
      var $tabberTab;
      var $tabberContent;
      var isTabberContentsShowing;
      var isMobile;
      var $wrapperId;
      var $iconElement;
      var showIcon;
      var hideIcon;
      $tabberContainer        = jQuery( '.tabber--container' );

      index                   = $tabberTabs.index ( this );  // current index
      $tabberContent          = $( $tabberContents[ index ] );
      $tabberTab              = $( '.tabber--tab.current--tab' );
      //$tabber                 = $( $tabberContainer[ index ] ).closest("dt").prop("id");
      isTabberContentsShowing = $tabberContent.is(':visible');
      isMobile                = Modernizr.mq( '( max-width: 767px )' );
      $wrapperId              = $( $tabberContents[ index ] ).closest("div").prop("id");
      //$tabber               = $( $tabber[ index ] ).closest("dl").prop("id");
      $iconElement            = $( $theIcons[ index ] );
      showIcon                = $iconElement.data( 'showIcon' );
      hideIcon                = $iconElement.data( 'hideIcon' );

      //var str = JSON.stringify( $tabber, null, 3 ); // (Optional) beautiful indented output.
      //console.log( 'str: ' + str )

      // Temporarily add class to the outer wrapper
      $( '#' + $wrapperId ).addClass( 'selected' );


      if ( isMobile ) { //  it is an accordion
         changeIcon( index, isTabberContentsShowing );

         // remove old content
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber-content--icon' ).removeClass( 'fa-caret-down' ).addClass( 'fa-caret-left' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).slideUp();

      } else {
         $tabber = $( '#' + $wrapperId + ' .tabber--tab.current--tab' ).closest("dt").prop("id");

         console.log( 'current: ' + '#' + $wrapperId + ' #' +  $tabber  );

         // remove old content
         jQuery( '#' + $tabber ).removeClass( 'current--tab' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).css( "display", "none");
      }

      jQuery( '.tabber--wrapper.selected .tabber--container.activated' ).removeClass( 'activated' );

      // activate new tab
      $( $tabberContainer[ $tabberTabs.index( this ) ] ).addClass( 'activated' );
      var $tabberId = $( '.tabber--wrapper.selected .tabber--container.activated .tabber--tab' ).closest("dt").prop("id");
      console.log( '$tabberId:  #' + $tabberId );


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

      //console.log ( 'isHiddenContentShowing: ' + isHiddenContentShowing );

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
