<?php

class DispletRetsIdxPagesModel extends DispletRetsIdxPlugin {
	protected static $_model = array();

	public static function build_model() {
		self::get_defaults();
		self::get_query_vars();
		self::get_pages();
		self::determine_mobile();
		self::determine_page();
		self::determine_popups();
		self::maybe_get_user_vars();
		self::maybe_build_page();
		self::maybe_set_query_args();
		self::maybe_set_residentials_args();
		self::maybe_get_residentials();
		self::_set_canonical();
		self::_set_is_canonical();
		self::maybe_add_parent_page();
		self::_get_user_property_rating();
		self::_get_similar_properties();
		self::globalize();
	}

	private static function determine_mobile() {
		if ( !empty( self::$_options['mobile_version'] ) ) {
			$device = new DispletRetsIdxMobileDetect();
			if ( $device->isMobile() && !$device->isTablet() ) {
				self::$_model['is_mobile_device'] = true;
			}
		}
	}

	private static function determine_page() {
		if ( ( self::$_model['pages']['is_property_details_page'] || self::$_model['pages']['is_mobile_property_details_page'] ) && !empty( self::$_model['property_id'] ) ) {
			self::$_model['is_property_details_page'] = true;
			if ( !empty( self::$_options['use_pdp_for_showcase_details'] ) && substr( self::$_model['property_id'], 0, 2 ) === 'PS' ) {
				self::$_model['is_property_showcase_page'] = true;
			}
		}
		else if ( ( self::$_model['pages']['is_property_details_page'] || self::$_model['pages']['is_mobile_property_details_page'] ) && self::has_partial_address_query_var() ) {
			self::$_model['is_partial_address_page'] = true;
		}
		else if ( self::$_model['pages']['is_search_results_page'] || self::$_model['pages']['is_mobile_search_results_page'] ) {
			self::$_model['is_search_results_page'] = true;
		}
		else if ( !empty( self::$_model['property_update_id'] ) ) {
			self::$_model['is_property_update_page'] = true;
		}
		if ( self::$_model['pages']['is_mobile_search_results_page'] || self::$_model['pages']['is_mobile_property_details_page'] || self::$_model['pages']['is_mobile_home_page'] || self::$_model['pages']['is_mobile_contact_page'] ) {
			self::$_model['is_mobile_page'] = true;
		}
	}

