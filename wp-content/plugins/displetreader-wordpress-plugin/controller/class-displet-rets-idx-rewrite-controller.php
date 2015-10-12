<?php

class DispletRetsIdxRewriteController extends DispletRetsIdxRewriteModel {
	public static function check_flush_rewrite_rules() {
		$flush_rewrite_version = get_option( 'displet_rets_idx_flushed_rewrite_rules' );
		if ( empty( $flush_rewrite_version ) ){
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
			update_option( 'displet_rets_idx_flushed_rewrite_rules', true );
		}
	}

	public static function maybe_reset_flush_rewrite( $post_id ){
		if ( $post_id == self::$_options['property_details_page_id'] ) {
			self::reset_flush_rewrite_rules();
		}
	}

	public static function reset_flush_rewrite_rules() {
		update_option( 'displet_rets_idx_flushed_rewrite_rules', false );
	}
}

?>