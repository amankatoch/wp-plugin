<?php

class DispletRetsIdxRewriteModel extends DispletRetsIdxPlugin {
	public static function generate_rewrite_rules() {
		$page_slug = trailingslashit( DispletRetsIdxUtilities::get_full_page_slug( self::$_options['property_details_page_id'] ) );
		$search_slug = trailingslashit( DispletRetsIdxUtilities::get_full_page_slug( self::$_options['search_results_page_id'] ) );
		add_rewrite_tag( '%property_state%', '([^/]{1,3})' );
		add_rewrite_tag( '%property_city%', '([^/]+)' );
		add_rewrite_tag( '%property_zip%', '([^/]+)' );
		add_rewrite_tag( '%property_id%', '([^/]+)' );
		add_rewrite_tag( '%property_address%', '([^/]+)' );
		add_rewrite_tag( '%property_price%', '([\d]+)' );
		add_rewrite_tag( '%property_update_id%', '([^/]+)' );
		add_rewrite_tag( '%re_user_login%', '([^/]+)' );
		add_rewrite_tag( '%residential_permalinks%', '([^/]+)' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/([^/]*)/([^/]*)/page/([0-9]+)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&property_city=$matches[2]&property_zip=$matches[3]&paged=$matches[4]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/([^/]*)/page/([0-9]+)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&property_city=$matches[2]&paged=$matches[3]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/page/([0-9]+)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&paged=$matches[2]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/([^/]*)/([^/]*)/([^/]*)/([^/]*)/([\d]*)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&property_city=$matches[2]&property_zip=$matches[3]&property_id=$matches[4]&property_address=$matches[5]&property_price=$matches[6]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/([^/]*)/([^/]*)/([^/]*)/([^/]*)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&property_city=$matches[2]&property_zip=$matches[3]&property_id=$matches[4]&property_address=$matches[5]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/([^/]*)/([^/]*)/([^/]*)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&property_city=$matches[2]&property_zip=$matches[3]&property_id=$matches[4]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/([^/]*)/([^/]*)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&property_city=$matches[2]&property_zip=$matches[3]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/([^/]*)/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]&property_city=$matches[2]', 'top' );
		add_rewrite_rule( $page_slug . '([^/]{1,3})/?$', 'index.php?page_id=' . self::$_options['property_details_page_id'] . '&property_state=$matches[1]', 'top' );
		if ( $search_slug === 'search/' && $search_slug !== $page_slug ) {
			add_rewrite_rule( $search_slug . 'page/([0-9]+)/?$', 'index.php?page_id=' . self::$_options['search_results_page_id'] . '&paged=$matches[1]', 'top' );
		}
		add_rewrite_rule('rets-mobile/([^/]{1,3})/?([^/]*)/?([^/]*)/?([^/]*)/?([^/]*)/?([\d]*)/?$', 'index.php?post_type=rets-mobile&property_state=$matches[1]&property_city=$matches[2]&property_zip=$matches[3]&property_id=$matches[4]&property_address=$matches[5]&property_price=$matches[6]', 'top');
		add_rewrite_rule('displet-property-update/([^/]+)/?([^/]*)/?$', 'index.php?property_update_id=$matches[1]&re_user_login=$matches[2]', 'top');
	}

	public static function get_property_id_from_url( $url ) {
		if ( !empty( $url ) ) {
			$pdp_url = get_permalink( self::$_options['property_details_page_id'] );
			$clean_url = str_replace( $pdp_url, '', $url );
			preg_match( '#[^/]+/[^/]+/[^/]+/( [^/]+ )#', $clean_url, $matches );
			if ( !empty( $matches ) ) {
				return $matches[1];
			}
		}
	}
}

?>