<?php

class DispletRetsIdxResidentialsController extends DispletRetsIdxResidentialsModel {
	private function filter_fields( $listing ) {
		$ugly_fields = array(
			'appliances_equipment',
			'area_amenities',
			'basement_description',
			'den_description',
			'dining_description',
			'exterior_features',
			'family_room_description',
			'fence_description',
			'fireplace_description',
			'floor',
			'garage_description',
			'green_features',
			'interior_features',
			'laundry_location',
			'living_description',
			'lot_description',
			'parking_description',
			'pool_description',
			'rooms',
			'waterfront_description',
		);
		foreach ( $ugly_fields as $field ) {
			if ( !empty( $listing->{ $field } ) ) {
				$listing->{ $field } = DispletRetsIdxUtilities::add_spaces_after_commas( $listing->{ $field } );
			}
		}
	}

	private function get_listing_classes( $listing, $i, $for_phony_listing = false ) {
		$listing->classes = new stdClass();
		if ( $for_phony_listing ) {
			if ( $this->_model['layout'] === 'table' ) {
				$listing->classes->table_view = 'displet-listing displet-listing-' . $i . ' displet-none displet-current';
			}
			else{
				$listing->classes->gallery_view = 'displet-listing displet-listing-' . $i . ' displet-none';
				$listing->classes->list_view = 'displet-listing displet-listing-' . $i . ' displet-none';
				if ( self::$_options['listings_orientation'] == 'gallery' ) {
					$listing->classes->gallery_view .= ' displet-current';
				}
				else if ( self::$_options['listings_orientation'] == 'list' ) {
					$listing->classes->list_view .= ' displet-current';
				}
			}
		}
		else {
			if ( $this->_model['layout'] === 'table' ) {
				$listing->classes->table_view = 'displet-listing displet-listing-' . $i . ' displet-showing displet-current';
			}
			else{
				$listing->classes->gallery_view = 'displet-listing displet-listing-' . $i . ' displet-showing';
				$listing->classes->list_view = 'displet-listing displet-listing-' . $i . ' displet-showing';
				if ( self::$_options['listings_orientation'] == 'gallery' && !$this->_model['is_mobile_page'] ) {
					$listing->classes->gallery_view .= ' displet-current';
				}
				else if ( self::$_options['listings_orientation'] == 'list' || ( $this->_model['is_mobile_page'] && self::$_options['listings_orientation'] != 'map' ) ) {
					$listing->classes->list_view .= ' displet-current';
				}
			}
		}
	}

	public static function get_map_markup( $map_markup, $scroll_wheel = true ) {
		return $scroll_wheel ? $map_markup : str_replace( '><', ' displet-scroll="false"><', $map_markup );
	}

	private function get_maps( $listing ) {
		if ( $listing->latitude && $listing->longitude ) {
			$listing->maps = array(
				'birds_eye' => '<div id="displet-birds-eye-canvas"></div>',
				'map' => '<div id="displet-map-canvas"></div>',
				'street_view' => '<div id="displet-street-view-canvas"></div>'
			);
		}
		$listing->latitude_display = $listing->latitude;
		$listing->longitude_display = $listing->longitude;
	}

	private function get_permalink( $listing ) {
		if ( $this->_model['data_from'] === 'property_showcase' && empty( self::$_options['use_pdp_for_showcase_details'] ) ) {
			$listing->permalink = get_permalink( $listing->ID );
		}
		else {
			if ( $this->_model['data_from'] === 'property_showcase' ) {
				$listing_id = 'PS' . $listing->ID;
			}
			else {
				$listing_id = $listing->id;
			}
			if ( !empty( $listing_id ) && !empty( $this->_model['property_details_page_url'] ) ) {
				$listing->permalink = DispletRetsIdxUtilities::get_listing_permalink( array(
					'page_url' => $this->_model['property_details_page_url'],
					'state' => !empty( $listing->state ) ? $listing->state : 'CAN',
					'city' => !empty( $listing->city ) ? $listing->city : 'City',
					'zip' => !empty( $listing->zip ) ? $listing->zip : '00000',
					'id' => $listing_id,
					'address' => $listing->address,
					'price' => $listing->list_price,
				) );
			}
		}
	}

	private function get_residentials_from_property_showcase() {
		return array(
			'meta' => false,
			'listings' => false,
			'wp_query' => new WP_Query( $this->_showcase_args ),
		);
	}

