<?php

class DispletRetsIdxPagesResourcesController extends DispletRetsIdxPagesController {
	public static function enqueue() {
		DispletRetsIdxResourcesController::enqueue_js( 'displet-rets-idx-scripts.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'displetretsidx-google-maps-geocoder' ) );
		DispletRetsIdxResourcesController::enqueue_js( 'modernizr.placeholder.min.js', array( 'jquery' ) );
		if ( !empty( self::$_options['board_translations'] ) && self::$_options['board_translations'] != 'none' ) {
			DispletRetsIdxResourcesController::enqueue_js( 'displet-listing-translations-scripts.js', array( 'jquery' ) );
			DispletRetsIdxResourcesController::enqueue_js( 'displet-listing-translations-variables-' . self::$_options['board_translations'] . '.js', array( 'jquery' ) );
		}
		self::_localize_js();
		self::_include_planwise_js();
		DispletRetsIdxResourcesController::enqueue_css( 'displet-rets-idx-styles.css' );
		wp_enqueue_style(
			'displetretsidx-font-awesome',
			trailingslashit( self::$_urls['includes'] ) . 'font-awesome-4.1.0/css/font-awesome.min.css',
			false,
			self::$_version
		);
	}

	private static function _include_planwise_js() {
		if ( self::$_model['is_property_details_page'] && !empty( self::$_options['use_planwise_affordability'] ) ) {
			wp_enqueue_script(
				'displet-rets-idx-planwise',
				'https://preview-uat.planwise.com/widgets/widgetsLoader',
				false,
				self::$_version
			);
			DispletRetsIdxResourcesController::localize_js(
				'displet-rets-idx-planwise.js',
				'PLANWISE',
				array(
					'widget' => array(
						'configParams' => array(
							'global' => array(
								'partnerReferralId' => 'YH5QSEMHDK',
							),
							'instances' => array(
								array(
									'type' => 'BREst',
									'settings' => array(
										'selector' => '#PLANWISE',
									),
									'data' => array(
										//'propertyId' => '123',
									),
								),
							),
							'shared' => array(
								'data' => array(
									'property' => array(
										'id' => self::$_model['listings'][0]->id,
										'address' => array(
											'streetAddress1' => self::$_model['listings'][0]->address,
											'city' => self::$_model['listings'][0]->city,
											'usState' => self::$_model['listings'][0]->state,
											'county' => self::$_model['listings'][0]->county,
											'postalCode' => self::$_model['listings'][0]->zip,
										),
										'purchasePrice' => self::$_model['listings'][0]->list_price,
									),
								),
							),
						),
					),
				)
			);
		}
	}

	private static function _localize_js() {
		$page = get_query_var( 'paged' );
		$current_user = wp_get_current_user();
		DispletRetsIdxResourcesController::localize_js(
			'displet-rets-idx-scripts.js',
			'displetretsidx',
			array(
				'cookies' => new stdClass(),
				'images' => array(
					'close' => trailingslashit( self::$_urls['css'] ) . 'images/close.png',
					'close_hover' => trailingslashit( self::$_urls['css'] ) . 'images/close_hover.png',
				),
				'is_displet_api' => !empty( self::$_options['displet_app_key'] ) ? true : false,
				'is_ie' => false,
				'listings' => array(),
				'nonces' => array(
					'check_login' => wp_create_nonce( 'displet_check_login_nonce' ),
					'check_user' => wp_create_nonce( 'displet_check_user_nonce' ),
					'email_friend' => wp_create_nonce( 'displet_email_friend_nonce' ),
					'get_clients' => wp_create_nonce( 'displet_get_clients_nonce' ),
					'get_cookies' => wp_create_nonce( 'displet_get_cookies_nonce' ),
					'get_property_showcase_listings' => wp_create_nonce( 'displet_get_property_showcase_listings_nonce' ),
					'login_user' => wp_create_nonce( 'displet_login_user_nonce' ),
					'property_showing' => wp_create_nonce( 'displet_property_showing_nonce' ),
					'register_user' => wp_create_nonce( 'displet_register_user_nonce' ),
					'save_property' => wp_create_nonce( 'displet_save_property_nonce' ),
					'save_search' => wp_create_nonce( 'displet_save_search_nonce' ),
					'save_search_registration' => wp_create_nonce( 'displet_save_search_registration_nonce' ),
					'set_cookie' => wp_create_nonce( 'displet_set_cookie_nonce' ),
					'update_searches' => wp_create_nonce( 'displet_update_searches_nonce' ),
				 ),
				'options' => array(
					'add_price_to_url' => !empty( self::$_options['add_price_to_url'] ) ? true : false,
					'address_format' => self::$_options['address_format'],
					'category' => !empty( self::$_options['oodle_category'] ) ? self::$_options['oodle_category'] : 'housing/sale',
					'city_include_filter' => $city_include_filter,
					'disclaimer_image' => self::$_options['disclaimer_image'],
					'emphasize_listing_office_and_agent' => ( !empty( self::$_options['emphasize_listing_office_and_agent'] ) ) ? true : false,
					'emphasize_mls_number' => ( !empty( self::$_options['emphasize_mls_number'] ) ) ? true : false,
					'exclude_referred_visitors' => self::$_options['exclude_referred_visitors'],
					'facebook_app_id' => self::$_options['facebook_app_id'],
					'facebook_channel' => plugins_url( 'displetreader-wordpress-plugin/js/channel.html' ),
					'include_disclaimer_image' => !empty( self::$_options['include_disclaimer_image'] ) ? true : false,
					'map_variance' => !empty( self::$_options['map_variance'] ) ? intval( self::$_options['map_variance'] ) : 2,
					'max_price_filter' => !empty( self::$_options['max_price_filter'] ) && is_numeric( self::$_options['max_price_filter'] ) ? intval( self::$_options['max_price_filter'] ) : false,
					'min_price_filter' => !empty( self::$_options['min_price_filter'] ) && is_numeric( self::$_options['min_price_filter'] ) ? intval( self::$_options['min_price_filter'] ) : false,
					'orientation' => self::$_options['listings_orientation'],
					'property_type_include_filter' => $property_type_include_filter,
					'public_views' => ( !empty( self::$_options['allowed_public_views'] ) && is_numeric( self::$_options['allowed_public_views'] ) ) ? intval( self::$_options['allowed_public_views'] ) : 0,
					'public_searches' => ( !empty( self::$_options['allowed_public_searches'] ) && is_numeric( self::$_options['allowed_public_searches'] ) ) ? intval( self::$_options['allowed_public_searches'] ) : 0,
					'registration_type' => !empty( self::$_options['registration_type'] ) ? self::$_options['registration_type'] : 'hard',
					'require_registration_to_search' => !empty( self::$_options['require_registration_to_search'] ) ? true : false,
					'require_registration_to_view_properties' => !empty( self::$_options['require_registration_to_view_properties'] ) ? true : false,
					'results_limit' => ( !empty( self::$_options['results_limit'] ) ) ? intval( self::$_options['results_limit'] ) : false,
					'use_polygon_search' => !empty( self::$_options['use_polygon_search'] ) ? true : false,
					'use_price_reduction' => !empty( self::$_options['use_price_reduction'] ) ? true : false,
					'zip_code_include_filter' => $zip_code_include_filter,
				 ),
				'pages' => array(
					'is_mobile_page' => self::$_model['is_mobile_page'] ? true : false,
					'is_property_details_page' => self::$_model['is_property_details_page'] ? true : false,
					'is_search_results_page' => self::$_model['is_search_results_page'] ? true : false,
				 ),
				'property' => array(
					'address' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->address : false,
					'city' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->city : false,
					'id' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->id : false,
					'image_url' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->image_urls : false,
					'latitude' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->latitude : false,
					'listing_agent_email' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->listing_agent_email : false,
					'longitude' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->longitude : false,
					'mls_number' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->mls_number : false,
					'permalink' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->permalink : false,
					'price' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->list_price : false,
					'square_feet' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->square_feet : false,
					'state' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->state : false,
					'zip' => self::$_model['is_property_details_page'] ? self::$_model['listings'][0]->zip : false,
				 ),
				'queries' => array(),
				'search' => '',
				'search_field_labels' => !empty( self::$_model['search_field_labels'] ) ? self::$_model['search_field_labels'] : array(),
				'urls' => array(
					'ajax' => admin_url( 'admin-ajax.php' ),
					'current_page' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
					'home' => home_url(),
					'referrer' => !empty( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : '',
					'mobile_property_details_page' => home_url( 'rets-mobile' ),
					'mobile_search_results_page' => home_url( 'rets-mobile' ),
					'search_results_page' => get_permalink( self::$_options['search_results_page_id'] ),
					'property_details_page' => get_permalink( self::$_options['property_details_page_id'] ),
				 ),
				'user' => array(
					'email' => !empty( $current_user->user_email ) ? $current_user->user_email : '',
					'is_logged_in' => is_user_logged_in() ? true : false,
					'can_view_leads' => current_user_can( 'displet_view_leads' ) ? true : false,
				 ),
				'wp' => array(
					'is_mobile_contact_page' => is_post_type_archive( 'rets-mobile-contact' ),
					'is_mobile_home_page' => is_post_type_archive( 'rets-mobile-home' ),
					'is_mobile_property_details_page' => is_post_type_archive( 'rets-mobile' ),
					'is_mobile_search_results_page' => is_post_type_archive( 'rets-mobile' ),
					'is_property_details_page' => is_page( self::$_options['property_details_page_id'] ),
					'is_search_results_page' => is_page( self::$_options['search_results_page_id'] ),
					'page' => !empty( $page ) ? $page : 1,
				),
			)
		);
	}

	public static function set_referral_cookie() {
		if ( empty( $_COOKIE['displetretsidx_referring_site'] ) ) {
        	setcookie( 'displetretsidx_referring_site', $_SERVER['HTTP_REFERER'], 0, '/' );
		}
	}
}

?>