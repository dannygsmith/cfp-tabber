<?php
/**
 * Process the shortcode
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

add_shortcode( 'tabber', __NAMESPACE__ . '\process_the_shortcode' );
/**
 * Process the Tabber Shortcode to build a list of Tabs.
 *
 * @since 1.0.0
 *
 * @param array|string $user_defined_attributes User defined attributes for this shortcode instance
 * @param string|null  $content                 Content between the opening and closing shortcode elements
 * @param string       $shortcode_name          Name of the shortcode
 *
 * @return string
 */
function process_the_shortcode( $user_defined_attributes, $content, $shortcode_name ) {
   $config = get_shortcode_configuration( $shortcode_name );

   $attributes = shortcode_atts(
      $config[ 'defaults' ],
      $user_defined_attributes,
      $shortcode_name
   );

   // do the processing
   $attributes['show_icon'] = esc_attr( $attributes['show_icon'] );

   if ( $content ) {
      $content = do_shortcode( $content ); // check for embedded shortcode
   }

   // Call the view file, capture it into the output buffer, and then return it.
   ob_start();
   include( $config[ 'view' ] );

   //d( $config );
   return ob_get_clean();
}

/**
 * Get the runtime configuration parameters for the specified shortcode.
 *
 * @since 0.1.0
 *
 * @param string $shortcode_name Name of the shortcode
 *
 * @return array
 */
function get_shortcode_configuration( $shortcode_name ) {
   $config = array (
      'view' => __DIR__ . '/views/' . $shortcode_name . '.php',
      'defaults' => array(
         'show_icon' => 'dashicons dashicons-arrow-down-alt2',
         'hide_icon' => 'dashicons dashicons-arrow-up-alt2',
      ),
   );

   if ( $shortcode_name == 'tabber' ) {
      $config[ 'defaults' ][ 'tab' ] = '';
   }

   return $config;
}