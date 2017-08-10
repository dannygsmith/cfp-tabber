<?php
/**
 * Custom Module Handle - bootstrap file
 *
 * @package CampFirePixels\Module\Custom;
 * @since   0.1.4
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Custom;
//ddd( __namespace__ );

define( 'CUSTOM_MODULE_DIR', __DIR__  );
//ddd( CUSTOM_MODULE_DIR );

/**
 * Autoload plugin files.
 *
 * @since 0.1.4
 *
 * @return void
 */
function autoload() {
   $files = array (
      'label-generator.php',
      'post-type.php',
      'shortcode.php',
      'taxonomy.php'
   );

   foreach ( $files as $file ) {
      include( __DIR__ . '/' . $file );
   }
}

autoload();

/**
 * Register a plugin with the custom module.  Handles .
 *
 * @since 0.1.5
 *
 * @param $plugin_file
 */
function register_plugin( $plugin_file ) {
   register_activation_hook(   $plugin_file, __NAMESPACE__ . '\delete_rewrite_rules_on_plugin_status_change' );
   register_deactivation_hook( $plugin_file, __NAMESPACE__ . '\delete_rewrite_rules_on_plugin_status_change' );
   register_uninstall_hook(    $plugin_file, __NAMESPACE__ . '\delete_rewrite_rules_on_plugin_status_change' );
}

/**
 * Delete the rewrite rules on plugin status change, i.e.
 * activation, deactivation, or uninstall.
 *
 * @since 1.0.0
 *
 * @return void
 */
function delete_rewrite_rules_on_plugin_status_change() {
   //ddd( 'inside delete ' );
   delete_option( 'rewrite_rules' );
}