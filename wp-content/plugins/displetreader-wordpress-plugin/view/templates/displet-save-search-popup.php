<div id="displet-save-search-popup" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<span class="<?php displetretsidx_save_search_popup_wrapper_class(); ?>">
		<div class="<?php displetretsidx_save_search_popup_behind_class(); ?>"></div>
		<div class="<?php displetretsidx_save_search_popup_class(); ?>">
			<table class="displet-inner">
				<tr>
					<td>
						<div class="displet-popup-back"></div>
						<div class="displet-popup">
							<div class="displet-popup-inner">
								<div class="displet-title">
									Save Search
								</div>
								<div class="displet-content">
									<div class="<?php displetretsidx_save_search_form_class(); ?>">
										<div class="displet-input">
											<input class="<?php displetretsidx_save_search_name_class(); ?>" type="text" placeholder="Search Name">
											<span class="displet-required displet-font-color">
												*
											</span>
										</div>
										<?php if ( displetretsidx_user_can_assign_searches() ) : ?>
											<div class="displet-input displet-clients">
												<select class="<?php displetretsidx_save_search_client_class(); ?>">
													<option value="none" selected="selected" disabled>
														Client Name
													</option>
												</select>
												<span class="displet-required displet-font-color">
													*
												</span>
											</div>
										<?php endif; ?>
										<?php displetretsidx_save_search_error_element(); ?>
										<div class="displet-action">
											<input class="<?php displetretsidx_save_search_submit_class(); ?> displet-button" type="submit" value="Submit">
											<span class="displet-loading-holder">
												<?php displetretsidx_the_loading_element(); ?>
											</span>
										</div>
									</div>
								</div>
								<div class="<?php displetretsidx_save_search_popup_close_class(); ?>">
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