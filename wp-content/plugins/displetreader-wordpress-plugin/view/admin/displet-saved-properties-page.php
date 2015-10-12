<script>
jQuery(document).ready(function($){
	$('#displet_delete_selected_saved_properties').click(function(){
		var properties_array = new Array();
		$('.displet-saved-properties-page.displet-admin table input:checked').each(function(){
			properties_array.push($(this).attr('id'))
		});
		if (properties_array.length) {
			var confirm = window.confirm('Are you sure you wish to delete the selected saved properties?');
			if (confirm == true){
				var data = {
				    action: 'displet_delete_properties_request',
				    _ajax_nonce: '<?php echo wp_create_nonce("displet_delete_properties_nonce"); ?>',
				    displet_properties: properties_array,
				};
				$.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {
					if (response == 'Succesful Deletion') {
						window.location.reload();
					}
					else {
						alert(response);
						window.location.reload();
					}
				});
			}
		}
		else{
			alert('No saved property has been selected.');
		}
	});
});
</script>
<?php
	global $displetretsidx_option;
	$user_id = get_current_user_id();
	$saved_properties = get_user_meta($user_id, 'displet_saved_properties', true);
	$has_favorites = $has_possibilities = $has_notes = false;
	$property_details_url = get_permalink($displetretsidx_option['property_details_page_id']);
	if (!empty($saved_properties)) {
		$saved_favorites = array();
		$saved_possibilities = array();
		$saved_notes = array();
		foreach ($saved_properties as $key => $saved_property){
			if (!empty($saved_property['sysid'])) {
				$model = array(
					'id' => $saved_property['sysid'],
					//'is_saved_searches_page' => true,
				);
				$residentials = new DispletRetsIdxResidentials( $model );
				$listing = $residentials->get_residentials();
				$saved_property = array_merge($saved_property, $listing);
				//$saved_property['listings'][0]->address = trim($saved_property['listings'][0]->street_number . ' ' . $saved_property['listings'][0]->street_name . ' ' . $saved_property['listings'][0]->street_post_dir);
			}
			if ($saved_property['type'] == 'favorite'){
				$saved_favorites[ $key ] = $saved_property;
			}
			else if ($saved_property['type'] == 'possibility'){
				$saved_possibilities[ $key ] = $saved_property;
			}
			else if ($saved_property['type'] == 'notes'){
				$saved_notes[ $key ] = $saved_property;
			}
		}
	}
