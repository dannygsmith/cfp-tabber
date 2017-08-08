<?php
/**
 * Runtime configuration for the Topic taxonomy.
 *
 * @package CampFirePixels\Module\Tabber\Custom;
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Tabber\Custom;

return array(
   /**=====================================
    * The taxonomy name.
    *======================================*/
   'taxonomy' => 'topic',
   /**=====================================
    * These are label configuration.
    *======================================*/
   'labels' => array(
      'taxonomy'          => 'topic',
      'singular_label'    => 'Topic',
      'plural_label'      => 'Topics',
      'in_sentence_label' => 'topics',
      'text_domain'       => TABBER_MODULE_TEXT_DOMAIN,
   ),
   /**=====================================
    * These are the arguments for registering the taxonomy.
    *======================================*/
   'args' => array(
      'label'             => __( 'Topics', TABBER_MODULE_TEXT_DOMAIN ),
      'labels'            => '', // automatically generate the labels.
      'hierarchical'      => true,
      'show_admin_column' => true,
      'public'            => false,
      'show_ui'           => true,
   ),
   /**=====================================
    * These are the post types to bind the taxonomy to.
    *======================================*/
   'post_types' => array( 'tabber' ),
);
