<?php

class DispletRetsIdxPagesController extends DispletRetsIdxPagesModel {
	public static function add_rel_prev_next() {
		if ( !empty( self::$_model['page'] ) && !empty( self::$_model['canonical'] ) ) {
			$url = trailingslashit( self::$_model['canonical'] );
			if ( self::$_model['page'] > 1 ) {
				$previous_url = self::$_model['page'] === 2 ? $url : $url . 'page/' . ( self::$_model['page'] - 1 );
				echo '<link rel="prev" href="' . $previous_url . '"/>' . PHP_EOL;
			}
			if ( !empty( self::$_model['meta']->count ) && !empty( self::$_model['meta']->last ) && self::$_model['meta']->last < self::$_model['meta']->count ) {
				echo '<link rel="next" href="' . $url . 'page/' . ( self::$_model['page'] + 1 ) . '"/>' . PHP_EOL;
			}
		}
	}

	public static function build() {
		self::build_model();
		self::maybe_prompt_for_mobile_redirect();
		self::maybe_include_templates();
		self::maybe_login_re_user();
		self::_update_user_property_views();
	}

	protected static function get_content() {
		$templates = new DispletRetsIdxTemplates( self::$_model );
		return $templates->get_templates();
	}

	public static function include_listings_jquery( $model ) {
		echo DispletRetsIdxTemplatesController::get_template( 'displet-listings-jquery.php', $model );
	}

	public static function include_ie_check() {
		echo
			'<!--[if IE]>' . PHP_EOL .
			'<script type="text/javascript">' . PHP_EOL .
			'	displetretsidx.is_ie = true;' . PHP_EOL .
			'</script>' . PHP_EOL .
			'<![endif]-->';
	}

	/*
	public static function include_javascript_variables() {
		if ( !is_admin() ) {
			echo DispletRetsIdxTemplatesController::get_template( 'displet-javascript-variables.php', self::$_model );
		}
	}
	*/

	public static function include_not_ie_styles(){
		echo DispletRetsIdxTemplatesController::get_template( 'displet-not-ie-styles.php', self::$_model );
	}

	public static function include_mobile_redirect_prompt() {
		$message = 'It appears you are using a mobile device.';
		if ( self::$_model['is_property_details_page'] ) {
			$url = DispletRetsIdxUtilities::get_listing_permalink( array(
				'page_url' => home_url( 'rets-mobile' ),
				'state' => self::$_model['property_state'],
				'city' => self::$_model['property_city'],
				'zip' => self::$_model['property_zip'],
				'id' => self::$_model['property_id'],
				'address' => self::$_model['property_address'],
				'price' => self::$_model['property_price'],
			) );
			$message .= 'Would you like to navigate to the mobile-specific page for this property?';
		}
		else{
			$url = home_url( 'rets-mobile-home' );
			$message .= 'Would you like to navigate to the mobile-specific real estate search?';
		}
		echo
			'<script>
				jQuery(document).bind("displetretsidx_have_cookies", function(){
					if (displetretsidx.cookies.use_mobile != "false") {
						var go_to_mobile = confirm("' . $message . '");
						if (go_to_mobile === true) {
							window.location.href = "' . $url . '";
						}
						else{
							displetretsidx.set_cookie("displetretsidx_use_mobile", "false");
						}
					}
				});
			</script>';
	}

	public static function include_version() {
		echo '<!-- Displet RETS/IDX v. ' . self::$_version . ' -->';
	}

	public static function is_property_details_page() {
		return self::$_model['is_property_details_page'];
	}

	public function maybe_add_rel_prev_and_next() {
		if ( self::$_model['is_partial_address_page'] || self::$_model['is_search_results_page'] ) {
			//remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
			//remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
			add_action( 'wp_head', array( 'DispletRetsIdxPagesController', 'add_rel_prev_next' ) );
		}
	}

