<?php

class DispletRetsIdxSearchFormsPageController extends DispletRetsIdxSearchFormsPageModel {
	public static function add_field( $args ) {
		// Intentionally empty
	}

	private static function _add_fields() {
		add_settings_field( 'search_forms', 'Search Forms', array( 'DispletRetsIdxSearchFormsPageController', 'add_field' ), self::$_slugs['search_forms_page'], 'search_forms_section', false );
	}

	public static function add_page() {
		DispletRetsIdxAdminPagesController::add_displet_tools_submenu_page( array(
			'menu_title' => 'Search Forms',
			'page_callback' => array( 'DispletRetsIdxSearchFormsPageController', 'render_page' ),
			'page_slug' => self::$_slugs['search_forms_page'],
		) );
	}

	public static function add_section( $args ) {
		// Intentionally empty
	}

	private static function _add_sections() {
		add_settings_section( 'search_forms_section', 'Search Forms', array( 'DispletRetsIdxSearchFormsPageController', 'add_section' ), self::$_slugs['search_forms_page'] );
	}

	public static function build() {
		self::build_model();
	}

	public static function create() {
		self::_register_settings();
		self::_add_sections();
		self::_add_fields();
	}

	public static function register_default_search_forms() {
		$search_forms = DispletRetsIdxOptionsController::get_option( 'search_forms' );
		if ( empty( $search_forms ) ) {
			self::$_model = array();
			self::$_options = DispletRetsIdxOptionsController::get_option();
			self::$_field_options = DispletRetsIdxOptionsController::get_option( 'fields' );
			self::set_search_forms( self::$_default_search_forms );
		}
	}

	private static function _register_settings() {
		register_setting( self::$_slugs['options']['search_forms'], self::$_slugs['options']['search_forms'], array( 'DispletRetsIdxSearchFormsPageController', 'validate' ) );
	}

	public static function render_page() {
		echo DispletRetsIdxTemplatesController::get_admin_template( 'displet-search-forms-page.php', self::$_model );
	}

	public static function set_search_forms( $search_forms, $from_update = false ) {
		if ( !empty( $search_forms ) ) {
			if ( $from_update && empty( self::$_model ) ) {
				self::$_model = array();
			}
			self::_set_defaults();
			self::_set_field_options();
			foreach ( $search_forms as &$form ) {
				if ( !empty( $form ) ) {
					foreach ( $form as &$column ) {
						if ( !empty( $column ) ) {
							foreach ( $column as &$field ) {
								if ( !empty( self::$_model['search_fields'][ $field ] ) ) {
									$new_field = array(
										'label' => !empty( self::$_model['search_fields'][ $field ]['label'] ) ? self::$_model['search_fields'][ $field ]['label'] : self::$_model['search_fields'][ $field ]['title'],
										'field' => $field,
										'options' => self::$_model['search_fields'][ $field ]['options'],
										'min' => self::$_model['search_fields'][ $field ]['range']['min'],
										'max' => self::$_model['search_fields'][ $field ]['range']['max'],
										'increment' => self::$_model['search_fields'][ $field ]['range']['increment'],
									);
									if ( $from_update ) {
										if ( $field === 'price' || $field === 'price_max' || $field === 'price_min' ) {
											if ( !empty( self::$_options['search_values_custom_prices'] ) ) {
												$new_field['range'] = array_map( array( 'DispletRetsIdxUtilities', 'increase_by_three_orders_of_magnitude' ), array_map( 'trim', explode( "\n", self::$_options['search_values_custom_prices'] ) ) );
											}
											if ( !empty( self::$_options['search_values_min_price'] ) ) {
												$new_field['min'] = intval( self::$_options['search_values_min_price'] ) * 1000;
											}
											if ( !empty( self::$_options['search_values_max_price'] ) ) {
												$new_field['max'] = intval( self::$_options['search_values_max_price'] ) * 1000;
											}
											if ( !empty( self::$_options['search_values_price_increment'] ) ) {
												$new_field['increment'] = intval( self::$_options['search_values_price_increment'] ) * 1000;
											}
										}
										else if ( $field === 'beds' || $field === 'beds_max' || $field === 'beds_baths' ) {
											if ( !empty( self::$_options['search_values_beds_min'] ) ) {
												$new_field['min'] = intval( self::$_options['search_values_beds_min'] );
											}
											if ( !empty( self::$_options['search_values_beds_max'] ) ) {
												$new_field['max'] = intval( self::$_options['search_values_beds_max'] );
											}
										}
										else if ( $field === 'baths' || $field === 'baths_max' ) {
											if ( !empty( self::$_options['search_values_baths_min'] ) ) {
												$new_field['min'] = intval( self::$_options['search_values_baths_min'] );
											}
											if ( !empty( self::$_options['search_values_baths_max'] ) ) {
												$new_field['max'] = intval( self::$_options['search_values_baths_max'] );
											}
										}
										else if ( $field === 'square_feet' || $field === 'square_feet_max' || $field === 'square_feet_min' ) {
											if ( !empty( self::$_options['search_values_min_square_feet'] ) ) {
												$new_field['min'] = intval( self::$_options['search_values_min_square_feet'] );
											}
											if ( !empty( self::$_options['search_values_max_square_feet'] ) ) {
												$new_field['max'] = intval( self::$_options['search_values_max_square_feet'] );
											}
											if ( !empty( self::$_options['search_values_square_feet_increment'] ) ) {
												$new_field['increment'] = intval( self::$_options['search_values_square_feet_increment'] );
											}
										}
										else if ( $field === 'acres_min' ) {
											if ( !empty( self::$_options['search_values_min_acres'] ) ) {
												$new_field['min'] = floatval( self::$_options['search_values_min_acres'] );
											}
											if ( !empty( self::$_options['search_values_max_acres'] ) ) {
												$new_field['max'] = floatval( self::$_options['search_values_max_acres'] );
											}
											if ( !empty( self::$_options['search_values_acres_increment'] ) ) {
												$new_field['increment'] = floatval( self::$_options['search_values_acres_increment'] );
											}
										}
										else if ( $field === 'property_type' || $field === 'property_type_select' ) {
											if ( !empty( self::$_options['search_values_property_types'] ) ) {
												$property_types = array_filter( self::$_options['search_values_property_types'], array( 'DispletRetsIdxUtilities', 'remove_false_as_string' ) );
												if ( !empty( $property_types ) ) {
													$new_field['options'] = array_keys( $property_types );
												}
											}
										}
									}
									$field = $new_field;
								}
							}
						}
					}
				}
			}
			DispletRetsIdxOptionsController::update_option( 'search_forms', $search_forms );
		}
	}

