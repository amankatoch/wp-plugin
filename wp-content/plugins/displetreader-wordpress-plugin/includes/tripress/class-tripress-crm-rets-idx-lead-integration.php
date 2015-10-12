<?php

class TripressCrmRetsIdxLeadIntegration {
	protected static $_assigned_agent_id;
	protected static $_base_url;
	protected static $_boolean_search_fields = array(
		'basement',
		'is_foreclosure',
		'is_gated_community',
		'master_on_main',
		'pool_on_property',
		'short_sale',
		'waterfront',
	);
	protected static $_crm_password;
	protected static $_crm_username;
	protected static $_endpoints = array(
		'authenticate' => '/crm/app/index.php/zurmo/api/login',
		'contacts' => array(
			'new' => '/crm/app/index.php/contacts/contact/api/create',
			'update' => '/crm/app/index.php/contacts/contact/api/update',
		),
		'idx_lead' => array(
			'new' => '/crm/app/index.php/displet/displetIdxLead/api/create',
			'update' => '/crm/app/index.php/displet/displetIdxLead/api/update',
		),
		'idx_lead_property' => array(
			'new' => '/crm/app/index.php/displet/displetIdxLeadProperty/api/create',
		),
		'idx_lead_property_view' => array(
			'new' => '/crm/app/index.php/displet/displetIdxLeadPropertyView/api/create',
		),
		'idx_lead_search' => array(
			'new' => '/crm/app/index.php/displet/displetIdxLeadSearch/api/create',
		),
	);
	protected static $_headers;
	protected static $_meta_keys = array(
		'assigned_agent_id' => 'tripress_assigned_agent_id',
		'crm_contact_id' => 'tripress_crm_contact_id',
		'crm_idx_id' => 'tripress_crm_idx_id',
		'crm_idx_lead_id' => 'tripress_crm_idx_lead_id',
		'crm_password' => 'tripress_crm_pw',
		'crm_url' => 'tripress_crm_url',
		'crm_username' => 'tripress_crm_user',
		'user_phone' => 'tripress_user_phone',
	);
	protected static $_numeric_search_fields = array(
		'id',
		'listed_since',
		'last_modified',
		'max_bathrooms',
		'max_bedrooms',
		'max_list_price',
		'max_price_per_sq_feet',
		'max_square_feet',
		'max_square_feet_available',
		'min_acres',
		'min_bathrooms',
		'min_bedrooms',
		'min_list_price',
		'min_lot_size',
		'min_price_per_sq_feet',
		'min_square_feet',
		'min_square_feet_available',
		'min_stories',
		'year_built',
	);
	protected static $_search_field_translations = array(
		'areaMlsDefined' => 'area_mls_defined',
		'basement' => 'basement',
		'city' => 'city',
		'county' => 'county',
		'external_id' => 'id',
		'isForeclosure' => 'is_foreclosure',
		'isGatedCommunity' => 'is_gated_community',
		'keyword' => 'keyword',
		'listedSince' => 'listed_since',
		'lastModified' => 'last_modified',
		'listingAgentId' => 'listing_agent_id',
		'listingOfficeId' => 'listing_office_id',
		'masterOnMain' => 'master_on_main',
		'maxBathrooms' => 'max_bathrooms',
		'minBathrooms' => 'min_bathrooms',
		'maxBedrooms' => 'max_bedrooms',
		'minBedrooms' => 'min_bedrooms',
		'maxPricePerSqFeet' => 'max_price_per_sq_feet',
		'minPricePerSqFeet' => 'min_price_per_sq_feet',
		'maxListPrice' => 'max_list_price',
		'minListPrice' => 'min_list_price',
		'maxSquareFeet' => 'max_square_feet',
		'minSquareFeet' => 'min_square_feet',
		'maxSquareFeetAvailable' => 'max_square_feet_available',
		'minSquareFeetAvailable' => 'min_square_feet_available',
		'minAcres' => 'min_acres',
		'minLotSize' => 'min_lot_size',
		'minStories' => 'min_stories',
		'mlsNumber' => 'mls_number',
		'poly' => 'poly',
		'poolOnProperty' => 'pool_on_property',
		'propertyType' => 'property_type',
		'quickTerms' => 'quick_terms',
		'school' => 'school',
		'schoolDistrict' => 'school_district',
		'shortSale' => 'short_sale',
		'state' => 'state',
		'status' => 'status',
		'streetName' => 'street_name',
		'streetNumber' => 'street_number',
		'subdivision' => 'subdivision',
		'waterfront' => 'waterfront',
		'yearBuilt' => 'year_built',
		'zip' => 'zip',
	);
	protected static $_session_id;
	protected static $_token;

