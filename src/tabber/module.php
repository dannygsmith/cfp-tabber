<?php
/**
 * Description
 *
 * @package CampFirePixels\Module\Tabber;
 * @since   0.1.3
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Tabber;

use CampFirePixels\Module\Custom as CustomModule;

define( 'TABBER_MODULE_TEXT_DOMAIN', TABBER_TEXT_DOMAIN ); // 'tabber'
define( 'TABBER_MODULE_PLUGIN', TABBER_PLUGIN ); // "/app/public/wp-content/plugins/cfp-tabber/bootstrap.php"
define( 'TABBER_MODULE_DIR', trailingslashit( __DIR__ ) );         // "/app/public/wp-content/plugins/cfp-tabber/src/tabber"

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_tabber_custom_configuration' );
add_filter( 'add_custom_taxonomy_runtime_config', __NAMESPACE__ . '\register_tabber_custom_configuration' );

/**
 * Loading in the post type and taxonomy runtime configurations with
 * the Custom Module.
 *
 * @since 1.0.0
 *
 * @param array $configurations Array of all the configurations.
 *
 * @return array
 */
function register_tabber_custom_configuration( array $configurations ) {
   $doing_post_type = current_filter() == 'add_custom_post_type_runtime_config';

   $filename = $doing_post_type
      ? 'post-type'
      : 'taxonomy';

   $runtime_config = (array)require( TABBER_MODULE_DIR . 'config/' . $filename . '.php' );
   if ( !$runtime_config ) {
      return $configurations;
   }

   $key = $doing_post_type
      ? $runtime_config[ 'post_type' ]
      : $runtime_config[ 'taxonomy' ];

   $configurations[ $key ] = $runtime_config;

   return $configurations;
}

/**
 * Autoload plugin files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload() {
   $files = array (
      'shortcode/shortcode.php',
      'template/helpers.php'
   );

   foreach ( $files as $file ) {
      include( __DIR__ . '/' . $file );
   }
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\setup_module' );
/**
 * Setup the module.
 *
 * @since 1.0.0
 *
 * @return void
 */
function setup_module() {
   CustomModule\register_shortcode( TABBER_MODULE_DIR . 'config/shortcode.php' );
}

autoload();