<?php
	if ( !empty( $model['options']['city_include_filter'] ) && is_array( $model['options']['city_include_filter'] ) && $filtered_citys = array_filter( $model['options']['city_include_filter'] ) ) {
		$city_include_filter = json_encode( array_keys( $filtered_citys ) );
	}
	else {
		$city_include_filter = 'false';
	}
	if ( !empty( $model['options']['property_type_include_filter'] ) && is_array( $model['options']['property_type_include_filter'] ) && $filtered_property_types = array_filter( $model['options']['property_type_include_filter'] ) ) {
		$property_type_include_filter = json_encode( array_keys( $filtered_property_types ) );
	}
	else {
		$property_type_include_filter = 'false';
	}
	if ( !empty( $model['options']['zip_code_include_filter'] ) && $filtered_zips = array_map( 'trim', explode( "\n", $model['options']['zip_code_include_filter'] ) ) ) {
		$zip_code_include_filter = json_encode( $filtered_zips );
	}
	else {
		$zip_code_include_filter = 'false';
	}
?>
<script type="text/javascript">
var displetretsidx = {
	cookies: {},
	images: {
		close: '<?php echo plugins_url("displetreader-wordpress-plugin/includes/css/images/close.png"); ?>',
		close_hover: '<?php echo plugins_url("displetreader-wordpress-plugin/includes/css/images/close_hover.png"); ?>',
	},
	is_displet_api: <?php echo !empty($model['options']['displet_app_key']) ? 'true' : 'false'; ?>,
	is_ie: false,
	listings: [],
	nonces: {
		check_login: '<?php echo wp_create_nonce("displet_check_login_nonce"); ?>',
		check_user: '<?php echo wp_create_nonce("displet_check_user_nonce"); ?>',
		email_friend: '<?php echo wp_create_nonce("displet_email_friend_nonce"); ?>',
		get_clients: '<?php echo wp_create_nonce("displet_get_clients_nonce"); ?>',
		get_cookies: '<?php echo wp_create_nonce("displet_get_cookies_nonce"); ?>',
		get_property_showcase_listings: '<?php echo wp_create_nonce("displet_get_property_showcase_listings_nonce"); ?>',
		login_user: '<?php echo wp_create_nonce("displet_login_user_nonce"); ?>',
		property_showing: '<?php echo wp_create_nonce("displet_property_showing_nonce"); ?>',
		register_user: '<?php echo wp_create_nonce("displet_register_user_nonce"); ?>',
		save_property: '<?php echo wp_create_nonce("displet_save_property_nonce"); ?>',
		save_search: '<?php echo wp_create_nonce("displet_save_search_nonce"); ?>',
		set_cookie: '<?php echo wp_create_nonce("displet_set_cookie_nonce"); ?>',
		update_searches: '<?php echo wp_create_nonce("displet_update_searches_nonce"); ?>',
	},
	options: {
		add_price_to_url: <?php echo !empty($model['options']['add_price_to_url']) ? 'true' : 'false'; ?>,
		address_format: '<?php echo $model["options"]["address_format"]; ?>',
		category: '<?php echo (!empty($model["options"]["oodle_category"])) ? $model["options"]["oodle_category"] : "housing/sale"; ?>',
		city_include_filter: <?php echo $city_include_filter; ?>,
		disclaimer_image: '<?php echo $model["options"]["disclaimer_image"]; ?>',
		emphasize_listing_office_and_agent: <?php echo (!empty($model['options']['emphasize_listing_office_and_agent'])) ? 'true' : 'false'; ?>,
		emphasize_mls_number: <?php echo (!empty($model['options']['emphasize_mls_number'])) ? 'true' : 'false'; ?>,
		exclude_referred_visitors: '<?php echo $model["options"]["exclude_referred_visitors"]; ?>',
		facebook_app_id: '<?php echo $model["options"]["facebook_app_id"]; ?>',
		facebook_channel: '<?php echo plugins_url("displetreader-wordpress-plugin/js/channel.html") ?>',
		include_disclaimer_image: <?php echo (!empty($model['options']['include_disclaimer_image'])) ? 'true' : 'false'; ?>,
		map_variance: <?php echo !empty($model['options']['map_variance']) ? intval($model['options']['map_variance']) : 2; ?>,
		max_price_filter: <?php echo !empty($model['options']['max_price_filter']) && is_numeric($model['options']['max_price_filter']) ? intval($model['options']['max_price_filter']) : 'false'; ?>,
		min_price_filter: <?php echo !empty($model['options']['min_price_filter']) && is_numeric($model['options']['min_price_filter']) ? intval($model['options']['min_price_filter']) : 'false'; ?>,
		orientation: '<?php echo $model["options"]["listings_orientation"]; ?>',
		property_type_include_filter: <?php echo $property_type_include_filter; ?>,
		public_views: <?php echo (!empty($model['options']['allowed_public_views']) && is_numeric($model['options']['allowed_public_views'])) ? intval($model['options']['allowed_public_views']) : 0; ?>,
		public_searches: <?php echo (!empty($model['options']['allowed_public_searches']) && is_numeric($model['options']['allowed_public_searches'])) ? intval($model['options']['allowed_public_searches']) : 0; ?>,
		registration_type: '<?php echo !empty($model["options"]["registration_type"]) ? $model["options"]["registration_type"] : "hard"; ?>',
		require_registration_to_search: <?php echo !empty($model['options']['require_registration_to_search']) ? 'true' : 'false'; ?>,
		require_registration_to_view_properties: <?php echo !empty($model['options']['require_registration_to_view_properties']) ? 'true' : 'false'; ?>,
		results_limit: <?php echo (!empty($model['options']['results_limit'])) ? intval($model['options']['results_limit']) : 'false'; ?>,
		use_polygon_search: <?php echo !empty( $model['options']['use_polygon_search'] ) ? 'true' : 'false'; ?>,
		use_price_reduction: <?php echo !empty( $model['options']['use_price_reduction'] ) ? 'true' : 'false'; ?>,
		zip_code_include_filter: <?php echo $zip_code_include_filter; ?>,
	},
	pages: {
		is_mobile_page: <?php echo $model['is_mobile_page'] ? 'true' : 'false'; ?>,
		is_property_details_page: <?php echo $model['is_property_details_page'] ? 'true' : 'false'; ?>,
		is_search_results_page: <?php echo $model['is_search_results_page'] ? 'true' : 'false'; ?>,
	},
	property: {
		address: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->address . "'" : 'false';  ?>,
		city: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->city . "'" : 'false';  ?>,
		id: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->id . "'" : 'false';  ?>,
		image_url: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->image_urls->primary_big . "'" : 'false';  ?>,
		latitude: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->latitude . "'" : 'false';  ?>,
		listing_agent_email: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->listing_agent_email . "'" : 'false';  ?>,
		longitude: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->longitude . "'" : 'false';  ?>,
		mls_number: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->mls_number . "'" : 'false';  ?>,
		permalink: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->permalink . "'" : 'false';  ?>,
		price: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->list_price . "'" : 'false';  ?>,
		square_feet: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->square_feet . "'" : 'false';  ?>,
		state: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->state . "'" : 'false';  ?>,
		zip: <?php echo $model['is_property_details_page'] ? "'" . $model['listings'][0]->zip . "'" : 'false';  ?>,
	},
	queries: [],
	search: '',
	search_field_labels: <?php echo !empty( $model['search_field_labels'] ) ? json_encode( $model['search_field_labels'] ) : '[]'; ?>,
	urls: {
		ajax: '<?php echo admin_url("admin-ajax.php"); ?>',
		current_page: '<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>',
		home: '<?php echo home_url(); ?>',
		referrer: '<?php if (!empty($_SERVER["HTTP_REFERER"])) echo $_SERVER["HTTP_REFERER"]; ?>',
		mobile_property_details_page: '<?php echo home_url("rets-mobile"); ?>',
		mobile_search_results_page: '<?php echo home_url("rets-mobile"); ?>',
		search_results_page: '<?php echo get_permalink($model["options"]["search_results_page_id"]); ?>',
		property_details_page: '<?php echo get_permalink($model["options"]["property_details_page_id"]); ?>',
	},
	user: {
		email: '<?php $current_user = wp_get_current_user(); if (!empty($current_user->user_email)) echo $current_user->user_email; ?>',
		is_logged_in: <?php echo is_user_logged_in() ? 'true' : 'false'; ?>,
		can_view_leads: <?php echo current_user_can('displet_view_leads') ? 'true' : 'false'; ?>,
	},
	wp: {
		is_mobile_contact_page: <?php $is_page = is_post_type_archive('rets-mobile-contact'); echo !empty($is_page) ? 'true' : 'false'; ?>,
		is_mobile_home_page: <?php $is_page = is_post_type_archive('rets-mobile-home'); echo !empty($is_page) ? 'true' : 'false'; ?>,
		is_mobile_property_details_page: <?php $is_page = is_post_type_archive('rets-mobile'); echo !empty($is_page) ? 'true' : 'false'; ?>,
		is_mobile_search_results_page: <?php $is_page = is_post_type_archive('rets-mobile'); echo !empty($is_page) ? 'true' : 'false'; ?>,
		is_property_details_page: <?php $is_page = is_page($model['options']['property_details_page_id']); echo !empty($is_page) ? 'true' : 'false'; ?>,
		is_search_results_page: <?php $is_page = is_page($model['options']['search_results_page_id']); echo !empty($is_page) ? 'true' : 'false'; ?>,
		page: <?php $page = get_query_var('paged'); echo !empty($page) ? $page : 1; ?>,
	},
};
</script>
<!--[if IE]>
<script type="text/javascript">
	displetretsidx.is_ie = true;
</script>
<![endif]-->