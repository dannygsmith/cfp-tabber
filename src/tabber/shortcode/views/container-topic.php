<?php namespace CampFirePixels\Module\Tabber\Shortcode; ?>
<dl class="tabber--container tabber-topic--<?php esc_attr_e( $attributes['topic'] ); ?>">
   <?php loop_and_render_tabbers_by_topic( $query, $attributes, $config ) ?>
</dl>

