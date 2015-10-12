<?php

class DispletRetsIdxQuickStartModel extends DispletRetsIdxPlugin {
	protected static $_choices;
	protected static $_sections = array(
		'create-pages' => 'Create Pages',
	);
	protected static $_settings;


	protected static function _get_options() {
		self::_set_choices();
		self::_set_options();
		return self::$_settings;
	}

	private static function _set_choices() {
		self::$_choices = array(
			'menus' => array(
				'new' => 'Default/New Menu',
				'none' => 'No Menu',
			),
			'pages' => array(
				'new' => 'Default/New Page',
				'none' => 'No Parent',
			),
		);
		$pages = get_pages();
		if ( !empty( $pages ) ) {
			foreach ( $pages as $page ) {
				self::$_choices['pages'][ $page->ID ] = $page->post_title;
			}
		}
		$menus = wp_get_nav_menus( array(
			'orderby' => 'name',
		) );
		if ( !empty( $menus ) ) {
			foreach ( $menus as $menu ) {
				self::$_choices['menus'][ $menu->term_id ] = $menu->name;
			}
		}
	}

	private static function _set_options() {
		$options = array();

		// Create Pages
		$options[] = array(
			'section' => 'create-pages',
			'id' => 'quick_start_type',
			'title' => 'Type',
			'desc' => 'The parameter that will be used for each value entered into Criteria below.',
			'type' => 'select2',
			'std' => 'zip',
			'choices' => array(
				'city' => 'Cities',
				'zip' => 'Zip Codes',
				'subdivision' => 'Subdivisions',
				'school_district' => 'School Districts',
				'school' => 'School Names',
			),
		);

		$options[] = array(
			'section' => 'create-pages',
			'id' => 'quick_start_criteria',
			'title' => 'Criteria',
			'desc' => '<b>Enter one per line. A new page will be created with listings for each entered</b>.<br>Ex. If Zip Codes is selected above, and 78701 is entered here, a page will be created with listings in zip code 78701.',
			'type' => 'textarea',
		);

		$options[] = array(
			'section' => 'create-pages',
			'id' => 'quick_start_parent_page',
			'title' => 'Parent Page',
			'desc' => 'Assign each page from Criteria to this parent page.',
			'type' => 'select2',
			'std' => 'new',
			'choices' => self::$_choices['pages'],
		);

		$options[] = array(
			'section' => 'create-pages',
			'id' => 'quick_start_parent_menu',
			'title' => 'Add to Menu',
			'desc' => 'Assign each page from Criteria to this menu.',
			'type' => 'select2',
			'std' => 'new',
			'choices' => self::$_choices['menus'],
		);

		self::$_settings = $options;
	}
}

?>