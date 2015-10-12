<?php

class DispletRetsIdxSearchFieldsController extends DispletRetsIdxSearchFieldsModel {
	public static function get_search_field_markup( $field ) {
		$markup = '<div class="displet-field">';
        switch ( $field['field'] ) {
			case 'acres_min' :
				$markup .= self::get_acres_min( $field );
				break;
			case 'area_mls_defined' :
				$markup .= self::get_area_mls_defined( $field, true );
				break;
			case 'area_mls_defined_select' :
				$markup .= self::get_area_mls_defined( $field );
				break;
			case 'basement' :
				$markup .= self::get_basement( $field );
				break;
			case 'baths' :
				$markup .= self::get_baths( $field );
				break;
			case 'baths_max' :
				$markup .= self::get_baths_max( $field );
				break;
			case 'beds' :
				$markup .= self::get_beds( $field );
				break;
			case 'beds_baths' :
				$markup .= self::get_beds_baths( $field );
				break;
			case 'beds_max' :
				$markup .= self::get_beds_max( $field );
				break;
			case 'city' :
				$markup .= self::get_city( $field, true );
				break;
			case 'city_select' :
				$markup .= self::get_city( $field );
				break;
			case 'county' :
				$markup .= self::get_county( $field );
				break;
			case 'foreclosure' :
				$markup .= self::get_foreclosure( $field );
				break;
			case 'is_gated_community' :
				$markup .= self::get_is_gated_community( $field );
				break;
			case 'keywords' :
				$markup .= self::get_keywords( $field );
				break;
			case 'last_modified' :
				$markup .= self::get_last_modified( $field );
				break;
			case 'listed_since' :
				$markup .= self::get_listed_since( $field );
				break;
			case 'master_on_main' :
				$markup .= self::get_master_on_main( $field );
				break;
			case 'mls_number' :
				$markup .= self::get_mls_number( $field );
				break;
			case 'new_construction' :
				$markup .= self::get_new_construction( $field );
				break;
			case 'pool' :
				$markup .= self::get_pool( $field );
				break;
			case 'price_min' :
				$markup .= self::get_price_min( $field );
				break;
			case 'price_max' :
				$markup .= self::get_price_max( $field );
				break;
			case 'price' :
				$markup .= self::get_price( $field );
				break;
			case 'property_type' :
				$markup .= self::get_property_type( $field, true );
				break;
			case 'property_type_select' :
				$markup .= self::get_property_type( $field );
				break;
			case 'quick_terms' :
				$markup .= self::get_quick_terms( $field );
				break;
			case 'school' :
				$markup .= self::get_school( $field );
				break;
			case 'school_district' :
				$markup .= self::get_school_district( $field, true );
				break;
			case 'school_district_select' :
				$markup .= self::get_school_district( $field );
				break;
			case 'short_sale' :
				$markup .= self::get_short_sale( $field );
				break;
			case 'square_feet_min' :
				$markup .= self::get_square_feet_min( $field );
				break;
			case 'square_feet_max' :
				$markup .= self::get_square_feet_max( $field );
				break;
			case 'square_feet' :
				$markup .= self::get_square_feet( $field );
				break;
			case 'state' :
				$markup .= self::get_state( $field );
				break;
			case 'state_multiple_select' :
				$markup .= self::get_state( $field, true );
				break;
			case 'status' :
				$markup .= self::get_status( $field, true );
				break;
			case 'status_select' :
				$markup .= self::get_status( $field );
				break;
			case 'stories' :
				$markup .= self::get_stories( $field );
				break;
			case 'subdivision' :
				$markup .= self::get_subdivision( $field );
				break;
			case 'waterfront' :
				$markup .= self::get_waterfront( $field );
				break;
			case 'year_built' :
				$markup .= self::get_year_built( $field );
				break;
			case 'zip' :
				$markup .= self::get_zip( $field );
				break;
		}
		$markup .= '</div>';
		return $markup;
	}

	public static function get_advanced_search_form_column_html( $column_id ) {
		return self::_get_search_form_column_html_for_fields( self::$_search_form_options[1][ $column_id - 1 ] );
	}

	public static function get_advanced_search_form_fields( $column_id ) {
		return self::$_search_form_options[1][ $column_id - 1 ];
	}

	public static function get_mobile_quick_search_form_html() {
		return self::_get_search_form_column_html_for_fields( self::$_search_form_options[2][0] );
	}

	public static function get_mobile_search_form_html() {
		return self::_get_search_form_column_html_for_fields( self::$_search_form_options[3][0] );
	}

	public static function get_quick_search_form_html( $form_id, $column_id ) {
		return self::_get_search_form_column_html_for_fields( self::$_search_form_options[ $form_id + 3 ][ $column_id - 1 ] );
	}

	public static function get_search_form_fields( $column_id ) {
		return self::$_search_form_options[0][ $column_id - 1 ];
	}

	public static function get_search_form_column_html( $column_id ) {
		return self::_get_search_form_column_html_for_fields( self::$_search_form_options[0][ $column_id - 1 ] );
	}

	private static function _get_search_form_column_html_for_fields( $fields ) {
		if ( !empty( $fields ) ) {
			$markup = '';
			foreach ( $fields as $field ) {
				$markup .= self::get_search_field_markup( $field );
			}
			return $markup;
		}
	}

	public static function has_advanced_search_form_column( $column_id ) {
		if ( !empty( self::$_search_form_options[1][ $column_id - 1 ] ) ) {
			return true;
		}
		return false;
	}

	public static function has_search_form_column( $column_id ) {
		if ( !empty( self::$_search_form_options[0][ $column_id - 1 ] ) ) {
			return true;
		}
		return false;
	}

	public static function has_quick_search_form( $form_id, $column_id ) {
		if ( !empty( self::$_search_form_options[ $form_id + 3 ][ $column_id - 1 ] ) ) {
			return true;
		}
		return false;
	}
}

?>