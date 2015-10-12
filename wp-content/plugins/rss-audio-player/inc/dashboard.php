<?php
global $wpdb;

$table_count = $wpdb->prefix . "rssplayer_setting";
$sql_count   = "SELECT * FROM $table_count";
$result      = $wpdb->get_results($sql_count);
$number      = count($result);
$table_feed  = $wpdb->prefix . "rssplayer_feed";
$sql_feed    = "SELECT dtModified FROM $table_count order by dtModified DESC";
$result_feed = $wpdb->get_results($sql_feed);
$time        = $result_feed[0]->dtModified;

?>
<div id="wpbody-content" aria-label="Main content" tabindex="0">
	<h1>RSS Audio Player Dashboard</h1>
	<h2><b>Product Level:</b> Pro | <b>Version Installed:</b> 1.0 </h2>
	<h2><b>Number of Feeds:</b> <?php echo $number; ?></h2>
	<h2><b>Last Feed Update:</b> <?php echo $time; ?></h2>
</div>

