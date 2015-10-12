<?php

/**
 * @return: print: HTML markup
 */
function displetretsidx_save_search_registration_error_element() {
	echo '<div class="displet-save-search-registration-error"></div>';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_user_name_class() {
	echo 'displet-save-search-registration-user-name';
}

/**
 * @return: print: text
 */
function displetretsidx_save_search_registration_user_name_value() {
	$user = DispletRetsIdxLeadsModel::get_current_user_data();
	if ( !empty( $user['name'] ) ) {
		echo $user['name'];
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_user_email_class() {
	echo 'displet-save-search-registration-user-email';
}

/**
 * @return: print: text
 */
function displetretsidx_save_search_registration_user_email_value() {
	$user = DispletRetsIdxLeadsModel::get_current_user_data();
	if ( !empty( $user['email'] ) ) {
		echo $user['email'];
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_user_phone_class() {
	echo 'displet-save-search-registration-user-phone';
}

/**
 * @return: print: text
 */
function displetretsidx_save_search_registration_user_phone_value() {
	$user = DispletRetsIdxLeadsModel::get_current_user_data();
	if ( !empty( $user['phone'] ) ) {
		echo $user['phone'];
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_city_class() {
	echo 'displet-save-search-registration-city';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_zip_class() {
	echo 'displet-save-search-registration-zip';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_min_bedrooms_class() {
	echo 'displet-save-search-registration-min-bedrooms';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_save_search_registration_min_bedrooms_options() {
	echo DispletRetsIdxUtilities::get_select_options( range( 1, 6 ), 'Min Bedrooms', '', '+ beds' );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_min_bathrooms_class() {
	echo 'displet-save-search-registration-min-bathrooms';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_save_search_registration_min_bathrooms_options() {
	echo DispletRetsIdxUtilities::get_select_options( range( 1, 6 ), 'Min Bathrooms', '', '+ baths' );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_min_list_price_class() {
	echo 'displet-save-search-registration-min-list-price';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_save_search_registration_min_list_price_options() {
	echo DispletRetsIdxUtilities::get_select_options_for_prices( range( 100, 1000, 50 ), 'Min Price', '', '+' );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_max_list_price_class() {
	echo 'displet-save-search-registration-max-list-price';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_save_search_registration_max_list_price_options() {
	echo DispletRetsIdxUtilities::get_select_options_for_prices( range( 100, 1000, 50 ), 'Max Price', '', '-' );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_property_type_class() {
	echo 'displet-save-search-registration-property-type';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_save_search_registration_property_type_options() {
	echo DispletRetsIdxUtilities::get_select_options( DispletRetsIdxResidentialsModel::get_filtered_field_options( 'property_type' ), 'Property Type' );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_submit_class() {
	echo 'displet-submit';
}

?>