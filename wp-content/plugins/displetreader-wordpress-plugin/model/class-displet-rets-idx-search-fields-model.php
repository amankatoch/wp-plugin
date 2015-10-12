<?php

class DispletRetsIdxSearchFieldsModel extends DispletRetsIdxPlugin {
	public static $fields = array(
		'acres_min' => array (
			'title' => 'Acres - Min',
			'label' => 'Min Acres',
			'range' => array(
				'custom' => true,
				'increment' => .25,
				'min' => .25,
				'max' => 5,
			),
		),
		'area_mls_defined_select' => array (
			'title' => 'Area ( MLS Defined )',
			'label' => 'Area',
		),
		'area_mls_defined' => array (
			'title' => 'Area ( MLS Defined ) | Multi-Select',
			'label' => 'Area',
		),
		'basement' => array (
			'title' => 'Basement',
			'label' => 'Basement',
		),
		'baths' => array (
			'title' => 'Baths - Min',
			'label' => 'Min Baths',
			'non_idx' => true,
			'range' => array(
				'min' => 1,
				'max' => 6,
			),
		),
		'baths_max' => array (
			'title' => 'Baths - Max',
			'label' => 'Max Baths',
			'range' => array(
				'min' => 1,
				'max' => 6,
			),
		),
		'beds' => array (
			'title' => 'Beds - Min',
			'label' => 'Min Beds',
			'non_idx' => true,
			'range' => array(
				'min' => 1,
				'max' => 6,
			),
		),
		'beds_max' => array (
			'title' => 'Beds - Max',
			'label' => 'Max Beds',
			'range' => array(
				'min' => 1,
				'max' => 6,
			),
		),
		'beds_baths' => array (
			'title' => 'Beds/Baths',
			'non_idx' => true,
			'range' => array(
				'min' => 1,
				'max' => 6,
			),
		),
		'city_select' => array (
			'title' => 'City',
			'label' => 'City',
			'non_idx' => true,
		),
		'city' => array (
			'title' => 'City | Multi-Select',
			'label' => 'City',
			'non_idx' => true,
		),
		'county' => array (
			'title' => 'County',
			'label' => 'County',
		),
		'foreclosure' => array (
			'title' => 'Foreclosure',
			'label' => 'Foreclosure',
			'non_idx' => true,
		),
		'is_gated_community' => array (
			'title' => 'Gated Community',
			'label' => 'Gated Community',
		),
		'keywords' => array (
			'title' => 'Keywords',
			'label' => 'Keywords: Ex. Pool, Modern, Foreclosure',
			'non_idx' => true,
		),
		'listed_since' => array (
			'title' => 'List Date',
			'label' => 'List Date',
		),
		'last_modified' => array (
			'title' => 'Listing Updated',
			'label' => 'Listing Updated',
		),
		'master_on_main' => array (
			'title' => 'Master On Main',
			'label' => 'Master On Main',
		),
		'mls_number' => array (
			'title' => 'MLS Number',
			'label' => 'MLS&reg; Number',
		),
		'new_construction' => array (
			'title' => 'New Construction',
			'label' => 'New Construction',
		),
		'pool' => array (
			'title' => 'Pool',
			'label' => 'Pool',
			'non_idx' => true,
		),
		'price_min' => array (
			'title' => 'Price - Min',
			'label' => 'Min Price',
			'non_idx' => true,
			'range' => array(
				'custom' => true,
				'increment' => 50000,
				'min' => 100000,
				'max' => 1000000,
				'lease_max' => true,
				'sale_min' => true,
			),
		),
		'price_max' => array (
			'title' => 'Price - Max',
			'label' => 'Max Price',
			'non_idx' => true,
			'range' => array(
				'custom' => true,
				'increment' => 50000,
				'min' => 100000,
				'max' => 1000000,
				'lease_max' => true,
				'sale_min' => true,
			),
		),
		'price' => array (
			'title' => 'Price - Min/Max',
			'non_idx' => true,
			'range' => array(
				'custom' => true,
				'increment' => 50000,
				'min' => 100000,
				'max' => 1000000,
				'lease_max' => true,
				'sale_min' => true,
			),
		),
		'property_type_select' => array (
			'title' => 'Property Type',
			'label' => 'Property Type',
			'non_idx' => true,
		),
		'property_type' => array (
			'title' => 'Property Type | Multi-Select',
			'label' => 'Property Type',
			'non_idx' => true,
		),
		'quick_terms' => array (
			'title' => 'Quick Terms',
			'label' => 'City, Zip, Neighborhood, or Condo',
			'non_idx' => true,
		),
		'school' => array (
			'title' => 'School',
			'label' => 'School',
		),
		'school_district_select' => array (
			'title' => 'School District',
			'label' => 'School District',
		),
		'school_district' => array (
			'title' => 'School District | Multi-Select',
			'label' => 'School District',
		),
		'short_sale' => array (
			'title' => 'Short Sale',
			'label' => 'Short Sale',
		),
		'square_feet_min' => array (
			'title' => 'Square Feet - Min',
			'label' => 'Min Sq Ft',
			'non_idx' => true,
			'range' => array(
				'custom' => true,
				'increment' => 500,
				'min' => 500,
				'max' => 5000,
			),
		),
		'square_feet_max' => array (
			'title' => 'Square Feet - Max',
			'label' => 'Max Sq Ft',
			'non_idx' => true,
			'range' => array(
				'custom' => true,
				'increment' => 500,
				'min' => 500,
				'max' => 5000,
			),
		),
		'square_feet' => array (
			'title' => 'Square Feet - Min/Max',
			'non_idx' => true,
			'range' => array(
				'custom' => true,
				'increment' => 500,
				'min' => 500,
				'max' => 5000,
			),
		),
		'state' => array (
			'title' => 'State',
			'label' => 'State',
		),
		'state_multiple_select' => array (
			'title' => 'State | Multi-Select',
			'label' => 'State',
		),
		'status_select' => array (
			'title' => 'Status',
			'label' => 'Status',
		),
		'status' => array (
			'title' => 'Status | Multi-Select',
			'label' => 'Status',
		),
		'stories' => array (
			'title' => 'Stories',
			'label' => 'Stories',
		),
		'subdivision' => array (
			'title' => 'Subdivision',
			'label' => 'Subdivision',
			'non_idx' => true,
		),
		'waterfront' => array (
			'title' => 'Waterfront',
			'label' => 'Waterfront',
		),
		'year_built' => array (
			'title' => 'Year Built',
			'label' => 'Year Built',
		),
		'zip' => array (
			'title' => 'Zip Code',
			'label' => 'Zip Code',
			'non_idx' => true,
		),
	);

