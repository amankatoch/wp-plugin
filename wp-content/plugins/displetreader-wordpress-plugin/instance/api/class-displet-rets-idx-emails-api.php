<?php

class DispletRetsIdxEmailsApi extends DispletRetsIdxApi {
	public function __construct( $args = array() ) {
		parent::__construct( $this->parse_args( $args, $this->get_args() ) );
	}

	private function get_args(){
		return array(
			'query_args' => array(
				'authentication_token' => self::$_options['displet_app_key'],
				'start_date' => date( 'm/d/Y', strtotime( '-30 days' ) ),
				'end_date' => date( 'm/d/Y' ),
			),
		);
	}

	public function get_user_opened( $user_id = false ) {
		if ( !empty( $user_id ) ) {
			$this->_model['endpoint'] = 'user_opened';
			$this->set_query_url();
			$this->_model['query_args']['user_id'] = $user_id;
			$result = parent::query( 'GET' );
			if ( !empty( $result->total ) || $result->total === 0 ) {
				return $result->total;
			}
			return false;
		}
	}

	private function set_query_url( $user_id = false ) {
		$this->_query = trailingslashit( self::$_api_url ) . 'sent_emails/' . $this->_model['endpoint'];
	}
}

?>