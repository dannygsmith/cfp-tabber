<!--
// container
// tab                             $tab
// content (hidden unless active)  $content
// close container

[tabber tab="First Tab"]The performance of this processor ...[/tabber]
-->

<dl class="tabber--container">
   <dt class="tabber--tab"><?php esc_html_e( $tab ); ?></dt>
   <dd class="tabber--content"><?php echo $content;  ?></dd>
</dl>







