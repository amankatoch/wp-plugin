<?php

class DispletRetsIdxLendersController extends DispletRetsIdxLendersModel {
	public static function get_new_duty_lender_id() {
		$duty_lender_array_position = get_option( 'displet_rets_idx_duty_lender_array_position' );
		if ( !empty( self::$_options['duty_lender'] ) ) {
			$duty_lenders = array();
			foreach ( self::$_options['duty_lender'] as $lender_id => $value ) {
				if ( !empty( $value ) ) {
					$duty_lenders[] = $lender_id;
				}
			}
			if ( !empty( $duty_lenders ) ) {
				if ( !empty( $duty_lender_array_position ) && intval( $duty_lender_array_position ) < count( $duty_lenders ) ) {
					$i = intval( $duty_lender_array_position );
				}
				else{
					$i = 0;
				}
				$duty_lender_array_position = $i;
				$duty_lender_array_position++;
				update_option( 'displet_rets_idx_duty_lender_array_position', $duty_lender_array_position );
				return $duty_lenders[$i];
			}
		}
	}
}

?>