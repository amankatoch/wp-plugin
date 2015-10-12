<?php

/**
 * Functions below permitted for use in displet-dynamic.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: boolean
 */
function displetretsidx_have_quick_search_columns() {
	global $displetretsidx_template;
	if ( empty( $displetretsidx_template['column_index'] ) ) {
		$displetretsidx_template['column_index'] = 1;
	}
	$has_form = displetretsidx_has_quick_search_form( $displetretsidx_template['id'], $displetretsidx_template['column_index'] );
	if ( !$has_form ) {
		$displetretsidx_template['column_index'] = 0;
	}
	return $has_form;
}

/**
 * @return: boolean
 */
function displetretsidx_the_quick_search_column() {
	global $displetretsidx_template;
	displetretsidx_the_quick_search_form( $displetretsidx_template['id'], $displetretsidx_template['column_index'] );
	$displetretsidx_template['column_index']++;
}

/**
 * @return: boolean
 */
function displetretsidx_has_quick_search_title() {
	global $displetretsidx_template;
	if ( !empty( $displetretsidx_template['title'] ) ) {
		return true;
	}
	return false;
}

/**
 * @return: text
 */
function displetretsidx_the_quick_search_title() {
	global $displetretsidx_template;
	echo $displetretsidx_template['title'];
}

/**
 * @return: text
 */
function displetretsidx_the_quick_search_submit_class() {
	echo 'displet-submit-quick-search';
}

?>