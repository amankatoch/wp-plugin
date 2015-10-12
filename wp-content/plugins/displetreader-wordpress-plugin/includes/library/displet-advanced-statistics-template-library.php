<?php

/**
 * Functions below permitted for use in displet-advanced-statistics.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: boolean
 */
function displetretsidx_have_advanced_stats() {
	global $displetretsidx_template;
	if ( empty( $displetretsidx_template['stats_by_status_index'] ) ) {
		$displetretsidx_template['stats_by_status_index'] = 0;
	}
	if ( !empty( $displetretsidx_template['stats_by_status'][$displetretsidx_template['stats_by_status_index']] ) ) {
		return true;
	}
	else if ( $displetretsidx_template['stats_by_status_index'] === count( $displetretsidx_template['stats_by_status'] ) ) {
		$displetretsidx_template['stats_by_status_index'] = 0;
	}
	return false;
}

/**
 * @return: none
 */
function displetretsidx_the_advanced_stats() {
	global $displetretsidx_template;
	global $displetretsidx_results;
	$displetretsidx_results = $displetretsidx_template['stats_by_status'][$displetretsidx_template['stats_by_status_index']];
	$displetretsidx_template['stats_by_status_index']++;
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: CSS classname
 */
function displetretsidx_the_advanced_stats_tab_class() {
	global $displetretsidx_template;
	global $displetretsidx_results;
	$class = 'displet-tab';
	if ( $displetretsidx_results === $displetretsidx_template['stats_by_status'][0] ) {
		$class .= ' displet-active';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_tab_for() {
	global $displetretsidx_results;
	echo esc_attr( $displetretsidx_results['status'] );
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_status() {
	global $displetretsidx_results;
	echo $displetretsidx_results['status'];
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_count() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->count );
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: CSS classname
 */
function displetretsidx_the_advanced_stats_content_class() {
	global $displetretsidx_template;
	global $displetretsidx_results;
	$class = 'displet-stats';
	if ( $displetretsidx_results !== $displetretsidx_template['stats_by_status'][0] ) {
		$class .= ' displet-none';
	}
	echo $class;
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_content_for() {
	displetretsidx_the_advanced_stats_tab_for();
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: boolean
 */
function displetretsidx_have_advanced_stats_data() {
	global $displetretsidx_results;
	if ( !empty( $displetretsidx_results['meta'] ) && !empty( $displetretsidx_results['meta']->count ) ) {
		return true;
	}
	return false;
}

/**
 * @deprecated: since 2.0.42
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_average_price() {
	displetretsidx_the_average_price();
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_average_price_per_square_foot() {
	global $displetretsidx_results;
	if ( !empty( $displetretsidx_results['meta']->square_feet_mean ) && !empty( $displetretsidx_results['meta']->list_price_mean ) ) {
		echo number_format( $displetretsidx_results['meta']->list_price_mean / $displetretsidx_results['meta']->square_feet_mean, 2 );
	}
}

/**
 * @deprecated: since 2.0.42
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_average_square_footage() {
	displetretsidx_the_average_square_footage();
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_average_bedrooms() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->num_bedrooms_mean, 1 );
}

/**
 * @package: displetretsidx_the_advanced_stats() or displetretsidx_setup_advanced_stats_data( $stats )
 * @return: print: text
 */
function displetretsidx_the_advanced_stats_average_bathrooms() {
	global $displetretsidx_results;
	echo number_format( $displetretsidx_results['meta']->full_baths_mean, 1 );
}

?>