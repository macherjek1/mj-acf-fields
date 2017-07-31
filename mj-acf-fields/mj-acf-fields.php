<?php
/*
 * Plugin Name: MJ - ACF Group Fields
 * Description: A theme support plugin MJ Theme
 * Author: Kevin Kernegger
 * Author URI: http://regenrek.at
 * Version: 0.0.6
 * Plugin URI: http://code.macherjek.com:7990/projects/MJPLUG/repos/mj-acf-fields/browse
 */

define( 'MJ_ACF_FIELDS_PLUGIN_DIR', plugin_dir_path( __FILE__  ));

/**
 * Require Composer autoloader if installed on it's own
 */
if (file_exists($composer = MJ_ACF_FIELDS_PLUGIN_DIR . '/vendor/autoload.php')) {
    require_once $composer;
}

require plugin_dir_path(__FILE__) . '/src/utils.php';
require plugin_dir_path(__FILE__) . '/src/BitbucketServerApi.php';

 add_action('after_setup_theme', function () {
 	require __DIR__ . '/src/main.php';
 }, 100);
?>
