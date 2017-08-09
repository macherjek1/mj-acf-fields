<?php
use Mj\Frontend\PageBlock;

// How many Cols we need?
$cols = intval(get_sub_field('cols'));

$columns = [
    2 => '6',
    3 => '4'
];

$fields = [
    'no_gutters' => get_sub_field('no_gutter') ? 'no-gutters' : ''
];

?>

<div <?= PageBlock::get_attrs() ?>>
  <div <?= PageBlock::get_width() ?>>
    <?php if($cols > 1) : ?>
        <div class="row <?= $fields['no_gutters']; ?>">
    <?php endif; ?>

    <?php if ( have_rows( 'grid_layouts' ) ) : ?>
    		<?php while ( have_rows( 'grid_layouts' ) ) : the_row(); ?>
                <?php if($cols > 1) : ?>
                    <div class="col-12 col-md-<?= $columns[$cols] ?>">
                <?php endif; ?>

    			<?php

                // 1 Path is deprecated
                // 2 Path is newer shorter one - use this

                Utils\mj_get_template_part( get_row_layout(), [
                'template-parts/flexibles/visual-editor/elements',
                'template-parts/visual-editor'
                ]); ?>
                <?php if($cols > 1): ?></div><?php endif; ?>
            <?php endwhile; ?>

    <?php endif; ?>

    <?php if($cols > 1) : ?>
        <div/><!-- end row -->
    <?php endif; ?>

    <?php if(get_sub_field('parallax')) : ?>
        <div class="dark-overlay"></div>
    <?php endif; ?>
  </div>
</div>
        