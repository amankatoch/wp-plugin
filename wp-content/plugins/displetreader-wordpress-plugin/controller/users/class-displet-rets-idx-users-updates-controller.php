<?php

class DispletRetsIdxUsersUpdatesController extends DispletRetsIdxUsersController {
	public static function add_property_filter_to_saved_searches() {
		$users = DispletRetsIdxLeadsModel::get_users();
		if ( !empty( $users ) && is_array( $users ) ) {
			$delay = count( $users );
			$i = 0;
			foreach ( $users as $user ) {
				if ( !empty( $user->ID ) ) {
					wp_schedule_single_event( time() + $delay + $i * 30, 'displetretsidx_add_property_filter_to_saved_searches_per_user', array( $user->ID ) );
					$i++;
				}
			}
		}
	}

	public static function add_property_filter_to_saved_searches_per_user( $user_id ) {
		$api_user_id = get_user_meta( $user_id, 'displet_api_user_id', true );
		$saved_searches = get_user_meta( $user_id, 'displet_saved_searches', true );
		if ( !empty( $api_user_id ) && !empty( $saved_searches ) && is_array( $saved_searches ) ) {
			foreach ( $saved_searches as $saved_search ) {
				if ( !empty( $saved_search['api_id'] ) ) {
					$criteria = DispletRetsIdxUtilities::get_search_criteria_array_from_hash( $saved_search['hash'] );
					$original_criteria = $criteria;
					$criteria['city'] = DispletRetsIdxResidentialsModel::get_filtered_city( $criteria['city'], false );
					$criteria['max_list_price'] = DispletRetsIdxResidentialsModel::get_filtered_max_price( $criteria['max_list_price'] );
					$criteria['min_list_price'] = DispletRetsIdxResidentialsModel::get_filtered_min_price( $criteria['min_list_price'] );
					$criteria['property_type'] = DispletRetsIdxResidentialsModel::get_filtered_property_type( $criteria['property_type'], false );
					$criteria['zip'] = DispletRetsIdxResidentialsModel::get_filtered_zip( $criteria['zip'], false );
					$criteria = array_filter( $criteria );
					if ( $original_criteria !== $criteria ) {
						DispletRetsIdxUsersApiController::update_saved_search( $api_user_id, $saved_search['api_id'], $criteria );
					}
				}
			}
		}
	}

	public static function maybe_add_property_filter_to_saved_searches() {
		if ( DispletRetsIdxSettingsController::has_property_filter() ) {
			self::add_property_filter_to_saved_searches();
		}
	}

	public static function register_non_api_users_with_api_cron() {
		$users = DispletRetsIdxLeadsModel::get_users();
		if ( !empty( $users ) && is_array( $users ) ) {
			$i = 1;
			$count = count( $users );
			$finished_after = time() + ( $count + 1 ) * 30;
			foreach ( $users as $user ) {
				if ( empty( $user->displet_api_user_id ) ) {
					$args = array(
						'user_id' => $user->ID,
						'user_email' => $user->user_email,
						'user_first_name' => $user->first_name,
						'user_last_name' => $user->last_name,
						'viewed_properties' => $user->displet_user_properties,
						'finished_after' => $finished_after
					 );
					wp_schedule_single_event( time() + $i * 30, 'displetretsidx_register_non_api_users_with_api_cron_per_user', array( $args ) );
					$i++;
				}
			}
		}
	}

	public static function register_non_api_users_with_api_cron_per_user( $args ) {
		$api_user_id = DispletRetsIdxUsersApiController::create_user( $args['user_email'], $args['user_first_name'], $args['user_last_name'] );
		if ( !empty( $api_user_id ) ) {
			update_user_meta( $args['user_id'], 'displet_api_user_id', $api_user_id );
			DispletRetsIdxSavedSearchesController::send_users_saved_searches_to_api( $args['user_id'], $api_user_id );
			if ( !empty( $args['viewed_properties'] ) ) {
				$i = 1;
				foreach ( $args['viewed_properties'] as $viewed_property ) {
					wp_schedule_single_event( time() + $args['finished_after'] + $i * 30, 'displetretsidx_register_non_api_users_with_api_cron_per_property', array( $viewed_property['url'], $api_user_id ) );
				}
			}
		}
	}

	public static function register_non_api_users_with_api_cron_per_property( $url, $api_user_id ) {
		$property_id = DispletRetsIdxRewriteModel::get_property_id_from_url( $url );
		if ( !empty( $property_id ) ) {
			wp_schedule_single_event( time(), 'displetretsidx_register_non_api_users_with_api_cron_per_property_at_api', array( $api_user_id, $property_id ) );
		}
	}

