<?php
	ini_set('memory_limit', '-1');
	$id_edited = $_GET['id'];

	//Update button code...
	if (isset($_POST['update_rss']))
	{
		global $wpdb;
		$table_setting = $wpdb->prefix . "rssplayer_setting";
		$res           = $wpdb->query("UPDATE $table_setting SET title='$title_updated', url='$url_updated', no_of_post='$number_updated', hide_description='$hide_description', dtModified=now() WHERE id=$id_edited");
		
		if($res)
		{
			?>
			<div id="message" class="updated below-h2">
				<p>Feed Updated</p>
			</div>
			<?php
		}
	}

	global $wpdb;
	$table_setting = $wpdb->prefix . "rssplayer_setting";
	$sql_edit      = "SELECT title, url, no_of_post, hide_description FROM $table_setting WHERE id = $id_edited LIMIT 0, 1";
	$result        = $wpdb->get_results($sql_edit) or die(mysql_error());
	$res           = $result[0];
?>

<div class="wrap">
	<h1 align="left">Edit RSS Feed</h1>
	<form action="" method="post">
		<table width="400px" border="0px" align="left" class="tableaddnew">
			<tr>
				<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #222222;padding-left: 5px;">Enter Feed Title</td>
				<td><input type="text" id="new_title" placeholder="Enter Title" name="new_title1" value="<?php echo $res->title; ?>" ></td>
			</tr>
			<tr>
				<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #222222;padding-left: 5px;">Enter New RSS Url</td>
				<td><input type="text" id="new_url" placeholder="Paste New Rss URL" name="new_url1" value="<?php echo $res->url; ?>"></td>
			</tr>
			<tr>
				<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #222222;padding-left: 5px;">Enter No. Of Feed Items To Show</td>
				<td><input type="number" min="1" max="100" placeholder="Enter Any Number" name="rss_num1" id="rss_num" style="width: 188px;" value="<?php echo $res->no_of_post; ?>"></td>
			</tr>
			<tr>
				<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #222222;padding-left: 5px;">Hide Description</td>
				<td><input type="checkbox" name="hide_description" value="<?php echo $res->hide_description; ?>" id="hide_description" onclick="this.value = this.checked * 1" <?php echo $res->hide_description == '1' ? 'CHECKED' : null; ?>></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="button" value="Update" name="update" onclick="update_rss('<?php echo plugin_dir_url( __FILE__ ); ?>','<?php echo $id_edited; ?>')" style="background-color: #0074A2;color: #F1F1F1;width: 160px;font-size: 14px;font-weight: 400;line-height: 18px;height: 27px;border-color: transparent;"></td>
			</tr>
		</table>
	</form>
	<div id="rssOutput"></div>
</div>