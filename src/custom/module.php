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

define( 'CUSTOM_MODULE_DIR', __DIR__  );

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