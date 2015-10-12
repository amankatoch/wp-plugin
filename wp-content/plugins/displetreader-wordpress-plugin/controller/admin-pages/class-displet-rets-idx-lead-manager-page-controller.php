<?php

class DispletRetsIdxLeadManagerPageController extends DispletRetsIdxLeadManagerPageModel {
	public static function add_page() {
		$page = DispletRetsIdxAdminPagesController::add_displet_tools_submenu_page( array(
			'capability' => self::$_capabilities['view_leads'],
			'menu_title' => 'Lead Manager',
			'page_callback' => array( 'DispletRetsIdxLeadManagerPageController', 'include_page' ),
			'page_slug' => self::$_slugs['lead_manager_page'],
		) );
		if ( $page ) {
			add_action('load-' . $page, array('DispletRetsIdxLeadManagerPageController', 'filter_lead_manager_query_vars'));
		}
	}

	public static function build() {
		self::build_model();
		self::maybe_normalize_leads();
		self::maybe_normalize_lead();
		self::maybe_set_pagination_markup();
		self::maybe_import_users_from_csv();
	}

	public static function filter_lead_manager_query_vars() {
		parse_str( $_SERVER['QUERY_STRING'], $url_query_vars );
		$original_count = count( $url_query_vars );
		$url_query_vars = array_filter( $url_query_vars );
		if ( $original_count > count( $url_query_vars ) ) {
			$url = admin_url( 'admin.php?' . http_build_query( $url_query_vars ) );
			wp_safe_redirect( $url, 301 );
		}
	}

	private static function get_view_all_markup_end() {
		return '</div><a class="toggle-div-div" href="javascript:;">View All</a></div>';
	}

	private static function get_view_all_markup_start() {
		return '<div><div style="display: none;">';
	}

	public static function include_page() {
		if ( self::$_model['is_single'] ) {
			echo DispletRetsIdxTemplatesController::get_admin_template( 'displet-lead-manager-single.php', self::$_model );
		}
		else {
			echo DispletRetsIdxTemplatesController::get_admin_template( 'displet-lead-manager-page.php', self::$_model );
		}
	}

	private static function maybe_import_users_from_csv() {
		if ( isset( $_FILES['user_import_csv'] ) ) {
			check_admin_referer( 'displet_user_import_nonce' );
			DispletRetsIdxLeadsController::import_users_from_csv( $_FILES['user_import_csv']['tmp_name'], $_POST['user_import_email'] );
			self::$_model['importing_users'] = true;
		}
	}

	private static function maybe_normalize_lead() {
		if ( self::$_model['is_single'] && !empty( self::$_model['lead'] ) ) {
			self::maybe_set_edit_url();
			self::maybe_set_favorites_markup();
			self::maybe_set_last_login();
			self::maybe_set_last_opened_email();
			self::maybe_set_properties_markup();
			self::maybe_set_registered_at();
			self::maybe_set_saved_searches_markup();
			self::maybe_set_searches_markup();
			self::maybe_set_showings_markup();
		}
	}

	private static function maybe_normalize_leads() {
		if ( !self::$_model['is_single'] && !empty( self::$_model['leads'] ) && is_array( self::$_model['leads'] ) ) {
			foreach ( self::$_model['leads'] as $lead ) {
				$lead->view_url = self::$_model['lead_manager_page_url'] . '&user_id=' . $lead->ID;
				if ( self::$_model['is_admin_user'] ) {
					$assigned_agent_id = get_user_meta( $lead->ID, 'displet_agent_id', true );
					if ( !empty( $assigned_agent_id ) ) {
						$assigned_agent = get_userdata( intval( $assigned_agent_id ) );
						$lead->agent = $assigned_agent->display_name;
					}
					else{
						$lead->agent = 'Unassigned';
					}
					$assigned_lender_id = get_user_meta( $lead->ID, 'displet_lender_id', true );
					if ( !empty( $assigned_lender_id ) ) {
						$assigned_lender = get_userdata( intval( $assigned_lender_id ) );
						$lead->lender = $assigned_lender->display_name;
					}
					else{
						$lead->lender = 'Unassigned';
					}
				}
				// Necessary for AustinHomeSeller.com custom functionality
				if ( !empty( $lead->displet_user_submitted_address ) ) {
					self::$_model['user_has_address'] = true;
				}
			}
		}
	}

