
<?php // Include a Custom Page Block which is defined under custom ?>
<?php if(get_sub_field('page_block_name')) : ?>
  <?php get_template_part('template-parts/flexibles/custom/' . get_sub_field('page_block_name')); ?>
  <?php
  				Utils\mj_get_template_part(get_sub_field('page_block_name'), apply_filters('mj/acf_fields/template_loop_paths', [
  					'template-parts/flexibles/visual-editor/custom',
  					'template-parts/visual-editor/loops'
  				]));
  ?>
<?php
  // Use default query loop
  else: ?>
  <?php

  // should we filter by taxonomy?
  $tax = [];

  if(get_sub_field('page_block_filter_enabled')) {
    $tax = [
      'taxonomy' => get_sub_field('page_block_filter_taxonomy'),
      'field' => get_sub_field('page_block_filter_field'),
      'terms' => get_sub_field('page_block_filter_terms')
    ];
  }

  $query = new WP_Query( array(
    'post_type'      => get_sub_field('post_type_name'),
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'posts_per_page' => -1,
    'tax_query' => [
      $tax
    ]
    ));
  ?>
  <?php if($query->have_posts()) : ?>
    <div class="page-block latest-posts" data-node-type="latest-posts-block">
      <?php if(get_sub_field('mj_pageblock_title')) : ?>
        <h3><?= get_sub_field('mj_pageblock_title') ?></h3>
      <?php endif; ?>
      <div class="grid">
        <div class="grid-sizer"></div>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php get_template_part('template-parts/post/content',
                  get_post_type() !== 'post' ? get_post_type() : get_post_format()); ?>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endif; wp_reset_postdata(); ?>



<?php endif; ?>