	public static function save_new_meta_values_for_user_searches() {
		$users = DispletRetsIdxLeadsModel::get_users();
		if ( !empty( $users ) && is_array( $users ) ) {
			$delay = count( $users );
			$i = 0;
			foreach ( $users as $user ) {
				if ( !empty( $user->ID ) ) {
					wp_schedule_single_event( time() + $delay + $i * 30, 'displetretsidx_save_new_meta_values_for_user_searches_per_user', array( $user->ID ) );
					$i++;
				}
			}
		}
	}

	public static function save_new_meta_values_for_user_searches_per_user( $user_id ) {
		$user_properties = get_user_meta( $user_id, 'displet_user_properties', true );
		if ( !empty( $user_properties ) ) {
			DispletRetsIdxViewedPropertiesController::update_property_view_stats( $user_id, $user_properties );
		}
		$user_searches = get_user_meta( $user_id, 'displet_user_hashes', true );
		if ( !empty( $user_searches ) ) {
			update_user_meta( $user_id, 'displet_user_hashes_count', count( $user_searches ) );
		}
		$user_logins = get_user_meta( $user_id, 'displet_logins', true );
		if ( !empty( $user_logins ) ) {
			update_user_meta( $user_id, 'displet_logins_count', count( $user_logins ) );
		}
	}

	public static function schedule_register_non_api_users_with_api_cron() {
		wp_schedule_single_event( time(), 'displetretsidx_register_non_api_users_with_api_cron' );
	}

	public static function send_agents_to_api() {
		$users = DispletRetsIdxAgentsModel::get_users( true );
		if ( !empty( $users ) && is_array( $users ) ) {
			foreach ( $users as $user ) {
				DispletRetsIdxAgentsController::send_agent_to_api( $user->ID );
			}
		}
	}

	public static function send_assigned_agent_ids_to_api() {
		$users = DispletRetsIdxLeadsModel::get_users();
		if ( !empty( $users ) && is_array( $users ) ) {
			$delay = count( $users );
			$i = 0;
			foreach ( $users as $user ) {
				if ( !empty( $user->{ self::$_meta_keys['lead']['assigned_agent_id'] } ) ) {
					wp_schedule_single_event( time() + $delay + $i * 10, 'displetretsidx_update_assigned_agent_id_at_api', array( $user->ID, $user->{ self::$_meta_keys['lead']['assigned_agent_id'] } ) );
					$i++;
				}
			}
		}
	}

	public static function send_saved_properties_to_api() {
		$users = DispletRetsIdxLeadsModel::get_users();
		if ( !empty( $users ) && is_array( $users ) ) {
			$start = time() + count( $users );
			$i = 0;
			foreach ( $users as $user ) {
				if ( !empty( $user->ID ) && !empty( $user->{ self::$_meta_keys['saved_properties'] } ) ) {
					wp_schedule_single_event( $start + ( $i * 30 ), 'displetretsidx_send_saved_properties_to_api_per_user', array( $user->ID ) );
					$i++;
				}
			}
		}
	}

	public static function send_saved_properties_to_api_per_user( $user_id ) {
		if ( !empty( $user_id ) ) {
			$saved_properties = get_user_meta( $user_id, self::$_meta_keys['saved_properties'], true );
			if ( !empty( $saved_properties ) && is_array( $saved_properties ) ) {
				$api_user_id = DispletRetsIdxLeadsModel::get_api_user_id( $user_id );
				if ( !empty( $api_user_id ) ) {
					foreach ( $saved_properties as &$saved_property ) {
						$saved_property['api_id'] = DispletRetsIdxSavedPropertiesController::send_saved_property_to_api( $user_id, $saved_property, $api_user_id );
					}
				}
				update_user_meta( $user_id, self::$_meta_keys['saved_properties'], $saved_properties );
			}
		}
	}

	public static function upgrade_users_to_role_2() {
		$leads = DispletRetsIdxLeadsModel::get_users();
		if ( !empty( $leads ) ) {
			foreach ( $leads as $lead ) {
				$name = get_user_meta( $lead->ID, 'nickname', true );
				$names = DispletRetsIdxUsersModel::get_first_and_last_name( $name );
				if ( !empty( $names ) ) {
					wp_update_user( array(
						'ID' => $lead->ID,
						'display_name' => $names['first_name']
					 ) );
					update_user_meta( $lead->ID, 'first_name', $names['first_name'] );
					update_user_meta( $lead->ID, 'last_name', $names['last_name'] );
				}
				$api_user_id = get_user_meta( $lead->ID, 'displet_api_user_id', true );
				if ( empty( $api_user_id ) ) {
					$api_user_id = DispletRetsIdxUsersApiController::create_user( $lead->user_email, $names['first_name'], $names['last_name'] );
					update_user_meta( $lead->ID, 'displet_api_user_id', $api_user_id );
				}
				DispletRetsIdxSavedSearchesController::send_users_saved_searches_to_api( $lead->ID, $api_user_id );
			}
		}
	}
}

?>