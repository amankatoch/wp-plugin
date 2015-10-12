<?php

class DispletRetsIdxLeadsController extends DispletRetsIdxLeadsModel {
	public static function add_to_user_page( $user ) {
		if ( user_can( $user->ID, 'displet_save_properties' ) && !user_can( $user->ID, self::$_capabilities['view_leads'] ) ) {
			?>
				<table class="form-table">
					<tr>
						<th><label for="displet_phone">Phone</label></th>
						<td>
							<input type="text" name="displet_phone" id="displet_phone" value="<?php echo esc_attr( get_the_author_meta( 'displet_phone', $user->ID ) ); ?>" class="regular-text"/><br />
						</td>
					</tr>
				</table>
			<?php
		}
	}

	public static function create_new_re_search_user( $args ) {
		$args = wp_parse_args( $args, array(
			'email' => '',
			'name' => '',
			'phone' => '',
			'realtor' => '',
			'url' => '',
			'upstream_url' => '',
			'last_hash' => '',
			'listing_agent_email' => '',
			'user_address' => '',
			'user_address_time' => '',
			'user_registered' => '',
			'send_emails' => true,
			'login_user' => true,
			'use_cron' => true,
		 ) );
		extract( $args );
		if ( !empty( $email ) ) {
			$password = wp_generate_password( 12, false );
			$user_id = wp_insert_user( array(
				'user_login' => $email,
				'user_email' => $email,
				'user_pass' => $password,
				'role' => 'displet_user',
			 ) );
			if ( is_wp_error( $user_id ) ) {
				if ( is_multisite() && $user_id->get_error_code() == 'existing_user_login' ) {
					$user = get_user_by( 'email', $email );
					if ( !empty( $user ) ) {
						$site = get_current_site();
						$blogs = get_blogs_of_user( $user->ID );
						if ( !DispletRetsIdxUtilities::in_array_of_objects( $site->id, $blogs, 'userblog_id' ) ) {
							$success = add_user_to_blog( $site->id, $user->ID, 'displet_user' );
							if ( !empty( $success ) && !is_wp_error( $success ) ) {
								$user_id = $user->ID;
								$user_info = get_userdata( $user_id );
								if ( $login_user ) {
									wp_set_auth_cookie( $user_id );
								}
							}
						}
					}
				}
				if ( is_wp_error( $user_id ) ) {
					return $user_id->get_error_message();
				}
			}
			else{
				$user_info = get_userdata( $user_id );
				if ( $login_user ) {
					$creds = array(
						'user_login' => $user_info->user_login,
						'user_password' => $password,
						'remember' => true
					 );
					$user = wp_signon( $creds, false );
				}
			}
			$names = DispletRetsIdxUsersModel::get_first_and_last_name( $name );
			$update_user_args = array(
				'ID' => $user_id,
				'role' => 'displet_user',
				'display_name' => ucwords( $name ),
			);
			if ( !empty( $user_registered ) ) {
				$time = strtotime( $user_registered );
				if ( !empty( $time ) ) {
					$update_user_args['user_registered'] = get_gmt_from_date( date_i18n( 'Y-m-d H:i:s', $time ) );
				}
			}
			wp_update_user( $update_user_args );
			$assigned_agent_id = DispletRetsIdxAgentsController::get_new_duty_agent_id( $listing_agent_email );
			$assigned_lender_id = DispletRetsIdxLendersController::get_new_duty_lender_id();
			if ( $send_emails ) {
				DispletRetsIdxEmailController::send_new_user_registration( $email, $name, $phone, $realtor, $url, $user_info->user_login, $password, $assigned_agent_id, $assigned_lender_id );
			}
			$user_details = array(
				'assigned_agent_id' => $assigned_agent_id,
				'assigned_lender_id' => $assigned_lender_id,
				'email' => $email,
				'first_name' => $names['first_name'],
				'last_hash' => $last_hash,
				'last_name' => $names['last_name'],
				'name' => $name,
				'phone' => $phone,
				'realtor' => $realtor,
				'upstream_url' => $upstream_url,
				'url' => $url,
				'user_address' => urldecode( $user_address ),
				'user_address_time' => $user_address_time,
				'user_id' => $user_id,
			 );
			if ( $use_cron ) {
				wp_schedule_single_event( time(), 'displetretsidx_new_user_cron_jobs', array( $user_details ) );
			}
			else{
				DispletRetsIdxLeadsController::new_user_cron_jobs( $user_details );
			}
			unset( $user_details['user_id'] );
			unset( $user_details['listing_agent_email'] ); // Specific to RAPB, would confuser users of hook
			unset( $user_details['user_address'] ); // Specific to DispletHomeValue themes, avoiding confusion
			unset( $user_details['user_address_time'] ); // Specific to DispletHomeValue themes, avoiding confusion
			do_action( 'displetretsidx_post_registration', $user_id, $user_details );
			return array(
				'success' => true,
				'user_id' => $user_id,
			);
		}
	}

