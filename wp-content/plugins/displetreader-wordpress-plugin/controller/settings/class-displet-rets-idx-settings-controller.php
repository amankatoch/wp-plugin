<?php

class DispletRetsIdxSettingsController extends DispletRetsIdxSettingsModel {
	public static function add_page() {
		self::$_settings_page = new DispletRetsIdxOptions( array(
			'div_id' => 'displet-rets-idx-options',
			'menu_title' => 'RETS/IDX Settings',
			'options_slug' => self::$_slugs['options']['settings'],
			'page_slug' => self::$_slugs['settings_page'],
			'page_title' => 'Displet RETS/IDX Settings',
			'scripts' => array(
				'jquery',
				'media-upload',
				'thickbox',
				'wp-color-picker',
			),
			'styles' => array(
				'thickbox',
				'wp-color-picker',
			),
		), self::_get_sections(), self::_get_options() );
		DispletRetsIdxSettingsController::maybe_take_action_from_settings_update();
	}

	public static function get_defaults() {
		$defaults = array();
		$options = self::_get_options();
		if ( !empty( $options ) ) {
			foreach ( $options as $option ) {
				$defaults[ $option['id'] ] = $option['std'];
			}
		}
		return $defaults;
	}

	public static function globalize() {
		global $displetretsidx_option;
		$displetretsidx_option = self::$_options;
	}

    public static function register_default_settings() {
	    $has_default_page = get_page_by_path( 'rets' );
	    if ( !$has_default_page ) {
	        $displet_default_rets_idx_page = array(
	          'post_name' => 'rets',
	          'post_title' => 'Real Estate',
	          'post_type' => 'page',
	          'post_status' => 'publish'
	        );
	        wp_insert_post( $displet_default_rets_idx_page );
	    }
	    $displetretsidx_option = self::get_defaults();
		add_option( 'displet_rets_idx_options', $displetretsidx_option );
	}

	public static function set_cookie() {
		check_ajax_referer( 'displet_set_cookie_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_set_cookie_request' ) {
			if ( !empty( $_POST['name'] ) && !empty( $_POST['value'] ) ) {
        		setcookie( $_POST['name'], $_POST['value'], 0, '/' );
			}
		}
		die();
	}

	public static function get_cookies() {
		check_ajax_referer( 'displet_get_cookies_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_get_cookies_request' ) {
			$cookies = new stdClass();
			$cookies->last_viewed_sort = $_COOKIE['displetretsidx_last_viewed_sort'];
			$cookies->last_viewed_hash = $_COOKIE['displetretsidx_last_viewed_hash'];
			$cookies->last_viewed_orientation = $_COOKIE['displetretsidx_last_viewed_orientation'];
			$cookies->last_viewed_count = $_COOKIE['displetretsidx_last_viewed_count'];
			$cookies->last_search_count = $_COOKIE['displetretsidx_last_search_count'];
			$cookies->referring_site = $_COOKIE['displetretsidx_referring_site'];
			$cookies->use_mobile = $_COOKIE['displetretsidx_use_mobile'];
			$cookies->user_address = $_COOKIE['displetretsidx_user_submitted_address']; // AustinHomeSeller.com custom functionality
			$cookies->user_address_time = $_COOKIE['displetretsidx_user_submitted_address_time']; // AustinHomeSeller.com custom functionality
			echo json_encode( $cookies );
		}
		die();
	}

	public static function get_filtered_statuses() {
		$field_options = DispletRetsIdxOptionsController::get_option( 'fields' );
		if ( !empty( $field_options['status'] ) && is_array( $field_options['status'] ) ) {
			return $field_options['status'];
		}
		return false;
	}

	public static function maybe_get_field_options( $options, $action_options ) {
		$field_options = DispletRetsIdxOptionsController::get_option( 'fields' );
		$is_new_api_key = DispletRetsIdxUtilities::is_new_api_key( $action_options, $options );
		if ( $is_new_api_key || empty( $field_options ) ) {
			self::update_field_options( $options, true );
			return array(
				'displet_app_key' => $options['displet_app_key']
			);
		}
		return false;
	}

