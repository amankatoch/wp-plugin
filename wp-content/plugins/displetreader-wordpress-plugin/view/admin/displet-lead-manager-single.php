<div id="displet-lead-manager-single" class="wrap">
	<h2>
		Displet Lead Manager
	</h2>
	<a href="<?php echo $model['lead_manager_page_url']; ?>">
		Back To Lead Manager
	</a>
	<table class="form-table">
		<tr>
			<td>
				<h3>
					<?php echo $model['lead']->nickname; ?>
					<a href="<?php echo $model['lead']->edit_url; ?>">
						(Edit)
					</a>
				</h3>
				<?php if ( !empty( $model['lead']->displet_phone ) ) : ?>
					<div>
						<?php echo $model['lead']->displet_phone; ?>
					</div>
				<?php endif; ?>
				<div>
					<a href="mailto:<?php echo $model['lead']->user_email; ?>">
						<?php echo $model['lead']->user_email; ?>
					</a>
				</div>
			</td>
			<td>
				<?php if ( !empty( $model['lead']->displet_mean_price ) ) : ?>
					<div>
						<label>
							Avg Price:
						</label>
						$<?php echo number_format( $model['lead']->displet_mean_price ); ?>
					</div>
				<?php endif; ?>
				<?php if ( !empty( $model['lead']->displet_zip_mode ) ) : ?>
					<div>
						<label>
							Top Zip Code:
						</label>
						<?php echo $model['lead']->displet_zip_mode; ?>
					</div>
				<?php endif; ?>
			</td>
			<td>
				<?php if ( !empty( $model['lead']->displet_mean_square_feet ) ) : ?>
					<div>
						<label>
							Avg Sq Ft:
						</label>
						<?php echo number_format( $model['lead']->displet_mean_square_feet ); ?>
					</div>
				<?php endif; ?>
				<?php if ( !empty( $model['lead']->displet_mean_beds ) ) : ?>
					<div>
						<label>
							Avg Beds:
						</label>
						<?php echo number_format( $model['lead']->displet_mean_beds ); ?>
					</div>
				<?php endif; ?>
				<?php if ( !empty( $model['lead']->displet_mean_baths ) ) : ?>
					<div>
						<label>
							Avg Baths:
						</label>
						<?php echo number_format( $model['lead']->displet_mean_baths ); ?>
					</div>
				<?php endif; ?>
			</td>
			<td>
				<?php if ( !empty( $model['lead']->last_login ) ) : ?>
					<div>
						<label>
							Last Login:
						</label>
						<?php echo $model['lead']->last_login; ?>
					</div>
				<?php endif; ?>
				<?php if ( !empty( $model['lead']->displet_logins_count ) ) : ?>
					<div>
						<label>
							Total Logins:
						</label>
						<?php echo $model['lead']->displet_logins_count; ?>
					</div>
				<?php endif; ?>
				<?php if ( !empty( $model['lead']->opened_emails ) || $model['lead']->opened_emails === 0 ) : ?>
					<div>
						<label>
							Emails Opened in Last 30 Days:
						</label>
						<?php echo $model['lead']->opened_emails; ?>
					</div>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<table class="form-table">
		<tr>
			<?php if ( !empty( $model['lead']->registered_at ) ) : ?>
				<td>
					<label>
						Registered:
					</label>
					<?php echo $model['lead']->registered_at; ?>
					<?php if ( !empty( $model['lead']->displet_registration_url ) ) : ?>
						from
						<?php if ( $model['lead']->displet_registration_url !== 'User Import' ) : ?>
							<a href="<?php echo $model['lead']->displet_registration_url; ?>" target="_blank">
						<?php endif; ?>
						<?php echo $model['lead']->displet_registration_url; ?>
						<?php if ( $model['lead']->displet_registration_url !== 'User Import' ) : ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				</td>
			<?php endif; ?>
			<?php if ( !empty( $model['lead']->displet_registration_upstream_url ) ) : ?>
				<td>
					<label>
						Registration Referral:
					</label>
					<a href="<?php echo $model['lead']->displet_registration_upstream_url; ?>" target="_blank">
						<?php echo $model['lead']->displet_registration_upstream_url; ?>
					</a>
				</td>
			<?php endif; ?>
		</tr>
	</table>
	<table class="form-table">
		<tr>
			<?php if ( !empty( $model['lead']->properties_markup ) ) : ?>
				<td>
					<h4>
						Property Viewing History
					</h4>
					<?php echo $model['lead']->properties_markup; ?>
				</td>
			<?php endif; ?>
			<?php if ( !empty( $model['lead']->favorites_markup ) ) : ?>
				<td>
					<h4>
						Saved Properties
					</h4>
					<?php echo $model['lead']->favorites_markup; ?>
				</td>
			<?php endif; ?>
		</tr>
		<tr>
			<?php if ( !empty( $model['lead']->searches_markup ) ) : ?>
				<td>
					<h4>
						Property Search History
					</h4>
					<?php echo $model['lead']->searches_markup; ?>
				</td>
			<?php endif; ?>
			<?php if ( !empty( $model['lead']->saved_searches_markup ) ) : ?>
				<td>
					<h4>
						Saved Searches
					</h4>
					<?php echo $model['lead']->saved_searches_markup; ?>
				</td>
			<?php endif; ?>
		</tr>
		<tr>
			<?php if ( !empty( $model['lead']->showings_markup ) ) : ?>
				<td>
					<h4>
						Showing/Info Requests
					</h4>
					<?php echo $model['lead']->showings_markup; ?>
				</td>
			<?php endif; ?>
			<?php if ( !empty( $model['lead']->email_friend_markup ) ) : ?>
				<td>
					<h4>
						Email To Friend History
					</h4>
					<?php echo $model['lead']->email_friend_markup; ?>
				</td>
			<?php endif; ?>
		</tr>
	</table>
</div>