	private static function _authenticate_user() {
		if ( !empty( self::$_crm_username ) && !empty( self::$_crm_password ) ) {
    		$url = self::$_base_url . self::$_endpoints['authenticate'];
			$headers = array(
				'Accept: application/json',
				'ZURMO_AUTH_USERNAME: ' . self::$_crm_username,
				'ZURMO_AUTH_PASSWORD: ' . self::$_crm_password,
				'ZURMO_API_REQUEST_TYPE: REST',
    		);
    		$response_array = TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'POST', $headers );
    		$response = json_decode( $response_array );
    		if ( $response->status === 'SUCCESS' ) {
    			self::$_session_id = $response->data->sessionId;
    			self::$_token = $response->data->token;
    		}
		}
	}

	private static function _get_current_date() {
		return date( 'Y-m-d H:i:s', current_time( 'timestamp' ) );
	}

	private static function _get_data_for_new_crm_contact_from_user( $user_id ) {
		$user_data = get_userdata( $user_id );
		return array(
			'firstName' => !empty( $user_data->first_name ) ? $user_data->first_name : 'Unknown',
			'lastName' => !empty( $user_data->last_name ) ? $user_data->last_name : 'Unknown',
			'mobilePhone' => $user_data->{ self::$_meta_keys['user_phone'] },
			'primaryEmail' => array(
				'emailAddress' => $user_data->user_email,
			),
			'source' => array(
				'value' => 'TRIBUS IDX',
			),
			'state' => array(
				'id' => 2,
			),
			'idxSubscribeDate' => self::_get_current_date(),
			'idxLastActivityDate' => self::_get_current_date(),
		);
	}

	private static function _get_search_details_from_hash( $hash ) {
		$details = array();
		if ( !empty( $hash ) ) {
			$field_value_pairs = array_map( 'trim', explode( '/', ltrim( $hash, '#' ) ) );
			if ( !empty( $field_value_pairs ) ) {
				foreach ( $field_value_pairs as $field_value_pair ) {
					$field_value_array = array_map( 'trim', explode( '=', $field_value_pair ) );
					if ( !empty( $field_value_array ) && count( $field_value_array ) === 2 ) {
						$details[ $field_value_array[0] ] = urldecode( $field_value_array[1] );
					}
				}
			}
		}
		return $details;
	}

	private static function _get_sysid_from_property_url_suffix( $url_suffix ) {
		$property_id_match = preg_match( '~^[^/]+/[^/]+/[^/]+/([^/]+)~', $url_suffix, $property_id_matches );
		if ( !empty( $property_id_match ) && is_array( $property_id_matches ) ) {
			return $property_id_matches[1];
		}
		return false;
	}

	private static function _get_translated_search_fields( $fields ) {
		$translated_search_fields = array();
		if ( !empty( $fields ) && is_array( $fields ) ) {
			foreach ( $fields as $field => $value ) {
				if ( $translated_key = array_search( strtolower( $field ), self::$_search_field_translations ) ) {
					if ( $field === 'min_list_price' || $field === 'max_list_price' ) {
						$value = intval( $value ) * 1000;
					}
					elseif ( in_array( $field, self::$_numeric_search_fields ) ) {
						$value = intval( $value );
					}
					elseif ( in_array( $field, self::$_boolean_search_fields ) ) {
						$value = $value === 'Y' || $value === '1' ? true : false;
					}
					$translated_search_fields[ $translated_key ] = $value;
				}
			}
		}
		return $translated_search_fields;
	}

	private static function _get_url_from_property_url_suffix( $url_suffix ) {
		if ( !empty( $url_suffix ) && function_exists( 'displetretsidx_get_property_details_page_id' ) ) {
			$search_results_page_id = displetretsidx_get_property_details_page_id();
			return trailingslashit( get_permalink( $search_results_page_id ) ) . $url_suffix;
		}
		return false;
	}

	private static function _is_ready_to_send() {
		if ( !empty( self::$_base_url ) && !empty( self::$_headers ) ) {
			return true;
		}
		return false;
	}

	private static function _prepare_to_send() {
		self::_set_base_url();
		self::_set_crm_user_pass();
		self::_authenticate_user();
		self::_set_headers();
	}

	public static function save_api_user_id_after_lead_registration( $user_id, $api_user_id ) {
		if ( !empty( $user_id ) && !empty( $api_user_id ) ) {
			update_user_meta( $user_id, self::$_meta_keys['crm_idx_id'], $api_user_id );
			self::_update_rets_idx_lead_with_crm_after_api_user_id_assigned( $user_id, $api_user_id );
		}
	}

	public static function save_assigned_agent_id_on_lead_assignation( $user_id, $assignation_details ) {
		if ( !empty( $user_id ) && !empty( $assignation_details['assigned_agent_id'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['assigned_agent_id'], $assignation_details['assigned_agent_id'] );
		}
	}

	public static function save_assigned_agent_id_on_lead_registration( $user_id, $user_details ) {
		if ( !empty( $user_id ) && !empty( $user_details['assigned_agent_id'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['assigned_agent_id'], $user_details['assigned_agent_id'] );
		}
	}

	public static function save_phone_on_lead_registration( $user_id, $user_details ) {
		if ( !empty( $user_id ) && !empty( $user_details['phone'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['user_phone'], $user_details['phone'] );
		}
	}

	public static function save_phone_on_lead_update( $user_id, $user_details ) {
		if ( !empty( $user_id ) && isset( $user_details['phone'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['user_phone'], $user_details['phone'] );
		}
	}

	public static function schedule_sending_rets_idx_leads_to_crm_on_addition_of_crm_credentials( $user_id ) {
		if ( current_user_can( 'edit_user', $user_id ) && !empty( $_POST[ self::$_meta_keys['crm_username'] ] ) && !empty( $_POST[ self::$_meta_keys['crm_password'] ] ) ) {
			$previous_username = get_user_meta( $user_id, self::$_meta_keys['crm_username'], true );
			$previous_password = get_user_meta( $user_id, self::$_meta_keys['crm_password'], true );
			if ( empty( $previous_username ) && empty( $previous_password ) ) {
				wp_schedule_single_event( time() + 30, 'tripress_schedule_sending_new_rets_idx_leads_to_crm_per_agent', array( $user_id ) );
			}
		}
	}

	public static function schedule_sending_new_rets_idx_leads_to_crm_per_agent( $assigned_agent_id ) {
		if ( !empty( $assigned_agent_id ) ) {
			$leads = get_users( array(
				'meta_key' => self::$_meta_keys['assigned_agent_id'],
				'meta_value' => $assigned_agent_id,
			) );
			if ( !empty( $leads ) && is_array( $leads ) ) {
				$count = count( $leads );
				$delay = $count * 2;
				$offset = 0;
				foreach ( $leads as $lead ) {
					wp_schedule_single_event( time() + $delay + ( $offset * 15 ), 'tripress_send_new_rets_idx_lead_to_crm_per_lead', array( $assigned_agent_id, $lead->ID ) );
					$offset++;
				}
			}
		}
	}

	private static function _send_new_rets_idx_lead_property_to_crm( $idx_lead_id, $data ) {
		if ( !empty( $idx_lead_id ) && !empty( $data ) ) {
			self::_prepare_to_send();
			if ( self::_is_ready_to_send() ) {
				$url = self::$_base_url . self::$_endpoints['idx_lead_property']['new'];
    			$response_array = TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'POST', self::$_headers, array( 'data' => $data ) );
    			$response = json_decode( $response_array );
    			if ( $response->status === 'SUCCESS' ) {
    				$idx_lead_update_data = array(
    					'modelRelations' => array(
    						'displetIdxLeadProperties' => array(
    							array(
    								'action' => 'add',
    								'modelClassName' => 'DispletIdxLeadProperty',
    								'modelId' => $response->data->id,
    							),
    						),
    					),
    				);
    				self::_update_rets_idx_lead_with_crm_as_idx_lead( $idx_lead_id, $idx_lead_update_data );
				}
    		}
		}
	}

	public static function send_new_rets_idx_lead_property_to_crm_on_property_save( $user_id, $property_details ) {
		if ( !empty( $user_id ) && !empty( $property_details ) ) {
			$idx_lead_id = get_user_meta( $user_id, self::$_meta_keys['crm_idx_lead_id'], true );
			if ( !empty( $idx_lead_id ) ) {
				self::_set_assigned_agent_id( $user_id );
				self::_send_new_rets_idx_lead_property_to_crm( $idx_lead_id, array(
					'address' => $property_details['address'],
					'comments' => $property_details['message'],
					'price' => intval( $property_details['price'] ),
					'primaryPhotoUrl' => $property_details['image_url'],
					'property_id' => self::_get_sysid_from_property_url_suffix( $property_details['url'] ),
					'rating' => $property_details['rating'],
					'squareFeet' => intval( $property_details['square_feet'] ),
					'type' => $property_details['type'],
					'url' => self::_get_url_from_property_url_suffix( $property_details['url'] ),
					'zip' => $property_details['zip'],
                ) );
			}
		}
	}

	private static function _send_new_rets_idx_lead_property_view_to_crm( $idx_lead_id, $data ) {
		if ( !empty( $data ) ) {
			self::_prepare_to_send();
			if ( self::_is_ready_to_send() ) {
				$url = self::$_base_url . self::$_endpoints['idx_lead_property_view']['new'];
    			$response_array = TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'POST', self::$_headers, array( 'data' => $data ) );
    			$response = json_decode( $response_array );
    			if ( $response->status === 'SUCCESS' ) {
    				$idx_lead_update_data = array(
    					'modelRelations' => array(
    						'displetIdxLeadPropertyViews' => array(
    							array(
    								'action' => 'add',
    								'modelClassName' => 'DispletIdxLeadPropertyView',
    								'modelId' => $response->data->id,
    							),
    						),
    					),
    				);
    				self::_update_rets_idx_lead_with_crm_as_idx_lead( $idx_lead_id, $idx_lead_update_data );
				}
    		}
		}
	}

	public static function send_new_rets_idx_lead_property_view_to_crm_on_property_view( $user_id, $property_details ) {
		if ( !empty( $user_id ) && !empty( $property_details['last_property'] ) ) {
			$idx_lead_id = get_user_meta( $user_id, self::$_meta_keys['crm_idx_lead_id'], true );
			if ( !empty( $idx_lead_id ) ) {
				self::_set_assigned_agent_id( $user_id );
				$data = array(
					'address' => $property_details['last_property']['address'],
					'price' => intval( $property_details['last_property']['price'] ),
					'primaryPhotoUrl' => $property_details['last_property']['image_url'],
					'property_id' => self::_get_sysid_from_property_url_suffix( $property_details['last_property']['url'] ),
					'squareFeet' => intval( $property_details['last_property']['sq_ft'] ),
					'url' => self::_get_url_from_property_url_suffix( $property_details['last_property']['url'] ),
					'zip' => $property_details['last_property']['zip'],
                );
				self::_send_new_rets_idx_lead_property_view_to_crm( $idx_lead_id, $data );
			}
		}
	}

	private static function _send_new_rets_idx_lead_search_to_crm( $idx_lead_id, $data ) {
		if ( !empty( $idx_lead_id ) && !empty( $data ) ) {
			self::_prepare_to_send();
			if ( self::_is_ready_to_send() ) {
				$url = self::$_base_url . self::$_endpoints['idx_lead_search']['new'];
    			$response_array = TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'POST', self::$_headers, array( 'data' => $data ) );
    			$response = json_decode( $response_array );
    			if ( $response->status === 'SUCCESS' ) {
    				$idx_lead_update_data = array(
    					'modelRelations' => array(
    						'displetIdxLeadSearches' => array(
    							array(
    								'action' => 'add',
    								'modelClassName' => 'DispletIdxLeadSearch',
    								'modelId' => $response->data->id,
    							),
    						),
    					),
    				);
    				self::_update_rets_idx_lead_with_crm_as_idx_lead( $idx_lead_id, $idx_lead_update_data );
				}
    		}
		}
	}

	public static function send_new_rets_idx_lead_search_to_crm_on_search_save( $user_id, $search_details ) {
		if ( !empty( $user_id ) && !empty( $search_details ) ) {
			$idx_lead_id = get_user_meta( $user_id, self::$_meta_keys['crm_idx_lead_id'], true );
			if ( !empty( $idx_lead_id ) ) {
				self::_set_assigned_agent_id( $user_id );
				$details = self::_get_search_details_from_hash( $search_details['hash'] );
				$data = self::_get_translated_search_fields( $details );
				$data['search_id'] = intval( $search_details['api_id'] );
				$data['searchName'] = $search_details['name'];
				$data['isSaved'] = true;
				self::_send_new_rets_idx_lead_search_to_crm( $idx_lead_id, $data );
			}
		}
	}

	public static function send_new_rets_idx_lead_search_to_crm_on_search_view( $user_id, $search_details ) {
		if ( !empty( $user_id ) && !empty( $search_details ) ) {
			$idx_lead_id = get_user_meta( $user_id, self::$_meta_keys['crm_idx_lead_id'], true );
			if ( !empty( $idx_lead_id ) ) {
				self::_set_assigned_agent_id( $user_id );
				$details = self::_get_search_details_from_hash( $search_details['last_hash'] );
				$data = self::_get_translated_search_fields( $details );
				$data['searchName'] = self::_get_current_date();
				$data['isSaved'] = false;
				self::_send_new_rets_idx_lead_search_to_crm( $idx_lead_id, $data );
			}
		}
	}

	private static function _send_new_rets_idx_lead_to_crm( $user_id, $data ) {
		if ( !empty( $user_id ) && !empty( $data ) ) {
			self::_prepare_to_send();
			if ( self::_is_ready_to_send() ) {
				$url = self::$_base_url . self::$_endpoints['contacts']['new'];
    			$response_array = TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'POST', self::$_headers, array( 'data' => $data ) );
    			$response = json_decode( $response_array );
    			if ( $response->status === 'SUCCESS' ) {
    				update_user_meta( $user_id, self::$_meta_keys['crm_contact_id'], $response->data->id );
    				$idx_lead_data = array(
    					'idx_id' => intval( get_user_meta( $user_id, self::$_meta_keys['crm_idx_id'], true ) ),
    					'zurmoContact_id' => $response->data->id,
    					'emailAddress' => $data['primaryEmail']['emailAddress'],
    				);
    				self::_send_new_rets_idx_lead_to_crm_as_idx_lead( $user_id, $idx_lead_data );
				}
    		}
		}
	}

	public static function _send_new_rets_idx_lead_to_crm_as_idx_lead( $user_id, $data ) {
		if ( !empty( $user_id ) && !empty( $data ) ) {
			$url = self::$_base_url . self::$_endpoints['idx_lead']['new'];
    		$response_array = TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'POST', self::$_headers, array( 'data' => $data ) );
    		$response = json_decode( $response_array );
    		if ( $response->status === 'SUCCESS' ) {
    			update_user_meta( $user_id, self::$_meta_keys['crm_idx_lead_id'], $response->data->id );
    		}
		}
	}

	public static function send_new_rets_idx_lead_to_crm_per_lead( $assigned_agent_id, $user_id ) {
		self::$_assigned_agent_id = $assigned_agent_id;
		$data = self::_get_data_for_new_crm_contact_from_user( $user_id );
		self::_send_new_rets_idx_lead_to_crm( $user_id, $data );
	}

	public static function send_new_rets_idx_lead_to_crm_on_registration( $user_id, $user_details ) {
		if ( !empty( $user_id ) && !empty( $user_details['assigned_agent_id'] ) ) {
			self::$_assigned_agent_id = $user_details['assigned_agent_id'];
			$data = array(
				'firstName' => !empty( $user_details['first_name'] ) ? $user_details['first_name'] : 'Unknown',
				'lastName' => !empty( $user_details['last_name'] ) ? $user_details['last_name'] : 'Unknown',
				'mobilePhone' => $user_details['phone'],
				'primaryEmail' => array(
					'emailAddress' => $user_details['email'],
				),
				'source' => array(
					'value' => 'TRIBUS IDX',
				),
				'state' => array(
					'id' => 2,
				),
				'idxSubscribeDate' => self::_get_current_date(),
				'idxLastActivityDate' => self::_get_current_date(),
			);
			self::_send_new_rets_idx_lead_to_crm( $user_id, $data );
		}
	}

	public static function send_new_rets_idx_lead_with_crm_on_assignation( $user_id, $assignation_details ) {
		if ( !empty( $user_id ) && !empty( $assignation_details['assigned_agent_id'] ) ) {
			self::$_assigned_agent_id = $assignation_details['assigned_agent_id'];
			$data = self::_get_data_for_new_crm_contact_from_user( $user_id );
			self::_send_new_rets_idx_lead_to_crm( $user_id, $data );
		}
	}

	private static function _set_assigned_agent_id( $user_id ) {
		if ( !empty( $user_id ) ) {
			self::$_assigned_agent_id = get_user_meta( $user_id, self::$_meta_keys['assigned_agent_id'], true );
		}
	}

	private static function _set_base_url() {
		if ( !empty( self::$_assigned_agent_id ) ) {
			self::$_base_url = get_user_meta( self::$_assigned_agent_id, self::$_meta_keys['crm_url'], true );
		}
	}

	private static function _set_crm_user_pass() {
		if ( !empty( self::$_assigned_agent_id ) ) {
			self::$_crm_username = get_user_meta( self::$_assigned_agent_id, self::$_meta_keys['crm_username'], true );
			self::$_crm_password = get_user_meta( self::$_assigned_agent_id, self::$_meta_keys['crm_password'], true );
		}
	}

	private static function _set_headers() {
		if ( !empty( self::$_session_id ) && !empty( self::$_token ) ) {
			self::$_headers = array(
				'Accept: application/json',
				'ZURMO_SESSION_ID: ' . self::$_session_id,
				'ZURMO_TOKEN: ' . self::$_token,
				'ZURMO_API_REQUEST_TYPE: REST',
			);
		}
	}

	private static function _update_rets_idx_lead_with_crm( $user_id, $data ) {
		if ( !empty( $user_id ) && !empty( $data ) ) {
			$crm_contact_id = get_user_meta( $user_id, self::$_meta_keys['crm_contact_id'], true );
			if ( !empty( $crm_contact_id ) ) {
				self::_prepare_to_send();
				if ( self::_is_ready_to_send() ) {
					$url = self::$_base_url . trailingslashit( self::$_endpoints['contacts']['update'] ) . $crm_contact_id;
    				TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'PUT', self::$_headers, array( 'data' => $data ) );
				}
			}
		}
	}

	private static function _update_rets_idx_lead_with_crm_as_idx_lead( $idx_lead_id, $data ) {
		if ( !empty( $idx_lead_id ) && !empty( $data ) ) {
			$url = self::$_base_url . trailingslashit( self::$_endpoints['idx_lead']['update'] ) . $idx_lead_id;
    		TripressCrmRetsIdxApiRestHelper::createApiCall( $url, 'PUT', self::$_headers, array( 'data' => $data ) );
		}
	}

	public static function update_rets_idx_lead_with_crm_on_user_login( $user_id, $login_details ) {
		if ( !empty( $user_id ) ) {
			self::_set_assigned_agent_id( $user_id );
			$data = array(
				'idxLastActivityDate' => self::_get_current_date(),
			);
			self::_update_rets_idx_lead_with_crm( $user_id, $data );
		}
	}

	public static function update_rets_idx_lead_with_crm_on_user_update( $user_id, $user_details ) {
		if ( !empty( $user_id ) && !empty( $user_details['assigned_agent_id'] ) ) {
			self::$_assigned_agent_id = $user_details['assigned_agent_id'];
			$data = array(
				'firstName' => $user_details['first_name'],
				'lastName' => $user_details['last_name'],
				'mobilePhone' => $user_details['phone'],
				'primaryEmail' => array(
					'emailAddress' => $user_details['email'],
				),
				'idxSubscribeDate' => self::_get_current_date(),
				'idxLastActivityDate' => self::_get_current_date(),
			);
			self::_update_rets_idx_lead_with_crm( $user_id, $data );
		}
	}

	private static function _update_rets_idx_lead_with_crm_after_api_user_id_assigned( $user_id, $api_user_id ) {
		if ( !empty( $user_id ) && !empty( $api_user_id ) ) {
    		$idx_lead_id = get_user_meta( $user_id, self::$_meta_keys['crm_idx_lead_id'], true );
    		if ( !empty( $idx_lead_id ) ) {
				self::_set_assigned_agent_id( $user_id );
				self::_prepare_to_send();
				if ( self::_is_ready_to_send() ) {
					$data = array(
    					'idx_id' => intval( $api_user_id ),
					);
					self::_update_rets_idx_lead_with_crm_as_idx_lead( $idx_lead_id, $data );
    			}
			}
		}
	}
}

