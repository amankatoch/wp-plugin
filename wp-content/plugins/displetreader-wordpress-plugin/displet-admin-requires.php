<?php if ( is_admin() ) {

/************
Models extend DispletRetsIdxPlugin
************/

require_once('model/class-displet-rets-idx-quick-start-model.php');

require_once('model/admin-pages/class-displet-rets-idx-admin-pages-model.php'); // Parent class, require before /model/admin-pages/class-*.php
require_once('model/admin-pages/class-displet-rets-idx-lead-manager-page-model.php');
require_once('model/admin-pages/class-displet-rets-idx-saved-properties-page-model.php');
require_once('model/admin-pages/class-displet-rets-idx-saved-searches-page-model.php');
require_once('model/admin-pages/class-displet-rets-idx-search-forms-page-model.php');

/************
Controllers extend models
************/

require_once('controller/class-displet-rets-idx-quick-start-controller.php');

require_once('controller/admin-pages/class-displet-rets-idx-admin-pages-controller.php'); // Parent class, require before /controller/admin-pages/class-*.php
require_once('controller/admin-pages/class-displet-rets-idx-admin-pages-resources-controller.php');
require_once('controller/admin-pages/class-displet-rets-idx-lead-manager-page-controller.php');
require_once('controller/admin-pages/class-displet-rets-idx-saved-properties-page-controller.php');
require_once('controller/admin-pages/class-displet-rets-idx-saved-searches-page-controller.php');
require_once('controller/admin-pages/class-displet-rets-idx-search-forms-page-controller.php');

} ?>