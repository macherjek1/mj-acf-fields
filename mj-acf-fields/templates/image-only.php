<?php
$field = array(
	'image' => get_sub_field( 'image' ),
	'aspect_ratio' => get_sub_field('aspect_ratio'),
	'full_width' => get_sub_field('full_width')
);
$container = $field['aspect_ratio'] === "auto" ? true : false;

if($field['full_width']) {
	$class = "image-block--full";
} else {
	$class = "";
}
//$class = "image-block--full";
?>

<div class="page-block image-block <?= $class; ?>">

		<div class="section-container--content-wide">

	<?= App\mj_get_responsive_img($field['image'], 'full', 'lazyload', 'MACHERJEK_THUMBNAIL_SIZES', $field['aspect_ratio']); ?>
	<?php if( have_rows('repeater_tltr') ) : ?>

		<div class="berry-bg tltr tltr-tr">
			<ul>
		<?php while ( have_rows('repeater_tltr') ) : the_row();
			?>
			<li><?php the_sub_field('entry'); ?></li>

	<?php endwhile; ?>
		</ul>
		</div>
	<?php endif; ?>

		</div>

</div>
