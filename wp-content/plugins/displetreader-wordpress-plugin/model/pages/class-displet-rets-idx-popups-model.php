<?php

class DispletRetsIdxPopupsModel extends DispletRetsIdxPagesModel {
	public static function build_login_register() {
		self::$_model['google_auth_url'] = DispletRetsIdxGoogleLoginController::get_authorization_url();
	}
}

?>