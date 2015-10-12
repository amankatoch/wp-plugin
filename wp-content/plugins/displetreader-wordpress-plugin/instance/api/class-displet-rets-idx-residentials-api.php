<?php

class DispletRetsIdxResidentialsApi extends DispletRetsIdxApi {
	public function __construct( $args = array() ) {
		parent::__construct( $this->parse_args( $args, $this->get_default_args() ), $this->get_int_args() );
		$this->get_query_args();
		$this->get_query_url();
		$this->_response = $this->query( 'GET' );
	}

	private function get_default_args() {
		return array(
			'endpoint' => 'search',
			'is_displet_api' => true,
			'num_listings' => false,
			'page' => false,
		);
	}

	private function get_displet_query_args() {
		$this->_model['query_args'] = array_merge( $this->_model['query_args'], array(
			'authentication_token' => self::$_options['displet_app_key'],
			'limit' => $this->_model['num_listings'],
			'page' => !empty( $this->_model['page'] ) ? $this->_model['page'] : false,
		) );
	}

	private function get_int_args() {
		return array(
			'num_listings',
			'page',
		);
	}

	private function get_oodle_key() {
		$remainder = time() % 3;
		if ( $remainder === 0 ) {
			return '0F35256B0FAC';
		}
		else if ( $remainder === 1 ) {
			return 'B9A2E1A6AB5F';
		}
		return '579B95506556';
	}

	private function get_oodle_query_args() {
		$this->_model['query_args'] = array_merge( $this->_model['query_args'], array(
			'attributes' => array(),
			'category' => !empty( self::$_options['oodle_category'] ) ? self::$_options['oodle_category'] : 'housing/sale',
			'format' => 'json',
			'image_sizes' => $this->_model['num_listings'] === 1 ? false : 'm',
			'jsoncallback' => 'none',
			'key' => $this->get_oodle_key(),
			'num' => $this->_model['num_listings'],
			'num_images' => $this->_model['num_listings'] === 1 ? false : '1',
			'q' => array(),
			'region' => !empty( self::$_options['oodle_region'] ) ? self::$_options['oodle_region'] : 'usa',
			'start' => !empty( $this->_model['page'] ) && !empty( $this->_model['num_listings'] ) ? $this->_model['page'] * $this->_model['num_listings'] : false,
		) );
	}

	private function get_query_args() {
		if ( $this->_model['is_displet_api'] ) {
			$this->get_displet_query_args();
		}
		else {
			$this->get_oodle_query_args();
			$this->translate_oodle_query_args();
		}
	}

	private function get_query_url() {
		if ( $this->_model['is_displet_api'] ) {
			$this->_query = trailingslashit( self::$_api_url ) . 'residentials/' . $this->_model['endpoint'];
		}
		else{
			$this->_query = 'http://api.oodle.com/api/v2/listings';
		}
	}

	public function get_residentials() {
		if ( !empty( $this->_response ) ) {
			if ( $this->_model['is_displet_api'] && !empty( $this->_response->results ) ) {
				$listings = $this->_response->results;
				$meta = $this->_response->meta;
			}
			else if ( !empty( $this->_response->listings ) ) {
				$listings = $this->_response->listings;
				$meta = $this->_response->meta;
			}
			else if ( !empty( $this->_response->count ) || $this->_response->count === 0 ) {
				return $this->_response->count;
			}
			$residentials = array(
				'listings' => $listings,
				'meta' => $this->_response->meta,
				'query_url' => $this->_query,
				'query_args' => array_filter( $this->_model['query_args'] ),
			);
			if ( !empty( $this->_response->stats_by_status ) ) {
				$residentials['stats_by_status'] = $this->_response->stats_by_status;
			}
			if ( !empty( $this->_response->error ) ) {
				$residentials['residentials_api_error'] = $this->_response->error;
			}
			return $residentials;
		}
		return false;
	}