add_action( 'displetretsidx_post_lead_assigned_api_user_id', array( 'TripressCrmRetsIdxLeadIntegration', 'save_api_user_id_after_lead_registration' ), 10, 2 );
add_action( 'displetretsidx_post_lead_reassigned', array( 'TripressCrmRetsIdxLeadIntegration', 'save_assigned_agent_id_on_lead_assignation' ), 10, 2 );
add_action( 'displetretsidx_post_registration', array( 'TripressCrmRetsIdxLeadIntegration', 'save_assigned_agent_id_on_lead_registration' ), 10, 2 );
add_action( 'displetretsidx_post_registration', array( 'TripressCrmRetsIdxLeadIntegration', 'save_phone_on_lead_registration' ), 10, 2 );
add_action( 'displetretsidx_post_update_lead', array( 'TripressCrmRetsIdxLeadIntegration', 'save_phone_on_lead_update' ), 10, 2 );
add_action( 'edit_user_profile_update', array( 'TripressCrmRetsIdxLeadIntegration', 'schedule_sending_rets_idx_leads_to_crm_on_addition_of_crm_credentials' ) );
add_action( 'personal_options_update', array( 'TripressCrmRetsIdxLeadIntegration', 'schedule_sending_rets_idx_leads_to_crm_on_addition_of_crm_credentials' ) );
add_action( 'tripress_schedule_sending_new_rets_idx_leads_to_crm_per_agent', array( 'TripressCrmRetsIdxLeadIntegration', 'schedule_sending_new_rets_idx_leads_to_crm_per_agent' ) );
add_action( 'displetretsidx_post_lead_saved_property', array( 'TripressCrmRetsIdxLeadIntegration', 'send_new_rets_idx_lead_property_to_crm_on_property_save' ), 10, 2 );
add_action( 'displetretsidx_post_lead_viewed_property', array( 'TripressCrmRetsIdxLeadIntegration', 'send_new_rets_idx_lead_property_view_to_crm_on_property_view' ), 10, 2 );
add_action( 'displetretsidx_post_lead_saved_search', array( 'TripressCrmRetsIdxLeadIntegration', 'send_new_rets_idx_lead_search_to_crm_on_search_save' ), 10, 2 );
add_action( 'displetretsidx_post_lead_viewed_search', array( 'TripressCrmRetsIdxLeadIntegration', 'send_new_rets_idx_lead_search_to_crm_on_search_view' ), 10, 2 );
add_action( 'tripress_send_new_rets_idx_lead_to_crm_per_lead', array( 'TripressCrmRetsIdxLeadIntegration', 'send_new_rets_idx_lead_to_crm_per_lead' ), 10, 2 );
add_action( 'displetretsidx_post_registration', array( 'TripressCrmRetsIdxLeadIntegration', 'send_new_rets_idx_lead_to_crm_on_registration' ), 10, 2 );
add_action( 'displetretsidx_post_lead_reassigned', array( 'TripressCrmRetsIdxLeadIntegration', 'send_new_rets_idx_lead_with_crm_on_assignation' ), 10, 2 );
add_action( 'displetretsidx_post_lead_login', array( 'TripressCrmRetsIdxLeadIntegration', 'update_rets_idx_lead_with_crm_on_user_login' ), 10, 2 );
add_action( 'displetretsidx_post_update_lead', array( 'TripressCrmRetsIdxLeadIntegration', 'update_rets_idx_lead_with_crm_on_user_update' ), 10, 2 );

