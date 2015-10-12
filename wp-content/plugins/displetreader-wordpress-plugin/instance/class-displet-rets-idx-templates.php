<?php

class DispletRetsIdxTemplates extends DispletRetsIdxTemplatesController {
	protected $_model;

	public function __construct( $args = array() ) {
		$this->parse_args( $args );
		$this->build_model();
	}

	private function get_error_message() {
		if ( $this->_model['residentials_api_error'] === 'Access has been suspended.' ) {
			return
				'<div class="displet-error">
					This account has been temporarily suspended. Please contact us at
					<a href="http://tribus.zendesk.com/" target="_blank">our help desk</a>
					or call 312-957-8846 from 8am to 7pm CST, Monday to Friday.
				</div>';
		}
		return $this->_model['residentials_api_error'];
	}

	private function get_listings_jquery() {
		echo self::get_template( 'displet-listings-jquery.php', $this->_model );
	}

	public function get_templates() {
		$content = '';
		if ( current_user_can( 'manage_options' ) && !empty( $this->_model['residentials_api_error'] ) ) {
			return $this->get_error_message();
		}
		elseif ( $this->_model['is_property_details_page'] ) {
			$content .= '<!-- Displet Property ID: ' . $this->_model['property_id'] . ' -->';
			$content .= self::get_template( 'displet-property-details-page-content.php', $this->_model );
		}
		elseif ( $this->_model['is_mobile_page'] && $this->_model['is_search_results_page'] ) {
			return self::get_template_path( 'displet-search-results-mobile.php' );
		}
		else {
			if ( $this->_model['layout'] != 'table' ) {
				$content .= '<span id="displetretsidx_listings' . $this->_model['shortcode_count'] . '" class="displetretsidx_listings">';
			}
			if ( !empty( $this->_model['caption'] ) ) {
				$content .= '<h2 class="displet-caption">' . $this->_model['caption'] . '</h2>';
			}
			if ( $this->_model['is_search_results_page'] && empty( $this->_model['property_state'] ) ) {
				$content .= self::get_template( 'displet-search-form.php', $this->_model );
			}
			$content .= $this->get_listings_jquery();
			if ( $this->_model['count'] > 0 || $this->_model['layout'] == 'table' ) {
				if ( $this->_model['is_displet_api'] ) {
					if ( $this->_model['data_from'] !== 'property_showcase' && !empty( $this->_model['stats'] ) && $this->_model['stats'] !== 'no' ) {
						if ( $this->_model['stats'] == 'advanced' && $this->_model['layout'] !== 'table' && !( $this->_model['is_search_results_page'] && empty( $this->_model['property_state'] ) ) ) {
							$content .= self::get_template( 'displet-statistics-advanced.php', $this->_model );
						}
						else if ( $this->_model['stats'] == 'basic' || $this->_model['stats'] == 'yes' ) {
							$content .= self::get_template( 'displet-statistics.php', $this->_model );
						}
					}
					if ( $this->_model['data_from'] !== 'property_showcase' && !$this->_model['is_search_results_page'] && ( $this->_model['count'] > 9 || $this->_model['layout'] == 'table' ) ) {
						if ( $this->_model['layout'] !== 'table' ) {
							if ( !empty( $this->_model['property_type_navigation'] ) && $this->_model['property_type_navigation'] !== 'no' && $this->_model['show_listings'] !== 'no' && !empty( $this->_model['property_types'] ) ) {
								$content .= self::get_template( 'displet-property-type-navigation.php', $this->_model );
							}
							if ( !empty( $this->_model['price_navigation'] ) && $this->_model['price_navigation'] !== 'no' && $this->_model['show_listings'] !== 'no' ) {
								$content .= self::get_template( 'displet-price-navigation.php', $this->_model );
							}
						}
					}
				}
			}
			else if ( $this->_model['data_from'] !== 'property_showcase' && !empty( $this->_model['show_listings'] ) && $this->_model['show_listings'] == 'no' && !empty( $this->_model['stats'] ) && $this->_model['stats'] !== 'no' ) {
				if ( $this->_model['stats'] == 'advanced' ) {
					$content .= self::get_template( 'displet-statistics-advanced.php', $this->_model );
				}
				else{
					$content .= self::get_template( 'displet-statistics.php', $this->_model );
				}
			}
			if ( $this->_model['show_listings'] !== 'no' ) {
				if ( $this->_model['layout'] == 'table' ) {
					$content .= self::get_template( 'displet-table.php', $this->_model );
				}
				else {
					$content .= self::get_template( 'displet-dynamic.php', $this->_model );
				}
			}
			if ( $this->_model['layout'] !== 'table' ) {
				$content .= '</span>';
			}
		}
		return $content;
	}

	private function parse_args( $args ) {
		$this->_model = wp_parse_args( $args, array(
			'canonical' => false,
			'caption' => false,
			'data_from' => 'api',
			'is_displet_api' => !empty( self::$_options['displet_app_key'] ) ? true : false,
			'is_mobile_page' => false,
			'is_partial_address_page' => false,
			'is_property_details_page' => false,
			'is_search_results_page' => false,
			'is_shortcode' => false,
			'last_updated' => date( 'Y-m-d', strtotime( '-12 hours' ) ),
			'layout' => !empty( self::$_options['listings_layout'] ) ? self::$_options['listings_layout'] : 'default',
			'num_listings' => !empty( self::$_options['listings_per_page'] ) ? intval( self::$_options['listings_per_page'] ) : 10,
			'options' => self::$_options,
			'orientation' => !empty( self::$_options['listings_orientation'] ) ? self::$_options['listings_orientation'] : 'gallery',
			'page' => 1,
			'price_navigation' => self::$_options['include_price_navigation'],
			'price_navigation_prices' => self::$_options['price_navigation_prices'],
			'property_type_navigation' => self::$_options['include_property_type_navigation'],
			'property_type_sorting' => self::$_options['include_property_type_sorting'],
			'show_listings' => true,
			'shortcode_count' => 1,
			'stats' => self::$_options['include_stats'],
		) );
	}
}

?>