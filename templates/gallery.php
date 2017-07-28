<?php if(get_sub_field('gallery_title')) : ?>
<h2><?= get_sub_field( 'gallery_title' ) ?></h2>
<?php endif; ?>
<?php
if ( function_exists( 'envira_gallery' ) ) {
  envira_gallery( get_sub_field( 'gallery_id' ) );
}
?>
