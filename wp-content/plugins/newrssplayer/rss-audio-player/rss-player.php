<?php
ob_start();
/*
Plugin Name: Esferasoft HTML5 RSS Audio Player
Plugin URI: http://www.esferasoft.com/rss-audio-player
Description: Provide the ability to automatically poll a Podcast RSS Feed and listen, download, and share (via Facebook, Twitter, Google+, Email) the podcast files from the feed. Display on posts/pages via shortcode.
Author: BriteWorx Digital
Version: 1.0
Author URI: http://www.esferasoft.com
*/


ini_set("memory_limit", "-1");
define('WP_USE_THEMES', false);
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

// Configure Css and JS files	  
function rssplayer_css_and_js()
{
	wp_register_style('rssplayer_css_and_js', plugins_url('css/style.css',__FILE__ ));
	wp_register_script('rssplayer_css_and_js', plugins_url('js/custom.js',__FILE__ ));
	wp_enqueue_style('rssplayer_css_and_js');
	wp_enqueue_script('rssplayer_css_and_js');
	wp_enqueue_media('rssplayer_css_and_js');
}


add_action( 'admin_init','rssplayer_css_and_js');
add_action('admin_menu', 'rssplayer_plugin_menu');


function rssplayer_plugin_menu()
{	
	add_menu_page( 'rssplayer', 'Esferasoft RSS Audio Player','manage_options', 'rssplayer','rssplayer_dashboard' ,plugin_dir_url( __FILE__ ) .'images/PodcastIcon16x16.png'); 
	add_submenu_page( 'rssplayer', 'Esferasoft Add RSS', 'Add New RSS Feed', 'manage_options', 'Add_new_rssplayer', 'add_new_rss'); 
	add_submenu_page( 'rssplayer', 'Esferasoft Add RSS', 'Feed List', 'manage_options', 'list_rssplayer', 'rssplayer_options');
	add_submenu_page( 'rssplayer', 'Esferasoft Settings', 'Settings', 'manage_options', 'setting_rss_player', 'setting'); 
	add_submenu_page( 'rssplayer', 'Esferasoft rssplayer', '', 'manage_options', 'edit_rssplayer', 'edit_rssplayer'); 
}

function edit_rssplayer()
{
	include('inc/edit_rss.php');
}

function rssplayer_dashboard()

{
  include('inc/dashboard.php');
}

function rssplayer_options()
{
	include('inc/display_rss.php');
}

function add_new_rss()
{
	include('inc/add_new_rssplayer.php');
}


function setting()
{
	include("inc/setting_rss_player.php");
}


$page_link = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
global $BriteWorx_db_version;
$BriteWorx_db_version = "1.0";

/* == After activation creating database.. === */

register_activation_hook( __FILE__, 'rssplayer_install' );

function rssplayer_install()
{
	require_once( ABSPATH . 'wp-load.php' );
	global $wpdb;
	global $rssplayer_db_version;

	$table_setting = $wpdb->prefix . "rssplayer_setting";
      
	$sql = "CREATE TABLE $table_setting (
		id mediumint(9) NOT NULL AUTO_INCREMENT,  
		title tinytext NOT NULL,
		url VARCHAR(300) DEFAULT '' NOT NULL,
		no_of_post VARCHAR(300) DEFAULT '' NOT NULL,
		hide_description tinyint(1) NOT NULL DEFAULT '0',
		dtCreated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		dtModified datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		UNIQUE KEY id (id)
    );";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	$table_feed = $wpdb->prefix . "rssplayer_feed";
	$sql_feed   = "CREATE TABLE $table_feed (
		id mediumint(9) NOT NULL AUTO_INCREMENT,  
		feed_id mediumint(9) NOT NULL,
		feed_xml_title VARCHAR(300) DEFAULT '' NOT NULL,
		feed_xml_date VARCHAR(300) DEFAULT '' NOT NULL,
		feed_xml_link VARCHAR(300) DEFAULT '' NOT NULL,
		feed_xml_description VARCHAR(300) DEFAULT '' NOT NULL,
		feed_xml_media VARCHAR(300) DEFAULT '' NOT NULL,
		dtCreated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		dtModified datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		UNIQUE KEY id (id)
	);";
	dbDelta( $sql_feed );
	add_option( "rssplayer_db_version", $rssplayer_db_version );

	$installed_ver = get_option( "rssplayer_db_version" );
	if( $installed_ver != $jal_db_version ) {
		$table_setting = $wpdb->prefix . "rssplayer_setting";
		$sql = "CREATE TABLE $table_setting (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,  
		  title tinytext NOT NULL,
		  url VARCHAR(300) DEFAULT '' NOT NULL,
		  no_of_post VARCHAR(300) DEFAULT '' NOT NULL,
		  dtCreated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  dtModified datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  UNIQUE KEY id (id)
		);";
	   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	   dbDelta( $sql );
	   update_option( "rssplayer_db_version", $rssplayer_db_version );
	} 

	
	add_option( "rssplayer_db_version", $rssplayer_db_version );
}


