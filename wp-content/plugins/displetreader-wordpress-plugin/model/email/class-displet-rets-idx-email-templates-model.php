<?php

class DispletRetsIdxEmailTemplatesModel extends DispletRetsIdxEmailModel {
	protected static $_options_slugs_for_api_params_with_placeholders = array(
		'assigned_lead_agent_message' => 'email_template_assigned_lead',
		'assigned_lead_agent_title' => 'email_title_assigned_lead',
		'email_signature' => 'email_signature',
		'emailed_friend_agent_message' => 'email_template_email_friend_to_admin',
		'emailed_friend_agent_title' => 'email_title_email_friend_to_admin',
		'emailed_friend_user_message' => 'email_template_email_friend_to_user',
		'emailed_friend_user_title' => 'email_title_email_friend_to_user',
		'new_registration_agent_message' => 'email_template_new_registration_to_admin',
		'new_registration_agent_title' => 'email_title_new_registration_to_admin',
		'new_registration_user_message' => 'email_template_new_registration_to_user',
		'new_registration_user_title' => 'email_title_new_registration_to_user',
		'saved_property_agent_message' => 'email_template_saved_property_to_admin',
		'saved_property_agent_title' => 'email_title_saved_property_to_admin',
		'saved_search_agent_message' => 'email_template_saved_search_to_admin',
		'saved_search_agent_title' => 'email_title_saved_search_to_admin',
		'showing_request_agent_message' => 'email_template_property_showing_to_admin',
		'showing_request_agent_title' => 'email_title_property_showing_to_admin',
		'showing_request_user_message' => 'email_template_property_showing_to_user',
		'showing_request_user_title' => 'email_title_property_showing_to_user',
	);

	protected static $_option_slugs_for_api_params_without_placeholders = array(
		'banner_ad_url' => 'email_template_banner_image_id',
		'logo_url' => 'email_template_logo_image_id',
		'primary_color' => 'email_template_primary_color',
		'secondary_color' => 'email_template_secondary_color',
		'to_admin_email' => 'email',
		'from_admin_email' => 'email_from_address',
		'from_admin_name' => 'email_from_name',
	);

	public static function get_api_params() {
		return array_keys( array_merge(
			self::$_options_slugs_for_api_params_with_placeholders,
			self::$_option_slugs_for_api_params_without_placeholders
		) );
	}

	public static function get_default_activity_report_title() {
		return
			'Recent User Activity on %%site_url%%';
	}

	public static function get_default_activity_report_message() {
		return
			'The following users have logged in within the last 7 days:' . PHP_EOL . PHP_EOL .
			'%%user_activity_report%%';
	}

	public static function get_default_assigned_lead_title() {
		return
			'A Lead Has Been Assigned To You from %%site_url%%';
	}

	public static function get_default_assigned_lead_message() {
		return
			'A lead has been assigned to you from %%site_url%%.' . PHP_EOL . PHP_EOL .
			'Name: %%user_name%%' . PHP_EOL .
			'Email: %%user_email%%' . PHP_EOL .
			'Phone: %%user_phone%%' . PHP_EOL . PHP_EOL .
			'To view all of your assigned leads, please visit %%leads_url%%.';
	}

	public static function get_default_email_friend_title_to_admin() {
		return
			'Property Emailed To A Friend from %%site_url%%';
	}

	public static function get_default_email_friend_title_to_user() {
		return
			'%%user_name%% Thinks You\'ll Like %%property_address%%';;
	}

	public static function get_default_email_friend_message_to_admin() {
		return
			'%%property_url%%' . PHP_EOL . PHP_EOL .
			'Property: %%property_address%% ' . PHP_EOL .
			'Friend Name: %%friend_name%%' . PHP_EOL .
			'Friend Email: %%friend_email%%' . PHP_EOL .
			'User Name: %%user_name%%' . PHP_EOL .
			'User Email: %%user_email%%' . PHP_EOL .
			'User Message: %%user_message%%';
	}

	public static function get_default_email_friend_message_to_user() {
		return
			'%%property_url%%' . PHP_EOL . PHP_EOL .
			'Property: %%property_address%%' . PHP_EOL .
			'Message from %%user_name%%: %%user_message%%';
	}

	public static function get_default_new_registration_title_to_admin() {
		return
			'A New User Has Registered at %%site_url%%';
	}

