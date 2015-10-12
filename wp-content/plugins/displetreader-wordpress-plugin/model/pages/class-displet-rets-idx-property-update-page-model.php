<?php

class DispletRetsIdxPropertyUpdatePageModel extends DispletRetsIdxPagesModel {
	public static function build() {
		self::set_property_id();
	}

	private static function set_property_id() {
		if ( self::$_model['is_property_update_page'] ) {
			self::$_model['property_id'] = self::$_model['property_update_id'];
		}
	}
}

?>