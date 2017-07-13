<dl class="tabber--container">
   <dt class="tabber--tab <?php echo $attributes['show_icon']; ?>"
       data-show-icon="<?php echo $attributes['show_icon']; ?>"
       data-hide-icon="<?php esc_attr_e( $attributes['hide_icon'] ); ?>">
         <?php echo esc_html( $attributes[ 'tab' ] ); ?>
   </dt>
   <dd class="tabber--content" style="display: none;"><?php echo $content; ?></dd>
</dl>