	public static function get_field_values($field, $api_key){
		$query_url = self::$_api_url . '/residentials/field_options?field=' . $field . '&authentication_token=' . $api_key;
		$query_args = array(
			'timeout' => 10,
			'headers' => array(
				'referer' => home_url()
			)
		);
		$json_array = wp_remote_get($query_url, $query_args);
		if (is_array($json_array)) {
			$json_data = json_decode($json_array['body']);
			return $json_data->field_options;
		}
	}

	public static function has_property_filter() {
		if ( !empty( self::$_options['city_include_filter'] ) && is_array( self::$_options['city_include_filter'] ) ) {
			$city_include_filter = array_filter( self::$_options['city_include_filter'], array( 'DispletRetsIdxUtilities', 'remove_false_as_string' ) );
		}
		else {
			$city_include_filter = false;
		}
		if ( !empty( self::$_options['property_type_include_filter'] ) && is_array( self::$_options['property_type_include_filter'] ) ) {
			$property_type_include_filter = array_filter( self::$_options['property_type_include_filter'], array( 'DispletRetsIdxUtilities', 'remove_false_as_string' ) );
		}
		else {
			$property_type_include_filter = false;
		}
		if (
			!empty( $city_include_filter ) ||
			!empty( self::$_options['min_price_filter'] ) ||
			!empty( self::$_options['max_price_filter'] ) ||
			!empty( $property_type_include_filter ) ||
			!empty( self::$_options['zip_code_include_filter'] )
		) {
			return true;
		}
		return false;
	}

	public static function maybe_update_page_options( $options, $action_options ) {
		$is_new_search_results_page = DispletRetsIdxUtilities::is_option_new( 'search_results_page_id', $action_options, $options );
		$is_new_property_details_page = DispletRetsIdxUtilities::is_option_new( 'property_details_page_id', $action_options, $options );
		if ( $is_new_search_results_page || $is_new_property_details_page ) {
			DispletRetsIdxRewriteController::reset_flush_rewrite_rules();
			return array(
				'search_results_page_id' => $options['search_results_page_id'],
				'property_details_page_id' => $options['property_details_page_id']
			);
		}
		return false;
	}

	public static function maybe_update_email_activity_report( $options, $action_options ) {
		if ( DispletRetsIdxUtilities::email_activity_has_changed( $action_options, $options ) ) {
			DispletRetsIdxEmailController::adjust_activity_report_schedule();
			return array(
				'email_activity' => $options['email_activity']
			 );
		}
		return false;
	}

	public static function maybe_update_property_suggestions( $options, $action_options ) {
		$has_changed_use_property_suggestions = DispletRetsIdxUtilities::has_option_changed( 'use_property_suggestions', $action_options, $options );
		$is_new_property_suggestions_views_min = DispletRetsIdxUtilities::is_option_new( 'property_suggestions_views_min', $action_options, $options );
		$is_new_property_suggestions_zips_min = DispletRetsIdxUtilities::is_option_new( 'property_suggestions_zips_min', $action_options, $options );
		$is_new_property_suggestions_price_variance = DispletRetsIdxUtilities::is_option_new( 'property_suggestions_price_variance', $action_options, $options );
		$is_new_property_suggestions_square_footage_variance = DispletRetsIdxUtilities::is_option_new( 'property_suggestions_square_footage_variance', $action_options, $options );
		if ( $has_changed_use_property_suggestions || $is_new_property_suggestions_views_min || $is_new_property_suggestions_zips_min || $is_new_property_suggestions_price_variance || $is_new_property_suggestions_square_footage_variance ) {
			DispletRetsIdxPropertySuggestionsApiController::update( $options['displet_app_key'], array(
				'turned_on' => $options['use_property_suggestions'],
				'property_views_threshold' => $options['property_suggestions_views_min'],
				'zip_codes_to_include' => $options['property_suggestions_zips_min'],
				'price_variation' => $options['property_suggestions_price_variance'],
				'footage_variation' => $options['property_suggestions_square_footage_variance']
			 ) );
			return array(
				'use_property_suggestions' => $options['use_property_suggestions'],
				'property_suggestions_views_min' => $options['property_suggestions_views_min'],
				'property_suggestions_zips_min' => $options['property_suggestions_zips_min'],
				'property_suggestions_price_variance' => $options['property_suggestions_price_variance'],
				'property_suggestions_square_footage_variance' => $options['property_suggestions_square_footage_variance']
			 );
		}
		return false;
	}