	private static function get_acres_options( $field ) {
		$options = array(
			'min' => array(),
		);
		if ( !empty( $field['range'] ) && is_array( $field['range'] ) ) {
			$values = array_map( 'intval', $field['range'] );
		}
		else if ( !DispletRetsIdxUtilities::empty_excluding_zero( $field['min'] ) && !empty( $field['max'] ) && !empty( $field['increment'] ) ) {
			$values = array();
			$min = floatval( $field['min'] );
			$max = floatval( $field['max'] );
			$increment = floatval( $field['increment'] );
			if ( $increment > 0 && ( $max - $min + 1 ) / $increment <= 500 ) {
				for ( $i = $min; $i <= $max; $i += $increment ) {
					$values[] = $i;
				}
			}
		}
		if ( !empty( $values ) ) {
			foreach ( $values as $value ) {
				$label = number_format( $value, 2 ) . '+ acres';
				$options['min'][ strval( $value ) ] = $label;
			}
		}
		return $options;
	}

	protected static function get_acres_min( $field ) {
		$options = self::get_acres_options( $field );
		return self::get_select_markup( 'min_acres', $field['label'], $options['min'] );
	}


	protected static function get_area_mls_defined( $field, $multiple = false ) {
		$options = self::get_area_mls_defined_options( $field );
		if ( !empty( $options ) ) {
			return self::get_select_markup( 'area_mls_defined', $field['label'], $options, $multiple );
		}
		else{
			return self::get_input_markup( 'area_mls_defined', $field['label'] );
		}
	}

