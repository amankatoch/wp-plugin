<?php

// Legacy class needed for legacy DPC's
class DispletRetsIdxSearchResults {
	public static function is_search_form_widget_area_used( $column_id ){
		return DispletRetsIdxSearchFieldsController::has_search_form_column( $column_id );
	}

	public static function is_advanced_search_form_widget_area_used( $column_id ){
		return DispletRetsIdxSearchFieldsController::has_advanced_search_form_column( $column_id );
	}

	public static function is_quick_search_form_column_used( $form, $column ){
		return DispletRetsIdxSearchFieldsController::has_quick_search_form( $form, $column );
	}
}

?>