	public static function delete_users() {
		check_ajax_referer( 'displet_delete_users_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_delete_users_request' ) {
			if ( !empty( $_POST['displet_users'] ) ) {
				$error_occurred = false;
				foreach ( $_POST['displet_users'] as $user ) {
					$deleted[] = wp_delete_user( $user );
					do_action( 'displetretsidx_post_delete_lead', $user );
				}
				foreach ( $deleted as $was_deleted ) {
					if ( !$was_deleted ) {
						$error_occurred = true;
					}
				}
				if ( $error_occurred ) {
					echo 'There was an error processing your request.';
				}
				else{
					echo 'Succesful Deletion';
				}
			}
			die();
		}
	}

	public static function import_single_user_cron_job( $user, $send_emails ) {
		if ( !empty( $user['email'] ) ) {
			DispletRetsIdxLeadsController::create_new_re_search_user( array(
				'email' => $user['email'],
				'name' => $user['name'],
				'phone' => $user['phone'],
				'user_registered' => $user['date'],
				'url' => 'User Import',
				'send_emails' => !empty( $send_emails ) ? true : false,
				'login_user' => false,
				'use_cron' => false,
			 ) );
		}
	}

	public static function import_users_cron_job( $users, $send_emails ) {
		if ( !empty( $users ) && is_array( $users ) ) {
			$time = time();
			foreach ( $users as $user ) {
				if ( !empty( $user['email'] ) ) {
					wp_schedule_single_event( $time, 'displetretsidx_import_single_user_cron_job', array( $user, $send_emails ) );
				}
				$time += 30;
			}
		}
	}

	public function import_users_from_csv( $csv_path, $send_emails ) {
		if ( !empty( $csv_path ) ) {
			$handle = fopen( $csv_path, 'r' );
			if ( !empty( $handle ) ) {
				$keys = array_map( 'strtolower', fgetcsv( $handle, 0 ) );
				while ( !feof( $handle ) ) {
					$csv_array = fgetcsv( $handle, 0 );
					if ( !empty( $csv_array ) ) {
				    	$users[] = array_combine( $keys, $csv_array );
					}
				}
				wp_schedule_single_event( time(), 'displetretsidx_import_users_cron_job', array( $users, $send_emails ) );
			    fclose( $handle );
			}
		}
	}

	public static function maybe_do_austin_home_value_new_user_jobs( $user_id, $address, $address_time ) {
		if ( !empty( $address ) && DispletRetsIdxUtilities::is_unregistered_address_theme() ) {
			if ( !empty( $user_id ) ) {
				update_user_meta( $user_id, 'displet_user_submitted_address', $address );
			}
			self::_remove_partial_match_row( $address );
			wp_unschedule_event( $address_time, 'displetretsidx_send_unregistered_address_notification', array( $address ) );
		}
	}

