<?php $show_icon = esc_attr( $attributes[ 'show_icon' ] ); ?>
<dl class="tabber--container">
   <dt class="tabber--tab">
      <span class="tabber-title--content"><?php esc_html_e( $attributes[ 'title' ] ); ?></span>
      <span class="tabber-title--icon <?php echo $show_icon; ?>"
            data-show-icon="<?php echo $show_icon; ?>">
            <span class="screen-reader-text">Click to reveal the answer</span>
      </span>
   </dt>
   <dd class="tabber--content" style="display: none;"><?php echo $content; ?></dd>
</dl>