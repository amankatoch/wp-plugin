<?php

class DispletRetsIdxViewedSearchesController extends DispletRetsIdxLeadsController {
	public static function update_viewed_searches() {
		check_ajax_referer( 'displet_update_searches_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_update_searches' && !empty( $_POST['last_hash'] ) ) {
			$user_id = get_current_user_id();
			if ( $user_id != 0 && current_user_can( 'displet_save_searches' ) && !current_user_can( self::$_capabilities['view_leads'] ) ) {
				$user_searches = get_user_meta( $user_id, 'displet_user_hashes', true );
				$user_searches[] = $_POST['last_hash'];
				$user_searches_count = count( $user_searches );
				update_user_meta( $user_id, 'displet_user_hashes', $user_searches );
				update_user_meta( $user_id, 'displet_user_hashes_count', $user_searches_count );
				$search_criteria = DispletRetsIdxResidentialsModel::get_search_criteria_from_hash( $_POST['last_hash'] );
				self::_send_saved_search_to_api( $user_id, $search_criteria );
				do_action( 'displetretsidx_post_lead_viewed_search', $user_id, array(
					'all_hashes' => $user_searches,
					'hash_count' => $user_searches_count,
					'last_hash' => $_POST['last_hash'],
				) );
			}
		}
		die();
	}

	private static function _send_saved_search_to_api( $user_id, $search_criteria ) {
		if ( !empty( $user_id ) && !empty( $search_criteria ) ) {
			$api_user_id = get_user_meta( $user_id, self::$_meta_keys['api_user_id'], true );
			if ( !empty( $api_user_id ) ) {
				$api = new DispletRetsIdxViewedSearchesApi( array(
					'search_criteria' => $search_criteria,
					'user_id' => $api_user_id,
				) );
				$api->create();
			}
		}
	}
}

?>