	public static function new_user_cron_jobs( $args ) {
		extract( $args );
		update_user_meta( $user_id, 'displet_lead', true );
		update_user_meta( $user_id, 'displet_agent_id', $assigned_agent_id );
		update_user_meta( $user_id, 'displet_lender_id', $assigned_lender_id );
		update_user_meta( $user_id, 'first_name', $first_name );
		update_user_meta( $user_id, 'last_name', $last_name );
		update_user_meta( $user_id, 'nickname', ucwords( $name ) );
		update_user_meta( $user_id, 'displet_phone', $phone );
		update_user_meta( $user_id, 'displet_realtor', $realtor );
		update_user_meta( $user_id, 'displet_registration_url', $url );
		update_user_meta( $user_id, 'displet_registration_upstream_url', $upstream_url );
		update_user_meta( $user_id, 'displet_last_hash', $last_hash );
		DispletRetsIdxLeadsController::maybe_do_austin_home_value_new_user_jobs( $user_id, $user_address, $user_address_time );
		$zap_user = array(
			'came_from' => $upstream_url,
			'email' => $email,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'name' => $name,
			'phone' => $phone,
			'registered_at' => $url,
			'user_profile_url' => admin_url( 'admin.php?page=displet-lead-manager&user_id=' . $user_id ),
			'website' => home_url(),
		);
		DispletRetsIdxUsersController::send_to_zapier( $zap_user, 'registration' );
		$api_agent_id = !empty( $assigned_agent_id ) ? get_user_meta( $assigned_agent_id, self::$_meta_keys['agent']['api_id'], true ) : false;
		$api_user_id = DispletRetsIdxUsersApiController::create_user( $email, $first_name, $last_name, $phone, $api_agent_id );
		if ( !empty( $api_user_id ) ) {
			update_user_meta( $user_id, 'displet_api_user_id', $api_user_id );
			$property_id = DispletRetsIdxRewriteModel::get_property_id_from_url( $url );
			DispletRetsIdxUsersApiController::update_user_property_views( $api_user_id, $property_id );
			do_action( 'displetretsidx_post_lead_assigned_api_user_id', $user_id, $api_user_id );
		}
		do_action( 'displetretsidx_post_lead_registration_cron_jobs', $user_id );
	}

	public static function reassign_user( $user_id, $agent_id = false, $lender_id = false ) {
		if ( !empty( $user_id ) && ( !empty( $agent_id ) || !empty( $lender_id ) ) ) {
			if ( !empty( $_POST['displet_agent'] ) ) {
				update_user_meta( $user_id, 'displet_agent_id', $agent_id );
			}
			if ( !empty( $_POST['displet_lender'] ) ) {
				update_user_meta( $user_id, 'displet_lender_id', $lender_id );
			}
			DispletRetsIdxEmailController::send_assigned_lead_message( $user_id, $agent_id, $lender_id );
			self::update_assigned_agent_id_at_api( $user_id, $agent_id );
			$assignation_details = array(
				'assigned_agent_id' => !empty( $agent_id ) ? intval( $agent_id ) : false,
				'assigned_lender_id' => !empty( $lender_id ) ? intval( $lender_id ) : false,
			);
			do_action( 'displetretsidx_post_lead_reassigned', $user_id, $assignation_details );
		}
	}

	private static function _remove_partial_match_row( $address ) {
		if ( !empty( $address ) ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'displet_partial_addresses';
			$where = array(
				'address' => $address,
			);
			$where_format = '%s';
			$wpdb->delete( $table_name, $where, $where_format );
		}
	}

	public static function save_from_user_page( $user_id ) {
		if ( user_can( $user_id, 'displet_save_properties' ) && !user_can( $user->ID, self::$_capabilities['view_leads'] ) && current_user_can( 'edit_user', $user_id ) ) {
			if ( isset( $_POST['displet_phone'] ) ) {
				update_user_meta( $user_id, 'displet_phone', $_POST['displet_phone'] );
			}
			$api_user_id = get_user_meta( $user_id, 'displet_api_user_id', true );
			if ( !empty( $api_user_id ) ) {
				$user_array = array();
				if ( !empty( $_POST['first_name'] ) ) {
					$user_array['first_name'] = $_POST['first_name'];
				}
				if ( !empty( $_POST['last_name'] ) ) {
					$user_array['last_name'] = $_POST['last_name'];
				}
				if ( !empty( $_POST['email'] ) ) {
					$user_array['email'] = $_POST['email'];
				}
				if ( !empty( $_POST['displet_phone'] ) ) {
					$user_array['phone'] = $_POST['displet_phone'];
				}
				DispletRetsIdxUsersApiController::update_user( $api_user_id, $user_array );
			}
			$agent_id = get_user_meta( $user_id, 'displet_agent_id', true );
			$user_details = array(
				'assigned_agent_id' => !empty( $agent_id ) ? intval( $agent_id ) : false,
				'email' => $_POST['email'],
				'first_name' => $_POST['first_name'],
				'last_name' => $_POST['last_name'],
				'phone' => $_POST['displet_phone'],
			);
			do_action( 'displetretsidx_post_update_lead', $user_id, $user_details );
		}
	}