	public static function get_property_showcase_listings_ajax() {
		check_ajax_referer( 'displet_get_property_showcase_listings_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_get_property_showcase_listings_request' &&!empty( $_POST['residential_args'] ) ) {
			foreach ( $_POST['residential_args'] as $key => $value ) {
				if ( $value === 'true' ) {
					$_POST['residential_args'][ $key ] = true;
				}
				else if ( $value === 'false' ) {
					$_POST['residential_args'][ $key ] = false;
				}
			}
			if ( !empty( $_POST['residential_args']['is_shortcode'] ) ) {
				$_POST['residential_args']['is_shortcode'] = false;
			}
			$residentials = new DispletRetsIdxResidentials( $_POST['residential_args'] );
			$listings = $residentials->get_residentials();
			if ( !empty( $listings ) ) {
				echo json_encode( $listings );
			}
			die();
		}
		echo 'Error';
		die();
	}

	private function maybe_include_phony_listings( $i ) {
		if ( ( $this->_model['is_partial_address_page'] || $this->_model['is_search_results_page'] || $this->_model['is_shortcode'] ) ) {
			$num_listings = $this->_model['is_search_results_page'] ? 50 : $this->_model['num_listings'];
			if ( $i <= $num_listings ) {
				for ( $j = $i; $j <= $num_listings; $j++ ) {
					$phony_listing = new stdClass();
					$this->get_listing_classes( $phony_listing, $j, true );
					$this->_residentials['listings'][] = $phony_listing;
				}
			}
		}
	}

	private function maybe_limit_listings() {
		if ( $this->_model['data_from'] !== 'property_showcase' && !empty( $this->_residentials['listings'] ) && !empty( self::$_options['results_limit'] ) && !$this->_model['is_property_details_page'] ) {
			$max_count = intval( self::$_options['results_limit'] );
			if ( $this->_residentials['meta']->last > $max_count ) {
				$this->_residentials['meta']->last = $max_count;
			}
			$limited_listings = array();
			$current_count = intval( $this->_residentials['meta']->first );
			$i = 0;
			foreach ( $this->_residentials['listings'] as $listing ) {
				if ( ( $current_count + $i ) <= $max_count ) {
					$limited_listings[] = $listing;
				}
				$i++;
			}
			$this->_residentials['listings'] = $limited_listings;
		}
	}

	private function maybe_remove_unincluded_fields( $listing ) {
		if ( $this->_model['is_property_details_page'] ) {
			$option_name_listing_field_pairs = array(
				'include_modified' => 'modified',
				'include_list_date' => 'list_date',
				'include_listing_office_pdp' => 'listing_office_name',
				'include_listing_agent_pdp' => 'listing_agent_name',
				'include_listing_agent_id' => 'listing_agent_id',
				'include_listing_office_id' => 'listing_office_id',
				'include_foreclosure' => 'is_foreclosure',
				'include_short_sale' => 'short_sale',
				'include_longitude' => 'longitude_display',
				'include_latitude' => 'latitude_display',
				'include_feed_image_trans_date' => 'feed_image_trans_date',
				'include_sysid' => 'sysid',
				'include_price_per_square_feet' => 'price_per_sq_feet'
			 );
		}
		else if ( $this->_model['is_partial_address_page'] || $this->_model['is_search_results_page'] || $this->_model['is_shortcode'] || $this->_model['is_widget'] ) {
			$option_name_listing_field_pairs = array(
				'include_listing_agent' => 'listing_agent_name',
				'include_listing_office' => 'listing_office_name',
			 );
		}
		if ( !empty( $option_name_listing_field_pairs ) ) {
			foreach ( $option_name_listing_field_pairs as $option_name => $field ) {
				if ( empty( self::$_options[ $option_name ] ) ) {
					unset( $listing->{ $field } );
				}
			}
		}
	}

