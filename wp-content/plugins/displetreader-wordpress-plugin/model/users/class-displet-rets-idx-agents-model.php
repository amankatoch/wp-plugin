<?php

class DispletRetsIdxAgentsModel extends DispletRetsIdxPlugin {
	public static function add_custom_user_role_for_agents() {
		remove_role( 'displet_agent' );
		add_role( 'displet_agent', 'Displet RE Agent', array(
			'displet_save_properties' => true,
			'displet_save_searches' => true,
			'displet_view_leads' => true,
			'edit_users' => true,
			'read' => true,
		) );
	}

	public static function get_users( $include_admins = false ) {
		$agents = get_users( array(
			'role' => self::$_roles['agent'],
		) );
		$users = !empty( $agents ) && is_array( $agents ) ? $agents : array();
		if ( $include_admins ) {
			$users = array_merge( $users, get_users( array(
				'role' => 'administrator',
			) ) );
		}
		return $users;
	}
}

?>