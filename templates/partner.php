<?php
$field = array(
	'subtitle'   => get_sub_field( 'subtitle' ),
	'title'      => get_sub_field( 'title' ),
	'content'    => get_sub_field( 'content' ),
	'img'		 => get_sub_field('image'),
	'use_featured_image' => get_sub_field('use_featured_image'),
	'cta_link' => get_sub_field('cta_link'),
	'cta_text' => get_sub_field('cta_text'),
	'position'	 => get_sub_field('position'),
	'background'	 => get_sub_field('background')
);
?>

<?php if( have_rows('partner') ) : ?>
<div class="page-block spacer-pt spacer-pb partner light-grey-bg">
  <div class="section-container section-container--content-wide">

		<h2 class="h2 page-block--title">Unsere Partner</h2>

    <div class="d-flex">
    <?php while(have_rows('partner')) : the_row();

      $field = [
        'image' => get_sub_field('mj_partner_image'),
        'alt' => get_sub_field('mj_partner_alt'),
        'link' => get_sub_field('mj_partner_link'),
				'svg_use_id'	 => get_sub_field('svg_use_id'),
				'svg_use_viewbox'	 => get_sub_field('svg_use_viewbox')
      ];
    ?>

      <div class="partner-logo">
        <?php // svg only ?>
        <a href="<?= $field['link'] ?>" target="_blank">
          <?= App\svg_use($field['svg_use_id'], $field['svg_use_viewbox']); ?>
        </a>
      </div>

  <?php
endwhile; ?>
    </div>
  </div>
</div>
<?php endif; ?>
