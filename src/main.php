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

		$this->check_for_updates();

		add_shortcode('mj_acf_fields', array($this, 'render'));
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
		ob_start();
		require MJ_ACF_FIELDS_PLUGIN_DIR . 'version.json';
		$arr = json_decode(ob_get_clean());
		return $arr->stable;
	}

	public function get_update_url() {
		return UpdateUrl::UPDATE_URL;
	}

	public function check_for_updates() {
		$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
			'http://code.macherjek.com:7990/projects/MJPLUG/repos/mj-acf-fields/raw/plugin.json?at=refs%2Fheads%2Fmaster',
			__FILE__,
			'unique-plugin-or-theme-slug'
		);
	}
}
mjtheme()->mj_acf_fields = new MJ_ACF_Fields();
endif;
?>
