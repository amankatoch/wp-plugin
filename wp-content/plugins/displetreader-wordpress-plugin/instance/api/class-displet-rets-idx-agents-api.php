<?php

class DispletRetsIdxAgentsApi extends DispletRetsIdxApi {
	protected static $_fields = array(
		'address',
		'email',
		'email_signature',
		'facebook_url',
		'headshot_url',
		'instagram_url',
		'linkedin_url',
		'name',
		'phone',
	);

	public function __construct( $args = array() ) {
		parent::__construct( $this->parse_args( $args, $this->_get_args() ) );
	}

	public function create() {
		$this->_prepare_to_query( true );
		$result = $this->query();
		if ( !empty( $result->id ) ) {
			return $result->id;
		}
		return false;
	}

	public function delete() {
		$this->_prepare_to_query();
		$result = $this->query( 'DELETE' );
		if ( !empty( $result->success ) ) {
			return $result->success;
		}
		return false;
	}

	private function _get_args(){
		return array(
			'endpoint' => '',
			'query_args' => array(
				'authentication_token' => self::$_options['displet_app_key'],
			),
		);
	}

	private function _prepare_to_query( $new = false ) {
		if ( !$new ) {
			$this->_set_endpoint();
		}
		$this->_set_query_args();
		$this->_set_query_url();
	}

	private function _set_endpoint() {
		if ( !empty( $this->_model['agent_id'] ) ) {
			$this->_model['endpoint'] = $this->_model['agent_id'];
		}
	}

	private function _set_query_args() {
		foreach ( self::$_fields as $field ) {
			if ( isset( $this->_model[ $field ] ) ) {
				$this->_model['query_args'][ $field ] = $this->_model[ $field ];
			}
		}
	}

	private function _set_query_url( $user_id = false ) {
		$this->_query = trailingslashit( self::$_api_url ) . 'agents/' . $this->_model['endpoint'];
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