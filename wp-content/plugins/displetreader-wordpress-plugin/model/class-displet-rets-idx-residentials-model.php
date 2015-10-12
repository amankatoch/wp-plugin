<?php

class DispletRetsIdxResidentialsModel extends DispletRetsIdxPlugin {
	protected $_model;
	protected $_query_args;
	protected $_residentials = array();
	protected $_showcase_args;
	protected $_showcase_meta_query = array();

	protected static $_comma_separated_fields = array(
		'area_mls_defined',
		'city',
		'keyword',
		'listing_agent_id',
		'listing_office_id',
		'mls_number',
		'property_type',
		'quick_terms',
		'school',
		'school_district',
		'status',
		'subdivision',
		'zip',
	);

	protected static $_default_return_fields = array(
		'city',
		'full_baths',
		'half_baths',
		'id',
		'internet_remarks',
		'latitude',
		'list_price',
		'longitude',
		'num_bedrooms',
		'original_list_price',
		'primary_big_image_urls',
		'property_type',
		'state',
		'status',
		'street_name',
		'street_number',
		'street_post_dir',
		'street_pre_direction',
		'square_feet',
		'unit',
		'zip',
	);

	protected static $_min_search_fields = array(
		'min_bathrooms',
		'min_bedrooms',
		'min_list_price',
		'min_square_feet',
	);

	protected static $_max_search_fields = array(
		'max_bathrooms',
		'max_bedrooms',
		'max_list_price',
		'max_square_feet',
	);

	protected static $_numeric_search_fields = array(
		'min_bathrooms',
		'min_bedrooms',
		'min_list_price',
		'min_square_feet',
		'max_bathrooms',
		'max_bedrooms',
		'max_list_price',
		'max_square_feet',
	);

	protected static $_partial_match_search_fields = array(
		'subdivision',
		'zip',
	);

	protected static $_property_showcase_residential_fields = array(
		'address' => 'displetpropertyshowcase_address',
		'bathrooms' => 'displetpropertyshowcase_bathrooms',
		'city' => 'displetpropertyshowcase_city',
		'internet_remarks' => 'post_content',
		'list_price' => 'displetpropertyshowcase_price_value',
		'num_bedrooms' => 'displetpropertyshowcase_bedrooms_value',
		'square_feet' => 'displetpropertyshowcase_size_value',
		'state' => 'displetpropertyshowcase_state',
		'zip' => 'displetpropertyshowcase_zip',
	);

	protected static $_property_showcase_search_fields = array(
		'city' => 'displetpropertyshowcase_city',
		'max_bathrooms' => 'displetpropertyshowcase_bathrooms_value',
		'max_bedrooms' => 'displetpropertyshowcase_bedrooms_value',
		'max_list_price' => 'displetpropertyshowcase_price_value',
		'max_square_feet' => 'displetpropertyshowcase_size_value',
		'min_bathrooms' => 'displetpropertyshowcase_bathrooms_value',
		'min_bedrooms' => 'displetpropertyshowcase_bedrooms_value',
		'min_list_price' => 'displetpropertyshowcase_price_value',
		'min_square_feet' => 'displetpropertyshowcase_size_value',
		'subdivision' => 'displetpropertyshowcase_subdivision',
		'zip' => 'displetpropertyshowcase_zip',
	);

	protected static $_required_residential_return_fields = array(
		'city',
		'id',
		'state',
		'street_name',
		'street_number',
		'street_post_dir',
		'street_pre_direction',
		'unit',
		'zip',
	);

	protected static $_search_field_labels = array(
		'area_mls_defined' => 'Area',
		'basement' => 'Basement',
		'city' => 'City',
		'county' => 'County',
		'id' => 'ID',
		'is_foreclosure' => 'Foreclosure',
		'is_gated_community' => 'Gated Community',
		'keyword' => 'Keyword',
		'listed_since' => 'Listed Since',
		'last_modified' => 'Last Modified',
		'listing_agent_id' => 'Listing Agent ID',
		'listing_office_id' => 'Listing Office ID',
		'master_on_main' => 'Master On Main',
		'max_bathrooms' => 'Max Bathrooms',
		'max_bedrooms' => 'Max Bedrooms',
		'max_list_price' => 'Max Price',
		'max_price_per_sq_feet' => 'Max Price/Sq Ft',
		'max_square_feet' => 'Max Square Feet',
		'max_square_feet_available' => 'Max Square Feet Available',
		'min_acres' => 'Min Acres',
		'min_bathrooms' => 'Min Bathrooms',
		'min_bedrooms' => 'Min Bedrooms',
		'min_list_price' => 'Min Price',
		'min_lot_size' => 'Min Lot Size',
		'min_price_per_sq_feet' => 'Min Price/Sq Ft',
		'min_square_feet' => 'Min Square Feet',
		'min_square_feet_available' => 'Min Square Feet Available',
		'min_stories' => 'Min Stories',
		'mls_number' => 'MLS Number',
		'poly' => 'Coordinates',
		'pool_on_property' => 'Pool',
		'property_type' => 'Property Type',
		'quick_terms' => 'Quick Terms',
		'school' => 'School',
		'school_district' => 'School District',
		'short_sale' => 'Short Sale',
		'state' => 'State',
		'status' => 'Status',
		'street_name' => 'Street Name',
		'street_number' => 'Street Number',
		'subdivision' => 'Subdivision',
		'waterfront' => 'Waterfront',
		'year_built' => 'Max Years Since Built',
		'zip' => 'Zip',
	);

