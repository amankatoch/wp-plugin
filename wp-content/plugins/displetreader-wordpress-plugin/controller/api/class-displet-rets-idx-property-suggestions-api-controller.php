<?php

class DispletRetsIdxPropertySuggestionsApiController extends DispletRetsIdxApiController {
	public static function update( $api_key, $args ) {
		$endpoint_url = '/api_apps/' . $api_key . '/property_suggestion_setup';
		$query_args = array(
			'turned_on' => $args['turned_on'],
			'property_views_threshold' => $args['property_views_threshold'],
			'zip_codes_to_include' => $args['zip_codes_to_include'],
			'price_variation' => $args['price_variation'],
			'footage_variation' => $args['footage_variation'],
			'authentication_token' => $api_key
		);
		parent::query( $endpoint_url, $query_args, 'PUT' );
	}
}

?>