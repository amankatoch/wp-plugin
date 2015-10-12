<?php

class DispletRetsIdxUtilities {
	/*****************************
	/ String manipulation
	*****************************/

	public static function remove_url_prefixes( $string ) {
		return str_replace( array( 'http://www.', 'https://www.', 'http://', 'https://' ), '', $string );
	}

	public static function remove_url_suffixes( $string ) {
		if ( strpos( $string, '/' ) !== false ) {
			return substr( $string, 0, strpos( $string, '/' ) );
		}
		return $string;
	}

	public static function empty_excluding_zero( $string ) {
		if ( $string === 0 || $string === '0' ) {
			return false;
		}
		return empty( $string );
	}

	public static function get_domainless_url( $string ) {
		$unprefixed = self::remove_url_prefixes( $string );
		if ( strpos( $unprefixed, '/' ) !== false ) {
			return substr( $unprefixed, strpos( $unprefixed, '/' ), strlen( $unprefixed ) - 1 );
		}
		return $unprefixed;
	}

	public static function get_listing_permalink( $args ) {
		extract( wp_parse_args( $args, array(
			'page_url' => false,
			'state' => false,
			'city' => false,
			'zip' => false,
			'id' => false,
			'address' => false,
			'price' => false,
		 ) ) );
		if ( !empty( $page_url ) ) {
			$uri_vars = array(
				$state,
				$city,
				$zip,
				$id,
				$address,
			 );
			$permalink = trailingslashit( $page_url );
			foreach ( $uri_vars as $uri_var ) {
				if ( !empty( $uri_var ) ) {
					$permalink .= preg_replace( '/[^\w-]+/', '', preg_replace( '/[ ]+/', '-', $uri_var ) ) . '/';
				}
			}
			if ( !empty( $price ) ) {
				global $displetretsidx_option;
				if ( !empty( $displetretsidx_option['add_price_to_url'] ) ) {
					$permalink .= preg_replace( '/[\D]+/', '', $price ) . '/';
				}
			}
			return rtrim( $permalink, '/' );
		}
	}

	public static function get_numeric_value( $string ) {
		return preg_replace( '/[^0-9.]/', '', $string );
	}

	public static function add_spaces_after_commas( $string ) {
		return preg_replace( '/(?<!\d),(?=\S)|,(?!(\d{3})|\s)/', ', ', $string );
	}

	public static function get_address_from_property_details_suffix( $string ) {
		if ( !empty( $string ) ) {
			preg_match( '~([^/]+)/?([^/]*)/?([^/]*)/?([^/]*)/?([^/]*)/?~', $string, $matches );
			if ( !empty( $matches[5] ) ) {
				return array(
					'state' => $matches[1],
					'city' => $matches[2],
					'zip' => $matches[3],
					'address' => str_replace( '-', ' ', $matches[5] ),
				);
			}
		}
		return false;
	}

	public static function get_phone_url( $phone_number ) {
		if ( !empty( $phone_number ) ) {
			return 'tel:+1' . preg_replace( '/[\D]/', '', $phone_number );
		}
	}

	public static function get_email_url( $email ) {
		if ( !empty( $email ) ) {
			return 'mailto:' . $email;
		}
	}

	public static function not_empty_excluding_zero( $string ) {
		if ( $string === 0 || $string === '0' ) {
			return true;
		}
		return !empty( $string );
	}

	/*****************************
	/ Array Map
	*****************************/

	public static function increase_by_three_orders_of_magnitude( $number ) {
		if ( is_numeric( $number ) ) {
			return intval( $number ) * 1000;
		}
	}

	public static function reduce_by_three_orders_of_magnitude( $number ) {
		if ( is_numeric( $number ) ) {
			return intval( intval( $number ) / 1000 );
		}
	}

	public static function remove_non_numeric_characters( $string ) {
		return preg_replace( '/[^\d.]*/', '', $string );
	}

	/*****************************
	/ Array Filter
	*****************************/

	public static function remove_false_as_string( $string ) {
		if ( $string === 'false' ) {
			return false;
		}
		return $string;
	}

	/*****************************
	/ Option related
	*****************************/

	public static function is_new_api_key( $original_option, $new_option ) {
		return self::is_option_new( 'displet_app_key', $original_option, $new_option );
	}

	public static function is_new_api_token( $original_option, $new_option ) {
		return self::is_option_new( 'displet_app_token', $original_option, $new_option );
	}

	public static function is_new_email_address( $original_option, $new_option ) {
		return self::is_option_new( 'email_from_address', $original_option, $new_option );
	}

	public static function email_activity_has_changed( $original_option, $new_option ) {
		return self::has_option_changed( 'email_activity', $original_option, $new_option );
	}

	public static function is_option_new( $array_key, $original_option, $new_option ) {
		if ( !empty( $new_option[$array_key] ) && self::has_option_changed( $array_key, $original_option, $new_option ) ) {
			return true;
		}
		return false;
	}

	public static function has_option_changed( $array_key, $original_option, $new_option ) {
		if ( $new_option[$array_key] !== $original_option[$array_key] ) {
			return true;
		}
		return false;
	}

