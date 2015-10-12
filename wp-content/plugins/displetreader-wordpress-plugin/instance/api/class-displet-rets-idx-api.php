<?php

class DispletRetsIdxApi extends DispletRetsIdxPlugin {
	protected $_model;
	protected $_query;
	protected $_response;

	protected function __construct( $args, $filter_int_args = false ) {
		$this->_model = $this->parse_args( $this->maybe_filter_int_args( $args, $filter_int_args ), $this->get_default_args() );
		$this->_set_default_vars();
	}

	protected function build_query_url() {
		if ( !empty( $this->_query ) ) {
			if ( !empty( $this->_model['query_args'] ) && is_array( $this->_model['query_args'] ) ) {
				if ( $this->_model['remove_null_values'] ) {
					$this->_model['query_args'] = array_filter( $this->_model['query_args'], array( 'DispletRetsIdxUtilities', 'not_empty_excluding_zero' ) );
				}
				else {
					$hash_for_null = hash( 'sha256', time() );
					foreach ( $this->_model['query_args'] as &$query_arg ) {
						if ( $query_arg === null ) {
							$query_arg = $hash_for_null;
						}
					}
				}
				$this->_query .= '?' . http_build_query( $this->_model['query_args'] );
				if ( !$this->_model['remove_null_values'] ) {
					$this->_query = str_replace( $hash_for_null, '%00', $this->_query );
				}
			}
		}
	}

	private function get_default_args() {
		return array(
			'query_args' => array(),
			'remove_null_values' => true,
		);
	}

	public function maybe_filter_int_args( $args, $int_args ) {
		if ( !empty( $int_args ) && is_array( $int_args ) ) {
			foreach ( $int_args as $int_arg ) {
				if ( !empty( $args[ $int_arg ] ) ) {
					if ( is_numeric( $args[ $int_arg ] ) ) {
						$args[ $int_arg ] = intval( $args[ $int_arg ] );
					}
					else {
						$args[ $int_arg ] = false;
					}
				}
			}
		}
		return $args;
	}

	protected function parse_args( $args, $defaults ) {
		return wp_parse_args( $args, $defaults );
	}

	protected function query( $method = false ) {
		$this->build_query_url();
		$query_args = array(
			'timeout' => 10,
			'headers' => array(
				'referer' => $this->_model['referer'],
			),
		);
		if ( !empty( $method ) && $method != 'GET' ) {
			$query_args['method'] = $method;
		}
		if ( !empty( $method ) && $method == 'GET' ) {
			$json_array = wp_remote_get( $this->_query, $query_args );
		}
		else{
			$json_array = wp_remote_post( $this->_query, $query_args );
		}
		if ( is_array( $json_array ) && !empty( $json_array['body'] ) ) {
			return json_decode( $json_array['body'] );
		}
		return false;
	}

	private function _set_default_vars() {
		$this->_model = array_merge( $this->_model, array(
			'referer' => home_url(),
		) );
	}
}

?>