<?php

// Plugin Activation
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxAgentsModel', 'add_custom_user_role_for_agents' ) );
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxLeadsModel', 'add_custom_user_role_for_leads' ) );
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxLendersModel', 'add_custom_user_role_for_lenders' ) );
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxUpdatesController', 'maybe_deactivate' ) );
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxSearchFormsPageController', 'register_default_search_forms' ) );
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxSettingsController', 'register_default_settings' ) );
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxRewriteController', 'reset_flush_rewrite_rules' ) );
register_activation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxEmailController', 'adjust_activity_report_schedule' ) );

// After Setup Theme
add_action( 'after_setup_theme', array( 'DispletRetsIdxOptionsController', 'set_options' ) );
add_action( 'after_setup_theme', array( 'DispletRetsIdxPlugin', 'build' ) );

// Init
add_action( 'init', array( 'DispletRetsIdxMobilePageController', 'register_post_types' ) );
add_action( 'init', array( 'DispletRetsIdxMobilePageController', 'register_menu' ) );
add_action( 'init', array( 'DispletRetsIdxMobilePageController', 'register_sidebars' ) );
add_action( 'init', array( 'DispletRetsIdxSettingsController', 'globalize' ) );
add_action( 'init', array( 'DispletRetsIdxRewriteModel', 'generate_rewrite_rules' ) );
add_action( 'init', array( 'DispletRetsIdxUpdatesController', 'maybe_update' ) );
add_action( 'init', array( 'DispletRetsIdxPagesResourcesController', 'set_referral_cookie' ) );

// Widgets Init
add_action( 'widgets_init', array( 'DispletRetsIdxQuickSearchWidgetsController', 'register_widgets' ) );
add_action( 'widgets_init', array( 'DispletRetsIdxSidescrollerWidgetController', 'register_widget') );

// Login Init
add_action( 'login_init', array( 'DispletRetsIdxGoogleLoginController', 'login_register_user' ) );

// WP Loaded
add_action( 'wp_loaded', array( 'DispletRetsIdxRewriteController', 'check_flush_rewrite_rules' ) );

// WP
add_action( 'wp', array( 'DispletRetsIdxPagesController', 'build' ) );

// Template Redirect
add_action( 'template_redirect', array( 'DispletRetsIdxPagesController', 'maybe_add_rel_prev_and_next' ) );
add_action( 'template_redirect', array( 'DispletRetsIdxPagesController', 'maybe_adjust_for_genesis' ) );
add_action( 'template_redirect', array( 'DispletRetsIdxPagesController', 'maybe_replace_canonical' ) );
add_action( 'template_redirect', array( 'DispletRetsIdxPagesController', 'redirect_to_parent' ), 1 );
add_action( 'template_redirect', array( 'DispletRetsIdxPagesModel', 'globalize' ) );

// WP Print Scripts
//add_action( 'wp_print_scripts', array( 'DispletRetsIdxPagesController', 'include_javascript_variables' ) );

// WP Enqueue Scripts
add_action( 'wp_enqueue_scripts', array( 'DispletRetsIdxPagesResourcesController', 'enqueue' ) );
add_action( 'wp_enqueue_scripts', array( 'DispletRetsIdxResourcesController', 'enqueue' ) );

// WP Head
add_action( 'wp_head', array( 'DispletRetsIdxPagesController', 'include_ie_check' ), 9999 );
add_action( 'wp_head', array( 'DispletRetsIdxPagesController', 'include_version' ), 9999 );
add_action( 'wp_head', array( 'DispletRetsIdxPagesController', 'include_not_ie_styles' ) );
add_action( 'wp_head', array( 'DispletRetsIdxPagesController', 'maybe_noindex_nofollow' ) );

// Admin Bar Menu
add_action( 'admin_bar_menu', array( 'DispletRetsIdxToolbarController', 'maybe_add_search_properties' ), 999 );
add_action( 'admin_bar_menu', array( 'DispletRetsIdxToolbarController', 'maybe_add_saved_properties' ), 999 );
add_action( 'admin_bar_menu', array( 'DispletRetsIdxToolbarController', 'maybe_add_saved_searches' ), 999 );
add_action( 'admin_bar_menu', array( 'DispletRetsIdxToolbarController', 'maybe_clean_up' ), 9999 );

// WP AJAX
add_action( 'wp_ajax_displet_email_friend_request', array( 'DispletRetsIdxEmailController', 'send_email_to_friend_request' ) );
add_action( 'wp_ajax_nopriv_displet_email_friend_request', array( 'DispletRetsIdxEmailController', 'send_email_to_friend_request' ) );
add_action( 'wp_ajax_displet_property_showing_request', array( 'DispletRetsIdxPropertyInquiriesController', 'send_property_showing_request' ) );
add_action( 'wp_ajax_nopriv_displet_property_showing_request', array( 'DispletRetsIdxPropertyInquiriesController', 'send_property_showing_request' ) );