	private function normalize_displet_listing( $listing ) {
		if ( !empty( self::$_options['address_format'] ) ) {
			$listing->address = self::$_options['address_format'];
			$listing->address = str_replace( '%%street_number%%', $listing->street_number, $listing->address );
			$listing->address = str_replace( '%%street_name%%', $listing->street_name, $listing->address );
			$listing->address = str_replace( '%%street_pre_direction%%', $listing->street_pre_direction, $listing->address );
			$listing->address = str_replace( '%%street_post_direction%%', $listing->street_post_dir, $listing->address );
			$listing->address = str_replace( '%%unit%%', $listing->unit, $listing->address );
			if ( empty( $listing->unit ) ) {
				$listing->address = str_replace( '#', '', $listing->address );
			}
			$listing->address = trim( $listing->address );
			$listing->address = str_replace( '   ', ' ', $listing->address );
			$listing->address = str_replace( '  ', ' ', $listing->address );
		}
		else{
			$listing->address = $listing->street_number . ' ' . $listing->street_pre_direction . ' '  . $listing->street_name . ' ' . $listing->street_post_dir;
			if ( !empty( $listing->unit ) ) {
				$listing->address .= ' #' . $listing->unit;
			}
			$listing->address = trim( $listing->address );
			$listing->address = str_replace( '  ', ' ', $listing->address );
		}
		$half_baths = ( !empty( $listing->half_baths ) ) ? '/' . $listing->half_baths : '';
		$listing->bathrooms = $listing->full_baths . $half_baths;
	}

	private function normalize_listing( $listing, $i ) {
		if ( $this->_model['data_from'] === 'property_showcase' ) {
			$this->normalize_showcase_listing( $listing );
		}
		else {
			if ( $this->_model['is_displet_api'] ) {
				$this->normalize_displet_listing( $listing );
			}
			else{
				$this->normalize_oodle_listing( $listing );
			}
		}
		$this->get_permalink( $listing );
		if ( $this->_model['is_property_details_page'] ) {
			$this->get_maps( $listing );
			$this->filter_fields( $listing );
		}
		else if ( $this->_model['is_partial_address_page'] || $this->_model['is_search_results_page'] || $this->_model['is_shortcode'] ) {
			$this->get_listing_classes( $listing, $i );
		}
		$this->maybe_remove_unincluded_fields( $listing );
	}

	private function normalize_listings() {
		$i = 1;
		if ( $this->_model['data_from'] === 'property_showcase' ) {
			$this->_residentials['listings'] = $this->_residentials['wp_query']->posts;
			unset( $this->_residentials['wp_query'] );
		}
		if ( !empty( $this->_residentials['listings'] ) ) {
			foreach ( $this->_residentials['listings'] as $listing ) {
				$this->normalize_listing( $listing, $i );
				$i++;
			}
		}
		$this->maybe_include_phony_listings( $i );
	}

	private function normalize_oodle_listing( $listing ) {
		//$listing->id = $listing->id;
		$listing->list_price = $listing->attributes->price;
		$listing->address = $listing->location->address;
		$listing->city = $listing->location->name;
		$listing->state = $listing->location->state;
		$listing->zip = $listing->location->zip;
		$listing->num_bedrooms = $listing->attributes->bedrooms;
		$listing->bathrooms = $listing->attributes->bathrooms;
		$listing->square_feet = $listing->attributes->square_feet;
		$listing->property_type = str_replace( 'Houses', 'House', str_replace( 'Condos, Townhouses & Apts for Sale', 'Condo / Townhouse / Apt', $listing->category->name ) );
		$listing->mls_number = $listing->attributes->mls_id;
		$listing->internet_remarks = $listing->body;
		$listing->image_urls = new stdClass();
		$listing->image_urls->primary_big = $listing->images[0]->src;
		// Swap phones, emails and URLs from description
		if ( !empty( $listing->internet_remarks ) ) {
			$phone = '/([0-9]{3})[-. ]?([0-9]{4})/';
			$email = '/([\S]+)@([\S]+)/';
			$website = '/([\S]+)\.com([\S]+)/';
			$new_body = preg_replace( $phone, 'XXX-XXXX', $listing->internet_remarks );
			$new_body = preg_replace( $email, 'XXXX@XXXX', $new_body );
			$new_body = preg_replace( $website, 'http://.com', $new_body );
			$listing->internet_remarks = $new_body;
		}
		if ( $this->_model['is_property_details_page'] ) {
			$listing->latitude = $listing->location->latitude;
			$listing->longitude = $listing->location->longitude;
			$listing->year_built = $listing->attributes->year;
			$listing->area_amenities = $listing->attributes->amenities;
			// Get largest of each photo
			if ( is_array( $listing->images ) ) {
				$images_array = array();
				// Get largest of each image
				for ( $j = $i - 1; $j < count( $listing->images ); $j++ ) {
					if ( $listing->images[$j]->num == $last_num || $j == count( $listing->images ) - 1 ) {
						$last_src = $listing->images[$j]->src;
					}
					if ( ( $listing->images[$j]->num > $last_num || $j == count( $listing->images ) - 1 ) && !empty( $last_src ) ) {
						$images_array[] = $last_src;
					}
					$last_num = $listing->images[$j]->num;
				}
				$listing->image_urls = new stdClass();
				$listing->image_urls->all_big = $images_array;
				$listing->image_urls->all_thumb = $images_array;
				$listing->image_urls->primary_big = $images_array[$i];
				$listing->image_urls->primary_thumb = $images_array[$i];
			}
		}
	}

