<?php
/**
 * The default shortcode runtime configuration parameters.
 *
 * @package CampFirePixels\Module\Custom
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Custom;

return array (

   /**=================================================
    * Shortcode name, the name within the square brackets
    *==================================================*/
   'shortcode_name'              => '',

   /**=================================================
    * Specify if you want do_shortcode() to run on the
    * content between the shortcode opening and closing
    * brackets. Defaults to true.
    *==================================================*/
   'do_shortcode_within_content' => true,

   /**=================================================
    * Specify the processing function when you want
    * your code to handle the output buffer, view, and
    * processing. Defaults to null.
    *==================================================*/
   'processing_function'         => null,

   /**=================================================
    * The absolute path to the view file. If more than
    * one, use an array of view files.
    *==================================================*/
   'view'                        => '',

   /**=================================================
    * Defined shortcode default attributes.  Each is
    * overridable by the author.
    *==================================================*/
   'defaults'                    => array (),
);
