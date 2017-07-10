<?php
/**
 * Description
 *
 * @package CampFirePixels\Tabber
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 *
 *  [tabber tab="First Tab"]The performance of this processor ...[/tabber]
 *
 */

namespace CampFirePixels\Tabber;

add_shortcode( 'tabber', 'process_the_tabber_shortcode' );
/**
 * Process the Tabber Shortcode to build a list of Tabs.
 *
 * @since 1.0.0
 *
 * @param array|string $user_defined_attributes User defined attributes for this shortcode instance
 * @param string|null $content Content between the opening and closing shortcode elements
 * @param string $shortcode_name Name of the shortcode
 *
 * @return string
 */
function process_the_tabber_shortcode( $user_defined_attributes, $content, $shortcode_name ) {
   $attributes = shortcode_atts(
      array(
         'number_of_tabs' => 4,
         'class'          => '',
      ),
      $user_defined_attributes,
      $shortcode_name
   );

   // do the processing

   // Call the view file, capture it into the output buffer, and then return it.
   ob_start();
   include( __DIR__ . '/views/tabber.php' );
   return ob_get_clean();
}