//pipin function to get thumb
function pippin_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}


//*** Generating Short Code ***

function rssplayer_shortcode ($atts, $content = null)

{
    extract( shortcode_atts(
        array(
            'id' => '1',
        ), $atts )
    ); 

	
	global $wpdb;
	$short         = "";
	$tbl_name      = $wpdb->prefix.'rssplayer_feed';
	$resultfeed    = $wpdb->get_results( "SELECT * FROM $tbl_name where feed_id='$id' ORDER BY id ASC");
	$tbl_setting   = $wpdb->prefix.'rssplayer_setting';
	$resultsetting = $wpdb->get_results( "SELECT * FROM $tbl_setting where id= '$id'");
	$short .= "<table border=0 cellpadding=0 cellspacing=0 class=rssplayer_table>";
	$short .= "<tbody>";
    
	$feedtitle = $resultsetting[0]->title;
	$feedurl   = $resultsetting[0]->url;
	$feedposts = $resultsetting[0]->no_of_post;

	$feedhide  = $resultsetting[0]->hide_description;

	$short .= "<tr>";
	$short .= "<td align=left valign=top><div class=sliderHeader>";
	if(get_post_meta( '1', 'rss_player_title_icon', true ))
	{

	 $image_url=get_post_meta( '1', 'rss_player_title_icon', true );
	 $image_id= pippin_get_image_id($image_url);
     $image_attributes= wp_get_attachment_image_src( $image_id, array(32,32),false );


 	 $short .="<h2> <img src='".$image_attributes[0]."' width='" . $image_attributes[1]."' height='" . $image_attributes[2]. "'>";
	

	}
	else
	{
	$short .="<h2> no image";
	}
	$short .= ucfirst($feedtitle);
	$short .= "</h2></div></td>
			</tr>";

			
	foreach ($resultfeed as $value)

	{
		$xmlid          = $value->id;
		$xmlfeedid      = $value->feed_id;
		$xmltitle       = $value->feed_xml_title;
		$xmldate        = $value->feed_xml_date;
		$xmllink        = $value->feed_xml_link;
		$xmldescription = $value->feed_xml_description;
		$xmlmedia       = $value->feed_xml_media;
		$originalDate   = $xmldate;

		$xmldesc1 = html_entity_decode($xmldescription);
		$xmldesc  = $xmldesc1;
		$xmldesc  = preg_replace("/<img[^>]+\>/i", "", $xmldesc); 

		$newDate = date("m-d-Y", strtotime($originalDate));
        
		$short.="<tr><td valign=top>";

		
		if ($xmlid % 2 == 0)
			$short .= "<div class='programText' style='background-color:#f1f4f7;border:1px solid #eee;padding:10px;'>";
		else
			
		$short .= "<div class=programText style='background-color:#fff;border:1px solid #eee;padding:10px;'>";
		$short .= "<div style='float:left;'>";
		$short .= "<a title='Right Click and Save As to download' href=".$xmlmedia." target='_blank'><img class=dwn src=".plugin_dir_url( __FILE__ )."images/download_icon_off.png border=0 style=padding-top:1px;>
				   </a></div>";
		$short .= "<div style='float:left;padding-left:5px;'><a title='Display Player' href=javascript:showPlayer('".$xmlid."');>";
		$short .= "<img class=play src=".plugin_dir_url( __FILE__ )."images/play.png border=0></a></div>";
		$short .= "<div class=podcast-left-main>";
		$short .= "<div class=podcast_title>".$xmltitle."</div></div>";
		$short .= "<div class=social-date>";
		$short .= "<div style=float:right;>";
		//$short .= "<a class='email_generate fancybox' title='Email to a Friend'  href='#emailif' data=".$xmlid."><img class='email' src=".plugin_dir_url( __FILE__ )."images/email.png border=0></a></div>";
		
		//$short .= "<div style=float:right;>";
		
		
		$short .='<a href="#" id="" onclick="return false" ><img class="email" src="'.plugin_dir_url( __FILE__ ).'images/email.png" border=0 onclick="ShowMessage_Form(\''.$xmlid.','.plugins_url('inc/email.php',__FILE__).','.get_the_permalink().'\')"></a>
        <div class="pop-up" id="pop1'.$xmlid.'">
        <!-- The pop-up block -->
        <div class="popBox">
          <!-- If the content becomes larger than the pop-up this div will scroll the content -->
          <div class="popScroll" style="height:300px;" id="viewJobb'.$xmlid.'">
          ';
          /*$short .="<form id='mail_form' name='mail_form' method='post' action='' style='padding:0px;margin:0px;position: relative; bottom: 5px'>
		<table border='0' allign='center' cellpadding='0' cellspacing='0' class='textBody'>
		<tbody>		
		<tr>
		<td align='right' style='padding-top:5px;'>Your Email:</td> 
		<td align='left' style='padding-top:5px;padding-left:5px;'>
		<input style='width:300px;margin:0px;' type='text' name='fromEmail' id='fromEmail".$xmlid."'>
		</td>
		</tr>		
		<tr>
		<td align='right' style='padding-top:5px;'>Recipient Email:</td> 
		<td align='left' style='padding-top:5px;padding-left:5px;''>
		<input style='width:300px;margin:0px;' type='text' name='toEmail' id='toEmail".$xmlid."'></td>
		</tr>
		<tr>
		<td align='right' style='padding-top:5px;'>Subject:</td> 
		<td align='left' style='padding-top:5px; padding-left: 5px;'>
		<input style='width:300px; margin: 0px;' type='text' name='subject' id='subject".$xmlid."' value='Check this out!'></td>
		</tr>
		<tr>
		<td align='right' valign='top' style='padding-top:5px;'>Comments:</td>
		<td align='left' style='padding-top:5px; padding-left: 5px;'>
		<textarea id='briteWrox_comment".$xmlid."' class='textBody' style='width:300px;height:50px;padding:0px;overflow:auto;' name='comments'></textarea></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td align='left' style='padding-top:5px;padding-left:5px;'>
		<input id='mail_link".$xmlid."' type='hidden' value='".$xmlid."' style='margin:0px;'>
		<input type='hidden' name='hide_email' value=".plugins_url('/email.php',__FILE__)." id='plugUrl".$xmlid."'/>
		<input class='mailSend' onclick='sendmail(".$xmlid.");' type='button' value='Send' style='margin:0px;'>
		</td>
		</tr>
		</tbody>
		</table>
		</form>";
		*/
		?>

		<?php
          $short .= '</div>
          <!-- The close pop-up link correctly positioned at the end of the content block -->
          <a class="close" href="#"><span>Back to links</span></a>
        </div>
        <!-- This link is the light box -->
        <a class="lightbox" href="#">Back to links</a>
      </div></div>';
      
      $iframe_data='<textarea class=popsj><iframe src='.plugin_dir_url( __FILE__ ).'iframe.php?id='.$xmlid.' width=100% height=696 frameborder=0> </iframe></textarea>';

$short .= "<div style=float:right;>";
		$short .="<a href='#' onclick='return false'><img class=share src='".plugin_dir_url( __FILE__ )."images/share.png' border=0 onclick='ShowMessage(\" ".$iframe_data." \")'></a>";
		/*
		$short .='<a href="#pop'.$xmlid.'" id="popUpA"><img class=share src="'.plugin_dir_url( __FILE__ ).'images/share.png" border=0></a>
        <div class="pop-up" id="pop'.$xmlid.'">
        <!-- The pop-up block -->
        <div class="popBox height_smal">
          <!-- If the content becomes larger than the pop-up this div will scroll the content -->
          <div class="popScroll" id="viewJob">
          <textarea style=" width:570px; height: 63px;"><iframe src="'.plugin_dir_url( __FILE__ )."iframe.php?id=".$xmlid.'" width="100%" height="696" frameborder="0"> </iframe></textarea>

          </div>
          <!-- The close pop-up link correctly positioned at the end of the content block -->
          <a class="close" href="#"><span>Back to links</span></a>
        </div>
        <!-- This link is the light box -->
        <a class="lightbox" href="#">Back to links</a>
      </div>';

	*/

		$short .= "</div>";
		
		$short .= "<div style=float:right;>";
		$short .= "<a class='prevent_showPop' title='Share on Google +' href=https://plus.google.com/share?url=".get_the_permalink()."><img class=google src=".plugin_dir_url( __FILE__ )."images/google.png border=0></a></div>";
		$short .= "<div style=float:right;>";
		$short .= "<a class='prevent_showPop' title='Share on Twitter' href=http://twitter.com/share?url=".get_the_permalink()."><img class=twitterr src=".plugin_dir_url( __FILE__ )."images/twitter.png border=0></a></div>";
		$short .= "<div style=float:right;>";
		$short .= "<a class='prevent_showPop' title='Share on Facebook' href=http://www.facebook.com/sharer.php?u=".get_the_permalink()."><img class=facebook src=".plugin_dir_url( __FILE__ )."images/fb.png border=0></a></div>";
		$short .= "<div class=podcast-date>".$newDate."&nbsp;</div>";
		$short .= "<div style=clear:both;></div></div>";
		$short .= "<div style=clear:both;></div>";

		
		if (!$feedhide)

		{
			$xmldesc = strip_tags($xmldesc);

			$short .= "<div class='desc".$xmlid." show-more'>";
			//$short .= $xmldesc ? substr($xmldesc,0,90) : $xmldesc; 
			$short .=substr($xmldesc,0,51);
			if (strlen($xmldesc) > 51)
			{ 
    		$short .="<a class='readmore' href=javascript:showMore('".$xmlid."');> Show more </a>";
    		$short.="<span class='description".$xmlid." more'>".substr($xmldesc,51)." <a href=javascript:showMore('".$xmlid."'); class='show_less'> Show Less <a></span>";
			}
			$short.="</div>"; 
			//$short .= "<a class='extraDesc' href=javascript:showMore('".$xmlid."');>Show More</a></div>";
			//$short .= "<div class='description".$xmlid." show-more' style=display:none;>".$xmldesc."<a href=javascript:showMore('".$xmlid."');> Show Less </a></div>";
		} 

		
		$short.="<div class=audioplayer".$xmlid." align=center style=display:none;>";
		$short.="<audio id=audioPlayer".$xmlid." src=".$xmlmedia." type=audio/mpeg  controls></audio></div></div></td></tr>";
	}

	
	$short.="</tbody></table>";
	//$short.="<script>
	//var time_interval=parseInt(60000)*parseInt(". get_post_meta( '1', 'rss_player_feed_time', true ).");   setInterval(function(){ feed_check('".$id."','".plugin_dir_url( __FILE__ )."')}, time_interval);</script>";
	

	return $short;
}
add_shortcode( 'rssplayer', 'rssplayer_shortcode' );

