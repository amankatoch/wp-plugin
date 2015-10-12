<?php

/**
 * Functions below permitted for use in displet-login-register-popup.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_popup_wrapper_class() {
	echo 'displet-save-search-registration-popup-wrapper displet-none';
}

/**
 * @return: boolean
 */
function displetretsidx_has_save_search_registration_popup_title() {
	global $displetretsidx_option;
	if ( !empty( $displetretsidx_option['save_search_registration_title'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetretsidx_the_save_search_registration_popup_title() {
	global $displetretsidx_option;
	if ( !empty( $displetretsidx_option['save_search_registration_title'] ) ) {
		echo $displetretsidx_option['save_search_registration_title'];
	}
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_registration_popup_close_class() {
	echo 'displet-close';
}

?>