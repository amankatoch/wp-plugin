<?php

/**
 * Functions below permitted for use in external applications ( custom templates, custom theme functionality, etc. )
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/*****************************
/ Option related
*****************************/

/**
 * @return: string
 */
function displetretsidx_get_api_key() {
	global $displetretsidx_option;
	return $displetretsidx_option['displet_app_key'];
}

/**
 * @return: string
 */
function displetretsidx_get_property_details_page_id() {
	global $displetretsidx_option;
	return $displetretsidx_option['property_details_page_id'];
}

/**
 * @return: string
 */
function displetretsidx_get_search_results_page_id() {
	global $displetretsidx_option;
	return $displetretsidx_option['search_results_page_id'];
}

/**
 * @deprecated: since 2.1, no replacement
 * @param: $setting: string ( min_price, max_price, price_increment, beds_min, beds_max, baths_min, baths_max, min_square_feet, max_square_feet, square_feet_increment, min_acres, max_acres, or acres_increment )
 * @return: success: integer
 * @return: failure: false
 */
function displetretsidx_get_search_value( $setting ) {
	$option = get_option( 'displet_rets_idx_search_values' );
	if ( isset( $option['search_values_' . $setting] ) ) {
		return intval( $option['search_values_' . $setting] );
	}
	return false;
}

/**
 * @param: $field: string or array ( area_mls_defined, city, property_type or school_district, status or zip )
 * @return: success: array
 * @return: failure: false
 */
function displetretsidx_get_field_options( $field ) {
	$field_option = DispletRetsIdxOptionsController::get_option( 'fields' );
	if ( is_array( $field ) ) {
		$fields = array();
		foreach ( $field as $slug ) {
			if ( isset( $field_option[ $slug ] ) ) {
				$fields = array_merge( $fields, $field_option[ $slug ] );
			}
		}
		sort( $fields );
		return $fields;
	}
	elseif ( isset( $field_option[ $field ] ) ) {
		return $field_option[ $field ];
	}
	return false;
}

/**
 * @param: $field: string ( area_mls_defined, city, property_type or school_district or status )
 * @return: success: array
 * @return: failure: false
 */
function displetretsidx_get_filtered_field_options( $field ) {
	return DispletRetsIdxResidentialsModel::get_filtered_field_options( $field );
}

/*****************************
/ Search Form related
*****************************/

/**
 * @param: $column: integer
 * @return: boolean
 */
function displetretsidx_has_search_form( $column = 1 ) {
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	return DispletRetsIdxSearchFieldsController::has_search_form_column( $column );
}

/**
 * @deprecated: since 2.1, replaced with displetretsidx_the_search_form
 * @param: $column: integer
 * @return: print: dynamic_sidebar
 */
function displetretsidx_get_search_form( $column = 1 ) {
	displetretsidx_the_search_form( $column );
}

/**
 * @param: $column: integer
 * @return: array()
 */
function displetretsidx_get_search_form_fields( $column = 1 ) {
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	return DispletRetsIdxSearchFieldsController::get_search_form_fields( $column );
}

/**
 * @param: $column: integer
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_search_form( $column = 1 ) {
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	echo DispletRetsIdxSearchFieldsController::get_search_form_column_html( $column );
}

/**
 * @param: $field: array( $label => 'Label', $field => 'field_slug', $options => array( 'Option 1', 'Option 2' ), $min => '10', $max => '100', $increment => '5', $range => array( '1', '2', '3', '5', '10' ) )
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_search_form_field( $field ) {
	echo DispletRetsIdxSearchFieldsController::get_search_field_markup( $field );
}

/**
 * @param: $column: integer
 * @return: boolean
 */
function displetretsidx_has_advanced_search_form( $column = 1 ) {
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	return DispletRetsIdxSearchFieldsController::has_advanced_search_form_column( $column );
}

/**
 * @deprecated: since 2.1, replaced with displetretsidx_the_search_form
 * @param: $column: integer
 * @return: print: dynamic_sidebar
 */
function displetretsidx_get_advanced_search_form( $column = 1 ) {
	displetretsidx_the_advanced_search_form( $column );
}

/**
 * @param: $column: integer
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_advanced_search_form( $column = 1 ) {
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	echo DispletRetsIdxSearchFieldsController::get_advanced_search_form_column_html( $column );
}

/**
 * @param: $column: integer
 * @return: array()
 */
function displetretsidx_get_advanced_search_form_fields( $column = 1 ) {
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	return DispletRetsIdxSearchFieldsController::get_advanced_search_form_fields( $column );
}

/**
 * @param: $id: integer, $column: integer
 * @return: boolean
 */
function displetretsidx_has_quick_search_form( $id, $column = 1 ) {
	$id = is_numeric( $id ) ? intval( $id ) : 1;
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	return DispletRetsIdxSearchFieldsController::has_quick_search_form( $id, $column );
}

/**
 * @deprecated: since 2.1, use displetretsidx_the_quick_search_form()
 * @param: $id: integer, $column: integer
 * @return: print: dynamic_sidebar
 */
function displetretsidx_get_quick_search_form( $id, $column = 1 ) {
	displetretsidx_the_quick_search_form( $id, $column );
}

/**
 * @param: $id: integer, $column: integer
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_quick_search_form( $id, $column = 1 ) {
	$id = is_numeric( $id ) ? intval( $id ) : 1;
	$column = is_numeric( $column ) ? intval( $column ) : 1;
	echo DispletRetsIdxSearchFieldsController::get_quick_search_form_html( $id, $column );
}

/*****************************
/ Listings related
*****************************/

/**
 * @param: $criteria: array( 'field' => 'value' ); $num_listings: integer, 1-50
 * @return: success - array: $results['listings'] = object( stdClass ), $results['meta'] = object( stdClass ), $results['query_url'] = string
 * @return: failure - boolean: false
 */
function displetretsidx_get_listings( $criteria = array(), $num_listings = false ) {
	if ( !empty( $num_listings ) ) {
		$criteria['num_listings'] = $num_listings;
	}
	$residentials = new DispletRetsIdxResidentials( $criteria );
	$results = $residentials->get_residentials();
	if ( !empty( $results ) ) {
		return array(
			'listings' => $results['listings'],
			'meta' => $results['meta'],
			'query_url' => $results['query_url'],
		 );
	}
	return false;
}

/**
 * @param: $criteria: array( 'field' => 'value' )
 * @return: success - integer
 * @return: failure - boolean: false
 */
function displetretsidx_get_count( $criteria = false ) {
	$residentials = new DispletRetsIdxResidentials( $criteria );
	$count = $residentials->get_count();
	if ( !empty( $count ) || $count === 0 ) {
		return $count;
	}
	return false;
}

/**
 * @param: $criteria: array( 'field' => 'value' )
 * @return: success - array() of query args
 * @return: failure - boolean: false
 */
function displetretsidx_get_query_args( $criteria = false ) {
	$residentials = new DispletRetsIdxResidentials( $criteria );
	$args = $residentials->get_query_args();
	if ( !empty( $args ) ) {
		return $args;
	}
	return false;
}

?>