/* == For frontend functionality adding js and css with html in footer == */
function rssplayer_function()

{  
  echo "<div style='display:none;' id='iframe_genrate' style='min-width:500px;min-height:350px;'><textarea style='height: 80px;width:574px; overflow:auto;'>demo</textarea></div>";
  echo "<div id='emailif' style='display:none; min-width:450px;min-height:300px;width:100%;height:100%;'>
		<div class='rssplayer_email_resopne'>
		</div>
		<div class='rssplayer_email_content'>
		<div class='textBody' style='margin-bottom:10px;'>Fill out the form below to email this episode to a friend.</div>
		";
		/*
		echo "<form id='mail_form' name='mail_form' method='post' action='' style='padding:0px;margin:0px;'>
		<table border='0' allign='center' cellpadding='0' cellspacing='0' class='textBody'>
		<tbody>		
		<tr>
		<td align='right' style='padding-top:5px;'>Your Email:</td> 
		<td align='left' style='padding-top:5px;padding-left:5px;'>
		<input style='width:300px;margin:0px;' type='text' name='fromEmail' id='fromEmail'>
		</td>
		</tr>		
		<tr>
		<td align='right' style='padding-top:5px;'>Recipient Email:</td> 
		<td align='left' style='padding-top:5px;padding-left:5px;''>
		<input style='width:300px;margin:0px;' type='text' name='toEmail' id='toEmail'></td>
		</tr>
		<tr>
		<td align='right' style='padding-top:5px;'>Subject:</td> 
		<td align='left' style='padding-top:5px; padding-left: 5px;'>
		<input style='width:300px; margin: 0px;' type='text' name='subject' id='subject' value='Check this out!'></td>
		</tr>
		<tr>
		<td align='right' valign='top' style='padding-top:5px;'>Comments:</td>
		<td align='left' style='padding-top:5px; padding-left: 5px;'>
		<textarea id='briteWrox_comment' class='textBody' style='width:300px;height:50px;padding:0px;overflow:auto;' name='comments'></textarea></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td align='left' style='padding-top:5px;padding-left:5px;'>
		<input id='mail_link' type='hidden' value='' style='margin:0px;'>
		<input type='hidden' name='hide_email' value=".plugins_url('/email.php',__FILE__)." id='plugUrl'/>
		<input class='mailSend' onclick='sendmail();' type='button' value='Send' style='margin:0px;'>
		</td>
		</tr>
		</tbody>
		</table>
		</form> ";
		*/
		echo "</div> 		
		</div>";
	echo "<link rel='stylesheet' type='text/css' href=".plugin_dir_url( __FILE__ )."css/style.css>";
	echo "<link rel='stylesheet' type='text/css' href=".plugin_dir_url( __FILE__ )."css/popup.css>";
	echo "<link rel='stylesheet' type='text/css' media='all' href=".plugin_dir_url( __FILE__ )."fancybox/jquery.fancybox.css>";
	?>
	<style>
     body
        {
            font-family: Verdana;
            font-size: 10px;
         
        }
     
    </style>

<input type="button" onclick="ShowMessage('This Modal Popup Window using Javascript')"value="Show Message Window" 
        style="width: 290px"/><br /><br />


	<?php
	//echo "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>";
	echo "<script type='text/javascript' src=".plugin_dir_url( __FILE__ )."fancybox/jquery.fancybox.js?v=2.0.6></script>";
	echo "<script type='text/javascript' src=".plugin_dir_url( __FILE__ )."js/ModalPopupWindow.js></script>";
	echo "<script type='text/javascript' src=".plugin_dir_url( __FILE__ )."js/custom.js></script>";
	
	//echo " <script type=text/javascript>
	//	$('.fancybox').fancybox({'showNavArrows':true,openEffect:'elastic',closeEffect:'elastic'});
	//	</script>";
	?>
	

<?php 
}
add_action('wp_footer', 'rssplayer_function', 100);

