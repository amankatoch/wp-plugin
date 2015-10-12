<?php

class DispletRetsIdxTemplatesModel extends DispletRetsIdxPlugin {
	protected function build_model() {
		$this->set_count();
		$this->set_disclaimer();
		$this->maybe_set_pagination_urls();
		$this->maybe_filter_orientation();
		$this->maybe_set_max_results_message();
		$this->maybe_set_price_navigation();
		$this->maybe_set_property_types();
		$this->maybe_set_sort_options();
		$this->maybe_globalize();
	}

	public function get_model() {
		return $this->_model;
	}

	private function maybe_filter_orientation() {
		if ( $this->_model['is_mobile_page'] && $this->_model['orientation'] === 'gallery' ) {
			$this->_model['orientation'] = 'list';
		}
	}

	private function maybe_globalize() {
		if ( $this->_model['is_mobile_page'] ) {
			global $displetretsidx_model;
			$displetretsidx_model = $this->_model;
		}
	}

	private function maybe_set_max_results_message() {
		if ( $this->_model['data_from'] !== 'property_showcase' && !$this->_model['is_property_details_page'] && $this->_model['show_listings'] !== 'no' && !empty( self::$_options['results_limit'] ) && $this->_model['count'] > intval( self::$_options['results_limit'] ) ) {
			$this->_model['results_limit_message'] = 'Only ' . self::$_options['results_limit'] . ' properties may be displayed per search. To see all results, please narrow your search criteria.';
		}
	}

	private function maybe_set_page_urls( $page_url ) {
		if ( !empty( self::$_options['use_numbered_pagination'] ) ) {
			$this->_model['page_urls'] = DispletRetsIdxUtilities::get_pagination_urls( array(
				'count' => $this->_model['meta']->count,
				'current_page' => $this->_model['page'],
				'num_per_page' => $this->_model['num_listings'],
				'pre_page_number_url_content' => 'page/',
				'url' => trailingslashit( $page_url ),
			) );
		}
	}

	private function maybe_set_pagination_urls() {
		if ( $this->_model['is_partial_address_page'] || $this->_model['is_search_results_page'] || $this->_model['is_shortcode'] ) {
			if ( !empty( $this->_model['canonical'] ) ) {
				$page_url = trailingslashit( $this->_model['canonical'] );
			}
			else{
				$page_url = trailingslashit( get_permalink() );
			}
			if ( $this->_model['meta']->count == $this->_model['meta']->last ) {
				$last_page_of_listings = floor( intval( $this->_model['meta']->count ) / $this->_model['num_listings'] );
				if ( !empty( $last_page_of_listings ) ) {
					$this->_model['previous_page_url'] = $page_url . 'page/' . $last_page_of_listings;
				}
				else{
					$this->_model['previous_page_url'] = $page_url;
				}
				$this->_model['next_page_url'] = $page_url . '#next';
			}
			else if ( $this->_model['page'] ) {
				$next_page_id = $this->_model['page'] + 1;
				$previous_page_id = $this->_model['page'] - 1;
				if ( $this->_model['page'] < 2 ) {
					$previous_page = '#previous';
				}
				else{
					$previous_page = 'page/' . $previous_page_id;
				}
				$next_page = 'page/' . $next_page_id;
				$this->_model['previous_page_url'] = $page_url . $previous_page;
				$this->_model['next_page_url'] = $page_url . $next_page;
			}
			else{
				$this->_model['previous_page_url'] = $page_url . '#previous';
				$this->_model['next_page_url'] = $page_url . 'page/2';
			}
			$this->maybe_set_page_urls( $page_url );
		}
	}

	private function maybe_set_price_navigation() {
		if ( $this->_model['data_from'] !== 'property_showcase' && $this->_model['is_displet_api'] && !$this->_model['is_property_details_page'] && !$this->_model['is_search_results_page'] && ( $this->_model['count'] > 9 || $this->_model['layout'] == 'table' ) && !empty( $this->_model['price_navigation'] ) && $this->_model['price_navigation'] !== 'no' && $this->_model['show_listings'] !== 'no' && !empty( $this->_model['meta']->list_price_min ) && !empty( $this->_model['meta']->list_price_max ) ) {
			if ( !empty( $this->_model['price_navigation_prices'] ) ) {
				$all_price_points = array();
				$price_points_as_thousands = array_map( 'trim', explode( ',', $this->_model['price_navigation_prices'] ) );
				if ( !empty( $price_points_as_thousands ) ) {
					foreach ( $price_points_as_thousands as $price ) {
						$all_price_points[] = intval( $price ) * 1000;
					}
				}
			}
			else {
				$number_of_navs = ( intval( $this->_model['meta']->count ) > 24 ) ? 7 : 4;
				$price_min = intval( $this->_model['meta']->list_price_min );
				$price_max = intval( $this->_model['meta']->list_price_max );
				$price_segment = intval( ( $price_max - $price_min ) / $number_of_navs );
				for ( $i = ( $price_min + $price_segment ); $i <= $price_max; $i += $price_segment ) {
					if ( $i > 1000000 ) {
						$price_round = 250000;
					}
					else if ( $i > 500000 ) {
						$price_round = 100000;
					}
					else {
						$price_round = 50000;
					}
					if ( $i == ( $price_min + $price_segment ) ) {
						$all_price_points[] = ceil( $i / $price_round ) * $price_round;
					}
					else if ( $price_max < ( $i + $price_segment ) ) {
						$all_price_points[] = floor( $i / $price_round ) * $price_round;
					}
					else{
						$all_price_points[] = round( $i / $price_round ) * $price_round;
					}
				}
			}
			$price_points = array_unique( $all_price_points );
			if ( !empty( $price_points ) ) {
				$previous_price_point = false;
				$first = true;
				foreach ( $price_points as $price_point ) {
					if ( $first ) {
						$first = false;
						$min = 0;
						$max = $price_point;
					}
					else {
						$min = $previous_price_point;
						$max = $price_point;
					}
					$this->_model['price_points'][] = array(
						'min' => $min,
						'max' => $max,
					);
					$previous_price_point = $price_point;
				}
				if ( !empty( $previous_price_point ) ) {
					$this->_model['price_points'][] = array(
						'min' => $previous_price_point,
						'max' => 999999999,
					);
				}
			}
		}
	}

