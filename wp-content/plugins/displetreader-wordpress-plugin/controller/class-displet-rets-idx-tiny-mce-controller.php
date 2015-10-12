<?php

class DispletRetsIdxTinyMCEController extends DispletRetsIdxTinyMceModel {
	public static function buttons_callback( $buttons ) {
		$buttons[] = self::$_slugs['shortcode'];
		$buttons[] = '|';
		return $buttons;
	}

	public static function external_plugins_callback( array $plugins) {
		$plugins[ self::$_slugs['shortcode'] ] = trailingslashit( self::$_urls['js'] ) . 'tinymce.displetlisting.js';
		return $plugins;
	}

	public static function get_agent_id_ajax() {
		check_ajax_referer( 'displet_get_agent_id_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_get_agent_id_request' && !empty( $_POST['mls_number'] ) ) {
			$residentials = new DispletRetsIdxResidentials( array(
				'return_fields' => 'listing_agent_id',
				'mls_number' => $_POST['mls_number'],
			) );
			$results = $residentials->get_residentials();
			if ( !empty( $results['listings'][0]->listing_agent_id ) ) {
				echo $results['listings'][0]->listing_agent_id;
				die();
			}
		}
		echo 'Failed';
		die();
	}

	public static function get_office_id_ajax() {
		check_ajax_referer( 'displet_get_office_id_nonce' );
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'displet_get_office_id_request' && !empty( $_POST['mls_number'] ) ) {
			$residentials = new DispletRetsIdxResidentials( array(
				'return_fields' => 'listing_agent_id',
				'mls_number' => $_POST['mls_number'],
			) );
			$results = $residentials->get_residentials();
			if ( !empty( $results['listings'][0]->listing_office_id ) ) {
				echo $results['listings'][0]->listing_office_id;
				die();
			}
		}
		echo 'Failed';
		die();
	}
}


?>