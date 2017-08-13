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

use CampFirePixels\Module\Custom as CustomModule;

require_once __DIR__ . '/settings-page.php';

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue the plugin assets (scripts and styles).
 *
 * @since 0.1.0
 *
 * @return void
 */
function enqueue_assets() {

   wp_enqueue_style( 'dashicons' );

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

// Update CSS within in Admin
function admin_styles() {
   wp_enqueue_style( 'admin-styles',
                     TABBER_URL . 'assets/sass/admin.css' );

}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\admin_styles' );

// Add landing page body class to the head.
add_filter( 'body_class', __NAMESPACE__ . '\genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {

   $classes[] = 'no-js';

   return $classes;
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
      'custom/module.php',
      'tabber/module.php',
   );

   foreach ( $files as $file ) {
      include( __DIR__ . '/' . $file );
   }
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\setup_plugin' );
/**
 * Setup the plugin.
 *
 * @since 1.3.0
 *
 * @return void
 */
function setup_plugin() {
   foreach ( array ( 'tab' ) as $shortcode ) {
      $pathto_configuration_file = sprintf( '%s/config/shortcode/%s.php',
                                            TABBER_DIR,
                                            $shortcode
      );

      CustomModule\register_shortcode( $pathto_configuration_file );
   }
}

autoload();