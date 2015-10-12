<?php

class DispletRetsIdxPartialAddressPageModel extends DispletRetsIdxPagesModel {
	public static function build() {
		self::get_query_vars();
	}

	private static function get_query_vars() {
		if ( !empty( self::$_model['property_zip'] ) ){
			self::$_model['zip'] = str_replace( '-', ' ', self::$_model['property_zip'] );
		}
		else if ( !empty( self::$_model['property_city'] ) ){
			self::$_model['city'] = str_replace( '-', ' ', self::$_model['property_city'] );
		}
		else if ( !empty( self::$_model['property_state'] ) ){
			self::$_model['state'] = str_replace( '-', ' ', self::$_model['property_state'] );
		}
	}
}

?>