	protected static $_search_fields = array(
		'areamlsdefined' => 'area_mls_defined',
		'basement' => 'basement',
		'city' => 'city',
		'county' => 'county',
		'id' => 'id',
		'isforeclosure' => 'is_foreclosure',
		'isgatedcommunity' => 'is_gated_community',
		'keyword' => 'keyword',
		'listedsince' => 'listed_since',
		'lastmodified' => 'last_modified',
		'listingagentid' => 'listing_agent_id',
		'listingofficeid' => 'listing_office_id',
		'masteronmain' => 'master_on_main',
		'maxbathrooms' => 'max_bathrooms',
		'maxbedrooms' => 'max_bedrooms',
		'maxlistprice' => 'max_list_price',
		'maxpricepersqfeet' => 'max_price_per_sq_feet',
		'maxsquarefeet' => 'max_square_feet',
		'maxsquarefeetavailable' => 'max_square_feet_available',
		'minacres' => 'min_acres',
		'minbathrooms' => 'min_bathrooms',
		'minbedrooms' => 'min_bedrooms',
		'minlistprice' => 'min_list_price',
		'minlotsize' => 'min_lot_size',
		'minpricepersqfeet' => 'min_price_per_sq_feet',
		'minsquarefeet' => 'min_square_feet',
		'minsquarefeetavailable' => 'min_square_feet_available',
		'minstories' => 'min_stories',
		'mlsnumber' => 'mls_number',
		'poly' => 'poly',
		'poolonproperty' => 'pool_on_property',
		'propertytype' => 'property_type',
		'quickterms' => 'quick_terms',
		'school' => 'school',
		'schooldistrict' => 'school_district',
		'shortsale' => 'short_sale',
		'state' => 'state',
		'status' => 'status',
		'streetname' => 'street_name',
		'streetnumber' => 'street_number',
		'subdivision' => 'subdivision',
		'waterfront' => 'waterfront',
		'yearbuilt' => 'year_built',
		'zip' => 'zip',
	);

	private function build_query_args() {
		$this->maybe_set_return_fields();
		$this->maybe_set_search_fields();
		$this->maybe_set_property_filter();
		$this->set_sort();
		$this->maybe_set_showcase_args();
	}

	private static function _get_clean_search_field( $field, $value ) {
		if ( in_array( $field, self::$_comma_separated_fields ) && !empty( $value ) ) {
			$value_array = array_map( 'trim', explode( ',', $value ) );
			if ( !empty( $value_array ) ) {
				return implode( ',', $value_array );
			}
		}
		return $value;
	}

	public static function get_filtered_city( $city, $is_excludable = true ) {
		if ( !empty( self::$_options['city_include_filter'] ) && is_array( self::$_options['city_include_filter'] ) ) {
			$city_filter = array_filter( self::$_options['city_include_filter'], array( 'DispletRetsIdxUtilities', 'remove_false_as_string' ) );
			if ( !empty( $city_filter ) ) {
				$filter_cities = array_map( 'strtolower', array_keys( $city_filter ) );
				if ( !empty( $city ) ){
					$query_cities = array();
					$model_cities = explode( ',', $city );
					foreach ( $model_cities as $model_city ) {
						if ( in_array( strtolower( $model_city ), $filter_cities ) ) {
							$query_cities[] = $model_city;
						}
					}
					if ( !empty( $query_cities ) ) {
						return implode( ',', $query_cities );
					}
					if ( $is_excludable ) {
						return 'property_filter_excluded';
					}
				}
				return implode( ',', $filter_cities );
			}
		}
		return $city;
	}

