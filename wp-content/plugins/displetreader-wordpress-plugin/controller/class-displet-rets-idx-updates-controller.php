<?php

class DispletRetsIdxUpdatesController extends DispletRetsIdxUpdatesModel {
	public static function maybe_deactivate() {
		$active_plugins = get_option( 'active_plugins' );
		if ( !empty( $active_plugins ) && is_array( $active_plugins ) ) {
			$plugins = array();
			$alert = false;
			foreach ( $active_plugins as $plugin ) {
				if ( $plugin == 'displetsearch-wordpress-plugin/DispletReader.php' ) {
					$alert = true;
				}
				if ( $plugin != 'displetreader-wordpress-plugin/displetreader-wordpress-plugin.php' ) {
					$plugins[] = $plugin;
				}
			}
			if ( $alert ) {
				update_option( 'displetretsidx_deactivated', true );
				wp_schedule_single_event( time(), 'displetretsidx_update_active_plugins', array( $plugins ) );
			}
		}
	}

	public static function maybe_notify() {
		$last_version = DispletRetsIdxOptionsController::get_option( 'notify' );
		$model = false;
		if ( empty( $last_version ) ) {
			$model = array(
				'version' => self::$_version,
				'message' => self::get_message( 'welcome' ),
			);
		}
		else if ( version_compare( self::$_version, $last_version, '>' ) ) {
			if ( version_compare( '2.0.12', $last_version, '>' ) && empty( self::$_options['displet_app_token'] ) ) {
				$model = array(
					'version' => '2.0.12',
					'message' => self::get_message( '2_0_12' ),
				);
			}
			else if ( version_compare( '2.0.13', $last_version, '>' ) ) {
				$model = array(
					'version' => '2.0.13',
					'message' => self::get_message( '2_0_13' ),
				);
			}
			else if ( version_compare( '2.0.25', $last_version, '>' ) ) {
				$model = array(
					'version' => '2.0.25',
					'message' => self::get_message( '2_0_25' ),
				);
			}
			else if ( version_compare( '2.0.51', $last_version, '>' ) ) {
				$model = array(
					'version' => '2.0.51',
					'message' => self::get_message( '2_0_51' ),
				);
			}
			else if ( version_compare( '2.1', $last_version, '>' ) ) {
				$model = array(
					'version' => '2.1',
					'message' => self::get_message( '2_1' ),
				);
			}
		}
		if ( !empty( $model ) ) {
			echo DispletRetsIdxTemplatesController::get_admin_template( 'displet-notification-jquery.php', $model );
		}
		else {
			DispletRetsIdxOptionsController::update_option( 'notify', self::$_version );
		}
	}

	public static function maybe_notify_of_deactivation() {
		$deactivated = get_option( 'displetretsidx_deactivated' );
		if ( !empty( $deactivated ) ) {
			echo '<div class="error"><h3>Warning! Displet RETS/IDX Deactivated</h3><p>Displet RETS/IDX was deactivated because it appears DispletReader Legacy is currently active. If you wish to use Displet RETS/IDX, please first deactivate DispletReader Legacy.</p></div>';
			update_option( 'displetretsidx_deactivated', false );
		}
	}

