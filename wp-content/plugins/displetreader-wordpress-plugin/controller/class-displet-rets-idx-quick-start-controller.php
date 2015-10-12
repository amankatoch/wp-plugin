<?php

class DispletRetsIdxQuickStartController extends DispletRetsIdxQuickStartModel {
	public static function add_page() {
		new DispletRetsIdxOptions( array(
			'div_id' => 'displet-rets-idx-quick-start',
			'menu_title' => 'Quick Start',
			'options_slug' => self::$_slugs['options']['quick_start'],
			'page_slug' => self::$_slugs['quick_start_page'],
			'page_title' => 'Displet RETS/IDX Quick Start',
		), self::$_sections, self::_get_options() );
	}

	public static function build() {
		self::$_quick_start_options = DispletRetsIdxOptionsController::get_option( 'quick_start' );
	}

	private static function create() {
		// Decide slug from Type selected
		if ( self::$_quick_start_options['quick_start_type'] == 'city' ){
			$name = 'Cities';
			$slug = 'cities';
		}
		else if ( self::$_quick_start_options['quick_start_type'] == 'zip' ){
			$name = 'Zip Codes';
			$slug = 'zip-codes';
		}
		else if ( self::$_quick_start_options['quick_start_type'] == 'subdivision' ){
			$name = 'Subdivisions';
			$slug = 'subdivisions';
		}
		else if ( self::$_quick_start_options['quick_start_type'] == 'school_district' ){
			$name = 'School Districts';
			$slug = 'school-districts';
		}
		else if ( self::$_quick_start_options['quick_start_type'] == 'school' ){
			$name = 'Schools';
			$slug = 'schools';
		}

		// Create menu if needed
		if ( self::$_quick_start_options['quick_start_parent_menu'] == 'new' ) {
			$menu_id = self::register_menu( $name );
		}
		// Get ID of selected menu
		else if ( !empty( self::$_quick_start_options['quick_start_parent_menu'] ) && self::$_quick_start_options['quick_start_parent_menu'] != 'none' ) {
			$menu_id = self::$_quick_start_options['quick_start_parent_menu'];
		}
		// Menu not set or set to none
		else{
			$menu_id = false;
		}

		// Create parent page if needed
		if ( self::$_quick_start_options['quick_start_parent_page'] == 'new' ) {
			$parent_id = self::register_parent_page( $name, $slug );
		}
		// Get ID of selected parent page
		else if ( !empty( self::$_quick_start_options['quick_start_parent_page'] ) && self::$_quick_start_options['quick_start_parent_page'] != 'none' ) {
			$parent_id = self::$_quick_start_options['quick_start_parent_page'];
		}
		// Parent page not set or set to none
		else{
			$parent_id = false;
		}

		// Create pages for each
		$criteria_values = array_map( 'trim', explode( "\n", self::$_quick_start_options['quick_start_criteria'] ) );
		if ( !empty( $criteria_values ) ){
			self::register_pages( $criteria_values, self::$_quick_start_options['quick_start_type'], $menu_id, $parent_id );
		}

		// Remove Criteria to prevent looping creation
		self::$_quick_start_options['quick_start_criteria'] = '';
		DispletRetsIdxOptionsController::update_option( 'quick_start', self::$_quick_start_options );
	}

	private static function register_pages( $criteria_values, $criteria_type, $menu_id, $parent_id ){
		foreach ( $criteria_values as $value ) {
			$value = trim( $value );
			if ( !empty( $parent_id ) ){
				$parent_path = str_replace( home_url(), '', get_permalink( $parent_id ) );
				$path = $parent_path . $value;
			}
			else{
				$path = $value;
			}
			$post = get_page_by_path( $path . '-real-estate' );

			// Add page if it doesn't exist
			if ( !$post ) {
				$quick_start_args = array(
					'post_name' => str_replace( ' ', '-', strtolower( $value ) ),
					'post_title' => $value,
					'post_content' => '[' . self::$_slugs['shortcode'] . ' ' . $criteria_type . '="' . $value . '"]',
					'post_type' => 'page',
					'post_status' => 'publish'
				 );
				if ( !empty( $parent_id ) ){
					$quick_start_args['post_parent'] = $parent_id;
				}
				$post_id = wp_insert_post( $quick_start_args );
			}

			// Remove page from the trash if it already exists
			else{
				$quick_start_args = array(
					'post_status' => 'publish',
					'ID' => $post->ID
				 );
				wp_update_post( $quick_start_args );
				$post_id = $post->ID;
			}

			// Add to menu if ID is set
			if ( !empty( $menu_id ) ){
    			wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-object' => 'page',
					'menu-item-object-id' => $post_id,
					'menu-item-title' => $value,
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish'
    			 ) );
			}
		}
	}

	private static function register_parent_page( $name, $slug ){
		$value = trim( $value );
		$post = get_page_by_path( $slug );
		// Add page if it doesn't exist
		if ( !$post ) {
			$quick_start_args = array(
				'post_name' => $slug,
				'post_title' => $name,
				'post_type' => 'page',
				'post_status' => 'publish'
			 );
			$post_id = wp_insert_post( $quick_start_args );
		}
		// Remove page from the trash if it already exists
		else{
			$quick_start_args = array(
				'post_status' => 'publish',
				'ID' => $post->ID
			 );
			wp_update_post( $quick_start_args );
			$post_id = $post->ID;
		}
		return $post_id;
	}

	private static function register_menu( $name ){
		$menu = wp_get_nav_menu_object( $name );
		if ( !$menu ){
			$menu_id = wp_create_nav_menu( $name );
		}
		else{
			$menu_id = $menu->term_id;
		}
		return $menu_id;
	}


	public static function maybe_create() {
		if ( !empty( self::$_quick_start_options['quick_start_criteria'] ) ) {
			self::create();
		}
	}
}

?>