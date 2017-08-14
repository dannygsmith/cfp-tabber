<?php
/**
 * Tabber shortcodes's runtime configuration parameters.
 *
 * @package CampFirePixels\Module\Tabber\Shortcode
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Tabber\Shortcode;

return array (
   /**=================================================
    * Shortcode name [tabber]
    *==================================================*/
   'shortcode_name'              => 'tabber',

   /**=================================================
    * Specify if you want do_shortcode() to run on the
    * content between the shortcode opening and closing
    * brackets. Defaults to true.
    *==================================================*/
   'do_shortcode_within_content' => true,

   /**=================================================
    * Specify the processing function when you want
    * your code to handle the output buffer, view, and
    * processing.
    *==================================================*/
   'processing_function'         => __NAMESPACE__ . '\process_the_tabber_shortcode',

   /**=================================================
    * Paths to the view files
    *==================================================*/
   'view'                        => array (
      'container_single' => TABBER_MODULE_DIR . '/views/container.php',
      'container_topic'  => TABBER_MODULE_DIR . '/views/container.php',
      'tabber'           => TABBER_MODULE_DIR . '/views/tabber.php',
   ),

   /**=================================================
    * Defined shortcode default attributes.  Each is
    * overridable by the author.
    *==================================================*/
   'defaults'                    => array (
      'show_icon'               => 'fa fa-caret-left',
      'post_id'                 => 0,
      'topic'                   => '',
      'number_of_tabbers'       => -1,
      'show_none_found_message' => 1,
      'none_found_by_topic'     => __( 'Sorry, no Tabbers were found for that topic.', TABBER_MODULE_TEXT_DOMAIN ),
      'none_found_single'       => __( 'Sorry, no Tabber found.', TABBER_MODULE_TEXT_DOMAIN ),
   ),
);