?>
<div class="wrap displet-saved-properties-page displet-admin">
	<h2>Saved Properties</h2>
	<table>
		<tr>
			<th class="h3" colspan="6">
				<h3>
					Favorites
				</h3>
			</th>
		</tr>
		<?php if (!empty($saved_favorites)) : ?>
			<tr>
				<th></th>
				<th></th>
				<th>Price</th>
				<th>Address</th>
				<th>Rating</th>
				<th>Message</th>
			</tr>
			<?php foreach ($saved_favorites as $property_id => $saved_property) : ?>
				<tr class="details">
					<td class="select">
						<input id="<?php echo $property_id; ?>" type="checkbox">
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->image_urls->primary_big)) : ?>
							<div class="image-wrapper">
								<a href="<?php echo $property_details_url . $saved_property['url']; ?>">
									<img src="<?php echo $saved_property['listings'][0]->image_urls->primary_big; ?>">
								</a>
							</div>
						<?php endif; ?>
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->list_price)) : ?>
							$<?php echo number_format($saved_property['listings'][0]->list_price); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->address)) : ?>
							<a href="<?php echo $property_details_url . $saved_property['url']; ?>">
								<?php echo $saved_property['listings'][0]->address . ', ' . $saved_property['listings'][0]->city . ', ' . $saved_property['listings'][0]->state . ' ' . $saved_property['listings'][0]->zip; ?>
							</a>
						<?php endif; ?>
					</td>
					<td>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 1) echo ' displet-on'; ?>">
							1 Star
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 2) echo ' displet-on'; ?>">
							2 Stars
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 3) echo ' displet-on'; ?>">
							3 Stars
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 4) echo ' displet-on'; ?>">
							4 Stars
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 5) echo ' displet-on'; ?>">
							5 Stars
						</div>
					</td>
					<td>
						<?php echo nl2br( $saved_property['message'] ); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="6">You have no saved favorites at this time.</td>
			</tr>
		<?php endif; ?>
		<tr>
			<th class="h3" colspan="6">
				<h3>
					Possibilities
				</h3>
			</th>
		</tr>
		<?php if (!empty($saved_possibilities)) : ?>
			<tr>
				<th></th>
				<th></th>
				<th>Price</th>
				<th>Address</th>
				<th>Rating</th>
				<th>Message</th>
			</tr>
			<?php foreach ($saved_possibilities as $property_id => $saved_property) : ?>
				<tr class="details">
					<td>
						<input id="<?php echo $property_id ?>" type="checkbox">
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->image_urls->primary_big)) : ?>
							<a href="<?php echo $property_details_url . $saved_property['url']; ?>">
								<img src="<?php echo $saved_property['listings'][0]->image_urls->primary_big; ?>">
							</a>
						<?php endif; ?>
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->list_price)) : ?>
							$<?php echo number_format($saved_property['listings'][0]->list_price); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->address)) : ?>
							<a href="<?php echo $property_details_url . $saved_property['url']; ?>">
								<?php echo $saved_property['listings'][0]->address . ', ' . $saved_property['listings'][0]->city . ', ' . $saved_property['listings'][0]->state . ' ' . $saved_property['listings'][0]->zip; ?>
							</a>
						<?php endif; ?>
					</td>
					<td>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 1) echo ' displet-on'; ?>">
							1 Star
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 2) echo ' displet-on'; ?>">
							2 Stars
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 3) echo ' displet-on'; ?>">
							3 Stars
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 4) echo ' displet-on'; ?>">
							4 Stars
						</div>
						<div class="displet-rating<?php if ($saved_property['rating'] >= 5) echo ' displet-on'; ?>">
							5 Stars
						</div>
					</td>
					<td>
						<?php echo $saved_property['message']; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="6">You have no saved possibilities at this time.</td>
			</tr>
		<?php endif; ?>
		<tr>
			<th class="h3" colspan="6">
				<h3>
					Notes
				</h3>
			</th>
		</tr>
		<?php if (!empty($saved_notes)) : ?>
			<tr>
				<th></th>
				<th></th>
				<th>Price</th>
				<th>Address</th>
				<th></th>
				<th>Message</th>
			</tr>
			<?php foreach ($saved_notes as $property_id => $saved_property) : ?>
				<tr class="details">
					<td>
						<input id="<?php echo $property_id; ?>" type="checkbox">
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->image_urls->primary_big)) : ?>
							<a href="<?php echo $property_details_url . $saved_property['url']; ?>">
								<img src="<?php echo $saved_property['listings'][0]->image_urls->primary_big; ?>">
							</a>
						<?php endif; ?>
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->list_price)) : ?>
							$<?php echo number_format($saved_property['listings'][0]->list_price); ?>
						<?php endif; ?>
					</td>
					<td>
						<?php if (!empty($saved_property['listings'][0]->address)) : ?>
							<a href="<?php echo $property_details_url . $saved_property['url']; ?>">
								<?php echo $saved_property['listings'][0]->address . ', ' . $saved_property['listings'][0]->city . ', ' . $saved_property['listings'][0]->state . ' ' . $saved_property['listings'][0]->zip; ?>
							</a>
						<?php endif; ?>
					</td>
					<td></td>
					<td>
						<?php echo $saved_property['message']; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="6">You have no saved "just notes" properties at this time.</td>
			</tr>
		<?php endif; ?>
	</table>
	<div class="submit">
		<a href="javascript:;" id="displet_delete_selected_saved_properties" class="button-primary">Delete Selected Saved Properties</a>
	</div>
	<div class="displet-response"><!-- --></div>
</div>