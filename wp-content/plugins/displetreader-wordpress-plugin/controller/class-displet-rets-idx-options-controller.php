<?php

class DispletRetsIdxOptionsController extends DispletRetsIdxOptionsModel {
	public function add_field( $args = array() ) {
		extract( wp_parse_args( $args, array(
			'type' => false,
			'id' => false,
			'desc' => false,
			'std' => false,
			'choices' => false,
			'class' => false,
			'help' => false,
			'idx' => false,
			'auth' => 1,
			'min' => '',
			'max' => '',
			'explicit' => false,
		) ) );
		$class = $class === 'color' ? 'displet-color-picker' : '';
		$class .= $explicit ? 'displet-explicit-text' : '';
		$idx_disabled = ( $idx  && empty( self::$_options['displet_app_key'] ) ) ? 'disabled' : '';
		if ( $auth !== 1 ) {
			$auth_markup = !empty( $auth ) ? '<span class="displet-authorized">Authorized for ' . $auth . '</span>' : '<span class="displet-unauthorized">Unsuccessful attempt to authorize. Please re-enter your API key and password and try again.</span>';
		}
		else {
			$auth_markup = '';
		}
		$help_markup = !empty( $help ) ? '<a class="displet-help" href="' . esc_url_raw( $help ) . '" target="_blank">Help</a>' . PHP_EOL : '';
		$description_markup = !empty( $desc ) ? '<p><span class="description">' . $desc . '</span></p>' . PHP_EOL : '';
		if ( $type !== 'multi-checkbox' && $type !== 'multi-text' ) {
			$value = isset( self::$_options[ $id ] ) ? self::$_options[ $id ] : $std;
		}
		if ( $explicit ) {
			echo '<div><a href="javascript:;" class="displet-explicit-text-toggle">Explicit Content - Click to Show</a></div>';
		}
		switch ( $type ) {
			case 'text':
				echo '<input class="regular-text ' . $class . '" type="text" id="' . $id . '" name="' . $this->_model['options_slug'] . '[' . $id . ']" value="' . esc_attr( stripslashes( $value ) ) . '" ' . $idx_disabled . '/>';
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'password':
				echo '<input class="regular-text ' . $class . '" type="password" id="' . $id . '" name="' . $this->_model['options_slug'] . '[' . $id . ']" value="' . esc_attr( stripslashes( $value ) ) . '" ' . $idx_disabled . '/>';
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'multi-text':
				foreach( $choices as $slug => $label ) {
					$value = isset( self::$_options[ $id ][ $slug ] ) ? self::$_options[ $id ][ $slug ] : $std[ $slug ];
					echo '<span>' . $label . ':</span><input class="regular-text ' . $class . '" type="text" id="' . $id . '|' . $slug . '" name="' . $this->_model['options_slug'] . '[' . $id . '|' . $slug . ']" value="' . esc_attr( $value ) . '" ' . $idx_disabled . '/><br/>';
				}
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'textarea':
				echo '<textarea class="textarea ' . $class . '" type="text" id="' . $id . '" name="' . $this->_model['options_slug'] . '[' . $id . ']" rows="5" cols="30" ' . $idx_disabled . '>' . esc_html( stripslashes( $value ) ) . '</textarea>';
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'select':
				echo '<select id="' . $id . '" class="select ' . $class . '" name="' . $this->_model['options_slug'] . '[' . $id . ']" ' . $idx_disabled . '>';
					foreach( $choices as $choice ) {
						echo '<option value="' . esc_attr( $choice ) . '" ' . selected( $value, $choice, false ) . '>' . esc_html( $choice ) . '</option>';
					}
				echo '</select>';
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'select2':
				echo '<select id="' . $id . '" class="select ' . $class . '" name="' . $this->_model['options_slug'] . '[' . $id . ']" ' . $idx_disabled . '>';
				foreach( $choices as $slug => $label ) {
					echo '<option value="' . esc_attr( $slug ) . '"' . selected( $value, $slug, false )  . '>' . esc_html( $label ) . '</option>';
				}
				echo '</select>';
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'checkbox':
				echo '<input class="checkbox ' . $class . '" type="checkbox" id="' . $id . '" name="' . $this->_model['options_slug'] . '[' . $id . ']" value="1" ' . checked( $value, true, false ) . ' ' . $idx_disabled . '/>';
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'multi-checkbox':
				$i = 0;
				foreach( $choices as $slug => $label ) {
					$value = isset( self::$_options[ $id ][ $slug ] ) ? self::$_options[ $id ][ $slug ] : $std[ $slug ];
					echo '<input class="checkbox ' . $class . '" type="checkbox" id="' . $id . '|' . $slug . '" name="' . $this->_model['options_slug'] . '[' . $id .'|' . $slug . ']" value="1" ' . checked( self::$_options[ $id ][ $slug ], true, false ) . ' ' . $idx_disabled . '/>' . esc_html( $label ) . '<br/>';
					$i++;
				}
				echo $auth_markup . $help_markup . $description_markup;
			break;
			case 'image':
				$style = !empty( self::$_options[ $id ] ) ? 'background-image:url(' . esc_url( self::$_options[ $id ] ) . ');' : 'display:none;';
				echo '<div id="' . $id . '-display" class="displet-photo-display" style="' . $style . '"></div>';
				echo '<input type="text" id="' . $id . '" name="' . $this->_model['options_slug'] . '[' . $id . ']' . '" value="' . esc_url( self::$_options[ $id ] ) . '" />';
				echo '<input type="button" id="' . $id . '-upload" class="button" value="Select Image" />';
				echo $desc != '' ? "<br /><span class='description'>$desc</span>" : "";
			break;
			case 'editor':
				wp_editor( $value, $this->_model['options_slug'] . '_' . $id, array(
					'textarea_name' => $this->_model['options_slug'] . '[' . $id . ']',
					'textarea_rows' => 5,
				) );
				echo $auth_markup . $help_markup . $description_markup;
			break;
		}
	}

