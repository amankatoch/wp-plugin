<div id="displet-sidescroller-widget" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_slideshow_class(); ?>" for="<?php displetretsidx_the_slideshow_for(); ?>">
	<?php if ( displetretsidx_have_listings() ) : ?>
		<ul>
			<?php while ( displetretsidx_have_listings() ) : displetretsidx_the_listing(); ?>
				<li>
					<a class="displet-listing" href="<?php displetretsidx_the_permalink(); ?>">
						<?php if ( displetretsidx_has_photo_url() ) : ?>
							<div class="displet-image" style="<?php displetretsidx_the_photo_style(); ?>">
								<img src="<?php displetretsidx_the_photo_url(); ?>"/>
							</div>
						<?php endif; ?>
						<?php if ( displetretsidx_has_price() ) : ?>
							<div class="displet-price displet-group">
								$<?php displetretsidx_the_price(); ?>
							</div>
						<?php endif; ?>
						<div class="displet-info">
							<div class="displet-address">
								<?php if ( displetretsidx_has_address() ) : ?>
									<div>
										<?php displetretsidx_the_address(); ?>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_city() || displetretsidx_has_state() || displetretsidx_has_zip() ) : ?>
									<div>
										<?php if ( displetretsidx_has_city() ) : ?>
											<?php displetretsidx_the_city(); ?>,
										<?php endif; ?>
										<?php if ( displetretsidx_has_state() ) : ?>
											<?php displetretsidx_the_state(); ?>
										<?php endif; ?>
										<?php if ( displetretsidx_has_zip() ) : ?>
											<?php displetretsidx_the_zip(); ?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_subdivision() ) : ?>
									<div class="displet-subdivision displet-font-color-light">
										<?php displetretsidx_the_subdivision(); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="displet-specs">
								<?php if ( displetretsidx_has_bedrooms() || displetretsidx_has_bathrooms() ) : ?>
									<div>
										<?php if ( displetretsidx_has_bedrooms() ) : ?>
											<?php displetretsidx_the_bedrooms(); ?>
											Bed
											<?php if ( displetretsidx_has_bathrooms() ) : ?>
												/
											<?php endif; ?>
										<?php endif; ?>
										<?php if ( displetretsidx_has_bathrooms() ) : ?>
											<?php displetretsidx_the_bathrooms(); ?>
											Bath
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_square_feet() ) : ?>
									<div>
										<?php displetretsidx_the_square_feet(); ?>
										Sq. Ft.
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_property_type() ) : ?>
									<div>
										Property Type:
										<?php displetretsidx_the_property_type(); ?>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_mls_number() ) : ?>
									<div class="displet-font-color-light">
										MLS&reg; #:
										<?php displetretsidx_the_mls_number(); ?>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_has_listing_agent_name() || displetretsidx_has_listing_office_name() ) : ?>
									<div class="displet-font-color-light">
										Courtesy of
										<?php if ( displetretsidx_has_listing_agent_name() ) : ?>
											<span class="displet-font-color-light">
												<?php displetretsidx_the_listing_agent_name(); ?><?php if ( displetretsidx_has_listing_office_name() ) echo ','; ?>
											</span>
										<?php endif; ?>
										<?php if ( displetretsidx_has_listing_office_name() ) : ?>
											<span class="displet-font-color-light">
												<?php displetretsidx_the_listing_office_name(); ?>
											</span>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if ( displetretsidx_use_disclaimer_image() ) : ?>
									<img class="displet-mls-logo" src="<?php displetretsidx_the_disclaimer_image_url(); ?>"/>
								<?php endif; ?>
							</div>
						</div>
						<div class="displet-view-details">
							View Details
						</div>
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
		<div class="displet-navigation">
			<div class="displet-navigation-inner">
				<div class="<?php displetretsidx_the_previous_listing_class(); ?>"></div>
				<div class="<?php displetretsidx_the_next_listing_class(); ?>"></div>
			</div>
		</div>
	<?php else : ?>
		No listings available
	<?php endif; ?>
</div>