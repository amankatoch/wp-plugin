<?php

class DispletRetsIdxPartialAddressPageController extends DispletRetsIdxPagesController {
	protected static $_title_replacements = array(
		'city' => 'property_city',
		'state' => 'property_state',
		'zip_code' => 'property_zip',
	);

	private static function get_default_title() {
		if ( !empty( self::$_model['property_zip'] ) ) {
			return str_replace( '-', ' ', self::$_model['zip'] );
		}
		else if ( !empty( self::$_model['property_city'] ) ) {
			return str_replace( '-', ' ', self::$_model['city'] );
		}
		else if ( !empty( self::$_model['property_state'] ) ) {
			return str_replace( '-', ' ', self::$_model['state'] );
		}
	}

	private static function get_meta_title() {
		if ( !empty( self::$_options['partial_address_page_title'] ) ) {
			$title = self::$_options['partial_address_page_title'];
			foreach ( self::$_title_replacements as $placeholder => $query_var ) {
				$title = str_replace( '%%' . $placeholder . '%%', str_replace( '-', ' ', self::$_model[ $query_var ] ), $title );
			}
			return trim( ltrim( $title, ',' ) );
		}
		return self::get_default_title();
	}

	private static function get_page_title() {
		if ( !empty( self::$_options['partial_address_page_h1'] ) ) {
			$title = self::$_options['partial_address_page_h1'];
			foreach ( self::$_title_replacements as $placeholder => $query_var ) {
				$title = str_replace( '%%' . $placeholder . '%%', str_replace( '-', ' ', self::$_model[ $query_var ] ), $title );
			}
			return trim( ltrim( $title, ',' ) );
		}
		return self::get_default_title();
	}

	public static function replace_meta_title( $title ) {
		return self::get_meta_title();
	}

	public static function replace_meta_title_genesis() {
		$title = self::get_meta_title();
		echo '<title>' . $title . '</title>';
	}

	public static function replace_page_content( $content ) {
		if ( in_the_loop(  ) ) {
			if ( !empty( self::$_model['property_zip'] ) ){
				$content = '<!-- Displet Property Zip: ' . self::$_model['zip'] . ' -->';
			}
			else if ( !empty( self::$_model['property_city'] ) ){
				$content = '<!-- Displet Property City: ' . self::$_model['city'] . ' -->';
			}
			else if ( !empty( self::$_model['property_state'] ) ){
				$content = '<!-- Displet Property State: ' . self::$_model['state'] . ' -->';
			}
			$content .= self::get_content();
		}
		return $content;

	}

	public static function replace_page_title( $title, $id ) {
		if ( $id == self::$_options['property_details_page_id'] && in_the_loop() && DispletRetsIdxUtilities::is_referral_function( 'the_title' ) ) {
			return self::get_page_title();
		}
		return $title;
	}
}

?>