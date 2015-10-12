<?php

/**
 * Functions below permitted for use in external applications ( custom templates, custom theme functionality, etc. )
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_default_mobile_styles_class() {
	echo 'displet-default-mobile-styles';
}

/**
 * @return: boolean
 */
function displetretsidx_has_mobile_title() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['mobile_header_title'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetretsidx_the_mobile_title() {
	global $displetretsidx_template;
	echo nl2br( $displetretsidx_template['options']['mobile_header_title'] );
}

/**
 * @return: boolean
 */
function displetretsidx_has_mobile_header() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['mobile_header_text'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetretsidx_the_mobile_header() {
	global $displetretsidx_template;
	echo nl2br( $displetretsidx_template['options']['mobile_header_text'] );
}

/**
 * @return: print: url
 */
function displetretsidx_the_mobile_home_url() {
	global $displetretsidx_template;
	echo $displetretsidx_template['mobile_home_page_url'];
}

/**
 * @return: print: url
 */
function displetretsidx_the_mobile_favorites_url() {
	global $displetretsidx_template;
	echo $displetretsidx_template['favorites_page_url'];
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_mobile_favorites_class() {
	echo 'displet-favorites';
}

/**
 * @return: print: url
 */
function displetretsidx_the_mobile_search_url() {
	global $displetretsidx_template;
	echo $displetretsidx_template['search_results_page_url'];
}

/**
 * @return: print: url
 */
function displetretsidx_the_mobile_contact_url() {
	global $displetretsidx_template;
	echo $displetretsidx_template['mobile_contact_page_url'];
}

/**
 * @return: boolean
 */
function displetretsidx_use_nearby_listings() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['use_nearby_listings'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_nearby_listings_class() {
	echo 'displet-nearby-listings-submit';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_nearby_listings_loading_element() {
	echo '<div class="displet-nearby-listings-loading displet-loading"></div>';
}

/**
 * @return: boolean
 */
function displetretsidx_has_mobile_menu() {
	$menu = displetretsidx_get_mobile_menu();
	if ( !empty( $menu ) ) {
		return true;
	}
	return false;
}

/**
 * @return: wp_nav_menu
 */
function displetretsidx_get_mobile_menu() {
	return wp_nav_menu( array(
		'theme_location' => 'displetretsidx_mobile_menu',
		'echo' => false,
		'fallback_cb' => false
	 ) );
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_mobile_menu() {
	echo displetretsidx_get_mobile_menu();
}

/**
 * @param: $column: int
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_mobile_quick_search_form() {
	echo DispletRetsIdxSearchFieldsController::get_mobile_quick_search_form_html();
}

/**
 * @deprecated: since 2.0.35, use displetretsidx_the_mobile_quick_search_form
 * @return: print: dynamic_sidebar
 */
function displetretsidx_get_mobile_quick_search_form() {
	displetretsidx_the_mobile_quick_search_form();
}

/**
 * @param: $column: int
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_mobile_search_form() {
	echo DispletRetsIdxSearchFieldsController::get_mobile_search_form_html();
}

/**
 * @deprecated: since 2.0.35, use displetretsidx_the_mobile_search_form
 * @return: print: dynamic_sidebar
 */
function displetretsidx_get_mobile_search_form() {
	displetretsidx_the_mobile_search_form();
}

/**
 * @return: boolean
 */
function displetretsidx_has_email() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['mobile_email'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_mobile_contact_page_top() {
	DispletRetsIdxUtilities::get_widget_area( 'displetretsidx-mobile-contact-top', 'Displet Mobile Contact Page Top', false );
}

/**
 * @deprecated: since 2.0.35
 * @return: print: dynamic_sidebar
 */
function displetretsidx_get_mobile_contact_page_top() {
	displetretsidx_the_mobile_contact_page_top();
}

/**
 * @return: print: text
 */
function displetretsidx_the_email() {
	global $displetretsidx_template;
	echo $displetretsidx_template['options']['mobile_email'];
}

/**
 * @return: print: url
 */
function displetretsidx_the_email_url() {
	global $displetretsidx_template;
	echo DispletRetsIdxUtilities::get_email_url( $displetretsidx_template['options']['mobile_email'] );
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_more_photos_class() {
	echo 'displet-more-photos';
}

/**
 * @return: print: dynamic_sidebar
 */
function displetretsidx_the_mobile_contact_page_bottom() {
	DispletRetsIdxUtilities::get_widget_area( 'displetretsidx-mobile-contact-bottom', 'Displet Mobile Contact Page Bottom', false );
}

/**
 * @deprecated: since 2.0.35
 * @return: print: dynamic_sidebar
 */
function displetretsidx_get_mobile_contact_page_bottom() {
	displetretsidx_the_mobile_contact_page_bottom();
}

/**
 * @return: boolean
 */
function displetretsidx_has_mobile_footer() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['mobile_footer'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: print: text
 */
function displetretsidx_the_mobile_footer() {
	global $displetretsidx_template;
	echo nl2br( $displetretsidx_template['options']['mobile_footer'] );
}

?>