	private function _add_fields() {
		if ( !empty( $this->_settings ) && is_array( $this->_settings ) ) {
			foreach ( $this->_settings as $option ) {
				if ( !empty( $option['id'] ) && !empty( $option['title'] ) && !empty( $option['section'] ) ) {
					add_settings_field( $option['id'], $option['title'], array( $this, 'add_field' ), $this->_model['page_slug'], $option['section'], $option );
				}
			}
		}
	}

	protected function _add_page() {
		$page = DispletRetsIdxAdminPagesController::add_displet_tools_submenu_page( array(
			'menu_title' => $this->_model['menu_title'],
			'page_callback' => array( $this, 'render_page' ),
			'page_slug' => $this->_model['page_slug'],
		) );
		if ( $page ) {
			$this->_add_page_hooks( $page );
		}
	}

	private function _add_page_hooks( $page ) {
		add_action( 'load-'. $page, array( $this, 'enqueue' ) );
	}

	private function _add_sections() {
		if ( !empty( $this->_sections ) && is_array( $this->_sections ) ) {
			foreach ( $this->_sections as $id => $title ) {
				add_settings_section( $id, $title, array( $this, 'section_callback' ), $this->_model['page_slug'] );
			}
		}
	}

	public function _create_page() {
		$this->_register_settings();
		$this->_add_sections();
		$this->_add_fields();
	}

	public function enqueue() {
		wp_enqueue_style(
			'displetretsidx-options-styles',
			trailingslashit( self::$_urls['css'] ) . 'displet-rets-idx-options-styles.css',
			$this->_model['styles'],
			self::$_version
		);
		wp_enqueue_script(
			'displetretsidx-options-scripts',
			trailingslashit( self::$_urls['js'] ) . 'displet-rets-idx-options-scripts.js',
			$this->_model['scripts'],
			self::$_version
		);
	}

	public static function get_associative_array_from_post_objects( $objects, $key_property = 'ID', $value_property = 'post_title' ) {
		$array = array();
		if ( !empty( $objects ) && is_array( $objects ) ) {
			foreach ( $objects as $object ) {
				$array[ $object->{ $key_property } ] = $object->{ $value_property };
			}
		}
		return $array;
	}

	public static function get_option( $name = 'settings' ) {
		$option_name = self::get_option_name( $name );
		if ( !empty( $option_name ) ) {
			return self::_stripslashes_deep( get_option( $option_name ) );
		}
	}

	private static function get_option_name( $name ) {
		if ( !empty( self::$_slugs['options'][ $name ] ) ) {
			return self::$_slugs['options'][ $name ];
		}
		return false;
	}

	private function _register_settings() {
		register_setting( $this->_model['options_slug'], $this->_model['options_slug'], array( $this, 'validate_callback' ) );
	}

	public function render_page() {
		?>
		<div id="<?php echo $this->_model['div_id']; ?>" class="wrap displet-admin">
			<h2>
				<?php echo $this->_model['page_title']; ?>
			</h2>
			<div class="displet-messages">
				<?php settings_errors(); ?>
			</div>
			<form action="options.php" method="post">
				<?php if ( !empty( $this->_sections ) && is_array( $this->_sections ) ) : ?>
					<h2 class="displet-tabs nav-tab-wrapper">
					<?php foreach ( $this->_sections as $section => $title ) : ?>
						<?php if ( strpos( $section, 'open' ) !== false ) : ?>
							<a href="#<?php echo preg_replace( '/\W*/', '', $title ); ?>" class="nav-tab">
								<?php echo $title; ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
					</h2>
				<?php endif; ?>
				<?php
					settings_fields( $this->_model['options_slug'] );
					do_settings_sections( $this->_model['page_slug'] );
				?>
				<p class="submit">
					<input name="Submit" type="submit" class="button-primary" value="Save"/>
				</p>
			</form>
		</div>
		<?php
	}

