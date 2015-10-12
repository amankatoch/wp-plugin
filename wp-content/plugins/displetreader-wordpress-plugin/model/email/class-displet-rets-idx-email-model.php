<?php

class DispletRetsIdxEmailModel extends DispletRetsIdxPlugin {
	protected $_headers;
	protected $_messages = array(
		'admin_or_agent_or_lender' => false,
		'user_or_friend' => false,
	);
	protected $_model;
	protected $_recipients = array(
		'admin' => false,
		'agent' => false,
		'friend' => false,
		'lender' => false,
		'user' => false,
	);
	protected $_replacements = array(
		'admin_or_agent_or_lender' => false,
		'user_or_friend' => false,
	);
	protected $_sender = array();
	protected $_signature;
	protected $_titles = array(
		'admin_or_agent_or_lender' => false,
		'user_or_friend' => false,
	);
	protected $_type;
	protected static $_types_for_recipients = array(
		'admin' => array(
			'activity_report',
			'address_captured',
			'emailed_friend',
			'registration',
			'saved_property',
			'saved_search',
			'showing_request',
		),
		'agent' => array(
			'address_captured',
			'assigned_lead',
			'emailed_friend',
			'registration',
			'saved_property',
			'saved_search',
			'showing_request',
		),
		'friend' => array(
			'emailed_friend',
		),
		'lender' => array(
			'assigned_lead',
			'emailed_friend',
			'registration',
			'saved_property',
			'saved_search',
			'showing_request',
		),
		'user' => array(
			'registration',
			'showing_request',
		),
	);

	protected function _build_model() {
		$this->_set_defaults();
		$this->_set_conditional_vars();
		$this->_set_admin_recipient();
		$this->_set_agent_recipient();
		$this->_set_friend_recipient();
		$this->_set_lender_recipient();
		$this->_set_user_recipient();
		$this->_set_sender();
		$this->_set_headers();
		$this->_set_titles();
		$this->_set_messages();
		$this->_set_signature();
		$this->_set_replacements();
		$this->_replace_all_placeholders();
		$this->_format_messages();
	}

	private function _format_messages() {
		if ( !empty( $this->_messages ) && is_array( $this->_messages ) ) {
			foreach ( $this->_messages as $recipient => $message ) {
				if ( !empty( $message ) ) {
					if ( !empty( $this->_signature ) ) {
						$message .= PHP_EOL . PHP_EOL . $this->_signature;
					}
					$this->_messages[ $recipient ] = apply_filters( 'the_content', $message );
				}
			}
		}
	}

	public static function get_base_replacements() {
		return array(
			'site_name' => get_bloginfo( 'name' ),
			'site_url' => home_url(),
		);
	}

	public static function replace_placeholders( $content, $replacements ) {
		if ( !empty( $replacements ) && is_array( $replacements ) ) {
			foreach ( $replacements as $placeholder => $replacement ) {
				$content = str_replace( '%%' . $placeholder . '%%', $replacement, $content );
			}
		}
		return $content;
	}

	private function _replace_all_placeholders() {
		if ( !empty( $this->_messages ) && is_array( $this->_messages ) ) {
			foreach ( $this->_messages as $recipient => $message ) {
				$this->_messages[ $recipient ] = self::replace_placeholders( $this->_messages[ $recipient ], $this->_replacements[ $recipient ] );
			}
		}
		if ( !empty( $this->_titles ) && is_array( $this->_titles ) ) {
			foreach ( $this->_titles as $recipient => $message ) {
				$this->_titles[ $recipient ] = self::replace_placeholders( $this->_titles[ $recipient ], $this->_replacements[ $recipient ] );
			}
		}
		$this->_signature = self::replace_placeholders( $this->_signature, $this->_replacements['admin_or_agent_or_lender'] );
	}

	private function _set_admin_recipient() {
		if ( $this->_model['should_send_to_admin'] ) {
			$admin_email = ( !empty( self::$_options['email'] ) ) ? self::$_options['email'] : get_option( 'admin_email' );
			if ( !empty( $admin_email ) ) {
				$this->_recipients['admin'] = array_filter( array_map( 'trim', explode( ',', $admin_email ) ) );
			}
		}
	}

	private function _set_agent_recipient() {
		if ( $this->_model['should_send_to_agent'] ) {
			$agent = get_userdata( $this->_model['agent_id'] );
			if ( !empty( $agent ) ) {
				$this->_recipients['agent'] = $agent->user_email;
				$this->_model['agent_name'] = $agent->display_name;
			}
		}
	}

