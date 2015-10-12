<?php 
if(isset($_POST['rssUpdate']))
{
	$value=$_POST['time_interval'];
	update_post_meta( '1', 'rss_player_feed_time', $value );
	$rssplayer_icon=$_POST['your_image_url'];
	if(!empty($rssplayer_icon))
	{
		update_post_meta( '1', 'rss_player_title_icon', $rssplayer_icon );
	}	
}
     $image_url = (get_post_meta( '1', 'rss_player_title_icon', true )) ? get_post_meta( '1', 'rss_player_title_icon', true ) : plugin_dir_url( __FILE__ ).'images/title.jpg';
     $image_uri=get_post_meta( '1', 'rss_player_title_icon', true );
	 $image_id= pippin_get_image_id($image_uri);
     $image_attributes= wp_get_attachment_image_src( $image_id, array(32,32),false );
     $image_url=$image_attributes[0];
?>
<form method="post" enctype="multipart/form-data">
    <?php
/*<div style="margin-top: 1em">
    <h2>Time interval (Feed updates) : </h2>
    5<input id="time_interval" name="time_interval" type="range" min="5" max="60" value="<?php if(get_post_meta( '1', 'rss_player_feed_time', true )) { echo get_post_meta( '1', 'rss_player_feed_time', true ); } else{ echo "5"; }?>" />60 minutes
</div>*/
?>
<p id="result"><?php if(get_post_meta( '1', 'rss_player_feed_time', true )) { echo get_post_meta( '1', 'rss_player_feed_time', true )." minutes"; } ?></p>
<div style="margin-top: 1em">
	<h2>Upload Icon (Icon next to title) : </h2>
	<h3>Recommended 40px x 40px. Will be auto scaled to 40x40. </h3>
	<div><img src="<?php echo $image_url; ?>" ></div>
</div>
<?php 
echo '<input id="your_image_url" type="text" size="36" name="your_image_url" value="'.$image_url.'" />';
echo '<input id="your_image_url_button" class="button" type="button" value="Upload Image" />';
?>

<div style="margin-top: 1em">
<input type="submit" name="rssUpdate" class="button button-primary button-large" value="Update">
	</div>
</form>


<script type="text/javascript">
/*var p = document.getElementById("time_interval"),
    res = document.getElementById("result");

p.addEventListener("input", function() {
    res.innerHTML = p.value + ' minutes';
}, false);*/ 
</script>