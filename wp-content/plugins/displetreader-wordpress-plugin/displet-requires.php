<?php

/************
Includes extend nothing
************/

require_once('includes/class-displet-rets-idx-search-results.php');
require_once('includes/class-displet-rets-idx-utilities.php');
require_once('includes/google-login/Google_Client.php');
require_once('includes/google-login/contrib/Google_Oauth2Service.php');
require_once('includes/library/displet-library.php');
require_once('includes/library/displet-advanced-statistics-template-library.php');
require_once('includes/library/displet-dynamic-template-library.php');
require_once('includes/library/displet-login-register-popup-template-library.php');
require_once('includes/library/displet-mobile-template-library.php');
require_once('includes/library/displet-price-navigation-template-library.php');
require_once('includes/library/displet-property-details-page-template-library.php');
require_once('includes/library/displet-property-details-popups-template-library.php');
require_once('includes/library/displet-property-type-navigation-template-library.php');
require_once('includes/library/displet-quick-search-template-library.php');
require_once('includes/library/displet-request-showing-popup-template-library.php');
require_once('includes/library/displet-save-search-popup-template-library.php');
require_once('includes/library/displet-save-search-registration-form-template-library.php');
require_once('includes/library/displet-save-search-registration-popup-template-library.php');
require_once('includes/library/displet-search-form-template-library.php');
require_once('includes/library/displet-sidescroller-widget-template-library.php');
require_once('includes/library/displet-statistics-template-library.php');
require_once('includes/library/displet-table-template-library.php');
require_once('includes/library/displet-template-library.php');

/************
Models extend DispletRetsIdxPlugin
************/

require_once('model/class-displet-rets-idx-options-model.php');
require_once('model/class-displet-rets-idx-residentials-model.php');
require_once('model/class-displet-rets-idx-rewrite-model.php');
require_once('model/class-displet-rets-idx-search-fields-model.php');
require_once('model/class-displet-rets-idx-settings-model.php');
require_once('model/class-displet-rets-idx-templates-model.php');
require_once('model/class-displet-rets-idx-tiny-mce-model.php');
require_once('model/class-displet-rets-idx-updates-model.php');

require_once('model/email/class-displet-rets-idx-email-model.php'); // Parent class, require before /model/email/class-*.php
require_once('model/email/class-displet-rets-idx-email-templates-model.php');

require_once('model/pages/class-displet-rets-idx-pages-model.php'); // Parent class, require before /model/pages/class-*.php
require_once('model/pages/class-displet-rets-idx-mobile-page-model.php');
require_once('model/pages/class-displet-rets-idx-partial-address-page-model.php');
require_once('model/pages/class-displet-rets-idx-popups-model.php');
require_once('model/pages/class-displet-rets-idx-property-details-page-model.php');
require_once('model/pages/class-displet-rets-idx-property-update-page-model.php');
require_once('model/pages/class-displet-rets-idx-search-results-page-model.php');

require_once('model/users/class-displet-rets-idx-agents-model.php');
require_once('model/users/class-displet-rets-idx-leads-model.php');
require_once('model/users/class-displet-rets-idx-lenders-model.php');
require_once('model/users/class-displet-rets-idx-users-model.php');

/************
Controllers extend models
************/

require_once('controller/class-displet-rets-idx-email-controller.php');
require_once('controller/class-displet-rets-idx-google-login-controller.php');
require_once('controller/class-displet-rets-idx-options-controller.php');
require_once('controller/class-displet-rets-idx-residentials-controller.php');
require_once('controller/class-displet-rets-idx-resources-controller.php');
require_once('controller/class-displet-rets-idx-rewrite-controller.php');
require_once('controller/class-displet-rets-idx-search-fields-controller.php');
require_once('controller/class-displet-rets-idx-templates-controller.php');
require_once('controller/class-displet-rets-idx-tiny-mce-controller.php');
require_once('controller/class-displet-rets-idx-updates-controller.php');

