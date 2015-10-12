<?php

class DispletRetsIdxLeadManagerPageModel extends DispletRetsIdxAdminPagesModel {
	protected static $_leads_per_page = 25;

	protected static function build_model() {
		self::get_defaults();
		self::maybe_set_user_args();
		self::maybe_get_lead();
		self::maybe_get_leads();
		self::maybe_get_leads_count();
		self::maybe_get_partial_addresses();
		self::maybe_set_pagination();
		self::maybe_set_assignable_users();
	}

	private static function get_defaults() {
		self::$_model = array_merge( self::$_model, array(
			'agents' => array(),
			'count' => 0,
			'is_admin_user' => current_user_can( 'manage_options' ),
			'is_partial_address_theme' => DispletRetsIdxUtilities::is_unregistered_address_theme(),
			'is_single' => !empty( $_GET['user_id'] ) ? true : false,
			'lead_manager_page_url' => admin_url( 'admin.php?page=' . self::$_slugs['lead_manager_page'] ),
			'lenders' => array(),
			'importing_users' => false,
			'next_partial_address_url' => false,
			'next_url' => false,
			'options' => self::$_options,
			'page' => !empty( $_GET['pagenum'] ) ? intval( $_GET['pagenum'] ) : 1,
			'page_urls' => array(),
			'pagination' => '',
			'partial_addresses' => false,
			'partial_addresses_count' => 0,
			'previous_partial_address_url' => false,
			'previous_url' => false,
			'user_has_address' => false,
			'user_id' => $_GET['user_id'],
		) );
	}

	private function maybe_get_lead() {
		if ( self::$_model['is_single'] ) {
			self::$_model['lead'] = get_user_by( 'id', self::$_model['user_id'] );
		}
	}

	private static function maybe_get_leads() {
		if ( ! self::$_model['is_single'] ) {
			self::$_model['leads'] = get_users( self::$_model['user_args'] );
		}
	}

	private static function maybe_get_leads_count() {
		if ( ! self::$_model['is_single'] ) {
			$users = new WP_User_Query( self::$_model['user_args'] );
			self::$_model['count'] = intval( $users->get_total() );
		}
	}

	private static function maybe_get_partial_addresses() {
		if ( ! self::$_model['is_single'] && self::$_model['is_partial_address_theme'] && self::$_model['is_admin_user'] ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'displet_partial_addresses';
			$limit = self::$_leads_per_page;
			$offset = !empty( self::$_model['page'] ) ? ( self::$_model['page'] - 1 ) * $limit : 0;
			self::$_model['partial_addresses'] = $wpdb->get_results(
				"SELECT *
				FROM $table_name
				ORDER BY last_epoch DESC
				LIMIT $limit
				OFFSET $offset"
			);
			if ( !empty( self::$_model['partial_addresses'] ) && is_array( self::$_model['partial_addresses'] ) ) {
				foreach ( self::$_model['partial_addresses'] as $partial_address ) {
					$partial_address->epochs = maybe_unserialize( $partial_address->epochs );
				}
				self::$_model['partial_addresses_count'] = count( self::$_model['partial_addresses'] );
			}
		}
	}

	private static function maybe_set_assignable_users() {
		if ( !self::$_model['is_single'] && self::$_model['is_admin_user'] ) {
			$admin_users = get_users( array(
				'role' => 'administrator',
			) );
			if ( !empty( $admin_users ) ) {
				self::$_model['agents'] = $admin_users;
				self::$_model['lenders'] = $admin_users;
			}
			$agent_users = get_users( array(
				'role' => 'displet_agent',
			) );
			if ( !empty( $agent_users ) ) {
				self::$_model['agents'] = array_merge( self::$_model['agents'], $agent_users );
			}
			$lender_users = get_users( array(
				'role' => 'displet_lender',
			) );
			if ( !empty( $lender_users ) ) {
				self::$_model['lenders'] = array_merge( self::$_model['lenders'], $lender_users );
			}
		}
	}