	private static function determine_popups() {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_search_results_page'] || self::$_model['is_mobile_page'] || self::$_options['allow_sitewide_registration'] == '1' ) {
			self::$_model['has_login_register_popup'] = true;
		}
		if ( self::$_model['is_property_details_page'] || self::$_options['allow_sitewide_showing_requests'] == '1' ) {
			self::$_model['has_request_showing_popup'] = true;
		}
		if ( !empty( self::$_options['allow_sitewide_save_search_registrations'] ) ) {
			self::$_model['has_save_search_registration_popup'] = true;
		}
	}

	private static function get_defaults() {
		self::$_model = array(
			'ancestor_titles' => 0,
			'ancestor_urls' => 0,
			'ancestors' => 0,
			'data_from' => 'api',
			'extended_stats' => false,
			'get_listings' => true,
			'get_listings_by_status' => false,
			'get_stats_by_status' => false,
			'has_login_register_popup' => false,
			'has_request_showing_popup' => false,
			'has_save_search_registration_popup' => false,
			'is_canonical' => true,
			'is_displet_api' => !empty( self::$_options['displet_app_key'] ) ? true : false,
			'is_mobile_device' => false,
			'is_mobile_page' => false,
			'is_partial_address_page' => false,
			'is_property_details_page' => false,
			'is_property_showcase_page' => false,
			'is_property_update_page' => false,
			'is_search_results_page' => false,
			//'is_shortcode_page' => false,
			'property_details_page_url' => get_permalink( self::$_options['property_details_page_id'] ),
			'search_fields' => array(),
			'search_results_page_url' => get_permalink( self::$_options['search_results_page_id'] ),
		);
	}

	private static function get_residentials() {
		$residentials = new DispletRetsIdxResidentials( self::$_model );
		$results = $residentials->get_residentials();
		if ( self::$_model['is_property_details_page'] && self::$_model['is_property_showcase_page'] && empty( $results['listings'][0] ) ) {
			self::$_model['data_from'] = 'api';
			$residentials = new DispletRetsIdxResidentials( self::$_model );
			$results = $residentials->get_residentials();
		}
		if ( ( self::$_model['is_property_details_page'] || self::$_model['is_property_update_page'] ) && empty( $results['listings'][0] ) ){
			$residentials->swap_id_for_sysid();
			$results = $residentials->get_residentials();
		}
		if ( !empty( $results ) && is_array( $results ) ) {
			self::$_model = array_merge( self::$_model, $results );
		}
	}

	private static function get_pages() {
		self::$_model['pages'] = array(
			'is_property_details_page' => is_page( self::$_options['property_details_page_id'] ),
			'is_search_results_page' => is_page( self::$_options['search_results_page_id'] ),
			'is_mobile_search_results_page' => is_post_type_archive( 'rets-mobile' ),
			'is_mobile_property_details_page' => is_post_type_archive( 'rets-mobile' ),
			'is_mobile_home_page' => is_post_type_archive( 'rets-mobile-home' ),
			'is_mobile_contact_page' => is_post_type_archive( 'rets-mobile-contact' ),
		);
	}

	private static function get_query_vars() {
		$page = get_query_var( 'paged' );
		self::$_model = array_merge( self::$_model, array(
			'property_price' => get_query_var( 'property_price' ),
			'property_address' => get_query_var( 'property_address' ),
			'property_id' => get_query_var( 'property_id' ),
			'property_zip' => get_query_var( 'property_zip' ),
			'property_city' => get_query_var( 'property_city' ),
			'property_state' => get_query_var( 'property_state' ),
			'property_update_id' => get_query_var( 'property_update_id' ),
			're_user_login' => get_query_var( 're_user_login' ),
			'residential_permalinks' => get_query_var( 'residential_permalinks' ),
			'page' => !empty( $page ) ? intval( $page ) : 1,
			//'page_id' => intval( get_query_var( 'paged' ) ),
		) );
	}

	private static function _get_similar_properties() {
		if ( self::$_model['is_property_details_page'] && !self::$_model['is_mobile_page'] && !empty( self::$_options['include_similar_properties'] ) && self::$_model['is_canonical'] ) {
			DispletRetsIdxPropertyDetailsPageModel::get_similar_properties();
		}
	}

	private static function _get_user_property_rating() {
		if ( self::$_model['is_property_details_page'] && self::$_model['is_canonical'] ) {
			DispletRetsIdxPropertyDetailsPageModel::get_user_property_rating();
		}
	}

	public static function globalize() {
		global $displetretsidx_model;
		self::$_model['options'] = self::$_options;
		$displetretsidx_model = self::$_model;
	}

	private static function has_partial_address_query_var() {
		$query_vars = array(
			'property_state',
			'property_city',
			'property_state',
		);
		foreach ( $query_vars as $query_var ) {
			if ( !empty( self::$_model[ $query_var ] ) ) {
				return true;
			}
		}
		return false;
	}

	public static function is_search_results_page() {
		return self::$_model['is_search_results_page'];
	}

	private static function maybe_add_parent_page() {
		if ( ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] ) && !self::$_model['is_mobile_page'] ) {
			global $post;
			$post->post_parent = $post->ID;
		}
	}

	private static function maybe_build_page() {
		if ( self::$_model['is_mobile_page'] ) {
			DispletRetsIdxMobilePageModel::build();
		}
		if ( self::$_model['has_login_register_popup'] ) {
			DispletRetsIdxPopupsModel::build_login_register();
		}
		if ( self::$_model['is_property_details_page'] ) {
			DispletRetsIdxPropertyDetailsPageModel::build();
		}
		if ( self::$_model['is_property_update_page'] ) {
			DispletRetsIdxPropertyUpdatePageModel::build();
		}
		else if ( self::$_model['is_partial_address_page'] ) {
			DispletRetsIdxPartialAddressPageModel::build();
		}
		else if ( self::$_model['is_search_results_page'] ) {
			DispletRetsIdxSearchResultsPageModel::build();
		}
	}

	private static function maybe_get_residentials() {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_property_update_page'] || self::$_model['is_partial_address_page'] || self::$_model['is_search_results_page'] ) {
			self::get_residentials();
		}
	}

	private static function maybe_get_user_vars() {
		if ( self::$_model['has_request_showing_popup'] ) {
			$user = DispletRetsIdxLeadsModel::get_current_user_data();
			if ( !empty( $user ) ) {
				self::$_model['current_user_id'] = $user['id'];
				self::$_model['current_user_name'] = $user['name'];
				self::$_model['current_user_email'] = $user['email'];
				self::$_model['current_user_phone'] = $user['phone'];
			}
			/*
			$current_user = wp_get_current_user();
			if ( !empty( $current_user->ID ) ) {
				self::$_model['current_user_id'] = $current_user->ID;
				self::$_model['current_user_name'] = $current_user->display_name;
				self::$_model['current_user_email'] = $current_user->user_email;
				self::$_model['current_user_phone'] = get_user_meta( $current_user->ID, 'displet_phone', true );
			}
			*/
		}
	}

	private static function maybe_set_query_args() {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_property_update_page'] ) {
			self::$_model['id'] = self::$_model['property_id'];
			self::$_model['num_listings'] = 1;
			self::$_model['return_fields'] = 'all';
		}
	}

	private static function maybe_set_residentials_args() {
		if ( self::$_model['is_property_showcase_page'] ) {
			self::$_model['data_from'] = 'property_showcase';
		}
		if ( self::$_model['is_partial_address_page'] || self::$_model['is_search_results_page'] ) {
			if ( self::$_options['include_stats'] === 'advanced' || self::$_options['listings_layout'] === 'table' ) {
				self::$_model['statuses'] = DispletRetsIdxSettingsController::get_filtered_statuses();
			}
			if ( self::$_options['include_stats'] === 'advanced' ) {
				self::$_model['get_stats_by_status'] = true;
			}
			if ( self::$_options['listings_layout'] === 'table' ) {
				self::$_model['get_listings_by_status'] = true;
				if ( self::$_options['include_stats'] !== 'basic' ) {
					self::$_model['get_residentials'] = false;
				}
			}
		}
	}

	private static function _set_canonical() {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_property_update_page'] ) {
	    	self::$_model['canonical'] = self::$_model['listings'][0]->permalink;
		}
		else if ( self::$_model['is_partial_address_page'] ) {
	    	self::$_model['canonical'] = DispletRetsIdxUtilities::get_listing_permalink( array(
	    		'page_url' => self::$_model['property_details_page_url'],
	    		'state' => self::$_model['property_state'],
	    		'city' => self::$_model['property_city'],
	    		'zip' => self::$_model['property_zip']
	    	) );
		}
	}

	private static function _set_is_canonical() {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_property_update_page'] || self::$_model['is_partial_address_page'] ) {
			if ( ( !empty( self::$_model['property_id'] ) && !empty( self::$_model['property_zip'] ) && !empty( self::$_model['property_city'] ) && !empty( self::$_model['property_state'] ) ) || !empty( self::$_model['property_update_id'] ) && !empty( self::$_model['listings'][0]->permalink ) ) {
				$trimmed_url_end = rtrim( $_SERVER['REQUEST_URI'], '/' );
				$trimmed_permalink_end = rtrim( DispletRetsIdxUtilities::get_domainless_url( self::$_model['listings'][0]->permalink ), '/' );
				if ( !empty( $trimmed_url_end ) && !empty( $trimmed_permalink_end ) && $trimmed_permalink_end != $trimmed_url_end ) {
					self::$_model['is_canonical'] = false;
				}
			}
		}
	}
}

?>