// WP Login
add_action( 'wp_login', array( 'DispletRetsIdxLeadsController', 'update_last_login' ), 10, 2 );

// WP Schedule
add_action( 'displetactivityreport', array( 'DispletRetsIdxEmailController', 'send_activity_report' ) );
add_action( 'displetretsidx_import_single_user_cron_job', array( 'DispletRetsIdxLeadsController', 'import_single_user_cron_job' ), 10, 2 );
add_action( 'displetretsidx_import_users_cron_job', array( 'DispletRetsIdxLeadsController', 'import_users_cron_job' ), 10, 2 );
add_action( 'displetretsidx_new_user_cron_jobs', array( 'DispletRetsIdxLeadsController', 'new_user_cron_jobs' ) );
add_action( 'displetretsidx_register_non_api_users_with_api_cron', array( 'DispletRetsIdxUsersUpdatesController', 'register_non_api_users_with_api_cron' ) );
add_action( 'displetretsidx_register_non_api_users_with_api_cron_per_property', array( 'DispletRetsIdxUsersUpdatesController', 'register_non_api_users_with_api_cron_per_property' ), 10, 2 );
add_action( 'displetretsidx_register_non_api_users_with_api_cron_per_property_at_api', array( 'DispletRetsIdxUsersApiController', 'update_user_property_views' ), 10, 2 );
add_action( 'displetretsidx_register_non_api_users_with_api_cron_per_user', array( 'DispletRetsIdxUsersUpdatesController', 'register_non_api_users_with_api_cron_per_user' ) );
add_action( 'displetretsidx_save_new_meta_values_for_user_searches_per_user', array( 'DispletRetsIdxUsersUpdatesController', 'save_new_meta_values_for_user_searches_per_user' ) );
add_action( 'displetretsidx_send_saved_properties_to_api_per_user', array( 'DispletRetsIdxUsersUpdatesController', 'send_saved_properties_to_api_per_user' ) );
add_action( 'displetretsidx_add_property_filter_to_saved_searches_per_user', array( 'DispletRetsIdxUsersUpdatesController', 'add_property_filter_to_saved_searches_per_user' ) );
add_action( 'displetretsidx_send_assigned_agent_ids_to_api', array( 'DispletRetsIdxUsersUpdatesController', 'send_assigned_agent_ids_to_api' ) );
add_action( 'displetretsidx_send_unregistered_address_notification', array( 'DispletRetsIdxEmailController', 'send_unregistered_address_notification' ) );
add_action( 'displetretsidx_update_active_plugins', array( 'DispletRetsIdxUpdatesController', 'update_active_plugins' ) );
add_action( 'displetretsidx_update_assigned_agent_id_at_api', array( 'DispletRetsIdxLeadsController', 'update_assigned_agent_id_at_api' ), 10, 2 );

// Add Shortcode
add_shortcode( 'DispletListing', array( 'DispletRetsIdxDispletListingShortcodeController', 'render_shortcode' ) );
add_shortcode( 'DispletQuickSearch', array('DispletRetsIdxDispletQuickSearchShortcodeController', 'render_shortcode' ) );
add_shortcode( 'DispletSaveSearchRegistration', array('DispletRetsIdxDispletSaveSearchRegistrationShortcodeController', 'render_shortcode' ) );
add_shortcode( 'DispletStats', array( 'DispletRetsIdxDispletListingShortcodeController', 'render_shortcode_stats' ) );

// User Has Cap
add_filter( 'user_has_cap', array( 'DispletRetsIdxUsersModel', 'give_admins_custom_capabilities' ), 10, 3 );