	public function section_callback( $args ) {
		if ( strpos( $args['id'], 'open' ) !== false ) {
			echo '<div id="' . preg_replace( '/\W*/', '', $args['title'] ) . '" class="displet-tabbed">';
		}
		else if ( strpos( $args['id'], 'close' ) !== false ) {
			echo '</div>';
		}
	}

	public static function set_options() {
		self::$_options = self::get_option();
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			self::$_field_options = self::get_option( 'fields' );
		}
		self::$_search_form_options = self::get_option( 'search_forms' );
	}

	private static function _stripslashes_deep( $value ) {
  		return is_array( $value ) ? array_map( array( 'DispletRetsIdxOptionsController', '_stripslashes_deep' ), $value ) : stripslashes( $value );
	}

	public static function update_option( $name, $value ) {
		$option_name = self::get_option_name( $name );
		if ( !empty( $option_name ) ) {
			update_option( $option_name, $value );
		}
	}

	public function validate_callback( $input ) {
		$valid_input = array();
		foreach ( $this->_settings as $option ) {
			switch ( $option['type'] ) {
				case 'text':
					switch ( $option['class'] ) {
						case 'numeric':
							$input[ $option['id'] ] = trim( $input[ $option['id'] ] );
							if ( is_numeric( $input[ $option['id'] ] ) && ( !empty( $option['min'] ) || !empty( $option['max'] ) ) ) {
								if ( !empty( $option['max'] ) && $input[ $option['id'] ] > $option['max'] ) {
									$input[ $option['id'] ] = $option['max'];
								}
								else if ( !empty( $option['min'] ) && $input[$option['id']] < $option['min'] ) {
									$input[$option['id']] = $option['min'];
								}
							}
							$valid_input[ $option['id'] ] = ( is_numeric( $input[ $option['id'] ] ) || empty( $input[ $option['id'] ] ) ) ? $input[ $option['id'] ] : 'Expecting a Numeric value!';
							if ( !is_numeric( $input[ $option['id'] ] ) && !empty( $input[ $option['id'] ] ) ) {
								add_settings_error( $option['id'], $option['id'], 'Expecting a numeric value!', 'error' );
							}
						break;
						case 'multinumeric':
							$input[ $option['id'] ] = trim( $input[ $option['id'] ] );
							if ( $input[ $option['id'] ] !='' ) {
								$valid_input[ $option['id'] ] = ( preg_match( '/^-?\d+(?:,\s?-?\d+)*$/', $input[ $option['id'] ] ) == 1 ) ? $input[ $option['id'] ] : 'Expecting comma separated numeric values';
							}
							else {
								$valid_input[ $option['id'] ] = $input[ $option['id'] ];
							}
							if ( $input[ $option['id'] ] !='' && preg_match( '/^-?\d+(?:,\s?-?\d+)*$/', $input[ $option['id'] ] ) != 1 ) {
								add_settings_error( $option['id'], $option['id'], 'Expecting comma separated numeric values!', 'error' );
							}
						break;
						case 'color':
						case 'nohtml':
							$input[ $option['id'] ] = sanitize_text_field( $input[ $option['id'] ] );
							$valid_input[ $option['id'] ] = addslashes( $input[ $option['id'] ] );
						break;
						case 'url':
							$input[ $option['id'] ] = trim( $input[ $option['id'] ] );
							$valid_input[ $option['id'] ] = esc_url_raw( $input[ $option['id'] ] );
						break;
						case 'email':
							$input[ $option['id'] ] = trim( $input[ $option['id'] ] );
							if ( !empty( $input[ $option['id'] ] ) ) {
								if ( is_email( $input[ $option['id'] ] ) ) {
									$valid_input[ $option['id'] ] = $input[ $option['id'] ];
								}
								else {
									$valid_input[ $option['id'] ] = 'Invalid email! Please re-enter!';
									add_settings_error( $option['id'], $option['id'], 'Please enter a valid email address.', 'error' );
								}
							}
						break;
						default:
							$allowed_html = array(
								'a' => array(
									'href' => array(),
									'title' => array()
								 ),
								'b' => array(),
								'em' => array(),
								'i' => array(),
								'strong' => array()
							 );
							$input[ $option['id'] ] = trim( $input[ $option['id'] ] );
							$input[ $option['id'] ] = force_balance_tags( $input[ $option['id'] ] );
							$input[ $option['id'] ] = wp_kses( $input[ $option['id'] ], $allowed_html );
							$valid_input[ $option['id'] ] = addslashes( $input[ $option['id'] ] );
						break;
					}
				break;
				case 'password':
					switch ( $option['class'] ) {
						default:
							$input[ $option['id'] ] = sanitize_text_field( $input[ $option['id'] ] );
							$valid_input[ $option['id'] ] = addslashes( $input[ $option['id'] ] );
						break;
					}
				break;
				case 'multi-text':
					$textarray = array();
					foreach ( $option['choices'] as $slug => $label ) {
						if ( !empty( $input[$option['id'] . '|' . $slug] ) ) {
							switch ( $option['class'] ) {
								case 'numeric':
									$input[$option['id'] . '|' . $slug] = trim( $input[$option['id'] . '|' . $slug] );
									$input[$option['id'] . '|' . $slug] = ( is_numeric( $input[$option['id'] . '|' . $slug] ) ) ? $input[$option['id'] . '|' . $slug] : '';
								break;
								default:
									$input[$option['id'] . '|' . $slug] = sanitize_text_field( $input[$option['id'] . '|' . $slug] );
									$input[$option['id'] . '|' . $slug] = addslashes( $input[$option['id'] . '|' . $slug] );
								break;
							}
							$textarray[$slug] = $input[$option['id'] . '|' . $slug];

						}
						else {
							$textarray[$name] = '';
						}
					}
					if ( !empty( $textarray ) ) {
						$valid_input[ $option['id'] ] = $textarray;
					}
				break;
				case 'textarea':
					switch ( $option['class'] ) {
						case 'inlinehtml':
							$input[ $option['id'] ] = trim( $input[ $option['id'] ] );
							$input[ $option['id'] ] = force_balance_tags( $input[ $option['id'] ] );
							$input[ $option['id'] ] = addslashes( $input[ $option['id'] ] );
							$valid_input[ $option['id'] ] = wp_filter_kses( $input[ $option['id'] ] );
						break;
						case 'nohtml':
							$input[ $option['id'] ] = sanitize_text_field( $input[ $option['id'] ] );
							$valid_input[ $option['id'] ] = addslashes( $input[ $option['id'] ] );
						break;
						case 'allowlinebreaks':
							$input[ $option['id'] ] = wp_strip_all_tags( $input[ $option['id'] ] );
							$valid_input[ $option['id'] ] = addslashes( $input[ $option['id'] ] );
						break;
						default:
							$allowed_html = array(
								'a' => array(
									'href' => array(),
									'title' => array()
								 ),
								'b' => array(),
								'blockquote' => array(
									'cite' => array()
								 ),
								'br' => array(),
								'dd' => array(),
								'dl' => array(),
								'dt' => array(),
								'em' => array(),
								'i' => array(),
								'li' => array(),
								'ol' => array(),
								'p' => array(),
								'q' => array(
									'cite' => array()
								 ),
								'strong' => array(),
								'ul' => array(),
								'h1' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								 ),
								'h2' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								 ),
								'h3' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								 ),
								'h4' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								 ),
								'h5' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								 ),
								'h6' => array(
									'align' => array(),
									'class' => array(),
									'id' => array(),
									'style' => array()
								 )
							);
							$input[ $option['id'] ] = trim( $input[ $option['id'] ] );
							$input[ $option['id'] ] = force_balance_tags( $input[ $option['id'] ] );
							$input[ $option['id'] ] = wp_kses( $input[ $option['id'] ], $allowed_html );
							$valid_input[ $option['id'] ] = addslashes( $input[ $option['id'] ] );
						break;
					}
				break;
				case 'select':
					$valid_input[ $option['id'] ] = in_array( $input[ $option['id'] ], $option['choices'] ) ? $input[ $option['id'] ] : '';
				break;
				case 'select2':
					$valid_input[ $option['id'] ] = in_array( $input[ $option['id'] ], array_keys( $option['choices'] ) ) ? $input[ $option['id'] ] : '';
				break;
				case 'checkbox':
					if ( !isset( $input[ $option['id'] ] ) ) {
						$input[ $option['id'] ] = null;
					}
					$valid_input[ $option['id'] ] = ( $input[ $option['id'] ] == 1 ? 1 : 0 );
				break;
				case 'multi-checkbox':
					$checkboxarray = array();
					foreach ( $option['choices'] as $slug => $label ) {
						if ( !empty( $input[ $option['id'] . '|' . $slug ] ) ) {
							$checkboxarray[ $slug ] = true;
						}
						else {
							$checkboxarray[ $slug ] = false;
						}
					}
					$valid_input[ $option['id'] ] = $checkboxarray;
				break;
				case 'image':
					$valid_input[ $option['id'] ] = esc_url_raw( trim( $input[ $option['id'] ] ) );
				break;
				case 'editor':
					$valid_input[ $option['id'] ] = wp_kses( $input[ $option['id'] ], wp_kses_allowed_html( 'post' ) );
				break;
			}
		}
		return $valid_input;
	}
}

?>