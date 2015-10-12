<?php if ( $model['importing_users'] ) : ?>
	<div class="updated">
		<p>
			Your user import is in process. Please be patient while new users are created ( large imports may take several hours ). It is not necessary to remain on this page during the import process.
		</p>
	</div>
<?php endif; ?>
<div id="displet-lead-manager" class="wrap displet-admin">
	<h2>
		Displet RETS/IDX Lead Manager
	</h2>
	<h2 class="displet-tabs nav-tab-wrapper">
		<a href="#registered_leads" class="nav-tab">
			Leads
		</a>
		<?php if ( !empty( $model['partial_addresses'] ) ) : ?>
			<a href="#unregistered_addresses" class="displet-unregistered-addresses-tab nav-tab">
				Unregistered Addresses
			</a>
		<?php endif; ?>
		<a href="#search_leads" class="nav-tab">
			Search
		</a>
		<a href="#import_leads" class="nav-tab">
			Import
		</a>
	</h2>
	<div id="registered_leads" class="displet-tabbed">
		<table class="displet-leads form-table">
			<?php if ( !empty( $model['previous_url'] ) || !empty( $model['next_url'] ) ) : ?>
				<tr>
					<td colspan="10">
						<?php if ( !empty( $model['previous_url'] ) ) : ?>
							<a class="displet-left" href="<?php echo $model['previous_url']; ?>">
								Previous Page
							</a>
						<?php endif; ?>
						<?php if ( !empty( $model['next_url'] ) ) : ?>
							<a class="displet-right" href="<?php echo $model['next_url']; ?>">
								Next Page
							</a>
						<?php endif; ?>
						<?php if ( !empty( $model['pagination'] ) ) : ?>
							<div class="displet-pagination">
								<?php echo $model['pagination']; ?>
							</div>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
			<tr valign="top">
				<th class="checkbox"></th>
				<th>
					Name
				</th>
				<th>
					Email
				</th>
				<th>
					Phone
				</th>
				<?php if ( !empty( $model['options']['include_working_with_realtor'] ) ) : ?>
					<th>
						Has Realtor
					</th>
				<?php endif; ?>
				<th>
					Avg Price
				</th>
				<th>
					Avg Sq Ft
				</th>
				<th>
					Top Zip Code
				</th>
				<?php if ( $model['user_has_address'] ) : ?>
					<th>
						Address
					</th>
				<?php endif; ?>
				<?php if ( $model['is_admin_user'] ) : ?>
					<th>
						Agent
					</th>
					<th>
						Lender
					</th>
				<?php endif; ?>
			</tr>
			<?php if ( !empty( $model['leads'] ) ) : foreach ( $model['leads'] as $lead ) :
			?>
				<tr class="displet-lead">
					<td class="checkbox">
						<input id="<?php echo $lead->ID; ?>" type="checkbox">
					</td>
					<td>
						<a href="<?php echo $lead->view_url; ?>">
							<?php echo $lead->nickname; ?>
						</a>
					</td>
					<td>
						<a href="mailto:<?php echo $lead->user_email; ?>">
							<?php echo $lead->user_email; ?>
						</a>
					</td>
					<td>
						<?php echo $lead->displet_phone; ?>
					</td>
					<?php if ( !empty( $model['options']['include_working_with_realtor'] ) ) : ?>
						<td>
							<?php echo $lead->displet_realtor; ?>
						</td>
					<?php endif; ?>
					<td>
						$<?php if ( !empty( $lead->displet_mean_price ) ) echo number_format( $lead->displet_mean_price ); ?>
					</td>
					<td>
						<?php if ( !empty( $lead->displet_mean_square_feet ) ) echo number_format( $lead->displet_mean_square_feet ); ?>
					</td>
					<td>
						<?php echo $lead->displet_zip_mode; ?>
					</td>
					<?php if ( $model['user_has_address'] ) : ?>
						<td>
							<?php echo $lead->displet_user_submitted_address; ?>
						</td>
					<?php endif; ?>
					<?php if ( $model['is_admin_user'] ) : ?>
						<td>
							<?php echo $lead->agent; ?>
						</td>
						<td>
							<?php echo $lead->lender; ?>
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; else : ?>
				<tr>
					<td colspan="9">
						There are no leads
						<?php echo ( $_SERVER["REQUEST_URI"] == 'page=displet-lead-manager' ) ? 'at this time' : 'that match your search criteria'; ?>
					</td>
				</tr>
			<?php endif;?>
			<?php if ( !empty( $model['previous_url'] ) || !empty( $model['next_url'] ) ) : ?>
				<tr>
					<td colspan="10">
						<?php if ( !empty( $model['previous_url'] ) ) : ?>
							<a class="displet-left" href="<?php echo $model['previous_url']; ?>">
								Previous Page
							</a>
						<?php endif; ?>
						<?php if ( !empty( $model['next_url'] ) ) : ?>
							<a class="displet-right" href="<?php echo $model['next_url']; ?>">
								Next Page
							</a>
						<?php endif; ?>
						<?php if ( !empty( $model['pagination'] ) ) : ?>
							<div class="displet-pagination">
								<?php echo $model['pagination']; ?>
							</div>
						<?php endif; ?>
					</td>
				</tr>
			<?php endif; ?>
		</table>
		<table class="displet-user-action form-table">
			<tr valign="top">
				<td>
					<a href="javascript:;" id="displet_delete_selected_users" class="button-primary">Delete Selected Users</a>
				</td>
				<?php if ( $model['is_admin_user'] ) : ?>
					<td>
						Assign Selected Users to:
						<select id="displet_assigned_agent">
							<option value="">
								Agent
							</option>
							<?php
								if ( !empty( $model['agents'] ) ) {
									foreach ( $model['agents'] as $user ) {
										echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
									}
								}
							?>
						</select>
						<select id="displet_assigned_lender">
							<option value="">
								Lender
							</option>
							<?php
								if ( !empty( $model['lenders'] ) ) {
									foreach ( $model['lenders'] as $user ) {
										echo '<option value="' . $user->ID . '">' . $user->display_name . '</option>';
									}
								}
							?>
						</select>
						<a href="javascript:;" id="displet_reassign_selected_users" class="button-primary">
							Assign
						</a>
					</td>
				<?php endif; ?>
			</tr>
		</table>
	</div>
	<?php if ( !empty( $model['partial_addresses'] ) && is_array( $model['partial_addresses'] ) ) : ?>
		<div id="unregistered_addresses" class="displet-tabbed">
			<table class="displet-unregistered-addresses form-table">
				<?php if ( !empty( $model['previous_partial_address_url'] ) || !empty( $model['next_partial_address_url'] ) ) : ?>
					<tr>
						<td>
							<?php if ( !empty( $model['previous_partial_address_url'] ) ) : ?>
								<a href="<?php echo $model['previous_partial_address_url']; ?>">
									Previous Page
								</a>
							<?php endif; ?>
						</td>
						<td class="displet-next">
							<?php if ( !empty( $model['next_partial_address_url'] ) ) : ?>
								<a href="<?php echo $model['next_partial_address_url']; ?>">
									Next Page
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endif; ?>
				<tr valign="top">
					<th>
						Address
					</th>
					<th>
						Submitted
					</th>
				</tr>
				<?php foreach ( $model['partial_addresses'] as $partial_address ) : ?>
					<tr class="displet-unregistered-address">
						<td>
							<?php echo $partial_address->address; ?>
						</td>
						<td>
							<?php if ( !empty( $partial_address->epochs ) && is_array( $partial_address->epochs ) ) : foreach ( $partial_address->epochs as $epoch ) : ?>
								<div>
									<?php echo date( 'Y/m/d \a\t g:ia', $epoch ); ?>
								</div>
							<?php endforeach; endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php if ( !empty( $model['previous_partial_address_url'] ) || !empty( $model['next_partial_address_url'] ) ) : ?>
					<tr>
						<td>
							<?php if ( !empty( $model['previous_partial_address_url'] ) ) : ?>
								<a href="<?php echo $model['previous_partial_address_url']; ?>">
									Previous Page
								</a>
							<?php endif; ?>
						</td>
						<td class="displet-next">
							<?php if ( !empty( $model['next_partial_address_url'] ) ) : ?>
								<a href="<?php echo $model['next_partial_address_url']; ?>">
									Next Page
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endif; ?>
			</table>
		</div>
	<?php endif; ?>
	<div id="search_leads" class="displet-tabbed">
		<h3>
			Search Leads
		</h3>
		<form action="<?php echo admin_url( 'admin.php' ); ?>" method="get">
			<input type="hidden" name="page" value="displet-lead-manager">
			<table class="displet-user-search form-table">
				<tr valign="top">
					<th scope="row">
						<label for="user_name">
							Name
						</label>
					</th>
					<td>
						<input type="text" id="user_name" name="user_name"<?php if ( !empty( $_GET['user_name'] ) ) echo ' value="' . $_GET['user_name'] . '"'; ?>/>
					</td>
					<th scope="row">
						<label for="user_email">
							Email
						</label>
					</th>
					<td>
						<input type="text" id="user_email" name="user_email"<?php if ( !empty( $_GET['user_email'] ) ) echo ' value="' . $_GET['user_email'] . '"'; ?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="user_phone">
							Phone
						</label>
					</th>
					<td>
						<input type="text" id="user_phone" name="user_phone"<?php if ( !empty( $_GET['user_phone'] ) ) echo ' value="' . $_GET['user_phone'] . '"'; ?>/>
					</td>
					<th scope="row">
						<label for="has_phone">
							User Has Phone?
						</label>
					</th>
					<td>
						<input type="checkbox" id="has_phone" name="has_phone" value="1"<?php checked( $_GET['has_phone'] ); ?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="logged_in_since">
							Last Login Since
						</label>
					</th>
					<td>
						<input type="text" id="logged_in_since" name="logged_in_since"<?php if ( !empty( $_GET['logged_in_since'] ) ) echo ' value="' . $_GET['logged_in_since'] . '"'; ?>/>
					</td>
					<th scope="row">
						<label for="min_logins">
							Min Logins
						</label>
					</th>
					<td>
						<input type="text" id="min_logins" name="min_logins"<?php if ( !empty( $_GET['min_logins'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['min_logins'] ) . '"'; ?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="min_saved_properties">
							Min Saved Properties
						</label>
					</th>
					<td>
						<input type="text" id="min_saved_properties" name="min_saved_properties"<?php if ( !empty( $_GET['min_saved_properties'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['min_saved_properties'] ) . '"'; ?>/>
					</td>
					<th scope="row">
						<label for="min_saved_searches">
							Min Saved Searches
						</label>
					</th>
					<td>
						<input type="text" id="min_saved_searches" name="min_saved_searches"<?php if ( !empty( $_GET['min_saved_searches'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['min_saved_searches'] ) . '"'; ?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="min_showing_requests">
							Min Showing/Info Requests
						</label>
					</th>
					<td>
						<input type="text" id="min_showing_requests" name="min_showing_requests"<?php if ( !empty( $_GET['min_showing_requests'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['min_showing_requests'] ) . '"'; ?>/>
					</td>
					<th scope="row">
						<label for="zip_mode">
							Top Zip Code
						</label>
					</th>
					<td>
						<input type="text" id="zip_mode" name="zip_mode"<?php if ( !empty( $_GET['zip_mode'] ) ) echo ' value="' . $_GET['zip_mode'] . '"'; ?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="mean_price_min">
							Average Price Min
						</label>
					</th>
					<td>
						<input type="text" id="mean_price_min" name="mean_price_min"<?php if ( !empty( $_GET['mean_price_min'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['mean_price_min'] ) . '"'; ?>/>
					</td>
					<th scope="row">
						<label for="mean_price_max">
							Average Price Max
						</label>
					</th>
					<td>
						<input type="text" id="mean_price_max" name="mean_price_max"<?php if ( !empty( $_GET['mean_price_max'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['mean_price_max'] ) . '"'; ?>/>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="mean_square_feet_min">
							Average Square Feet Min
						</label>
					</th>
					<td>
						<input type="text" id="mean_square_feet_min" name="mean_square_feet_min"<?php if ( !empty( $_GET['mean_square_feet_min'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['mean_square_feet_min'] ) . '"'; ?>/>
					</td>
					<th scope="row">
						<label for="mean_square_feet_max">
							Average Square Feet Max
						</label>
					</th>
					<td>
						<input type="text" id="mean_square_feet_max" name="mean_square_feet_max"<?php if ( !empty( $_GET['mean_square_feet_max'] ) ) echo ' value="' . preg_replace( '/[^0-9]/', '', $_GET['mean_square_feet_max'] ) . '"'; ?>/>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" value="Search" class="button-primary">
			</p>
		</form>
	</div>
	<div id="import_leads" class="displet-tabbed">
		<h3>
			Import Leads
		</h3>
		<p>
			User import requires a
			<a href="http://en.wikipedia.org/wiki/Comma-separated_values">
				CSV ( comma-separated values ) file
			</a>
			containing any of the following headers ( email is required ):<br>
			<pre>Name, Email, Phone, Date</pre>
		</p>
		<form action="" method="post" enctype="multipart/form-data">
			<?php wp_nonce_field( 'displet_user_import_nonce' ); ?>
			<table class="form-table">
				<tr>
					<th scope="row">
						<label for="user_import_csv">
							CSV File:
						</label>
					</th>
					<td>
						<input type="file" name="user_import_csv">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="user_import_email">
							Send New User Email to Imported Users:
						</label>
					</th>
					<td>
						<input type="checkbox" name="user_import_email" value="1">
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="submit" value="Import" class="button-primary">
			</p>
		</form>
	</div>
</div>