<?php

class DispletRetsIdxPropertyDetailsPageModel extends DispletRetsIdxPagesModel {
	public static function build() {
		self::_replace_disclaimer();
	}

	public static function get_similar_properties() {
		if ( !empty( self::$_model['listings'][0] ) && !empty( self::$_model['listings'][0]->zip ) ) {
			$args = array(
				'zip' => self::$_model['listings'][0]->zip,
			);
			if ( !empty( self::$_model['listings'][0]->list_price ) ) {
				$price = intval( self::$_model['listings'][0]->list_price );
				$args['min_list_price'] = intval( $price * .75 / 1000 );
				$args['max_list_price'] = intval( $price * 1.25 / 1000 );
			}
			if ( !empty( self::$_model['listings'][0]->square_feet ) ) {
				$square_feet = intval( self::$_model['listings'][0]->square_feet );
				$args['min_square_feet'] = intval( $square_feet * .75 );
				$args['max_square_feet'] = intval( $square_feet * 1.25 );
			}
			if ( !empty( self::$_model['listings'][0]->subdivision ) ) {
				$args['subdivision'] = self::$_model['listings'][0]->subdivision;
			}
			$residentials = new DispletRetsIdxResidentials( $args );
			$results = $residentials->get_residentials();
			$count = !empty( $results['meta']->count ) ? intval( $results['meta']->count ) : 0;
			$listings = !empty( $results['listings'] ) ? $results['listings'] : array();
			if ( $count < 10 && $count < self::$_options['listings_per_page'] && !empty( $args['subdivision'] ) ) {
				unset( $args['subdivision'] );
				if ( !empty( self::$_model['listings'][0]->list_price ) ) {
					$price = intval( self::$_model['listings'][0]->list_price );
					$args['min_list_price'] = intval( $price * .85 / 1000 );
					$args['max_list_price'] = intval( $price * 1.15 / 1000 );
				}
				if ( !empty( self::$_model['listings'][0]->square_feet ) ) {
					$square_feet = intval( self::$_model['listings'][0]->square_feet );
					$args['min_square_feet'] = intval( $square_feet * .85 );
					$args['max_square_feet'] = intval( $square_feet * 1.15 );
				}
				$residentials = new DispletRetsIdxResidentials( $args );
				$results = $residentials->get_residentials();
				if ( !empty( $results['listings'] ) ) {
					$listings = array_merge( $listings, $results['listings'] );
				}
			}
			if ( !empty( $listings ) && is_array( $listings ) ) {
				$i = 0;
				$listings_by_id = array();
				foreach ( $listings as $listing ) {
					if ( $i < self::$_options['listings_per_page'] && !empty( $listing->id ) && $listing->id !== self::$_model['listings'][0]->id ) {
						$listings_by_id[ $listing->id ] = $listing;
						$i++;
					}
				}
				self::$_model['similar_listings'] = array_values( $listings_by_id );
			}
		}
	}

	public static function get_user_property_rating() {
		if ( !empty( self::$_model['listings'][0] ) && !empty( self::$_model['property_id'] ) && !empty( self::$_model['current_user_id'] ) ) {
			$saved_properties = get_user_meta( self::$_model['current_user_id'], 'displet_saved_properties', true );
			if ( !empty( $saved_properties ) && is_array( $saved_properties ) ) {
				foreach ( $saved_properties as $saved_property ) {
					if ( !empty( $saved_property['sysid'] ) && $saved_property['sysid'] === self::$_model['property_id'] ) {
						self::$_model['listings'][0]->user_rating = intval( $saved_property['rating'] );
					}
				}
			}
		}
	}

	private static function _replace_disclaimer() {
		if ( self::$_model['is_mobile_page'] ) {
			self::$_options['disclaimer'] = str_replace( '%%date_last_updated%%', date( 'Y-m-d', strtotime( '-12 hours' ) ), self::$_options['disclaimer'] );
		}
	}
}

?>