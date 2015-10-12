<div id="displet-login-register-popup" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<div class="displet-shadow"></div>
	<div class="displet-user-registration-popup">
		<table>
			<tr>
				<td>
					<div class="displet-popup-back"></div>
					<div class="displet-popup">
						<div class="displet-content">
							<div class="displet-title">
								<?php displetretsidx_the_login_register_title(); ?>
							</div>
							<?php displetretsidx_the_login_register_notification_element(); ?>
							<div class="displet-login">
								<a class="<?php displetretsidx_the_login_link_class(); ?> displet-font-color" href="javascript:;">
									Already Registered?
									<span>
										Login Here
									</span>
								</a>
								<div class="displet-login-form-wrapper">
									<div class="<?php displetretsidx_the_login_form_class(); ?>">
										<div class="displet-form-content">
											<div class="displet-table">
												<div class="displet-tr">
													<div class="displet-td">
														<div class="displet-input">
															<input class="<?php displetretsidx_the_login_email_class(); ?>" type="text" placeholder="EMAIL*">
														</div>
													</div>
													<?php if ( displetretsidx_use_password() ) : ?>
														<div class="displet-td">
															<div class="displet-input">
																<input class="<?php displetretsidx_the_login_password_class(); ?>" type="password" placeholder="PASSWORD*">
															</div>
														</div>
													<?php endif; ?>
												</div>
											</div>
											<a class="<?php displetretsidx_the_login_submit_class(); ?>" href="javascript:;">
												Login
												<div class="displet-loading-holder">
													<?php displetretsidx_the_loading_element(); ?>
												</div>
											</a>
										</div>
										<?php displetretsidx_the_login_error_element(); ?>
										<?php if ( displetretsidx_use_password() ) : ?>
											<div class="displet-forgot-password">
												<a href="<?php displetretsidx_the_lost_password_url(); ?>" class="displet-font-color">
													Forgot Password?
												</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<?php if ( displetretsidx_use_facebook_login() ) : ?>
								<div id="fb-root"></div>
								<a class="<?php displetretsidx_the_facebook_login_class(); ?>" href="javascript:;">
									Sign in with Facebook
								</a>
							<?php endif; ?>
							<?php if ( displetretsidx_use_google_login() ) : ?>
								<a class="<?php displetretsidx_the_google_login_class(); ?>" href="<?php displetretsidx_the_google_login_url(); ?>" target="_blank">
									Sign in with Google
								</a>
							<?php endif; ?>
							<div class="displet-create-account">
								<span>
									Or Create An Account
								</span>
							</div>
							<div class="<?php displetretsidx_the_registration_form_class(); ?>">
								<div class="displet-table">
									<div class="displet-tr">
										<div class="displet-td">
											<div class="displet-input">
												<input class="<?php displetretsidx_the_registration_name_class(); ?>" type="text" placeholder="NAME*">
											</div>
										</div>
										<div class="displet-td">
											<div class="displet-input">
												<input class="<?php displetretsidx_the_registration_email_class(); ?>" type="text" placeholder="EMAIL*">
											</div>
										</div>
										<div class="displet-td">
											<div class="displet-input">
												<input class="<?php displetretsidx_the_registration_phone_class(); ?>" type="text" placeholder="PHONE<?php if ( displetretsidx_require_registration_phone() ) echo '*'; ?>">
											</div>
										</div>
									</div>
								</div>
								<?php if ( displetretsidx_use_registration_realtor() ) : ?>
									<div class="displet-radio">
										Are you working with a Realtor?<?php if ( displetretsidx_require_registration_realtor() ) echo '*'; ?>
										<input class="<?php displetretsidx_the_registration_realtor_class(); ?>" type="radio" value="Yes">
										<span class="displet-label">
											Yes
										</span>
										<input class="<?php displetretsidx_the_registration_realtor_class(); ?>" type="radio" value="No">
										<span class="displet-label">
											No
										</span>
									</div>
								<?php endif; ?>
								<a class="<?php displetretsidx_the_registration_submit_class(); ?>" href="javascript:;">
									Register Now
									<div class="displet-loading-holder">
										<?php displetretsidx_the_loading_element(); ?>
									</div>
								</a>
								<?php displetretsidx_the_registration_error_element(); ?>
							</div>
							<div class="displet-registration-message">
								<?php displetretsidx_the_login_register_message(); ?>
							</div>
							<div class="displet-disclaimer">
								<?php displetretsidx_the_login_register_disclaimer(); ?>
							</div>
						</div>
						<div class="<?php displetretsidx_the_login_register_close_class(); ?>">
							Close
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>