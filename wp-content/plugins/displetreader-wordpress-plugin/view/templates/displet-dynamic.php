<div id="displet-dynamic" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<?php displetretsidx_the_unavailable_listing_element(); ?>
	<div class="displet-views displet-group">
		<a class="<?php displetretsidx_the_gallery_view_class(); ?> displet-font-color-current displet-font-color-hover displet-border-color-current displet-border-color-hover">
			Gallery
		</a>
		<a class="<?php displetretsidx_the_list_view_class(); ?> displet-font-color-current displet-font-color-hover displet-border-color-current displet-border-color-hover">
			List
		</a>
		<a class="<?php displetretsidx_the_map_view_class(); ?> displet-font-color-current displet-font-color-hover displet-border-color-current displet-border-color-hover">
			Map
		</a>
		<select class="<?php displetretsidx_the_sort_class(); ?> displet-font-color-light">
			<?php displetretsidx_the_sort_options(); ?>
		</select>
	</div>
	<div class="displet-controls displet-group">
		<div class="displet-counts displet-font-color-light">
			<span class="<?php displetretsidx_the_first_count_class(); ?> displet-font-color-light">
				<?php displetretsidx_the_first_count(); ?>
			</span>
			&ndash;
			<span class="<?php displetretsidx_the_last_count_class(); ?> displet-font-color-light">
				<?php displetretsidx_the_last_count(); ?>
			</span>
			of
			<span class="<?php displetretsidx_the_total_count_class(); ?> displet-font-color-light">
				<?php displetretsidx_the_total_count(); ?>
			</span>
		</div>
		<a href="<?php displetretsidx_the_previous_page_url(); ?>" class="<?php displetretsidx_the_previous_page_class(); ?> displet-font-color" rel="prev">
			<span class="displet-previous-icon displet-font-color">
				&laquo;
			</span>
			<span class="displet-font-color">
				Prev
			</span>
		</a>
		<?php displetretsidx_the_numbered_pagination(); ?>
		<a href="<?php displetretsidx_the_next_page_url(); ?>" class="<?php displetretsidx_the_next_page_class(); ?> displet-font-color" rel="next">
			<span class="displet-font-color">
				Next
			</span>
			<span class="displet-next-icon displet-font-color">
				&raquo;
			</span>
		</a>
	</div>
	<?php if ( displetretsidx_use_results_limit_message() ) : ?>
		<div class="<?php displetretsidx_the_results_limit_class(); ?>">
			<?php displetretsidx_the_results_limit_message(); ?>
		</div>
	<?php endif; ?>
	<div class="displet-listings displet-group">
		<?php if ( displetretsidx_have_listings() ) : while ( displetretsidx_have_listings() ) : displetretsidx_the_listing(); ?>
			<a class="<?php displetretsidx_the_gallery_listing_class(); ?>" href="<?php displetretsidx_the_permalink(); ?>">
				<div class="displet-photo-wrapper">
					<div class="<?php displetretsidx_the_photo_container_class(); ?> <?php displetretsidx_the_photo_class(); ?>" style="<?php displetretsidx_the_photo_style(); ?>">
						<?php if ( displetretsidx_has_photo_url() ) : ?>
							<img class="<?php displetretsidx_the_photo_class(); ?>" src="<?php displetretsidx_the_photo_url(); ?>">
						<?php endif; ?>
					</div>
					<div class="<?php displetretsidx_the_under_contract_banner_class(); ?>">
						Under Contract
					</div>
					<div class="<?php displetretsidx_the_contingency_banner_class(); ?>">
						Contingency
					</div>
					<?php if ( displetretsidx_use_price_reduction() ) : ?>
						<div class="<?php displetretsidx_the_price_reduction_banner_class(); ?>">
							<?php displetretsidx_the_price_reduction(); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="<?php displetretsidx_the_price_container_class(); ?> displet-group">
					<span class="displet-dollar displet-font-color">
						$
					</span>
					<span class="<?php displetretsidx_the_price_class(); ?> displet-font-color">
						<?php displetretsidx_the_price(); ?>
					</span>
				</div>
				<div class="displet-info">
					<div class="displet-location">
						<div class="<?php displetretsidx_the_address_container_class(); ?> <?php displetretsidx_the_address_class(); ?> displet-font-color-light">
							<?php displetretsidx_the_address(); ?>
						</div>
						<div>
							<span class="<?php displetretsidx_the_city_container_class(); ?> <?php displetretsidx_the_city_class(); ?> displet-font-color-light">
								<?php displetretsidx_the_city(); ?></span>,
							<span class="<?php displetretsidx_the_state_container_class(); ?> <?php displetretsidx_the_state_class(); ?> displet-font-color-light">
								<?php displetretsidx_the_state(); ?>
							</span>
							<span class="<?php displetretsidx_the_zip_container_class(); ?> <?php displetretsidx_the_zip_class(); ?> displet-font-color-light">
								<?php displetretsidx_the_zip(); ?>
							</span>
						</div>
						<?php if ( displetretsidx_use_subdivision() ) : ?>
							<div class="<?php displetretsidx_the_subdivision_container_class(); ?> <?php displetretsidx_the_subdivision_class(); ?> displet-font-color-light">
								<?php displetretsidx_the_subdivision(); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="displet-details">
						<div>
							<span class="<?php displetretsidx_the_bedrooms_container_class(); ?> displet-font-color-light">
								<span class="<?php displetretsidx_the_bedrooms_class(); ?> displet-font-color-light">
									<?php displetretsidx_the_bedrooms(); ?>
								</span>
								Bed /
							</span>
							<span class="<?php displetretsidx_the_bathrooms_container_class(); ?> displet-font-color-light">
								<span class="<?php displetretsidx_the_bathrooms_class(); ?> displet-font-color-light">
									<?php displetretsidx_the_bathrooms(); ?>
								</span>
								Bath
							</span>
						</div>
						<div class="<?php displetretsidx_the_square_feet_container_class(); ?> displet-font-color-light">
							<span class="<?php displetretsidx_the_square_feet_class(); ?> displet-font-color-light">
								<?php displetretsidx_the_square_feet(); ?>
							</span>
							Sq. Ft.
						</div>
						<div class="<?php displetretsidx_the_property_type_container_class(); ?> displet-font-color-light">
							Property Type:
							<span class="<?php displetretsidx_the_property_type_class(); ?> displet-font-color-light">
								<?php displetretsidx_the_property_type(); ?>
							</span>
						</div>
						<?php if ( displetretsidx_use_mls_number() ) : ?>
							<div class="<?php displetretsidx_the_mls_number_container_class(); ?> displet-font-color-light">
								MLS&reg; #:
								<span class="<?php displetretsidx_the_mls_number_class(); ?> <?php echo displetretsidx_is_mls_number_emphasized() ? 'displet-font-color' : 'displet-font-color-light'; ?>">
									<?php displetretsidx_the_mls_number(); ?>
								</span>
							</div>
						<?php endif; ?>
						<?php if ( displetretsidx_use_listing_agent() || displetretsidx_use_listing_office() ) : ?>
							<div class="<?php displetretsidx_the_listing_courtesy_class(); ?> displet-font-color-light">
								Courtesy of
								<span class="<?php displetretsidx_the_listing_agent_container_class(); ?> <?php displetretsidx_the_listing_agent_class(); ?> <?php echo displetretsidx_is_listing_agent_name_emphasized() ? 'displet-font-color' : 'displet-font-color-light'; ?>">
									<?php displetretsidx_the_listing_agent(); ?>
								</span>
								<span class="<?php displetretsidx_the_listing_office_container_class(); ?> <?php displetretsidx_the_listing_office_class(); ?> <?php echo displetretsidx_is_listing_office_name_emphasized() ? 'displet-font-color' : 'displet-font-color-light'; ?>">
									<?php displetretsidx_the_listing_office(); ?>
								</span>
							</div>
						<?php endif; ?>
						<?php if ( displetretsidx_use_disclaimer_image() ) : ?>
							<img class="displet-mls-logo" src="<?php displetretsidx_the_disclaimer_image_url(); ?>" />
						<?php endif; ?>
					</div>
				</div>
			</a>
			<a class="<?php displetretsidx_the_list_listing_class(); ?> displet-group" href="<?php displetretsidx_the_permalink(); ?>">
				<div class="displet-photo-wrapper">
					<div class="<?php displetretsidx_the_photo_container_class(); ?> <?php displetretsidx_the_photo_class(); ?>" style="<?php displetretsidx_the_photo_style(); ?>">
						<?php if ( displetretsidx_has_photo_url() ) : ?>
							<img class="<?php displetretsidx_the_photo_class(); ?>" src="<?php displetretsidx_the_photo_url(); ?>">
						<?php endif; ?>
					</div>
					<div class="<?php displetretsidx_the_under_contract_banner_class(); ?>">
						Under Contract
					</div>
					<div class="<?php displetretsidx_the_contingency_banner_class(); ?>">
						Contingency
					</div>
				</div>
				<div class="displet-info displet-group">
					<div class="displet-info-inner">
						<div class="displet-header">
							<div class="<?php displetretsidx_the_price_container_class(); ?>">
								<span class="displet-font-color">
									$
								</span>
								<span class="<?php displetretsidx_the_price_class(); ?> displet-font-color">
									<?php displetretsidx_the_price(); ?>
								</span>
							</div>
							<div class="displet-location">
								<span class="<?php displetretsidx_the_address_container_class(); ?> displet-font-color-light">
									<span class="<?php displetretsidx_the_address_class(); ?> displet-font-color-light">
										<?php displetretsidx_the_address(); ?>
									</span>
									|
								</span>
								<span class="<?php displetretsidx_the_city_container_class(); ?> <?php displetretsidx_the_city_class(); ?> displet-font-color-light">
									<?php displetretsidx_the_city(); ?></span>,
								<span class="<?php displetretsidx_the_state_container_class(); ?> <?php displetretsidx_the_state_class(); ?> displet-font-color-light">
									<?php displetretsidx_the_state(); ?>
								</span>
								<span class="<?php displetretsidx_the_zip_container_class(); ?> <?php displetretsidx_the_zip_class(); ?> displet-font-color-light">
									<?php displetretsidx_the_zip(); ?>
								</span>
								<?php if ( displetretsidx_use_subdivision() ) : ?>
									<div class="<?php displetretsidx_the_subdivision_container_class(); ?> <?php displetretsidx_the_subdivision_class(); ?> displet-font-color-light">
										<?php displetretsidx_the_subdivision(); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="displet-details displet-table">
							<div class="displet-tr">
								<?php if ( displetretsidx_use_mls_number() ) : ?>
									<div class="<?php displetretsidx_the_mls_number_container_class(); ?> displet-td displet-font-color-light">
										MLS&reg; #
									</div>
								<?php endif; ?>
								<div class="<?php displetretsidx_the_property_type_container_class(); ?> displet-td displet-font-color-light">
									Property Type
								</div>
								<div class="<?php displetretsidx_the_bedrooms_container_class(); ?> displet-td displet-font-color-light">
									Beds
								</div>
								<div class="<?php displetretsidx_the_bathrooms_container_class(); ?> displet-td displet-font-color-light">
									Baths
								</div>
								<div class="<?php displetretsidx_the_square_feet_container_class(); ?> displet-td displet-font-color-light">
									Square Ft
								</div>
							</div>
							<div class="displet-tr">
								<?php if ( displetretsidx_use_mls_number() ) : ?>
									<div class="<?php displetretsidx_the_mls_number_container_class(); ?> <?php displetretsidx_the_mls_number_class(); ?> displet-td <?php echo displetretsidx_is_mls_number_emphasized() ? 'displet-font-color' : 'displet-font-color-light'; ?>">
										<?php displetretsidx_the_mls_number(); ?>
									</div>
								<?php endif; ?>
								<div class="<?php displetretsidx_the_property_type_container_class(); ?> <?php displetretsidx_the_property_type_class(); ?> displet-td displet-font-color-light">
									<?php displetretsidx_the_property_type(); ?>
								</div>
								<div class="<?php displetretsidx_the_bedrooms_container_class(); ?> <?php displetretsidx_the_bedrooms_class(); ?> displet-td displet-font-color-light">
									<?php displetretsidx_the_bedrooms(); ?>
								</div>
								<div class="<?php displetretsidx_the_bathrooms_container_class(); ?> <?php displetretsidx_the_bathrooms_class(); ?> displet-td displet-font-color-light">
									<?php displetretsidx_the_bathrooms(); ?>
								</div>
								<div class="<?php displetretsidx_the_square_feet_container_class(); ?> displet-td">
									<span class="<?php displetretsidx_the_square_feet_class(); ?> displet-font-color-light">
										<?php displetretsidx_the_square_feet(); ?>
									</span>
									s.f.
								</div>
							</div>
						</div>
						<?php if ( displetretsidx_use_disclaimer_image() ) : ?>
							<img class="displet-mls-logo" src="<?php displetretsidx_the_disclaimer_image_url(); ?>" />
						<?php endif; ?>
						<?php if ( displetretsidx_use_listing_agent() || displetretsidx_use_listing_office() ) : ?>
							<div class="<?php displetretsidx_the_listing_courtesy_class(); ?>  displet-font-color-light">
								Courtesy of
								<span class="<?php displetretsidx_the_listing_agent_container_class(); ?> <?php displetretsidx_the_listing_agent_class(); ?> <?php echo displetretsidx_is_listing_agent_name_emphasized() ? 'displet-font-color' : 'displet-font-color-light'; ?>">
									<?php displetretsidx_the_listing_agent(); ?>
								</span>
								<span class="<?php displetretsidx_the_listing_office_container_class(); ?> <?php displetretsidx_the_listing_office_class(); ?> <?php echo displetretsidx_is_listing_office_name_emphasized() ? 'displet-font-color' : 'displet-font-color-light'; ?>">
									<?php displetretsidx_the_listing_office(); ?>
								</span>
							</div>
						<?php endif; ?>
						<div class="<?php displetretsidx_the_description_container_class(); ?> <?php displetretsidx_the_description_class(); ?> displet-font-color-light">
							<?php displetretsidx_the_description(); ?>
						</div>
					</div>
				</div>
				<div class="<?php displetretsidx_the_description_container_class(); ?> displet-text-overlay"></div>
			</a>
		<?php endwhile; endif; ?>
	</div>
	<div class="<?php displetretsidx_the_no_results_class(); ?>">
		No listings available.
	</div>
	<div class="<?php displetretsidx_the_map_class(); ?>">
		<?php displetretsidx_the_map(); ?>
	</div>
	<div class="displet-controls displet-group">
		<div class="displet-counts displet-font-color-light">
			<span class="<?php displetretsidx_the_first_count_class(); ?> displet-font-color-light">
				<?php displetretsidx_the_first_count(); ?>
			</span>
			&ndash;
			<span class="<?php displetretsidx_the_last_count_class(); ?> displet-font-color-light">
				<?php displetretsidx_the_last_count(); ?>
			</span>
			of
			<span class="<?php displetretsidx_the_total_count_class(); ?> displet-font-color-light">
				<?php displetretsidx_the_total_count(); ?>
			</span>
		</div>
		<a href="<?php displetretsidx_the_previous_page_url(); ?>" class="<?php displetretsidx_the_previous_page_class(); ?> displet-font-color" rel="prev">
			<span class="displet-previous-icon displet-font-color">
				&laquo;
			</span>
			<span class="displet-font-color">
				Prev
			</span>
		</a>
		<?php displetretsidx_the_numbered_pagination(); ?>
		<a href="<?php displetretsidx_the_next_page_url(); ?>" class="<?php displetretsidx_the_next_page_class(); ?> displet-font-color" rel="next">
			<span class="displet-font-color">
				Next
			</span>
			<span class="displet-next-icon displet-font-color">
				&raquo;
			</span>
		</a>
	</div>
	<div class="displet-powered">
		<?php displetretsidx_the_credit(); ?>
	</div>
	<?php if ( !displetretsidx_has_api_key() ) : ?>
		<div class="displet-free-disclaimer">
			This site is currently using the FREE version of the Displet plugin. For HIGH RES images &amp; up-to-date RETS data, please upgrade.
		</div>
	<?php endif; ?>
	<?php if ( displetretsidx_has_disclaimer() ) : ?>
		<div class="displet-disclaimer displet-group">
			<?php displetretsidx_the_disclaimer(); ?>
		</div>
	<?php endif; ?>
	<?php displetretsidx_the_listings_loading_element(); ?>
</div>