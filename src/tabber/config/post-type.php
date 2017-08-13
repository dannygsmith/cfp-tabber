<?php
/**
 * Runtime configuration for the Tabber custom post type.
 *
 * @package CampFirePixels\Module\Tabber\Custom;
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Tabber;

return array (
   /**=====================================
    * The post type name.
    *======================================*/
   'post_type' => 'tabber',

   /**=====================================
    * These are label configuration.
    *======================================*/
   'labels'    => array (
      'custom_type'       => 'tabber',
      'type'              => 'tabber',
      'singular_label'    => 'Tabber',
      'plural_label'      => 'Tabbers',
      'in_sentence_label' => 'tabbers',
      'text_domain'       => TABBER_MODULE_TEXT_DOMAIN,
   ),

   /**=====================================
    * Supported features for this post type.
    *======================================*/
   'features'  => array (
      'base_post_type' => 'post',

      'exclude' => array (
         'excerpt',
         'comments',
         'trackbacks',
         'custom-fields',
         'thumbnail',
      ),

      'additional' => array (
         'page-attributes',
      ),
   ),

   /**=====================================
    * Registration arguments.
    *======================================*/
   'args'      => array (
      'description' => 'CampFirePixels Responsive Tabber',
      'label'       => __( 'Tabber', TABBER_MODULE_TEXT_DOMAIN ),
      'labels'      => '', // automatically generate the labels
      'public'      => true,
      'supports'    => '', // automatically generate the support features
      'menu_icon'   => 'dashicons-index-card',
      'has_archive' => true,
   ),
);