<dt class="tabber--tab">
   <span class="tabber-content--content"><?php esc_html_e( $post_title ); ?></span>
   <span class="tabber-content--icon <?php echo $attributes['show_icon']; ?>"
         data-show-icon="<?php echo $attributes['show_icon']; ?>">
         <span class="screen-reader-text">Click to reveal the answer</span>
   </span>
</dt>
<dd class="tabber--content" style="display: none;"><?php echo $post_content; ?></dd>