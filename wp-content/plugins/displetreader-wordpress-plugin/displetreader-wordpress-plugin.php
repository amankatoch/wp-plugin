<?php

/*
 * Plugin name: Displet RETS/IDX
 * Plugin URI: http://displet.com/wordpress-plugins/displetreader-wordpress-plugin
 * Description: RETS/IDX Plugin that inserts real estate listings, statistics, maps, and quick searches into Wordpress pages & widget ready sidebars. Free version available.
 * Version: 2.1.19
 * Author: Displet
 * Author URI: http://displet.com/
 * License: GPL2
 */

class DispletRetsIdxPlugin {
	protected static $_api_url = 'http://api.displet.com';
	protected static $_capabilities = array(
		'save_property' => 'displet_save_properties',
		'save_search' => 'displet_save_searches',
		'view_leads' => 'displet_view_leads',
	 );
	protected static $_dir;
	public static $file = __FILE__;
	protected static $_field_options;
	protected static $_meta_keys = array(
		'agent' => array(
			'address' => 'displetretsidx_agent_address',
			'api_id' => 'displetretsidx_api_agent_id',
			'email_signature' => 'displet_email_signature',
			'facebook_url' => 'displetretsidx_agent_facebook_url',
			'headshot_url' => 'displetretsidx_agent_headshot_url',
			'instagram_url' => 'displetretsidx_agent_instagram_url',
			'linkedin_url' => 'displetretsidx_agent_linkedin_url',
			'phone' => 'displetretsidx_agent_phone',
		),
		'api_user_id' => 'displet_api_user_id',
		'lead' => array(
			'assigned_agent_id' => 'displet_agent_id',
			'phone' => 'displet_phone',
			'saved_searches' => 'displet_saved_searches',
		),
		'mean_baths' => 'displet_mean_baths',
		'mean_beds' => 'displet_mean_beds',
		'mean_price' => 'displet_mean_price',
		'mean_square_feet' => 'displet_mean_square_feet',
		'saved_properties' => 'displet_saved_properties',
		'zip_mode' => 'displet_zip_mode',
	);
	protected static $_options;
	protected static $_quick_start_options;
	protected static $_roles = array(
		'lead' => 'displet_user',
		'agent' => 'displet_agent',
	);
	protected static $_search_form_options;
	protected static $_slug = 'displetreader-wordpress-plugin';
	protected static $_slugs = array(
		'lead_manager_page' => 'displet-lead-manager',
		'options' => array(
			'action' => 'displet_rets_idx_action_options',
			'fields' => 'displet_rets_idx_field_options',
			'notify' => 'displet_rets_idx_version',
			'quick_start' => 'displet_rets_idx_quick_start',
			'search_forms' => 'displet_rets_idx_search_forms',
			'settings' => 'displet_rets_idx_options',
			'version' => 'displet_rets_idx_plugin',
		),
		'property_showcase_cpt' => 'displet_prop_shwcase',
		'quick_start_page' => 'displet-re-search-quick-start',
		'saved_properties_page' => 'displetretsidx_saved_properties',
		'saved_searches_page' => 'displetretsidx_saved_searches',
		'search_forms_page' => 'displetretsidx_search_forms',
		'settings_page' => 'displet-re-search-settings',
		'shortcode' => 'DispletListing',
	);
	protected static $_url;
	protected static $_urls;
	protected static $_version = '2.1.19';

	public static function build() {
		self::set_directory();
		self::set_url();
		self::set_urls();
	}

	private static function set_directory() {
		self::$_dir = dirname( __FILE__ );
	}

	private static function set_url() {
		self::$_url = plugins_url( self::$_slug );
	}

	private static function set_urls() {
		self::$_urls = array(
			'css' => self::$_url . '/includes/css',
			'includes' => self::$_url . '/includes',
			'js' => self::$_url . '/includes/js',
		 );
	}
}

require_once( 'displet-requires.php' );
require_once( 'displet-admin-requires.php' );

?>