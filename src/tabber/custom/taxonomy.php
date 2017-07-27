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

add_action( 'init', __NAMESPACE__ . '\register_custom_taxonomy' );
/**
 * Register the taxonomy.
 *
 * @since 0.1.3
 *
 * @return void
 */
function register_custom_taxonomy() {
   $args = array(
      'label'             => __( 'Topics', TABBER_MODULE_TEXT_DOMAIN ),
      'labels'            => get_taxonomy_labels_config( 'Topic', 'Topics' ),
      'hierarchical'      => true,
      'show_admin_column' => true,
      //'show_ui'           => true,
   );

   register_taxonomy( 'topic', array( 'tabber' ), $args );
}

/**
 * Get the taxonomy labels configuration.
 *
 * @since 1.0.0
 *
 * @param string $singular_label
 * @param string $plural_label
 * @param string $menu_label Menu label (optional)
 *
 * @return array
 */
function get_taxonomy_labels_config( $singular_label, $plural_label, $menu_label = '' ) {

   if ( ! $menu_label ) {
      $menu_label = $plural_label;
   }

   return array(
      'name'                       => _x( $plural_label, 'taxonomy general name', TABBER_MODULE_TEXT_DOMAIN ),
      'singular_name'              => _x( $singular_label, 'taxonomy singular name', TABBER_MODULE_TEXT_DOMAIN ),
      'search_items'               => __( 'Search ' . $plural_label, TABBER_MODULE_TEXT_DOMAIN ),
      'popular_items'              => __( 'Popular ' . $plural_label, TABBER_MODULE_TEXT_DOMAIN ),
      'all_items'                  => __( 'All ' . $plural_label, TABBER_MODULE_TEXT_DOMAIN ),
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => __( 'Edit ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'view_item'                  => __( 'View ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'update_item'                => __( 'Update ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'add_new_item'               => __( 'Add New ' . $singular_label, TABBER_MODULE_TEXT_DOMAIN ),
      'new_item_name'              => __( "New {$singular_label} Name", TABBER_MODULE_TEXT_DOMAIN ),
      'separate_items_with_commas' => __( "Separate {$plural_label} with commas", TABBER_MODULE_TEXT_DOMAIN ),
      'add_or_remove_items'        => __( "Add or remove {$plural_label}", TABBER_MODULE_TEXT_DOMAIN ),
      'choose_from_most_used'      => __( "Choose from the most used {$plural_label}", TABBER_MODULE_TEXT_DOMAIN ),
      'not_found'                  => __( "No {$plural_label} found.", TABBER_MODULE_TEXT_DOMAIN ),
      'menu_name'                  => $menu_label,
   );
}