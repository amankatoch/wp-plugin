<?php

class DispletRetsIdxViewedPropertiesController extends DispletRetsIdxLeadsController {
	public static function get_property_view_stats( $properties ) {
		$stats = array(
			'baths_average' => false,
			'beds_average' => false,
			'price_average' => false,
			'square_feet_average' => false,
			'zip_mode' => false,
		);
		if ( !empty( $properties ) && is_array( $properties ) ) {
			$baths_total = $baths_count = $beds_total = $beds_count = $price_total = $price_count = $sq_ft_total = $sq_ft_count = 0;
			$properties_zips = array();
			foreach ( $properties as $property ) {
				if ( isset( $property['baths'] ) && !DispletRetsIdxUtilities::empty_excluding_zero( $property['baths'] ) ) {
					$baths_total += intval( $property['baths'] );
					$baths_count++;
				}
				if ( isset( $property['beds'] ) && !DispletRetsIdxUtilities::empty_excluding_zero( $property['beds'] ) ) {
					$beds_total += intval( $property['beds'] );
					$beds_count++;
				}
				if ( !empty( $property['price'] ) && $price = intval( $property['price'] ) ) {
					$price_total += $price;
					$price_count++;
				}
				if ( !empty( $property['sq_ft'] ) && $sq_ft = intval( $property['sq_ft'] ) ) {
					$sq_ft_total += $sq_ft;
					$sq_ft_count++;
				}
				if ( !empty( $property['zip'] ) ) {
					$properties_zips[] = $property['zip'];
				}
			}
			if ( $baths_count > 0 ) {
				$stats['baths_average'] = round( $baths_total / $baths_count );
			}
			if ( $beds_count > 0 ) {
				$stats['beds_average'] = round( $beds_total / $beds_count );
			}
			if ( $price_count > 0 ) {
				$stats['price_average'] = round( $price_total / $price_count );
			}
			if ( $sq_ft_count > 0 ) {
				$stats['square_feet_average'] = round( $sq_ft_total / $sq_ft_count );
			}
			if ( !empty( $properties_zips ) ) {
				$values = array_count_values( $properties_zips );
				$stats['zip_mode'] = array_search( max( $values ), $values );
			}
		}
		return $stats;
	}

	public static function update_property_view_stats( $user_id, $user_properties ) {
		$property_stats = DispletRetsIdxViewedPropertiesController::get_property_view_stats( $user_properties );
		if ( isset( $property_stats['baths_average'] ) && !DispletRetsIdxUtilities::empty_excluding_zero( $property_stats['baths_average'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['mean_baths'], $property_stats['baths_average'] );
		}
		if ( isset( $property_stats['beds_average'] ) && !DispletRetsIdxUtilities::empty_excluding_zero( $property_stats['beds_average'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['mean_beds'], $property_stats['beds_average'] );
		}
		if ( !empty( $property_stats['price_average'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['mean_price'], $property_stats['price_average'] );
		}
		if ( !empty( $property_stats['square_feet_average'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['mean_square_feet'], $property_stats['square_feet_average'] );
		}
		if ( !empty( $property_stats['zip_mode'] ) ) {
			update_user_meta( $user_id, self::$_meta_keys['zip_mode'], $property_stats['zip_mode'] );
		}
		return $property_stats;
	}

	public static function update_viewed_properties( $property ) {
		$user_id = get_current_user_id();
		if ( $user_id != 0 && current_user_can( 'displet_save_properties' ) && !current_user_can( 'manage_options' ) ) {
			$user_properties = get_user_meta( $user_id, 'displet_user_properties', true );
			if ( empty( $user_properties ) ) {
				$user_properties = array();
			}
			$user_property = wp_parse_args( $property, array(
				'address' => '',
				'baths' => '',
				'beds' => '',
				'id' => '',
				'image_url' => '',
				'price' => '',
				'sq_ft' => '',
				'url' => '',
				'zip' => '',
			) );
			$user_properties[] = $user_property;
			update_user_meta( $user_id, 'displet_user_properties', $user_properties );
			$stats = DispletRetsIdxViewedPropertiesController::update_property_view_stats( $user_id, $user_properties );
			if ( !empty( $property['id'] ) ) {
				$api_user_id = get_user_meta( $user_id, 'displet_api_user_id', true );
				if ( !empty( $api_user_id ) ) {
					DispletRetsIdxUsersApiController::update_user_property_views( $api_user_id, $property['id'] );
				}
			}
			do_action( 'displetretsidx_post_lead_viewed_property', $user_id, array(
				'all_properties' => $user_properties,
				'last_property' => $user_property,
				'properties_count' => count( $user_properties ),
				'properties_stats' => $stats,
			) );
		}
	}
}

?>