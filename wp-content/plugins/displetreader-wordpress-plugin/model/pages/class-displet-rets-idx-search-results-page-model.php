<?php

class DispletRetsIdxSearchResultsPageModel extends DispletRetsIdxPagesModel {
	public static function build() {
		self::_set_search_field_labels();
	}

	private static function _set_search_field_labels() {
		self::$_model['search_field_labels'] = DispletRetsIdxResidentialsModel::get_search_field_labels();
	}
}

?>