<?php
/**
 * Tabber Shortcode Processing
 *
 * @package CampFirePixels\Module\Tabber\Shortcode;
 * @since   0.1.3
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Tabber\Shortcode;

add_shortcode( 'tabbers', __NAMESPACE__ . '\process_the_shortcode' );
/**
 * Process the Tabbers Shortcode to build a list of Tabbers.
 *
 * @since 0.1.3
 *
 * @param array|string $user_defined_attributes User defined attributes for this shortcode instance
 * @param string|null  $content                 Content between the opening and closing shortcode elements
 * @param string       $shortcode_name          Name of the shortcode
 *
 * @return string
 */
function process_the_shortcode( $user_defined_attributes, $content, $shortcode_name ) {
   $config = get_shortcode_configuration();

   $attributes = shortcode_atts(
      $config[ 'defaults' ],
      $user_defined_attributes
   );

   //ddd( $attributes );

   if ( !$attributes[ 'topic' ] ) {
      return '';
   }

   $attributes[ 'show_icon' ] = esc_attr( $attributes[ 'show_icon' ] );

   // Call the view file, capture it into the output buffer, and then return it.
   ob_start();

   render_topic_tabbers( $attributes, $config );

   return ob_get_clean();
}

/**
 * Render the Topic Tabbers.
 *
 * @since 0.1.3
 *
 * @param array $attributes
 * @param array $config
 *
 * @return string
 */
function render_topic_tabbers( array $attributes, array $config ) {

   $config_args = array (
      'posts_per_page' => (int)$attributes[ 'number_of_tabbers' ],
      'nopaging'       => true,
      'post_type'      => 'tabber',
      'tax_query'      => array (
         array (
            'taxonomy' => 'topic',
            'field'    => 'slug',
            'terms'    => $attributes[ 'topic' ],
         ),
      ),
   );

   $query = new \WP_Query( $config_args );

   if ( !$query->have_posts() ) {

      return render_none_found_message( $attributes );

   }

   include( $config[ 'views' ][ 'container_topic' ] );

   wp_reset_postdata();
}

function loop_and_render_tabbers_by_topic( \WP_Query $query, array $attributes, array $config ) {

   while ( $query->have_posts() ) {
      $query->the_post();

      $post_title     = get_the_title();
      $post_content   = do_shortcode( get_the_content() );
      include( $config[ 'views' ][ 'tabbers' ] );
   }
}

/**
 * Render "none found" message handler.
 *
 * @since 1.0.0
 *
 * @param array $attributes
 *
 * @return void
 */
function render_none_found_message( array $attributes ) {

   if ( !$attributes[ 'show_none_found_message' ] ) {
      return;
   }

   $message = $attributes[ 'none_found_by_topic' ];
   echo "<p>{$message}</p>";
}

/**
 * Get the runtime configuration parameters for the specified shortcode.
 *
 * @since 0.1.3
 *
 * @param string $shortcode_name Name of the shortcode
 *
 * @return array
 */
function get_shortcode_configuration() {
   return array (
      'views'    => array (
         'container_topic' => __DIR__ . '/views/container-topic.php',
         'tabbers'         => __DIR__ . '/views/tabber.php',
      ),
      'defaults' => array (
         'show_icon'               => 'dashicons dashicons-arrow-down-alt2',
         'post_id'                 => 0,
         'topic'                   => '',
         'number_of_tabbers'       => -1,
         'show_none_found_message' => 1,
         'none_found_by_topic'     => __( 'Sorry, no Tabbers were found for that topic.', TABBER_MODULE_TEXT_DOMAIN ),
      ),
   );
}
