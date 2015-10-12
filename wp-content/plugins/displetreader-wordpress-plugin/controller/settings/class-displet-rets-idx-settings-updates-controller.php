<?php

class DispletRetsIdxSettingsUpdatesController extends DispletRetsIdxSettingsController {
	protected static $_search_values_fields = array(
		'search_values_property_types',
		'search_values_min_price',
		'search_values_max_price',
		'search_values_price_increment',
		'search_values_custom_prices',
		'search_values_beds_min',
		'search_values_beds_max',
		'search_values_baths_min',
		'search_values_baths_max',
		'search_values_min_square_feet',
		'search_values_max_square_feet',
		'search_values_square_feet_increment',
		'search_values_min_acres',
		'search_values_max_acres',
		'search_values_acres_increment',
	);

	public static function update_settings_to_version_1() {
		$displetretsidx_option = DispletRetsIdxOptionsController::get_option();
		if ( !empty( $displetretsidx_option['include_stats'] ) ) {
			$displetretsidx_option['include_stats'] = 'basic';
		}
		else{
			$displetretsidx_option['include_stats'] = 'no';
		}
		DispletRetsIdxOptionsController::update_option( 'settings', $displetretsidx_option );
	}

	public static function change_to_multi_checkbox_from_one_per_line_textarea( $option_name ) {
		$options = DispletRetsIdxOptionsController::get_option();
		if ( !empty( $options[ $option_name ] ) ) {
			$values_array = array_map( 'trim', explode( "\n", $options[ $option_name ] ) );
			$new_values_array = array();
			foreach ( $values_array as $value ) {
				$new_values_array[$value] = 'true';
			}
			$options[ $option_name ] = $new_values_array;
		}
		DispletRetsIdxOptionsController::update_option( 'settings', $options );
	}

	public static function change_mutli_checkboxes_to_boolean_from_true_false_string() {
		$options = DispletRetsIdxOptionsController::get_option();
		if ( !empty( $options ) ) {
			$default_options = self::_get_options();
			foreach ( $default_options as $option ) {
				if ( $option['type'] === 'multi-checkbox' && !empty( $options[ $option['id'] ] ) && is_array( $options[ $option['id'] ] ) ) {
					foreach ( $options[ $option['id'] ] as $key => $value ) {
						$options[ $option['id'] ][ $key ] = $value === 'true' ? true : false;
					}
				}
			}
			DispletRetsIdxOptionsController::update_option( 'settings', $options );
		}
	}

	public static function save_search_values_as_new_option() {
		$new_options = array();
		foreach ( self::$_search_values_fields as $field ) {
			$new_options[ $field ] = self::$_options[ $field ];
		}
		update_option( 'displet_rets_idx_search_values', $new_options );
	}

	public static function set_quick_search_ids_from_widget_classes() {
		$widget_areas = get_option( 'sidebars_widgets' );
		if ( !empty( $widget_areas ) && is_array( $widget_areas ) ) {
			$old_widgets = array();
			$i = 1;
			foreach ( $widget_areas as &$widgets ) {
				if ( !empty( $widgets ) && is_array( $widgets ) ) {
					foreach ( $widgets as &$widget ) {
						preg_match( '/displetretsidxquicksearchwidget(\d{1})-(\d*)/', $widget, $matches );
						if ( !empty( $matches ) ) {
							$widget = 'displetretsidxquicksearchwidget-' . $i;
							$old_widgets[ $matches[1] ][] = $matches[2];
							$i++;
						}
					}
				}
			}
			if ( !empty( $old_widgets ) ) {
				$new_widgets = array();
				$i = 1;
				foreach ( $old_widgets as $id => $widgets ) {
					if ( !empty( $widgets ) ) {
						$widget_options = get_option( 'widget_displetretsidxquicksearchwidget' . $id );
						foreach ( $widgets as $key ) {
							if ( !empty( $widget_options[ $key ] ) && is_array( $widget_options[ $key ] ) ) {
								$widget_options[ $key ]['id'] = $id;
								$new_widgets[ $i ] = $widget_options[ $key ];
								$i++;
							}
						}
					}
				}
				update_option( 'widget_displetretsidxquicksearchwidget', $new_widgets );
				update_option( 'sidebars_widgets', $widget_areas );
			}
		}
	}

	public static function set_search_forms_from_widget_areas() {
		$widget_areas = get_option( 'sidebars_widgets' );
		if ( !empty( $widget_areas ) && is_array( $widget_areas ) ) {
			$search_forms = array(
				array(),
				array(),
				array(),
				array(),
				array(),
			);
			foreach ( $widget_areas as $widget_area => $widgets ) {
				if ( !empty( $widgets ) ) {
					if ( $widget_area === 'displetretsidx-quick-search-form-mobile' ) {
						$search_forms[2][0] = $widgets;
					}
					else if ( $widget_area === 'displetretsidx-search-form-mobile' ) {
						$search_forms[3][0] = $widgets;
					}
					elseif ( strpos( $widget_area, 'displetretsidx-search-form-advanced-' ) !== false ) {
						$column_id = intval( str_replace( 'displetretsidx-search-form-advanced-', '' , $widget_area ) ) - 1;
						$search_forms[1][ $column_id ] = $widgets;
					}
					else if ( strpos( $widget_area, 'displetretsidx-search-form-' ) !== false ) {
						$column_id = intval( str_replace( 'displetretsidx-search-form-', '' , $widget_area ) ) - 1;
						$search_forms[0][ $column_id ] = $widgets;
					}
					else {
						preg_match( '/displetretsidx-quick-search-(\d{1})-form-(\d*)/', $widget_area, $matches );
						if ( !empty( $matches ) ) {
							$form_id = intval( $matches[1] ) + 3;
							$column_id = intval( $matches[2] ) - 1;
							$search_forms[ $form_id ][ $column_id ] = $widgets;
						}
					}
				}
			}
			$widgets = get_option( 'widget_displetretsidxsearchfield' );
			if ( !empty( $widgets ) ) {
				foreach ( $search_forms as &$form ) {
					if ( !empty( $form ) ) {
						foreach ( $form as &$column ) {
							if ( !empty( $column ) && is_array( $column ) ) {
								foreach ( $column as &$field ) {
									if ( strpos( $field, 'displetretsidxsearchfield-' ) !== false ) {
										$key = intval( str_replace( 'displetretsidxsearchfield-', '', $field ) );
										$field = $widgets[ $key ]['field'];
									}
								}
							}
						}
					}
				}
				DispletRetsIdxSearchFormsPageController::set_search_forms( $search_forms, true );
			}
		}
	}

	public static function update_setting( $key, $value ) {
		$options = DispletRetsIdxOptionsController::get_option();
		$options[ $key ] = $value;
		DispletRetsIdxOptionsController::update_option( 'settings', $options );
	}
}

?>