/***********************
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
************************/
add_action('show_user_profile', 'tripress_crm_credentials');
add_action('edit_user_profile', 'tripress_crm_credentials');
add_action('personal_options_update', 'tripress_crm_credentials_update');
add_action('edit_user_profile_update', 'tripress_crm_credentials_update');
function tripress_crm_credentials($user) {
	$crm_url = get_user_meta( $user->ID, 'tripress_crm_url', true );
//crm username
$crm_user = get_user_meta($user->ID, 'tripress_crm_user');
//crm password
$crm_pw = get_user_meta($user->ID, 'tripress_crm_pw');
?>
<h3>CRM Credentials</h3>
<table class="form-table">
	<tr>
		<th scope="row">
			<label for="tripress_crm_url">
				URL
			</label>
		</th>
		<td>
			<input type="text" id="tripress_crm_url" class="regular-text" name="tripress_crm_url" value="<?php echo esc_url( $crm_url ); ?>"/>
		</td>
	</tr>
<tr>
<td><label for="crm-user">Username</label></td>
<td><input type="text" id="crm-user" name="tripress_crm_user" value="<?php echo $crm_user[0]; ?>" /></td>
</tr>
<tr>
<td><label for="crm-password">Password</label></td>
<td><input type="password" id="crm-password" name="tripress_crm_pw" value="<?php echo $crm_pw[0]; ?>" /></td>
</tr>
</table>
<?php
}
function tripress_crm_credentials_update($user_id) {
if ( current_user_can('edit_user',$user_id) ) {
	update_user_meta( $user_id, 'tripress_crm_url', $_POST['tripress_crm_url'] );
update_user_meta($user_id, "tripress_crm_user",$_POST['tripress_crm_user']);
update_user_meta($user_id, "tripress_crm_pw",$_POST['tripress_crm_pw']);
}
}
/***********************
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
Remove / DELETE / Remove
************************/

?>