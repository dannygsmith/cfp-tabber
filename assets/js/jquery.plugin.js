;(function ($, window, document, undefined) {
   'use strict';

   var $tabberTabs;      // array of cached tab labels
   var $tabberContents;  // array of cached contents

   /**
    * Initializes all scripts via document ready function
    */
   var init=function () {
      $tabberTabs=$('.tabber---tab');
      $tabberContents=$tabberTabs.next();
      $tabberTabs.on('click',
         {contentType: 'tabber'},   // pass type
         clickHandler);             // named function
   };

   var clickHandler=function (event) {
      console.log(event);
   };

   /**
    * Get the singular tab
    */
   function getTab() {

   }

   /**
    * Get the singular content
    */
   function getContent() {

   }

   $(document).ready(function () {
      init();
   });

})(jQuery, window, document);