	public static function get_area_mls_defined_options( $field ) {
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			$options = array();
			$field_options = !empty( $field['options'] ) ? $field['options'] : self::$_field_options['area_mls_defined'];
			if ( !empty( $field_options ) ) {
				foreach ( $field_options as $area_mls_defined ) {
					$options[ $area_mls_defined ] = $area_mls_defined;
				}
			}
			return $options;
		}
		return false;
	}

	protected static function get_basement( $field ) {
		return self::get_radio_markup( 'basement', $field['label'], self::get_yes_no_any_options() );
	}

	protected static function get_baths( $field ) {
		$options = self::get_baths_options( $field );
		return self::get_select_markup( 'min_bathrooms', $field['label'], $options['min'] );
	}

	protected static function get_baths_max( $field ) {
		$options = self::get_baths_options( $field );
		return self::get_select_markup( 'max_bathrooms', $field['label'], $options['max'] );
	}

	private static function get_baths_options( $field ) {
		$options = array(
			'min' => array(),
			'max' => array(),
		);
		if ( !DispletRetsIdxUtilities::empty_excluding_zero( $field['min'] ) && !empty( $field['max'] ) ) {
			$min = intval( $field['min'] );
			$max = intval( $field['max'] );
			if ( $max - $min + 1 <= 500 ) {
				for ( $i = $min; $i <= $max; $i++ ) {
					$min_label = $i . '+ baths';
					$max_label = $i . '- baths';
					$options['min'][ $i ] = $min_label;
					$options['max'][ $i ] = $max_label;
				}
			}
		}
		return $options;
	}

	protected static function get_beds( $field ) {
		$options = self::get_beds_options( $field );
		return self::get_select_markup( 'min_bedrooms', $field['label'], $options['min'] );
	}

	protected static function get_beds_baths( $field ) {
		$beds_options = self::get_beds_options( $field );
		$baths_options = self::get_baths_options( $field );
		$beds_markup = self::get_select_markup( 'min_bedrooms', 'Min Beds', $beds_options['min'] );
		$baths_markup = self::get_select_markup( 'min_bathrooms', 'Min Baths', $baths_options['min'] );
		return self::get_or_markup( $beds_markup, $baths_markup );
	}

	protected static function get_beds_max( $field ) {
		$options = self::get_beds_options( $field );
		return self::get_select_markup( 'max_bedrooms', $field['label'], $options['max'] );
	}

	private static function get_beds_options( $field ) {
		$options = array(
			'min' => array(),
			'max' => array(),
		);
		if ( !DispletRetsIdxUtilities::empty_excluding_zero( $field['min'] ) && !empty( $field['max'] ) ) {
			$min = intval( $field['min'] );
			$max = intval( $field['max'] );
			if ( $max - $min + 1 <= 500 ) {
				for ( $i = $min; $i <= $max; $i++ ) {
					$min_label = $i . '+ beds';
					$max_label = $i . '- beds';
					$options['min'][ $i ] = $min_label;
					$options['max'][ $i ] = $max_label;
				}
			}
		}
		return $options;
	}

	protected static function get_city( $field, $multiple = false ) {
		$options = self::get_city_options( $field );
		if ( !empty( $options ) ) {
			return self::get_select_markup( 'city', $field['label'], $options, $multiple );
		}
		else{
			return self::get_input_markup( 'city', $field['label'] );
		}
	}

	public static function get_city_options( $field ) {
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			$options = array();
			$field_options = !empty( $field['options'] ) ? $field['options'] : self::$_field_options['city'];
			if ( !empty( $field_options ) ) {
				if ( !empty( self::$_options['city_include_filter'] ) ) {
					$city_filter = array_filter( self::$_options['city_include_filter'] );
				}
				foreach ( $field_options as $city ) {
					if ( empty( $city_filter ) || !empty( self::$_options['city_include_filter'][ $city ] ) ) {
						$options[ $city ] = trim( $city );
					}
				}
			}
			return $options;
		}
		return false;
	}

	protected static function get_county( $field ) {
		return self::get_input_markup( 'county', $field['label'] );
	}

	protected static function get_foreclosure( $field ) {
		return self::get_radio_markup( 'is_foreclosure', $field['label'], self::get_yes_no_any_options() );
	}

	protected static function get_is_gated_community( $field ) {
		return self::get_radio_markup( 'is_gated_community', $field['label'], self::get_yes_no_any_options() );
	}

	private static function get_input_markup( $search_field, $title ) {
		return
			'<input type="text" id="displet-' . $search_field . '" name="' . $search_field . '" class="displet-search-field displet-full" value="" placeholder="' . $title . '">';
	}

	protected static function get_keywords( $field ) {
		return self::get_input_markup( 'keyword', $field['label'] );
	}

	protected static function get_last_modified( $field ) {
		return self::get_select_markup( 'last_modified', $field['label'], self::get_last_modified_listed_since_options() );
	}

	private static function get_last_modified_listed_since_options() {
		return array(
			'1' => 'Last Day',
			'2' => 'Last 2 Days',
			'3' => 'Last 3 Days',
			'5' => 'Last 5 Days',
			'7' => 'Last Week',
			'30' => 'Last Month',
			'90' => 'Last 3 Months',
			'180' => 'Last 6 Months',
		);
	}

	protected static function get_listed_since( $field ) {
		return self::get_select_markup( 'listed_since', $field['label'], self::get_last_modified_listed_since_options() );
	}

	protected static function get_master_on_main( $field ) {
		return self::get_radio_markup( 'master_on_main', $field['label'], self::get_yes_no_any_options() );
	}

	protected static function get_mls_number( $field ) {
		return self::get_input_markup( 'mls_number', $field['label'] );
	}

	protected static function get_new_construction( $field ) {
		return self::get_radio_markup( 'is_new_construction', $field['label'], self::get_yes_no_any_options() );
	}

	private static function get_or_markup( $first_half, $second_half, $to = false ) {
		$markup =
			'<div class="displet-or">';
		if ( $to ) {
			$markup .=
				'<span class="displet-to">
					To
				</span>';
		}
		$markup .=
				'<div class="displet-group">
					<div class="displet-half displet-left">
						' . $first_half . '
					</div>
					<div class="displet-half displet-right">
						' . $second_half . '
					</div>
				</div>
			</div>';
		return $markup;
	}

	protected static function get_pool( $field ) {
		return self::get_radio_markup( 'pool_on_property', $field['label'], self::get_yes_no_any_options() );
	}

	protected static function get_price( $field ) {
		$options = self::get_price_options( $field );
		$min_price_markup = self::get_select_markup( 'min_list_price', 'Min Price', $options['min'], false, $options['hidden'] );
		$max_price_markup = self::get_select_markup( 'max_list_price', 'Max Price', $options['max'], false, $options['hidden'] );
		return self::get_or_markup( $min_price_markup, $max_price_markup, true );
	}

	protected static function get_price_min( $field ) {
		$options = self::get_price_options( $field );
		return self::get_select_markup( 'min_list_price', $field['label'], $options['min'], false, $options['hidden'] );
	}

	protected static function get_price_max( $field ) {
		$options = self::get_price_options( $field );
		return self::get_select_markup( 'max_list_price', $field['label'], $options['max'], false, $options['hidden'] );
	}

	private static function get_price_options( $field ) {
		$options = array(
			'min' => array(),
			'max' => array(),
			'hidden' => array(
				'lease_max' => !empty( $field['lease_max'] ) ? intval( intval( $field['lease_max'] ) / 1000 ) : false,
				'sale_min' => !empty( $field['sale_min'] ) ? intval( intval( $field['sale_min'] ) / 1000 ) : false,
			),
		);
		if ( !empty( $field['range'] ) ) {
			$prices = array_map( array( 'DispletRetsIdxUtilities', 'reduce_by_three_orders_of_magnitude' ), $field['range'] );
		}
		else if ( !DispletRetsIdxUtilities::empty_excluding_zero( $field['min'] ) && !empty( $field['max'] ) && !empty( $field['increment'] ) ) {
			$prices = array();
			$min = intval( intval( $field['min'] ) / 1000 );
			$max = intval( intval( $field['max'] ) / 1000 );
			$increment = intval( intval( $field['increment'] ) / 1000 );
			if ( $increment > 0 && ( $max - $min + 1 ) / $increment <= 500 ) {
				for ( $i = $min; $i <= $max; $i += $increment ) {
					$prices[] = $i;
				}
			}
		}
		if ( !empty( $prices ) ) {
			$min_price = !empty( self::$_options['min_price_filter'] ) ? intval( self::$_options['min_price_filter'] ) : false;
			$max_price = !empty( self::$_options['max_price_filter'] ) ? intval( self::$_options['max_price_filter'] ) : false;
			foreach ( $prices as $price ) {
				if ( ( !$min_price || $price >= $min_price ) && ( !$max_price || $price <= $max_price ) ) {
					$base = '$' . number_format( $price * 1000 );
					$min_label = $base . '+';
					$max_label = $base . '-';
					$options['min'][ $price ] = $min_label;
					$options['max'][ $price ] = $max_label;
				}
			}
		}
		return $options;
	}

	protected static function get_property_type( $field, $multiple = false ) {
		return self::get_select_markup( 'property_type', $field['label'], self::get_property_type_options( $field ), $multiple );
	}

	public static function get_property_type_options( $field ) {
		$options = array();
		$field_options = !empty( $field['options'] ) ? $field['options'] : self::$_field_options['property_type'];
		if ( !empty( $field_options ) ) {
			if ( !empty( self::$_options['property_type_include_filter'] ) ) {
				$property_type_filter = array_filter( self::$_options['property_type_include_filter'] );
			}
			foreach ( $field_options as $property_type ) {
				if ( empty( $property_type_filter ) || !empty( self::$_options['property_type_include_filter'][ $property_type ] ) ) {
					$options[ $property_type ] = $property_type;
				}
			}
		}
		return $options;
	}

	protected static function get_quick_terms( $field ) {
		return self::get_input_markup( 'quick_terms', $field['label'] );
	}

	private function get_radio_markup( $search_field, $title, $options ) {
		$markup =
			'<div id="displet-' . $search_field . '" class="displet-radio">
				<label>' . $title . '</label>';
		if ( !empty( $options ) && is_array( $options ) ) {
			foreach ( $options as $value => $label ) {
				$markup .=
					'<input type="radio" name="' . $search_field . '" class="displet-search-field" value="' . $value . '">
					<span>
						' . $label . '
					</span>';
			}
		}
		$markup .=
			'</div>';
		return $markup;
	}

	private function get_select_markup( $search_field, $title, $options, $multiple = false, $hidden = false ) {
		$markup = '';
		if ( !$multiple ) {
			$markup .=
				'<div class="displet-select">';
		}
		if ( !empty( $hidden ) && is_array( $hidden ) ) {
			foreach( $hidden as $name => $value ) {
				if ( !empty( $value ) ) {
					$markup .= '<input type="hidden" name="' . $name . '" value="' . $value . '"/>' . PHP_EOL;
				}
			}
		}
		$markup .=
					'<select id="displet-' . $search_field . '" name="' . $search_field . '" class="displet-search-field"';
		if ( $multiple ) {
			$markup .= ' multiple data-placeholder="' . $title . '">
						<option value="none" disabled>' . $title . '</option>';
		}
		else {
			$markup .= '>
						<option value="none" selected="selected">' . $title . '</option>';
		}
				if ( !empty( $options ) && is_array( $options ) ) {
					foreach ( $options as $value => $label ) {
						$markup .= '<option value="' . $value . '">' . $label . '</option>';
					}
				}
		$markup .=
					'</select>';
		if ( !$multiple ) {
			$markup .=
				'</div>';
		}
		return $markup;
	}

	protected static function get_school( $field ) {
		return self::get_input_markup( 'school', $field['label'] );
	}

	protected static function get_school_district( $field, $multiple = false ) {
		$options = self::get_school_district_options( $field );
		if ( !empty( $options ) ) {
			return self::get_select_markup( 'school_district', $field['label'], $options, $multiple );
		}
		else{
			return self::get_input_markup( 'school_district', $field['label'] );
		}
	}

	public static function get_school_district_options( $field ) {
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			$options = array();
			$field_options = !empty( $field['options'] ) ? $field['options'] : self::$_field_options['school_district'];
			if ( !empty( $field_options ) ) {
				foreach ( $field_options as $school_district ) {
					$options[ $school_district ] = $school_district;
				}
			}
			return $options;
		}
		return false;
	}

	protected static function get_short_sale( $field ) {
		return self::get_radio_markup( 'short_sale', $field['label'], self::get_yes_no_any_options() );
	}

	protected static function get_square_feet( $field ) {
		$options = self::get_square_feet_options( $field );
		$min_square_feet_markup = self::get_select_markup( 'min_square_feet', 'Min Sq Ft', $options['min'] );
		$max_square_feet_markup = self::get_select_markup( 'max_square_feet', 'Max Sq Ft', $options['max'] );
		return self::get_or_markup( $min_square_feet_markup, $max_square_feet_markup, true );
	}

	protected static function get_square_feet_min( $field ) {
		$options = self::get_square_feet_options( $field );
		return self::get_select_markup( 'min_square_feet', $field['label'], $options['min'] );
	}

	protected static function get_square_feet_max( $field ) {
		$options = self::get_square_feet_options( $field );
		return self::get_select_markup( 'max_square_feet', $field['label'], $options['max'] );
	}

	private function get_square_feet_options( $field ) {
		$options = array(
			'min' => array(),
			'max' => array(),
		);
		if ( !empty( $field['range'] ) && is_array( $field['range'] ) ) {
			$values = array_map( 'intval', $field['range'] );
		}
		else if ( !empty( $field['min'] ) && !empty( $field['max'] ) && !empty( $field['increment'] ) ) {
			$values = array();
			$min = intval( $field['min'] );
			$max = intval( $field['max'] );
			$increment = intval( $field['increment'] );
			if ( $increment > 0 && ( $max - $min + 1 ) / $increment <= 500 ) {
				for ( $i = $min; $i <= $max; $i += $increment ) {
					$values[] = $i;
				}
			}
		}
		if ( !empty( $values ) ) {
			foreach ( $values as $value ) {
				$square_feet = number_format( $value );
				$min_label = $square_feet . '+ sq ft';
				$max_label = $square_feet . '- sq ft';
				$options['min'][ $value ] = $min_label;
				$options['max'][ $value ] = $max_label;
			}
		}
		return $options;
	}

	protected static function get_state( $field, $multiple = false ) {
		$options = self::get_state_options( $field );
		if ( !empty( $options ) ) {
			return self::get_select_markup( 'state', $field['label'], $options, $multiple );
		}
		else{
			return self::get_input_markup( 'state', $field['label'] );
		}
	}

	public static function get_state_options( $field ) {
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			$options = array();
			$field_options = !empty( $field['options'] ) ? $field['options'] : self::$_field_options['state'];
			if ( !empty( $field_options ) ) {
				foreach ( $field_options as $state ) {
					$options[ $state ] = $state;
				}
				return $options;
			}
		}
		return false;
	}

	protected static function get_status( $field, $multiple = false ) {
		$options = self::get_status_options( $field );
		if ( !empty( $options ) ) {
			return self::get_select_markup( 'status', $field['label'], $options, $multiple );
		}
		else{
			return self::get_input_markup( 'status', $field['label'] );
		}
	}

	public static function get_status_options( $field ) {
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			$options = array();
			$field_options = !empty( $field['options'] ) ? $field['options'] : self::$_field_options['status'];
			if ( !empty( $field_options ) ) {
				foreach ( $field_options as $status ) {
					$options[ $status ] = $status;
				}
				return $options;
			}
		}
		return false;
	}

	protected static function get_stories( $field ) {
		return self::get_radio_markup( 'min_stories', $field['label'], array(
			'1' => '1+',
			'2' => '2+',
			'none' => 'Any',
		) );
	}

	protected static function get_subdivision( $field ) {
		return self::get_input_markup( 'subdivision', $field['label'] );
	}

	protected static function get_waterfront( $field ) {
		return self::get_radio_markup( 'waterfront', $field['label'], self::get_yes_no_any_options() );
	}

	protected static function get_year_built( $field ) {
		return self::get_select_markup( 'year_built', $field['label'], array(
			'2' => 'New Construction',
			'5' => 'Last 5 Years',
			'10' => 'Last 10 Years',
			'15' => 'Last 15 Years',
			'20' => 'Last 20 Years',
			'25' => 'Last 25 Years',
		) );
	}

	private static function get_yes_no_any_options() {
		return array(
			'Y' => 'Yes',
			'N' => 'No',
			'none' => 'Any',
		);
	}

	protected static function get_zip( $field ) {
		return self::get_input_markup( 'zip', $field['label'] );
	}

}

?>