<div class="wrap">
<?php

if (isset($_POST['applybutton'])) {
	if($_POST['action']=="trash"){
	global $wpdb;
	$tbl_name=$wpdb->prefix.'rssplayer_setting';
	$tbl_name1=$wpdb->prefix.'rssplayer_feed';
	$count1=count($_POST['post']);
	for ($i=0; $i < $count1; $i++) { 
		$id=$_POST['post'][$i];
		$wpdb->query( "DELETE FROM $tbl_name where id='$id'");
		$wpdb->query("DELETE FROM $tbl_name1 where feed_id='$id'");
	}
}
}
if (isset($_GET['action'])=="trashme") {
	global $wpdb;
	$tbl_name=$wpdb->prefix.'rssplayer_setting';
	$tbl_name1=$wpdb->prefix.'rssplayer_feed';
	$id=$_GET['id'];
		$wpdb->query( "DELETE FROM $tbl_name where id='$id'");
		$wpdb->query("DELETE FROM $tbl_name1 where feed_id='$id'");
}
?>
<h2>Rss-Feeds <a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=Add_new_rssplayer" class="add-new-h2">Add New</a></h2>
	<div class="tablenav top">
	<form method="post">
		<div class="alignleft actions bulkactions">
			<select name="action">
			<option value="-1">Bulk Actions</option>
			<option value="trash">Move to Trash</option>
			</select>
			<input type="submit" name="applybutton" id="doaction" class="button action" value="Apply">
		</div>
		<br class="clear">
		</div>		
		<table class="wp-list-table widefat fixed pages">
		
			<thead>
				<tr>
					<th scope="col" id="cb" class="manage-column column-cb check-column" style=""><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th>
					<th scope="col" id="title" class="manage-column column-title" style="">Title</th>
					<th scope="col" id="author"  class="manage-column column-author">Author</th>
					<th class="manage-column"># of RSS Items To Show</th>					
					<th scope="col" id="categories" class="manage-column column-categories" style="">Shortcode</th>
					<th scope="col" id="date" class="manage-column column-date sortable asc" style="">Date Added</th>
					<th scope="col" id="date" class="manage-column column-date sortable asc" style="">Last Updated</th>
					
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th scope="col" id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></th>					
					<th scope="col" id="title" class="manage-column column-title">Title</th>
					<th scope="col" id="author"  class="manage-column column-author">Author</th>					
					<th class="manage-column"># of RSS Items To Show</th>	
					<th scope="col" id="categories" class="manage-column column-categories">Shortcode</th>
					<th scope="col" id="date" class="manage-column column-date sortable asc">Date Added</th>
					<th scope="col" id="date" class="manage-column column-date sortable asc" style="">Last Updated</th>
				</tr>
			</tfoot>
			<tbody id="the-list">
			<?php
			//*** Fetch all the feeds from the database ***
			global $wpdb;
//*** wordpress custom select query ***
$table_setting = $wpdb->prefix . "rssplayer_setting";
$table_feed=$wpdb->prefix . "rssplayer_feed";
$sqlf="SELECT id,title,dtCreated,dtModified FROM $table_setting";
$result = $wpdb->get_results($sqlf) or die(mysql_error());
foreach( $result as $results ) {
	$id=$results->id;
	$sql_feed_count="select Count(*) from $table_feed where feed_id='$id'";
	$result_feed = $wpdb->get_var($sql_feed_count) or die(mysql_error());
	$number=$result_feed;
	?><tr><th scope="row" class="check-column">
	<label class="screen-reader-text" for="cb-select-7">Select Aqua</label>
	<input id="cb-select-7" type="checkbox" name="post[]" value="<?php echo $results->id; ?>">
	<div class="locked-indicator"></div>
	</th>
	<td class="post-title page-title column-title"><strong><a class="row-title" href="<?php echo site_url(); ?>/wp-admin/admin.php?page=edit_rssplayer&id=<?php echo $results->id; ?>" title="Edit “Demo”"><?php echo $results->title; ?></a></strong><div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div><div class="row-actions"><span class="edit"><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=edit_rssplayer&id=<?php echo $results->id; ?>" title="Edit this item">Edit</a></span> | 
		<span class="edit"><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=list_rssplayer&id=<?php echo $results->id; ?>&action=trashme" title="Move to Trash">Trash</a></span></div>
	</td>
	<td class="author column-author"><?php  $current_user = wp_get_current_user();  echo  $current_user->user_login; ?></td>
<td><strong><?php echo $number; ?> </strong></td>
	<td class="categories column-categories">[rssplayer id="<?php echo $results->id; ?>"]</td>
	<td lass="date column-date"><?php echo $results->dtCreated; ?></td>
	<td lass="date column-date"><?php echo $results->dtModified; ?></td>
</tr>
<?php
$number++;
}
?>				
			</tbody>			
		</table>			
	</form>
</div>