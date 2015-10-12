<?php displetretsidx_get_template_part( 'displet-mobile-header' ); ?>

<?php
	if ( displetretsidx_have_listings() ) : while ( displetretsidx_have_listings() ) : displetretsidx_the_listing();
	// Property Details section
	$displet_pdp_basic = array();
	if ( displetretsidx_has_mls_number() ) {
		$bold = displetretsidx_is_mls_number_emphasized() ? 'displet-emphasize displet-font-color' : '';
		$displet_pdp_basic[] =
		'<tr class="displet-mls">
			<td class="displet-detail-title">MLS&reg; #:</td>
			<td class="displet-mls-value ' . $bold . '">' . displetretsidx_get_mls_number() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_price() ) {
		$displet_pdp_basic[] =
		'<tr class="displet-list-price">
			<td class="displet-detail-title">List Price:</td>
			<td class="displet-list-price-value">$' . displetretsidx_get_price() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_property_type() ) {
		$displet_pdp_basic[] =
		'<tr class="displet-property-type">
			<td class="displet-detail-title">Property Type:</td>
			<td class="displet-property-type-value">' . displetretsidx_get_property_type() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_year_built() ) {
		$displet_pdp_basic[] =
		'<tr class="displet-year-built">
			<td class="displet-detail-title">Year Built:</td>
			<td class="displet-year-built-value">' . displetretsidx_get_year_built() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_bedrooms() ) {
		$displet_pdp_basic[] =
		'<tr class="displet-bedrooms">
			<td class="displet-detail-title">Bedrooms:</td>
			<td class="displet-bedrooms-value">' . displetretsidx_get_bedrooms() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_bathrooms() ) {
		$displet_pdp_basic[] =
		'<tr class="displet-bathrooms">
			<td class="displet-detail-title">Bathrooms:</td>
			<td class="displet-bathrooms-value">' . displetretsidx_get_bathrooms() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_square_feet() ) {
		$displet_pdp_basic[] =
		'<tr class="displet-square-feet">
			<td class="displet-detail-title">Square Feet:</td>
			<td class="displet-square-feet-value">' . displetretsidx_get_square_feet() . '</td>
		</tr>';
	}
	// Interior Information section
	$displet_pdp_interior = array();
	if ( displetretsidx_has_ac() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-air-conditioning">
			<td class="displet-detail-title">Air Conditioning:</td>
			<td class="displet-air-conditioning-value">' . displetretsidx_get_ac() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_appliances_equipment() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-appliances">
			<td class="displet-detail-title">Appliances:</td>
			<td class="displet-appliances-value">' . displetretsidx_get_appliances_equipment() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_basement() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-basement">
			<td class="displet-detail-title">Basement:</td>
			<td class="displet-basement-value">' . displetretsidx_get_basement() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_basement_description() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-basement-description">
			<td class="displet-detail-title">Basement Description:</td>
			<td class="displet-basement-description-value">' . displetretsidx_get_basement_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_basement_sq_feet() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-basement-sq-ft">
			<td class="displet-detail-title">Basement Sq Ft:</td>
			<td class="displet-basement-sq-ft-value">' . displetretsidx_get_basement_sq_feet() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_full_baths() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-bathrooms-full">
			<td class="displet-detail-title">Bathrooms ( full ):</td>
			<td class="displet-bathrooms-full-value">' . displetretsidx_get_full_baths() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_half_baths() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-bathrooms-half">
			<td class="displet-detail-title">Bathrooms ( half ):</td>
			<td class="displet-bathrooms-half-value">' . displetretsidx_get_half_baths() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_three_quarter_baths() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-bathrooms-three-quarter">
			<td class="displet-detail-title">Bathrooms ( three-quarter ):</td>
			<td class="displet-bathrooms-three-quarter-value">' . displetretsidx_get_three_quarter_baths() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_bedrooms() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-bedrooms">
			<td class="displet-detail-title">Bedrooms:</td>
			<td class="displet-bedrooms-value">' . displetretsidx_get_bedrooms() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_bed2_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-bedroom-2-dimensions">
			<td class="displet-detail-title">Bedroom( 2 ) Dimensions:</td>
			<td class="displet-bedroom-2-dimensions-value">' . displetretsidx_get_bed2_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_bed3_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-bedroom-3-dimensions">
			<td class="displet-detail-title">Bedroom( 3 ) Dimensions:</td>
			<td class="displet-bedroom-3-dimensions-value">' . displetretsidx_get_bed3_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_bed4_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-bedroom-4-dimensions">
			<td class="displet-detail-title">Bedroom( 4 ) Dimensions:</td>
			<td class="displet-bedroom-4-dimensions-value">' . displetretsidx_get_bed4_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_den_description() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-den-description">
			<td class="displet-detail-title">Den Description:</td>
			<td class="displet-den-description-value">' . displetretsidx_get_den_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_den_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-den-dimensions">
			<td class="displet-detail-title">Den Dimensions:</td>
			<td class="displet-den-dimensions-value">' . displetretsidx_get_den_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_dining() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-dining">
			<td class="displet-detail-title">Dining:</td>
			<td class="displet-dining-value">' . displetretsidx_get_dining() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_dining_description() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-dining-description">
			<td class="displet-detail-title">Dining Description:</td>
			<td class="displet-dining-description-value">' . displetretsidx_get_dining_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_dining_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-dining-dimensions">
			<td class="displet-detail-title">Dining Dimensions:</td>
			<td class="displet-dining-dimensions-value">' . displetretsidx_get_dining_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_disability_features() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-disability-features">
			<td class="displet-detail-title">Disability Features:</td>
			<td class="displet-disability-features-value">' . displetretsidx_get_disability_features() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_family_room_description() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-family-room-description">
			<td class="displet-detail-title">Family Room Description:</td>
			<td class="displet-family-room-description-value">' . displetretsidx_get_family_room_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_family_room_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-family-room-dimensions">
			<td class="displet-detail-title">Family Room Dimensions:</td>
			<td class="displet-family-room-dimensions-value">' . displetretsidx_get_family_room_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_fireplace_description() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-fireplace-description">
			<td class="displet-detail-title">Fireplace Description:</td>
			<td class="displet-fireplace-description-value">' . displetretsidx_get_fireplace_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_fireplaces() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-fireplaces">
			<td class="displet-detail-title">Fireplaces:</td>
			<td class="displet-fireplaces-value">' . displetretsidx_get_fireplaces() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_floor() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-floor">
			<td class="displet-detail-title">Floor:</td>
			<td class="displet-floor-value">' . displetretsidx_get_floor() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_foundation() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-foundation">
			<td class="displet-detail-title">Foundation:</td>
			<td class="displet-foundation-value">' . displetretsidx_get_foundation() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_garage_description() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-garage-description">
			<td class="displet-detail-title">Garage Description:</td>
			<td class="displet-garage-description-value">' . displetretsidx_get_garage_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_garage_spaces() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-garage-spaces">
			<td class="displet-detail-title">Garage Spaces:</td>
			<td class="displet-garage-spaces-value">' . displetretsidx_get_garage_spaces() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_guest_accommodations() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-guest-accommodations">
			<td class="displet-detail-title">Guest Accommodations:</td>
			<td class="displet-guest-accommodations-value">' . displetretsidx_get_guest_accommodations() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_heat() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-heat">
			<td class="displet-detail-title">Heat:</td>
			<td class="displet-heat-value">' . displetretsidx_get_heat() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_interior_features() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-interior-features">
			<td class="displet-detail-title">Interior Features:</td>
			<td class="displet-interior-features-value">' . displetretsidx_get_interior_features() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_kitchen() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-kitchen">
			<td class="displet-detail-title">Kitchen:</td>
			<td class="displet-kitchen-value">' . displetretsidx_get_kitchen() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_kitchen_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-kitchen-dimensions">
			<td class="displet-detail-title">Kitchen Dimensions:</td>
			<td class="displet-kitchen-dimensions-value">' . displetretsidx_get_kitchen_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_laundry_location() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-laundry-location">
			<td class="displet-detail-title">Laundry Location:</td>
			<td class="displet-laundry-location-value">' . displetretsidx_get_laundry_location() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_living() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-living">
			<td class="displet-detail-title">Living:</td>
			<td class="displet-living-value">' . displetretsidx_get_living() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_living_description() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-living-description">
			<td class="displet-detail-title">Living Description:</td>
			<td class="displet-living-description-value">' . displetretsidx_get_living_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_living_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-living-dimensions">
			<td class="displet-detail-title">Living Dimensions:</td>
			<td class="displet-living-dimensions-value">' . displetretsidx_get_living_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_main_level_beds() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-main-level-beds">
			<td class="displet-detail-title">Main Level Beds:</td>
			<td class="displet-main-level-beds-value">' . displetretsidx_get_main_level_beds() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_main_level_sq_feet() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-main-level-sq-ft">
			<td class="displet-detail-title">Main Level Sq Ft:</td>
			<td class="displet-main-level-sq-ft-value">' . displetretsidx_get_main_level_sq_feet() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_master_dimensions() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-master-dimensions">
			<td class="displet-detail-title">Master Dimensions:</td>
			<td class="displet-master-dimensions-value">' . displetretsidx_get_master_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_master_on_main() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-master-on-main">
			<td class="displet-detail-title">Master On Main:</td>
			<td class="displet-master-on-main-value">' . displetretsidx_get_master_on_main() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_num_beds_above_grade() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-num-beds-above-grade">
			<td class="displet-detail-title">Num Beds Above Grade:</td>
			<td class="displet-num-beds-above-grade-value">' . displetretsidx_get_num_beds_above_grade() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_other_level_beds() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-other-level-beds">
			<td class="displet-detail-title">Other Level Beds:</td>
			<td class="displet-other-level-beds-value">' . displetretsidx_get_other_level_beds() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_rooms() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-rooms">
			<td class="displet-detail-title">Rooms:</td>
			<td class="displet-rooms-value">' . displetretsidx_get_rooms() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_square_feet() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-square-feet">
			<td class="displet-detail-title">Square Feet:</td>
			<td class="displet-square-feet-value">' . displetretsidx_get_square_feet() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_square_feet2() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-square-feet-2">
			<td class="displet-detail-title">Square Feet( 2 ):</td>
			<td class="displet-square-feet-2-value">' . displetretsidx_get_square_feet2() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_square_feet2_source() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-square-feet-2-source">
			<td class="displet-detail-title">Square Feet( 2 ) Source:</td>
			<td class="displet-square-feet-2-source-value">' . displetretsidx_get_square_feet2_source() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_square_feet_available() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-square-feet-available">
			<td class="displet-detail-title">Square Feet Available:</td>
			<td class="displet-square-feet-available-value">' . displetretsidx_get_square_feet_available() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_square_feet_source() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-square-feet-source">
			<td class="displet-detail-title">Square Feet Source:</td>
			<td class="displet-square-feet-source-value">' . displetretsidx_get_square_feet_source() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_square_foot_source() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-square-foot-source">
			<td class="displet-detail-title">Square Foot Source:</td>
			<td class="displet-square-foot-source-value">' . displetretsidx_get_square_foot_source() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_stories() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-stories">
			<td class="displet-detail-title">Stories:</td>
			<td class="displet-stories-value">' . displetretsidx_get_stories() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_upper_level_sq_feet() ) {
		$displet_pdp_interior[] =
		'<tr class="displet-upper-level-sq-feet">
			<td class="displet-detail-title">Upper Level Sq Ft:</td>
			<td class="displet-upper-level-sq-feet-value">' . displetretsidx_get_upper_level_sq_feet() . '</td>
		</tr>';
	}
	// Exterior Information section
	$displet_pdp_exterior = array();
	if ( displetretsidx_has_acres() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-acres">
			<td class="displet-detail-title">Acres:</td>
			<td class="displet-acres-value">' . displetretsidx_get_acres() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_building_name() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-building-name">
			<td class="displet-detail-title">Building Name:</td>
			<td class="displet-building-name-value">' . displetretsidx_get_building_name() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_condo_parking() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-condo-parking">
			<td class="displet-detail-title">Condo Parking:</td>
			<td class="displet-condo-parking-value">' . displetretsidx_get_condo_parking() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_construction() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-construction">
			<td class="displet-detail-title">Construction:</td>
			<td class="displet-construction-value">' . displetretsidx_get_construction() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_exterior_features() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-exterior-features">
			<td class="displet-detail-title">Exterior Features:</td>
			<td class="displet-exterior-features-value">' . displetretsidx_get_exterior_features() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_fence() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-fence">
			<td class="displet-detail-title">Fence:</td>
			<td class="displet-fence-value">' . displetretsidx_get_fence() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_fence_description() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-fence-description">
			<td class="displet-detail-title">Fence Description:</td>
			<td class="displet-fence-description-value">' . displetretsidx_get_fence_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_lot_description() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-lot-description">
			<td class="displet-detail-title">Lot Description:</td>
			<td class="displet-lot-description-value">' . displetretsidx_get_lot_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_lot_dimensions() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-lot-dimensions">
			<td class="displet-detail-title">Lot Dimensions:</td>
			<td class="displet-lot-dimensions-value">' . displetretsidx_get_lot_dimensions() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_lot_size() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-lot-size">
			<td class="displet-detail-title">Lot Size:</td>
			<td class="displet-lot-size-value">' . displetretsidx_get_lot_size() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_has_parking() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-parking">
			<td class="displet-detail-title">Parking:</td>
			<td class="displet-parking-value">' . displetretsidx_get_has_parking() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_parking_description() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-parking-description">
			<td class="displet-detail-title">Parking Description:</td>
			<td class="displet-parking-description-value">' . displetretsidx_get_parking_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_parking_spaces() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-parking-spaces">
			<td class="displet-detail-title">Parking Spaces:</td>
			<td class="displet-parking-spaces-value">' . displetretsidx_get_parking_spaces() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_pool_description() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-pool-description">
			<td class="displet-detail-title">Pool Description:</td>
			<td class="displet-pool-description-value">' . displetretsidx_get_pool_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_pool_on_property() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-pool-on-property">
			<td class="displet-detail-title">Pool On Property:</td>
			<td class="displet-pool-on-property-value">' . displetretsidx_get_pool_on_property() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_roof() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-roof">
			<td class="displet-detail-title">Roof:</td>
			<td class="displet-roof-value">' . displetretsidx_get_roof() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_sewer() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-sewer">
			<td class="displet-detail-title">Sewer:</td>
			<td class="displet-sewer-value">' . displetretsidx_get_sewer() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_trees() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-trees">
			<td class="displet-detail-title">Trees:</td>
			<td class="displet-trees-value">' . displetretsidx_get_trees() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_view() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-view">
			<td class="displet-detail-title">View:</td>
			<td class="displet-view-value">' . displetretsidx_get_view() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_utilities() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-utilities">
			<td class="displet-detail-title">Utilities:</td>
			<td class="displet-utilities-value">' . displetretsidx_get_utilities() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_water() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-water">
			<td class="displet-detail-title">Water:</td>
			<td class="displet-water-value">' . displetretsidx_get_water() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_water_access() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-water-access">
			<td class="displet-detail-title">Water Access:</td>
			<td class="displet-water-access-value">' . displetretsidx_get_water_access() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_waterfront() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-waterfront">
			<td class="displet-detail-title">Waterfront:</td>
			<td class="displet-waterfront-value">' . displetretsidx_get_waterfront() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_waterfront_description() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-waterfront-description">
			<td class="displet-detail-title">Waterfront Description:</td>
			<td class="displet-waterfront-description-value">' . displetretsidx_get_waterfront_description() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_zoning() ) {
		$displet_pdp_exterior[] =
		'<tr class="displet-zoning">
			<td class="displet-detail-title">Zoning:</td>
			<td class="displet-zoning-value">' . displetretsidx_get_zoning() . '</td>
		</tr>';
	}
	// Area Information section
	$displet_pdp_area = array();
	if ( displetretsidx_has_area_amenities() ) {
		$displet_pdp_area[] =
		'<tr class="displet-amenities">
			<td class="displet-detail-title">Amenities:</td>
			<td class="displet-amenities-value">' . displetretsidx_get_area_amenities() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_area_mls_defined() ) {
		$displet_pdp_area[] =
		'<tr class="displet-area">
			<td class="displet-detail-title">Area:</td>
			<td class="displet-area-value">' . displetretsidx_get_area_mls_defined() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_city() ) {
		$displet_pdp_area[] =
		'<tr class="displet-city">
			<td class="displet-detail-title">City:</td>
			<td class="displet-city-value">' . displetretsidx_get_city() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_county() ) {
		$displet_pdp_area[] =
		'<tr class="displet-county">
			<td class="displet-detail-title">County:</td>
			<td class="displet-county-value">' . displetretsidx_get_county() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_is_gated_community() ) {
		$displet_pdp_area[] =
		'<tr class="displet-gated-community">
			<td class="displet-detail-title">Gated Community:</td>
			<td class="displet-gated-community-value">' . displetretsidx_get_is_gated_community() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_state() ) {
		$displet_pdp_area[] =
		'<tr class="displet-state">
			<td class="displet-detail-title">State:</td>
			<td class="displet-state-value">' . displetretsidx_get_state() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_street_name() ) {
		$displet_pdp_area[] =
		'<tr class="displet-street-name">
			<td class="displet-detail-title">Street Name:</td>
			<td class="displet-street-name-value">' . displetretsidx_get_street_name() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_street_number() ) {
		$displet_pdp_area[] =
		'<tr class="displet-street-number">
			<td class="displet-detail-title">Street Number:</td>
			<td class="displet-street-number-value">' . displetretsidx_get_street_number() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_street_post_dir() ) {
		$displet_pdp_area[] =
		'<tr class="displet-street-post-dir">
			<td class="displet-detail-title">Street Post Dir:</td>
			<td class="displet-street-post-dir-value">' . displetretsidx_get_street_post_dir() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_street_pre_direction() ) {
		$displet_pdp_area[] =
		'<tr class="displet-street-pre-direction">
			<td class="displet-detail-title">Street Pre Direction:</td>
			<td class="displet-street-pre-direction-value">' . displetretsidx_get_street_pre_direction() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_subdivision() ) {
		$displet_pdp_area[] =
		'<tr class="displet-subdivision">
			<td class="displet-detail-title">Subdivision:</td>
			<td class="displet-subdivision-value">' . displetretsidx_get_subdivision() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_unit() ) {
		$displet_pdp_area[] =
		'<tr class="displet-unit">
			<td class="displet-detail-title">Unit:</td>
			<td class="displet-unit-value">' . displetretsidx_get_unit() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_zip() ) {
		$displet_pdp_area[] =
		'<tr class="displet-zip">
			<td class="displet-detail-title">' . displetretsidx_get_zip_label() . ':</td>
			<td class="displet-zip-value">' . displetretsidx_get_zip() . '</td>
		</tr>';
	}
	// School Information section
	$displet_pdp_school = array();
	if ( displetretsidx_has_elementary_a() ) {
		$displet_pdp_school[] =
		'<tr class="displet-elementary-a">
			<td class="displet-detail-title">Elementary:</td>
			<td class="displet-elementary-a-value">' . displetretsidx_get_elementary_a() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_high_school() ) {
		$displet_pdp_school[] =
		'<tr class="displet-high-school">
			<td class="displet-detail-title">High School:</td>
			<td class="displet-high-school-value">' . displetretsidx_get_high_school() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_junior_high_school() ) {
		$displet_pdp_school[] =
		'<tr class="displet-junior-high-school">
			<td class="displet-detail-title">Junior High School:</td>
			<td class="displet-junior-high-school-value">' . displetretsidx_get_junior_high_school() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_middle_school() ) {
		$displet_pdp_school[] =
		'<tr class="displet-middle-school">
			<td class="displet-detail-title">Middle School:</td>
			<td class="displet-middle-school-value">' . displetretsidx_get_middle_school() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_other_school() ) {
		$displet_pdp_school[] =
		'<tr class="displet-other-school">
			<td class="displet-detail-title">Other School:</td>
			<td class="displet-other-school-value">' . displetretsidx_get_other_school() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_school_district() ) {
		$displet_pdp_school[] =
		'<tr class="displet-school-district">
			<td class="displet-detail-title">School District:</td>
			<td class="displet-school-district-value">' . displetretsidx_get_school_district() . '</td>
		</tr>';
	}
	// Tax Information section
	$displet_pdp_tax = array();
	if ( displetretsidx_has_condo_fee() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-condo-fee">
			<td class="displet-detail-title">Condo Fee:</td>
			<td class="displet-condo-fee-value">' . displetretsidx_get_condo_fee() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_condo_fee_frequency() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-condo-fee-frequency">
			<td class="displet-detail-title">Condo Fee Frequency:</td>
			<td class="displet-condo-fee-frequency-value">' . displetretsidx_get_condo_fee_frequency() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_condo_fee_includes() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-condo-fee-includes">
			<td class="displet-detail-title">Condo Fee Includes:</td>
			<td class="displet-condo-fee-includes-value">' . displetretsidx_get_condo_fee_includes() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_estimated_taxes() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-estimated-taxes">
			<td class="displet-detail-title">Estimated Taxes:</td>
			<td class="displet-estimated-taxes-value">$' . displetretsidx_get_estimated_taxes() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_hoa() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-hoa">
			<td class="displet-detail-title">HOA:</td>
			<td class="displet-hoa-value">' . displetretsidx_get_hoa() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_hoa_fee() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-hoa-fee">
			<td class="displet-detail-title">HOA Fee:</td>
			<td class="displet-hoa-fee-value">$' . displetretsidx_get_hoa_fee() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_hoa_fee_includes() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-hoa-fee-includes">
			<td class="displet-detail-title">HOA Fee Includes:</td>
			<td class="displet-hoa-fee-includes-value">' . displetretsidx_get_hoa_fee_includes() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_hoa_frequency() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-hoa-frequency">
			<td class="displet-detail-title">HOA Frequency:</td>
			<td class="displet-hoa-frequency-value">' . displetretsidx_get_hoa_frequency() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_hoa_requirement() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-hoa-requirement">
			<td class="displet-detail-title">HOA Requirement:</td>
			<td class="displet-hoa-requirement-value">' . displetretsidx_get_hoa_requirement() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_mainteinance_fee() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-mainteinance-fee">
			<td class="displet-detail-title">Mainteinance Fee:</td>
			<td class="displet-mainteinance-fee-value">$' . displetretsidx_get_mainteinance_fee() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_tax_year() ) {
		$displet_pdp_tax[] =
		'<tr class="displet-tax-year">
			<td class="displet-detail-title">Tax Year:</td>
			<td class="displet-tax-year-value">' . displetretsidx_get_tax_year() . '</td>
		</tr>';
	}
	// Additional Information section
	$displet_pdp_other = array();
	if ( displetretsidx_has_builder_name() ) {
		$displet_pdp_other[] =
		'<tr class="displet-builder-name">
			<td class="displet-detail-title">Builder Name:</td>
			<td class="displet-builder-name-value">' . displetretsidx_get_builder_name() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_cdom() ) {
		$displet_pdp_other[] =
		'<tr class="displet-days-on-market">
			<td class="displet-detail-title">Days On Market ( contiguous ):</td>
			<td class="displet-days-on-market-value">' . displetretsidx_get_cdom() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_contract_date() ) {
		$displet_pdp_other[] =
		'<tr class="displet-contract-date">
			<td class="displet-detail-title">Contract Date:</td>
			<td class="displet-contract-date-value">' . displetretsidx_get_contract_date() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_is_foreclosure() ) {
		$displet_pdp_other[] =
		'<tr class="displet-foreclosure">
			<td class="displet-detail-title">Foreclosure:</td>
			<td class="displet-foreclosure-value">' . displetretsidx_get_is_foreclosure() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_feed_image_trans_date() ) {
		$displet_pdp_other[] =
		'<tr class="displet-feed-image-trans-date">
			<td class="displet-detail-title">Feed Image Trans Date:</td>
			<td class="displet-feed-image-trans-date-value">' . displetretsidx_get_feed_image_trans_date() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_foreclosure_type() ) {
		$displet_pdp_other[] =
		'<tr class="displet-foreclosure-type">
			<td class="displet-detail-title">Foreclosure Type:</td>
			<td class="displet-foreclosure-type-value">' . displetretsidx_get_foreclosure_type() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_green_features() ) {
		$displet_pdp_other[] =
		'<tr class="displet-green-features">
			<td class="displet-detail-title">Green Features:</td>
			<td class="displet-green-features-value">' . displetretsidx_get_green_features() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_modified() ) {
		$displet_pdp_other[] =
		'<tr class="displet-last-modified">
			<td class="displet-detail-title">Last Modified:</td>
			<td class="displet-last-modified-value">' . displetretsidx_get_modified() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_latitude_display() ) {
		$displet_pdp_other[] =
		'<tr class="displet-latitude">
			<td class="displet-detail-title">Latitude:</td>
			<td class="displet-latitude-value">' . displetretsidx_get_latitude_display() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_list_date() ) {
		$displet_pdp_other[] =
		'<tr class="displet-list-date">
			<td class="displet-detail-title">List Date:</td>
			<td class="displet-list-date-value">' . displetretsidx_get_list_date() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_price() ) {
		$displet_pdp_other[] =
		'<tr class="displet-list-price">
			<td class="displet-detail-title">List Price:</td>
			<td class="displet-list-price-value">$' . displetretsidx_get_price() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_listing_agent_name() ) {
		$bold = displetretsidx_is_listing_agent_name_emphasized() ? 'displet-emphasize displet-font-color' : '';
		$displet_pdp_other[] =
		'<tr class="displet-listing-agent-name">
			<td class="displet-detail-title">Listing Agent:</td>
			<td class="displet-listing-agent-name-value ' . $bold . '">' . displetretsidx_get_listing_agent_name() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_listing_agent_id() ) {
		$bold = displetretsidx_is_listing_agent_id_emphasized() ? 'displet-emphasize displet-font-color' : '';
		$displet_pdp_other[] =
		'<tr class="displet-listing-agent-id">
			<td class="displet-detail-title">Listing Agent ID:</td>
			<td class="displet-listing-agent-id-value ' . $bold . '">' . displetretsidx_get_listing_agent_id() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_listing_office_name() ) {
		$bold = displetretsidx_is_listing_office_name_emphasized() ? 'displet-emphasize displet-font-color' : '';
		$displet_pdp_other[] =
		'<tr class="displet-listing-office-name">
			<td class="displet-detail-title">Listing Office:</td>
			<td class="displet-listing-office-name-value ' . $bold . '">' . displetretsidx_get_listing_office_name() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_listing_office_id() ) {
		$bold = displetretsidx_is_listing_office_id_emphasized() ? 'displet-emphasize displet-font-color' : '';
		$displet_pdp_other[] =
		'<tr class="displet-listing-office-id">
			<td class="displet-detail-title">Listing Office ID:</td>
			<td class="displet-listing-office-id-value ' . $bold . '">' . displetretsidx_get_listing_office_id() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_longitude_display() ) {
		$displet_pdp_other[] =
		'<tr class="displet-longitude">
			<td class="displet-detail-title">Longitude:</td>
			<td class="displet-longitude-value">' . displetretsidx_get_longitude_display() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_mls_number() ) {
		$bold = displetretsidx_is_mls_number_emphasized() ? 'displet-emphasize displet-font-color' : '';
		$displet_pdp_other[] =
		'<tr class="displet-mls-number">
			<td class="displet-detail-title">MLS&reg; #:</td>
			<td class="displet-mls-number-value ' . $bold . '">' . displetretsidx_get_mls_number() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_is_new_construction() ) {
		$displet_pdp_other[] =
		'<tr class="displet-new-construction">
			<td class="displet-detail-title">New Construction:</td>
			<td class="displet-new-construction-value">' . displetretsidx_get_is_new_construction() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_number_of_units() ) {
		$displet_pdp_other[] =
		'<tr class="displet-number-of-units">
			<td class="displet-detail-title">Number Of Units:</td>
			<td class="displet-number-of-units-value">' . displetretsidx_get_number_of_units() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_open_house_begins() ) {
		$displet_pdp_other[] =
		'<tr class="displet-open-house-begins">
			<td class="displet-detail-title">Open House Begins:</td>
			<td class="displet-open-house-begins-value">' . displetretsidx_get_open_house_begins() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_open_house_date() ) {
		$displet_pdp_other[] =
		'<tr class="displet-open-house-date">
			<td class="displet-detail-title">Open House Date:</td>
			<td class="displet-open-house-date-value">' . displetretsidx_get_open_house_date() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_open_house_ends() ) {
		$displet_pdp_other[] =
		'<tr class="displet-open-house-ends">
			<td class="displet-detail-title">Open House Ends:</td>
			<td class="displet-open-house-ends-value">' . displetretsidx_get_open_house_ends() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_original_list_price() ) {
		$displet_pdp_other[] =
		'<tr class="displet-original-list-price">
			<td class="displet-detail-title">Original List Price:</td>
			<td class="displet-original-list-price-value">$' . displetretsidx_get_original_list_price() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_possession_date() ) {
		$displet_pdp_other[] =
		'<tr class="displet-possession-date">
			<td class="displet-detail-title">Possession Date:</td>
			<td class="displet-possession-date-value">' . displetretsidx_get_possession_date() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_possession_notes() ) {
		$displet_pdp_other[] =
		'<tr class="displet-possession-notes">
			<td class="displet-detail-title">Possession Notes:</td>
			<td class="displet-possession-notes-value">' . displetretsidx_get_possession_notes() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_price_change_date() ) {
		$displet_pdp_other[] =
		'<tr class="displet-price-change-date">
			<td class="displet-detail-title">Price Change Date:</td>
			<td class="displet-price-change-date-value">' . displetretsidx_get_price_change_date() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_price_per_sq_feet() ) {
		$displet_pdp_other[] =
		'<tr class="displet-price-per-sq-ft">
			<td class="displet-detail-title">Price Per Sq Ft:</td>
			<td class="displet-price-per-sq-ft-value">$' . displetretsidx_get_price_per_sq_feet() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_property_sub_type() ) {
		$displet_pdp_other[] =
		'<tr class="displet-property-sub-type">
			<td class="displet-detail-title">Property Sub-Type:</td>
			<td class="displet-property-sub-type-value">' . displetretsidx_get_property_sub_type() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_property_sub_type2() ) {
		$displet_pdp_other[] =
		'<tr class="displet-property-sub-type-2">
			<td class="displet-detail-title">Property Sub Type( 2 ):</td>
			<td class="displet-property-sub-type-2-value">' . displetretsidx_get_property_sub_type2() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_property_type() ) {
		$displet_pdp_other[] =
		'<tr class="displet-property-type">
			<td class="displet-detail-title">Property Type:</td>
			<td class="displet-property-type-value">' . displetretsidx_get_property_type() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_short_sale() ) {
		$displet_pdp_other[] =
		'<tr class="displet-short-sale">
			<td class="displet-detail-title">Short Sale:</td>
			<td class="displet-short-sale-value">' . displetretsidx_get_short_sale() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_status() ) {
		$displet_pdp_other[] =
		'<tr class="displet-status">
			<td class="displet-detail-title">Status:</td>
			<td class="displet-status-value">' . displetretsidx_get_status() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_sysid() ) {
		$displet_pdp_other[] =
		'<tr class="displet-sysid">
			<td class="displet-detail-title">Sysid:</td>
			<td class="displet-sysid-value">' . displetretsidx_get_sysid() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_total_number_of_units() ) {
		$displet_pdp_other[] =
		'<tr class="displet-total-number-of-units">
			<td class="displet-detail-title">Total Number Of Units:</td>
			<td class="displet-total-number-of-units-value">' . displetretsidx_get_total_number_of_units() . '</td>
		</tr>';
	}
	if ( displetretsidx_has_virtual_tour_non_branded() ) {
		$displet_pdp_other[] =
		'<tr class="displet-virtual-tour">
			<td class="displet-detail-title">Virtual Tour:</td>
			<td class="displet-virtual-tour-value"><a href="' . displetretsidx_get_virtual_tour_non_branded() . '" target="_blank">' . displetretsidx_get_virtual_tour_non_branded() . '</a></td>
		</tr>';
	}
	if ( displetretsidx_has_year_built() ) {
		$displet_pdp_other[] =
		'<tr class="displet-year-built">
			<td class="displet-detail-title">Year Built:</td>
			<td class="displet-year-built-value">' . displetretsidx_get_year_built() . '</td>
		</tr>';
	}
