;(function ($, window, document, undefined) {
   'use strict';

   $('#term-1').nextUntil('term3').andSelf().add('term1').wrapAll( '<div class="tabber-wrapper">' );
})(jQuery, window, document);

