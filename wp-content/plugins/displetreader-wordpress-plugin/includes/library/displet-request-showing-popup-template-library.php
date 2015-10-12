<?php

/**
 * Functions below permitted for use in displet-property-details-page-popups.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */


/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_popup_wrapper_class() {
	echo 'displet-request-showing-popup-wrapper displet-none';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_popup_behind_class() {
	echo 'displet-shadow';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_popup_class() {
	echo 'displet-request-showing-popup';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_address_class() {
	echo 'displet-address-value';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_mls_class() {
	echo 'displet-mls-value';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_name_class() {
	echo 'displet-user-name';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_email_class() {
	echo 'displet-user-email';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_phone_class() {
	echo 'displet-user-phone';
}

/**
 * @return: print: text
 */
function displetretsidx_is_phone_required_for_showing_request() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['showing_request_require_phone'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_appointment_class() {
	echo 'displet-user-appointment1';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_appointment2_class() {
	echo 'displet-user-appointment2';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_message_class() {
	echo 'displet-user-message';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_submit_class() {
	echo 'displet-submit';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_request_showing_popup_close_class() {
	echo 'displet-close';
}

?>