<?php
/**
 * Plugin Handler
 *
 * @package     CampFirePixels\Tabber
 * @since       0.1.0
 * @author      Danny G Smith
 * @link        https://campfirepixels.com
 * @license     GNU-2.0+
 */

namespace CampFirePixels\Tabber;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue the plugin assets (scripts and styles).
 *
 * @since 0.1.0
 *
 * @return void
 */
function enqueue_assets() {
   wp_enqueue_script(
      'tabber-plugin-script',
      TABBER_URL . 'assets/dist/js/jquery.plugin.js',
      array ( 'jquery' ),
      '0.1.0',
      true
   );
   wp_enqueue_style( 'tabber-plugin-style',
                     TABBER_URL . 'assets/dist/css/style.min.css'
      );
}

/**
 * Autoload plugin files.
 *
 * @since 0.1.0
 *
 * @return void
 */
function autoload() {
   $files = array (
      'shortcode/shortcodes.php',
   );

   foreach ( $files as $file ) {
      include( __DIR__ . '/' . $file );
   }
}

autoload();