	private static function maybe_set_user_args() {
		if ( ! self::$_model['is_single'] ) {
			self::$_model['user_args'] = array(
				'role' => self::$_roles['lead'],
				'orderby' => 'registered',
				'order' => 'DESC',
				'number' => self::$_leads_per_page,
				'offset' => self::$_leads_per_page * ( self::$_model['page'] - 1 ),
			);
			if ( !current_user_can( 'manage_options' ) ) {
				$meta_key = current_user_can( 'displet_save_searches' ) ? 'displet_agent_id' : 'displet_lender_id';
				self::$_model['user_args']['meta_value'] = get_current_user_id();
				self::$_model['user_args']['meta_key'] = $meta_key;
			}
			$meta_query = array();
			if ( !empty( $_GET['user_name'] ) ) {
				$meta_query[] = array(
					'key' => 'nickname',
					'value' => $_GET['user_name'],
					'compare' => 'LIKE'
				 );
			}
			if ( !empty( $_GET['user_email'] ) ) {
				self::$_model['user_args']['search'] = '*' . $_GET['user_email'] . '*';
			}
			if ( !empty( $_GET['user_phone'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_phone',
					'value' => $_GET['user_phone'],
					'compare' => 'LIKE'
				 );
			}
			if ( !empty( $_GET['logged_in_since'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_last_login',
					'value' => strtotime( $_GET['logged_in_since'] ),
					'compare' => '>=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['has_phone'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_phone',
					'value' => '',
					'compare' => '!='
				 );
				$meta_query[] = array(
					'key' => 'displet_phone',
					'value' => '(     )    -    ',
					'compare' => '!='
				 );
			}
			if ( !empty( $_GET['min_logins'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_logins_count',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['min_logins'] ),
					'compare' => '>=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['min_saved_properties'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_saved_properties_count',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['min_saved_properties'] ),
					'compare' => '>=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['min_saved_searches'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_user_hashes_count',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['min_saved_searches'] ),
					'compare' => '>=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['min_showing_requests'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_property_inquiries_count',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['min_showing_requests'] ),
					'compare' => '>=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['zip_mode'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_zip_mode',
					'value' => $_GET['zip_mode'],
					'compare' => '=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['mean_price_min'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_mean_price',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['mean_price_min'] ),
					'compare' => '>=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['mean_price_max'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_mean_price',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['mean_price_max'] ),
					'compare' => '<=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['mean_square_feet_min'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_mean_square_feet',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['mean_square_feet_min'] ),
					'compare' => '>=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $_GET['mean_square_feet_max'] ) ) {
				$meta_query[] = array(
					'key' => 'displet_mean_square_feet',
					'value' => preg_replace( '/[^0-9]/', '', $_GET['mean_square_feet_max'] ),
					'compare' => '<=',
					'type' => 'numeric'
				 );
			}
			if ( !empty( $meta_query ) ) {
				self::$_model['user_args']['meta_query'] = $meta_query;
			}
		}
	}

	private static function maybe_set_next_urls( $url ) {
		if ( self::$_model['count'] > self::$_leads_per_page ) {
			self::$_model['next_url'] = $url . '&pagenum=' . ( self::$_model['page'] + 1 );
			if ( self::$_model['is_partial_address_theme'] ) {
				self::$_model['next_url'] .= '#registered_leads';
			}
		}
		if ( self::$_model['is_partial_address_theme'] && self::$_model['partial_addresses_count'] === self::$_leads_per_page ) {
			self::$_model['next_partial_address_url'] = $url . '&pagenum=' . ( self::$_model['page'] + 1 ) . '#unregistered_addresses';
		}
	}

	private static function maybe_set_page_urls( $url ) {
		self::$_model['page_urls'] = DispletRetsIdxUtilities::get_pagination_urls( array(
			'count' => self::$_model['count'],
			'current_page' => self::$_model['page'],
			'num_per_page' => self::$_leads_per_page,
			'pre_page_number_url_content' => '&pagenum=',
			'url' => $url,
		) );
	}

	private static function maybe_set_pagination() {
		if ( ! self::$_model['is_single'] ) {
			$unpaged_url = preg_replace( '/&pagenum=(\d+)/', '', $_SERVER["REQUEST_URI"] );
			self::maybe_set_previous_urls( $unpaged_url );
			self::maybe_set_next_urls( $unpaged_url );
			self::maybe_set_page_urls( $unpaged_url );
		}
	}

	private static function maybe_set_previous_urls( $url ) {
		if ( self::$_model['page'] !== 1 ) {
			self::$_model['previous_url'] = $url . '&pagenum=' . ( self::$_model['page'] - 1 );
			if ( self::$_model['is_partial_address_theme'] ) {
				self::$_model['previous_partial_address_url'] = self::$_model['previous_url'] . '#unregistered_addresses';
				self::$_model['previous_url'] .= '#registered_leads';
			}
		}
	}
}

?>