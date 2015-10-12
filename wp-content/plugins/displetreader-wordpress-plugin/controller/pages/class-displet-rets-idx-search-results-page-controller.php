<?php

class DispletRetsIdxSearchResultsPageController extends DispletRetsIdxPagesController {
	public static function include_mobile_jquery() {
		self::include_listings_jquery( self::$_model );
	}

	public static function include_save_search_popup() {
		echo DispletRetsIdxTemplatesController::get_template( 'displet-save-search-popup.php', self::$_model );
	}

	public static function include_save_search_registration_popup() {
		echo DispletRetsIdxTemplatesController::get_template( 'displet-save-search-registration-popup.php', self::$_model );
	}

	public static function replace_page_content( $content ) {
		if ( in_the_loop() ) {
			$content = self::get_content();
		}
		return $content;
	}

	public static function use_mobile_template( $template ){
		$template = new DispletRetsIdxTemplates( self::$_model );
		self::$_model = $template->get_model();
		return $template->get_templates();
	}
}

?>