	public static function maybe_update() {
		$last_version = DispletRetsIdxOptionsController::get_option( 'version' );
		// If last version still using old update methodology
		if ( empty( $last_version ) || version_compare( '2.0.26', $last_version, '>' ) ) {
			$user_role_version = get_option( 'displet_rets_idx_user_role_version' );
			if ( empty( $user_role_version ) || $user_role_version < 2 ) {
				DispletRetsIdxLeadsModel::add_custom_user_role_for_leads();
				if ( $user_role_version < 2 ) {
					DispletRetsIdxUsersUpdatesController::upgrade_users_to_role_2();
				}
			}
			$version = get_option( 'displet_rets_idx_options_version' );
			if ( empty( $version ) || $version < 1 ) {
				if ( empty( $version ) || $version < 1 ) {
					DispletRetsIdxSettingsUpdatesController::update_settings_to_version_1();
				}
				update_option( 'displet_rets_idx_options_version', 1 );
			}
		}
		// If last version not current
		if ( version_compare( self::$_version, $last_version, '>' ) ) {
			if ( version_compare( '2.0.24', $last_version, '>' ) ) {
				self::update_to_2_0_24();
			}
			if ( version_compare( '2.0.25', $last_version, '>' ) ) {
				self::update_to_2_0_25();
			}
			if ( version_compare( '2.0.26', $last_version, '>' ) ) {
				self::update_to_2_0_26();
			}
			if ( version_compare( '2.0.27', $last_version, '>' ) ) {
				self::update_to_2_0_27();
			}
			if ( version_compare( '2.0.30', $last_version, '>' ) ) {
				self::update_to_2_0_30();
			}
			if ( version_compare( '2.0.31', $last_version, '>' ) ) {
				self::update_to_2_0_31();
			}
			if ( version_compare( '2.0.46', $last_version, '>' ) ) {
				self::update_to_2_0_46();
			}
			if ( version_compare( '2.1', $last_version, '>' ) ) {
				self::update_to_2_1();
			}
			if ( version_compare( '2.1.4', $last_version, '>' ) ) {
				self::update_to_2_1_4();
			}
			if ( version_compare( '2.1.10', $last_version, '>' ) ) {
				self::update_to_2_1_10();
			}
			if ( version_compare( '2.1.17', $last_version, '>' ) ) {
				self::update_to_2_1_17();
			}
			if ( version_compare( '2.1.18', $last_version, '>' ) ) {
				self::update_to_2_1_18();
			}
			if ( version_compare( '2.1.19', $last_version, '>' ) ) {
				self::update_to_2_1_19();
			}
			DispletRetsIdxOptionsController::update_option( 'version', self::$_version );
		}
	}

	public static function update_active_plugins( $plugins ) {
		update_option( 'active_plugins', $plugins );
	}

	private static function update_to_2_0_24() {
		DispletRetsIdxUsersUpdatesController::schedule_register_non_api_users_with_api_cron();
	}

	private static function update_to_2_0_25() {
		DispletRetsIdxRewriteController::reset_flush_rewrite_rules();
	}

	private static function update_to_2_0_26() {
		DispletRetsIdxSettingsUpdatesController::change_to_multi_checkbox_from_one_per_line_textarea( 'city_include_filter' );
	}

	private static function update_to_2_0_27() {
		DispletRetsIdxUsersUpdatesController::save_new_meta_values_for_user_searches();
	}

	private static function update_to_2_0_30() {
		DispletRetsIdxRewriteController::reset_flush_rewrite_rules();
	}

	private static function update_to_2_0_31() {
		DispletRetsIdxSettingsUpdatesController::update_setting( 'require_registration_to_view_properties', '1' );
	}

	private static function update_to_2_0_46() {
		DispletRetsIdxUsersUpdatesController::maybe_add_property_filter_to_saved_searches();
	}

	private static function update_to_2_1() {
		DispletRetsIdxSettingsUpdatesController::save_search_values_as_new_option();
		DispletRetsIdxSettingsUpdatesController::change_mutli_checkboxes_to_boolean_from_true_false_string();
		DispletRetsIdxSettingsUpdatesController::set_search_forms_from_widget_areas();
		DispletRetsIdxSettingsUpdatesController::set_quick_search_ids_from_widget_classes();
	}

	public static function update_to_2_1_4() {
		DispletRetsIdxLendersModel::add_custom_user_role_for_lenders();
	}

	private static function update_to_2_1_10() {
		DispletRetsIdxRewriteController::reset_flush_rewrite_rules();
	}

	private static function update_to_2_1_17() {
		DispletRetsIdxUsersUpdatesController::send_saved_properties_to_api();
	}

	private static function update_to_2_1_18() {
		DispletRetsIdxUsersUpdatesController::send_agents_to_api();
		wp_schedule_single_event( time(), 'displetretsidx_send_assigned_agent_ids_to_api' );
	}

	private static function update_to_2_1_19() {
		DispletRetsIdxSettingsController::update_email_templates_at_api( DispletRetsIdxOptionsController::get_option() );
		DispletRetsIdxSettingsController::update_field_options( self::$_options );
	}
}

?>