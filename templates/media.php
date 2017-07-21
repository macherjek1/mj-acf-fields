<div class="page-block media-block"
     style="background-image: url(<?= App\asset_path_child('images/bg_viol.jpg'); ?>)">

  <div class="rhombus-wrapper">
    <svg id="rhombus-bg" class="rhombus-bg" width="800" height="800"
    viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg"
    xlink="http://www.w3.org/1999/xlink" version="1.1">
         <clipPath id="raute-mask">
           <polygon points="400 0, 800 400, 400 800, 0 400" />
         </clipPath>
      <image clip-path="url(#raute-mask)" height="100%" width="100%" xlink:href="<?= App\asset_path_child('images/raute_wexltrails_bg.jpg') ?>" />
    </svg>
  </div>

  <div class="section-container">
    <div class="row">
      <div class="col-12 offset-lg-1 col-lg-5">
        <h2 id="exp-wexltrails" class="h1">Experience Wexl Trails</h2>
      </div>
      <div id="media-gallery" class="col-12 col-lg-6">
        <?php if ( function_exists( 'envira_gallery' ) ) { envira_gallery( 'home', 'slug' ); } ?>
      </div>
    </div>
  </div>
</div>
