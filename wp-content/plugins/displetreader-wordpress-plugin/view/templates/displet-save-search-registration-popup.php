<div id="displet-save-search-registration-popup" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<span class="<?php displetretsidx_save_search_registration_popup_wrapper_class(); ?>">
		<div class="displet-shadow"></div>
		<div class="displet-popup-wrapper">
			<table class="displet-inner">
				<tr>
					<td>
						<div class="displet-popup-back <?php displetretsidx_save_search_registration_popup_close_class(); ?>"></div>
						<div class="displet-popup">
							<div class="displet-popup-inner">
								<?php if ( displetretsidx_has_save_search_registration_popup_title() ) : ?>
									<div class="displet-title">
										<?php displetretsidx_the_save_search_registration_popup_title(); ?>
									</div>
								<?php endif; ?>
								<div class="displet-content">

									<?php displetretsidx_get_template_part( 'displet-save-search-registration-form' ); ?>

								</div>
								<div class="displet-x <?php displetretsidx_save_search_registration_popup_close_class(); ?>">
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