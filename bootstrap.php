<?php
/**
 * CampFirePixels Tabber plugin
 *
 * @package         CampFirePixels\Tabber
 * @author          Danny G Smith
 * @license         GPL-2.0+
 * @link            https://campfirepixels.com
 *
 * @wordpress-plugin
 * Plugin Name:     CampFirePixels Tabber
 * Plugin URI:      _
 * Description:     CampFirePixels Tabber is a WordPress Plugin that shows and hides hidden content.
 * Version:         0.1.0
 * Author:          Danny G Smith
 * Author URI:      https://campfirepixels.com
 * Text Domain:     cfp_tabber
 * Requires WP:     4.7
 * Requires PHP:    5.6
 */

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

 * [tabber tab="First Tab"]The performance of this processor ...[/tabber]

*/

namespace CampFirePixels\Tabber;

if ( !defined( 'ABSPATH' ) ) {
   die( "Oh, silly, there's nothing to see here." );
}

define( 'TABBER_PLUGIN', __FILE__ );
define( 'TABBER_DIR', trailingslashit( __DIR__ ) );
$plugin_url = plugin_dir_url( __FILE__ );

//d( TABBER_PLUGIN );
//ddd( TABBER_DIR );

if ( is_ssl() ) {
   $plugin_url = str_replace( 'http://', 'https://', $plugin_url );
}
define( 'TABBER_URL', $plugin_url );
define( 'TABBER_TEXT_DOMAIN', 'tabber' );

include( __DIR__ . '/src/plugin.php' );

/**
 * Get the bootstrap!
 */
if ( file_exists( __DIR__ . '/CMB2/init.php' ) ) {
   require_once __DIR__ . '/CMB2/init.php';
} elseif ( file_exists( __DIR__ . '/CMB2/init.php' ) ) {
   require_once __DIR__ . '/CMB2/init.php';
}
