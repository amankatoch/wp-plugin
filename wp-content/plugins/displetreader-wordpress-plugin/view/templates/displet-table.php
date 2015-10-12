<div id="displet-table" class="<?php displetretsidx_the_default_styles_class(); ?>">
	<div class="displet-tabs displet-group">
		<?php if ( displetretsidx_have_tables() ) : while ( displetretsidx_have_tables() ) : displetretsidx_the_table(); ?>
			<a class="<?php displetretsidx_the_table_tab_class(); ?>" href="javascript:;" for="<?php displetretsidx_the_table_tab_for(); ?>">
				<?php displetretsidx_the_table_status(); ?>
				<span class="<?php displetretsidx_the_total_count_class(); ?>">
					<?php displetretsidx_the_count(); ?>
				</span>
			</a>
		<?php endwhile; endif; ?>
	</div>
	<?php if ( displetretsidx_have_tables() ) : while ( displetretsidx_have_tables() ) : displetretsidx_the_table(); ?>
		<div id="<?php displetretsidx_the_table_id(); ?>" class="<?php displetretsidx_the_table_class(); ?>" for="<?php displetretsidx_the_table_for(); ?>">
			<div class="displet-group">
				<?php if ( displetretsidx_has_table_stats() ) : ?>
					<div id="displet-stats">
						<div class="displet-title">
							Statistics
						</div>
						<div class="displet-table">
							<div class="displet-tr">
								<?php if ( displetretsidx_has_count() ) : ?>
									<div class="displet-td">
										<span class="<?php displetretsidx_the_total_count_class(); ?>">
											<?php displetretsidx_the_count(); ?>
										</span>
										Total Listings
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_average_price() ) : ?>
									<div class="displet-td">
										Avg Price = $
										<span class="<?php displetretsidx_the_average_price_class(); ?>">
											<?php displetretsidx_the_average_price(); ?>
										</span>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_price_per_square_foot() ) : ?>
									<div class="displet-td">
										Avg $/SF = $
										<span class="<?php displetretsidx_the_average_price_per_square_foot_class(); ?>">
											<?php displetretsidx_the_price_per_square_foot(); ?>
										</span>
									</div>
								<?php endif; ?>
							</div>
							<div class="displet-tr">
								<?php if ( displetretsidx_has_average_square_footage() ) : ?>
									<div class="displet-td">
										Avg Size =
										<span class="<?php displetretsidx_the_average_square_footage_class(); ?>">
											<?php displetretsidx_the_average_square_footage(); ?>
										</span>
										Sq Ft
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_average_bedrooms() ) : ?>
									<div class="displet-td">
										Avg Beds =
										<span class="<?php displetretsidx_the_average_bedrooms_class(); ?>">
											<?php displetretsidx_the_average_bedrooms(); ?>
										</span>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_average_bathrooms() ) : ?>
									<div class="displet-td">
										Avg Baths =
										<span class="<?php displetretsidx_the_average_bathrooms_class(); ?>">
											<?php displetretsidx_the_average_bathrooms(); ?>
										</span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<select class="<?php displetretsidx_the_sort_class(); ?> displet-font-color-light">
					<?php displetretsidx_the_sort_options(); ?>
				</select>
			</div>
			<?php if ( displetretsidx_have_listings() ) : ?>
				<div id="displet-table-listings" class="displet-table">
					<div class="displet-tr">
						<div class="displet-td">
							Address
						</div>
						<?php if ( displetretsidx_use_subdivision() ) : ?>
							<div class="displet-td">
								Subdivision
							</div>
						<?php endif; ?>
						<div class="displet-td">
							List Price
						</div>
						<div class="displet-td">
							Beds/Baths
						</div>
						<div class="displet-td">
							Sq Ft
						</div>
						<div class="displet-td">
							Year Built
						</div>
						<?php if ( displetretsidx_use_mls_number() ) : ?>
							<div class="displet-td">
								MLS&reg; #
							</div>
						<?php endif; ?>
						<?php if ( displetretsidx_use_listing_agent() ) : ?>
							<div class="displet-td">
								Listing Agent
							</div>
						<?php endif; ?>
						<?php if ( displetretsidx_use_listing_office() ) : ?>
							<div class="displet-td">
								Listing Office
							</div>
						<?php endif; ?>
					</div>
					<div class="displet-tr"></div>
					<?php while ( displetretsidx_have_listings() ) : displetretsidx_the_listing(); ?>
						<a class="displet-tr <?php displetretsidx_the_table_listing_class(); ?>" href="<?php displetretsidx_the_permalink(); ?>">
							<div class="displet-td displet-address displet-address-value">
								<?php displetretsidx_the_address(); ?>
							</div>
							<?php if ( displetretsidx_use_subdivision() ) : ?>
								<div class="displet-td <?php displetretsidx_the_subdivision_class(); ?>">
									<?php displetretsidx_the_subdivision(); ?>
								</div>
							<?php endif; ?>
							<div class="displet-td">
								$<span class="<?php displetretsidx_the_price_class(); ?>"><?php displetretsidx_the_price(); ?>
								</span>
							</div>
							<div class="displet-td">
								<span class="<?php displetretsidx_the_bedrooms_class(); ?>">
									<?php displetretsidx_the_bedrooms(); ?>
								</span>
								<span class="<?php displetretsidx_the_bathrooms_container_class(); ?>">
									/
								</span>
								<span class="<?php displetretsidx_the_bathrooms_class(); ?>">
									<?php displetretsidx_the_bathrooms(); ?>
								</span>
							</div>
							<div class="displet-td <?php displetretsidx_the_square_feet_class(); ?>">
								<?php displetretsidx_the_square_feet(); ?>
							</div>
							<div class="displet-td <?php displetretsidx_the_year_built_class(); ?>">
								<?php displetretsidx_the_year_built(); ?>
							</div>
							<?php if ( displetretsidx_use_mls_number() ) : ?>
								<div class="displet-td <?php displetretsidx_the_mls_number_class(); ?>">
									<?php displetretsidx_the_mls_number(); ?>
								</div>
							<?php endif; ?>
							<?php if ( displetretsidx_use_listing_agent() ) : ?>
								<div class="displet-td <?php displetretsidx_the_listing_agent_class(); ?>">
									<?php echo displetretsidx_get_listing_agent(); ?>
								</div>
							<?php endif; ?>
							<?php if ( displetretsidx_use_listing_office() ) : ?>
								<div class="displet-td <?php displetretsidx_the_listing_office_class(); ?>">
									<?php displetretsidx_the_listing_office(); ?>
								</div>
							<?php endif; ?>
							<div class="displet-td">
								<div class="<?php displetretsidx_the_hover_container_class(); ?>">
									<div class="displet-image-container">
										<div class="<?php displetretsidx_the_photo_container_class(); ?> <?php displetretsidx_the_photo_class(); ?>" style="<?php displetretsidx_the_photo_style(); ?>">
											<img src="<?php displetretsidx_the_photo_url(); ?>">
										</div>
									</div>
									<div class="displet-details">
										View Details
									</div>
								</div>
							</div>
						</a>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
			<div class="<?php displetretsidx_the_no_results_class(); ?>">
				No listings available.
			</div>
			<div class="displet-controls displet-group">
				<span class="displet-counts displet-font-color-light">
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
				</span>
				<a href="<?php displetretsidx_the_previous_page_url(); ?>" class="<?php displetretsidx_the_previous_page_class(); ?> displet-font-color" rel="prev">
					Prev
				</a>
				|
				<a href="<?php displetretsidx_the_next_page_url(); ?>" class="<?php displetretsidx_the_next_page_class(); ?> displet-font-color" rel="next">
					Next
				</a>
			</div>
			<?php displetretsidx_the_listings_loading_element(); ?>
		</div>
	<?php endwhile; endif; ?>
</div>