	private static function maybe_set_edit_url() {
		if ( !empty( self::$_model['lead']->ID ) ) {
			self::$_model['lead']->edit_url = admin_url( 'user-edit.php?user_id=' . self::$_model['lead']->ID );
		}
	}

	private static function maybe_set_favorites_markup() {
		if ( !empty( self::$_model['lead']->displet_saved_properties ) ) {
			self::$_model['lead']->favorites_markup = '';
			$i = 1;
			foreach ( self::$_model['lead']->displet_saved_properties as $property ) {
				if ( $i === 11) {
					self::$_model['lead']->favorites_markup .= self::get_view_all_markup_start();
				}
				if ( !empty( $property['url'] ) ) {
					if ( !empty( $property['type'] ) ) {
						self::$_model['lead']->favorites_markup .= ucwords( $property['type'] ) . ' - ';
					}
					if ( !empty( $property['rating'] ) ) {
						self::$_model['lead']->favorites_markup .= $property['rating'] . '/5 stars: ';
					}
					$location = DispletRetsIdxUtilities::get_address_from_property_details_suffix( $property['url'] );
					self::$_model['lead']->favorites_markup .=
						'<a href="' . self::$_model['property_details_page_url'] . $property['url'] . '" target="_blank">'
							 . $location['address'] . ', ' . $location['city'] . ', ' . $location['state'] . ' ' . $location['zip'] .
						'</a><br>';
				}
				$i++;
			}
			if ( $i > 10 ) {
				self::$_model['lead']->favorites_markup .= self::get_view_all_markup_end();
			}
		}
	}

	private static function maybe_set_last_login() {
		// Newer leads stored as timestamp
		if ( is_numeric( self::$_model['lead']->displet_last_login ) ) {
			self::$_model['lead']->last_login = date( 'Y/m/d \a\t g:ia', self::$_model['lead']->displet_last_login );
		}
		// Older leads stored in date format
		else if ( !empty( self::$_model['lead']->displet_last_login ) ) {
			self::$_model['lead']->last_login = self::$_model['lead']->displet_last_login;
		}
	}

	private static function maybe_set_last_opened_email() {
		if ( !empty( self::$_model['lead']->displet_api_user_id ) ) {
			$emails = new DispletRetsIdxEmailsApi();
			self::$_model['lead']->opened_emails = $emails->get_user_opened( self::$_model['lead']->displet_api_user_id );
		}
	}

	private static function maybe_set_pagination_markup() {
		if ( !empty( self::$_model['page_urls'] ) && is_array( self::$_model['page_urls'] ) ) {
			$last_page = false;
			foreach ( self::$_model['page_urls'] as $page => $url ) {
				if ( !empty( $last_page ) && $page - $last_page > 1 ) {
					self::$_model['pagination'] .= '<span>...</span>';
				}
				$class = self::$_model['page'] === $page ? 'displet-current' : '';
				self::$_model['pagination'] .= '<a href="' . $url . '" class="' . $class . '">' . $page . '</a>';
				$last_page = $page;
			}
		}
	}

	private static function maybe_set_properties_markup() {
		if ( !empty( self::$_model['lead']->displet_user_properties ) ) {
			self::$_model['lead']->properties_markup = '';
			$i = 1;
			foreach ( self::$_model['lead']->displet_user_properties as $property ) {
				if ( $i === 11) {
					self::$_model['lead']->properties_markup .= self::get_view_all_markup_start();
				}
				if ( !empty( $property['url'] ) ){
					$property['address'] = ( !empty( $property['address'] ) ) ? $property['address'] : 'Property';
					$location = DispletRetsIdxUtilities::get_address_from_property_details_suffix( $property['url'] );
					self::$_model['lead']->properties_markup .=
						'<a href="' . self::$_model['property_details_page_url'] . $property['url'] . '" target="_blank">'
							 . $property['address'] . ', ' . $location['city'] . ', ' . $location['state'] . ' ' . $location['zip'] .
						'</a><br>';
				}
				$i++;
			}
			if ( $i > 10 ) {
				self::$_model['lead']->properties_markup .= self::get_view_all_markup_end();
			}
		}
	}

