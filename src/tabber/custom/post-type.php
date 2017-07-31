<?php
/**
 * Description
 *
 * @package CampFirePixels\Module\Tabber;
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Tabber;

add_action( 'init', __NAMESPACE__ . '\register_custom_post_type' );
/**
 * Register the custom post type.
 *
 * @since 0.1.3
 *
 * @return void
 *
 * https://www.billerickson.net/code/wp_query-arguments/
 */
function register_custom_post_type() {

   $features = get_all_post_type_features( 'post', array (
      'excerpt',
      'comments',
      'trackbacks',
      'custom-fields',
      'thumbnail',
      //'author'
   ) );

   $features[] = 'page-attributes';

   $args = array (
      'description' => 'CampFirePixels Responsive Tabbers',
      'label'       => __( 'Tabber', TABBER_MODULE_TEXT_DOMAIN ),
      'labels'      => get_post_type_labels_config( 'tabber', 'Tabber', 'Tabbers' ),
      'public'      => true,
      'supports'    => $features,
      'menu_icon'   => 'dashicons-index-card',
      'has_archive' => true,
   );
   register_post_type( 'tabber', $args );
}

/**
 * Get the post type labels configuration.
 *
 * @link  http://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @since 0.1.3
 *
 * @param string $post_type
 *
 * @param string $singular_label
 *
 * @param string $plural_label
 *
 * @return array
 */
function get_post_type_labels_config( $post_type, $singular_label, $plural_label ) {
   return ( array (
      'name'               => _x( $plural_label, 'post type general name', TABBER_MODULE_TEXT_DOMAIN ),
      'singular_name'      => _x( $singular_label, 'post type singular name', TABBER_MODULE_TEXT_DOMAIN ),
      'menu_name'          => _x( $plural_label, 'admin menu', TABBER_MODULE_TEXT_DOMAIN ),
      'name_admin_bar'     => _x( $singular_label, 'add new on admin bar', TABBER_MODULE_TEXT_DOMAIN ),
      'add_new'            => _x( 'Add New', $post_type, TABBER_MODULE_TEXT_DOMAIN ),
      'add_new_item'       => __( 'Add New ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'new_item'           => __( 'New ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'edit_item'          => __( 'Edit the ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'view_item'          => __( 'View ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'all_items'          => __( 'All ' . $plural_label, TABBER_MODULE_TEXT_DOMAIN ),
      'search_items'       => __( 'Search ' . $plural_label, TABBER_MODULE_TEXT_DOMAIN ),
      'parent_item_colon'  => __( 'Parent ' . $plural_label . ':', TABBER_MODULE_TEXT_DOMAIN ),
      'not_found'          => __( 'No ' . $plural_label . ' found.', TABBER_MODULE_TEXT_DOMAIN ),
      'not_found_in_trash' => __( 'No ' . $plural_label . ' found in Trash.', TABBER_MODULE_TEXT_DOMAIN )
   ) );
}

/**
 * Get all the post type features for the given post type.
 *
 * @since 0.1.3
 *
 * @param string $post_type        Given post type
 * @param array  $exclude_features Array of features to exclude
 *
 * @return array
 */
function get_all_post_type_features( $post_type = 'post', $exclude_features = array () ) {
   $configured_features = get_all_post_type_supports( $post_type );

   if ( !$exclude_features ) {
      return array_keys( $configured_features );
   }

   $features = array ();

   foreach ( $configured_features as $feature => $value ) {
      if ( in_array( $feature, $exclude_features ) ) {
         continue;
      }

      $features[] = $feature;
   }

   return $features;
}