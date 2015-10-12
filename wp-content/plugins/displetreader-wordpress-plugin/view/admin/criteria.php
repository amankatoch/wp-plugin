<?php
	$idx_only = empty( $model['options']['displet_app_key'] ) ? 'idxonly' : '';
	$available_with_upgrade = empty( $model['options']['displet_app_key'] ) ? 'Available w/ Upgrade' : '';
	$disabled = empty( $model['options']['displet_app_key'] ) ? ' disabled' : '';
	if ( !empty( $model['field_options']['property_type'] ) ) {
		foreach ( $model['field_options']['property_type'] as $property_type ) {
			$property_types_array[] = $property_type;
		}
	}
	if ( empty( $property_types_array ) ) {
		$property_types_array = array(
			'House',
			'Condo',
			'Lease',
			'Land',
			'Multi',
			'Ranch'
		);
	}
	$property_type_options = '';
	foreach ( $property_types_array as $property_type ){
		$property_type_options .= '<option value="' . $property_type . '">' . $property_type . '</option>' . PHP_EOL;
	}
	if ( !empty( $model['options']['displet_app_key'] ) ) {
		$area_mls_defined_options = '';
		if ( !empty( $model['field_options']['area_mls_defined'] ) ) {
			foreach ( $model['field_options']['area_mls_defined'] as $area_mls_defined ) {
				$area_mls_defined_options .= '<option value="' . $area_mls_defined . '">' . $area_mls_defined . '</option>' . PHP_EOL;
			}
		}
		$city_options = '';
		if ( !empty($model['field_options']['city'] ) ) {
			foreach ( $model['field_options']['city'] as $city ) {
				$city_options .= '<option value="' . $city . '">' . $city . '</option>' . PHP_EOL;
			}
		}
		$school_district_options = '';
		if ( !empty( $model['field_options']['school_district'] ) ) {
			foreach ( $model['field_options']['school_district'] as $school_district ) {
				$school_district_options .= '<option value="' . $school_district . '">' . $school_district . '</option>' . PHP_EOL;
			}
		}
		$status_options = '';
		if ( !empty( $model['field_options']['status'] ) ) {
			foreach ( $model['field_options']['status'] as $status ) {
				$status_options .= '<option value="' . $status . '">' . $status . '</option>' . PHP_EOL;
			}
		}
	}
?>
<script>
	var displetretsidx_ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
	var displetretsidx_get_agent_id_nonce = '<?php echo wp_create_nonce("displet_get_agent_id_nonce"); ?>';
	var displetretsidx_get_office_id_nonce = '<?php echo wp_create_nonce("displet_get_office_id_nonce"); ?>';