	private static function maybe_set_registered_at() {
		if ( !empty( self::$_model['lead']->user_registered ) ) {
			self::$_model['lead']->registered_at = get_date_from_gmt( self::$_model['lead']->user_registered, 'Y/m/d \a\t g:ia' );
		}
	}

	private static function maybe_set_saved_searches_markup() {
		if ( !empty( self::$_model['lead']->displet_saved_searches ) ) {
			self::$_model['lead']->saved_searches_markup = '';
			$i = 1;
			foreach ( self::$_model['lead']->displet_saved_searches as $saved_search ) {
				if ( $i === 11) {
					self::$_model['lead']->saved_searches_markup .= self::get_view_all_markup_start();
				}
				if ( $saved_search['hash'] ) {
					$saved_search['name'] = !empty( $saved_search['name'] ) ? $saved_search['name'] : self::$_model['search_results_page_url'] . $saved_search['hash'];
					self::$_model['lead']->saved_searches_markup .=
						'<a href="' . self::$_model['search_results_page_url'] . $saved_search['hash'] . '" target="_blank">'
							 . $saved_search['name'] .
						'</a><br>';
				}
				$i++;
			}
			if ( $i > 10 ) {
				self::$_model['lead']->saved_searches_markup .= self::get_view_all_markup_end();
			}
		}
	}

	private static function maybe_set_searches_markup() {
		if ( !empty( self::$_model['lead']->displet_user_hashes ) ) {
			self::$_model['lead']->searches_markup = '';
			$i = 1;
			foreach ( self::$_model['lead']->displet_user_hashes as $hash ) {
				if ( $i === 11) {
					self::$_model['lead']->searches_markup .= self::get_view_all_markup_start();
				}
				self::$_model['lead']->searches_markup .=
					'<a href="' . self::$_model['search_results_page_url'] . $hash . '" target="_blank">'
						. self::$_model['search_results_page_url'] . $hash .
					'</a><br>';
				$i++;
			}
			if ( $i > 10 ) {
				self::$_model['lead']->searches_markup .= self::get_view_all_markup_end();
			}
		}
	}

	private static function maybe_set_showings_markup() {
		if ( !empty( self::$_model['lead']->displet_property_inquiries ) ) {
			self::$_model['lead']->showings_markup = '';
			$i = 1;
			foreach ( self::$_model['lead']->displet_property_inquiries as $property_inquiry ) {
				if ( $i === 11) {
					self::$_model['lead']->showings_markup .= self::get_view_all_markup_start();
				}
				self::$_model['lead']->showings_markup .=
					'Name: ' . $property_inquiry['name'] .
					' Email: ' . $property_inquiry['email'] .
					' Phone: ' . $property_inquiry['phone'] .
					' Address: ' . $property_inquiry['address'] .
					' Appointment 1: ' . $property_inquiry['first_appointment'] .
					' Appointment 2: ' . $property_inquiry['second_appointment'] .
					' Message: ' . $property_inquiry['message'] . '<br>';
				$i++;
			}
			if ( $i > 10 ) {
				self::$_model['lead']->showings_markup .= self::get_view_all_markup_end();
			}
		}
	}

	public static function reassign_users() {
		check_ajax_referer( 'displet_reassign_users_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_reassign_users_request' ) {
			if ( !empty( $_POST['displet_users'] ) ) {
				if ( !empty( $_POST['displet_agent'] ) || !empty( $_POST['displet_lender'] ) ) {
					foreach ( $_POST['displet_users'] as $user_id ) {
						DispletRetsIdxLeadsController::reassign_user( $user_id, $_POST['displet_agent'], $_POST['displet_lender'] );
					}
					echo 'Succesful Assignation';
				}
				else{
					echo 'No agent or lender has been selected.';
				}
			}
			die();
		}
	}
}

?>