	public static function get_widget_area( $slug, $name, $hint = true ) {
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( $slug ) ) {
			if ( $hint && current_user_can( 'manage_options' ) ) {
				echo 'Insert Displet Search Field widgets into the ' . $name . ' widget area on your <a href="' . admin_url( 'widgets.php' ) . '">Widgets page</a>.';
			}
		}
	}

	/*****************************
	/ Miscellaneous
	*****************************/

	public static function get_select_options( $options, $label = '', $label_value = '', $append = '', $prepend = '', $options_are_keyed = false ) {
		$html = '';
		if ( !empty( $options ) && is_array( $options ) ) {
			if ( !empty( $label ) ) {
				$html .= '<option value="' . $label_value . '">' . $label . '</option>' . PHP_EOL;
			}
			foreach ( $options as $key => $value ) {
				$option_key = $options_are_keyed ? $key : $value;
				$html .= '<option value="' . $option_key . '">' . $prepend . $value . $append . '</option>' . PHP_EOL;
			}
		}
		return $html;
	}

	public static function get_select_options_for_prices( $prices_array, $label = '', $label_value = '', $append = '', $prepend = '$' ) {
		if ( !empty( $prices_array ) && is_array( $prices_array ) ) {
			$keyed_options = array();
			foreach ( $prices_array as $price ) {
				$keyed_options[ $price ] = number_format( $price * 1000 );
			}
			return self::get_select_options( $keyed_options, $label, $label_value, $append, $prepend, true );
		}
	}

	public static function in_array_of_objects( $value, $array, $key ) {
		if ( is_array( $array ) ) {
			foreach ( $array as $object ) {
				if ( !empty( $object->{$key} ) && $object->{$key} == $value ) {
					return true;
				}
			}
		}
		return false;
	}

	public static function is_referral_function( $function ) {
		$traces = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
		foreach ( $traces as $trace ) {
			if ( is_array( $function ) ) {
				if ( !empty( $trace['class'] ) && $function[0] === $trace['class'] && $function[1] === $trace['function'] ) {
					return true;
				}
			}
			else {
				if ( $function === $trace['function'] ) {
					return true;
				}
			}
		}
		return false;
	}

	public static function get_images( $num_images = -1 ) {
		return get_posts( array(
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'any',
			'posts_per_page' => $num_images,
		) );
	}

	public static function get_image_src( $image_id, $size = 'full' ) {
		$image = wp_get_attachment_image_src( $image_id, $size );
		if ( !empty( $image ) && is_array( $image ) ) {
			return $image[0];
		}
		return false;
	}

	public static function is_unregistered_address_theme() {
		if ( class_exists( 'DispletHomeValue' ) || class_exists( 'AustinHomeValue' ) || class_exists( 'AustinHouseSeller' ) ) {
			return true;
		}
		return false;
	}

	public static function get_full_page_slug( $page_id, $slug = '' ) {
		$page = get_page( $page_id );
		$new_slug = $page->post_name . '/' . $slug;
		if ( !empty( $page->post_parent ) ) {
			return self::get_full_page_slug( $page->post_parent, $new_slug );
		}
		return rtrim( $new_slug, '/' );
	}

	public static function get_pagination_urls( $args ) {
		extract( wp_parse_args( $args, array(
			'count' => false,
			'current_page' => false,
			'num_per_page' => false,
			'pre_page_number_url_content' => '',
			'url' => false,
		) ) );
		$page_urls = array();
		if ( !empty( $count ) && !empty( $current_page ) && !empty( $num_per_page ) && !empty( $url ) && $count > $num_per_page ) {
			$pages = intval( ceil( $count / $num_per_page ) );
			if ( $pages > 7 ) {
				if ( $current_page < 3 ) {
					$start = 1;
				}
				else if ( $current_page + 4 > $pages ) {
					$start = $pages - 5;
				}
				else {
					$start = $current_page - 2;
				}
				$limit = $start + 4;
			}
			else {
				$start = 1;
				$limit = $pages;
			}
			if ( $start !== 1 ) {
				$page_urls[1] = $url . $pre_page_number_url_content . 1;
			}
			for ( $i = $start; $i <= $limit; $i++ ) {
				$page_urls[ $i ] = $url . $pre_page_number_url_content . $i;
			}
			if ( $limit !== $pages ) {
				$page_urls[ $pages ] = $url . $pre_page_number_url_content . $pages;
			}
		}
		return $page_urls;
	}

	public static function get_post_thubmnail_src( $post_id, $size = 'full' ) {
		$image_id = get_post_thumbnail_id( $post_id );
		if ( !empty( $image_id ) ) {
			$image = wp_get_attachment_image_src( $image_id, $size );
			if ( !empty( $image ) ) {
				return $image[0];
			}
		}
		return false;
	}

	public static function get_post_thumbnail_urls( $post_id, $size = 'full' ) {
		$images = get_children( array(
			'post_parent' => $post_id,
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'numberposts' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC',
		) );
		if ( !empty( $images ) ) {
			$image_urls = array();
			foreach ( $images as $image ) {
				$image_array = wp_get_attachment_image_src( $image->ID, $size );
				if ( !empty( $image_array ) ) {
					$image_urls[] = $image_array[0];
				}
			}
			return $image_urls;
		}
		return false;
	}

	public static function get_search_criteria_array_from_hash( $hash ) {
		if ( !empty( $hash ) ) {
			$field_value_pairs = array_filter( explode( '/', str_replace( '#', '', $hash ) ) );
			if ( !empty( $field_value_pairs ) ) {
				$criteria = array();
				foreach ( $field_value_pairs as $field_value_pair ) {
					$field_value_array = array_map( 'trim', explode( '=', $field_value_pair ) );
					if ( !empty( $field_value_array ) && count( $field_value_array ) === 2 ) {
						$criteria[ $field_value_array[0] ] = urldecode( $field_value_array[1] );
					}
				}
				return $criteria;
			}
		}
		return false;
	}
}

?>