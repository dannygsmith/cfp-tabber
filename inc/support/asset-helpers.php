<?php
/**
 * Description
 *
 * @package CampFirePixels\${MY_NAMESPACE}
 * @since   1.0.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

//namespace CampFirePixels\${MY_NAMESPACE};


/**
 * Description
 *
 * @since 0.1.0
 *
 * @return bool
 */
function get_theme_versions() {

   if ( site_is_in_debug_mode() ) {
      $stylesheet = get_stylesheet_directory() . '/style.css';

      return filemtime( $stylesheet );
   }

   return '1.3';
}

/**
 * Checks if site is in development/debug mode.
 *
 * @since 0.1.0
 *
 * @return bool
 */
function site_is_in_debug_mode() {
   // check for live site
   if ( ! defined( 'SCRIPT_DEBUG') ) {
       return false;
   }

   return( (bool) 'SCRIPT_DEBUG' === true );
}