	private function _set_conditional_vars() {
		if ( in_array( $this->_type, self::$_types_for_recipients['admin'] ) ) {
			$this->_model['should_send_to_admin'] = true;
		}
		if ( in_array( $this->_type, self::$_types_for_recipients['agent'] ) && !empty( $this->_model['agent_id'] ) ) {
			$this->_model['should_send_from_agent'] = true;
			$this->_model['should_send_to_agent'] = true;
		}
		if ( in_array( $this->_type, self::$_types_for_recipients['friend'] ) ) {
			$this->_model['should_send_to_friend'] = true;
		}
		if ( in_array( $this->_type, self::$_types_for_recipients['lender'] ) && !empty( $this->_model['lender_id'] ) ) {
			$this->_model['should_send_to_lender'] = true;
		}
		if ( in_array( $this->_type, self::$_types_for_recipients['user'] ) ) {
			$this->_model['should_send_to_user'] = true;
		}
		if ( $this->_type === 'emailed_friend' && !empty( $this->_model['user_email'] ) && is_email( $this->_model['user_email'] ) ) {
			$this->_model['should_send_from_user'] = true;
		}
	}

	private function _set_defaults() {
		$this->_model = array_merge( $this->_model, array(
			'should_send_from_agent' => false,
			'should_send_from_user' => false,
			'should_send_to_admin' => false,
			'should_send_to_agent' => false,
			'should_send_to_friend' => false,
			'should_send_to_lender' => false,
			'should_send_to_user' => false,
		) );
	}

	private function _set_friend_recipient() {
		if ( $this->_model['should_send_to_friend'] && is_email( $this->_model['friend_email'] ) ) {
			$this->_recipients['friend'] = $this->_model['friend_email'];
		}
	}

	private function _set_headers() {
		if ( !empty( $this->_sender['email'] ) ) {
			$this->_headers .= 'From: ';
			if ( !empty( $this->_sender['name'] ) ) {
				$this->_headers .= $this->_sender['name'] . ' ';
			}
			$this->_headers .= '<' . $this->_sender['email'] . '>' . PHP_EOL;
		}
		$this->_headers .= 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL;
	}

	private function _set_lender_recipient() {
		if ( $this->_model['should_send_to_lender'] ) {
			$lender = get_userdata( $this->_model['lender_id'] );
			if ( !empty( $lender ) ) {
				$this->_recipients['lender'] = $lender->user_email;
				$this->_model['lender_name'] = $lender->display_name;
			}
		}
	}