	public static function submit_registration_ajax() {
		check_ajax_referer( 'displet_register_user_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_user_registration_request' ) {
			if ( !empty( $_POST['name'] ) && !empty( $_POST['email'] ) && ( empty( self::$_options['require_phone'] ) || !empty( $_POST['phone'] ) ) && ( empty( self::$_options['require_working_with_realtor'] ) || empty( self::$_options['include_working_with_realtor'] ) || !empty( $_POST['realtor'] ) ) ) {
				if ( is_email( $_POST['email'] ) ) {
					$is_blacklisted_email = DispletRetsIdxLeadsModel::is_blacklisted_email( $_POST['email'] );
					$is_blacklisted_name = DispletRetsIdxLeadsModel::is_blacklisted_name( $_POST['name'] );
					if ( !empty( $is_blacklisted_email ) ) {
						echo 'We\'re sorry, the email address provided has been prohibited.';
					}
					else if ( !empty( $is_blacklisted_name ) ) {
						echo 'We\'re sorry, the name provided has been prohibited.';
					}
					else {
						$result = DispletRetsIdxLeadsController::create_new_re_search_user( array(
							'email' => $_POST['email'],
							'name' => $_POST['name'],
							'phone' => $_POST['phone'],
							'realtor' => $_POST['realtor'],
							'url' => $_POST['url'],
							'upstream_url' => $_POST['upstream_url'],
							'last_hash' => $_POST['last_hash'],
							'listing_agent_email' => $_POST['listing_agent_email'],
							'user_address' => $_POST['user_address'],
							'user_address_time' => $_POST['user_address_time'],
						) );
						if ( !empty( $result['success'] ) ) {
							echo 'Successful Registration';
						}
						else {
							echo $result;
						}
					}
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

	public static function update_assigned_agent_id_at_api( $lead_user_id, $agent_user_id ) {
		if ( !empty( $lead_user_id ) && !empty( $agent_user_id ) ) {
			$api_user_id = get_user_meta( $lead_user_id, self::$_meta_keys['api_user_id'], true );
			$api_agent_id = get_user_meta( $agent_user_id, self::$_meta_keys['agent']['api_id'], true );
			if ( !empty( $api_user_id ) && !empty( $api_agent_id ) ) {
				DispletRetsIdxUsersApiController::update_user( $api_user_id, array(
					'agent_profile_id' => $api_agent_id,
				) );
			}
		}
	}

	public static function update_last_login( $user_login, $user ) {
		if ( user_can( $user->ID, 'displet_save_properties' ) && !user_can( $user->ID, 'manage_options' ) && !user_can( $user->ID, 'displet_view_leads' ) ) {
			$login_timestamps = get_user_meta( $user->ID, 'displet_logins', true );
			if ( empty( $login_timestamps ) || !is_array( $login_timestamps ) ) {
				$login_timestamps = array();
			}
			$last_login = current_time( 'timestamp' );
			$login_timestamps[] = $last_login;
			$logins_count = count( $login_timestamps );
			update_user_meta( $user->ID, 'displet_last_login', $last_login );
			update_user_meta( $user->ID, 'displet_logins', $login_timestamps );
			update_user_meta( $user->ID, 'displet_logins_count', $logins_count );
			do_action( 'displetretsidx_post_lead_login', $user->ID, array(
				'all_logins' => $login_timestamps,
				'last_login' => $last_login,
				'login_count' => $logins_count,
			) );
		}
	}
}

?>