</script>
<div class="criteria">
	<div class="displet-tabs displet-group">
		<a class="displet-active" href="#basic">
			Basic
		</a>
		<a href="#features">
			Features
		</a>
		<a href="#location">
			Location
		</a>
		<?php if ( !empty( $model['options']['use_polygon_search'] ) ) : ?>
			<a href="#map">
				Map
			</a>
		<?php endif; ?>
		<a href="#schools">
			Schools
		</a>
		<a href="#advanced">
			Advanced
		</a>
	</div>
	<div id="basic" class="displet-section">
		<table>
			<tr>
				<th scope="row">
					Property Type
				</th>
				<td>
					<select multiple name="criteria[property_type]">
						<option value="">
							Any
						</option>
						<?php echo $property_type_options; ?>
					</select>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Status
				</th>
				<td>
					<select multiple name="criteria[status]"<?php echo $disabled; ?>>
						<option value="">
							<?php echo !empty( $available_with_upgrade ) ? $available_with_upgrade : 'Any'; ?>
						</option>
						<?php echo $status_options; ?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					Min Price
				</th>
				<td class="price">
					<input type="text" name="criteria[minListPrice]"/>
					<span>
						,000
					</span>
				</td>
				<th scope="row">
					Max Price
				</th>
				<td class="price">
					<input type="text" name="criteria[maxListPrice]"/>
					<span>
						,000
					</span>
				</td>
			</tr>
			<tr>
				<th scope="row">
					Keywords
				</th>
				<td>
					<input type="text" name="criteria[keyword]"/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Age (In Years)
				</th>
				<td>
					<input type="text" name="criteria[yearBuilt]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					Foreclosure
				</th>
				<td>
					<input type="radio" name="criteria[is_foreclosure]" value=""/>
					Any
					<input type="radio" name="criteria[is_foreclosure]" value="Y"/>
					Yes
					<input type="radio" name="criteria[is_foreclosure]" value="N"/>
					No
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Short Sale
				</th>
				<td>
					<?php if ( !empty( $available_with_upgrade ) ) : ?>
						<div class="<?php echo $idx_only; ?>">
							<?php echo $available_with_upgrade; ?>
						</div>
					<?php else : ?>
						<input type="radio" name="criteria[short_sale]" value=""<?php echo $disabled; ?>/>
						Any
						<input type="radio" name="criteria[short_sale]" value="Y"<?php echo $disabled; ?>/>
						Yes
						<input type="radio" name="criteria[short_sale]" value="N"<?php echo $disabled; ?>/>
						No
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</div>
	<div id="features" class="displet-section">
		<table>
			<tr>
				<th scope="row">
					Min Bedrooms
				</th>
				<td>
					<input type="text" name="criteria[minBedrooms]"/>
				</td>
				<th scope="row">
					Max Bedrooms
				</th>
				<td>
					<input type="text" name="criteria[maxBedrooms]"/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					Min Bathrooms
				</th>
				<td>
					<input type="text" name="criteria[minBathrooms]"/>
				</td>
				<th scope="row">
					Max Bathrooms
				</th>
				<td>
					<input type="text" name="criteria[maxBathrooms]"/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					Min Sq Ft
				</th>
				<td>
					<input type="text" name="criteria[minSquareFeet]"/>
				</td>
				<th scope="row">
					Max Sq Ft
				</th>
				<td>
					<input type="text" name="criteria[maxSquareFeet]"/>
				</td>
			</tr>
			<tr>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Min Stories
				</th>
				<td>
					<input type="text" name="criteria[minStories]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Min Acres
				</th>
				<td>
					<input type="text" name="criteria[minAcres]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					Pool
				</th>
				<td>
					<input type="radio" name="criteria[pool_on_property]" value=""/>
					Any
					<input type="radio" name="criteria[pool_on_property]" value="Y"/>
					Yes
					<input type="radio" name="criteria[pool_on_property]" value="N"/>
					No
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Waterfront
				</th>
				<td>
					<?php if ( !empty( $available_with_upgrade ) ) : ?>
						<div class="<?php echo $idx_only; ?>">
							<?php echo $available_with_upgrade; ?>
						</div>
					<?php else : ?>
						<input type="radio" name="criteria[waterfront]" value=""<?php echo $disabled; ?>/>
						Any
						<input type="radio" name="criteria[waterfront]" value="Y"<?php echo $disabled; ?>/>
						Yes
						<input type="radio" name="criteria[waterfront]" value="N"<?php echo $disabled; ?>/>
						No
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</div>
	<div id="location" class="displet-section">
		<table>
			<tr>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Street Number
				</th>
				<td>
					<input type="text" name="criteria[street_number]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Street Name
				</th>
				<td>
					<input type="text" name="criteria[street_name]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
			</tr>
			<tr>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Quick Terms
				</th>
				<td>
					<input type="text" name="criteria[quick_terms]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
				<th scope="row">
					Subdivision
				</th>
				<td>
					<input type="text" name="criteria[subdivision]"/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					Zip Code
				</th>
				<td>
					<input type="text" name="criteria[zip]"/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					County
				</th>
				<td>
					<input type="text" name="criteria[county]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					City
				</th>
				<td>
					<?php if ( !empty($model['options']['displet_app_key'] ) ) : ?>
						<select multiple name="criteria[city]">
							<option value="">
								Any
							</option>
							<?php echo $city_options; ?>
						</select>
					<?php else : ?>
						<input type="text" name="criteria[city]"/>
					<?php endif;  ?>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Area (MLS Defined)
				</th>
				<td>
					<select multiple name="criteria[area_mls_defined]"<?php echo $disabled; ?>>
						<option value="">
							<?php echo !empty( $available_with_upgrade ) ? $available_with_upgrade : 'Any'; ?>
						</option>
						<?php echo $area_mls_defined_options; ?>
					</select>
				</td>
			</tr>
			<?php if ( empty( $model['options']['displet_app_key'] ) ) : ?>
				<tr>
					<th scope="row">
						Free Version
					</th>
					<td colspan="3">
						You may use city or zip code but not both with this version. Both available for simultaneous use with upgrade.
					</td>
				</tr>
			<?php endif; ?>
		</table>
	</div>
	<?php if ( !empty( $model['options']['use_polygon_search'] ) ) : ?>
		<div id="map" class="displet-section">
			<div id="displet-map-canvas"></div>
			<input type="hidden" name="criteria[poly]"<?php echo $disabled; ?>/>
		</div>
	<?php endif; ?>
	<div id="schools" class="displet-section">
		<table>
			<tr>
				<th scope="row" class="<?php echo $idx_only; ?>">
					School
				</th>
				<td>
					<input type="text" name="criteria[school]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					School District
				</th>
				<td>
					<select multiple name="criteria[school_district]"<?php echo $disabled; ?>>
						<option value="">
							<?php echo !empty( $available_with_upgrade ) ? $available_with_upgrade : 'Any'; ?>
						</option>
						<?php echo $school_district_options; ?>
					</select>
				</td>
			</tr>
		</table>
	</div>
	<div id="advanced" class="displet-section">
		<table>
			<tr>
				<th scope="row">
					Sort By
				</th>
				<td>
					<select name="criteria[sort]">
						<option value="">
							Default
						</option>
						<option value="price-ascending">
							Price Low to High
						</option>
						<option value="price-descending">
							Price High to Low
						</option>
						<option value="date-descending">
							Newest
						</option>
						<option value="date-ascending">
							Oldest
						</option>
					</select>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					MLS #
				</th>
				<td>
					<input type="text" name="criteria[mls_number]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
			</tr>
			<tr>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Listing Agent ID
				</th>
				<td>
					<input type="text" name="criteria[listing_agent_id]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Lookup Agent ID
				</th>
				<td>
					<a class="displet-get-listing-agent-id" href="javascript:;">
						Get Agent ID from MLS#
					</a>
				</td>
			</tr>
			<tr>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Listing Office ID
				</th>
				<td>
					<input type="text" name="criteria[listing_office_id]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Lookup Office ID
				</th>
				<td>
					<a class="displet-get-listing-office-id" href="javascript:;">
						Get Office ID from MLS#
					</a>
				</td>
			</tr>
			<tr>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Listed Since (In Days)
				</th>
				<td>
					<input type="text" name="criteria[listed_since]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
				<th scope="row" class="<?php echo $idx_only; ?>">
					Modified Since (In Days)
				</th>
				<td>
					<input type="text" name="criteria[last_modified]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
				</td>
			</tr>
		</table>
	</div>
</div>