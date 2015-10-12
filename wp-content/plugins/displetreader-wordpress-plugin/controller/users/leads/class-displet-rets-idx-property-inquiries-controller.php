<?php

class DispletRetsIdxPropertyInquiriesController extends DispletRetsIdxLeadsController {
	private static function _new( $user_id, $args ) {
		extract( wp_parse_args( $args, array(
			'address' => '',
			'appointment1' => '',
			'appointment2' => '',
			'city' => '',
			'email' => '',
			'message' => '',
			'mls_number' => '',
			'name' => '',
			'phone' => '',
			'state' => '',
			'url' => '',
			'zip' => '',
		) ) );
		$assigned_agent_id = DispletRetsIdxLeadsModel::get_assigned_agent_id( $user_id );
		$assigned_lender_id = DispletRetsIdxLeadsModel::get_assigned_lender_id( $user_id );
		$comma_separated_address_components = array_filter( array(
			$address,
			$city,
			$state,
		), 'trim' );
		$address = !empty( $comma_separated_address_components ) ? implode( ', ',  $comma_separated_address_components ) : '';
		if ( !empty( $zip ) ) {
			$address .= ' ' . trim( $zip );
		}
		new DispletRetsIdxEmail( 'showing_request', array(
			'agent_id' => $assigned_agent_id,
			'lender_id' => $assigned_lender_id,
			'property_address' => trim( $address ),
			'property_mls' => $mls_number,
			'property_url' => $url,
			'user_appointment' => $appointment1,
			'user_appointment2' => $appointment2,
			'user_email' => $email,
			'user_message' => $message,
			'user_name' => $name,
			'user_phone' => $phone,
		) );
		$inquiry_details = array(
			'email' => $email,
			'name' => $name,
			'phone' => $phone,
			'address' => $address,
			'first_appointment' => $appointment1,
			'second_appointment' => $appointment2,
			'message' => $message,
		);
		DispletRetsIdxPropertyInquiriesController::update_property_inquiries( $user_id, $inquiry_details );
		DispletRetsIdxUsersController::send_to_zapier( $inquiry_details, 'showing' );
	}

	public static function send_property_showing_request() {
		check_ajax_referer( 'displet_property_showing_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_property_showing_request' ) {
			if ( !empty( $_POST['name'] ) && !empty( $_POST['email'] ) && ( empty( self::$_options['showing_request_require_phone'] ) || !empty( $_POST['phone'] ) ) ) {
				if ( is_email( $_POST['email'] ) ) {
					$created_user = false;
					if ( is_user_logged_in() ) {
						$user_id = get_current_user_id();
					}
					else {
						$user = get_user_by( 'email', $_POST['email'] );
						if ( empty( $user ) ) {
							$new_user = DispletRetsIdxLeadsController::create_new_re_search_user( array(
								'email' => $_POST['email'],
								'name' => $_POST['name'],
								'phone' => $_POST['phone'],
								'url' => $_POST['url'],
								'upstream_url' => $_POST['upstream_url'],
								'last_hash' => $_POST['last_hash'],
								'listing_agent_email' => $_POST['listing_agent_email'],
								'use_cron' => false,
							) );
							if ( $new_user['success'] ) {
								$user_id = $new_user['user_id'];
								$created_user = true;
							}
						}
					}
					self::_new( $user_id, array(
						'address' => $_POST['address'],
						'appointment1' => $_POST['appointment1'],
						'appointment2' => $_POST['appointment2'],
						'city' => $_POST['city'],
						'email' => $_POST['email'],
						'message' => trim( $_POST['message'] ),
						'mls_number' => $_POST['mls_number'],
						'name' => $_POST['name'],
						'phone' => $_POST['phone'],
						'state' => $_POST['state'],
						'url' => $_POST['url'],
						'zip' => $_POST['zip'],
					) );
					$response = 'Sent Showing Request';
					if ( $created_user ) {
						$response .= ' and Created User';
					}
					echo $response;
				}
				else{
					echo 'Please enter a valid email address.';
				}
			}
			else{
				echo 'Please complete the required fields.';
			}
			die();
		}

		echo 'We\'re sorry, there was an error processing your request. Please try again.';
		die();
	}

	public static function update_property_inquiries( $user_id, $details ) {
		if ( !empty( $user_id ) ) {
			$inquiries = get_user_meta( $user_id, 'displet_property_inquiries', true );
			if ( empty( $inquiries ) ) {
				$inquiries = array();
			}
			$inquiries[] = $details;
			update_user_meta( $user_id, 'displet_property_inquiries', $inquiries );
			update_user_meta( $user_id, 'displet_property_inquiries_count', count( $inquiries ) );
		}
	}
}

?>