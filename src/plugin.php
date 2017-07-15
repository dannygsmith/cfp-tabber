<?php
/**
 * Plugin Handler
 *
 * @package     CampFirePixels\Tabber
 * @since       0.1.0
 * @author      Danny G Smith
 * @link        https://campfirepixels.com
 * @license     GNU-2.0+
 *
 * [tabber tab="First Tab"]The performance of this processor ...[/tabber]
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

   wp_enqueue_style('dashicons');

   wp_enqueue_style(
      'font-awesome',
      'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
      array (),
      CHILD_THEME_VERSION,
      'all' );


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