// Post Link
add_filter( 'page_link', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_partial_address_breadcrumb_urls' ), 10, 2 );

// Third-Party Plugin Hooks
add_filter( 'wpseo_canonical', array( 'DispletRetsIdxPagesController', 'maybe_replace_yoasts_canonical' ) );
add_filter( 'wp_seo_get_bc_title', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_breadcrumbs_title' ) );
add_filter( 'wp_seo_get_bc_ancestors', array( 'DispletRetsIdxPropertyDetailsPageController', 'replace_breadcrumbs_ancestors' ) );

add_action( 'wp_ajax_displet_user_registration_request', array( 'DispletRetsIdxLeadsController', 'submit_registration_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_user_registration_request', array( 'DispletRetsIdxLeadsController', 'submit_registration_ajax' ) );
add_action( 'wp_ajax_displetretsidx_user_signon', array( 'DispletRetsIdxUsersController', 'login_user_ajax' ) );
add_action( 'wp_ajax_nopriv_displetretsidx_user_signon', array( 'DispletRetsIdxUsersController', 'login_user_ajax' ) );
add_action( 'wp_ajax_displet_user_check_request', array( 'DispletRetsIdxUsersController', 'login_existing_facebook_user_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_user_check_request', array( 'DispletRetsIdxUsersController', 'login_existing_facebook_user_ajax' ) );
add_action( 'wp_ajax_displet_check_login_request', array( 'DispletRetsIdxUsersController', 'check_login_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_check_login_request', array( 'DispletRetsIdxUsersController', 'check_login_ajax' ) );
add_action( 'wp_ajax_displet_delete_users_request', array( 'DispletRetsIdxLeadsController', 'delete_users' ) );
add_action( 'wp_ajax_displet_reassign_users_request', array( 'DispletRetsIdxLeadManagerPageController', 'reassign_users' ) );
add_action( 'wp_ajax_displet_update_searches', array( 'DispletRetsIdxViewedSearchesController', 'update_viewed_searches' ) );
add_action( 'wp_ajax_nopriv_displet_update_searches', array( 'DispletRetsIdxViewedSearchesController', 'update_viewed_searches' ) );
add_action( 'wp_ajax_displet_save_property_request', array( 'DispletRetsIdxSavedPropertiesController', 'save_property' ) );
add_action( 'wp_ajax_nopriv_displet_save_property_request', array( 'DispletRetsIdxSavedPropertiesController', 'save_property' ) );
add_action( 'wp_ajax_displet_delete_properties_request', array( 'DispletRetsIdxSavedPropertiesController', 'delete_saved_properties' ) );
add_action( 'wp_ajax_nopriv_displet_delete_properties_request', array( 'DispletRetsIdxSavedPropertiesController', 'delete_saved_properties' ) );
add_action( 'wp_ajax_displet_save_search_request', array( 'DispletRetsIdxSavedSearchesController', 'save_search_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_save_search_request', array( 'DispletRetsIdxSavedSearchesController', 'save_search_ajax' ) );
add_action( 'wp_ajax_displet_save_search_registration_request', array( 'DispletRetsIdxSavedSearchesController', 'save_search_registration_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_save_search_registration_request', array( 'DispletRetsIdxSavedSearchesController', 'save_search_registration_ajax' ) );
add_action( 'wp_ajax_displet_delete_searches_request', array( 'DispletRetsIdxSavedSearchesController', 'delete_saved_searches' ) );
add_action( 'wp_ajax_nopriv_displet_delete_searches_request', array( 'DispletRetsIdxSavedSearchesController', 'delete_saved_searches' ) );
add_action( 'wp_ajax_displet_get_clients_request', array( 'DispletRetsIdxAgentsController', 'get_clients_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_get_clients_request', array( 'DispletRetsIdxAgentsController', 'get_clients_ajax' ) );
add_action( 'wp_ajax_displet_set_cookie_request', array( 'DispletRetsIdxSettingsController', 'set_cookie' ) );
add_action( 'wp_ajax_nopriv_displet_set_cookie_request', array( 'DispletRetsIdxSettingsController', 'set_cookie' ) );
add_action( 'wp_ajax_displet_get_cookies_request', array( 'DispletRetsIdxSettingsController', 'get_cookies' ) );
add_action( 'wp_ajax_nopriv_displet_get_cookies_request', array( 'DispletRetsIdxSettingsController', 'get_cookies' ) );
add_action( 'wp_ajax_displet_update_notify_version_request', array( 'DispletRetsIdxSettingsController', 'update_notify_version_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_update_notify_version_request', array( 'DispletRetsIdxSettingsController', 'update_notify_version_ajax' ) );
add_action( 'wp_ajax_displet_get_agent_id_request', array( 'DispletRetsIdxTinyMCEController', 'get_agent_id_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_get_agent_id_request', array( 'DispletRetsIdxTinyMCEController', 'get_agent_id_ajax' ) );
add_action( 'wp_ajax_displet_get_office_id_request', array( 'DispletRetsIdxTinyMCEController', 'get_office_id_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_get_office_id_request', array( 'DispletRetsIdxTinyMCEController', 'get_office_id_ajax' ) );
add_action( 'wp_ajax_displet_get_property_showcase_listings_request', array( 'DispletRetsIdxResidentialsController', 'get_property_showcase_listings_ajax' ) );
add_action( 'wp_ajax_nopriv_displet_get_property_showcase_listings_request', array( 'DispletRetsIdxResidentialsController', 'get_property_showcase_listings_ajax' ) );

// Plugin Deactivation
register_deactivation_hook( DispletRetsIdxPlugin::$file, array( 'DispletRetsIdxEmailController', 'unschedule_activity_report' ) );

?>