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
define( 'TABBER_MODULE_DIR', __DIR__  );         // "/app/public/wp-content/plugins/cfp-tabber/src/tabber"
//ddd( TABBER_MODULE_DIR );

/**
 * Autoload plugin files.
 *
 * @since 0.1.3
 *
 * @return void
 */
function autoload() {
   $files = array (
      'custom/post-type.php',
      'custom/taxonomy.php',
      'shortcode/shortcode.php',
      'template/helpers.php'
   );

   foreach ( $files as $file ) {
      include( __DIR__ . '/' . $file );
   }
}

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_tabber_custom_configuration' );
add_filter( 'add_custom_taxonomy_runtime_config',  __NAMESPACE__ . '\register_tabber_custom_configuration' );

function register_tabber_custom_configuration( array $configs ) {


}


autoload();

