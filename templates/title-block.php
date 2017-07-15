<?php
$field = array(
	'subtitle'   => get_sub_field( 'subtitle' ),
	'title'      => get_sub_field( 'title' )
);

?>
<?php if(isset($field['title'])) : ?>
	<div class="section-container--content-wide center">
		<h2 class="h1"><?= $field['title']; ?></h2>
	</div>
<?php endif; ?>
<?php if(isset($field['subtitle'])) : ?>
	<div class="section-container--content center">
		<p class="subtitle"><?= $field['subtitle']; ?></p>
	</div>
<?php endif; ?>
