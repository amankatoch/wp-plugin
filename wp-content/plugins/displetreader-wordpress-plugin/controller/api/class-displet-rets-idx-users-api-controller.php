<?php

class DispletRetsIdxUsersApiController extends DispletRetsIdxApiController {
	public static function create_saved_property( $user_id, $property_id, $save_type = '', $rating = '', $comments = '' ) {
		$endpoint_url = '/users/' . $user_id . '/saved_properties';
		$query_args = array(
			'residential_id' => $property_id,
			'type' => $save_type,
			'rating' => $rating,
			'comments' => $comments,
		 );
		$json_data = parent::query( $endpoint_url, $query_args );
		if ( !empty( $json_data->id ) ) {
			return $json_data->id;
		}
		return false;
	}

	public static function create_saved_search( $user_id, $search_name, $search_criteria ) {
		$endpoint_url = '/users/' . $user_id . '/saved_searches';
		$query_args = array(
			'name' => $search_name,
			'search_criteria' => $search_criteria,
			'email_frequency' => 1,
		 );
		$json_data = parent::query( $endpoint_url, $query_args );
		if ( !empty( $json_data->id ) ) {
			return $json_data->id;
		}
		return false;
	}

	public static function create_user( $email, $first_name, $last_name, $phone, $api_agent_id = false ) {
		$user_data = array(
			'email' => $email,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'phone' => $phone,
		);
		if ( !empty( $api_agent_id ) ) {
			$user_data['agent_profile_id'] = $api_agent_id;
		}
		$query_args = array(
			'user' => $user_data,
		);
		$json_data = parent::query( '/users', $query_args );
		if ( !empty( $json_data->id ) ) {
			self::maybe_update_user( $json_data, $user_data );
			return $json_data->id;
		}
		return false;
	}

	public static function delete_saved_property( $user_id, $property_id ) {
		$endpoint_url = '/users/' . $user_id . '/saved_properties/' . $property_id;
		parent::query( $endpoint_url, false, 'DELETE' );
	}

	public static function delete_saved_search( $user_id, $search_id ) {
		$endpoint_url = '/users/' . $user_id . '/saved_searches/' . $search_id;
		parent::query( $endpoint_url, false, 'DELETE' );
	}

	public static function get_saved_searches( $user_id ) {
		$endpoint_url = '/users/' . $user_id . '/saved_searches';
		$json_data = parent::query( $endpoint_url, false, 'GET' );
		if ( !empty( $json_data ) && is_array( $json_data ) ) {
			return $json_data;
		}
		return false;
	}

	private function maybe_update_user( $json_data, $user_data ) {
		if ( !empty( $json_data->updated_at ) ) {
			$yesterydays_epoch = strtotime( '-1 day' );
			$updated_epoch = strtotime( $json_data->updated_at );
			if ( $updated_epoch < $yesterydays_epoch ) {
				self::update_user( $json_data->id, $user_data );
			}
		}
	}

	public static function update_saved_search( $user_id, $search_id, $search_criteria ) {
		$endpoint_url = '/users/' . $user_id . '/saved_searches/' . $search_id;
		$query_args = array(
			'search_criteria' => is_array( $search_criteria ) ? http_build_query( $search_criteria ) : $search_criteria,
		 );
		$json_data = parent::query( $endpoint_url, $query_args, 'PUT' );
		if ( !empty( $json_data->id ) ) {
			return $json_data->id;
		}
		return false;
	}

	public static function update_user( $api_user_id, $user_array ) {
		if ( !empty( $user_array ) ) {
			$query_args = array(
				'user' => $user_array
			 );
			$endpoint_url = '/users/' . $api_user_id;
			parent::query( $endpoint_url, $query_args, 'PUT' );
		}
	}

	public static function update_user_property_views( $api_user_id, $property_id ) {
		if ( !empty( $api_user_id ) && !empty( $property_id ) ) {
			$endpoint_url = '/users/' . $api_user_id . '/property_views';
			$query_args = array(
				'residential_id' => $property_id
			 );
			parent::query( $endpoint_url, $query_args );
		}
	}

	/* Not needed currently but used successfully during testing
	public static function get_user( $user_id ) {
		global $displetretsidx_option;
		$query_url = self::$_api_url . '/users/' . $user_id;
		$query_args = array(
			'timeout' => 10,
			'headers' => array(
				'referer' => home_url(  )
			 ),
			'body' => array(
				'authentication_token' => $displetretsidx_option['displet_app_key']
			 )
		 );
		$json_array = wp_remote_get( $query_url, $query_args );
		if ( is_array( $json_array ) ) {
			$json_data = json_decode( $json_array['body'] );
			return $json_data;
		}
	}

	public static function get_saved_search( $user_id, $search_id ) {
		global $displetretsidx_option;
		$query_url = self::$_api_url . '/users/' . $user_id . '/saved_searches/' . $search_id;
		$query_args = array(
			'timeout' => 10,
			'headers' => array(
				'referer' => home_url(  )
			 ),
			'body' => array(
				'authentication_token' => $displetretsidx_option['displet_app_key']
			 )
		 );
		$json_array = wp_remote_get( $query_url, $query_args );
		if ( is_array( $json_array ) ) {
			$json_data = json_decode( $json_array['body'] );
			return $json_data;
		}
	}
	*/
}

?>