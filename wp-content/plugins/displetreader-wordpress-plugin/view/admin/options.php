<?php
	$idx_only = empty( $model['options']['displet_app_key'] ) ? 'idxonly' : '';
	$available_with_upgrade = empty( $model['options']['displet_app_key'] ) ? 'Available w/ Upgrade' : '';
	$disabled = empty( $model['options']['displet_app_key'] ) ? ' disabled' : '';
	$displet_property_showcase_is_active = is_plugin_active( 'displet-property-showcase/displet-property-showcase.php' );
?>
<div class="options">
	<table>
		<tr>
			<th scope="row">
				Caption
			</th>
 			<td>
 				<input id="caption" name="criteria[caption]" type="text"/>
			</td>
			<th scope="row">
				Show Listings
			</th>
			<td>
				<select name="criteria[listings]">
					<option value="yes">
						<?php echo $displet_property_showcase_is_active ? 'Displet RETS/IDX' : 'Yes'; ?>
					</option>
					<?php if ( $displet_property_showcase_is_active ) : ?>
						<option value="showcase">
							Displet Property Showcase
						</option>
					<?php endif; ?>
					<option value="no">
						No
					</option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row" class="<?php echo $idx_only; ?>">
				Show Stats
			</th>
			<td>
				<select class="<?php echo $idx_only; ?>" name="criteria[stats]"<?php echo $disabled; ?>>
					<option value="">
						<?php echo !empty( $available_with_upgrade ) ? $available_with_upgrade : 'Default'; ?>
					</option>
					<option value="basic">
						Basic
					</option>
					<option value="advanced">
						Advanced
					</option>
					<option value="no">
						No
					</option>
				</select>
			</td>
			<th scope="row" class="<?php echo $idx_only; ?>">
				Show Property Type Navigation
			</th>
			<td>
				<select class="<?php echo $idx_only; ?>" name="criteria[property_type_navigation]"<?php echo $disabled; ?>>
					<option value="">
						<?php echo !empty( $available_with_upgrade ) ? $available_with_upgrade : 'Default'; ?>
					</option>
					<option value="yes">
						Yes
					</option>
					<option value="no">
						No
					</option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row" class="<?php echo $idx_only; ?>">
				Show Price Navigation
			</th>
			<td>
				<select class="<?php echo $idx_only; ?>" name="criteria[price_navigation]"<?php echo $disabled; ?>>
					<option value="">
						<?php echo !empty( $available_with_upgrade ) ? $available_with_upgrade : 'Default'; ?>
					</option>
					<option value="yes">
						Yes
					</option>
					<option value="no">
						No
					</option>
				</select>
			</td>
			<th scope="row" class="<?php echo $idx_only; ?>">
				Price Navigation Prices
			</th>
			<td>
				<input type="text" name="criteria[price_navigation_prices]" placeholder="<?php echo $available_with_upgrade; ?>"<?php echo $disabled; ?>/>
			</td>
		</tr>
		<tr>
			<th scope="row" class="<?php echo $idx_only; ?>">
				Layout
			</th>
			<td>
				<select class="<?php echo $idx_only; ?>" name="criteria[layout]"<?php echo $disabled; ?>>
					<option value="">
						<?php echo !empty( $available_with_upgrade ) ? $available_with_upgrade : 'Default'; ?>
					</option>
					<option value="default">
						Grouped by View ( Gallery/List/Map )
					</option>
					<option value="table">
						Grouped by Status ( Table )
					</option>
				</select>
			</td>
			<th scope="row">
				<span class="orientation">
					Orientation
				</span>
			</th>
			<td>
				<select name="criteria[orientation]">
					<option value="">
						Default
					</option>
					<option value="gallery">
						Gallery
					</option>
					<option value="list">
						List
					</option>
					<option value="map">
						Map
					</option>
				</select>
			</td>
		</tr>
	</table>
</div>