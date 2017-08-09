<?php
/*
 * Plugin Name: MJ - ACF Group Fields
 * Description: A theme support plugin MJ Theme
 * Author: Kevin Regenrek
 * Author URI: http://www.macherjek.at
 * Version: 1.0.2
 * Plugin URI: https://github.com/macherjek1/mj-acf-fields
 */

define( 'MJ_ACF_FIELDS_PLUGIN_DIR', plugin_dir_path( __FILE__  ));

/**
 * Require Composer autoloader if installed on it's own
 */
if (file_exists($composer = MJ_ACF_FIELDS_PLUGIN_DIR . '/vendor/autoload.php')) {
    require_once $composer;
}

require plugin_dir_path(__FILE__) . '/src/utils.php';
 add_action('after_setup_theme', function () {
 	require __DIR__ . '/src/main.php';
 }, 100);
?>
