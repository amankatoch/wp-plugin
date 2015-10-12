<?php

class DispletRetsIdxEmail extends DispletRetsIdxEmailController {
	private static $_types = array(
		'activity_report',
		'address_captured',
		'assigned_lead',
		'emailed_friend',
		'registration',
		'saved_property',
		'saved_search',
		'showing_request',
	);

	public function __construct( $type, $args = array() ) {
		if ( in_array( $type, self::$_types ) ) {
			$this->_parse_args( $type, $args );
			$this->_build_model();
			$this->_send_emails();
		}
	}

	private function _parse_args( $type, $args ) {
		$this->_model = wp_parse_args( $args, array(
			'activity_report' => false,
			'agent_id' => false,
			'agent_name' => false,
			'friend_email' => false,
			'friend_name' => false,
			'lender_id' => false,
			'property_address' => false,
			'property_mls' => false,
			'property_url' => false,
			'registration_url' => false,
			'search_url' => false,
			'user_appointment' => false,
			'user_appointment2' => false,
			'user_email' => false,
			'user_has_realtor' => false,
			'user_login' => false,
			'user_message' => false,
			'user_name' => false,
			'user_password' => false,
			'user_phone' => false,
			'user_realtor' => false,
			'user_registration_url' => false,
			'user_username' => false,
		) );
		$this->_type = $type;
	}
}

?>