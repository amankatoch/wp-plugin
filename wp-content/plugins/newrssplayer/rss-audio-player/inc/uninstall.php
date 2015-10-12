<?php 
/* Short and sweet */

//if(!defined(WP_UNINSTALL_PLUGIN) exit();
 
// delete options
/*delete_option('myplugin_option1');
delete_option('myplugin_option2');
 
// delete transients
delete_transient('myplugin_transient');
 */
// delete custom tables
global $wpdb;
$table_name = $wpdb->prefix . "rssplayer_feed";
$table_setting = $wpdb->prefix . "rssplayer_setting";
$wpdb->query("DROP TABLE IF EXISTS {$table_name}");
$wpdb->query("DROP TABLE IF EXISTS {$table_setting}");


?>