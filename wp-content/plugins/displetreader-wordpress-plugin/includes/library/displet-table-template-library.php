<?php

/**
 * Functions below permitted for use in displet-table.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: boolean
 */
function displetretsidx_have_tables() {
	global $displetretsidx_template;
	if ( empty( $displetretsidx_template['listing_by_status_index'] ) ) {
		$displetretsidx_template['listing_by_status_index'] = 0;
	}
	if ( !empty( $displetretsidx_template['listings_by_status'][$displetretsidx_template['listing_by_status_index']] ) ) {
		return true;
	}
	else if ( $displetretsidx_template['listing_by_status_index'] === count( $displetretsidx_template['listings_by_status'] ) ) {
		$displetretsidx_template['listing_by_status_index'] = 0;
	}
	return false;
}

/**
 * @return: none
 */
function displetretsidx_the_table() {
	global $displetretsidx_template;
	global $displetretsidx_results;
	$displetretsidx_results = $displetretsidx_template['listings_by_status'][$displetretsidx_template['listing_by_status_index']];
	$displetretsidx_template['listing_by_status_index']++;
}

/**
 * @package: displetretsidx_the_table( $model )
 * @return: print: text
 */
function displetretsidx_the_table_status() {
	global $displetretsidx_results;
	echo $displetretsidx_results['status'];
}

/**
 * @package: displetretsidx_the_table( $model )
 * @return: print: for attribute
 */
function displetretsidx_the_table_tab_for() {
	global $displetretsidx_results;
	echo urlencode( $displetretsidx_results['status'] );
}

/**
 * @package: displetretsidx_the_table( $model )
 * @return: print: CSS classname
 */
function displetretsidx_the_table_tab_class() {
	global $displetretsidx_template;
	$class = 'displet-tab';
	if ( $displetretsidx_template['listing_by_status_index'] === 1 ) {
		$class .= ' displet-active';
	}
	echo $class;
}

/**
 * @return: boolean
 */
function displetretsidx_has_table_stats() {
	global $displetretsidx_template;
	if (  !empty(  $displetretsidx_template['stats']  ) && $displetretsidx_template['stats'] === 'advanced'  ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_table( $model )
 * @return: print: ID attribute
 */
function displetretsidx_the_table_id() {
	global $displetretsidx_template;
	echo 'displetretsidx_listings' . $displetretsidx_template['shortcode_count'] . '_' . $displetretsidx_template['listing_by_status_index'];
}

/**
 * @package: displetretsidx_the_table( $model )
 * @return: print: CSS classname
 */
function displetretsidx_the_table_class() {
	global $displetretsidx_template;
	$class = 'displet-table-view displetretsidx_listings';
	if ( $displetretsidx_template['listing_by_status_index'] !== 1 ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_table( $model )
 * @return: print: for attribute
 */
function displetretsidx_the_table_for() {
	displetretsidx_the_table_tab_for();
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_table_listing_class() {
	global $displetretsidx_listing;
	echo 'displet-table-listing ' . $displetretsidx_listing->classes->table_view;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_average_price_per_square_foot_class() {
	echo 'displet-average-price-per-square-foot';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_average_bedrooms_class() {
	echo 'displet-average-bedrooms';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_average_bathrooms_class() {
	echo 'displet-average-bathrooms';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_hover_container_class() {
	echo 'displet-hover-container';
}

?>