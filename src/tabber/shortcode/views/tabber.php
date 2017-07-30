<dt class="tabber--tab">
   <span class="tabber-title--content"><?php esc_html_e( $post_title ); ?></span>
   <span class="tabber-title--icon <?php echo $attributes['show_icon']; ?>"
         data-show-icon="<?php echo $attributes['show_icon']; ?>">
         <span class="screen-reader-text">Click to reveal the answer</span>
   </span>
</dt>
<dd class="tabber--content" style="display: none;"><?php echo $post_content; ?></dd>