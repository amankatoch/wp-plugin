<?php

/**
 * Functions below permitted for use in displet-sidescroller-widget-template-library.php template
 *
 * All function names, parameters, and return types/values are to remain unchanged
 */

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_slideshow_class() {
	echo 'displet-slideshow';
}

/**
 * @return: print: for attribute
 */
function displetretsidx_the_slideshow_for() {
	global $displetretsidx_template;
	echo $displetretsidx_template['visible'];
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_previous_listing_class() {
	echo 'displet-navigation-previous';
}

/**
 * @return: print: CSS classname
 */
function displetretsidx_the_next_listing_class() {
	echo 'displet-navigation-next';
}

?>