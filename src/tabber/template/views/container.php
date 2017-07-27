<?php
/**
 * Description
 *
 * @package CampFirePixels\Module\Tabber\Template;
 * @since   0.1.3
 * @author  Danny G Smith
 * @link    https://CampFirePixels.com
 * @license GNU General Public License 2.0+
 */

//d( 'top of container' );

use CampFirePixels\Module\Tabber\Shortcode as Shortcode;
use CampFirePixels\Module\Tabber\Template as Template;

//add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

if ( isset( $use_term_container ) && $use_term_container ) : ?>
<div class="collapsible-content--term-container tabber tabber-topic--<?php esc_attr_e( $term_slug ); ?>">
<?php endif; ?>

<?php if ( isset( $show_term_name ) && $show_term_name  ) : ?>
	<h2><?php esc_html_e( $record['term_name'] ); ?></h2>
<?php endif; ?>
	<dl class="tabber--container">

		<?php
        if ( $is_calling_source === 'template' ) {
	        Template\loop_and_render_tabbers( $record['posts'] );

        } elseif ( $is_calling_source === 'shortcode-by-topic' ) {
	        Shortcode\loop_and_render_tabbers_by_topic( $query, $attributes, $config );

        } else {
	        include( __DIR__ . '/tabber.php' );
        }
        ?>

	</dl>

<?php if ( isset( $use_term_container ) && $use_term_container ) : ?>
</div>
<?php endif; ?>