	private function translate_oodle_attributes() {
		if ( !empty( $this->_model['query_args']['min_list_price'] ) || !empty( $this->_model['query_args']['max_list_price'] ) ) {
			if ( !empty( $this->_model['query_args']['min_list_price'] ) && !empty( $this->_model['query_args']['max_list_price'] ) ) {
				$this->_model['query_args']['attributes'][] = 'price_' . ( intval( $this->_model['query_args']['min_list_price'] ) * 1000 ) . '_' . ( intval( $this->_model['query_args']['max_list_price'] ) * 1000 );
			}
			else if ( !empty( $this->_model['query_args']['min_list_price'] ) ) {
				$this->_model['query_args']['attributes'][] = 'price_' . ( intval( $this->_model['query_args']['min_list_price'] ) * 1000 ) . '+';
			}
			else if ( !empty( $this->_model['query_args']['max_list_price'] ) ) {
				$this->_model['query_args']['attributes'][] = 'price_' . ( intval( $this->_model['query_args']['max_list_price'] ) * 1000 ) . '-';
			}
			unset( $this->_model['query_args']['min_list_price'] );
			unset( $this->_model['query_args']['max_list_price'] );
		}
		if ( !empty( $this->_model['query_args']['min_bedrooms'] ) ) {
			$this->_model['query_args']['attributes'][] = 'bedrooms_' . $this->_model['query_args']['min_bedrooms'] . '+';
			unset( $this->_model['query_args']['min_bedrooms'] );
		}
		if ( !empty( $this->_model['query_args']['max_bedrooms'] ) ) {
			$this->_model['query_args']['attributes'][] = 'bedrooms_' . $this->_model['query_args']['max_bedrooms'] . '-';
			unset( $this->_model['query_args']['max_bedrooms'] );
		}
		if ( !empty( $this->_model['query_args']['min_bathrooms'] ) ) {
			$this->_model['query_args']['attributes'][] = 'bathrooms_' . $this->_model['query_args']['min_bathrooms'] . '+';
			unset( $this->_model['query_args']['min_bathrooms'] );
		}
		if ( !empty( $this->_model['query_args']['max_bathrooms'] ) ) {
			$this->_model['query_args']['attributes'][] = 'bathrooms_' . $this->_model['query_args']['max_bathrooms'] . '-';
			unset( $this->_model['query_args']['max_bathrooms'] );
		}
		if ( !empty( $this->_model['query_args']['min_square_feet'] ) || !empty( $this->_model['query_args']['max_square_feet'] ) ) {
			if ( !empty( $this->_model['query_args']['min_square_feet'] ) && !empty( $this->_model['query_args']['max_square_feet'] ) ) {
				$this->_model['query_args']['attributes'][] = 'square_feet_' . $this->_model['query_args']['min_square_feet'] . '_' . $this->_model['query_args']['max_square_feet'];
			}
			else if ( !empty( $this->_model['query_args']['min_square_feet'] ) ) {
				$this->_model['query_args']['attributes'][] = 'square_feet_' . $this->_model['query_args']['min_square_feet'] . '+';
			}
			else if ( !empty( $this->_model['query_args']['max_square_feet'] ) ) {
				$this->_model['query_args']['attributes'][] = 'square_feet_' . $this->_model['query_args']['max_square_feet'] . '-';
			}
			unset( $this->_model['query_args']['min_square_feet'] );
			unset( $this->_model['query_args']['max_square_feet'] );
		}
		if ( !empty( $this->_model['query_args']['pool_on_property'] ) ) {
			if ( $this->_model['query_args']['pool_on_property'] === 'yes' ) {
				$this->_model['query_args']['attributes'][] = 'amenities_pool';
			}
			unset( $this->_model['query_args']['pool_on_property'] );
		}
		if ( !empty( $this->_model['query_args']['is_gated_community'] ) ) {
			if ( $this->_model['query_args']['is_gated_community'] === 'yes' ) {
				$this->_model['query_args']['attributes'][] = 'amenities_gated';
			}
			unset( $this->_model['query_args']['is_gated_community'] );
		}
		if ( !empty( $this->_model['query_args']['attributes'] ) ) {
			$this->_model['query_args']['attributes'] = implode( ',', $this->_model['query_args']['attributes'] );
		}
		else {
			$this->_model['query_args']['attributes'] = false;
		}
	}

