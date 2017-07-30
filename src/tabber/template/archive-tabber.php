<?php
/**
 * Tabber Archive Template
 *
 * @package CampFirePixels\Module\Tabber;
 * @since   0.1.3
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */
namespace CampFirePixels\Module\Tabber\Template;

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', __NAMESPACE__ . '\do_tabber_archive_loop' );
/**
 * Do the Tabber Archive Loop and render out the HTML.
 *
 * NOTE: The variables are set to call the right HTML
 * markup the container.php view file.
 *
 * @since 0.1.3
 *
 * @return void
 */
function do_tabber_archive_loop() {

   $records = get_posts_grouped_by_term( 'tabber', 'topic' );
	if ( ! $records ) {
		echo '<p>Sorry, there are no Tabbers.</p>';
		return;
	}

   $use_term_container = true;
	$show_term_name     = true;
	$is_calling_source  = 'template';

   foreach ( $records as $record ) {
		$term_slug = $record['term_slug'];

      include( TABBER_MODULE_DIR . 'template/views/container.php' );
   }
}

/**
 * Loop through and render out the Tabbers.
 *
 * @since 0.1.3
 *
 * @param array $tabbers
 *
 * @return void
 */
function loop_and_render_tabbers( array $tabbers ) {
	$attributes = array(
      'show_icon' => 'fa fa-caret-left',

	);

	foreach ( $tabbers as $tabber ) {

      //$post_content = do_shortcode( $tabber['post_content'] );
      $post_content = do_shortcode( apply_filters( 'the_content', $tabber['post_content'] ) );
      $post_title   = $tabber['post_title'];

      include( TABBER_MODULE_DIR . 'template/views/tabber.php' );
	}
}

genesis();
