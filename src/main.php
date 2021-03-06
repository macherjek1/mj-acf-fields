<?php
/**
*
*@class       MJ_ACF_Fields
*
*/
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('MJ_ACF_Fields') ) :


class MJ_ACF_Fields {

	public function __construct() {

		if(!$this->is_acf_installed()) {
			throw new Exception(__('MJ ACF Fields requires ACF Fields Pro 5+', 'mj'));
		}

		add_shortcode('mj_acf_fields', array($this, 'render'));
		add_action('init',	array($this, 'check_for_updates'));
	}

	public function render() {
		/**
		 * This file loads the correct visual editor block element for the
		 * current page layout
		 */
		if ( have_rows( 'scpt_layouts' ) ) :
			while ( have_rows( 'scpt_layouts' ) ) : the_row();

				// 1 Path is deprecated
        // 2 Path is newer shorter one - use this
				Utils\mj_get_template_part(get_row_layout(), apply_filters('mj/acf_fields/template_paths', [
					'template-parts/flexibles/visual-editor',
					'template-parts/visual-editor'
				]));
			endwhile;
		endif;
	}

	public function is_acf_installed() {
		return class_exists('acf');
	}

	public function get_version() {
		return $this->updateChecker->getInstalledVersion();
	}

	// @TODO Get Latest Tag Version
	public function get_remote_version() {
		//$latestTag =  $this->api->getLatestTag();
		return "N/A";
	}

	public function is_update_available() {
		return $this->updateChecker->getUpdate() === null ? false : true;
		exit;
	}

	public function check_for_updates() {
		$this->updateChecker = Puc_v4_Factory::buildUpdateChecker(
			'https://github.com/macherjek1/mj-acf-fields/',
			MJ_ACF_FIELDS_PLUGIN_DIR . '/mj-acf-fields.php',
			'mj-acf-fields'
		);
		$this->updateChecker->setBranch('master');

	}
}
mjtheme()->mj_acf_fields = new MJ_ACF_Fields();
endif;
?>