if( !wp_next_scheduled( 'update_mj_feedlist' ) ) {
    wp_schedule_event( time(), 'hourly', 'update_mj_feedlist' );
}
else {
    //wp_clear_scheduled_hook( 'update_mj_feedlist' );
}

if( !function_exists( 'update_mj_feeds' ) ) {
    function update_mj_feeds() {

        date_default_timezone_set( 'America/Los_Angeles' );
        
        global $wpdb;
        
        $settings_table = $wpdb->prefix . "rssplayer_setting";
        
        $feeds_table = $wpdb->prefix . "rssplayer_feed";
        
        $sql = "SELECT * FROM $settings_table";
        
        $feeds = $wpdb->get_results( $sql );
   
        if( $feeds ) {
            foreach( $feeds as $feed ) {
                $sql = "SELECT * FROM $feeds_table WHERE feed_id='{$feed->id} ORDER BY id ASC";
                
                $newest_feed = $wpdb->get_row( $sql );
                
                if( @simplexml_load_file( $feed->url ) )  {
                    $feed_xml = simplexml_load_file( $feed->url );
                    
                    $needs_updated = false;
                    
                    foreach( $feed_xml->channel->item as $item ) {
                        if( strtotime( $item->pubDate ) > strtotime( $newest_feed->feed_xml_date ) ) {
                            $needs_updated = true;
                            break;
                        }
                    }
                    
                    if( $needs_updated ) {
                        $sql = "UPDATE $settings_table SET dtModified=NOW() WHERE id='{$feed->id}'";
                        $wpdb->query($sql);
                        
                        $sql = "DELETE FROM $feeds_table WHERE feed_id='{$feed->id}'";
                        $wpdb->query($sql);
                        
                        $num_of_posts = (int) $feed->no_of_post;
                        
                        foreach( $feed_xml->channel->item as $item ) {
                            if($num_of_posts > 0) {
                                echo $num_of_posts, "<br>";
                                $title = str_replace( "'", " ", $item->title );
                                $date = $item->pubDate;
                                $link = $item->link;
                                // I'm not sure if this should be decoded. Using this code because it is in the original update code.
                                $description = trim( html_entity_decode( str_replace( "'", " ", $item->description ), ENT_QUOTES, 'UTF-8' ) );
                                $media = $item->enclosure['url'];
                                $sql = "INSERT INTO $feeds_table (feed_id, feed_xml_title, feed_xml_date, feed_xml_link, feed_xml_description, feed_xml_media, dtModified) VALUES ('{$feed->id}', '$title', '$date', '$link', '$description', '$media', NOW())";
                                $wpdb->query($sql);
                                --$num_of_posts;
                            }
                        }
                    }
                }
            }
        }
    }
}

add_action('update_mj_feedlist', 'update_mj_feeds');
?>