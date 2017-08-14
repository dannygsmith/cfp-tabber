<?php
/**
 * Description
 *
 * @package CampFirePixels\Tabber\Shortcode;
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Tabber\Shortcode;

return array (

   /**=================================================
    * Shortcode name [tab]
    *==================================================*/
   'shortcode_name' => 'tab',

   /**=================================================
    * Paths to the view files
    *==================================================*/
   'view'           => TABBER_DIR . 'src/shortcode/views/tab.php',

   /**=================================================
    * Defined shortcode default attributes.  Each is
    * overridable by the author.
    *==================================================*/
   'defaults'       => array (
      'show_icon' => 'fa fa-caret-left',
      'title'     => '',
   ),
);
