<?php

class DispletRetsIdxSavedPropertiesPageController extends DispletRetsIdxSavedPropertiesPageModel {
	public static function add_page() {
		if ( !current_user_can( 'manage_options' ) ) {
			add_menu_page(
				'Saved Properties',
				'Saved Properties',
				'displet_save_properties',
				self::$_slugs['saved_properties_page'],
				array( 'DispletRetsIdxSavedPropertiesPageController', 'include_page' ),
				plugins_url( 'displetreader-wordpress-plugin/includes/css/images/saved-properties-icon.png' ),
				71
			);
		}
	}

	public static function build() {
		self::build_model();
	}

	public static function include_page() {
		echo DispletRetsIdxTemplatesController::get_admin_template( 'displet-saved-properties-page.php', self::$_model );
	}
}

?>