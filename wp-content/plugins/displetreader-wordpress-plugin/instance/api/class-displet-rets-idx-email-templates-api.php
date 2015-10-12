<?php

class DispletRetsIdxEmailTemplatesApi extends DispletRetsIdxApi {
	public function __construct( $args = array() ) {
		parent::__construct( $this->parse_args( $args, $this->_get_args() ) );
	}

	public function create() {
		$this->_prepare_to_query();
		$result = $this->query();
		if ( !empty( $result ) ) {
			return $result;
		}
		return false;
	}

	private function _get_args(){
		return array(
			'query_args' => array(
				'authentication_token' => self::$_options['displet_app_key'],
			),
			'remove_null_values' => false,
		);
	}

	private function _prepare_to_query() {
		$this->_set_query_args();
		$this->_set_query_url();
	}

	private function _set_query_args() {
		$params = DispletRetsIdxEmailTemplatesModel::get_api_params();
		if ( !empty( $params ) && is_array( $params ) ) {
			foreach ( $params as $param ) {
				if ( isset( $this->_model[ $param ] ) || $this->_model[ $param ] === null ) {
					$this->_model['query_args'][ $param ] = $this->_model[ $param ];
				}
			}
		}
	}

	private function _set_query_url() {
		$this->_query = trailingslashit( self::$_api_url ) . 'email_template';
	}

	public function update() {
		$this->_prepare_to_query();
		$result = $this->query( 'PUT' );
		if ( !empty( $result ) ) {
			return $result;
		}
		return false;
	}
}

?>