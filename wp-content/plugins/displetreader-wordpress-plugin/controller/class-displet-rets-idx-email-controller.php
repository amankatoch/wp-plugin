<?php

class DispletRetsIdxEmailController extends DispletRetsIdxEmailModel {
	public static function adjust_activity_report_schedule() {
		if ( !empty( self::$_options['email_activity'] ) ) {
			wp_schedule_event( time() + 60 * 60 * 23, 'daily', 'displetactivityreport' );
		}
		else{
			self::unschedule_activity_report();
		}
	}

	public static function send_activity_report() {
		$current_time = current_time( 'timestamp' );
		$mostly_recent_users = get_users( array(
			'meta_key' => 'displet_last_login',
			'meta_value' => $current_time - 60 * 60 * 24 * 7,
			'meta_compare' => '>'
		 ) );
		$recent_users = array();
		if ( !empty( $mostly_recent_users ) && is_array( $mostly_recent_users ) ) {
			$edit_url = admin_url( 'admin.php?page=displet-lead-manager&user_id=' );
			foreach ( $mostly_recent_users as $user ) {
				if ( !empty( $user->displet_last_login ) && is_numeric( $user->displet_last_login ) ) {
					$logins_for_day = 0;
					if ( !empty( $user->displet_logins ) && is_array( $user->displet_logins ) ) {
						foreach ( $user->displet_logins as $login ) {
							if ( $login > $current_time - 60 * 60 * 24 ) {
								$logins_for_day++;
							}
						}
					}
					$property_stats = DispletRetsIdxViewedPropertiesController::get_property_view_stats( $user->displet_user_properties );
					$recent_users[] = array(
						'url' => $edit_url . $user->ID,
						'name' => $user->nickname,
						'phone' => $user->displet_phone,
						'logins_for_day' => $logins_for_day,
						'logins_total' => count( $user->displet_logins ),
						'price_average' => $property_stats['price_average'],
						'zip_mode' => $property_stats['zip_mode']
					 );
				}
			}
		}
		if ( !empty( $recent_users ) ) {
			$user_activity_report = '<table cellpadding="3" width="100%"><tr><th>Name</th><th>Phone</th><th>Logins In Last Day</th><th>Total Logins</th><th>Average Price</th><th>Most Frequented Zip Code</th></tr>';
			foreach ( $recent_users as $user ) {
				$price_average = !empty( $user['price_average'] ) ? number_format( $user['price_average'] ) : '';
				$user_activity_report .= '<tr><td align="left"><a href="' . $user['url'] . '">' . $user['name'] . '</a></td><td align="center">' . $user['phone'] . '</td><td align="center">' . $user['logins_for_day'] . '</td><td align="center">' . $user['logins_total'] . '</td><td align="center">$' . $price_average . '</td><td align="center">' . $user['zip_mode'] . '</td></tr>';
			}
			$user_activity_report .= '</table>';
			new DispletRetsIdxEmail( 'activity_report', array(
				'activity_report' => $user_activity_report,
			) );
		}
	}

	public static function send_assigned_lead_message( $lead_id, $assigned_agent_id, $assigned_lender_id ) {
		$lead = get_userdata( $lead_id );
		new DispletRetsIdxEmail( 'assigned_lead', array(
			'agent_id' => $assigned_agent_id,
			'lender_id' => $assigned_lender_id,
			'user_name' => $lead->display_name,
			'user_email' => $lead->user_email,
			'user_phone' => get_user_meta( $lead_id, 'displet_phone', true ),
		) );
	}

	public static function send_email_to_friend_request() {
		check_ajax_referer( 'displet_email_friend_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_email_friend_request' ) {
			if ( !empty( $_POST['email'] ) && is_email( $_POST['email'] ) ) {
				$user = wp_get_current_user();
				$assigned_agent_id = !empty( $user->ID ) ? DispletRetsIdxLeadsModel::get_assigned_agent_id( $user->ID ) : false;
				$assigned_lender_id = !empty( $user->ID ) ? DispletRetsIdxLeadsModel::get_assigned_lender_id( $user->ID ) : false;
				$user_name = !empty( $user->display_name ) ? $user->display_name : 'A Friend';
				$user_email = !empty( $user->user_email ) ? $user->user_email : false;
				$address = trim( $_POST['address'] ) . ', ' . trim( $_POST['city'] ) . ', ' . trim( $_POST['state'] ) . ' ' . trim( $_POST['zip'] );
				new DispletRetsIdxEmail( 'emailed_friend', array(
					'agent_id' => $assigned_agent_id,
					'friend_email' => $_POST['email'],
					'friend_name' => $_POST['name'],
					'lender_id' => $assigned_lender_id,
					'property_address' => $address,
					'property_url' => $_POST['url'],
					'user_email' => $user_email,
					'user_message' => $_POST['message'],
					'user_name' => $user_name,
				) );
				echo 'Your message has been sent.';
			}
			else{
				echo 'Please enter a valid email address.';
			}
			die();
		}
		echo 'We\'re sorry, there was an error processing your request. Please try again.';
		die();
	}

	protected function _send_emails() {
		if ( !empty( $this->_messages['admin_or_agent_or_lender'] ) && ( !empty( $this->_recipients['admin'] ) || !empty( $this->_recipients['agent'] ) || !empty( $this->_recipients['lender'] ) ) ) {
			$recipients = !empty( $this->_recipients['admin'] ) ? $this->_recipients['admin'] : array();
			if ( !empty( $this->_recipients['agent'] ) ) {
				$recipients[] = $this->_recipients['agent'];
			}
			if ( !empty( $this->_recipients['lender'] ) ) {
				$recipients[] = $this->_recipients['lender'];
			}
			wp_mail( $recipients, $this->_titles['admin_or_agent_or_lender'], $this->_messages['admin_or_agent_or_lender'], $this->_headers );
		}
		if ( !empty( $this->_messages['user_or_friend'] ) && ( !empty( $this->_recipients['user'] ) || !empty( $this->_recipients['friend'] ) ) ) {
			$recipients = array();
			if ( !empty( $this->_recipients['user'] ) ) {
				$recipients[] = $this->_recipients['user'];
			}
			if ( !empty( $this->_recipients['friend'] ) ) {
				$recipients[] = $this->_recipients['friend'];
			}
			wp_mail( $recipients, $this->_titles['user_or_friend'], $this->_messages['user_or_friend'], $this->_headers );
		}
	}

	public static function send_new_user_registration( $email, $name, $phone, $realtor, $url, $username, $password, $assigned_agent_id, $assigned_lender_id ) {
		new DispletRetsIdxEmail( 'registration', array(
			'agent_id' => $assigned_agent_id,
			'lender_id' => $assigned_lender_id,
			'registration_url' => $url,
			'user_email' => $email,
			'user_has_realtor' => $realtor,
			'user_name' => $name,
			'user_password' => $password,
			'user_phone' => $phone,
			'user_username' => $username
		) );
	}

	public static function send_unregistered_address_notification( $address ) {
		if ( !empty( $address ) ) {
			$assigned_agent_id = DispletRetsIdxAgentsController::get_new_duty_agent_id( false, false );
			new DispletRetsIdxEmail( 'address_captured', array(
				'agent_id' => $assigned_agent_id,
				'property_address' => trim( $address ),
			) );
		}
	}

	public static function unschedule_activity_report() {
		wp_clear_scheduled_hook( 'displetactivityreport' );
	}
}

?>