<?php

/**
 * Functions below permitted for use in displet-login-register-popup.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_popup_wrapper_class() {
	echo 'displet-save-search-popup-wrapper displet-none';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_popup_behind_class() {
	echo 'displet-shadow';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_popup_class() {
	echo 'displet-save-search-popup';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_form_class() {
	echo 'displet-form';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_name_class() {
	echo 'displet-search-name';
}

/**
 * @return: boolean
 */
function displetretsidx_user_can_assign_searches() {
	if ( is_user_logged_in() && current_user_can( 'displet_view_leads' ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_client_class() {
	echo 'displet-client-name';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_save_search_error_element() {
	echo '<div class="displet-save-search-error"></div>';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_submit_class() {
	echo 'displet-submit';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_save_search_popup_close_class() {
	echo 'displet-close';
}

?>