	private static function maybe_update_saved_searches( $options, $action_options ) {
		$has_changed_property_type_filter = DispletRetsIdxUtilities::has_option_changed( 'property_type_include_filter', $action_options, $options );
		$has_changed_zip_code_filter = DispletRetsIdxUtilities::has_option_changed( 'zip_code_include_filter', $action_options, $options );
		$has_changed_city_filter = DispletRetsIdxUtilities::has_option_changed( 'city_include_filter', $action_options, $options );
		$has_changed_min_price_filter = DispletRetsIdxUtilities::has_option_changed( 'min_price_filter', $action_options, $options );
		$has_changed_max_price_filter = DispletRetsIdxUtilities::has_option_changed( 'max_price_filter', $action_options, $options );
		if ( $has_changed_property_type_filter || $has_changed_zip_code_filter || $has_changed_city_filter || $has_changed_min_price_filter || $has_changed_max_price_filter ) {
			DispletRetsIdxUsersUpdatesController::add_property_filter_to_saved_searches();
			return array(
				'property_type_include_filter' => $options['property_type_include_filter'],
				'zip_code_include_filter' => $options['zip_code_include_filter'],
				'city_include_filter' => $options['city_include_filter'],
				'min_price_filter' => $options['min_price_filter'],
				'max_price_filter' => $options['max_price_filter'],
			);
		}
		return false;
	}

	public static function maybe_take_action_from_settings_update() {
		$options = DispletRetsIdxOptionsController::get_option();
		$action_options = DispletRetsIdxOptionsController::get_option( 'action' );
		if ( empty( $action_options ) ) $action_options = array();
		$new_action_options = array();
		$new_action_options[] = DispletRetsIdxSettingsController::maybe_update_page_options( $options, $action_options );
		$new_action_options[] = DispletRetsIdxSettingsController::maybe_authenticate_api_key( $options, $action_options );
		$new_action_options[] = DispletRetsIdxSettingsController::maybe_get_field_options( $options, $action_options );
		$new_action_options[] = DispletRetsIdxSettingsController::maybe_update_email_activity_report( $options, $action_options );
		$new_action_options[] = DispletRetsIdxSettingsController::maybe_update_property_suggestions( $options, $action_options );
		$new_action_options[] = self::maybe_update_saved_searches( $options, $action_options );
		$new_action_options[] = self::_maybe_update_email_templates_api( $options, $action_options );
		$new_action_options = array_filter( $new_action_options );
		if ( !empty( $new_action_options ) ) {
			foreach ( $new_action_options as $new_action_option ) {
				if ( !empty( $new_action_option ) && is_array( $new_action_option ) ) {
					$action_options = array_merge( $action_options, $new_action_option );
				}
			}
			DispletRetsIdxOptionsController::update_option( 'action', $action_options );
		}
	}

