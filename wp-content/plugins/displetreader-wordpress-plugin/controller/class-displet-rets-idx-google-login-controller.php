<?php

class DispletRetsIdxGoogleLoginController extends DispletRetsIdxPlugin {
	private static function get_client(){
		global $displetretsidx_option;
		if (!empty($displetretsidx_option['google_client_id']) && !empty($displetretsidx_option['google_client_secret']) && !empty($displetretsidx_option['google_api_key'])){
			$client = new displetretsidx_Google_Client();
			//$client->setApplicationName("Google UserInfo PHP Starter Application");
			$client->setClientId($displetretsidx_option['google_client_id']);
			$client->setClientSecret($displetretsidx_option['google_client_secret']);
			$client->setDeveloperKey($displetretsidx_option['google_api_key']);
			$client->setRedirectUri(home_url('wp-login.php?loginGoogle=1'));
			$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
			return $client;
		}
		return false;
	}

	public static function get_authorization_url(){
		$client = self::get_client();
		if (!empty($client)) {
			$auth_url = $client->createAuthUrl();
			return $auth_url;
		}
		return false;
	}

	public static function login_register_user() {
		if ($_REQUEST['loginGoogle'] == '1') {
			$client = self::get_client();

			session_start();
			$oauth2 = new displetretsidx_Google_Oauth2Service($client);

			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				$_SESSION['token'] = $client->getAccessToken();
			}

			if (isset($_SESSION['token'])) {
				$client->setAccessToken($_SESSION['token']);
			}

			if ($client->getAccessToken()) {
				$user = $oauth2->userinfo->get();

				// Filtered via PHP sanitize filters
				$email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
				global $displetretsidx_event_tracking_email;
				$displetretsidx_event_tracking_email = $email;

				$user_id = DispletRetsIdxUsersModel::get_user_id_by_email($email);
				if ( !empty( $user_id ) ) {
					wp_set_auth_cookie( $user_id, true );
					add_action('login_head', array('DispletRetsIdxGoogleLoginController', 'include_login_event_tracking_code'), 999999999999);
				}
				else {
					$user_registration_response = DispletRetsIdxLeadsController::create_new_re_search_user(array(
						'email' => $email,
						'name' => $user['name'],
						'phone' => 'Google',
						'url' => $_COOKIE['displet_registration_url'],
						'upstream_url' => $_COOKIE['displet_upstream_url'],
						'last_hash' => $_COOKIE['displetretsidx_last_viewed_hash']
					));
					if (!empty($user_registration_response['success'])) {
						add_action('login_head', array('DispletRetsIdxGoogleLoginController', 'include_registration_event_tracking_code'), 999999999999);
					}
				}
			}
		}
	}

	public static function include_login_event_tracking_code(){
		global $displetretsidx_event_tracking_email;
		echo
			"<script>
				if (typeof(_gaq) !== 'undefined' || typeof(ga) !== 'undefined') {
					if (typeof(_gaq) !== 'undefined') {
						_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'Existing User Login', '" . $displetretsidx_event_tracking_email . "']);
					}
					else {
						ga('send', 'event', 'Displet RETS/IDX', 'Existing User Login', '" . $displetretsidx_event_tracking_email . "');
					}
					setTimeout(function(){
						window.close();
					}, 1000);
				}
				else{
					window.close();
				}
			</script>";
	}

	public static function include_registration_event_tracking_code(){
		global $displetretsidx_event_tracking_email;
		echo
			"<script>
				if (typeof(_gaq) !== 'undefined' || typeof(ga) !== 'undefined') {
					if (typeof(_gaq) !== 'undefined') {
						_gaq.push(['_trackEvent', 'Displet RETS/IDX', 'New User Registration', '" . $displetretsidx_event_tracking_email . "']);
					}
					else {
						ga('send', 'event', 'Displet RETS/IDX', 'New User Registration', '" . $displetretsidx_event_tracking_email . "');
					}
					setTimeout(function(){
						window.close();
					}, 1000);
				}
				else{
					window.close();
				}
			</script>";
	}
}

?>