<?php

class DispletRetsIdxSavedSearchesPageController extends DispletRetsIdxSavedSearchesPageModel {
	public static function add_page() {
		if ( !current_user_can( 'manage_options' ) ) {
			add_menu_page(
				'Saved Searches',
				'Saved Searches',
				'displet_save_searches',
				self::$_slugs['saved_searches_page'],
				array( 'DispletRetsIdxSavedSearchesPageController', 'include_page' ),
				plugins_url( 'displetreader-wordpress-plugin/includes/css/images/saved-searches-icon.png' ),
				72
			);
		}
	}

	public static function build() {
		self::build_model();
		self::prep_property_suggestions();
		self::prep_saved_searches();
		self::set_searches();
	}

	private static function get_property_suggestions_criteria() {
		if ( !empty( self::$_model['property_suggestions']->search_criteria ) ) {
			parse_str( self::$_model['property_suggestions']->search_criteria, $criteria );
			if ( !empty( $criteria ) ) {
				$translated_criteria = array();
				foreach ( $criteria as $field => $value ) {
					$translated_field = DispletRetsIdxResidentialsModel::get_translated_legacy_search_field( $field );
					if ( !empty( $translated_field ) ) {
						$translated_criteria[] = $translated_field . '=' . $value;
					}
				}
				return $translated_criteria;
			}
		}
	}

	private static function get_property_suggestions_url( $criteria ) {
		if ( !empty( $criteria ) && is_array( $criteria ) ) {
			$hash = implode( '/',  $criteria );
		}
		else {
			$hash = '';
		}
		return self::$_model['search_results_page_url'] . $hash;
	}

	private static function get_saved_search_description( $saved_search ) {
		$criteria = array_filter( array_map( 'trim', explode( '/', str_replace( '#', '', $saved_search['hash'] ) ) ) );
		return self::get_search_description( $criteria );
	}

	private static function get_search_description( $criteria ) {
		if ( !empty( $criteria ) && is_array( $criteria ) ) {
			$description = array();
			foreach ( $criteria as $value ) {
				if ( strpos( $value, 'price' ) !== false ) {
					$value .= 'k';
				}
				$description[] = ucwords( str_replace( '=', ': ', str_replace( '_', ' ', urldecode( $value ) ) ) );
			}
			return implode( ', ', $description );
		}
		return false;
	}

	private static function get_saved_search_url( $saved_search ) {
		return self::$_model['search_results_page_url'] . $saved_search['hash'];
	}

	public static function include_page() {
		echo DispletRetsIdxTemplatesController::get_admin_template( 'displet-saved-searches-page.php', self::$_model );
	}

	private static function prep_property_suggestions() {
		if ( !empty( self::$_model['property_suggestions'] ) ) {
			$criteria = self::get_property_suggestions_criteria();
			self::$_model['property_suggestions'] = array(
				'description' => self::get_search_description( $criteria ),
				'name' => 'Property Suggestions',
				'url' => self::get_property_suggestions_url( $criteria ),
			);
		}
	}

	private static function prep_saved_searches() {
		if ( !empty( self::$_model['saved_searches'] ) ) {
			$saved_searches = array();
			foreach ( self::$_model['saved_searches'] as $saved_search ) {
				if ( is_array( $saved_search ) ) {
					$saved_search['description'] = self::get_saved_search_description( $saved_search );
					$saved_search['url'] = self::get_saved_search_url( $saved_search );
					$saved_searches[] = $saved_search;
				}
			}
			self::$_model['saved_searches'] = $saved_searches;
		}
	}

	private static function set_searches() {
		if ( !empty( self::$_model['property_suggestions'] ) ) {
			self::$_model['searches'][] = self::$_model['property_suggestions'];
		}
		if ( !empty( self::$_model['saved_searches'] ) ) {
			self::$_model['searches'] = array_merge( self::$_model['searches'], self::$_model['saved_searches'] );
		}
	}
}

?>