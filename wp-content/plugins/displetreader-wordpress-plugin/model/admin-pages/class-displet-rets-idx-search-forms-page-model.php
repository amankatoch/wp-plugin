<?php

class DispletRetsIdxSearchFormsPageModel extends DispletRetsIdxAdminPagesModel {
	protected static $_default_search_forms = array(
		0 => array(
			0 => array(
				'property_type',
				'price',
				'beds_baths',
			),
			1 => array(
				'quick_terms',
				'keywords',
				'foreclosure',
			),
		),
		1 => array(
			0 => array(
				'square_feet',
				'school_district',
			),
			1 => array(
				'foreclosure',
				'pool',
				'waterfront',
			),
		),
		2 => array(
			0 => array(
				'property_type_select',
				'price',
				'beds_baths',
			),
		),
		3 => array(
			0 => array(
				'property_type_select',
				'price',
				'beds_baths',
				'square_feet',
				'city_select',
				'keywords',
			),
		),
		4 => array(
			0 => array(
				'property_type_select',
				'price',
				'beds_baths',
				'quick_terms',
				'keywords',
			),
		),
	);

	protected static function build_model() {
		self::_set_defaults();
		self::_set_field_options();
		self::_set_empty_forms();
	}

	private static function _get_city_options() {
		if ( !empty( self::$_options['displet_app_key'] ) && !empty( self::$_field_options['city'] ) ) {
			$options = array();
			if ( !empty( self::$_options['city_include_filter'] ) ) {
				$city_filter = array_filter( self::$_options['city_include_filter'] );
			}
			foreach ( self::$_field_options['city'] as $city ) {
				if ( empty( $city_filter ) || !empty( self::$_options['city_include_filter'][ $city ] ) ) {
					$options[] = $city;
				}
			}
			return $options;
		}
		return false;
	}

	private static function _get_property_type_options() {
		$options = array();
		if ( !empty( self::$_options['displet_app_key'] ) && !empty( self::$_field_options['property_type'] ) ) {
			if ( !empty( self::$_options['property_type_include_filter'] ) ) {
				$property_type_filter = array_filter( self::$_options['property_type_include_filter'] );
			}
			foreach ( self::$_field_options['property_type'] as $property_type ) {
				if ( empty( $property_type_filter ) || !empty( self::$_options['property_type_include_filter'][ $property_type ] ) ) {
					$options[] = $property_type;
				}
			}
		}
		else {
			$options = array(
				'Condo',
				'House',
				'Land',
				'Lease',
				'Multi',
				'Ranch',
			);
		}
		return $options;
	}

	protected static function _set_defaults() {
		self::$_model = array_merge( self::$_model, array(
			'has_mobile_search_form' => !empty( self::$_options['mobile_version'] ) ? true : false,
			'options_slug' => self::$_slugs['options']['search_forms'],
			'page_slug' => self::$_slugs['search_forms_page'],
			'search_fields' => DispletRetsIdxSearchFieldsModel::$fields,
			'search_forms' => !empty( self::$_search_form_options ) ? self::$_search_form_options : array(),
		) );
	}

	protected static function _set_field_options() {
		$options = array(
			'area_mls_defined' => array(
				'options' => !empty( self::$_options['displet_app_key'] ) ? self::$_field_options['area_mls_defined'] : false,
				'slugs' => array(
					'area_mls_defined',
					'area_mls_defined_select',
				),
			),
			'city' => array(
				'options' => self::_get_city_options(),
				'slugs' => array(
					'city',
					'city_select',
				),
			),
			'property_type' => array(
				'options' => self::_get_property_type_options(),
				'slugs' => array(
					'property_type',
					'property_type_select',
				),
			),
			'school_district' => array(
				'options' => !empty( self::$_options['displet_app_key'] ) ? self::$_field_options['school_district'] : false,
				'slugs' => array(
					'school_district',
					'school_district_select',
				),
			),
			'state' => array(
				'options' => !empty( self::$_options['displet_app_key'] ) ? self::$_field_options['state'] : false,
				'slugs' => array(
					'state',
					'state_multiple_select',
				),
			),
			'status' => array(
				'options' => !empty( self::$_options['displet_app_key'] ) ? self::$_field_options['status'] : false,
				'slugs' => array(
					'status',
					'status_select',
				),
			),
		);
		foreach ( $options as $slug => $field ) {
			if ( !empty( self::$_field_options[ $slug ] ) ) {
				if ( !empty( $field['options'] ) && is_array( $field['options'] ) ) {
					$field['options'] = array_values( $field['options'] );
				}
				if ( !empty( $field['slugs'] ) ) {
					foreach ( $field['slugs'] as $field_slug ) {
						if ( !empty( self::$_model['search_fields'][ $field_slug ] ) ) {
							self::$_model['search_fields'][ $field_slug ]['options'] = $field['options'];
						}
					}
				}
			}
		}
	}

	private static function _set_empty_forms() {
		$default_form_keys = array(
			0,
			1,
			2,
			3,
			4,
		);
		foreach ( $default_form_keys as $key ) {
			if ( empty( self::$_model['search_forms'][ $key ] ) ) {
				 self::$_model['search_forms'][ $key ] = array( array() );
			}
		}
		ksort(self::$_model['search_forms']);
	}
}

?>