	public static function validate( $input ) {
		$search_forms = array(
			array(),
			array(),
			array(),
			array(),
			array(),
		);
		if ( !empty( $input['search_forms'] ) && is_array( $input['search_forms'] ) ) {
			$search_fields = DispletRetsIdxSearchFieldsModel::$fields;
			foreach ( $input['search_forms'] as &$form ) {
				if ( !empty( $form ) && is_array( $form ) ) {
					foreach ( $form as &$column ) {
						if ( !empty( $column ) && is_array( $column ) ) {
							foreach ( $column as &$field ) {
								if ( !empty( $field ) && is_array( $field ) ) {
									foreach ( $field as $key => &$value) {
										switch ( $key ) {
											case 'options':
												$value = !empty( $value ) && is_array( $value ) ? array_map( 'addslashes', $value ) : array();
											break;
											case 'increment':
											case 'min':
											case 'max':
											case 'lease_max':
											case 'sale_min':
												if ( DispletRetsIdxUtilities::empty_excluding_zero( $value ) && !DispletRetsIdxUtilities::empty_excluding_zero( $search_fields[ $field['field'] ]['range'][ $key ] ) ) {
													$value = $search_fields[ $field['field'] ]['range'][ $key ];
												}
												else {
													$value = DispletRetsIdxUtilities::remove_non_numeric_characters( $value );
												}
											break;
											case 'range':
												if ( !empty( $value ) ) {
													$value = array_filter( array_map( array( 'DispletRetsIdxUtilities', 'remove_non_numeric_characters' ), explode( "\n", $value ) ) );
												}
												else {
													$value = array();
												}
											break;
											default:
												$value = sanitize_text_field( $value );
											break;
										}
									}
									if ( !DispletRetsIdxUtilities::empty_excluding_zero( $field['min'] ) && !DispletRetsIdxUtilities::empty_excluding_zero( $field['max'] ) ) {
										$count = 0;
										if ( $field['field'] === 'price' || $field['field'] === 'price' || $field['field'] ) {
											$difference = intval( intval( $field['max'] ) / 1000 ) - intval( intval( $field['min'] ) / 1000 );
											$increment = intval( intval( $field['increment'] ) / 1000 );
										}
										else {
											$difference = floatval( $field['max'] ) - floatval( $field['min'] );
											$increment = floatval( $field['increment'] );
										}
										if ( !empty( $increment ) ) {
											$count = floor( ( $difference + 1 ) / $increment );
										}
										else {
											$count = intval( $difference ) + 1;
										}
										if ( $count > 500 ) {
											add_settings_error(
												'search_forms',
												'search_forms',
												'Too many options for ' . $field['label'] . '! Try a higher min, a lower max, or a higher increment to avoid having ' . number_format( $count ) . ' options.',
												'error'
											);
										}
									}
								}
							}
							$column = array_values( $column );
						}
					}
					$form = array_values( $form );
				}
			}
			foreach ( $input['search_forms'] as $key => $search_form ) {
				if ( !empty( $search_form ) ) {
					$search_forms[ $key ] = $search_form;
				}
			}
		}
		return $search_forms;
	}
}

?>