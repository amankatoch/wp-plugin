<?php

/**
 * Functions below permitted for use in displet-login-register-popup.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */



/**
 * @return: print: text
 */
function displetretsidx_the_login_register_title() {
	global $displetretsidx_template;
	echo !empty( $displetretsidx_template['options']['registration_title'] ) ? $displetretsidx_template['options']['registration_title'] : 'Please Register To View Details';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_login_register_notification_element() {
	echo '<div class="displet-message displet-none"></div>';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_login_link_class() {
	echo 'displet-login-expand-contract';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_login_form_class() {
	echo 'displet-login-form';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_login_email_class() {
	echo 'displet-login-email';
}

/**
 * @return: boolean
 */
function displetretsidx_use_password() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['login_without_password'] ) ) {
		return false;
	}
	return true;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_login_password_class() {
	echo 'displet-login-password';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_login_submit_class() {
	echo 'displet-submit';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_login_error_element() {
	echo '<div class="displet-login-error displet-none"></div>';
}

/**
 * @return: print: URL
 */
function displetretsidx_the_lost_password_url() {
	echo home_url( 'wp-login.php?action=lostpassword' );
}

/**
 * @return: boolean
 */
function displetretsidx_use_facebook_login() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['facebook_app_id'] ) && !empty( $displetretsidx_template['options']['facebook_app_secret'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_facebook_login_class() {
	echo 'displet-facebook-login';
}

/**
 * @return: boolean
 */
function displetretsidx_use_google_login() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['google_auth_url'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_google_login_class() {
	echo 'displet-google-login';
}

/**
 * @return: URL
 */
function displetretsidx_the_google_login_url() {
	global $displetretsidx_template;
	echo $displetretsidx_template['google_auth_url'];
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_registration_form_class() {
	echo 'displet-registration-form';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_registration_name_class() {
	echo 'displet-user-name';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_registration_email_class() {
	echo 'displet-user-email';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_registration_phone_class() {
	echo 'displet-user-phone';
}

/**
 * @return: boolean
 */
function displetretsidx_require_registration_phone() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['require_phone'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: boolean
 */
function displetretsidx_use_registration_realtor() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['include_working_with_realtor'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_registration_realtor_class() {
	echo 'displet-user-realtor';
}

/**
 * @return: boolean
 */
function displetretsidx_require_registration_realtor() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['require_working_with_realtor'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_registration_submit_class() {
	echo 'displet-submit';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_registration_error_element() {
	echo '<div class="displet-registration-error displet-none"></div>';
}

/**
 * @return: print: text with some inline HTML permitted
 */
function displetretsidx_the_login_register_message() {
	global $displetretsidx_template;
	echo !empty( $displetretsidx_template['options']['registration_message'] ) ? nl2br( stripslashes( $displetretsidx_template['options']['registration_message'] ) ) : '<span>Why register?</span> When you register, you will have the ability to save your favorite properties, leave comments, and save searches to update you when new listings hit the market. Use our powerful search tool for free.';
}

/**
 * @return: print: text with some inline HTML permitted
 */
function displetretsidx_the_login_register_disclaimer() {
	global $displetretsidx_template;
	echo !empty( $displetretsidx_template['options']['registration_disclaimer'] ) ? nl2br( stripslashes( $displetretsidx_template['options']['registration_disclaimer'] ) ) : 'Don\'t worry, we hate spam as much as you and would never share your information or send you unsolicited email.';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_login_register_close_class() {
	echo 'displet-close displet-none';
}

?>