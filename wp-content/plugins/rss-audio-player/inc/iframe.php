<?php
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../../../wp-blog-header.php');
?>
<html>
<head>
<?php
echo "<link rel='stylesheet' type='text/css' href=".plugin_dir_url( __FILE__ )."css/style.css>";
  echo "<link rel='stylesheet' type='text/css' media='all' href=".plugin_dir_url( __FILE__ )."fancybox/jquery.fancybox.css>";
  echo "<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>";
  echo "<script type='text/javascript' src=".plugin_dir_url( __FILE__ )."fancybox/jquery.fancybox.js?v=2.0.6></script>";
  
  echo " <script type=text/javascript>
$('.fancybox').fancybox({'showNavArrows':true,openEffect:'elastic',closeEffect:'elastic'});
</script>";
?>
</head>
<body>
<?php
//echo "Plugins url: ".plugin_dir_url( __FILE__ )."images/fb.png";
/* Short and sweet */
define('WP_USE_THEMES', false);
require('../../../wp-blog-header.php');

$id_iframe=$_GET['id'];
$page_link ="http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
global $wpdb;
$table_feed = $wpdb->prefix . "rssplayer_feed";
$result=$wpdb->get_results("SELECT * FROM $table_feed WHERE id='$id_iframe' ORDER BY id ASC");
$tbl_setting=$wpdb->prefix.'rssplayer_setting';
$resultsetting = $wpdb->get_results( "SELECT * FROM $tbl_setting where id= '$id_iframe'");
$feedtitle = $resultsetting[0]->title;
  $feedurl = $resultsetting[0]->url;
  $feedposts = $resultsetting[0]->no_of_post;
  ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="programText ">
	<tbody>
	<?php
foreach ($result as $value) {
	$xmlid = $value->id;
    $xmlfeedid = $value->feed_id;
    $xmltitle = $value->feed_xml_title;
    $xmldate = $value->feed_xml_date;
    $xmllink = $value->feed_xml_link;
    $xmldescription = $value->feed_xml_description;
    $xmlmedia = $value->feed_xml_media;
    $originalDate = $xmldate;
    $xmldesc1 = html_entity_decode($xmldescription);
    $xmldesc = $xmldesc1;
    $xmldesc = preg_replace("/<img[^>]+\>/i", "", $xmldesc); 
    //echo $xmldesc;


    $newDate = date("m-d-Y", strtotime($originalDate));
	?>
	<tr>
    <td style="padding-top:15px;" align="left" valign="top">
      <div class="programText" id="pc0" style="background-color:#f1f4f7; border:1px solid #eee; padding:10px;">
        
          <div style="float:left;">
            <a  href="<?php echo $xmlmedia;?>" ><img class="dwn" src="<?php echo plugin_dir_url( __FILE__ );?>images/download_icon_off.png" border="0" style="padding-top:1px;" >
            </a> &nbsp;&nbsp;
          </div>
          <div style="float:left; padding-left: px;"><a href="javascript:showPlayerIframe('<?php echo $id_iframe; ?>');">
            <img class="play" src="<?php echo plugin_dir_url( __FILE__ );?>images/play.png" border="0"></a>&nbsp;&nbsp;
          </div>
            <div class="podcast-left-main">
              <div class="podcast_title"><?php echo $xmltitle;?></div>
            </div>
            <div class="social-date">
               <div style="float:right;">
                <a class="email_generate fancybox" href="#emailif" data="<?php echo $xmlid; ?>"><img class="email" src="<?php echo plugin_dir_url( __FILE__ );?>images/email.png" border="0">
                </a>
              </div>
              <div style="float:right;">
                <a class="iframe_plug fancybox" data="<?php echo plugin_dir_url( __FILE__ );?>iframe.php?id=<?php echo $xmlid; ?>" href="#iframe_genrate"><img class="share" src="<?php echo plugin_dir_url( __FILE__ );?>images/share.png" border="0">
                </a>
              </div>
              <div style="float:right;">
                <a onclick="return false" href=""><img onclick="myFunction('https://plus.google.com/share?url=<?php echo the_permalink();?>')" class="google" src="<?php echo plugin_dir_url( __FILE__ );?>images/google.png" border="0" >
                </a>
              </div>
              <div style="float:right;">
                <a onclick="return false" href=""><img class="twitter" src="<?php echo plugin_dir_url( __FILE__ );?>images/twitter.png" border="0" onclick="myFunction('http://twitter.com/share?url=<?php echo the_permalink();?>')" >
                </a>
              </div>
              <div style="float:right;">
                <a onclick="return false" href=""><img onclick="myFunction('http://www.facebook.com/sharer.php?u=<?php echo the_permalink();?>')" class="facebook" src="<?php echo plugin_dir_url( __FILE__ );?>images/fb.png" border="0">
                </a>
              </div>
              <div class="podcast-date"><?php echo $newDate;?>&nbsp;</div>
              <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>
            <?php if(!strstr($xmldesc,"<a")){
              $xmldesc=strip_tags($xmldesc);
              ?>
            <div class="desc<?php echo $xmlid; ?> show-more"><?php echo substr($xmldesc,0,30); ?>
      <a href="javascript:showMore('<?php echo $xmlid; ?>');">Show More</a>
        </div>
        <div class="description<?php echo $xmlid; ?> show-more" style="display:none;"><?php echo $xmldesc; ?><a href="javascript:showMore('<?php echo $xmlid; ?>');"> Show Less </a></div>
        <?php } 
        else
        {
        ?>

        <?php //echo $xmldesc; ?>

        <?php } ?>
        <div style="display:none;" class="audioplayer<?php echo $xmlid; ?>" align="center">
        <audio preload="none" id="audioPlayer<?php echo $xmlid; ?>" src="<?php echo $xmlmedia;?>" type="audio/mpeg"  controls>
        </audio></div>
      </div>
    </td>
  </tr>
  </tbody>
  </table>
<?php
}
?>
<div style="display:none;" id='iframe_genrate' width='500px' height='300px' ><textarea style='height: 80px;width:574px; overflow:auto;'>demo</textarea></div>
<div id="emailif" style="display:none;">
  <div id="fancybox-wrap" style="width: 430px; height: 300px; top: 417px; left: 408px; display: block;">
  <div id="fancybox-content" style="overflow:none;border-width:10px;width:410px;height:225px;">