?>
<div id="displet-property-details" class="<?php displetretsidx_the_default_mobile_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<h1 class="<?php displetretsidx_the_address_class(); ?>">
		<?php displetretsidx_the_address(); ?>
	</h1>
	<?php if ( displetretsidx_has_photo_urls() ) : ?>
		<div id="displet-photos">
			<div class="<?php displetretsidx_the_photos_class(); ?>">
				<img src="<?php displetretsidx_the_photo_url(); ?>">
				<div class="<?php displetretsidx_the_more_photos_class(); ?>">
					More Photos
				</div>
			</div>
			<div class="<?php displetretsidx_the_thumbnails_class(); ?> displet-group">
				<?php $image_urls = displetretsidx_get_photo_urls(); foreach ( $image_urls as $image_url ) : ?>
					<a class="<?php displetretsidx_the_thumbnail_class(); ?>" href="#displet-photos">
						<img src="<?php echo $image_url; ?>">
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php if ( !displetretsidx_has_api_key() ) : ?>
			<div class="displet-free-disclaimer">
				This site is currently using the FREE version of the Displet plugin. For HIGH RES images &amp; up-to-date RETS data, please upgrade.
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="displet-basic">
		<?php if ( !empty( $displet_pdp_basic ) ) : ?>
			<table>
				<?php if ( !empty( $displet_pdp_basic ) ) foreach ( $displet_pdp_basic as $displet_pdp_html ) echo $displet_pdp_html; ?>
			</table>
		<?php endif; ?>
		<div class="displet-basic-action displet-group">
			<div class="displet-left">
				<a class="<?php displetretsidx_the_request_showing_class(); ?>" href="javascript:;">
					Request Info/ Showing
				</a>
			</div>
			<div class="displet-right">
				<a class="<?php displetretsidx_the_save_property_class(); ?>" href="javascript:;">
					Save Property
				</a>
			</div>
		</div>
	</div>
	<table class="displet-action">
		<tr>
			<?php if ( displetretsidx_has_phone() ) : ?>
				<td class="displet-phone">
					Call @
					<a href="<?php displetretsidx_the_phone_url(); ?>">
						<?php displetretsidx_the_phone(); ?>
					</a>
				</td>
			<?php endif; ?>
			<td class="displet-email">
				<a class="<?php displetretsidx_the_email_friend_class(); ?>" href="javascript:;">
					Email to a Friend
				</a>
			</td>
		</tr>
	</table>
	<?php if ( displetretsidx_has_description() ) : ?>
		<div class="displet-description">
			<h4 class="displet-description-title">
				Property Description
			</h4>
			<div class="displet-description-value">
				<?php displetretsidx_the_description(); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( displetretsidx_has_disclaimer() && displetretsidx_is_disclaimer_above_details() ) : ?>
		<div class="displet-disclaimer">
			<?php displetretsidx_the_disclaimer(); ?>
		</div>
	<?php endif; ?>
	<div class="displet-details-section">
		<h4 class="displet-description-title">
			Property Details
		</h4>
		<?php if ( !empty( $displet_pdp_interior ) ) : ?>
			<div class="displet-section">
				<h4 class="displet-section-title displet-active">
					Interior Information
				</h4>
				<table class="displet-details">
					<?php if ( !empty( $displet_pdp_interior ) ) foreach ( $displet_pdp_interior as $displet_pdp_html ) echo $displet_pdp_html; ?>
				</table>
			</div>
		<?php endif; ?>
		<?php if ( !empty( $displet_pdp_exterior ) ) : ?>
			<div class="displet-section">
				<h4 class="displet-section-title">
					Lot &amp; Exterior Information
				</h4>
				<table class="displet-details" style="display: none;">
					<?php if ( !empty( $displet_pdp_exterior ) ) foreach ( $displet_pdp_exterior as $displet_pdp_html ) echo $displet_pdp_html; ?>
				</table>
			</div>
		<?php endif; ?>
		<?php if ( !empty( $displet_pdp_area ) ) : ?>
			<div class="displet-section">
				<h4 class="displet-section-title">
					Area Information
				</h4>
				<table class="displet-details" style="display: none;">
					<?php if ( !empty( $displet_pdp_area ) ) foreach ( $displet_pdp_area as $displet_pdp_html ) echo $displet_pdp_html; ?>
				</table>
			</div>
		<?php endif; ?>
		<?php if ( !empty( $displet_pdp_school ) ) : ?>
			<div class="displet-section">
				<h4 class="displet-section-title">
					School Information
				</h4>
				<table class="displet-details" style="display: none;">
					<?php if ( !empty( $displet_pdp_school ) ) foreach ( $displet_pdp_school as $displet_pdp_html ) echo $displet_pdp_html; ?>
				</table>
			</div>
		<?php endif; ?>
		<?php if ( !empty( $displet_pdp_tax ) ) : ?>
			<div class="displet-section">
				<h4 class="displet-section-title">
					Tax &amp; HOA Information
				</h4>
				<table class="displet-details" style="display: none;">
					<?php if ( !empty( $displet_pdp_tax ) ) foreach ( $displet_pdp_tax as $displet_pdp_html ) echo $displet_pdp_html; ?>
				</table>
			</div>
		<?php endif; ?>
		<?php if ( !empty( $displet_pdp_other ) ) : ?>
			<div class="displet-section">
				<h4 class="displet-section-title">
					Additional Information
				</h4>
				<table class="displet-details" style="display: none;">
					<?php if ( !empty( $displet_pdp_other ) ) foreach ( $displet_pdp_other as $displet_pdp_html ) echo $displet_pdp_html; ?>
				</table>
			</div>
		<?php endif; ?>
	</div>
	<?php if ( displetretsidx_has_maps() ) : ?>
		<div class="<?php displetretsidx_the_map_tabs_class(); ?> displet-group">
			<a class="<?php displetretsidx_the_map_tab_class(); ?>" href="javascript:;">
				Map
			</a>
			<a class="<?php displetretsidx_the_street_view_tab_class(); ?>" href="javascript:;">
				Street View
			</a>
		</div>
		<div class="displet-map">
			<?php displetretsidx_the_maps(); ?>
		</div>
	<?php endif; ?>
	<div class="displet-powered">
		<?php displetretsidx_the_credit(); ?>
	</div>
	<?php if ( !displetretsidx_has_api_key() ) : ?>
		<div class="displet-free-disclaimer">
			This site is currently using the FREE version of the Displet plugin. For HIGH RES images &amp; up-to-date RETS data, please upgrade.
		</div>
	<?php endif; ?>
	<?php if ( displetretsidx_has_disclaimer() && !displetretsidx_is_disclaimer_above_details() ) : ?>
		<div class="displet-disclaimer">
			<?php displetretsidx_the_disclaimer(); ?>
		</div>
	<?php endif; ?>
</div>
<?php endwhile; endif; ?>

<?php displetretsidx_get_template_part( 'displet-mobile-footer' ); ?>