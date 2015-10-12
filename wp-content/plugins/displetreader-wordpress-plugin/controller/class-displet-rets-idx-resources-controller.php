<?php

class DispletRetsIdxResourcesController extends DispletRetsIdxPlugin {
	public static function enqueue() {
		self::_enqueue_google_maps_js();
		self::_enqueu_intercom_io_js_for_agent_and_search_users();
	}

	public static function enqueue_css( $filename ) {
		/* Should be unused
		$custom_template_uri = self::get_custom_template_uri( $filename );
		if ( !empty( $custom_template_uri ) ) {
			$stylesheet_url = $custom_template_uri;
		}
		else{
			$stylesheet_url = plugins_url( self::$_slug . '/includes/css/' . $filename );
		}
		$slug = basename( $filename, '.css' );
		*/
		wp_enqueue_style(
			self::_get_slug( $filename, 'css' ),
			trailingslashit( self::$_urls['css'] ) . $filename,
			false,
			self::$_version
		);
	}

	private static function _enqueue_google_maps_js() {
		wp_enqueue_script(
			'displetretsidx-google-maps-geocoder',
			'http://maps.googleapis.com/maps/api/js?libraries=drawing,geometry&sensor=false',
			false,
			self::$_version
		);
	}

	private static function _enqueu_intercom_io_js_for_agent_and_search_users() {
		if ( is_user_logged_in() && current_user_can( 'displet_view_leads' ) ) {
			self::enqueue_js( 'intercom-io-script.js' );
			$user = wp_get_current_user();
			$intercom_vars = array(
				'app_id' => 'lb5nppo2',
				'created_at' => current_time( 'timestamp' ),
				'domain' => home_url(),
				'email' => $user->user_email,
				'name' => $user->display_name,
				'plugin_version' => self::$_version,
				'user_hash' => hash_hmac( 'sha256', $user->user_email, 'k3vZZS7gjJ1p3DIZvbwvC303_TXqLSYWlFwhhS43' ),
				'wp_version' => get_bloginfo( 'version' ),
			);
			$user_leads = DispletRetsIdxLeadsModel::get_users_count( $user->ID );
			if ( !empty( $user_leads ) ) {
				$intercom_vars['user_leads'] = $user_leads;
			}
			self::localize_js( 'intercom-io-script.js', 'intercomSettings', $intercom_vars );
		}
	}

	public static function enqueue_js( $filename, $dependencies = array() ) {
		wp_enqueue_script(
			self::_get_slug( $filename, 'js' ),
			trailingslashit( self::$_urls['js'] ) . $filename,
			$dependencies,
			self::$_version
		);
	}

	/*
	public static function get_custom_template_uri( $filename ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( empty( self::$_options['disable_custom_templates'] ) ) {
			$theme_dir = get_stylesheet_directory();
			if ( file_exists( $theme_dir . '/' . $filename ) ) {
				$theme_url = get_stylesheet_directory_uri();
				return $theme_url . '/' . $filename;
			}
			else if ( file_exists( ABSPATH . 'wp-content/plugins/displet-pro-custom/' . $filename ) && is_plugin_active( 'displet-pro-custom/displet-pro-custom.php' ) ) {
				return plugins_url( 'displet-pro-custom/' . $filename );
			}
		}
		return false;
	}
	*/

	private static function _get_slug( $filename, $extension ) {
		if ( !empty( $filename ) && !empty( $extension ) ) {
			return basename( $filename, '.' . $extension );
		}
	}

	public static function localize_js( $filename, $namespace, $vars ) {
		wp_localize_script(
			self::_get_slug( $filename, 'js' ),
			$namespace,
			$vars
		);
	}
}

?>