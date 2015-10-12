<?php

class DispletRetsIdxMobilePageModel extends DispletRetsIdxPagesModel {
	public static function build() {
		self::$_model = array_merge( self::$_model, array(
			'search_results_page_url' => home_url( 'rets-mobile' ),
			'mobile_home_page_url' => home_url( 'rets-mobile-home' ),
			'mobile_contact_page_url' => home_url( 'rets-mobile-contact' ),
			'favorites_page_url' => admin_url( 'admin.php?page=displetretsidx_saved_properties' ),
		) );
	}
}

?>