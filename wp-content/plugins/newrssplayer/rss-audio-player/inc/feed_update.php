<?php

define('WP_USE_THEMES', false);
require('../../../wp-blog-header.php');
header('HTTP/1.1 200 OK');
$status;
date_default_timezone_set('America/Los_Angeles');
$feedId = $_REQUEST['feed_check_id'];
global $wpdb;
$table_setting = $wpdb->prefix . "rssplayer_setting";
$table_feed = $wpdb->prefix . "rssplayer_feed";

$sql="SELECT id,url,title,no_of_post FROM $table_setting where id='$feedId'";
$result = $wpdb->get_results($sql) or die(mysql_error());
foreach ($result as $value) {
	$id_main = $value->id;
	$url_main = $value->url;
	$title_main = $value->title;
	$number_of_posts= $value->no_of_post;	
	$sql1="SELECT feed_xml_date FROM $table_feed WHERE feed_id = '$id_main' ORDER BY id ASC";
	$result1 = $wpdb->get_results($sql1) or die(mysql_error());
	$date_main = $result1[0]->feed_xml_date;

    if(@simplexml_load_file($url_main)){
        $xml=simplexml_load_file($url_main);
        
        $y=array();
        
        foreach($xml->channel->item as $news){
        
            $d['description'] =(string)$news->description;
            $d['title'] =(string)$news->title;
            $d['link'] = (string)$news->link;
            $d['media'] = (string)$news->enclosure['url'];   
            $d['pubDate'] = (string)$news->pubDate;
            $y[] = $d;
        }
        
        $originalDate = $y[0]['pubDate'];
        //echo $originalDate, ": ", $date_main, "\r\n";
        //echo date('Y-m-d H:i:s', strtotime($originalDate)), ": ", date('Y-m-d H:i:s', strtotime($date_main)), "\r\n";
        
        if(strtotime($originalDate) == strtotime($date_main)){
        	$status=array("status"=>"No","msg"=>"Still No Updations...");
        }
        else
        {
        	$status=array("status"=>"Yes","id"=>$id_main,"title"=>$title_main,"url"=>$url_main,"no_of_post"=>$number_of_posts);
        
        }
    
    }
    else
    {
    	$status=array("status"=>"No","msg"=>"Not a valid XML");
    }
    echo str_replace("\/", "/", json_encode($status));
}

?>
