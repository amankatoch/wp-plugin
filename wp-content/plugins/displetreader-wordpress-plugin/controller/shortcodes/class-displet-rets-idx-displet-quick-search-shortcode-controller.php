<?php

class DispletRetsIdxDispletQuickSearchShortcodeController extends DispletRetsIdxPlugin {
	public function render_shortcode( $attributes ) {
		$model = shortcode_atts( array(
			'id' => 1,
			'title' => ''
		 ), $attributes );
		$model['options'] = self::$_options;
		$displet_templates = DispletRetsIdxTemplatesController::get_template( 'displet-quick-search.php', $model );
		return $displet_templates;
	}
}

?>