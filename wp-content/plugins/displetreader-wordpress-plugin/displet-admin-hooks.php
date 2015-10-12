<?php if ( is_admin() ) {

// After Setup Theme
add_action( 'after_setup_theme', array( 'DispletRetsIdxQuickStartController', 'build' ) );

// Admin Menu
add_action( 'admin_menu', array( 'DispletRetsIdxAdminPagesController', 'maybe_clean_up_dashboard' ), 9999 );
add_action( 'admin_menu', array( 'DispletRetsIdxAdminPagesController', 'maybe_remove_jetpack_menu' ), 9999 );
add_action( 'admin_menu', array( 'DispletRetsIdxLeadManagerPageController', 'add_page' ) );
add_action( 'admin_menu', array( 'DispletRetsIdxQuickStartController', 'add_page' ) );
add_action( 'admin_menu', array( 'DispletRetsIdxSavedPropertiesPageController', 'add_page' ) );
add_action( 'admin_menu', array( 'DispletRetsIdxSavedSearchesPageController', 'add_page' ) );
add_action( 'admin_menu', array( 'DispletRetsIdxSearchFormsPageController', 'add_page' ) );
add_action( 'admin_menu', array( 'DispletRetsIdxSettingsController', 'add_page' ) );

// Admin Init
add_action( 'admin_init', array( 'DispletRetsIdxQuickStartController', 'maybe_create' ) );
add_action( 'admin_menu', array( 'DispletRetsIdxSearchFormsPageController', 'create' ) );

// Current Screen
add_action( 'current_screen', array( 'DispletRetsIdxAdminPagesController', 'build' ) );

// Admin Enqueue Scripts
add_action( 'admin_enqueue_scripts', array( 'DispletRetsIdxAdminPagesResourcesController', 'enqueue' ) );
add_action( 'admin_enqueue_scripts', array( 'DispletRetsIdxResourcesController', 'enqueue' ) );

// Admin Print Scripts
add_action( 'admin_print_scripts', array( 'DispletRetsIdxAdminPagesController', 'include_javascript_variables' ) );

// Admin Head
add_action( 'admin_head', array( 'DispletRetsIdxUpdatesController', 'maybe_notify' ) );

// Admin Notices
add_action( 'admin_notices', array( 'DispletRetsIdxUpdatesController', 'maybe_notify_of_deactivation' ) );

// Show User Profile
add_action( 'show_user_profile', array( 'DispletRetsIdxAgentsController', 'add_to_agent_page' ) );
add_action( 'show_user_profile', array( 'DispletRetsIdxLeadsController', 'add_to_user_page' ) );

// Edit User Profile
add_action( 'edit_user_profile', array( 'DispletRetsIdxAgentsController', 'add_to_agent_page' ) );
add_action( 'edit_user_profile', array( 'DispletRetsIdxLeadsController', 'add_to_user_page' ) );

// Edit User Profile Update
add_action( 'edit_user_profile_update', array( 'DispletRetsIdxAgentsController', 'save_from_agent_page' ) );
add_action( 'edit_user_profile_update', array( 'DispletRetsIdxLeadsController', 'save_from_user_page' ) );

// Personal Options Update
add_action( 'personal_options_update', array( 'DispletRetsIdxAgentsController', 'save_from_agent_page' ) );
add_action( 'personal_options_update', array( 'DispletRetsIdxLeadsController', 'save_from_user_page' ) );

// Profile Update
add_action( 'profile_update', array( 'DispletRetsIdxAgentsController', 'update_agent_at_api' ) );

// Delete User
add_action( 'delete_user', array( 'DispletRetsIdxAgentsController', 'delete_agent_from_api' ) );

// User Register
add_action( 'user_register', array( 'DispletRetsIdxAgentsController', 'send_new_agent_to_api_on_user_creation' ) );

// Save Post
add_filter( 'save_post', array( 'DispletRetsIdxRewriteController', 'maybe_reset_flush_rewrite' ) );

// MCE External Plugins
add_filter( 'mce_external_plugins', array( 'DispletRetsIdxTinyMCEController', 'external_plugins_callback' ) );

// MCE Buttons
add_filter( 'mce_buttons', array( 'DispletRetsIdxTinyMCEController', 'buttons_callback' ) );

} ?>