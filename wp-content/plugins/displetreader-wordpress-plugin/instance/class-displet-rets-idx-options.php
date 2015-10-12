<?php

class DispletRetsIdxOptions extends DispletRetsIdxOptionsController {
	public function __construct( $args, $sections, $options ) {
		$this->_model = wp_parse_args( $args, array(
			'menu_title' => '',
			'options_slug' => '',
			'page_slug' => '',
			'page_title' => '',
			'scripts' => array(
				'jquery',
			),
			'styles' => false,
		) );
		$this->_sections = $sections;
		$this->_settings = $options;
		$this->_add_page();
		add_action( 'admin_init', array( $this, '_create_page' ) );
	}

	public function update_field( $id, $value, $key = 'choices' ) {
		if ( !empty( $this->_settings ) && is_array( $this->_settings ) ) {
			foreach ( $this->_settings as &$setting ) {
				if ( !empty( $setting['id'] ) && $setting['id'] === $id ) {
					$setting[ $key ] = $value;
					break;
				}
			}
		}
	}
}

?>