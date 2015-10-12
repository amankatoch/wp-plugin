<?php

class DispletRetsIdxMobilePageController extends DispletRetsIdxPagesController {
	public static function register_menu() {
		if ( !empty( self::$_options['mobile_version'] ) ) {
			register_nav_menus( array(
			  'displetretsidx_mobile_menu' => "Mobile Homepage Menu",
			) );
		}
	}

	public static function register_post_types() {
		$args = array(
			'public' => false,
			'publicly_queryable' => true,
			'has_archive' => true
		 );
		register_post_type( 'rets-mobile', $args );
		register_post_type( 'rets-mobile-home', $args );
		register_post_type( 'rets-mobile-contact', $args );
	}

	public static function register_sidebars() {
		if ( !empty( self::$_options['mobile_version'] ) ) {
			register_sidebar( array(
				'name' => 'Displet Mobile Contact Page Top',
				'id' => 'displetretsidx-mobile-contact-top',
				'description' => 'Above contact information',
				'before_widget' => '<div class="displet-widget">',
				'after_widget' => '</div>',
				'before_title' => '<div class="displet-title">',
				'after_title' => '</div>',
			) );
			register_sidebar( array(
				'name' => 'Displet Mobile Contact Page Bottom',
				'id' => 'displetretsidx-mobile-contact-bottom',
				'description' => 'Below contact information',
				'before_widget' => '<div class="displet-widget">',
				'after_widget' => '</div>',
				'before_title' => '<div class="displet-title">',
				'after_title' => '</div>',
			) );
		}
	}

	public static function use_contact_page_template( $template ){
		return DispletRetsIdxTemplatesController::get_template_path( 'displet-mobile-contact-page.php' );
	}

	public static function use_home_page_template( $template ){
		return DispletRetsIdxTemplatesController::get_template_path( 'displet-mobile-home-page.php' );
	}
}

?>