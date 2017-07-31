<?php
$field = array(
	'subtitle'   => get_sub_field( 'subtitle' ),
	'title'      => get_sub_field( 'title' ),
	'content'    => get_sub_field( 'content' ),
);
?>
<div class="page-block content-block">
	<?php if ( ! empty( $field['subtitle'] ) ): ?>
		<h4><?= $field['subtitle']; ?></h4>
	<?php endif; ?>

	<?php if ( ! empty( $field['title'] ) ): ?>
		<h2><?= $field['title']; ?></h2>
	<?php endif; ?>

	<?= $field['content']; ?>
</div>
