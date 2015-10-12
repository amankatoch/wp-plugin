<?php if ( displetretsidx_have_listings() ) : while ( displetretsidx_have_listings() ) : displetretsidx_the_listing(); ?>
<div id="displet-property-details-popups" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<span class="<?php displetretsidx_the_save_property_popup_wrapper_class(); ?>">
		<div class="<?php displetretsidx_the_save_property_popup_behind_class(); ?>"></div>
		<div class="<?php displetretsidx_the_save_property_popup_class(); ?>">
			<table class="displet-inner">
				<tr>
					<td>
						<div class="displet-popup-back"></div>
						<div class="displet-popup">
							<div class="displet-popup-inner">
								<div class="displet-title">
									Save Property
									<?php if ( displetretsidx_has_address() ) : ?>
										-
										<?php displetretsidx_the_address(); ?>
									<?php endif; ?>
								</div>
								<div class="displet-content">
									<div class="displet-form">
										<div class="displet-save-property-type displet-input">
											<input type="radio" name="<?php displetretsidx_the_save_property_type_name(); ?>" value="<?php displetretsidx_the_save_property_favorite_value(); ?>" checked>
											<span>
												Save as favorite
											</span>
											<input type="radio" name="<?php displetretsidx_the_save_property_type_name(); ?>" value="<?php displetretsidx_the_save_property_possibility_value(); ?>">
											<span>
												Save as possibility
											</span>
											<input type="radio" name="<?php displetretsidx_the_save_property_type_name(); ?>" value="<?php displetretsidx_the_save_property_notes_value(); ?>">
											<span>
												Just save notes
											</span>
										</div>
										<div class="<?php displetretsidx_the_rate_property_container_class(); ?> displet-input">
											<div class="displet-label">
												Rate this property
											</div>
											<div class="<?php displetretsidx_the_rate_property_class(); ?> displet-on" rating="<?php displetretsidx_the_rate_property_1_star_rating(); ?>">
												1 Star
											</div>
											<div class="<?php displetretsidx_the_rate_property_class(); ?> displet-on" rating="<?php displetretsidx_the_rate_property_2_star_rating(); ?>">
												2 Stars
											</div>
											<div class="<?php displetretsidx_the_rate_property_class(); ?> displet-on displet-selected" rating="<?php displetretsidx_the_rate_property_3_star_rating(); ?>">
												3 Stars
											</div>
											<div class="<?php displetretsidx_the_rate_property_class(); ?>" rating="<?php displetretsidx_the_rate_property_4_star_rating(); ?>">
												4 Stars
											</div>
											<div class="<?php displetretsidx_the_rate_property_class(); ?>" rating="<?php displetretsidx_the_rate_property_5_star_rating(); ?>">
												5 Stars
											</div>
										</div>
										<div class="displet-input">
											<div class="displet-label">
												Comments:
											</div>
											<textarea class="<?php displetretsidx_the_save_property_commments_class(); ?>"></textarea>
										</div>
										<div class="displet-action">
											<input class="<?php displetretsidx_the_save_property_submit_class(); ?> displet-button" type="submit" value="Save">
											<span class="displet-loading-holder">
												<?php displetretsidx_the_loading_element(); ?>
											</span>
										</div>
									</div>
								</div>
								<div class="<?php displetretsidx_the_save_property_popup_close_class(); ?>">
									Close
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</span>
	<span class="<?php displetretsidx_the_email_friend_popup_wrapper_class(); ?>">
		<div class="<?php displetretsidx_the_email_friend_popup_behind_class(); ?>"></div>
		<div class="<?php displetretsidx_the_email_friend_popup_class(); ?>">
			<table class="displet-inner">
				<tr>
					<td>
						<div class="displet-popup-back"></div>
						<div class="displet-popup">
							<div class="displet-popup-inner">
								<div class="displet-title">
									Email To A Friend
								</div>
								<div class="displet-content">
									<div class="displet-form">
										<div class="displet-input">
											<div class="displet-label">
												Friend's name:
											</div>
											<input class="<?php displetretsidx_the_email_friend_name_class(); ?>" type="text">
										</div>
										<div class="displet-input">
											<div class="displet-label">
												Friend's email address:
											</div>
											<input class="<?php displetretsidx_the_email_friend_email_class(); ?>" type="text">
										</div>
										<div class="displet-input">
											<div class="displet-label">
												Your message:
											</div>
											<textarea class="<?php displetretsidx_the_email_friend_message_class(); ?>"></textarea>
										</div>
										<div class="displet-action">
											<input class="<?php displetretsidx_the_email_friend_submit_class(); ?> displet-button" type="submit" value="Send">
											<span class="displet-loading-holder">
												<?php displetretsidx_the_loading_element(); ?>
											</span>
										</div>
									</div>
								</div>
								<div class="<?php displetretsidx_the_email_friend_popup_close_class(); ?>">
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