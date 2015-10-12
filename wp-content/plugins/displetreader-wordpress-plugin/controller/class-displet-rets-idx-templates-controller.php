<?php

class DispletRetsIdxTemplatesController extends DispletRetsIdxTemplatesModel {
	public static function get_admin_template( $name, &$model ) {
		return self::render( ABSPATH . 'wp-content/plugins/' . self::$_slug . '/view/admin/' . $name, $model );
	}

	private static function get_custom_template_path( $filename ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( empty( self::$_options['disable_custom_templates'] ) ) {
			$theme_dir = get_stylesheet_directory();
			if ( file_exists( $theme_dir . '/' . $filename ) ) {
				return $theme_dir . '/' . $filename;
			}
			else if ( file_exists( ABSPATH . 'wp-content/plugins/displet-pro-custom/' . $filename ) && is_plugin_active( 'displet-pro-custom/displet-pro-custom.php' ) ) {
				return ABSPATH . 'wp-content/plugins/displet-pro-custom/' . $filename;
			}
		}
		return false;
	}

	public static function get_template( $name, &$model ) {
		$template_path = self::get_template_path( $name );
		global $displetretsidx_template;
		global $displetretsidx_results;
		$displetretsidx_template = $model;
		$displetretsidx_results = $model;
		if ( !empty( $model['query_url'] ) ) {
			$output = '<!-- Displet Query: ' . $model['query_url'] . ' -->' . PHP_EOL;
		}
		else {
			$output = '';
		}
		$output .= self::render( $template_path, $model );
		return $output;
	}

	public static function get_template_path( $filename ) {
		$custom_template_path = self::get_custom_template_path( $filename );
		if ( !empty( $custom_template_path ) ) {
			return $custom_template_path;
		}
		else{
			return ABSPATH . 'wp-content/plugins/' . self::$_slug . '/view/templates/' . $filename;
		}
	}

	private static function render( $path, &$model ) {
		if ( file_exists( $path ) ) {
			ob_start();
			include $path;
			$output = ob_get_contents();
			ob_end_clean();
			return trim( $output );
		}
	}
}

?>