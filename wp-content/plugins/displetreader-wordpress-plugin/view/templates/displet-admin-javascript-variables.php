<script>
	var displetretsidx_delete_users_nonce = '<?php echo wp_create_nonce("displet_delete_users_nonce"); ?>';
	var displetretsidx_is_ie = false;
	var displetretsidx_reassign_users_nonce = '<?php echo wp_create_nonce("displet_reassign_users_nonce"); ?>';
	var displetretsidx_search_field_widget_labels = <?php echo json_encode( DispletRetsIdxSearchFieldsModel::$fields ); ?>;
	var displetretsidx_url = '<?php echo $model["url"]; ?>';
	var displetretsidx_admin = {
		first_city: '<?php echo $model["first_city"]  ?>',
		images: {
			close: '<?php echo plugins_url("displetreader-wordpress-plugin/includes/css/images/close.png"); ?>',
			close_hover: '<?php echo plugins_url("displetreader-wordpress-plugin/includes/css/images/close_hover.png"); ?>',
		},
		nonces: {
			delete_search: '<?php echo wp_create_nonce("displet_delete_searches_nonce"); ?>',
		},
		options: {
			use_polygon_search: <?php echo !empty( $model['options']['use_polygon_search'] ) ? 'true' : 'false'; ?>,
		},
		pages: {
			is_lead_manager_page: <?php echo $model['is_lead_manager_page'] ? 'true' : 'false'; ?>,
			is_add_user_page: <?php echo $model['is_add_user_page'] ? 'true' : 'false'; ?>,
			is_saved_properties_page: <?php echo $model['is_saved_properties_page'] ? 'true' : 'false'; ?>,
			is_saved_searches_page: <?php echo $model['is_saved_searches_page'] ? 'true' : 'false'; ?>,
			is_search_forms_page: <?php echo $model['is_search_forms_page'] ? 'true' : 'false'; ?>,
		},
		search_fields: <?php echo !empty( $model['search_fields'] ) ? json_encode( $model['search_fields'] ) : json_encode( DispletRetsIdxSearchFieldsModel::$fields ); ?>,
	};
</script>
<!--[if IE]>
<script>
	displetretsidx_is_ie = true;
</script>
<![endif]-->