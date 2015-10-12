<?php

/**
 * Functions below permitted for use in templates
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/*****************************
/ General
*****************************/

/**
 * @param: $filename: string (without .php)
 * @return: print: include
 */
function displetretsidx_get_template_part( $filename ) {
	include( DispletRetsIdxTemplatesController::get_template_path( $filename . '.php' ) );
}

/**
 * @param: $model: variable $model passed to template
 * @return: print: commented HTML markup
 */
function displetretsidx_setup_template_data( $model ) {
	global $displetretsidx_template;
	global $displetretsidx_results;
	$displetretsidx_template = $model;
	$displetretsidx_results = $model;
	if ( !empty( $displetretsidx_template['query_url'] ) ) {
		echo '<!-- Displet Query: ' . $displetretsidx_template['query_url'] . ' -->';
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_default_styles_class() {
	echo 'displet-default-styles';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_color_scheme_class() {
	global $displetretsidx_template;
	echo 'displet-' . $displetretsidx_template['options']['color_scheme'] . '-color-scheme';
}

/**
 * @return: url
 */
function displetretsidx_the_search_results_page_url() {
	echo get_permalink(  displetretsidx_get_search_results_page_id()  );
}

/**
 * @return: boolean
 */
function displetretsidx_has_api_key() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['is_displet_api'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetretsidx_has_phone() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['phone'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetretsidx_the_phone() {
	global $displetretsidx_template;
	echo $displetretsidx_template['options']['phone'];
}

/**
 * @return: print: url
 */
function displetretsidx_the_phone_url() {
	global $displetretsidx_template;
	echo DispletRetsIdxUtilities::get_phone_url( $displetretsidx_template['options']['phone'] );
}

/**
 * @return: boolean
 */
function displetretsidx_has_disclaimer() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['disclaimer'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetretsidx_the_disclaimer() {
	global $displetretsidx_template;
	echo $displetretsidx_template['options']['disclaimer'];
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_credit() {
	global $displetretsidx_template;
	$credit = 'Powered by ';
	if ( !empty( $displetretsidx_template['options']['no_link'] ) ) {
		$credit .= 'Displet Real Estate Search';
	}
	else{
		$credit .= '<a href="http://displet.com/wordpress-plugins/displet-rets-idx-plugin/" target="_blank">Displet Real Estate Search</a>';
	}
	echo $credit;
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_loading_element() {
	echo '<div class="displet-loading displet-none"></div>';
}

/*****************************
/ Pages
*****************************/

/**
 * @return: boolean
 */
function displetretsidx_is_search_results_page() {
	return DispletRetsIdxPagesModel::is_search_results_page();
}

/*****************************
/ For DispletListing shortcode templates ( displet-dynamic.php, displet-price-navigation.php )
*****************************/

/**
 * @return: boolean
 */
function displetretsidx_has_caption() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['caption'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetretsidx_the_caption() {
	global $displetretsidx_template;
	echo $displetretsidx_template['caption'];
}

/*****************************
/ For templates with listings ( displet-dynamic.php, displet-property-details-page-content.php )
*****************************/

/**
 * @return: boolean
 */
function displetretsidx_have_listings() {
	global $displetretsidx_results;
	if ( empty( $displetretsidx_results['listings_index'] ) ) {
		$displetretsidx_results['listings_index'] = 0;
	}
	if ( !empty( $displetretsidx_results['listings'][$displetretsidx_results['listings_index']] ) ) {
		return true;
	}
	else if ( $displetretsidx_results['listings_index'] === count( $displetretsidx_results['listings'] ) ) {
		$displetretsidx_results['listings_index'] = 0;
	}
	return false;
}

/**
 * @return: none
 */
function displetretsidx_the_listing() {
	global $displetretsidx_results;
	global $displetretsidx_listing;
	$displetretsidx_listing = $displetretsidx_results['listings'][$displetretsidx_results['listings_index']];
	$displetretsidx_results['listings_index']++;
}

/**
 * @param: $listing: variable from foreach ( $model['listings'] as $listing )
 * @return: none
 */
function displetretsidx_setup_listing_data( $listing ) {
	global $displetretsidx_listing;
	$displetretsidx_listing = $listing;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_results_limit_class() {
	echo 'displet-max-results';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: url
 */
function displetretsidx_the_permalink() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->permalink;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_price() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->list_price ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_price() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->list_price;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_price() {
	global $displetretsidx_listing;
	echo number_format( $displetretsidx_listing->list_price );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_price_class() {
	echo 'displet-price-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_price_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-price';
	if ( DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->list_price ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_photo_url() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->image_urls->primary_big ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: url
 */
function displetretsidx_get_photo_url() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->image_urls->primary_big;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: url
 */
function displetretsidx_the_photo_url() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->image_urls->primary_big;
}


/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS style
 */
function displetretsidx_the_photo_style() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->image_urls->primary_big ) ) {
		echo 'background-image: url( ' . $displetretsidx_listing->image_urls->primary_big . ' );';
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_photo_class() {
	echo 'displet-image-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_photo_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-image';
	if ( empty( $displetretsidx_listing->image_urls->primary_big ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_address() {
	global $displetretsidx_listing;
	if (  !empty(  $displetretsidx_listing->address  )  ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_address() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->address;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_address() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->address;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_address_class() {
	echo 'displet-address-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_address_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-address';
	if ( empty( $displetretsidx_listing->address ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_city() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->city ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_city() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->city;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_city() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->city;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_city_class() {
	echo 'displet-city-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_city_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-city';
	if ( empty( $displetretsidx_listing->city ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_state() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->state ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_state() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->state;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_state() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->state;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_state_class() {
	echo 'displet-state-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_state_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-state';
	if ( empty( $displetretsidx_listing->state ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_zip() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->zip ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_zip() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->zip;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_zip() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->zip;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_zip_class() {
	echo 'displet-zip-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_zip_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-zip';
	if ( empty( $displetretsidx_listing->zip ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: text
 */
function displetretsidx_get_zip_label() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['zip_label'] ) && $displetretsidx_template['options']['zip_label'] == 'postal_code' ) {
		return 'Postal Code';
	}
	return 'Zip';
}

/**
 * @return: boolean
 */
function displetretsidx_use_subdivision() {
	global $displetretsidx_template;
	$stacks = debug_backtrace();
	if ( !empty( $stacks[0]['file'] ) && strpos( $stacks[0]['file'], 'displet-property-details-page-content.php' ) !== false ) {
		if ( !empty( $displetretsidx_template['options']['include_subdivision_pdp'] ) ) {
			return true;
		}
	}
	else if ( !empty( $displetretsidx_template['options']['include_subdivision'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_subdivision() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->subdivision ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_subdivision() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->subdivision;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_subdivision() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->subdivision;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_subdivision_class() {
	echo 'displet-subdivision-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_subdivision_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-subdivision';
	if ( empty( $displetretsidx_listing->subdivision ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_bedrooms() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->num_bedrooms ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_bedrooms() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->num_bedrooms;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_bedrooms() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->num_bedrooms;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_bedrooms_class() {
	echo 'displet-beds-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_bedrooms_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-beds';
	if ( DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->num_bedrooms ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_bathrooms() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->bathrooms ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_bathrooms() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->bathrooms;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_bathrooms() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->bathrooms;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_bathrooms_class() {
	echo 'displet-baths-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_bathrooms_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-baths';
	if ( DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->bathrooms ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_square_feet() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->square_feet ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_square_feet() {
	global $displetretsidx_listing;
	return number_format( $displetretsidx_listing->square_feet );
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_square_feet() {
	global $displetretsidx_listing;
	echo number_format( $displetretsidx_listing->square_feet );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_square_feet_class() {
	echo 'displet-square-feet-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_square_feet_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-square-feet';
	if ( DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->square_feet ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_property_type() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->property_type ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_property_type() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->property_type;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_property_type() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->property_type;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_property_type_class() {
	echo 'displet-property-type-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_property_type_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-property-type';
	if ( empty( $displetretsidx_listing->property_type ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_use_mls_number() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['include_mls_number'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_mls_number() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->mls_number ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_mls_number() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->mls_number;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_mls_number() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->mls_number;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_mls_number_class() {
	$class = 'displet-mls-value';
	if ( displetretsidx_is_mls_number_emphasized() ) {
		$class .= ' displet-emphasize';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_is_mls_number_emphasized() {
	global $displetretsidx_template;
	if ( DispletRetsIdxPagesController::is_property_details_page() && empty( $displetretsidx_template['similar_listings_index'] ) ) {
		if ( !empty( $displetretsidx_template['options']['emphasize_mls_number_pdp'] ) ) {
			return true;
		}
	}
	else if ( !empty( $displetretsidx_template['options']['emphasize_mls_number'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_mls_number_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-mls';
	if ( empty( $displetretsidx_listing->mls_number ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_listing_courtesy_class() {
	global $displetretsidx_listing;
	$class = 'displet-courtesy';
	if ( empty( $displetretsidx_listing->listing_office_name ) && empty( $displetretsidx_listing->listing_agent_name ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_use_listing_agent() {
	global $displetretsidx_template;
	if ( $displetretsidx_template['is_displet_api'] && !empty( $displetretsidx_template['options']['include_listing_agent'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_get_listing_agent() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->listing_agent_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_listing_agent() {
	global $displetretsidx_listing;
	$agent = $displetretsidx_listing->listing_agent_name;
	if ( !empty( $displetretsidx_listing->listing_agent_name ) && !empty( $displetretsidx_listing->listing_office_name ) ) {
		$agent .= ',';
	}
	echo $agent;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_listing_agent_class() {
	$class = 'displet-listing-agent-name-value';
	if ( displetretsidx_is_listing_agent_name_emphasized() ) {
		$class .= ' displet-emphasize';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_is_listing_agent_name_emphasized() {
	global $displetretsidx_template;
	if ( DispletRetsIdxPagesController::is_property_details_page() && empty( $displetretsidx_template['similar_listings_index'] ) ) {
		if ( !empty( $displetretsidx_template['options']['emphasize_listing_office_and_agent_pdp'] ) ) {
			return true;
		}
	}
	else if ( !empty( $displetretsidx_template['options']['emphasize_listing_office_and_agent'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetretsidx_is_listing_agent_id_emphasized() {
	return displetretsidx_is_listing_agent_name_emphasized();
}

/**
 * @return: boolean
 */
function displetretsidx_is_listing_office_name_emphasized() {
	return displetretsidx_is_listing_agent_name_emphasized();
}

/**
 * @return: boolean
 */
function displetretsidx_is_listing_office_id_emphasized() {
	return displetretsidx_is_listing_agent_name_emphasized();
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_listing_agent_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-listing-agent-name';
	if ( empty( $displetretsidx_listing->listing_agent_name ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_use_listing_office() {
	global $displetretsidx_template;
	if ( $displetretsidx_template['is_displet_api'] && !empty( $displetretsidx_template['options']['include_listing_office'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_listing_office() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->listing_office_name;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_listing_office_class() {
	$class = 'displet-listing-office-name-value';
	if ( displetretsidx_is_listing_office_name_emphasized() ) {
		$class .= ' displet-emphasize';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_listing_office_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-listing-office-name';
	if ( empty( $displetretsidx_listing->listing_office_name ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_listing_agent_name() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->listing_agent_name ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_listing_agent_name() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->listing_agent_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_listing_agent_name() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->listing_agent_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_listing_office_name() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->listing_office_name ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_listing_office_name() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->listing_office_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_listing_office_name() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->listing_office_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->internet_remarks ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->internet_remarks;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->internet_remarks;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_description_class() {
	echo 'displet-description-value';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_description_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-description';
	if ( empty( $displetretsidx_listing->internet_remarks ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_year_built() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->year_built ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_year_built() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->year_built;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_year_built() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->year_built;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_year_built_class() {
	echo 'displet-year-built-value';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_no_results_class() {
	global $displetretsidx_results;
	$class = 'displet-no-results';
	if ( !empty( $displetretsidx_results['meta']->count ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_use_results_limit_message() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['results_limit_message'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetretsidx_the_results_limit_message() {
	global $displetretsidx_template;
	echo $displetretsidx_template['results_limit_message'];
}

/**
 * @return: boolean
 */
function displetretsidx_use_disclaimer_image() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['disclaimer_image'] ) && !empty( $displetretsidx_template['options']['include_disclaimer_image'] ) ) {
		return true;
	}
	return false;
}


/**
 * @return: print: url
 */
function displetretsidx_the_disclaimer_image_url() {
	global $displetretsidx_template;
	echo $displetretsidx_template['options']['disclaimer_image'];
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_listings_loading_element() {
	echo '<div class="displet-listings-loading displet-none"></div>';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_unavailable_listing_element() {
	echo '<div class="displet-unavailable"></div>';
}

/*****************************
/ For listings templates with navigation ( displet-dynamic.php )
*****************************/

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_first_count_class() {
	echo 'displet-first-listings-value';
}

/**
 * @return: print: text
 */
function displetretsidx_the_first_count() {
	global $displetretsidx_results;
	if ( !empty( $displetretsidx_results['meta']->count ) ) {
		echo number_format( $displetretsidx_results['meta']->first );
	}
	else{
		echo '0';
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_last_count_class() {
	echo 'displet-last-listings-value';
}

/**
 * @return: print: text
 */
function displetretsidx_the_last_count() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->last );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_total_count_class() {
	echo 'displet-total-listings-value';
}

/**
 * @return: print: text
 */
function displetretsidx_the_total_count() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->count );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_total_pages_class() {
	echo 'displet-total-pages-value';
}

/**
 * @return: print: text
 */
function displetretsidx_the_total_pages() {
	global $displetretsidx_results;
	echo number_format( ceil( $displetretsidx_results['meta']->count / $displetretsidx_results['meta']->limit ) );
}


/**
 * @return: print: url
 */
function displetretsidx_the_previous_page_url() {
	global $displetretsidx_results;
	echo $displetretsidx_results['previous_page_url'];
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_previous_page_class() {
	$class = 'displet-previous-listings-link';
	if ( !is_paged() ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: print: url
 */
function displetretsidx_the_next_page_url() {
	global $displetretsidx_results;
	echo $displetretsidx_results['next_page_url'];
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_next_page_class() {
	global $displetretsidx_results;
	$class = 'displet-next-listings-link';
	if ( intval( $displetretsidx_results['meta']->count ) == intval( $displetretsidx_results['meta']->last ) ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_has_numbered_pagination() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['page_urls'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: array( $page => $url )
 */
function displetretsidx_get_numbered_pagination() {
	global $displetretsidx_template;
	return $displetretsidx_template['page_urls'];
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_numbered_pagination() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['page_urls'] ) && is_array( $displetretsidx_template['page_urls'] ) ) {
		$paged = get_query_var('paged');
		$current_page = !empty( $paged ) ? intval( $paged ) : 1;
		$last_page = 0;
		$output = '<span class="displet-numbered-pagination">';
		foreach ( $displetretsidx_template['page_urls'] as $page => $url ) {
			if ( $page - $last_page > 1 ) {
				$output .= '<span>...</span>';
			}
			$class = $page === $current_page ? ' displet-current-page' : '';
			$output .= '<a href="' . $url . '" class="displet-numbered-page' . $class . '" for="' . $page . '">' . number_format( $page ) . '</a>' . PHP_EOL;
			$last_page = $page;
		}
		$output .= '</span>';
		echo $output;
	}
}

/**
 * @params: prepend: Text to be prepended to the option text (standard is just page number)
 * @return: print: HTML markup
 */
function displetretsidx_the_numbered_pagination_select( $prepend = '' ) {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['page_urls'] ) && is_array( $displetretsidx_template['page_urls'] ) ) {
		$paged = get_query_var('paged');
		$current_page = !empty( $paged ) ? intval( $paged ) : 1;
		$last_page = 0;
		$output = '<select class="displet-numbered-pagination-select">';
		foreach ( $displetretsidx_template['page_urls'] as $page => $url ) {
			if ( $page - $last_page > 1 ) {
				$output .= '<option disabled>...</option>';
			}
			$selected = $page === $current_page ? 'selected="selected"' : '';
			$output .= '<option value="' . $url . '" ' . $selected . '" for="' . $page . '">' . $prepend . number_format( $page ) . '</option>' . PHP_EOL;
			$last_page = $page;
		}
		$output .= '</select>';
		echo $output;
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_sort_class() {
	echo 'displet-listings-sortby';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_sort_options() {
	global $displetretsidx_template;
	echo $displetretsidx_template['sort_options'];
}

/*****************************
/ For statistics templates ( displet-statistics.php & displet-advanced-statistics.php )
*****************************/

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_count() {
	global $displetretsidx_results;
	if ( !empty( $displetretsidx_results['meta']->count ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_count() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->count );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_lowest_price() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->list_price_min ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_lowest_price() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->list_price_min );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_highest_price() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->list_price_max ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_highest_price() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->list_price_max );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_average_price() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->list_price_mean ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_average_price() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->list_price_mean );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_lowest_square_footage() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->square_feet_min ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_lowest_square_footage() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->square_feet_min );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_highest_square_footage() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->square_feet_max ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_highest_square_footage() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->square_feet_max );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_average_square_footage() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->square_feet_mean ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_average_square_footage() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->square_feet_mean );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_price_per_square_foot() {
	if ( displetretsidx_has_average_price() && displetretsidx_has_average_square_footage() ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_price_per_square_foot() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->list_price_mean ) && !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->square_feet_mean ) ) {
		echo number_format( $displetretsidx_results['meta']->list_price_mean / $displetretsidx_results['meta']->square_feet_mean, 2 );
	}
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_average_bedrooms() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->num_bedrooms_mean ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_average_bedrooms() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->num_bedrooms_mean, 1 );
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: boolean
 */
function displetretsidx_has_average_bathrooms() {
	global $displetretsidx_results;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_results['meta']->full_baths_mean ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_stats() or displetretsidx_the_advanced_stats()
 * @return: print: text
 */
function displetretsidx_the_average_bathrooms() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->full_baths_mean, 1 );
}

?>