	private function _set_messages() {
		if ( $this->_type === 'activity_report' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_user_activity'] ) ? self::$_options['email_template_user_activity'] : DispletRetsIdxEmailTemplatesModel::get_default_activity_report_message();
		}
		else if ( $this->_type === 'address_captured' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_unregistered_address'] ) ? self::$_options['email_template_unregistered_address'] : DispletRetsIdxEmailTemplatesModel::get_default_unregistered_address_message();
		}
		else if ( $this->_type === 'assigned_lead' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_assigned_lead'] ) ? self::$_options['email_template_assigned_lead'] : DispletRetsIdxEmailTemplatesModel::get_default_assigned_lead_message();
		}
		else if ( $this->_type === 'emailed_friend' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_email_friend_to_admin'] ) ? self::$_options['email_template_email_friend_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_email_friend_message_to_admin();
			$this->_messages['user_or_friend'] = !empty( self::$_options['email_template_email_friend_to_user'] ) ? self::$_options['email_template_email_friend_to_user'] : DispletRetsIdxEmailTemplatesModel::get_default_email_friend_message_to_user();
		}
		else if ( $this->_type === 'registration' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_new_registration_to_admin'] ) ? self::$_options['email_template_new_registration_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_new_registration_message_to_admin();
			$this->_messages['user_or_friend'] = !empty( self::$_options['email_template_new_registration_to_user'] ) ? self::$_options['email_template_new_registration_to_user'] : DispletRetsIdxEmailTemplatesModel::get_default_new_registration_message_to_user();
		}
		else if ( $this->_type === 'saved_property' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_saved_property_to_admin'] ) ? self::$_options['email_template_saved_property_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_saved_property_message_to_admin();
		}
		else if ( $this->_type === 'saved_search' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_saved_search_to_admin'] ) ? self::$_options['email_template_saved_search_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_saved_search_message_to_admin();
		}
		else if ( $this->_type === 'showing_request' ) {
			$this->_messages['admin_or_agent_or_lender'] = !empty( self::$_options['email_template_property_showing_to_admin'] ) ? self::$_options['email_template_property_showing_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_property_showing_message_to_admin();
			$this->_messages['user_or_friend'] = !empty( self::$_options['email_template_property_showing_to_user'] ) ? self::$_options['email_template_property_showing_to_user'] : DispletRetsIdxEmailTemplatesModel::get_default_property_showing_message_to_user();
		}
	}

	private function _set_replacements() {
		$replacements = array(
			'friend_email' => $this->_model['friend_email'],
			'friend_name' => $this->_model['friend_name'],
			'property_address' => $this->_model['property_address'],
			'property_mls' => $this->_model['property_mls'],
			'property_url' => $this->_model['property_url'],
			'registration_url' => $this->_model['registration_url'],
			'search_url' => $this->_model['search_url'],
			'user_activity_report' => $this->_model['activity_report'],
			'user_appointment' => $this->_model['user_appointment'],
			'user_appointment2' => $this->_model['user_appointment2'],
			'user_email' => $this->_model['user_email'],
			'user_has_realtor' => $this->_model['user_has_realtor'],
			'user_message' => $this->_model['user_message'],
			'user_name' => $this->_model['user_name'],
			'user_phone' => $this->_model['user_phone'],
			'user_username' => $this->_model['user_username'],
		);
		$replacements = array_merge( $replacements, self::get_base_replacements() );
		if ( !empty( $this->_messages['admin_or_agent_or_lender'] ) ) {
			$this->_replacements['admin_or_agent_or_lender'] = array_merge( $replacements, array(
				'leads_url' => admin_url( 'admin.php?page=displet-lead-manager' ),
			) );
		}
		if ( !empty( $this->_messages['user_or_friend'] ) ) {
			$this->_replacements['user_or_friend'] = array_merge( $replacements, array(
				'user_password' => $this->_model['user_password'],
			) );
		}
	}

	private function _set_sender() {
		if ( $this->_model['should_send_from_user'] ) {
			$this->_sender['email'] = $this->_model['user_email'];
			$this->_sender['name'] = $this->_model['user_name'];
		}
		else if ( $this->_model['should_send_from_agent'] && !empty( $this->_recipients['agent'] ) ) {
			$this->_sender['email'] = $this->_recipients['agent'];
			$this->_sender['name'] = $this->_model['agent_name'];
		}
		else {
			$this->_sender['email'] = $this->_recipients['admin'][0];
			$this->_sender['name'] = !empty( self::$_options['email_from_name'] ) ? self::$_options['email_from_name'] : get_bloginfo( 'name' );
		}
	}

	private function _set_signature() {
		if ( !$this->_model['should_send_from_user'] ) {
			if ( !empty( $this->_model['agent_id'] ) ) {
				$this->_signature = get_user_meta( $this->_model['agent_id'], 'displet_email_signature', true );
			}
			else if ( !empty( self::$_options['email_signature'] ) ) {
				$this->_signature = self::$_options['email_signature'];
			}
		}
	}

	private function _set_titles() {
		if ( $this->_type === 'activity_report' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_user_activity'] ) ? self::$_options['email_title_user_activity'] : DispletRetsIdxEmailTemplatesModel::get_default_activity_report_title();
		}
		else if ( $this->_type === 'address_captured' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_unregistered_address'] ) ? self::$_options['email_title_unregistered_address'] : DispletRetsIdxEmailTemplatesModel::get_default_unregistered_address_title();
		}
		else if ( $this->_type === 'assigned_lead' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_assigned_lead'] ) ? self::$_options['email_title_assigned_lead'] : DispletRetsIdxEmailTemplatesModel::get_default_assigned_lead_title();
		}
		else if ( $this->_type === 'emailed_friend' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_email_friend_to_admin'] ) ? self::$_options['email_title_email_friend_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_email_friend_title_to_admin();
			$this->_titles['user_or_friend'] = !empty( self::$_options['email_title_email_friend_to_user'] ) ? self::$_options['email_title_email_friend_to_user'] : DispletRetsIdxEmailTemplatesModel::get_default_email_friend_title_to_user();
		}
		else if ( $this->_type === 'registration' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_new_registration_to_admin'] ) ? self::$_options['email_title_new_registration_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_new_registration_title_to_admin();
			$this->_titles['user_or_friend'] = !empty( self::$_options['email_title_new_registration_to_user'] ) ? self::$_options['email_title_new_registration_to_user'] : DispletRetsIdxEmailTemplatesModel::get_default_new_registration_title_to_user();
		}
		else if ( $this->_type === 'saved_property' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_saved_property_to_admin'] ) ? self::$_options['email_title_saved_property_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_saved_property_title_to_admin();
		}
		else if ( $this->_type === 'saved_search' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_saved_search_to_admin'] ) ? self::$_options['email_title_saved_search_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_saved_search_title_to_admin();
		}
		else if ( $this->_type === 'showing_request' ) {
			$this->_titles['admin_or_agent_or_lender'] = !empty( self::$_options['email_title_property_showing_to_admin'] ) ? self::$_options['email_title_property_showing_to_admin'] : DispletRetsIdxEmailTemplatesModel::get_default_property_showing_title_to_admin();
			$this->_titles['user_or_friend'] = !empty( self::$_options['email_title_property_showing_to_user'] ) ? self::$_options['email_title_property_showing_to_user'] : DispletRetsIdxEmailTemplatesModel::get_default_property_showing_title_to_user();
		}
	}

	private function _set_user_recipient() {
		if ( $this->_model['should_send_to_user'] && !empty( $this->_model['user_email'] ) && is_email( $this->_model['user_email'] ) ) {
			$this->_recipients['user'] = $this->_model['user_email'];
		}
	}
}

?>