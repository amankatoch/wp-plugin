<?php if ( displetretsidx_have_listings() ) : while ( displetretsidx_have_listings() ) : displetretsidx_the_listing(); ?>
<div id="displet-request-showing-popup" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>" for="<?php if ( displetretsidx_has_id() ) displetretsidx_the_id(); ?>">
	<span class="<?php displetretsidx_the_request_showing_popup_wrapper_class(); ?>">
		<div class="<?php displetretsidx_the_request_showing_popup_behind_class(); ?>"></div>
		<div class="<?php displetretsidx_the_request_showing_popup_class(); ?>">
			<table class="displet-inner">
				<tr>
					<td>
						<div class="displet-popup-back"></div>
						<div class="displet-popup">
							<div class="displet-popup-inner">
								<div class="displet-title">
									Request Showing or Information
								</div>
								<div class="displet-content">
									<?php if ( displetretsidx_has_address() ) : ?>
										<div class="displet-address">
											<b>
												Address
											</b>
											<span>
												<?php displetretsidx_the_address(); ?>
											</span>
										</div>
									<?php endif; ?>
									<?php if ( displetretsidx_has_mls_number() ) : ?>
										<div class="displet-mls">
											<b>
												MLS #
											</b>
											<span>
												<?php displetretsidx_the_mls_number(); ?>
											</span>
										</div>
									<?php endif; ?>
									<div class="displet-form">
										<?php if ( !displetretsidx_has_address() ) : ?>
											<div class="displet-input">
												<input class="<?php displetretsidx_the_request_showing_address_class(); ?>" type="text" placeholder="Property Address">
											</div>
										<?php endif; ?>
										<?php if ( !displetretsidx_has_mls_number() ) : ?>
											<div class="displet-input">
												<input class="<?php displetretsidx_the_request_showing_mls_class(); ?>" type="text" placeholder="Property MLS#">
											</div>
										<?php endif; ?>
										<div class="displet-input">
											<input class="<?php displetretsidx_the_request_showing_name_class(); ?>" type="text" placeholder="Name" value="<?php displetretsidx_the_user_name(); ?>">
											<span class="displet-required">
												*
											</span>
										</div>
										<div class="displet-input">
											<input class="<?php displetretsidx_the_request_showing_email_class(); ?>" type="text" placeholder="Email Address" value="<?php displetretsidx_the_user_email(); ?>">
											<span class="displet-required">
												*
											</span>
										</div>
										<div class="displet-input">
											<input class="<?php displetretsidx_the_request_showing_phone_class(); ?>" type="text" placeholder="Phone #" value="<?php displetretsidx_the_user_phone(); ?>">
											<?php if ( displetretsidx_is_phone_required_for_showing_request() ) : ?>
												<span class="displet-required">
													*
												</span>
											<?php endif; ?>
										</div>
										<div class="displet-appointments displet-input displet-group">
											<span>
												Preferred Date
											</span>
											<input class="<?php displetretsidx_the_request_showing_appointment_class(); ?>" type="text" placeholder="1st choice">
											<input class="<?php displetretsidx_the_request_showing_appointment2_class(); ?>" type="text" placeholder="2nd choice">
										</div>
										<textarea class="<?php displetretsidx_the_request_showing_message_class(); ?>" placeholder="Enter any comments"></textarea>
										<div class="displet-required-description">
											* indicates a required field
										</div>
										<div class="displet-action">
											<input class="<?php displetretsidx_the_request_showing_submit_class(); ?> displet-button" type="submit" value="Send">
											<span class="displet-loading-holder">
												<?php displetretsidx_the_loading_element(); ?>
											</span>
										</div>
									</div>
								</div>
								<div class="<?php displetretsidx_the_request_showing_popup_close_class(); ?>">
									Close
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</span>
</div>
<?php endwhile; endif; ?>