	private function normalize_showcase_listing( $listing ) {
		foreach ( self::$_property_showcase_residential_fields as $field => $meta ) {
			if ( !empty( $listing->{$meta} ) ) {
				$listing->{ $field } = $listing->{ $meta };
			}
		}
		if ( !empty( $listing->bathrooms ) ) {
			$listing->bathrooms = DispletRetsIdxUtilities::get_numeric_value( $listing->bathrooms );
		}
		if ( !empty( $listing->internet_remarks ) ) {
			if ( $this->_model['is_property_details_page'] ) {
				$listing->internet_remarks = apply_filters( 'the_content', $listing->internet_remarks );
			}
			else {
				$listing->internet_remarks = strip_tags( $listing->internet_remarks );
			}
		}
		$listing->image_urls = new stdClass();
		if ( $this->_model['is_property_details_page'] ) {
			$listing->image_urls->all_big = DispletRetsIdxUtilities::get_post_thumbnail_urls( $listing->ID );
		}
		else {
			$listing->image_urls->primary_big = DispletRetsIdxUtilities::get_post_thubmnail_src( $listing->ID );
		}
		return $listing;
	}

	private function maybe_normalize_meta() {
		if ( $this->_model['data_from'] === 'property_showcase' ) {
			if ( !empty( $this->_residentials['wp_query'] ) ) {
				$this->_residentials['meta'] = new stdClass();
				$this->_residentials['meta']->first = $this->_showcase_args['offset'] + 1;
				$this->_residentials['meta']->last = $this->_showcase_args['offset'] + $this->_residentials['wp_query']->post_count;
				$this->_residentials['meta']->count = $this->_residentials['wp_query']->found_posts;
			}
		}
		else if ( !empty( $this->_residentials['meta'] ) ) {
			if ( $this->_model['is_displet_api'] ) {
				$this->_residentials['meta']->first = $this->_model['num_listings'] * intval( $this->_residentials['meta']->page ) - $this->_model['num_listings'] + 1;
				$this->_residentials['meta']->last = intval( $this->_residentials['meta']->first ) + $this->_model['num_listings'] - 1;
				if ( $this->_residentials['meta']->last > $this->_residentials['meta']->count ) {
					$this->_residentials['meta']->last = $this->_residentials['meta']->count;
				}
			}
			else {
				$this->_residentials['meta']->count = $this->_residentials['meta']->total;
			}
		}
	}

	protected function normalize_residentials() {
		$this->maybe_normalize_meta();
		$this->maybe_limit_listings();
		$this->normalize_listings();
	}

	protected function query_residentials( $endpoint = false ) {
		$model = $this->_model;
		$model['query_args'] = $this->_query_args;
		if ( $this->_model['data_from'] === 'api' ) {
			if ( !empty( $endpoint ) ) {
				$model['endpoint'] = $endpoint;
			}
			$api = new DispletRetsIdxResidentialsApi( $model );
			$this->_residentials = $api->get_residentials();
		}
		else if ( $this->_model['data_from'] === 'property_showcase' ) {
			$this->_residentials = $this->get_residentials_from_property_showcase();
			$this->save_model_as_query_args();
		}
		$this->save_data_from();
	}

	protected function save_data_from() {
		if ( !empty( $this->_residentials ) && is_array( $this->_residentials ) ) {
			$this->_residentials['data_from'] = $this->_model['data_from'];
		}
	}

	private function save_model_as_query_args() {
		$this->_model['sort_by'] = $this->_query_args['sort_by'];
		$this->_model['direction'] = $this->_query_args['direction'];
		$this->_residentials['query_args'] = $this->_model;
		$this->_residentials['query_url'] = http_build_query( $this->_showcase_args );
	}
}

?>