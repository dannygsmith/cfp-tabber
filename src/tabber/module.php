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

define( 'TABBER_MODULE_TEXT_DOMAIN', TABBER_TEXT_DOMAIN ); // 'tabber'
define( 'TABBER_MODULE_PLUGIN', TABBER_PLUGIN ); // "/app/public/wp-content/plugins/cfp-tabber/bootstrap.php"
define( 'TABBER_MODULE_DIR', plugin_dir_path( __FILE__  ) );

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

autoload();

register_activation_hook(   TABBER_MODULE_PLUGIN, __NAMESPACE__ . '\activate_the_plugin');

function activate_the_plugin() {

   register_custom_post_type();
   register_custom_taxonomy();

   flush_rewrite_rules();
}

register_deactivation_hook( TABBER_MODULE_PLUGIN, __NAMESPACE__ . '\deactivate_plugin');
/**
 * The plugin is deactivating.  Delete out the rewrite rules option.
 *
 * @since 0.1.3
 *
 * @return void
 */
function deactivate_plugin() {

   delete_option( 'rewrite_rules' );
}

register_uninstall_hook( TABBER_MODULE_PLUGIN, __NAMESPACE__ . '\uninstall_plugin' );
/**
 * Plugin is being uninstalled. Clean up after ourselves...silly.
 *
 * @since 0.1.3
 *
 * @return void
 */
function uninstall_plugin() {
   delete_option( 'rewrite_rules' );
}
