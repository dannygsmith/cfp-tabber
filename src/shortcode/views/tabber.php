<!--
// container
// tab                             $tab
// content (hidden unless active)  $content
// close container

[tabber tab="First Tab"]The performance of this processor ...[/tabber]
-->

<dl class="tabber--container">
   <dt class="tabber--tab"><?php echo esc_html( $tab ); ?></dt> <!-- tab label   -->
   <dd class="tabber--content" style="display: none;"><?php echo $content;  ?></dd> <!-- tab content -->
</dl>







