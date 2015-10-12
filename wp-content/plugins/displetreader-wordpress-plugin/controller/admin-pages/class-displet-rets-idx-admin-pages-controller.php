<?php

class DispletRetsIdxAdminPagesController extends DispletRetsIdxAdminPagesModel {
	public static function add_displet_tools_submenu_page( $args ) {
		extract( wp_parse_args( $args, array(
			'capability' => 'manage_options',
			'menu_title' => '',
			'page_callback' => false,
			'page_slug' => '',
		) ) );
		$tools_menu = add_menu_page(
			'Displet Tools',
			'Displet Tools',
			'displet_view_leads',
			'displettools-uid-slug',
			array( 'DispletRetsIdxAdminPagesController', 'render_displet_tools_page' ),
			trailingslashit( self::$_urls['css'] ) . 'images/displet-icon.png',
			76
		);
		if ( $tools_menu ) {
			remove_submenu_page('displettools-uid-slug', 'displettools-uid-slug');
			$page = add_submenu_page(
				'displettools-uid-slug',
				$menu_title,
				$menu_title,
				$capability,
				$page_slug,
				$page_callback
			);
			return $page;
		}
	}

	public static function build() {
		self::build_model();
		self::maybe_build_page();
	}

	public static function include_javascript_variables(){
		echo DispletRetsIdxTemplatesController::get_template( 'displet-admin-javascript-variables.php', self::$_model );
	}

	private static function maybe_build_page() {
		if ( self::$_model['is_lead_manager_page'] ) {
			DispletRetsIdxLeadManagerPageController::build();
		}
		else if ( self::$_model['is_saved_properties_page'] ) {
			DispletRetsIdxSavedPropertiesPageController::build();
		}
		else if ( self::$_model['is_saved_searches_page'] ) {
			DispletRetsIdxSavedSearchesPageController::build();
		}
		else if ( self::$_model['is_search_forms_page'] ) {
			DispletRetsIdxSearchFormsPageController::build();
		}
	}

	public static function maybe_clean_up_dashboard() {
		if ( self::is_search_user() ) {
			remove_meta_box( 'dashboard_activity', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
		}
	}

	public static function maybe_remove_jetpack_menu() {
		if ( self::is_search_user() ) {
			remove_menu_page( 'jetpack' );
		}
	}

	public static function render_displet_tools_page() {
		// Empty since page is removed
	}
}

?>