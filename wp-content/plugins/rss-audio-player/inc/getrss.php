<?php

date_default_timezone_set('America/Los_Angeles');
ini_set('memory_limit','-1');
define('WP_USE_THEMES', false);
require('../../../../wp-blog-header.php');
header('HTTP/1.1 200 OK');
		//get the q parameter from URL
		$newTitle=$_REQUEST['title'];
		$url=$_REQUEST['url'];

//check if it is valid xml
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
	
	$originalDate = $y[$i]['pubDate'];
	$newDate      = date("d-m-Y", strtotime($originalDate));

	$count1 = count($y);
	$numb   = $_REQUEST['num'];
	$hide   = $_REQUEST['hide_description'];

	if ($count1 > $numb)
		$check = $numb;
	else
		$check = $count1;

	global $wpdb;
	$table_setting = $wpdb->prefix . "rssplayer_setting";
	$msg1 = $wpdb->query("INSERT INTO $table_setting (title,url,no_of_post,dtCreated,hide_description) VALUES('$newTitle','$url','$numb',now(),$hide)");
	$id_geted = $wpdb->insert_id;
	
	for($i = 0; $i < $check; $i++)
	{
		$xmltitle = str_replace("'"," ",$y[$i]['title']);
		$xmldate  = $y[$i]['pubDate'];
		$xmllink  = $y[$i]['link'];
		$xmldesc  = trim(html_entity_decode( str_replace("'"," ",$y[$i]['description']), ENT_QUOTES, 'UTF-8'));
		$xmlmedia = $y[$i]['media'];
		global $wpdb;
		$table_feed = $wpdb->prefix . "rssplayer_feed";
		$wpdb->query("INSERT INTO $table_feed (feed_id,feed_xml_title,feed_xml_date,feed_xml_link,feed_xml_description,feed_xml_media,dtCreated) VALUES('$id_geted','$xmltitle','$xmldate','$xmllink','$xmldesc','$xmlmedia',now())");
	}
}
else
	$status = array("status"=>"error","msg"=>"Its not a valid XML URL.");
	
if ($msg1)
	$status = array("status"=>"success","msg"=>"Saved Successfully");
  
echo json_encode($status);
?>