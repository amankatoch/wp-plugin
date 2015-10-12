<?php

class DispletRetsIdxApiController extends DispletRetsIdxPlugin {
	public static function query( $endpoint_url, $args, $method = false ) {
		$query_args = array(
			'timeout' => 10,
			'headers' => array(
				'referer' => home_url(),
			 )
		 );
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			$query_url = self::$_api_url . $endpoint_url;
			$query_string_args = array(
				'authentication_token' => self::$_options['displet_app_key']
			);
		}
		if ( !empty( $args ) && is_array( $args ) ) {
			foreach ( $args as $key => $value ) {
				$query_string_args[ $key ] = $value;
			}
		}
		$query_url .= '?' . http_build_query( $query_string_args );
		if ( !empty( $method ) && $method != 'GET' ) {
			$query_args['method'] = $method;
		}
		if ( !empty( $method ) && $method == 'GET' ) {
			$json_array = wp_remote_get( $query_url, $query_args );
		}
		else{
			$json_array = wp_remote_post( $query_url, $query_args );
		}
		if ( is_array( $json_array ) && !empty( $json_array['body'] ) ) {
			$results = json_decode( $json_array['body'] );
			if ( is_object( $results ) ) {
				$results->query_url = $query_url;
			}
			return $results;
		}
		return false;
	}
}

?>