    public static function update_notify_version_ajax() {
        check_ajax_referer( 'displet_update_notify_version_nonce' );
        if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_update_notify_version_request' && !empty( $_POST['version'] ) ) {
        	DispletRetsIdxOptionsController::update_option( 'notify', $_POST['version'] );
        }
        die();
    }

	public static function update_api_website_values( $api_key, $modify_token, $email_address ) {
		$home_url = home_url();
		$trimmed_domain = DispletRetsIdxUtilities::remove_url_suffixes( DispletRetsIdxUtilities::remove_url_prefixes( $home_url ) );
		$query_url = self::$_api_url . '/api_apps/' . $api_key;
		$query_args = array(
			'method' => 'PUT',
			'timeout' => 10,
			'headers' => array(
				'referer' => $home_url
			 ),
			'body' => array(
				'email' => $email_address,
				'domain' => $trimmed_domain,
				'authentication_token' => $api_key,
				'modify_token' => $modify_token
			 )
		 );
		$json_array = wp_remote_post( $query_url, $query_args );
		if ( is_array( $json_array ) && !empty( $json_array['body'] ) ) {
			$json_response = json_decode( $json_array['body'] );
			if ( !empty( $json_response->success ) ) {
				return $home_url;
			}
		}
		return false;
	}

	public static function maybe_authenticate_api_key( $options, $action_options ) {
		$is_new_api_key = DispletRetsIdxUtilities::is_new_api_key( $action_options, $options );
		$is_new_email_address = DispletRetsIdxUtilities::is_new_email_address( $action_options, $options );
		$is_new_api_token = DispletRetsIdxUtilities::is_new_api_token( $action_options, $options );
		if ( $is_new_api_key || $is_new_email_address || $is_new_api_token || ( empty( $options['email_from_address'] ) && !empty( $action_options['email_from_address'] ) ) ) {
			$email_address = ( !empty( $options['email_from_address'] ) ) ? $options['email_from_address'] : get_bloginfo( 'admin_email' );
			$authenticated_url = self::update_api_website_values( $options['displet_app_key'], $options['displet_app_token'], $email_address );
			self::$_settings_page->update_field( 'displet_app_key', $authenticated_url, 'auth' );
			return array(
				'authenticated_url' => $authenticated_url,
				'displet_app_key' => $options['displet_app_key'],
				'displet_app_token' => $options['displet_app_token'],
				'email_from_address' => $options['email_from_address']
			);
		}
		return false;
	}

	private static function _maybe_update_email_templates_api( $options, $action_options ) {
		if ( self::_has_new_email_template_option( $options, $action_options ) ) {
			self::update_email_templates_at_api( $options );
			$new_action_options = array();
			$option_slugs_for_api_params = DispletRetsIdxEmailTemplatesModel::get_option_slugs();
			foreach ( $option_slugs_for_api_params as $slug ) {
				$new_action_options[ $slug ] = $options[ $slug ];
			}
			return $new_action_options;
		}
		return false;
	}

	public static function update_email_templates_at_api( $options ) {
		$option_slugs_for_api_params = DispletRetsIdxEmailTemplatesModel::get_option_slugs_for_api_params();
		if ( !empty( $option_slugs_for_api_params ) && is_array( $option_slugs_for_api_params ) ) {
			$api_args = array();
			$defaults = self::_get_email_template_options_with_defaults();
			$replacements = DispletRetsIdxEmailModel::get_base_replacements();
			$placeholder_options = DispletRetsIdxEmailTemplatesModel::get_option_slugs_with_placeholders();
			foreach ( $option_slugs_for_api_params as $param => $slug ) {
				$value = !empty( $options[ $slug ] ) ? $options[ $slug ] : $defaults[ $slug ]['std'];
				if ( $param === 'banner_ad_url' || $param === 'logo_url' ) {
					if ( !empty( $value ) ) {
						$value = DispletRetsIdxUtilities::get_image_src( $value );
					}
				}
				elseif ( in_array( $slug, $placeholder_options ) ) {
					$value = DispletRetsIdxEmailModel::replace_placeholders( $value, $replacements );
				}
				$api_args[ $param ] = empty( $value ) ? null : $value;
			}
			$api = new DispletRetsIdxEmailTemplatesApi( $api_args );
			$api->update();
		}
	}

	public static function update_field_options( $options, $update_settings_page = false ) {
		if ( !empty( $options['displet_app_key'] ) ) {
			$field_options = array(
				'area_mls_defined' => self::get_field_values( 'area_mls_defined', $options['displet_app_key'] ),
				'city' => self::get_field_values( 'city', $options['displet_app_key'] ),
				'property_type' => self::get_field_values( 'property_type', $options['displet_app_key'] ),
				'school_district' => self::get_field_values( 'school_district', $options['displet_app_key'] ),
				'state' => self::get_field_values( 'state', $options['displet_app_key'] ),
				'status' => self::get_field_values( 'status', $options['displet_app_key'] ),
				'zip' => self::get_field_values( 'zip', $options['displet_app_key'] ),
			);
			foreach ( $field_options as $field => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value as $key => $val ) {
						$value[ $val ] = $val;
						unset( $value[ $key ] );
					}
				}
				else {
					$value = array();
				}
				if ( $update_settings_page ) {
					self::$_settings_page->update_field( $field . '_include_filter', $value );
				}
			}
			DispletRetsIdxOptionsController::update_option( 'fields', $field_options );
			do_action( 'displetretsidx_post_field_options_update', $field_options );
		}
	}
}

?>