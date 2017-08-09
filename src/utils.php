<?php
namespace Utils;

function mj_get_template_part( $file, $paths = array()) {
    $filepath = template_exists($file, $paths);

    // or use ith from plugin path
    if(!$filepath)
        $filepath = MJ_ACF_FIELDS_PLUGIN_DIR . 'templates/' . $file . '.php';

    ob_start();
    $return = require( $filepath );
    $data = ob_get_clean();

    echo $data;
}


function template_exists($file, $paths) {
  foreach($paths as $path) {
    $filepath = $path . '/' . $file . '.php';

    // Check if file is inside child theme
    if(file_exists(get_stylesheet_directory() .'/'. $filepath)) {
        return get_stylesheet_directory() .'/'. $filepath;
      // Check if file is inside main theme
    } elseif(file_exists(get_template_directory() .'/'. $filepath)) {
          return get_template_directory() .'/'. $filepath;
    }
  }

  return false;
}