	public static function get_default_new_registration_title_to_user() {
		return
			'New Account Details for %%site_url%%';
	}

	public static function get_default_new_registration_message_to_admin() {
		return
			'A new user has registered at %%site_url%%.' . PHP_EOL . PHP_EOL .
			'Name: %%user_name%%' . PHP_EOL .
			'Email: %%user_email%%' . PHP_EOL .
			'Phone: %%user_phone%%' . PHP_EOL .
			'Registered at: %%registration_url%%' . PHP_EOL;
	}

	public static function get_default_new_registration_message_to_user() {
		return
			'Thank you for registering at %%site_url%%.' . PHP_EOL . PHP_EOL .
			'Name: %%user_name%%' . PHP_EOL .
			'Email: %%user_email%%' . PHP_EOL .
			'Phone: %%user_phone%%' . PHP_EOL .
			'Username: %%user_username%%' . PHP_EOL .
			'Password: %%user_password%%' . PHP_EOL;
	}

	public static function get_default_property_showing_title_to_admin() {
		return
			'Property Showing Request for %%property_address%%';
	}

	public static function get_default_property_showing_title_to_user() {
		return
			'Property Showing Request Received for %%property_address%%';
	}

	public static function get_default_property_showing_message_to_admin() {
		return
			'%%property_url%%' . PHP_EOL . PHP_EOL .
			'Property: %%property_address%%: ' . PHP_EOL .
			'Name: %%user_name%%' . PHP_EOL .
			'Email: %%user_email%%' . PHP_EOL .
			'Phone: %%user_phone%%' . PHP_EOL .
			'Appointment 1: %%user_appointment%%' . PHP_EOL .
			'Appointment 2: %%user_appointment2%%' . PHP_EOL .
			'Message: %%user_message%%';
	}

	public static function get_default_property_showing_message_to_user() {
		return
			'%%property_url%%' . PHP_EOL . PHP_EOL .
			'Property: %%property_address%%' . PHP_EOL .
			'Name: %%user_name%%' . PHP_EOL .
			'Email: %%user_email%%' . PHP_EOL .
			'Phone: %%user_phone%%' . PHP_EOL .
			'Appointment 1: %%user_appointment%%' . PHP_EOL .
			'Appointment 2: %%user_appointment2%%' . PHP_EOL .
			'Message: %%user_message%%';
	}

	public static function get_default_saved_property_message_to_admin() {
		return
			'%%property_url%%' . PHP_EOL . PHP_EOL .
			'Property: %%property_address%%' . PHP_EOL .
			'Name: %%user_name%%' . PHP_EOL .
			'Email: %%user_email%%' . PHP_EOL .
			'Phone: %%user_phone%%';
	}

	public static function get_default_saved_search_message_to_admin() {
		return
			'%%search_url%%' . PHP_EOL . PHP_EOL .
			'Name: %%user_name%%' . PHP_EOL .
			'Email: %%user_email%%' . PHP_EOL .
			'Phone: %%user_phone%%';
	}

	public static function get_default_saved_property_title_to_admin() {
		return
			'A Property Was Saved at %%site_url%%';
	}

	public static function get_default_saved_search_title_to_admin() {
		return
			'A Search Was Saved at %%site_url%%';
	}

	public static function get_default_signature() {
		return
			'Thanks,' . PHP_EOL .
			'%%site_name%%' . PHP_EOL .
			'%%site_url%%';
	}

	public static function get_default_unregistered_address_message() {
		return
			'A new address was submitted at %%site_url%%.' . PHP_EOL . PHP_EOL .
			'Address: %%property_address%%';
	}

	public static function get_default_unregistered_address_title() {
		return
			'New Address Submitted at %%site_url%%';
	}

	public static function get_option_slugs() {
		return array_values( array_merge(
			self::$_options_slugs_for_api_params_with_placeholders,
			self::$_option_slugs_for_api_params_without_placeholders
		) );
	}

	public static function get_option_slugs_for_api_params() {
		return array_merge(
			self::$_options_slugs_for_api_params_with_placeholders,
			self::$_option_slugs_for_api_params_without_placeholders
		);
	}

	public static function get_option_slugs_with_placeholders() {
		return array_values( self::$_options_slugs_for_api_params_with_placeholders );
	}
}

?>