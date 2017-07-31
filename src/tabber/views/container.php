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

use CampFirePixels\Module\Tabber\Shortcode as Shortcode;
use CampFirePixels\Module\Tabber\Template  as Template;

if ( isset( $use_term_container ) && $use_term_container ) : ?>
   <div class="tabber-content--term-container tabber tabber-topic--<?php esc_attr_e( $term_slug ); ?>">
<?php endif; ?>

<?php if ( isset( $show_term_name ) && $show_term_name  ) : ?>
	<h2><?php esc_html_e( $record['term_name'] ); ?></h2>
<?php endif; ?>

		<?php
        if ( $is_calling_source === 'template' ) {
           Template\loop_and_render_tabbers( $record['posts'] );

        } elseif ( $is_calling_source === 'shortcode-by-topic' ) {
            Shortcode\loop_and_render_tabbers_by_topic( $query, $attributes, $config );

        } else {
	        include( __DIR__ . '/tabber.php' );
        }
        ?>

<?php if ( isset( $use_term_container ) && $use_term_container ) : ?>
</div>
<?php endif; ?>


