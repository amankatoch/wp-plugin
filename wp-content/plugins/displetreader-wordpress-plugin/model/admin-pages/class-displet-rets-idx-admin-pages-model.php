<?php

class DispletRetsIdxAdminPagesModel extends DispletRetsIdxPlugin {
	protected static $_model;

	protected static function build_model() {
		self::set_defaults();
		self::determine_page();
		self::set_first_city();
		self::set_url();
	}

	private static function determine_page() {
		$screen = get_current_screen();
		if ( !empty( $screen->id ) ) {
			if ( $screen->id === 'displet-tools_page_' . self::$_slugs['lead_manager_page'] ) {
				self::$_model['is_lead_manager_page'] = true;
			}
			else if ( $screen->id === 'toplevel_page_' . self::$_slugs['saved_properties_page'] ) {
				self::$_model['is_saved_properties_page'] = true;
			}
			else if ( $screen->id === 'toplevel_page_' . self::$_slugs['saved_searches_page'] ) {
				self::$_model['is_saved_searches_page'] = true;
			}
			else if ( $screen->id === 'displet-tools_page_' . self::$_slugs['search_forms_page'] ) {
				self::$_model['is_search_forms_page'] = true;
			}
			else if ( $screen->id === 'user' ) {
				self::$_model['is_add_user_page'] = true;
			}
		}
	}

	protected static function is_search_user() {
		if ( current_user_can( self::$_capabilities['save_property'] ) && !current_user_can( self::$_capabilities['view_leads'] ) ) {
			return true;
		}
		return false;
	}

	private static function set_defaults() {
		self::$_model = array(
			'is_add_user_page' => false,
			'is_lead_manager_page' => false,
			'is_saved_properties_page' => false,
			'is_saved_searches_page' => false,
			'is_search_forms_page' => false,
			'mobile_homepage_url' => home_url( 'rets-mobile-home' ),
			'mobile_search_results_page_url' => home_url( 'rets-mobile' ),
			'property_details_page_url' => get_permalink( self::$_options['property_details_page_id'] ),
			'search_results_page_url' => get_permalink( self::$_options['search_results_page_id'] ),
		);
	}

	private static function set_first_city() {
		self::$_model['first_city'] = !empty( self::$_field_options['city'][0] ) ? self::$_field_options['city'][0] : '';
	}

	private static function set_url() {
		self::$_model['url'] = self::$_url;
	}
}

?>