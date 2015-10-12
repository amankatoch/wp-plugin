<?php

class DispletRetsIdxLeadsModel extends DispletRetsIdxPlugin {
	public static function add_custom_user_role_for_leads() {
		remove_role( 'displet_user' );
		add_role( 'displet_user', 'Real Estate Search User', array(
			'displet_save_properties' => true,
			'displet_save_searches' => true,
			'read' => true,
		) );
	}

	public static function get_api_user_id( $user_id ) {
		if ( !empty( $user_id ) ) {
			return get_user_meta( $user_id, self::$_meta_keys['api_user_id'], true );
		}
	}
	public static function get_assigned_agent_id( $user_id ) {
		if ( !empty( $user_id ) ) {
			return get_user_meta( $user_id, 'displet_agent_id', true );
		}
	}

	public static function get_assigned_lender_id( $user_id ) {
		if ( !empty( $user_id ) ) {
			return get_user_meta( $user_id, 'displet_lender_id', true );
		}
	}

	public static function get_current_user_data() {
		$current_user = wp_get_current_user();
		if ( !empty( $current_user->ID ) ) {
			return array(
				'email' => $current_user->user_email,
				'id' => $current_user->ID,
				'name' => $current_user->display_name,
				'phone' => $current_user->{ self::$_meta_keys['lead']['phone'] },
			);
		}
		return false;
	}

	public static function get_users( $agent_id = false, $args = array() ) {
		if ( !empty( $agent_id ) ) {
			$args['meta_key'] = 'displet_agent_id';
			$args['meta_value'] = $agent_id;
		}
		else{
			$args['role'] = self::$_roles['lead'];
		}
		return get_users( $args );
	}

	public static function get_users_count( $agent_id = false ) {
		$args = array(
			'count_total' => true,
			'fields' => 'ID',
		);
		if ( !empty( $agent_id ) ) {
			$args['meta_key'] = 'displet_agent_id';
			$args['meta_value'] = $agent_id;
		}
		else{
			$args['role'] = self::$_roles['lead'];
		}
		$users = new WP_User_Query( $args );
		if ( !empty( $users ) ) {
			return $users->get_total();
		}
	}

	public static function is_blacklisted_email( $email ) {
		if ( !empty( self::$_options['blacklisted_emails'] ) ) {
			$blacklisted_emails = array_map( 'trim', explode( "\n", strtolower( self::$_options['blacklisted_emails'] ) ) );
			if ( !empty( $blacklisted_emails ) ) {
				$lowercase_email = strtolower( $email );
				foreach ( $blacklisted_emails as $blacklisted_email ) {
					$pattern = '/^' . str_replace( '%%', '.*', $blacklisted_email ) . '$/';
					preg_match( $pattern, $lowercase_email, $matches );
					if ( !empty( $matches ) ) {
						return true;
					}
				}
			}
		}
		return false;
	}

	public static function is_blacklisted_name( $name ) {
		if ( !empty( self::$_options['blacklisted_names'] ) ) {
			$blacklisted_names = array_map( 'trim', explode( "\n", strtolower( self::$_options['blacklisted_names'] ) ) );
			if ( !empty( $blacklisted_names ) ) {
				$lowercase_name = strtolower( $name );
				foreach ( $blacklisted_names as $blacklisted_name ) {
					$pattern = '/(?:^|\s)' . str_replace( '%%', '.*', $blacklisted_name ) . '(?:$|\s)/';
					preg_match( $pattern, $lowercase_name, $matches );
					if ( !empty( $matches ) ) {
						return true;
					}
				}
			}
		}
		return false;
	}
}

?>