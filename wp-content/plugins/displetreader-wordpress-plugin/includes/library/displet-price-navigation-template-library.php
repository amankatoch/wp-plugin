<?php

/**
 * Functions below permitted for use in displet-price-navigation.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */


/**
 * @return: print: CSS class
 */
function displetretsidx_the_price_navigation_point_class() {
	echo 'displet-price-navigation';
}

/**
 * @return: boolean
 */
function displetretsidx_have_price_navigation() {
	global $displetretsidx_template;
	if ( empty( $displetretsidx_template['price_points_index'] ) ) {
		$displetretsidx_template['price_points_index'] = 0;
	}
	if ( !empty( $displetretsidx_template['price_points'][ $displetretsidx_template['price_points_index'] ] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: none
 */
function displetretsidx_the_price_navigation() {
	global $displetretsidx_template;
	global $displetretsidx_price_navigation;
	$displetretsidx_price_navigation = $displetretsidx_template['price_points'][ $displetretsidx_template['price_points_index'] ];
	$displetretsidx_template['price_points_index']++;
}

/**
 * @package: displetretsidx_the_price_navigation()
 * @return: boolean
 */
function displetretsidx_is_first_price_point() {
	global $displetretsidx_template;
	if ( $displetretsidx_template['price_points_index'] === 1 ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_price_navigation()
 * @return: boolean
 */
function displetretsidx_is_last_price_point() {
	global $displetretsidx_template;
	if ( $displetretsidx_template['price_points_index'] === count( $displetretsidx_template['price_points'] ) ) {
		return true;
	}
	return false;
}

/**
 * @package: displetretsidx_the_price_navigation()
 * @return: print: integer
 */
function displetretsidx_the_min_price_point() {
	global $displetretsidx_price_navigation;
	echo $displetretsidx_price_navigation['min'];
}

/**
 * @package: displetretsidx_the_price_navigation()
 * @return: print: string
 */
function displetretsidx_the_pretty_min_price_point() {
	global $displetretsidx_price_navigation;
	if ( !empty( $displetretsidx_price_navigation['min'] ) ) {
		echo number_format( $displetretsidx_price_navigation['min'] );
	}
}

/**
 * @package: displetretsidx_the_price_navigation()
 * @return: print: integer
 */
function displetretsidx_the_max_price_point() {
	global $displetretsidx_price_navigation;
	echo $displetretsidx_price_navigation['max'];
}

/**
 * @package: displetretsidx_the_price_navigation()
 * @return: print: string
 */
function displetretsidx_the_pretty_max_price_point() {
	global $displetretsidx_price_navigation;
	if ( !empty( $displetretsidx_price_navigation['max'] ) ) {
		echo number_format( $displetretsidx_price_navigation['max'] );
	}
}

?>