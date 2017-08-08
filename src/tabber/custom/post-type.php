<?php
/**
 * Tabber Custom Post Type Handler
 *
 * @package CampFirePixels\Module\Tabber;
 * @since   0.1.0
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

namespace CampFirePixels\Module\Tabber;

add_filter( 'add_custom_post_type_runtime_config', __NAMESPACE__ . '\register_tabber_custom_post_type' );
/**
 * Register the custom post type.
 *
 * @since 1.0.0
 *
 * @param array $configs Array of all the custom post type configurations.
 *
 * @return array
 */
function register_tabber_custom_post_type( array $configs ) {
   $config = include( TABBER_DIR . 'config/tabber/post-type.php' );
   $configs[ $config['post_type'] ] = $config;
   return $configs;
}