	public static function maybe_adjust_for_genesis() {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] || ( self::$_model['is_mobile_page'] && self::$_model['is_search_results_page'] ) ) {
			if ( function_exists( 'genesis_disable_seo' ) ) {
				genesis_disable_seo();
				if ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] ) {
					remove_filter( 'wp_title', 'genesis_default_title', 10, 3 );
					remove_action( 'genesis_title', 'wp_title' );
					if ( self::$_model['is_property_details_page'] ) {
						add_action( 'genesis_title', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_meta_title_genesis' ) );
					}
					else if ( self::$_model['is_partial_address_page'] ) {
						add_action( 'genesis_title', array( 'DispletRetsIdxPartialAddressPageController', 'replace_meta_title_genesis' ) );
					}
				}
			}
		}
	}

	private static function maybe_include_templates() {
		if ( self::$_model['is_property_details_page'] ) {
			add_action( 'wp_footer', array( 'DispletRetsIdxPropertyDetailsPageController', 'include_popups' ) );
			add_filter( 'wp_title', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_meta_title' ), 1000000 );
			add_filter( 'wpseo_title', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_meta_title' ) );
			if ( self::$_model['is_mobile_page'] ) {
				add_filter( 'template_include', array( 'DispletRetsIdxPropertyDetailsPageController', 'use_mobile_template' ) );
			}
			else {
				add_filter( 'the_content', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_page_content' ) );
				add_filter( 'the_title', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_page_title' ), 10, 2 );
			}
		}
		else if ( self::$_model['is_partial_address_page'] ) {
			add_filter( 'wp_title', array( 'DispletRetsIdxPartialAddressPageController', 'replace_meta_title' ), 1000000 );
			add_filter( 'wpseo_title', array( 'DispletRetsIdxPartialAddressPageController', 'replace_meta_title' ) );
			add_filter( 'the_content', array( 'DispletRetsIdxPartialAddressPageController', 'replace_page_content' ) );
			add_filter( 'the_title', array( 'DispletRetsIdxPartialAddressPageController', 'replace_page_title' ), 10, 2 );
		}
		else if ( self::$_model['is_search_results_page'] ) {
			add_action( 'wp_footer', array( 'DispletRetsIdxSearchResultsPageController', 'include_save_search_popup' ) );
			if ( self::$_model['is_mobile_page'] ) {
				add_action( 'wp_head', array( 'DispletRetsIdxSearchResultsPageController', 'include_mobile_jquery' ) );
				add_filter( 'template_include', array( 'DispletRetsIdxSearchResultsPageController', 'use_mobile_template' ) );
			}
			else{
				add_filter( 'the_content', array( 'DispletRetsIdxSearchResultsPageController', 'replace_page_content' ) );
			}
		}
		else if ( self::$_model['pages']['is_mobile_home_page'] ) {
			add_filter( 'template_include', array( 'DispletRetsIdxMobilePageController', 'use_home_page_template' ) );
		}
		else if ( self::$_model['pages']['is_mobile_contact_page'] ) {
			add_filter( 'template_include', array( 'DispletRetsIdxMobilePageController', 'use_contact_page_template' ) );
		}
		if ( self::$_model['has_login_register_popup'] ) {
			add_action( 'wp_footer', array( 'DispletRetsIdxPropertyDetailsPageController', 'include_login_register_popup' ) );
		}
		if ( self::$_model['has_request_showing_popup'] ) {
			add_action( 'wp_footer', array( 'DispletRetsIdxPropertyDetailsPageController', 'include_request_showing_popup' ) );
		}
		if ( self::$_model['has_save_search_registration_popup'] ) {
			add_action( 'wp_footer', array( 'DispletRetsIdxSearchResultsPageController', 'include_save_search_registration_popup' ) );
		}
	}

	private static function maybe_login_re_user() {
		if ( self::$_model['is_property_update_page'] && !empty( self::$_model['re_user_login'] ) ) {
			$user_id = username_exists( urldecode( trim( self::$_model['re_user_login'] ) ) );
			if ( !empty( $user_id ) && user_can( $user_id, 'displet_user' ) && !user_can( $user_id, 'manage_options' ) ) {
				wp_set_auth_cookie( $user_id, true );
			}
		}
	}

	public static function maybe_noindex_nofollow(){
		if ( self::$_model['is_search_results_page'] && !empty( self::$_options['no_index_no_follow_search_results_page'] ) ) {
			echo '<meta name="robots" content="noindex,nofollow">' . PHP_EOL;
		}
	}

	private static function maybe_prompt_for_mobile_redirect() {
		if ( self::$_model['is_mobile_device'] && !self::$_model['is_mobile_page'] ) {
			add_action( 'wp_head', array( 'DispletRetsIdxPagesController', 'include_mobile_redirect_prompt' ) );
		}
	}

	public static function maybe_replace_canonical(){
		if ( !has_action( 'wpseo_head' ) ) {
			if ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] ) {
				remove_action( 'wp_head', 'rel_canonical' );
				add_action( 'wp_head', array( 'DispletRetsIdxPagesController', 'new_canonical' ), 1 );
			}
		}
	}

	public static function maybe_replace_yoasts_canonical( $canonical ) {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_partial_address_page'] ) {
	    	return self::$_model['canonical'];
	    }
		return $canonical;
	}

	public static function new_canonical() {
	    echo '<link rel="canonical" href="' . self::$_model['canonical'] . '" />' . PHP_EOL;
	}

	public static function redirect_to_canonical() {
		if ( ( self::$_model['is_property_details_page'] || self::$_model['is_property_update_page'] ) && !empty( self::$_model['listings'][0]->permalink ) && !self::$_model['is_canonical'] ) {
			wp_safe_redirect( self::$_model['listings'][0]->permalink, 301 );
		}
	}

	public static function redirect_to_parent() {
		if ( self::$_model['is_property_details_page'] || self::$_model['is_property_update_page'] ) {
			if ( empty( self::$_model['listings'][0] ) ) {
				$url = DispletRetsIdxUtilities::get_listing_permalink( array(
	    			'page_url' => self::$_model['property_details_page_url'],
	    			'state' => self::$_model['property_state'],
	    			'city' => self::$_model['property_city'],
	    			'zip' => self::$_model['property_zip']
	    		) );
				$url .= '#listing=' . self::$_model['property_id'] . '/';
	    		if ( !empty( self::$_model['property_address'] ) ) {
	    			$url .= 'address=' . self::$_model['property_address'] . '/';
	    		}
	    		$url .= 'status=unavailable';
	    		wp_safe_redirect( $url, 301 );
			}
			else {
				self::redirect_to_canonical();
			}
		}
		else if ( self::$_model['is_partial_address_page'] && empty( self::$_model['meta']->count ) ) {
			$query_vars = array_filter( array(
				self::$_model['property_state'],
				self::$_model['property_city'],
				self::$_model['property_zip'],
			), 'trim' );
			array_pop( $query_vars );
			if ( !empty( $query_vars ) ) {
				$url = trailingslashit( self::$_model['property_details_page_url'] ) . implode('/', $query_vars );
			}
			else {
				$url = self::$_model['search_results_page_url'];
			}
			wp_safe_redirect( $url, 301 );
		}
	}

	private static function _update_user_property_views() {
		if ( self::$_model['is_property_details_page'] && self::$_model['is_canonical'] ) {
			DispletRetsIdxViewedPropertiesController::update_viewed_properties( array(
				'address' => self::$_model['listings'][0]->address,
				'baths' => self::$_model['listings'][0]->full_baths,
				'beds' => self::$_model['listings'][0]->num_bedrooms,
				'id' => self::$_model['property_id'],
				'image_url' => self::$_model['listings'][0]->image_urls->primary_big,
				'price' => self::$_model['listings'][0]->list_price,
				'sq_ft' => self::$_model['listings'][0]->square_feet,
				'url' => str_replace( trailingslashit( self::$_model['property_details_page_url'] ) , '', self::$_model['canonical'] ),
				'zip' => self::$_model['listings'][0]->zip,
			) );
		}
	}
}

?>