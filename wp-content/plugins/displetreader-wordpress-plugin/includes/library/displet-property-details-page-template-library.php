<?php

/**
 * Functions below permitted for use in displet-property-details-page-content.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_previous_result_class() {
	echo 'displet-previous-result displet-none';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_next_result_class() {
	echo 'displet-next-result displet-none';
}

/**
 * @return: boolean
 */
function displetretsidx_use_planwise_affordability() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['use_planwise_affordability'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_class() {
	echo 'displet-request-showing';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_property_class() {
	echo 'displet-save-property';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_rate_property_auto_submit_container_class() {
	global $displetretsidx_listing;
	$class = 'displet-rate-property-auto-submit';
	if ( !empty( $displetretsidx_listing->user_rating ) ) {
		$class .= ' displet-user-rated';
	}
	echo $class;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_class() {
	echo 'displet-email-friend';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_planwise_container() {
	echo '<div id="PLANWISE"></div>';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_photo_urls() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->image_urls->all_big ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: array: url
 */
function displetretsidx_get_photo_urls() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->image_urls->all_big;
}

/**
 * @return: print: CSS style attribute
 */
function displetretsidx_the_photos_container_style() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['pdp_force_full_width_photos'] ) ) {
		echo 'max-width: none !important;';
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_photos_slideshow_class() {
	echo 'displet-photo-slideshow';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_previous_photo_class() {
	echo 'displet-previous-photo';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_next_photo_class() {
	echo 'displet-next-photo';
}

/**
 * @deprecated: since 2.0.36
 * @return: print: CSS classname
 */
function displetretsidx_the_photos_thumbnails_class() {
	displetretsidx_the_slideshow_thumbnails_class();
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_slideshow_thumbnails_class() {
	echo 'displet-thumbnails';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_thumbnails_class() {
	echo 'displet-photos-thumbs-value';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_thumbnail_class() {
	echo 'displet-image';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_photos_class() {
	echo 'displet-photos-large-value';
}

/**
 * @return: boolean
 */
function displetretsidx_is_disclaimer_above_details() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['pdp_disclaimer_below_photos'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_maps() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->maps ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: HTML markup
 */
function displetretsidx_the_maps( $scroll_wheel = true ) {
	displetretsidx_the_road_map( $scroll_wheel );
	displetretsidx_the_street_view_map( $scroll_wheel );
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: HTML markup
 */
function displetretsidx_the_road_map( $scroll_wheel = true ) {
	global $displetretsidx_listing;
	echo DispletRetsIdxResidentialsController::get_map_markup( $displetretsidx_listing->maps['map'], $scroll_wheel );
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: HTML markup
 */
function displetretsidx_the_birds_eye_map( $scroll_wheel = true ) {
	global $displetretsidx_listing;
	echo DispletRetsIdxResidentialsController::get_map_markup( $displetretsidx_listing->maps['birds_eye'], $scroll_wheel );
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: HTML markup
 */
function displetretsidx_the_street_view_map( $scroll_wheel = true ) {
	global $displetretsidx_listing;
	echo DispletRetsIdxResidentialsController::get_map_markup( $displetretsidx_listing->maps['street_view'], $scroll_wheel );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_map_tabs_class() {
	echo 'displet-map-tabs';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_map_tab_class() {
	echo 'displet-map-select displet-active';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_street_view_tab_class() {
	echo 'displet-street-view-select';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_area_amenities() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->area_amenities ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_area_amenities() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->area_amenities;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_area_amenities() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->area_amenities;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_ac() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->ac ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_ac() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->ac;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_ac() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->ac;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_appliances_equipment() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->appliances_equipment ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_appliances_equipment() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->appliances_equipment;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_appliances_equipment() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->appliances_equipment;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_basement() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->basement ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_basement() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->basement;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_basement() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->basement;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_basement_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->basement_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_basement_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->basement_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_basement_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->basement_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_basement_sq_feet() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->basement_sq_feet ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_basement_sq_feet() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->basement_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_basement_sq_feet() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->basement_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_full_baths() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->full_baths ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_full_baths() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->full_baths;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_full_baths() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->full_baths;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_half_baths() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->half_baths ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_half_baths() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->half_baths;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_half_baths() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->half_baths;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_three_quarter_baths() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->three_quarter_baths ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_three_quarter_baths() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->three_quarter_baths;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_three_quarter_baths() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->three_quarter_baths;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_bed2_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->bed2_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_bed2_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->bed2_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_bed2_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->bed2_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_bed3_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->bed3_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_bed3_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->bed3_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_bed3_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->bed3_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_bed4_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->bed4_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_bed4_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->bed4_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_bed4_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->bed4_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_den_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->den_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_den_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->den_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_den_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->den_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_den_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->den_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_den_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->den_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_den_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->den_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_dining() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->dining ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_dining() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->dining;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_dining() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->dining;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_dining_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->dining_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_dining_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->dining_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_dining_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->dining_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_dining_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->dining_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_dining_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->dining_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_dining_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->dining_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_disability_features() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->disability_features ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_disability_features() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->disability_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_disability_features() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->disability_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_family_room_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->family_room_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_family_room_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->family_room_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_family_room_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->family_room_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_family_room_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->family_room_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_family_room_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->family_room_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_family_room_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->family_room_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_fireplace_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->fireplace_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_fireplace_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->fireplace_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_fireplace_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->fireplace_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_fireplaces() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->fireplaces ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_fireplaces() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->fireplaces;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_fireplaces() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->fireplaces;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_floor() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->floor ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_floor() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->floor;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_floor() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->floor;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_foundation() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->foundation ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_foundation() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->foundation;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_foundation() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->foundation;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_garage_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->garage_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_garage_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->garage_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_garage_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->garage_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_garage_spaces() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->garage_spaces ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_garage_spaces() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->garage_spaces;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_garage_spaces() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->garage_spaces;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_guest_accommodations() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->guest_accommodations ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_guest_accommodations() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->guest_accommodations;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_guest_accommodations() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->guest_accommodations;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_heat() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->heat ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_heat() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->heat;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_heat() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->heat;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_interior_features() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->interior_features ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_interior_features() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->interior_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_interior_features() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->interior_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_kitchen() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->kitchen ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_kitchen() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->kitchen;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_kitchen() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->kitchen;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_kitchen_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->kitchen_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_kitchen_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->kitchen_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_kitchen_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->kitchen_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_laundry_location() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->laundry_location ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_laundry_location() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->laundry_location;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_laundry_location() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->laundry_location;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_living() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->living ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_living() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->living;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_living() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->living;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_living_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->living_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_living_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->living_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_living_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->living_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_living_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->living_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_living_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->living_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_living_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->living_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_main_level_beds() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->main_level_beds ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_main_level_beds() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->main_level_beds;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_main_level_beds() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->main_level_beds;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_main_level_sq_feet() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->main_level_sq_feet ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_main_level_sq_feet() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->main_level_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_main_level_sq_feet() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->main_level_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_master_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->master_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_master_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->master_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_master_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->master_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_master_on_main() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->master_on_main ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_master_on_main() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->master_on_main;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_master_on_main() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->master_on_main;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_num_beds_above_grade() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->num_beds_above_grade ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_num_beds_above_grade() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->num_beds_above_grade;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_num_beds_above_grade() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->num_beds_above_grade;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_other_level_beds() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->other_level_beds ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_other_level_beds() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->other_level_beds;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_other_level_beds() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->other_level_beds;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_rooms() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->rooms ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_rooms() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->rooms;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_rooms() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->rooms;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_square_feet2() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->square_feet2 ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_square_feet2() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->square_feet2;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_square_feet2() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->square_feet2;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_square_feet2_source() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->square_feet2_source ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_square_feet2_source() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->square_feet2_source;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_square_feet2_source() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->square_feet2_source;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_square_feet_available() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->square_feet_available ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_square_feet_available() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->square_feet_available;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_square_feet_available() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->square_feet_available;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_square_feet_source() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->square_feet_source ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_square_feet_source() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->square_feet_source;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_square_feet_source() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->square_feet_source;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_square_foot_source() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->square_foot_source ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_square_foot_source() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->square_foot_source;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_square_foot_source() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->square_foot_source;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_stories() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->stories ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_stories() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->stories;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_stories() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->stories;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_upper_level_sq_feet() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->upper_level_sq_feet ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_upper_level_sq_feet() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->upper_level_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_upper_level_sq_feet() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->upper_level_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_acres() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->acres ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_acres() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->acres;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_acres() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->acres;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_building_name() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->building_name ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_building_name() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->building_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_building_name() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->building_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_condo_parking() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->condo_parking ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_condo_parking() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->condo_parking;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_condo_parking() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->condo_parking;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_construction() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->construction ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_construction() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->construction;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_construction() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->construction;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_exterior_features() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->exterior_features ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_exterior_features() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->exterior_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_exterior_features() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->exterior_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_fence() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->fence ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_fence() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->fence;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_fence() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->fence;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_fence_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->fence_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_fence_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->fence_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_fence_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->fence_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_lot_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->lot_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_lot_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->lot_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_lot_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->lot_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_lot_dimensions() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->lot_dimensions ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_lot_dimensions() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->lot_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_lot_dimensions() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->lot_dimensions;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_lot_size() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->lot_size ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_lot_size() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->lot_size;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_lot_size() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->lot_size;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_has_parking() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->has_parking ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_has_parking() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->has_parking;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_has_parking() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->has_parking;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_parking_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->parking_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_parking_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->parking_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_parking_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->parking_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_parking_spaces() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->parking_spaces ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_parking_spaces() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->parking_spaces;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_parking_spaces() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->parking_spaces;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_pool_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->pool_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_pool_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->pool_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_pool_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->pool_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_pool_on_property() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->pool_on_property ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_pool_on_property() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->pool_on_property;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_pool_on_property() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->pool_on_property;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_roof() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->roof ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_roof() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->roof;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_roof() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->roof;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_sewer() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->sewer ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_sewer() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->sewer;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_sewer() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->sewer;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_trees() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->trees ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_trees() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->trees;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_trees() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->trees;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_view() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->view ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_view() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->view;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_view() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->view;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_utilities() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->utilities ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_utilities() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->utilities;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_utilities() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->utilities;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_water() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->water ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_water() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->water;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_water() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->water;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_water_access() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->water_access ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_water_access() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->water_access;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_water_access() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->water_access;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_waterfront() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->waterfront ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_waterfront() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->waterfront;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_waterfront() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->waterfront;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_waterfront_description() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->waterfront_description ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_waterfront_description() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->waterfront_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_waterfront_description() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->waterfront_description;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_zoning() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->zoning ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_zoning() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->zoning;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_zoning() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->zoning;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_area_mls_defined() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->area_mls_defined ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_area_mls_defined() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->area_mls_defined;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_area_mls_defined() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->area_mls_defined;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_county() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->county ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_county() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->county;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_county() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->county;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_is_gated_community() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->is_gated_community ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_is_gated_community() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->is_gated_community;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_is_gated_community() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->is_gated_community;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_street_name() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->street_name ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_street_name() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->street_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_street_name() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->street_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_street_number() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->street_number ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_street_number() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->street_number;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_street_number() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->street_number;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_street_post_dir() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->street_post_dir ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_street_post_dir() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->street_post_dir;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_street_post_dir() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->street_post_dir;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_street_pre_direction() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->street_pre_direction ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_street_pre_direction() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->street_pre_direction;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_street_pre_direction() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->street_pre_direction;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_unit() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->unit ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_unit() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->unit;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_unit() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->unit;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_elementary_a() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->elementary_a ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_elementary_a() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->elementary_a;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_elementary_a() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->elementary_a;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_high_school() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->high_school ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_high_school() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->high_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_high_school() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->high_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_junior_high_school() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->junior_high_school ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_junior_high_school() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->junior_high_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_junior_high_school() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->junior_high_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_middle_school() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->middle_school ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_middle_school() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->middle_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_middle_school() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->middle_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_other_school() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->other_school ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_other_school() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->other_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_other_school() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->other_school;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_school_district() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->school_district ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_school_district() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->school_district;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_school_district() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->school_district;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_condo_fee() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->condo_fee ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_condo_fee() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->condo_fee;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_condo_fee() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->condo_fee;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_condo_fee_frequency() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->condo_fee_frequency ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_condo_fee_frequency() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->condo_fee_frequency;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_condo_fee_frequency() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->condo_fee_frequency;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_condo_fee_includes() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->condo_fee_includes ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_condo_fee_includes() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->condo_fee_includes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_condo_fee_includes() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->condo_fee_includes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_estimated_taxes() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->estimated_taxes ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_estimated_taxes() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->estimated_taxes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_estimated_taxes() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->estimated_taxes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_hoa() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->hoa ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_hoa() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->hoa;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_hoa() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->hoa;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_hoa_fee() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->hoa_fee ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_hoa_fee() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->hoa_fee;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_hoa_fee() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->hoa_fee;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_hoa_fee_includes() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->hoa_fee_includes ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_hoa_fee_includes() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->hoa_fee_includes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_hoa_fee_includes() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->hoa_fee_includes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_hoa_frequency() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->hoa_frequency ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_hoa_frequency() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->hoa_frequency;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_hoa_frequency() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->hoa_frequency;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_hoa_requirement() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->hoa_requirement ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_hoa_requirement() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->hoa_requirement;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_hoa_requirement() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->hoa_requirement;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_mainteinance_fee() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->mainteinance_fee ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_mainteinance_fee() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->mainteinance_fee;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_mainteinance_fee() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->mainteinance_fee;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_tax_year() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->tax_year ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_tax_year() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->tax_year;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_tax_year() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->tax_year;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_builder_name() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->builder_name ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_builder_name() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->builder_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_builder_name() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->builder_name;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_cdom() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->cdom ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_cdom() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->cdom;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_cdom() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->cdom;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_contract_date() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->contract_date ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_contract_date() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->contract_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_contract_date() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->contract_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_is_foreclosure() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->is_foreclosure ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_is_foreclosure() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->is_foreclosure;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_is_foreclosure() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->is_foreclosure;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_feed_image_trans_date() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->feed_image_trans_date ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_feed_image_trans_date() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->feed_image_trans_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_feed_image_trans_date() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->feed_image_trans_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_foreclosure_type() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->foreclosure_type ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_foreclosure_type() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->foreclosure_type;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_foreclosure_type() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->foreclosure_type;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_green_features() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->green_features ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_green_features() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->green_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_green_features() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->green_features;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_modified() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->modified ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_modified() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->modified;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_modified() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->modified;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_latitude_display() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->latitude_display ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_latitude_display() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->latitude_display;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_latitude_display() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->latitude_display;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_list_date() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->list_date ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_list_date() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->list_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_list_date() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->list_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_listing_agent_id() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->listing_agent_id ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_listing_agent_id() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->listing_agent_id;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_listing_agent_id() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->listing_agent_id;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_listing_office_id() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->listing_office_id ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_listing_office_id() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->listing_office_id;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_listing_office_id() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->listing_office_id;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_longitude_display() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->longitude_display ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_longitude_display() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->longitude_display;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_longitude_display() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->longitude_display;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_is_new_construction() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->is_new_construction ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_is_new_construction() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->is_new_construction;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_is_new_construction() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->is_new_construction;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_number_of_units() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->number_of_units ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_number_of_units() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->number_of_units;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_number_of_units() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->number_of_units;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_open_house_begins() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->open_house_begins ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_open_house_begins() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->open_house_begins;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_open_house_begins() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->open_house_begins;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_open_house_date() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->open_house_date ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_open_house_date() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->open_house_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_open_house_date() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->open_house_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_open_house_ends() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->open_house_ends ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_open_house_ends() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->open_house_ends;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_open_house_ends() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->open_house_ends;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_original_list_price() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->original_list_price ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_original_list_price() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->original_list_price;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_original_list_price() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->original_list_price;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_possession_date() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->possession_date ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_possession_date() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->possession_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_possession_date() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->possession_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_possession_notes() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->possession_notes ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_possession_notes() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->possession_notes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_possession_notes() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->possession_notes;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_price_change_date() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->price_change_date ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_price_change_date() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->price_change_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_price_change_date() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->price_change_date;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_price_per_sq_feet() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->price_per_sq_feet ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_price_per_sq_feet() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->price_per_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_price_per_sq_feet() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->price_per_sq_feet;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_property_sub_type() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->property_sub_type ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_property_sub_type() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->property_sub_type;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_property_sub_type() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->property_sub_type;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_property_sub_type2() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->property_sub_type2 ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_property_sub_type2() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->property_sub_type2;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_property_sub_type2() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->property_sub_type2;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_short_sale() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->short_sale ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_short_sale() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->short_sale;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_short_sale() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->short_sale;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_status() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->status ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_status() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->status;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_status() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->status;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_sysid() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->sysid ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_sysid() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->sysid;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_id() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->id;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_id() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->id ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_id() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->id;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_sysid() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->sysid;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_total_number_of_units() {
	global $displetretsidx_listing;
	if ( !DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_listing->total_number_of_units ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_total_number_of_units() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->total_number_of_units;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_total_number_of_units() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->total_number_of_units;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: boolean
 */
function displetretsidx_has_virtual_tour_non_branded() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->virtual_tour_non_branded ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: text
 */
function displetretsidx_get_virtual_tour_non_branded() {
	global $displetretsidx_listing;
	return $displetretsidx_listing->virtual_tour_non_branded;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: text
 */
function displetretsidx_the_virtual_tour_non_branded() {
	global $displetretsidx_listing;
	echo $displetretsidx_listing->virtual_tour_non_branded;
}

/**
 * @return: print: text
 */
function displetretsidx_the_user_name() {
	global $displetretsidx_template;
	echo $displetretsidx_template['current_user_name'];
}

/**
 * @return: print: text
 */
function displetretsidx_the_user_email() {
	global $displetretsidx_template;
	echo $displetretsidx_template['current_user_email'];
}

/**
 * @return: print: text
 */
function displetretsidx_the_user_phone() {
	global $displetretsidx_template;
	echo $displetretsidx_template['current_user_phone'];
}

/**
 * @return: boolean
 */
function displetretsidx_have_similar_listings() {
	global $displetretsidx_template;
	global $displetretsidx_listing;
	global $displetretsidx_original_listing;
	if ( DispletRetsIdxUtilities::empty_excluding_zero( $displetretsidx_template['similar_listings_index'] ) ) {
		$displetretsidx_original_listing = $displetretsidx_listing;
		$displetretsidx_template['similar_listings_index'] = 0;
	}
	if ( !empty( $displetretsidx_template['similar_listings'][ $displetretsidx_template['similar_listings_index'] ] ) ) {
		return true;
	}
	else if ( $displetretsidx_template['similar_listings_index'] === count( $displetretsidx_template['similar_listings'] ) ) {
		$displetretsidx_listing = $displetretsidx_original_listing;
		$displetretsidx_template['similar_listings_index'] = 0;
	}
	return false;
}

/**
 * @return: none
 */
function displetretsidx_the_similar_listing() {
	global $displetretsidx_template;
	global $displetretsidx_listing;
	$displetretsidx_listing = $displetretsidx_template['similar_listings'][ $displetretsidx_template['similar_listings_index'] ];
	$displetretsidx_template['similar_listings_index']++;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_similar_listings_slideshow_class() {
	echo 'displet-similar-listings-slideshow';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_previous_similar_listings_class() {
	echo 'displet-similar-listings-previous';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_next_similar_listings_class() {
	echo 'displet-similar-listings-next';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_prepopulate_showing_request_date_class() {
	echo 'displet-prepopulated-showing-request-date';
}

?>