	private function translate_oodle_category() {
		if ( !empty( $this->_model['query_args']['property_type'] ) ) {
			if ( !empty( $this->_model['query_args']['category'] ) ) {
				$property_type = strtolower( $this->_model['query_args']['property_type'] );
				// Available to housing/sale & housing/rent
				if ( $property_type === 'house' ) {
					$this->_model['query_args']['category'] .= '/home';
				}
				else if ( $property_type === 'condo' ) {
					$this->_model['query_args']['category'] .= '/condo';
				}
				else if ( $property_type === 'commercial' ) {
					$this->_model['query_args']['category'] .= '/commerical';
				}
				else if ( $property_type === 'mobile' ) {
					$this->_model['query_args']['category'] .= '/mobile';
				}
				else if ( $property_type === 'vacation' ) {
					$this->_model['query_args']['category'] .= '/vacation';
				}
				else if ( $property_type === 'other' ) {
					$this->_model['query_args']['category'] .= '/other';
				}
				else if ( $property_type === 'open_house' ) {
					$this->_model['query_args']['category'] .= '/open_house';
				}
				else if ( $property_type === 'storage' ) {
					$this->_model['query_args']['category'] .= '/storage';
				}
				// Available only to housing/sale
				else if ( $property_type === 'land' ) {
					$this->_model['query_args']['category'] = 'housing/sale/land';
				}
				else if ( $property_type === 'multi' ) {
					$this->_model['query_args']['category'] = 'housing/sale/multi_family';
				}
				else if ( $property_type === 'ranch' ) {
					$this->_model['query_args']['category'] = 'housing/sale/farm';
				}
				// Available only to housing/rent
				else if ( $property_type === 'lease' ) {
					$this->_model['query_args']['category'] = 'housing/rent';
				}
				else if ( $property_type === 'apartment' ) {
					$this->_model['query_args']['category'] = 'housing/rent/apartment';
				}
				else if ( $property_type === 'garage' ) {
					$this->_model['query_args']['category'] = 'housing/rent/garage';
				}
				else if ( $property_type === 'roommates' ) {
					$this->_model['query_args']['category'] = 'housing/rent/roommates';
				}
				else if ( $property_type === 'short_term' ) {
					$this->_model['query_args']['category'] = 'housing/rent/short_term';
				}
			}
			unset( $this->_model['query_args']['property_type'] );
		}
	}

	private function translate_oodle_keywords() {
		if ( !empty( $this->_model['query_args']['id'] ) ) {
			$this->_model['query_args']['q'][] = $this->_model['query_args']['id'];
			unset( $this->_model['query_args']['id'] );
		}
		if ( !empty( $this->_model['query_args']['subdivision'] ) ) {
			$this->_model['query_args']['q'][] = $this->_model['query_args']['subdivision'];
			unset( $this->_model['query_args']['subdivision'] );
		}
		if ( !empty( $this->_model['query_args']['keyword'] ) ) {
			$this->_model['query_args']['q'][] = $this->_model['query_args']['keyword'];
			unset( $this->_model['query_args']['keyword'] );
		}
		if ( !empty( $this->_model['query_args']['q'] ) ) {
			$this->_model['query_args']['q'] = implode( ',', $this->_model['query_args']['q'] );
		}
		else {
			$this->_model['query_args']['q'] = false;
		}
	}

	private function translate_oodle_location() {
		if ( !empty( $this->_model['query_args']['area'] ) ) {
			$this->_model['query_args']['location'] = $this->_model['query_args']['area'];
			$this->_model['query_args']['radius'] = '0';
			unset( $this->_model['query_args']['area'] );
		}
		if ( !empty( $this->_model['query_args']['area_mls_defined'] ) ) {
			$this->_model['query_args']['location'] = $this->_model['query_args']['area_mls_defined'];
			$this->_model['query_args']['radius'] = '0';
			unset( $this->_model['query_args']['area_mls_defined'] );
		}
		if ( !empty( $this->_model['query_args']['city'] ) ) {
			$this->_model['query_args']['location'] = $this->_model['query_args']['city'];
			$this->_model['query_args']['radius'] = '0';
			unset( $this->_model['query_args']['city'] );
		}
		if ( !empty( $this->_model['query_args']['zip'] ) ) {
			$this->_model['query_args']['location'] = $this->_model['query_args']['zip'];
			$this->_model['query_args']['radius'] = '0';
			unset( $this->_model['query_args']['zip'] );
		}
	}

	private function translate_oodle_query_args() {
		$this->translate_oodle_attributes();
		$this->translate_oodle_category();
		$this->translate_oodle_keywords();
		$this->translate_oodle_location();
		$this->translate_oodle_sort();
	}

	private function translate_oodle_sort() {
		if ( !empty( $this->_model['query_args']['sort_by'] ) || !empty( $this->_model['query_args']['direction'] ) ) {
			if ( $this->_model['query_args']['sort_by'] === 'list_price' && $this->_model['query_args']['direction'] === 'desc' ) {
				$this->_model['query_args']['sort'] = 'price_reverse';
			}
			else if ( $this->_model['query_args']['sort_by'] === 'list_date' ) {
				if ( $this->_model['query_args']['direction'] === 'desc' ) {
					$this->_model['query_args']['sort'] = 'ctime_reverse';
				}
				else {
					$this->_model['query_args']['sort'] = 'ctime';
				}
			}
			unset( $this->_model['query_args']['sort_by'] );
			unset( $this->_model['query_args']['direction'] );
		}
		if ( empty( $this->_model['query_args']['sort'] ) ) {
			$this->_model['query_args']['sort'] = 'price';
		}
	}
}

?>