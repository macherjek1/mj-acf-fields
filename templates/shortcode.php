<?php
$field = array(
	'shortcode' => get_sub_field( 'shortcode' ),
  	'width' => get_sub_field('width') ? get_sub_field('width') : 'section-container--content-wide',
);
?>
<div class="page-block shortcode-block spacer-pt spacer-pb">
		<div class="<?= $field['width'] ?>">
      <?= $field['shortcode']; ?>
		</div>
</div>