<div style="width:410px;height:auto;overflow:none;position:relative;">
<div id="section1" style="display:block;">
<div class="textBody" style="margin-bottom:10px;">Fill out the form below to email this episode to a friend.</div>
<form id="mail_form" name="mail_form" method="post" action="" style="padding:0px;margin:0px;">
<table border="0" cellpadding="0" cellspacing="0" class="textBody" id="viewjob">
<tbody>
<tr>
<td align="right" width="100">Your Name:</td>
<td align="left" style="padding-left:5px;"><input style="width:300px;margin:0px;" type="text" name="fromName" id="fromName"></td>
</tr>
<tr>
<td align="right" style="padding-top:5px;">Your Email:</td> 
<td align="left" style="padding-top:5px;padding-left:5px;">
<input style="width:300px;margin:0px;" type="text" name="fromEmail" id="fromEmail">
</td>
</tr>
<tr>
<td align="right" style="padding-top:5px;">Recipient Name:</td> 
<td align="left" style="padding-top:5px;padding-left:5px;">
<input style="width:300px;margin:0px;" type="text" name="toName" id="toName"></td>
</tr>
<tr>
<td align="right" style="padding-top:5px;">Recipient Email:</td> 
<td align="left" style="padding-top:5px;padding-left:5px;">
<input style="width:300px;margin:0px;" type="text" name="toEmail" id="toEmail"></td>
</tr>
<tr>
<td align="right" style="padding-top:5px;">Subject:</td> 
<td align="left" style="padding-top:5px; padding-left: 5px;">
<input style="width:300px; margin: 0px;" type="text" name="subject" id="subject" value="Check this out!"></td>
</tr>
<tr>
<td align="right" valign="top" style="padding-top:5px;">Comments:</td>
<td align="left" style="padding-top:5px; padding-left: 5px;">
<textarea id="briteWrox_comment" class="textBody" style="width:300px;height:50px;padding:0px;overflow:auto;" name="comments"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="left" style="padding-top:5px;padding-left:5px;">
<input id='mail_link' type='hidden' value='' style='margin:0px;'>
<input type='hidden' name='hide_email' value='<?php echo plugins_url('/email.php',__FILE__);?>' id='plugUrl'/>
<input class="mailSend" onclick="sendmail_iframe();" type="button" value="Send" style="margin:0px;">

</td>
</tr>
</tbody>
</table>
</form> 
</div>
</div>
  </div></div></div>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>js/custom.js"></script>
</body>
</html>
<?php echo "<link rel='stylesheet' type='text/css' href=".plugin_dir_url( __FILE__ )."css/style.css>";
  echo "<link rel='stylesheet' type='text/css' href=".plugin_dir_url( __FILE__ )."css/popup.css>";
   echo "<script type='text/javascript' src=".plugin_dir_url( __FILE__ )."js/ModalPopupWindow.js></script>";
  
  ?>