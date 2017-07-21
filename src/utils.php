<?php 
namespace Utils;

function mj_get_template_part( $file, $paths = array()) {
    $has_override = true;

    foreach($paths as $path) {
        $filepath = $path . '/' . $file . '.php';

        // Check if file is inside child theme
        if(file_exists(get_stylesheet_directory() . $filepath)) {
            $file = $filepath;

        // Check if file is inside main theme
        } elseif(file_exists(get_template_directory() . $filepath)) {
            $file = $filepath;
        } else {
            $has_override = false;
        }
    }

    // or use ith from plugin path    
    if(!$has_override)
        $file = MJ_ACF_FIELDS_PLUGIN_DIR . 'templates/' . $file . '.php';

    ob_start();
    $return = require( $file );
    $data = ob_get_clean();

    echo $data;
}