require_once('controller/api/class-displet-rets-idx-api-controller.php'); // Parent class, require before /controller/api/class-*.php
require_once('controller/api/class-displet-rets-idx-property-suggestions-api-controller.php');
require_once('controller/api/class-displet-rets-idx-users-api-controller.php');

require_once('controller/pages/class-displet-rets-idx-pages-controller.php'); // Parent class, require before /controller/pages/class-*.php
require_once('controller/pages/class-displet-rets-idx-pages-resources-controller.php');
require_once('controller/pages/class-displet-rets-idx-mobile-page-controller.php');
require_once('controller/pages/class-displet-rets-idx-partial-address-page-controller.php');
require_once('controller/pages/class-displet-rets-idx-property-details-page-controller.php');
require_once('controller/pages/class-displet-rets-idx-search-results-page-controller.php');
require_once('controller/pages/class-displet-rets-idx-toolbar-controller.php');

require_once('controller/settings/class-displet-rets-idx-settings-controller.php'); // Parent class, require before /controller/settings/class-*.php
require_once('controller/settings/class-displet-rets-idx-settings-updates-controller.php');

require_once('controller/shortcodes/class-displet-rets-idx-displet-listing-shortcode-controller.php');
require_once('controller/shortcodes/class-displet-rets-idx-displet-quick-search-shortcode-controller.php');
require_once('controller/shortcodes/class-displet-rets-idx-displet-save-search-registration-shortcode-controller.php');

require_once('controller/users/class-displet-rets-idx-agents-controller.php');
require_once('controller/users/class-displet-rets-idx-lenders-controller.php');
require_once('controller/users/class-displet-rets-idx-users-controller.php');
require_once('controller/users/class-displet-rets-idx-users-updates-controller.php');

require_once('controller/users/leads/class-displet-rets-idx-leads-controller.php'); // Parent class, require before /controller/users/leads/class-*.php
require_once('controller/users/leads/class-displet-rets-idx-property-inquiries-controller.php');
require_once('controller/users/leads/class-displet-rets-idx-saved-properties-controller.php');
require_once('controller/users/leads/class-displet-rets-idx-saved-searches-controller.php');
require_once('controller/users/leads/class-displet-rets-idx-viewed-searches-controller.php');
require_once('controller/users/leads/class-displet-rets-idx-viewed-properties-controller.php');

require_once('controller/widgets/class-displet-rets-idx-sidescroller-widget-controller.php');
require_once('controller/widgets/class-displet-rets-idx-quick-search-widgets-controller.php');

/************
Instances extend controllers
************/

require_once('instance/class-displet-rets-idx-email.php');
require_once('instance/class-displet-rets-idx-mobile-detect.php');
require_once('instance/class-displet-rets-idx-options.php');
require_once('instance/class-displet-rets-idx-residentials.php');
require_once('instance/class-displet-rets-idx-templates.php');

require_once('instance/api/class-displet-rets-idx-api.php'); // Parent class, require before /api/class-*.php
require_once('instance/api/class-displet-rets-idx-agents-api.php');
require_once('instance/api/class-displet-rets-idx-emails-api.php');
require_once('instance/api/class-displet-rets-idx-email-templates-api.php');
require_once('instance/api/class-displet-rets-idx-residentials-api.php');
require_once('instance/api/class-displet-rets-idx-viewed-searches-api.php');

require_once('instance/widgets/class-displet-rets-idx-sidescroller-widget.php');
require_once('instance/widgets/class-displet-rets-idx-quick-search-widgets.php');

/************
WP Hooks
************/

require_once('displet-admin-hooks.php');
require_once('displet-hooks.php');

/************
Third-party
************/

//require_once('includes/tripress/class-tripress-crm-rets-idx-lead-integration.php');
//require_once('includes/tripress/class-tripress-crm-rets-idx-api-rest-helper.php');
require_once('includes/opendoor/opendoor.php');

?>