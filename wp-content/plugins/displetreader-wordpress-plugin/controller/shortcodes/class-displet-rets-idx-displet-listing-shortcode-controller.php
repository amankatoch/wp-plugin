<?php

class DispletRetsIdxDispletListingShortcodeController extends DispletRetsIdxPlugin {
	protected static $_orientations = array(
		'map' => 'map',
		'tile' => 'gallery',
		'vertical' => 'list',
	);
	protected static $_shortcode_count = 1;

	private static function get_lowercase_yes_no_model( $model ) {
		$yes_no_keys = array(
			'layout',
			'price_navigation',
			'property_type_navigation',
			'property_type_sorting',
			'show_listings',
			'stats'
		 );
		foreach ( $yes_no_keys as $key => $value ) {
			if ( !empty( $model[$key] ) ) {
				$model[ $key ] = strtolower( $value );
			}
		}
		return $model;
	}

	private static function _get_model_for_templates( $model ) {
		$model['options'] = self::$_options;
		$model['shortcode_count'] = self::$_shortcode_count++;
		$model['orientation'] = self::_get_standardized_orientation( $model['orientation'] );
		return $model;
	}

	private static function _get_standardized_orientation( $orientation ) {
		$orientation = strtolower( $orientation );
		if ( in_array( $orientation, self::$_orientations ) ) {
			return $orientation;
		}
		foreach ( self::$_orientations as $legacy => $current ) {
			if ( $orientation === $legacy ) {
				return $current;
			}
		}
		return self::$_options['listings_orientation'];
	}

	public static function render_shortcode( $attributes ) {
		$model = shortcode_atts( array(
			// Has settings defaults but shortcode override
			'orientation' => self::$_options['listings_orientation'],
			'price_navigation' => self::$_options['include_price_navigation'],
			'price_navigation_prices' => self::$_options['price_navigation_prices'],
			'property_type_navigation' => self::$_options['include_property_type_navigation'],
			'property_type_sorting' => self::$_options['include_property_type_sorting'],
			'stats' => self::$_options['include_stats'],
			'layout' => self::$_options['listings_layout'],
			'listings' => true,
			// Has only shortcode attributes
			'caption' => '',
			'minlistprice' => '',
			'min_list_price' => '',
			'maxlistprice' => '',
			'max_list_price' => '',
			'minbedrooms' => '',
			'min_bedrooms' => '',
			'maxbedrooms' => '',
			'max_bedrooms' => '',
			'minbathrooms' => '',
			'min_bathrooms' => '',
			'maxbathrooms' => '',
			'max_bathrooms' => '',
			'minsquarefeet' => '',
			'min_square_feet' => '',
			'maxsquarefeet' => '',
			'max_square_feet' => '',
			'quick_terms' => '',
			'area_mls_defined' => '',
			'city' => '',
			'property_type' => '',
			'minstories' => '',
			'min_stories' => '',
			'waterfront' => '',
			'pool_on_property' => '',
			'subdivision' => '',
			'keyword' => '',
			'school' => '',
			'school_district' => '',
			'minacres' => '',
			'min_acres' => '',
			'zip' => '',
			'is_foreclosure' => '',
			'yearbuilt' => '',
			'year_built' => '',
			'county' => '',
			'status' => '',
			'short_sale' => '',
			'last_modified' => '',
			'listing_agent_id' => '',
			'listing_office_id' => '',
			'min_lot_size' => '',
			'is_gated_community' => '',
			'min_sold_date' => '',
			'max_sold_date' => '',
			'master_on_main' => '',
			'basement' => '',
			'min_square_feet_available' => '',
			'max_square_feet_available' => '',
			'min_price_per_sq_feet' => '',
			'max_price_per_sq_feet' => '',
			'street_name' => '',
			'street_number' => '',
			'listed_since' => '',
			'sort_by' => '',
			'direction' => '',
			'mls_number' => '',
			'poly' => '',
		), $attributes );
		$model['show_listings'] = $model['listings'];
		$model['listings'] = false;
		$model = self::get_lowercase_yes_no_model( $model );
		$model = self::set_residentials_args( $model );
		$residentials = new DispletRetsIdxResidentials( $model );
		$listings = $residentials->get_residentials();
		$model = array_merge( $model, $listings );
		$templates = new DispletRetsIdxTemplates( self::_get_model_for_templates( $model ) );
		return $templates->get_templates();
	}

	public static function render_shortcode_stats() {
		// Empty to remove legacy shortcode calls
	}

	private static function set_residentials_args( $model ) {
		$model['is_shortcode'] = true;
		if ( $model['stats'] === 'advanced' || $model['layout'] === 'table' ) {
			$model['statuses'] = DispletRetsIdxSettingsController::get_filtered_statuses();
		}
		if ( $model['stats'] === 'advanced' ) {
			$model['get_stats_by_status'] = true;
		}
		if ( $model['layout'] === 'table' ) {
			$model['get_listings_by_status'] = true;
			if ( $model['stats'] !== 'basic' && $model['stats'] !== 'yes' ) {
				$model['get_residentials'] = false;
			}
		}
		if ( $model['show_listings'] === 'showcase' ) {
			$model['data_from'] = 'property_showcase';
		}
		$page = get_query_var( 'paged' );
		if ( !empty( $page ) && $page > 1 ) {
			$model['page'] = $page;
		}
		return $model;
	}
}

?>