	public static function get_filtered_max_price( $max_price ) {
		if ( !empty( self::$_options['max_price_filter'] ) && is_numeric( self::$_options['max_price_filter'] ) ) {
			$max_price_filter = intval( self::$_options['max_price_filter'] );
			if ( empty( $max_price ) || $max_price > $max_price_filter ){
				return $max_price_filter;
			}
		}
		return $max_price;
	}

	public static function get_filtered_min_price( $min_price ) {
		if ( !empty( self::$_options['min_price_filter'] ) && is_numeric( self::$_options['min_price_filter'] ) ) {
			$min_price_filter = intval( self::$_options['min_price_filter'] );
			if ( empty( $min_price ) || $min_price < $min_price_filter ){
				return $min_price_filter;
			}
		}
		return $min_price;
	}

	public static function get_filtered_field_options( $field ) {
		if ( !empty( $field ) && !empty( self::$_field_options ) ) {
			if ( $field === 'area_mls_defined' && !empty( self::$_field_options['area_mls_defined'] ) ) {
				return self::$_field_options['area_mls_defined'];
			}
			elseif ( $field === 'city' && !empty( self::$_field_options['city'] ) && is_array( self::$_field_options['city'] ) ) {
				$options = self::get_filtered_city( implode( ',', self::$_field_options['city'] ) );
				if ( !empty( $options ) ) {
					return explode( ',', $options );
				}
			}
			elseif ( $field === 'property_type' && !empty( self::$_field_options['property_type'] ) && is_array( self::$_field_options['property_type'] ) ) {
				$options = self::get_filtered_property_type( implode( ',', self::$_field_options['property_type'] ) );
				if ( !empty( $options ) ) {
					return explode( ',', $options );
				}
			}
			elseif ( $field === 'school_district' && !empty( self::$_field_options['school_district'] ) ) {
				return self::$_field_options['school_district'];
			}
			elseif ( $field === 'status' && !empty( self::$_field_options['status'] ) ) {
				return self::$_field_options['status'];
			}
		}
		return false;
	}

	public static function get_filtered_property_type( $property_type, $is_excludable = true ) {
		if ( !empty( self::$_options['property_type_include_filter'] ) && is_array( self::$_options['property_type_include_filter'] ) ) {
			$property_type_filter = array_filter( self::$_options['property_type_include_filter'], array( 'DispletRetsIdxUtilities', 'remove_false_as_string' ) );
			if ( !empty( $property_type_filter ) ) {
				$filter_property_types = array_map( 'strtolower', array_keys( $property_type_filter ) );
				if ( !empty( $property_type ) ){
					$query_property_types = array();
					$model_property_types = array_map( 'trim', explode( ',', urldecode( $property_type ) ) );
					foreach ( $model_property_types as $model_property_type ) {
						if ( in_array( strtolower( $model_property_type ), $filter_property_types ) ) {
							$query_property_types[] = $model_property_type;
						}
					}
					if ( !empty( $query_property_types ) ) {
						return implode( ',', $query_property_types );
					}
					if ( $is_excludable ) {
						return 'property_filter_excluded';
					}
				}
				return implode( ',', $filter_property_types );
			}
		}
		return $property_type;
	}

	public static function get_filtered_zip( $zip, $is_excludable = true ) {
		if ( !empty( self::$_options['zip_code_include_filter'] ) ) {
			$filter_zips = array_map( 'trim', explode( "\n", self::$_options['zip_code_include_filter'] ) );
			if ( !empty( $zip ) ){
				$query_zips = array();
				$model_zips = explode( ',', urldecode( $zip ) );
				foreach ( $model_zips as $model_zip ) {
					if ( in_array( $model_zip, $filter_zips ) ) {
						$query_zips[] = $model_zip;
					}
				}
				if ( !empty( $query_zips ) ) {
					return implode( ',', $query_zips );
				}
				if ( $is_excludable ) {
					return 'property_filter_excluded';
				}
			}
			return implode( ',', $filter_zips );
		}
		return $zip;
	}

	public static function get_hash_from_search_parameters( $search_parameters ) {
		if ( !empty( $search_parameters ) && is_array( $search_parameters ) ) {
			$hash = array();
			foreach ( $search_parameters as $field => $value ) {
				$field = strtolower( $field );
				if ( in_array( $field, self::$_search_fields ) ) {
					$hash[] = $field . '=' . urlencode( $value );
				}
			}
			if ( !empty( $hash ) ) {
				return '#' . implode( '/', $hash );
			}
		}
	}

	private function get_meta_query_compare( $field ) {
		if ( in_array( $field, self::$_partial_match_search_fields ) ) {
			return 'LIKE';
		}
		else if ( in_array( $field, self::$_max_search_fields ) ) {
			return '<=';
		}
		else if ( in_array( $field, self::$_min_search_fields ) ) {
			return '>=';
		}
		return '=';
	}

