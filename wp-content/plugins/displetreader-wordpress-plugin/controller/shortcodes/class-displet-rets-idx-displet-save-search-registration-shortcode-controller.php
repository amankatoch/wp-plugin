<?php

class DispletRetsIdxDispletSaveSearchRegistrationShortcodeController extends DispletRetsIdxPlugin {
	public function render_shortcode( $attributes ) {
		$model = array(
			'options' => self::$_options,
		);
		return DispletRetsIdxTemplatesController::get_template( 'displet-save-search-registration-form.php', $model );
	}
}

?>