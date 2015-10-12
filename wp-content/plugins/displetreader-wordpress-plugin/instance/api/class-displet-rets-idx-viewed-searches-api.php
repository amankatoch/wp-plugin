<?php

class DispletRetsIdxViewedSearchesApi extends DispletRetsIdxApi {
	protected static $_params = array(
		'search_criteria',
		'user_id',
	);

	public function __construct( $args = array() ) {
		parent::__construct( $this->parse_args( $args, $this->_get_args() ) );
	}

	public function create() {
		$this->_prepare_to_query();
		$result = $this->query();
		if ( !empty( $result->id ) ) {
			return $result->id;
		}
		return false;
	}

	private function _get_args(){
		return array(
			'query_args' => array(
				'authentication_token' => self::$_options['displet_app_key'],
			),
		);
	}

	private function _prepare_to_query() {
		$this->_set_query_args();
		$this->_set_query_url();
	}

	private function _set_query_args() {
		if ( !empty( self::$_params ) && is_array( self::$_params ) ) {
			foreach ( self::$_params as $param ) {
				if ( isset( $this->_model[ $param ] ) || $this->_model[ $param ] === null ) {
					$this->_model['query_args'][ $param ] = $this->_model[ $param ];
				}
			}
		}
	}

	private function _set_query_url() {
		$this->_query = trailingslashit( self::$_api_url ) . 'viewed_searches';
	}
}

?>