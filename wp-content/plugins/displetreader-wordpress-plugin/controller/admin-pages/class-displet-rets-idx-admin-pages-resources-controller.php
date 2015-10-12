<?php

class DispletRetsIdxAdminPagesResourcesController extends DispletRetsIdxAdminPagesController {
	public static function enqueue() {
		DispletRetsIdxResourcesController::enqueue_css( 'displet-rets-idx-admin-styles.css' );
		DispletRetsIdxResourcesController::enqueue_js( 'displet-rets-idx-admin-scripts.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-dialog', 'jquery-ui-tabs', 'jquery-ui-sortable', 'jquery-ui-draggable', 'jquery-ui-droppable', 'admin-widgets', 'media-upload', 'thickbox' ) );
		wp_enqueue_style( 'wp-pointer' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'wp-pointer' );
		wp_enqueue_media();
	}
}

?>