	private function get_meta_query_type( $field ) {
		if ( in_array( $field , self::$_numeric_search_fields ) ) {
			return 'NUMERIC';
		}
		return 'CHAR';
	}

	private function get_meta_query_value( $field ) {
		if ( $field === 'min_list_price' || $field === 'max_list_price' ) {
			return intval( $this->_model[ $field ] ) * 1000;
		}
		return $this->_model[ $field ];
	}

	protected function get_return_fields() {
		$return_fields = self::$_default_return_fields;
		if ( !empty( self::$_options['include_subdivision'] ) ) {
			$return_fields[] = 'subdivision';
		}
		if ( !empty( self::$_options['include_mls_number'] ) ) {
			$return_fields[] = 'mls_number';
		}
		if ( !empty( self::$_options['include_listing_agent'] ) ) {
			$return_fields[] = 'listing_agent_name';
		}
		if ( !empty( self::$_options['include_listing_office'] ) ) {
			$return_fields[] = 'listing_office_name';
		}
		if ( !empty( self::$_options['include_listing_agent'] ) ) {
			$return_fields[] = 'listing_agent_name';
		}
		return apply_filters( 'displetretsidx_return_fields', $return_fields );
	}

	public static function get_search_criteria_from_hash( $hash ) {
		$trimmed_saved_search_criteria = rtrim( ltrim( $hash, '#' ), '/' );
		$saved_search_criteria = str_replace( '/', '&', $trimmed_saved_search_criteria );
		return $saved_search_criteria;
	}

	public static function get_search_field_labels() {
		return self::$_search_field_labels;
	}

	public static function get_translated_legacy_search_field( $legacy_search_field ) {
		$field = strtolower( $legacy_search_field );
		if ( !empty( self::$_search_fields[ $field ] ) ) {
			return self::$_search_fields[ $field ];
		}
		return false;
	}

	private function maybe_filter_city() {
		if ( !empty( $this->_query_args['city'] ) || !empty( self::$_options['city_include_filter'] ) ) {
			$this->_query_args['city'] = self::get_filtered_city( $this->_query_args['city'] );
		}
	}

	private function maybe_filter_min_price() {
		if ( !empty( $this->_query_args['min_list_price'] ) || !empty( self::$_options['min_price_filter'] ) ) {
			$this->_query_args['min_list_price'] = self::get_filtered_min_price( $this->_query_args['min_list_price'] );
		}
	}

	private function maybe_filter_max_price() {
		if ( !empty( $this->_query_args['max_list_price'] ) || !empty( self::$_options['max_price_filter'] ) ) {
			$this->_query_args['max_list_price'] = self::get_filtered_max_price( $this->_query_args['max_list_price'] );
		}
	}

	private function maybe_filter_property_type() {
		if ( !empty( $this->_query_args['property_type'] ) || !empty( self::$_options['property_type_include_filter'] ) ) {
			$this->_query_args['property_type'] = self::get_filtered_property_type( $this->_query_args['property_type'] );
		}
	}

	private function maybe_filter_zip_code() {
		if ( !empty( $this->_query_args['zip'] ) || !empty( self::$_options['zip_code_include_filter'] ) ) {
			$this->_query_args['zip'] = self::get_filtered_zip( $this->_query_args['zip'] );
		}
	}

	private function maybe_set_property_filter() {
		if ( $this->_model['data_from'] === 'api' ) {
			$this->maybe_filter_city();
			$this->maybe_filter_min_price();
			$this->maybe_filter_max_price();
			$this->maybe_filter_property_type();
			$this->maybe_filter_zip_code();
		}
	}

	private function maybe_set_return_fields() {
		if ( $this->_model['data_from'] === 'api' && $this->_model['is_displet_api'] && !empty( $this->_model['return_fields'] ) && is_array( $this->_model['return_fields'] ) ) {
			if ( $this->_model['get_residentials'] || $this->_model['get_listings_by_status'] ) {
				foreach ( self::$_required_residential_return_fields as $return_field ) {
					if ( empty( $this->_model['return_fields'][ $return_field ] ) ) {
						$this->_model['return_fields'][] = $return_field;
					}
				}
			}
			if ( $this->_model['layout'] === 'table' ) {
				$this->_model['return_fields'][] = 'year_built';
			}
			$this->_query_args['return_fields'] = implode( ',', array_unique( $this->_model['return_fields'] ) );
		}
	}

