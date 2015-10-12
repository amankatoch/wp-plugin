<?php

class DispletRetsIdxUsersController extends DispletRetsIdxUsersModel {
	public static function check_login_ajax() {
		check_ajax_referer( 'displet_check_login_nonce' );
		if ( is_user_logged_in() ) {
			echo 'Successful Login';
		}
		else{
			echo 'User Not Logged In';
		}
		die();
	}

	public static function login_existing_facebook_user_ajax() {
		check_ajax_referer( 'displet_check_user_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_user_check_request' && !empty( $_POST['email'] ) && !empty( $_POST['token'] ) ) {
			$user_id = DispletRetsIdxUsersModel::get_user_id_by_email( $_POST['email'] );
			if ( !empty( $user_id ) ) {
				$json_array = wp_remote_post( 'https://graph.facebook.com/oauth/access_token?client_id=' . self::$_options['facebook_app_id'] . '&client_secret=' . self::$_options['facebook_app_secret'] . '&grant_type=client_credentials' );
				if ( !empty( $json_array['body'] ) ) {
					$response = wp_remote_get( 'https://graph.facebook.com/debug_token?input_token=' . $_POST['token'] . '&' . $json_array['body'] );
					if ( !empty( $response['body'] ) ) {
						$result = json_decode( $response['body'] );
						if ( !empty( $result->data ) && !empty( $result->data->is_valid ) && !empty( $result->data->app_id ) && $result->data->app_id === self::$_options['facebook_app_id'] ) {
							wp_set_auth_cookie( $user_id, true );
							echo 'User Exists and Logged In';
						}
					}
				}
			}
			else {
				echo 'There is no email account associated with this user.';
			}
			die();
		}
		echo 'We\'re sorry, there was an error processing your request. Please try again.';
		die();
	}

	public static function login_user_ajax() {
		check_ajax_referer( 'displet_login_user_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displetretsidx_user_signon' ) {
			if ( !empty( $_POST['email'] ) && ( !empty( $_POST['password'] ) || !empty( self::$_options['login_without_password'] ) ) ) {
				$logged_in = false;
				if ( !empty( self::$_options['login_without_password'] ) ) {
					$user = get_user_by( 'login', $_POST['email'] );
					if ( !empty( $user->roles ) && is_array( $user->roles ) && in_array( 'displet_user', $user->roles ) ) {
						$logged_in = true;
						wp_set_auth_cookie( $user->ID );
					}
					else{
						echo 'We were not able to locate this user. Please check your entry and try again.';
					}
				}
				else{
					$creds = array();
					$creds['user_login'] = $_POST['email'];
					$creds['user_password'] = $_POST['password'];
					$creds['remember'] = true;
					$user = wp_signon( $creds, false );
					if ( is_wp_error( $user ) ) {
						echo $user->get_error_message();
					}
					else if ( !empty( $user ) ) {
						$logged_in = true;
					}
				}
				if ( $logged_in ) {
					echo 'Successful Login';
				}
			}
			else {
				echo 'Please complete the required fields.';
			}
			die();
		}

		echo 'We\'re sorry, there was an error processing your request. Please try again.';
		die();
	}

	public static function send_to_zapier( $user_data, $zap ) {
		if ( !empty( self::$_options['zapier_' . $zap . '_url'] ) ) {
			$request = array(
				'user-agent' => 'Displet',
				'body' => $user_data,
				'referer' => home_url()
			 );
			$urls = array_map( 'trim', explode( "\n", self::$_options['zapier_' . $zap . '_url'] ) );
			foreach ( $urls as $url ) {
				$post_url = trim( $url );
				if ( !empty( $post_url ) ) {
					wp_remote_post( $post_url, $request );
				}
			}
		}
	}
}

?>