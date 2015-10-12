<?php

class DispletRetsIdxSavedSearchesPageModel extends DispletRetsIdxAdminPagesModel {
	public static function build_model() {
		self::get_defaults();
		self::get_user_property_suggestions();
		self::get_user_saved_searches();
	}

	private static function get_defaults() {
		self::$_model = array_merge( self::$_model, array(
			'property_suggestions' => false,
			'saved_searches' => false,
			'search_results_page_url' => get_permalink( self::$_options['search_results_page_id'] ),
			'searches' => array(),
			'user_id' => get_current_user_id(),
		) );
	}

	private static function get_user_property_suggestions() {
		if ( !empty( self::$_model['user_id'] ) ) {
			$api_user_id = get_user_meta( self::$_model['user_id'], 'displet_api_user_id', true );
			if ( !empty( $api_user_id ) ) {
				$saved_searches = DispletRetsIdxUsersApiController::get_saved_searches( $api_user_id );
				if ( !empty( $saved_searches ) ) {
					foreach ( $saved_searches as $saved_search ) {
						if ( !empty( $saved_search->suggested ) ) {
							self::$_model['property_suggestions'] = $saved_search;
						}
					}
				}
			}
		}
	}

	private static function get_user_saved_searches() {
		if ( !empty( self::$_model['user_id'] ) ) {
			self::$_model['saved_searches'] = get_user_meta( self::$_model['user_id'], 'displet_saved_searches', true );
		}
	}
}

?>