	private function maybe_set_property_types() {
		if ( $this->_model['data_from'] !== 'property_showcase' && !$this->_model['is_property_details_page'] && ( $this->_model['count'] > 9 || $this->_model['layout'] == 'table' ) && ( !empty( $this->_model['property_type_navigation'] ) || !empty( $this->_model['property_type_sorting'] ) ) ) {
			$property_types = array();
			if ( !empty( $this->_model['property_type'] ) ){
				$model_property_types = explode( ',', $this->_model['property_type'] );
				if ( count( $model_property_types ) > 1 ) {
					foreach ( $model_property_types as $property_type ) {
						$key = strtolower( trim( $property_type ) );
						$property_types[ $key ] = $property_type;
					}
				}
			}
			else{
				$displetretsidx_field_option = DispletRetsIdxOptionsController::get_option( 'fields' );
				if ( !empty( $displetretsidx_field_option['property_type'] ) ) {
					foreach ( $displetretsidx_field_option['property_type'] as $property_type ) {
						$key = strtolower( $property_type );
						$property_types[ $key ] = $property_type;
					}
				}
			}
			$filter_used = false;
			if ( !empty( $this->_options['property_type_include_filter'] ) ) {
				foreach ( $this->_options['property_type_include_filter'] as $key => $value ) {
					$new_key = strtolower( $key );
					$filter_property_types[ $new_key ] = $value;
					if ( $value != 'false' ) {
						$filter_used = true;
					}
				}
			}
			if ( !empty( $property_types ) && !empty( $filter_used ) ) {
				foreach ( $property_types as $property_type_key => $value ) {
					if ( isset( $filter_property_types[ $property_type_key ] ) && $filter_property_types[ $property_type_key ] == 'false' ){
						unset( $property_types[ $property_type_key ] );
					}
				}
			}
			$this->_model['property_types'] = $property_types;
			$this->_model['property_type_points'] = array_values( $property_types );
		}
	}

	private function maybe_set_sort_options() {
		if ( !$this->_model['is_property_details_page'] && $this->_model['show_listings'] !== 'no' ) {
			$this->_model['sort_options'] =
				'<option class="displet-font-color-light" value="">Sort By</option>
				<option class="displet-font-color-light" value="price-ascending">Price Low to High</option>
				<option class="displet-font-color-light" value="price-descending">Price High to Low</option>
				<option class="displet-font-color-light" value="date-descending">Newest</option>
				<option class="displet-font-color-light" value="date-ascending">Oldest</option>';
			if (
					$this->_model['data_from'] !== 'property_showcase' &&
					$this->_model['is_displet_api'] &&
					!$this->_model['is_search_results_page'] &&
					!empty( $this->_model['property_type_sorting'] ) &&
					$this->_model['property_type_sorting'] !== 'no' &&
					!empty( $this->_model['property_types'] )
				)
			{
				$this->_model['sort_options'] .= '<option class="displet-font-color-light" value="all">All Property Types</option>';
				foreach ( $this->_model['property_types'] as $property_type ) {
					$this->_model['sort_options'] .= '<option class="displet-font-color-light" value="' . $property_type . '">' . $property_type . '</option>';
				}
			}
		}
	}

	private function set_disclaimer() {
		$this->_model['options']['disclaimer'] = '';
		if ( !empty( self::$_options['disclaimer_image'] ) ) {
			$this->_model['options']['disclaimer'] .= '<img class="displet-mls-logo" src="' . self::$_options['disclaimer_image'] . '" />';
		}
		if ( !empty( self::$_options['disclaimer'] ) ) {
			$this->_model['options']['disclaimer'] .= str_replace( '%%date_last_updated%%', $this->_model['last_updated'], self::$_options['disclaimer'] );
		}
	}

	private function set_count() {
		$this->_model['count'] = !empty( $this->_model['meta']->count ) ? $this->_model['meta']->count : 0;
	}
}

?>