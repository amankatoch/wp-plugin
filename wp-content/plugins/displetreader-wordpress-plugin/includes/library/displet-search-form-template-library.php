<?php

/**
 * Functions below permitted for use in displet-dynamic.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: boolean
 */
function displetretsidx_have_search_form_columns() {
	global $displetretsidx_template;
	if ( empty( $displetretsidx_template['column_index'] ) ) {
		$displetretsidx_template['column_index'] = 1;
	}
	$has_form = displetretsidx_has_search_form( $displetretsidx_template['column_index'] );
	if ( !$has_form ) {
		$displetretsidx_template['column_index'] = 0;
	}
	return $has_form;
}

/**
 * @return: boolean
 */
function displetretsidx_the_search_form_column() {
	global $displetretsidx_template;
	displetretsidx_the_search_form( $displetretsidx_template['column_index'] );
	$displetretsidx_template['column_index']++;
}

/**
 * @return: boolean
 */
function displetretsidx_have_advanced_search_form_columns() {
	global $displetretsidx_template;
	if ( empty( $displetretsidx_template['column_index'] ) ) {
		$displetretsidx_template['column_index'] = 1;
	}
	$has_form = displetretsidx_has_advanced_search_form( $displetretsidx_template['column_index'] );
	if ( !$has_form ) {
		$displetretsidx_template['column_index'] = 0;
	}
	return $has_form;
}

/**
 * @return: boolean
 */
function displetretsidx_the_advanced_search_form_column() {
	global $displetretsidx_template;
	displetretsidx_the_advanced_search_form( $displetretsidx_template['column_index'] );
	$displetretsidx_template['column_index']++;
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_advanced_search_form_class() {
	echo 'displet-advanced-form';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_advanced_search_form_toggle_class() {
	echo 'displet-toggle-advanced-search-form';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_save_search_class() {
	echo 'displet-save-search';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_submit_search_class() {
	echo 'displet-submit-search';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_search_form_toggle_class() {
	echo 'displet-revise-form';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_search_tags_container_class() {
	echo 'displet-search-tags';
}

?>