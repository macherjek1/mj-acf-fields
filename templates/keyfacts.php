<div id="facts" class="page-block">
  <div class="section-container">
    <div class="d-flex facts">

      <?php
            // check if the repeater field has rows of data
            if( have_rows('mj_facts') ) :
              // loop through the rows of data
                while ( have_rows('mj_facts') ) : the_row();
      ?>

      <div class="fact">
        <span class="num"><?= get_sub_field('mj_keyfact_num'); ?></span>
        <span class="desc"><?= get_sub_field('mj_keyfact_desc'); ?></span>
      </div>

    <?php endwhile; endif; ?>
    </div>
  </div>
</div>
