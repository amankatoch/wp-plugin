<?php

class DispletRetsIdxResidentials extends DispletRetsIdxResidentialsController {
	public function __construct( $args = array() ) {
		$this->parse_args( $args );
		$this->prep_query();
	}

	public function get_count() {
		$this->query_residentials( 'count' );
		return $this->_residentials;
	}

	public function get_query_args() {
		return $this->_query_args;
	}

	public function get_residentials() {
		if ( $this->_model['get_residentials'] ) {
			$this->query_residentials();
			$this->normalize_residentials();
			$residentials = $this->_residentials;
		}
		else {
			$residentials = array();
		}
		if ( ($this->_model['get_listings_by_status'] || $this->_model['get_stats_by_status'] ) && !empty( $this->_model['statuses'] ) && is_array( $this->_model['statuses'] ) ) {
			$residentials_by_status = array();
			if ( ! $this->_model['get_listings_by_status'] && $this->_model['get_stats_by_status'] ) {
				$this->_model['num_listings'] = 1;
			}
			foreach ( $this->_model['statuses'] as $status ) {
				$this->_query_args['status'] = $status;
				$this->query_residentials();
				$this->normalize_residentials();
				$this->_residentials['status'] = $status;
				$residentials_by_status[] = $this->_residentials;
			}
			if ( $this->_model['get_listings_by_status'] ) {
				$residentials['listings_by_status'] = $residentials_by_status;
			}
			if ( $this->_model['get_stats_by_status'] ) {
				$residentials['stats_by_status'] = $residentials_by_status;
			}
		}
		return $residentials;
	}

	private function parse_args( $args ) {
		$this->_model = wp_parse_args( $args, array(
			'data_from' => 'api',
			'direction' => false,
			'extended_stats' => false,
			'get_listings_by_status' => false,
			'get_residentials' => true,
			'get_stats_by_status' => false,
			'is_displet_api' => !empty( self::$_options['displet_app_key'] ) ? true : false,
			'is_mobile_page' => false,
			'is_partial_address_page' => false,
			'is_property_details_page' => false,
			'is_search_results_page' => false,
			'is_shortcode' => false,
			'is_widget' => false,
			'layout' => !empty( self::$_options['listings_layout'] ) ? self::$_options['listings_layout'] : 'default',
			'num_listings' => !empty( self::$_options['listings_per_page'] ) ? intval( self::$_options['listings_per_page'] ) : 10,
			'page' => false,
			'page_urls' => false,
			'return_fields' => $this->get_return_fields(),
			'sort_by' => false,
			'statuses' => false,
		) );
	}

	public function swap_id_for_sysid() {
		$this->_query_args['sysid'] = $this->_query_args['id'];
		unset( $this->_query_args['id'] );
	}
}

?>