	private function maybe_set_search_fields() {
		foreach ( self::$_search_fields as $search_field ) {
			if ( !empty( $this->_model[ $search_field ] ) ) {
				if ( $this->_model['data_from'] === 'property_showcase' ) {
					if ( !empty( self::$_property_showcase_search_fields[ $search_field ] ) ) {
						$this->_showcase_meta_query[] = array(
							'key' => self::$_property_showcase_search_fields[ $search_field ],
							'value' => $this->get_meta_query_value( $search_field ),
							'compare' => $this->get_meta_query_compare( $search_field ),
							'type' => $this->get_meta_query_type( $search_field ),
						);
					}
				}
				else {
					$this->_query_args[ $search_field ] = self::_get_clean_search_field( $search_field, $this->_model[ $search_field ] );
				}
			}
		}
	}

	private function maybe_set_showcase_args() {
		if ( $this->_model['data_from'] === 'property_showcase' ) {
			$this->_showcase_args = array(
				'post_type' => self::$_slugs['property_showcase_cpt'],
			);
			if ( $this->_model['is_property_details_page'] ) {
				$this->_showcase_args['post__in'] = array( str_replace( 'PS', '', $this->_model['id'] ) );
				$this->_showcase_args['ignore_sticky_posts'] = true;
			}
			else {
				$this->_showcase_args = array_merge( $this->_showcase_args, array(
					'posts_per_page' => $this->_model['num_listings'],
					'offset' => !empty( $this->_model['page'] ) ? ( intval( $this->_model['page'] ) - 1 ) * intval( $this->_model['num_listings'] ) : 0,
					'order' => strtoupper( $this->_query_args['direction'] ),
				) );
				if ( $this->_query_args['sort_by'] === 'list_price' ) {
					$this->_showcase_args['meta_key'] = 'displetpropertyshowcase_price_value';
					$this->_showcase_args['orderby'] = 'meta_value';
				}
				else {
					$this->_showcase_args['orderby'] = 'post_date';
				}
				if ( !empty( $this->_showcase_meta_query ) ) {
					$this->_showcase_args['meta_query'] = $this->_showcase_meta_query;
				}
			}
		}
	}

	private function maybe_swap_search_fields() {
		if ( $this->_model['is_shortcode'] || $this->_model['is_widget'] ) {
			foreach ( self::$_search_fields as $legacy_search_field => $search_field ) {
				if ( $legacy_search_field !== $search_field && !empty( $this->_model[ $legacy_search_field ] ) ) {
					$this->_model[ $search_field ] = $this->_model[ $legacy_search_field ];
					unset( $this->_model[ $legacy_search_field ] );
				}
			}
		}
	}

	protected function prep_query() {
		$this->maybe_swap_search_fields();
		$this->build_query_args();
		$this->set_property_details_page_url();
		$this->set_endpoint();
	}

	private function set_endpoint() {
		if ( $this->_model['extended_stats'] ) {
			$this->_model['endpoint'] = 'extended_stats';
		}
	}

	private function set_property_details_page_url() {
		if ( $this->_model['data_from'] === 'api' || ( $this->_model['data_from'] === 'property_showcase' && !empty( self::$_options['use_pdp_for_showcase_details'] ) ) ) {
			if ( $this->_model['is_mobile_page'] ) {
				$this->_model['property_details_page_url'] = home_url( 'rets-mobile' );
			}
			else {
				$this->_model['property_details_page_url'] = get_permalink( self::$_options['property_details_page_id'] );
			}
		}
	}

	private function set_sort() {
		if ( !empty( $this->_model['sort_by'] ) && !empty( $this->_model['direction'] ) ) {
			$this->_query_args['sort_by'] = $this->_model['sort_by'];
			$this->_query_args['direction'] = $this->_model['direction'];
		}
		else {
			if ( ( $this->_model['is_widget'] || $this->_model['is_shortcode'] ) && !empty( $this->_model['sort'] ) ) {
				$sort = $this->_model['sort'];
			}
			else{
				$sort = self::$_options['listings_sort'];
			}
			if ( $sort === 'price-ascending' ) {
				$this->_query_args['sort_by'] = 'list_price';
				$this->_query_args['direction'] = 'asc';
			}
			else if ( $sort === 'list-date-ascending' ) {
				$this->_query_args['sort_by'] = 'list_date';
				$this->_query_args['direction'] = 'asc';
			}
			else if ( $sort === 'list-date-descending' ) {
				$this->_query_args['sort_by'] = 'list_date';
				$this->_query_args['direction'] = 'desc';
			}
			else {
				$this->_query_args['sort_by'] = 'list_price';
				$this->_query_args['direction'] = 'desc';
			}
		}
	}
}

?>