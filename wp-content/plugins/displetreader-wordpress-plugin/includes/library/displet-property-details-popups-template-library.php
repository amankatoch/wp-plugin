<?php

/**
 * Functions below permitted for use in displet-property-details-page-popups.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */


/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_property_popup_wrapper_class() {
	echo 'displet-save-property-popup-wrapper displet-none';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_property_popup_behind_class() {
	echo 'displet-shadow';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_property_popup_class() {
	echo 'displet-save-property-popup';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_save_property_type_name() {
	echo 'displet-save-property-type';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_save_property_favorite_value() {
	echo 'favorite';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_save_property_possibility_value() {
	echo 'possibility';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_save_property_notes_value() {
	echo 'notes';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_rate_property_container_class() {
	echo 'displet-rate-property';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_rate_property_class() {
	echo 'displet-rating';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_1_star_rating() {
	echo '1';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_2_star_rating() {
	echo '2';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_3_star_rating() {
	echo '3';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_4_star_rating() {
	echo '4';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_5_star_rating() {
	echo '5';
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_1_star_class() {
	global $displetretsidx_listing;
	$class = 'displet-rating';
	if ( !empty( $displetretsidx_listing->user_rating ) && $displetretsidx_listing->user_rating >= 1 ) {
		$class .= ' displet-on';
	}
	echo $class;
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_2_star_class() {
	global $displetretsidx_listing;
	$class = 'displet-rating';
	if ( !empty( $displetretsidx_listing->user_rating ) && $displetretsidx_listing->user_rating >= 2 ) {
		$class .= ' displet-on';
	}
	echo $class;
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_3_star_class() {
	global $displetretsidx_listing;
	$class = 'displet-rating';
	if ( !empty( $displetretsidx_listing->user_rating ) && $displetretsidx_listing->user_rating >= 3 ) {
		$class .= ' displet-on';
	}
	echo $class;
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_4_star_class() {
	global $displetretsidx_listing;
	$class = 'displet-rating';
	if ( !empty( $displetretsidx_listing->user_rating ) && $displetretsidx_listing->user_rating >= 4 ) {
		$class .= ' displet-on';
	}
	echo $class;
}

/**
 * @return: print: HTML attribute
 */
function displetretsidx_the_rate_property_5_star_class() {
	global $displetretsidx_listing;
	$class = 'displet-rating';
	if ( !empty( $displetretsidx_listing->user_rating ) && $displetretsidx_listing->user_rating >= 5 ) {
		$class .= ' displet-on';
	}
	echo $class;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_property_commments_class() {
	echo 'displet-property-comments';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_property_submit_class() {
	echo 'displet-submit';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_property_popup_close_class() {
	echo 'displet-close';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_popup_wrapper_class() {
	echo 'displet-email-friend-popup-wrapper displet-none';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_popup_class() {
	echo 'displet-email-friend-popup';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_popup_behind_class() {
	echo 'displet-shadow';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_name_class() {
	echo 'displet-friend-name';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_email_class() {
	echo 'displet-friend-email';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_message_class() {
	echo 'displet-user-message';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_submit_class() {
	echo 'displet-submit';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_email_friend_popup_close_class() {
	echo 'displet-close';
}

?>