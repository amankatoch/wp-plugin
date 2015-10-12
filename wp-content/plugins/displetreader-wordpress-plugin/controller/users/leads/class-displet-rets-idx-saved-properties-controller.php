<?php

class DispletRetsIdxSavedPropertiesController extends DispletRetsIdxLeadsController {
	public static function delete_saved_properties() {
		check_ajax_referer( 'displet_delete_properties_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_delete_properties_request' ) {
			if ( !empty( $_POST['displet_properties'] ) && is_array( $_POST['displet_properties'] ) ) {
				$user_id = get_current_user_id();
				$saved_properties = get_user_meta( $user_id, 'displet_saved_properties', true );
				$api_user_id = DispletRetsIdxLeadsModel::get_api_user_id( $user_id );
				foreach ( $_POST['displet_properties'] as $property_id ) {
					if ( !empty( $api_user_id ) && isset( $saved_properties[ $property_id ]['api_id'] ) ) {
						DispletRetsIdxUsersApiController::delete_saved_property( $api_user_id, $saved_properties[ $property_id ]['api_id'] );
					}
					unset( $saved_properties[ $property_id ] );
				}
				update_user_meta( $user_id, 'displet_saved_properties', $saved_properties );
				echo 'Succesful Deletion';
			}
			else{
				echo 'No property was selected for deletion.';
			}
			die();
		}
		else {
			echo 'There was an error processing your request. Please try again.';
		}
		die();
	}

	public static function save_property() {
		check_ajax_referer( 'displet_save_property_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_save_property_request' ) {
			if ( !is_user_logged_in() ) {
				echo 'You are not logged in. Please sign in or create an account and try again.';
			}
			elseif ( current_user_can( 'displet_save_properties' ) && !current_user_can( 'manage_options' ) ) {
				if ( !empty( $_POST['type'] ) ) {
					$user = wp_get_current_user();
					if ( !empty( $user->ID ) ) {
						$base = get_permalink( self::$_options['property_details_page_id'] );
						$url = str_replace( $base, '', $_POST['url'] );
						$saved_properties = get_user_meta( $user->ID, 'displet_saved_properties', true );
						$message = !empty( $_POST['message'] ) ? stripslashes( $_POST['message'] ) : '';
						$saved_property = array(
							'address' => $_POST['address'],
							'image_url' => $_POST['image_url'],
							'message' => $message,
							'price' => $_POST['price'],
							'rating' => $_POST['rating'],
							'square_feet' => $_POST['square_feet'],
							'sysid' => $_POST['sysid'],
							'type' => $_POST['type'],
							'url' => $url,
							'zip' => $_POST['zip'],
						);
						$saved_property['api_id'] = DispletRetsIdxSavedPropertiesController::send_saved_property_to_api( $user->ID, $saved_property );
						if ( !empty( $saved_property['sysid'] ) ) {
							if ( !empty( $saved_properties[ $saved_property['sysid'] ] ) && !empty( $saved_properties[ $saved_property['sysid'] ]['message'] ) ) {
								$saved_property['message'] .= PHP_EOL . PHP_EOL . $saved_properties[ $saved_property['sysid'] ]['message'];
							}
							$saved_properties[ $saved_property['sysid'] ] = $saved_property;
						}
						else {
							$saved_properties[] = $saved_property;
						}
						update_user_meta( $user->ID, 'displet_saved_properties', $saved_properties );
						update_user_meta( $user->ID, 'displet_saved_properties_count', count( $saved_properties ) );
						new DispletRetsIdxEmail( 'saved_property', array(
							'agent_id' => DispletRetsIdxLeadsModel::get_assigned_agent_id( $user->ID ),
							'lender_id' => DispletRetsIdxLeadsModel::get_assigned_lender_id( $user->ID ),
							'property_address' => $_POST['address'],
							'property_url' => $_POST['url'],
							'user_email' => $user->user_email,
							'user_message' => $message,
							'user_name' => $user->display_name,
							'user_phone' => $user->displet_phone,
						) );
						do_action( 'displetretsidx_post_lead_saved_property', $user->ID, $saved_property );
						echo 'This property has been saved.';
					}
					else{
						echo 'You are not logged in. Please sign in or create an account and try again.';
					}
				}
				else{
					echo 'Please select Save as favorite, Save as possibility, or Just save notes.';
				}
			}
			else{
				echo 'The current user does not have the capability to save properties.';
			}
			die();
		}
		echo 'We\'re sorry, there was an error processing your request. Please try again.';
		die();
	}

	public static function send_saved_property_to_api( $user_id, $saved_property, $api_user_id = false ) {
		if ( !empty( $user_id ) && !empty( $saved_property ) ) {
			if ( empty( $api_user_id ) ) {
				$api_user_id = DispletRetsIdxLeadsModel::get_api_user_id( $user_id );
			}
			if ( !empty( $api_user_id ) ) {
				return DispletRetsIdxUsersApiController::create_saved_property( $api_user_id, $saved_property['sysid'], $saved_property['type'], $saved_property['rating'], $saved_property['message'] );
			}
		}
	}
}

?>