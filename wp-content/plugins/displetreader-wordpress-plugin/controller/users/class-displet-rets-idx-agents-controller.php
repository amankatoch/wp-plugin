<?php

class DispletRetsIdxAgentsController extends DispletRetsIdxAgentsModel {
	public static function add_to_agent_page( $user ) {
		if ( user_can( $user->ID, 'displet_view_leads' ) ) {
			?>
				<h3>Displet RETS/IDX Settings</h3>
				<table class="form-table">
					<tr>
						<th>
							<label for="<?php echo self::$_meta_keys['agent']['phone']; ?>">
								Phone
							</label>
						</th>
						<td>
							<input type="text" name="<?php echo self::$_meta_keys['agent']['phone']; ?>" id="<?php echo self::$_meta_keys['agent']['phone']; ?>" class="regular-text" value="<?php echo esc_attr( $user->{ self::$_meta_keys['agent']['phone'] } ); ?>"/>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo self::$_meta_keys['agent']['address']; ?>">
								Address
							</label>
						</th>
						<td>
							<textarea name="<?php echo self::$_meta_keys['agent']['address']; ?>" id="<?php echo self::$_meta_keys['agent']['address']; ?>" rows="5" cols="30"><?php echo esc_textarea( $user->{ self::$_meta_keys['agent']['address'] } ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo self::$_meta_keys['agent']['facebook_url']; ?>">
								Facebook URL
							</label>
						</th>
						<td>
							<input type="text" name="<?php echo self::$_meta_keys['agent']['facebook_url']; ?>" id="<?php echo self::$_meta_keys['agent']['facebook_url']; ?>" class="regular-text" value="<?php echo esc_attr( $user->{ self::$_meta_keys['agent']['facebook_url'] } ); ?>"/>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo self::$_meta_keys['agent']['instagram_url']; ?>">
								Instagram URL
							</label>
						</th>
						<td>
							<input type="text" name="<?php echo self::$_meta_keys['agent']['instagram_url']; ?>" id="<?php echo self::$_meta_keys['agent']['instagram_url']; ?>" class="regular-text" value="<?php echo esc_attr( $user->{ self::$_meta_keys['agent']['instagram_url'] } ); ?>"/>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo self::$_meta_keys['agent']['linkedin_url']; ?>">
								LinkedIn URL
							</label>
						</th>
						<td>
							<input type="text" name="<?php echo self::$_meta_keys['agent']['linkedin_url']; ?>" id="<?php echo self::$_meta_keys['agent']['linkedin_url']; ?>" class="regular-text" value="<?php echo esc_attr( $user->{ self::$_meta_keys['agent']['linkedin_url'] } ); ?>"/>
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo self::$_meta_keys['agent']['headshot_url']; ?>">
								Headshot URL
							</label>
						</th>
						<td>
							<div id="<?php echo self::$_meta_keys['agent']['headshot_url']; ?>-display" class="displet-photo-display" style="background-image: url('<?php echo esc_attr( $user->{ self::$_meta_keys['agent']['headshot_url'] } ); ?>'); <?php if ( empty( $user->{ self::$_meta_keys['agent']['headshot_url'] } ) ) echo 'display: none;'; ?>"></div>
							<input type="text" name="<?php echo self::$_meta_keys['agent']['headshot_url']; ?>" id="<?php echo self::$_meta_keys['agent']['headshot_url']; ?>" class="regular-text" value="<?php echo esc_attr( $user->{ self::$_meta_keys['agent']['headshot_url'] } ); ?>"/>
							<input type="button" id="<?php echo self::$_meta_keys['agent']['headshot_url']; ?>-upload" class="button" value="Select Image" />
						</td>
					</tr>
					<tr>
						<th>
							<label for="<?php echo self::$_meta_keys['agent']['email_signature']; ?>">
								Email Signature
							</label>
						</th>
						<td>
							<textarea name="<?php echo self::$_meta_keys['agent']['email_signature']; ?>" id="<?php echo self::$_meta_keys['agent']['email_signature']; ?>" rows="5" cols="30"><?php echo esc_textarea( $user->{ self::$_meta_keys['agent']['email_signature'] } ); ?></textarea>
							<br/>
							<span class="description">
								Displayed at the bottom of each outbound email.
							</span>
						</td>
					</tr>
				</table>
			<?php
		}
	}

	public static function delete_agent_from_api( $user_id ) {
		if ( !empty( $user_id ) ) {
			$userdata = get_userdata( $user_id );
			$args = array(
				'agent_id' => $userdata->{ self::$_meta_keys['agent']['api_id'] },
			);
			if ( !empty( $args['agent_id'] ) ) {
				$api = new DispletRetsIdxAgentsApi( $args );
				$api->delete();
			}
		}
	}

	public static function get_clients_ajax() {
		check_ajax_referer( 'displet_get_clients_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_get_clients_request' ) {
			$args = array(
				'orderby' => 'display_name',
			);
			if ( current_user_can( 'manage_options' ) ) {
				$clients = DispletRetsIdxLeadsModel::get_users( false, $args );
			}
			else{
				$user_id = get_current_user_id();
				if ( !empty( $user_id ) ) {
					$clients = DispletRetsIdxLeadsModel::get_users( $user_id, $args );
				}
			}
			if ( !empty( $clients ) && is_array( $clients ) ) {
				$output = array();
				foreach ( $clients as $client ) {
					$output[] = array(
						'name' => $client->display_name,
						'id' => $client->ID
					 );
				}
				echo json_encode( $output );
			}
			else{
				echo 'No matching users.';
			}
		}
		else{
			echo 'There was an error processing your request. Please try again.';
		}
		die();
	}

	public static function get_new_duty_agent_id( $listing_agent_email, $rotate_duty_agent = true ) {
		if ( !empty( self::$_options['duty_agent_use_listing_agent_email'] ) && !empty( $listing_agent_email ) ) {
			$listing_agent_user = get_user_by( 'email', $listing_agent_email );
		}
		if ( !empty( $listing_agent_user ) ) {
			return $listing_agent_user->ID;
		}
		else{
			$duty_agent_array_position = get_option( 'displet_rets_idx_duty_agent_array_position' );
			if ( !empty( self::$_options['duty_agent'] ) ) {
				$duty_agents = array();
				foreach ( self::$_options['duty_agent'] as $agent_id => $value ) {
					if ( !empty( $value ) ) {
						$duty_agents[] = $agent_id;
					}
				}
				if ( !empty( $duty_agents ) ) {
					if ( !empty( $duty_agent_array_position ) && intval( $duty_agent_array_position ) < count( $duty_agents ) ) {
						$i = intval( $duty_agent_array_position );
					}
					else{
						$i = 0;
					}
					if ( $rotate_duty_agent ) {
						$duty_agent_array_position = $i;
						$duty_agent_array_position++;
						update_option( 'displet_rets_idx_duty_agent_array_position', $duty_agent_array_position );
					}
					return $duty_agents[$i];
				}
			}
		}
	}

	private static function _save_api_agent_id( $user_id, $api_agent_id ) {
		if ( !empty( $api_agent_id ) ) {
			update_user_meta( $user_id, self::$_meta_keys['agent']['api_id'], $api_agent_id );
		}
	}

	public static function save_from_agent_page( $user_id ) {
		if ( user_can( $user_id, 'displet_view_leads' ) && current_user_can( 'edit_user', $user_id ) ) {
			if ( !empty( self::$_meta_keys['agent'] ) && is_array( self::$_meta_keys['agent'] ) ) {
				foreach ( self::$_meta_keys['agent'] as $meta_key ) {
					if ( isset( $_POST[ $meta_key ] ) ) {
						update_user_meta( $user_id, $meta_key, $_POST[ $meta_key ] );
					}
				}
			}
		}
	}

	public static function send_agent_to_api( $user_id ) {
		if ( !empty( $user_id ) ) {
			$userdata = get_userdata( $user_id );
			$args = array(
				'address' => $userdata->{ self::$_meta_keys['agent']['address'] },
				'email' => $userdata->user_email,
				'email_signature' => $userdata->{ self::$_meta_keys['agent']['email_signature'] },
				'facebook_url' => $userdata->{ self::$_meta_keys['agent']['facebook_url'] },
				'headshot_url' => $userdata->{ self::$_meta_keys['agent']['headshot_url'] },
				'instagram_url' => $userdata->{ self::$_meta_keys['agent']['instagram_url'] },
				'linkedin_url' => $userdata->{ self::$_meta_keys['agent']['linkedin_url'] },
				'name' => $userdata->display_name,
				'phone' => $userdata->{ self::$_meta_keys['agent']['phone'] },
			);
			if ( !empty( $userdata->{ self::$_meta_keys['agent']['api_id'] } ) ) {
				$args['agent_id'] = $userdata->{ self::$_meta_keys['agent']['api_id'] };
			}
			$api = new DispletRetsIdxAgentsApi( $args );
			if ( !empty( $args['agent_id'] ) ) {
				$api->update();
			}
			else {
				$agent_id = $api->create();
				self::_save_api_agent_id( $user_id, $agent_id );
			}
		}
	}

	public static function send_new_agent_to_api_on_user_creation( $user_id ) {
		if ( isset( $_POST['role'] ) && ( $_POST['role'] === self::$_roles['agent'] || $_POST['role'] === 'administrator' ) ) {
			self::send_agent_to_api( $user_id );
		}
	}

	public static function update_agent_at_api( $user_id ) {
		if ( !empty( $user_id ) && user_can( $user_id, self::$_capabilities['view_leads'] ) ) {
			self::send_agent_to_api( $user_id );
		}
	}
}

?>