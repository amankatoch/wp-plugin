<?php
define('WP_USE_THEMES', false);
require('../../../wp-blog-header.php');
header('HTTP/1.1 200 OK');
$idfeed = trim($_REQUEST['xml_link']);
global $wpdb;
// print_r($_POST);
$tbl_name   = $wpdb->prefix.'rssplayer_feed';
//$resultfeed = $wpdb->get_results( "SELECT feed_xml_link FROM $tbl_name where id='$idfeed'");
$link       = "http://christianpodcastnetwork.com/joel-osteen/";
$fromname   = trim($_POST['fromName']);
$fromemail  = filter_var(trim($_POST['fromEmail']), FILTER_SANITIZE_EMAIL);
$toname     = trim($_POST['toName']);
$toemail    = filter_var(trim($_POST['toEmail']), FILTER_SANITIZE_EMAIL);
$subject    = trim($_POST['subject']);
//$comments   = "<html><head></head><body>".trim($_REQUEST['comments'])."<br>You have received a RSS feed: <a href='".$resultfeed[0]->feed_xml_link."'>Click On This Link</a></body></html>";
$comments   = "<html><head></head><body>".trim($_REQUEST['comments'])."<br>You have received a RSS feed: <a href='". $link ."'>Click On This Link</a></body></html>";
// echo $fromname." ~ ".$toemail;

if( filter_var( $fromemail, FILTER_VALIDATE_EMAIL ) && filter_var( $toemail, FILTER_VALIDATE_EMAIL ) ) {
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: ' . get_bloginfo( 'name', 'display' ) . ' <' . $fromemail . '>' . "\r\n";

$res = mail ($toemail, $subject, $comments, $headers);

if ($res)
	echo 'Email Sent';
else
	echo 'Sending failure, Please Try Again';
}
else {

    echo 'You didn\'t provide a valid email.';
}

?>