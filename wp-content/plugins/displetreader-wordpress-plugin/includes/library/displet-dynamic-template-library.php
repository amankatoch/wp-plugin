<?php

/**
 * Functions below permitted for use in displet-dynamic.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_gallery_view_class() {
	global $displetretsidx_template;
	$class = 'displet-tile-view';
	if ( $displetretsidx_template['orientation'] == 'gallery' ) {
		$class .= ' displet-current-view';
	}
	echo $class;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_list_view_class() {
	global $displetretsidx_template;
	$class = 'displet-list-view';
	if ( $displetretsidx_template['orientation'] == 'list' ) {
		$class .= ' displet-current-view';
	}
	echo $class;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_map_view_class() {
	global $displetretsidx_template;
	$class = 'displet-map-view';
	if ( $displetretsidx_template['orientation'] == 'map' ) {
		$class .= ' displet-current-view';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_gallery_listing_class() {
	global $displetretsidx_template;
	global $displetretsidx_listing;
	$class = 'displet-tile-listing ' . $displetretsidx_listing->classes->gallery_view;
	if ( $displetretsidx_template['orientation'] != 'gallery' ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_list_listing_class() {
	global $displetretsidx_template;
	global $displetretsidx_listing;
	$class = 'displet-vertical-listing ' . $displetretsidx_listing->classes->list_view;
	if ( $displetretsidx_template['orientation'] != 'list' ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_hover_transition_element() {
	echo '<div class="displet-hovertrans"></div>';
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_hover_transition_overlay_element() {
	echo '<div class="displet-text-overlay"></div><div class="displet-text-overlay-hovertrans"></div>';
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_under_contract_banner_class() {
	global $displetretsidx_listing;
	$class = 'displet-under-contract';
	if ( stripos( $displetretsidx_listing->status, 'pen' ) === false && stripos( $displetretsidx_listing->status, 'und' ) === false ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_contingency_banner_class() {
	global $displetretsidx_listing;
	$class = 'displet-contingency';
	if ( stripos( $displetretsidx_listing->status, 'conting' ) === false ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: CSS classname
 */
function displetretsidx_the_price_reduction_banner_class() {
	global $displetretsidx_listing;
	$class = 'displet-price-reduction';
	if ( empty( $displetretsidx_listing->original_list_price ) || $displetretsidx_listing->original_list_price <= $displetretsidx_listing->list_price || stripos( $displetretsidx_listing->status, 'pen' ) !== false || stripos( $displetretsidx_listing->status, 'und' ) !== false || stripos( $displetretsidx_listing->status, 'conting' ) !== false ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_use_price_reduction() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['options']['use_price_reduction'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_listing() or displetretsidx_setup_listing_data( $listing )
 * @return: print: HTML markup
 */
function displetretsidx_the_price_reduction() {
	global $displetretsidx_listing;
	if ( !empty( $displetretsidx_listing->original_list_price ) && $displetretsidx_listing->original_list_price > $displetretsidx_listing->list_price && stripos( $displetretsidx_listing->status, 'pen' ) === false && stripos( $displetretsidx_listing->status, 'und' ) === false && stripos( $displetretsidx_listing->status, 'conting' ) === false ) {
		echo '<div>Reduced $' . floor( ( $displetretsidx_listing->original_list_price - $displetretsidx_listing->list_price ) / 1000 ) . 'k</div>';
	}
}

/**
 * @return: print: HTML markup
 */
function displetretsidx_the_map() {
	echo '<div id="displetretsidx_canvas" style="width: 100%; height: 500px;"></div>';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_map_class() {
	global $displetretsidx_template;
	$class = 'displet-map';
	if ( $displetretsidx_template['orientation'] !== 'map' ) {
		$class .= ' hiding';
	}
	echo $class;
}

?>