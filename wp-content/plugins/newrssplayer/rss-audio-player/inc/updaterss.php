<?php
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../../../wp-blog-header.php');
header('HTTP/1.1 200 OK');
$msg = "";

//get the q parameter from URL
$newTitle = $_REQUEST['title'];
$url	  = $_REQUEST['url'];
$id       = $_REQUEST['id'];
$hide     = $_REQUEST['hide_description'];

if (@simplexml_load_file($url))
{
	$xml = simplexml_load_file($url);
	$y   = array();

	foreach($xml->channel->item as $news)
	{
		$d['description'] = (string)$news->description;
		$d['title']       = (string)$news->title;
		$d['link']        = (string)$news->link;
		$d['media']       = (string)$news->enclosure['url'];   
		$d['pubDate']     = (string)$news->pubDate;
		$y[] = $d;
	}

	$count1 = count($y);
	$numb   = $_REQUEST['num'];
	$count1 = (int)$count1;
	$numb   = (int)$numb;
	
	if ($count1 > $numb)
		$check = $numb;
	else
		$check = $count1;

	global $wpdb;
	$table_setting = $wpdb->prefix . "rssplayer_setting";
	$table_feed    = $wpdb->prefix . "rssplayer_feed";
	$qry="UPDATE $table_setting SET title='$newTitle', url='$url', no_of_post='$numb', hide_description='$hide', dtModified=NOW() WHERE id='$id'";
	$wpdb->query($qry);
	$del = $wpdb->query("DELETE FROM $table_feed WHERE feed_id='$id'");
	
	for ($i = 0; $i < $check; $i++)
	{
		$xmltitle = str_replace("'", " ", $y[$i]['title']);
		$xmldate  = $y[$i]['pubDate'];
		$xmllink  = $y[$i]['link'];

		$xmldescription = trim(html_entity_decode( str_replace("'", " ", $y[$i]['description']), ENT_QUOTES, 'UTF-8'));
		$xmlmedia       = $y[$i]['media'];
		$table_feed     = $wpdb->prefix . "rssplayer_feed";
		$msg            = $wpdb->query("INSERT INTO $table_feed (feed_id,feed_xml_title,feed_xml_date,feed_xml_link,feed_xml_description,feed_xml_media,dtModified) VALUES('$id','$xmltitle','$xmldate','$xmllink','$xmldescription','$xmlmedia',NOW())");
	}
	
// Reset auto generated id...
//$wpdb->query("ALTER TABLE $table_feed DROP `id`");
//$wpdb->query("ALTER TABLE $table_feed AUTO_INCREMENT = 1");
//$wpdb->query("ALTER TABLE $table_feed ADD `id` mediumint(9)	NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
}
else
	$status = array("status" => "error", "msg" => "Its not a valid XML URL");

if ($msg)
	$status = array("status" => "success", "msg" => "Updated Successfully");
else
	$status = array("status" => "error", "msg" => "Feeds not updated!");

echo str_replace("\/", "/", json_encode($status));
?>
