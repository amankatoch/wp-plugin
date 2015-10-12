<?php

class DispletRetsIdxUsersModel extends DispletRetsIdxPlugin {
	public static function get_first_and_last_name( $name ) {
		$names = array();
		preg_match( '/[^\s]+/', $name, $first_name_match );
		if ( !empty( $first_name_match ) ) {
			$names['first_name'] = $first_name_match[0];
		}
		else{
			$names['first_name'] = $name;
		}
		$names['last_name'] = trim( str_replace( $names['first_name'], '', $name ) );
		if ( !empty( $names['first_name'] ) ) {
			$names['first_name'] = ucwords( $names['first_name'] );
		}
		if ( !empty( $names['last_name'] ) ) {
			$names['last_name'] = ucwords( $names['last_name'] );
		}
		return $names;
	}

	public static function get_user_id_by_email( $email ) {
		$user_id = username_exists( $email );
		if ( empty( $user_id ) ) {
			$user = get_user_by( 'email', $email );
			if ( empty( $user ) ) {
				return false;
			}
			else{
				$user_id = $user->ID;
			}
		}
		return $user_id;
	}

	public static function give_admins_custom_capabilities( $capabilities, $capability, $args ) {
		if ( !empty( $capabilities['manage_options'] ) && ( $args[0] === 'displet_view_leads' || $args[0] === 'displet_save_searches' ) ) {
			$capabilities[ $capability[0] ] = true;
		}
		return $capabilities;
	}
}

?>