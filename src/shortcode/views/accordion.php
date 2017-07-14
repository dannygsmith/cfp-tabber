<dl class="tabber--container">
   <dt class="tabber--tab <?php echo $attributes['showIcon']; ?>"
       data-show-icon="<?php echo $attributes['showIcon']; ?>"
       data-hide-icon="<?php esc_attr_e( $attributes['hideIcon'] ); ?>">
         <?php echo esc_html( $attributes[ 'tab' ] ); ?>
   </dt>
   <dd class="tabber--content" style="display: none;"><?php echo $content; ?></dd>
</dl>