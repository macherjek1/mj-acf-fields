<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if( ! class_exists('MJ_ACF_Fields_Admin') ) :

  class MJ_ACF_Fields_Admin {

  	// vars
  	var $notices = array();

    function __construct() {
  		// actions
  		add_action('admin_menu', array($this, 'admin_menu'));
  		// add_action('admin_enqueue_scripts',	array($this, 'admin_enqueue_scripts'), 0);
  		// add_action('admin_notices', 		array($this, 'admin_notices'));
  	}

  	function admin_menu() {

  		// vars
  		$slug = 'edit.php?post_type=acf-field-group';

  		// add parent
  		add_menu_page(__("Custom Fields",'acf'), __("Custom Fields",'acf'), $cap, $slug, false, 'dashicons-welcome-widgets-menus', '80.025');
  	}
  }
endif;
