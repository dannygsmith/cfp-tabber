;(function ($, window, document, undefined) {
   'use strict';

   document.body.className = document.body.className.replace("no-js","js");

   var $tabberContainer;
   var $tabberContents;  // array of cached contents
   var $tabberTabs;      // array of cached tab labels
   var $theIcons;
   var j;
   var k;

   /**
    * Initializes all scripts via document ready function
    */
   var init = function () {
      $tabberContainer = jQuery( '.tabber--container' );
      $tabberTabs      = jQuery( '.tabber--tab' );
      $theIcons        = $tabberTabs.find('.tabber-content--icon');
      $tabberContents  = $tabberTabs.next();

      $tabberTabs.on(   'click',
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

      console.log( $theIcons );

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

      var $iconElement;
      var $tabber;
      var $tabberContent;
      var $tabberTab;
      var $wrapperId;
      var hideIcon;
      var index;
      var isMobile;
      var isTabberContentsShowing;
      var showIcon;

      $tabberContainer        = jQuery( '.tabber--container' );
      index                   = $tabberTabs.index ( this );  // current index
      $tabberContent          = $( $tabberContents[ index ] );
      $tabberTab              = $( '.tabber--tab.current--tab' );
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

         //transform: rotate( '45deg' );

         // remove old content
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber-content--icon' ).removeClass( 'fa-caret-down' ).addClass( 'fa-caret-left' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).slideUp();

      } else {
         $tabber = $( '#' + $wrapperId + ' .tabber--tab.current--tab' ).closest("dt").prop("id");

         // remove old content
         jQuery( '#' + $tabber ).removeClass( 'current--tab' );
         jQuery( '.tabber--wrapper.selected .tabber--container.activated .tabber--content' ).css( "display", "none");
      }

      jQuery( '.tabber--wrapper.selected .tabber--container.activated' ).removeClass( 'activated' );

      // activate new tab
      $( $tabberContainer[ $tabberTabs.index( this ) ] ).addClass( 'activated' );
      var $tabberId = $( '.tabber--wrapper.selected .tabber--container.activated .tabber--tab' ).closest("dt").prop("id");

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

/*! modernizr 3.5.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-cssvhunit-cssvwunit-flexbox-flexboxtweener-hovermq-inlinesvg-matchmedia-mediaqueries-pointermq-setclasses !*/
!function(e,n,t){function r(e,n){return typeof e===n}function i(){var e,n,t,i,o,s,a;for(var l in _)if(_.hasOwnProperty(l)){if(e=[],n=_[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(i=r(n.fn,"function")?n.fn():n.fn,o=0;o<e.length;o++)s=e[o],a=s.split("."),1===a.length?Modernizr[a[0]]=i:(!Modernizr[a[0]]||Modernizr[a[0]]instanceof Boolean||(Modernizr[a[0]]=new Boolean(Modernizr[a[0]])),Modernizr[a[0]][a[1]]=i),w.push((i?"":"no-")+a.join("-"))}}function o(e){var n=S.className,t=Modernizr._config.classPrefix||"";if(T&&(n=n.baseVal),Modernizr._config.enableJSClass){var r=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(r,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),T?S.className.baseVal=n:S.className=n)}function s(n,t,r){var i;if("getComputedStyle"in e){i=getComputedStyle.call(e,n,t);var o=e.console;if(null!==i)r&&(i=i.getPropertyValue(r));else if(o){var s=o.error?"error":"log";o[s].call(o,"getComputedStyle returning null, its possible modernizr test results are inaccurate")}}else i=!t&&n.currentStyle&&n.currentStyle[r];return i}function a(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):T?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function l(e,n){if("object"==typeof e)for(var t in e)b(e,t)&&l(t,e[t]);else{e=e.toLowerCase();var r=e.split("."),i=Modernizr[r[0]];if(2==r.length&&(i=i[r[1]]),"undefined"!=typeof i)return Modernizr;n="function"==typeof n?n():n,1==r.length?Modernizr[r[0]]=n:(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=n),o([(n&&0!=n?"":"no-")+r.join("-")]),Modernizr._trigger(e,n)}return Modernizr}function u(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function f(){var e=n.body;return e||(e=a(T?"svg":"body"),e.fake=!0),e}function d(e,t,r,i){var o,s,l,u,d="modernizr",c=a("div"),p=f();if(parseInt(r,10))for(;r--;)l=a("div"),l.id=i?i[r]:d+(r+1),c.appendChild(l);return o=a("style"),o.type="text/css",o.id="s"+d,(p.fake?p:c).appendChild(o),p.appendChild(c),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(n.createTextNode(e)),c.id=d,p.fake&&(p.style.background="",p.style.overflow="hidden",u=S.style.overflow,S.style.overflow="hidden",S.appendChild(p)),s=t(c,e),p.fake?(p.parentNode.removeChild(p),S.style.overflow=u,S.offsetHeight):c.parentNode.removeChild(c),!!s}function c(e,n){return!!~(""+e).indexOf(n)}function p(e,n){return function(){return e.apply(n,arguments)}}function h(e,n,t){var i;for(var o in e)if(e[o]in n)return t===!1?e[o]:(i=n[e[o]],r(i,"function")?p(i,t||n):i);return!1}function m(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function v(n,r){var i=n.length;if("CSS"in e&&"supports"in e.CSS){for(;i--;)if(e.CSS.supports(m(n[i]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var o=[];i--;)o.push("("+m(n[i])+":"+r+")");return o=o.join(" or "),d("@supports ("+o+") { #modernizr { position: absolute; } }",function(e){return"absolute"==s(e,null,"position")})}return t}function g(e,n,i,o){function s(){f&&(delete O.style,delete O.modElem)}if(o=r(o,"undefined")?!1:o,!r(i,"undefined")){var l=v(e,i);if(!r(l,"undefined"))return l}for(var f,d,p,h,m,g=["modernizr","tspan","samp"];!O.style&&g.length;)f=!0,O.modElem=a(g.shift()),O.style=O.modElem.style;for(p=e.length,d=0;p>d;d++)if(h=e[d],m=O.style[h],c(h,"-")&&(h=u(h)),O.style[h]!==t){if(o||r(i,"undefined"))return s(),"pfx"==n?h:!0;try{O.style[h]=i}catch(y){}if(O.style[h]!=m)return s(),"pfx"==n?h:!0}return s(),!1}function y(e,n,t,i,o){var s=e.charAt(0).toUpperCase()+e.slice(1),a=(e+" "+q.join(s+" ")+s).split(" ");return r(n,"string")||r(n,"undefined")?g(a,n,i,o):(a=(e+" "+L.join(s+" ")+s).split(" "),h(a,n,t))}function C(e,n,r){return y(e,t,t,n,r)}var w=[],_=[],x={_version:"3.5.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){_.push({name:e,fn:n,options:t})},addAsyncTest:function(e){_.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=x,Modernizr=new Modernizr;var S=n.documentElement,T="svg"===S.nodeName.toLowerCase();Modernizr.addTest("inlinesvg",function(){var e=a("div");return e.innerHTML="<svg/>","http://www.w3.org/2000/svg"==("undefined"!=typeof SVGRect&&e.firstChild&&e.firstChild.namespaceURI)});var b;!function(){var e={}.hasOwnProperty;b=r(e,"undefined")||r(e.call,"undefined")?function(e,n){return n in e&&r(e.constructor.prototype[n],"undefined")}:function(n,t){return e.call(n,t)}}(),x._l={},x.on=function(e,n){this._l[e]||(this._l[e]=[]),this._l[e].push(n),Modernizr.hasOwnProperty(e)&&setTimeout(function(){Modernizr._trigger(e,Modernizr[e])},0)},x._trigger=function(e,n){if(this._l[e]){var t=this._l[e];setTimeout(function(){var e,r;for(e=0;e<t.length;e++)(r=t[e])(n)},0),delete this._l[e]}},Modernizr._q.push(function(){x.addTest=l});var z=function(){var n=e.matchMedia||e.msMatchMedia;return n?function(e){var t=n(e);return t&&t.matches||!1}:function(n){var t=!1;return d("@media "+n+" { #modernizr { position: absolute; } }",function(n){t="absolute"==(e.getComputedStyle?e.getComputedStyle(n,null):n.currentStyle).position}),t}}();x.mq=z,Modernizr.addTest("mediaqueries",z("only all")),Modernizr.addTest("hovermq",z("(hover)")),Modernizr.addTest("pointermq",z("(pointer:coarse),(pointer:fine),(pointer:none)"));var P=x.testStyles=d;P("#modernizr { height: 50vh; }",function(n){var t=parseInt(e.innerHeight/2,10),r=parseInt(s(n,null,"height"),10);Modernizr.addTest("cssvhunit",r==t)}),P("#modernizr { width: 50vw; }",function(n){var t=parseInt(e.innerWidth/2,10),r=parseInt(s(n,null,"width"),10);Modernizr.addTest("cssvwunit",r==t)});var E="Moz O ms Webkit",q=x._config.usePrefixes?E.split(" "):[];x._cssomPrefixes=q;var j=function(n){var r,i=prefixes.length,o=e.CSSRule;if("undefined"==typeof o)return t;if(!n)return!1;if(n=n.replace(/^@/,""),r=n.replace(/-/g,"_").toUpperCase()+"_RULE",r in o)return"@"+n;for(var s=0;i>s;s++){var a=prefixes[s],l=a.toUpperCase()+"_"+r;if(l in o)return"@-"+a.toLowerCase()+"-"+n}return!1};x.atRule=j;var L=x._config.usePrefixes?E.toLowerCase().split(" "):[];x._domPrefixes=L;var N={elem:a("modernizr")};Modernizr._q.push(function(){delete N.elem});var O={style:N.elem.style};Modernizr._q.unshift(function(){delete O.style}),x.testAllProps=y,x.testAllProps=C,Modernizr.addTest("flexbox",C("flexBasis","1px",!0)),Modernizr.addTest("flexboxtweener",C("flexAlign","end",!0));var R=x.prefixed=function(e,n,t){return 0===e.indexOf("@")?j(e):(-1!=e.indexOf("-")&&(e=u(e)),n?y(e,n,t):y(e,"pfx"))};Modernizr.addTest("matchmedia",!!R("matchMedia",e)),i(),o(w),delete x.addTest,delete x.addAsyncTest;for(var A=0;A<Modernizr._q.length;A++)Modernizr._q[A]();e.Modernizr=Modernizr}(window,document);