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
		add_filter( 'http_request_args', array($this, 'allow_unsafe_urls'));
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

	public function get_remote_version() {
		$latestTag =  $this->api->getLatestTag();
		return $latestTag->version;
	}

	public function is_update_available() {
		return $this->updateChecker->getUpdate() === null ? false : true;
		exit;
	}

	public function check_for_updates() {
		$this->api = new BitbucketServerApi(
			"http://code.macherjek.com:7990/rest/api/latest/projects/MJPLUG/repos/mj-acf-fields/",
			"http://code.macherjek.com:7990/projects/MJPLUG/repos/mj-acf-fields/");

		$this->updateChecker = new Puc_v4p2_Vcs_PluginUpdateChecker(
			$this->api,
			MJ_ACF_FIELDS_PLUGIN_DIR . 'mj-acf-fields.php',
			'mj-acf-fields');

		$this->updateChecker->setBranch('master');
	}

	function allow_unsafe_urls($args) {
		$args['reject_unsafe_urls'] = false;
		return $args;
	}
}
mjtheme()->mj_acf_fields = new MJ_ACF_Fields();
endif;
?>
