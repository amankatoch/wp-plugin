<?php

class DispletRetsIdxPropertyDetailsPageController extends DispletRetsIdxPagesController {
	protected static $_title_replacements = array(
		'address' => 'address',
		'city' => 'city',
		'mls_number' => 'mls_number',
		'state' => 'state',
		'subdivision' => 'subdivision',
		'zip_code' => 'zip',
	);

	private static function get_default_title() {
		$title = self::$_model['listings'][0]->address;
		if ( !empty( self::$_model['listings'][0]->city ) ) {
			$title .= ', ' . self::$_model['listings'][0]->city;
		}
		if ( !empty( self::$_model['listings'][0]->state ) ) {
			$title .= ', ' . self::$_model['listings'][0]->state;
		}
		if ( !empty( self::$_model['listings'][0]->zip ) ) {
			$title .= ' ' . self::$_model['listings'][0]->zip;
		}
		return $title;
	}

	private static function get_meta_title(){
		if ( !empty( self::$_options['property_details_page_title'] ) ) {
			$title = self::$_options['property_details_page_title'];
			foreach ( self::$_title_replacements as $placeholder => $property ) {
				$title = str_replace( '%%' . $placeholder . '%%', self::$_model['listings'][0]->{ $property }, $title );
			}
			return $title;
		}
		return self::get_default_title();
	}

	private static function get_page_title() {
		if ( !empty( self::$_options['property_details_page_h1'] ) ) {
			$title = self::$_options['property_details_page_h1'];
			foreach ( self::$_title_replacements as $placeholder => $property ) {
				$title = str_replace( '%%' . $placeholder . '%%', self::$_model['listings'][0]->{ $property }, $title );
			}
			return $title;
		}
		return self::get_default_title();
	}

	public static function include_login_register_popup(){
		echo DispletRetsIdxTemplatesController::get_template( 'displet-login-register-popup.php', self::$_model );
	}

	public static function include_request_showing_popup(){
		$model = self::$_model;
		if ( !self::$_model['is_property_details_page'] ) {
			$model['listings'] = array(
				'placeholder',
			);
		}
		echo DispletRetsIdxTemplatesController::get_template( 'displet-request-showing-popup.php', $model );
	}

	public static function include_popups(){
		echo DispletRetsIdxTemplatesController::get_template( 'displet-property-details-page-popups.php', self::$_model );
	}

	public static function replace_breadcrumbs_ancestors( $ancestors ) {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] ) {
			$property_details_page_id = intval( self::$_options['property_details_page_id'] );
			$ancestors[] = $property_details_page_id;
			if ( !empty( self::$_model['property_city'] ) ) {
				$ancestors[] = $property_details_page_id;
			}
			if ( !empty( self::$_model['property_zip'] ) ) {
				$ancestors[] = $property_details_page_id;
			}
			if ( !empty( self::$_model['property_id'] ) ) {
				$ancestors[] = $property_details_page_id;
			}
			self::$_model['ancestors'] = count( $ancestors );
		}
		return $ancestors;
	}

	public static function replace_breadcrumbs_title( $title ) {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] ) {
			if ( self::$_model['is_property_details_page'] ) {
				$max_subtract = 3;
			}
			else if ( !empty( self::$_model['property_zip'] ) ) {
				$max_subtract = 2;
			}
			else if ( !empty( self::$_model['property_city'] ) ) {
				$max_subtract = 1;
			}
			else if ( !empty( self::$_model['property_state'] ) ) {
				$max_subtract = 0;
			}
			if ( self::$_model['ancestor_titles'] === self::$_model['ancestors'] ) {
				if ( self::$_model['is_property_details_page'] ) {
					$title = !empty( self::$_model['listings'][0]->address ) ? self::$_model['listings'][0]->address : '';
				}
				else if ( !empty( self::$_model['property_zip'] ) ) {
					$title = urldecode( str_replace( '-', ' ', self::$_model['property_zip'] ) );
				}
				else if ( !empty( self::$_model['property_city'] ) ) {
					$title = urldecode( str_replace( '-', ' ', self::$_model['property_city'] ) );
				}
				else if ( !empty( self::$_model['property_state'] ) ) {
					$title = urldecode( str_replace( '-', ' ', self::$_model['property_state'] ) );
				}
			}
			else if ( self::$_model['ancestor_titles'] === self::$_model['ancestors'] - $max_subtract + 2 ) {
				$title = urldecode( str_replace( '-', ' ', self::$_model['property_zip'] ) );
			}
			else if ( self::$_model['ancestor_titles'] === self::$_model['ancestors'] - $max_subtract + 1 ) {
				$title = urldecode( str_replace( '-', ' ', self::$_model['property_city'] ) );
			}
			else if ( self::$_model['ancestor_titles'] === self::$_model['ancestors'] - $max_subtract ) {
				$title = urldecode( str_replace( '-', ' ', self::$_model['property_state'] ) );
			}
			self::$_model['ancestor_titles']++;
		}
		return $title;
	}

	public static function replace_partial_address_breadcrumb_urls( $url, $post_id ) {
		if ( ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] ) && $post_id === intval( self::$_options['property_details_page_id'] ) && DispletRetsIdxUtilities::is_referral_function( array( 'WPSEO_Breadcrumbs', 'get_link_info_for_id' ) ) ) {
			if ( self::$_model['is_property_details_page'] ) {
				$max_subtract = 3;
			}
			else if ( !empty( self::$_model['property_zip'] ) ) {
				$max_subtract = 2;
			}
			else if ( !empty( self::$_model['property_city'] ) ) {
				$max_subtract = 1;
			}
			else if ( !empty( self::$_model['property_state'] ) ) {
				$max_subtract = 0;
			}
			if ( self::$_model['ancestor_urls'] >= self::$_model['ancestors'] - $max_subtract ) {
				$url = trailingslashit( $url ) . self::$_model['property_state'];
			}
			if ( self::$_model['ancestor_urls'] >= self::$_model['ancestors'] - $max_subtract + 1 ) {
				$url = trailingslashit( $url ) . self::$_model['property_city'];
			}
			if ( self::$_model['ancestor_urls'] >= self::$_model['ancestors'] - $max_subtract + 2 ) {
				$url = trailingslashit( $url ) . self::$_model['property_zip'];
			}
			self::$_model['ancestor_urls']++;
		}
		return $url;
	}

	public static function replace_meta_title( $title ) {
		return self::get_meta_title();
	}

	public static function replace_meta_title_genesis(){
		$title = self::get_meta_title();
		echo '<title>' . $title . '</title>';
	}

	public static function replace_page_content( $content ) {
		if ( in_the_loop() ) {
			$template = new DispletRetsIdxTemplates( self::$_model );
			$content = $template->get_templates();
		}
		return $content;
	}

	public static function replace_page_title( $title, $id ) {
		if ( $id == self::$_options['property_details_page_id'] && in_the_loop() && DispletRetsIdxUtilities::is_referral_function( 'the_title' ) ) {
			return self::get_page_title();
		}
		return $title;
	}

	public static function use_mobile_template( $template ){
		return DispletRetsIdxTemplatesController::get_template_path( 'displet-property-details-mobile.php' );
	}
}

?>