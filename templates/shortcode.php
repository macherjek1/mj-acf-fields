<?php
$field = array(
	'shortcode' => get_sub_field( 'shortcode' )
);
?>
<div class="page-block shortcode-block spacer-pt spacer-pb">
		<div class="<?= $field['width'] ?>">
      <?= $field['shortcode']; ?>
		</div>
</div>
