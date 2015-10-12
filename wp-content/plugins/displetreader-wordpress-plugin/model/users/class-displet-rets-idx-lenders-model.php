<?php

class DispletRetsIdxLendersModel extends DispletRetsIdxPlugin {
	public static function add_custom_user_role_for_lenders() {
		remove_role( 'displet_lender' );
		add_role( 'displet_lender', 'Displet RE Lender', array(
			'displet_view_leads' => true,
			'edit_users' => true,
			'read' => true,
		) );
	}
}

?>