<?php

/**
*
*@class       MJ_ACF_Fields
*
*/

class MJ_ACF_Fields {

	public function __construct() {

		if(!$this->is_acf_installed()) {
			throw new Exception(__('MJ ACF Fields requires ACF Fields Pro 5+', 'mj'));
		}

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
}
new MJ_ACF_Fields();


?>
