<?php

/**
 * Functions below permitted for use in displet-price-navigation.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */


/**
 * @return: boolean
 */
function displetretsidx_have_property_type_navigation() {
	global $displetretsidx_template;
	if ( empty( $displetretsidx_template['property_type_points_index'] ) ) {
		$displetretsidx_template['property_type_points_index'] = 0;
	}
	if ( !empty( $displetretsidx_template['property_type_points'][ $displetretsidx_template['property_type_points_index'] ] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: none
 */
function displetretsidx_the_property_type_navigation() {
	global $displetretsidx_template;
	global $displetretsidx_property_type_navigation;
	$displetretsidx_property_type_navigation = $displetretsidx_template['property_type_points'][ $displetretsidx_template['property_type_points_index'] ];
	$displetretsidx_template['property_type_points_index']++;
}

/**
 * @package: displetretsidx_the_property_type_navigation()
 * @return: print: integer
 */
function displetretsidx_the_property_type_point() {
	global $displetretsidx_property_type_navigation;
	echo $displetretsidx_property_type_navigation;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_property_type_point_class() {
	echo 'displet-property-type-navigation';
}

?>