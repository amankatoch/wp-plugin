	function sendmail (val)
				{	
					var plugin_url = document.getElementById("plugUrl"+val).value,	    
					    Eemail     = document.getElementById("fromEmail"+val).value,	   
					    EtoEmail   = document.getElementById("toEmail"+val).value,
					    Esubject   = document.getElementById("subject"+val).value,
					    Ecomments  = document.getElementById("briteWrox_comment"+val).value,
					    Elink      = document.getElementById("mail_link"+val).value,
					    page       = window.location.href;
						//alert(plugin_url + Eemail);
						var xmlhttp;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						  }
						xmlhttp.onreadystatechange=function()
						  {
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
						    {
						    document.getElementById("viewJob"+val).innerHTML="<div class='sent_mail'>" + xmlhttp.responseText + "</div>";
						    
						    }
						  }
						xmlhttp.open("POST",plugin_url,true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.send("val="+val+"&fromName= 'Rss Player Pod Cast'& fromEmail= " + Eemail + "& toName= 'Friends'& toEmail= "+EtoEmail+"& subject= "+Esubject+"& comments= "+Ecomments+"& xml_link= "+Elink+"& page= "+page + "" );

				}
	
	

	function sendmail_iframe (val)
				{	
					var plugin_url = document.getElementById("plugUrl").value,	    
					    Eemail     = document.getElementById("fromEmail").value,	   
					    EtoEmail   = document.getElementById("toEmail").value,
					    Esubject   = document.getElementById("subject").value,
					    Ecomments  = document.getElementById("briteWrox_comment").value,
					    Elink      = document.getElementById("mail_link").value,
					    page       = window.location.href;
						//alert(plugin_url + Eemail);
						var xmlhttp;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						  }
						xmlhttp.onreadystatechange=function()
						  {
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
						    {
						    document.getElementById("viewjob").innerHTML="<div class='sent_mail'>" + xmlhttp.responseText + "</div>";
						    
						    }
						  }
						xmlhttp.open("POST",plugin_url,true);
						xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
						xmlhttp.send("val="+val+"&fromName= 'Rss Player Pod Cast'& fromEmail= " + Eemail + "& toName= 'Friends'& toEmail= "+EtoEmail+"& subject= "+Esubject+"& comments= "+Ecomments+"& xml_link= "+Elink+"& page= "+page + "" );

				}
	
	


function show_rss (plugin_url)
{
	jQuery("#rssOutput").html("Inserting Feeds.. <img src=" + "'" + plugin_url + "../images/spinner.gif' >");

	var rss_url = jQuery("#new_url").val(),
	    title   = jQuery("#new_title").val(),
	    number  = jQuery("#rss_num").val(),
	    hide    = jQuery("#hide_description").val();

	var validtit = document.getElementById("new_title").value,
	    validnum = document.getElementById("rss_num").value;
		
	if (validtit.length == 0)		
	{		
		alert("Please, Enter Title");		
		return false;		
	}
		
	var validurl = document.getElementById("new_url").value;		
	//if the length of the string value is 0,		
	//it means the user has entered no value:
	rss_url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
				
	if (validurl.length == 0)		
	{		
		alert("Please, Enter Url");		
		return false;		
	}
	else if (!rss_url_validate.test(rss_url))
	{
		alert('Please Enter Valid Url');
		return false;
	}
	
	var validnum = document.getElementById("rss_num").value;		
	//if the length of the string value is 0,		
	//it means the user has entered no value:		
	if (validnum.length == 0)		
	{		
		alert("Please, Enter No. of Rss Feed You Want");		
		return false;		
	}	
	
	jQuery.ajax({
		type: "POST",
		url:  plugin_url + "getrss.php",
		data: { url : rss_url, title : title, plugin_url : plugin_url, num : number, hide_description : hide }
	})
	.done(function(response){
		response = jQuery.parseJSON(response);		
		if (response.status == "success")
		{
			jQuery("#rssOutput").html("<div class='updated highlight'>" + response.msg + "</div>");
			document.getElementById("rss_num").value   = "";
			document.getElementById("new_title").value = "";
			document.getElementById("new_url").value   = "";
			document.getElementById("hide_description").checked = false;
		}
		else if (response.status == "error")
		{
			jQuery("#rssOutput").html("<div class='error highlight'>" + response.msg + "</div>");
		}
	});
}

function update_rss (plugin_url, id)
{
	jQuery("#rssOutput").html("Updating Feeds.. <img src=" + "'" + plugin_url + "../images/spinner.gif' >");
	
	var rss_url = jQuery("#new_url").val(),
	    title   = jQuery("#new_title").val(),
	    number  = jQuery("#rss_num").val(),
	    hide    = jQuery("#hide_description").val();

	var validtit = document.getElementById("new_title").value,
	    validnum = document.getElementById("rss_num").value;
	
	if (validtit.length == 0)		
	{		
		alert("Please, Enter Title");		
		return false;		
	}
	
	var validurl = document.getElementById("new_url").value;		
	//if the length of the string value is 0,		
	//it means the user has entered no value:
	rss_url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
			
	if (validurl.length == 0)		
	{		
		alert("Please, Enter Url");		
		return false;		
	}	
	else if( !rss_url_validate.test(rss_url) )
	{
		alert('Please Enter Valid Url');
		return false;
	}
	
	var validnum = document.getElementById("rss_num").value;			
	if (validnum.length == 0)		
	{		
		alert("Please, Enter No. of Rss Feed You Want");		
		return false;		
	}
	
	jQuery.ajax({
		type: "POST",
		url:  plugin_url + "updaterss.php",
		data: { url : rss_url, title : title, plugin_url : plugin_url, num : number, id: id, hide_description: hide }
	})
	.done(function(output){
		output = JSON.parse(output);
		console.log(output);
		
		if (output.status == "success")
		{
			jQuery("#rssOutput").html("<div id='message' class='updated highlight' >" + output.msg + "</div>");
		}
		else if (output.status == "error")
		{
			jQuery("#rssOutput").html("<div id='message' class='error highlight' >" + output.msg + "</div>");	
		}
	});
}


function ssendmail ()
{
	var plugin_url = jQuery("#plugUrl").val(),	    
	    Eemail     = jQuery("#fromEmail").val(),	   
	    EtoEmail   = jQuery("#toEmail").val(),
	    Esubject   = jQuery("#subject").val(),
	    Ecomments  = jQuery("#briteWrox_comment").val(),
	    Elink      = jQuery("#mail_link").val(),
	    page       = window.location.href;
		
	jQuery.ajax({
		type:"POST",
		url: plugin_url,
		data:{ fromName : 'Rss Player Pod Cast', fromEmail : Eemail, toName : 'Friends', toEmail : EtoEmail, subject : Esubject, comments : Ecomments, xml_link : Elink, page : page}
	})
	.done(function(response){
		jQuery(".rssplayer_email_content").hide();
		jQuery(".rssplayer_email_resopne").show();
		jQuery(".rssplayer_email_resopne").html("<div class='sent_mail'>" + response + "</div>");
	});
}
function showPlayer (id)
{
	jQuery(".audioplayer" + id + "").toggle();	
}

function showPlayerIframe (id)
{
	jQuery(".audioplayer" + id + "").toggle();	
	var myAudio = document.getElementById("audioPlayer" + id + "");
	
	if (myAudio.paused)
		myAudio.play();
	else
		myAudio.pause();			
}

jQuery(".email_generate").click(function() {
	var xml_id_email = jQuery(this).attr("data");
	jQuery("#mail_link").val(xml_id_email);
});

jQuery(".iframe_plug").click(function() {
	var iframe_url = jQuery(this).attr("data");
	jQuery("#iframe_genrate textarea").html("<iframe src='"+iframe_url+"' width='100%' height='696' frameborder='0'> </iframe>");
});

function feed_check (id, url)
{
	jQuery.ajax({
		type: "POST",
		url:  url + "feed_update.php",
		data: {feed_check_id : id}
	})
	.done(function(response){
		console.log(response);
		response = JSON.parse(response);
		
		if (response.status == "Yes")
		{
			var rss_url = response.url,
			    title   = response.title,
			    number  = response.no_of_post,
			    id      = response.id,
			    hide    = response.hide_description;
			
			jQuery.ajax({
				type: "POST",
				url:  url + "updaterss.php",
				data: { url : rss_url, title : title, num : number, id : id, hide_description : hide }
			})
			.done(function(msg){
				console.log(msg);
			});
		}
		
		if (response.status == "No")
		{
			console.log(response.msg);
		}
  });
}


jQuery(document).ready(function(){
	jQuery(".email_generate").click(function(){
				jQuery(".rssplayer_email_resopne").hide();
				jQuery(".rssplayer_email_content").show();
	});
	jQuery(".prevent_showPop").click(function(e){
		e.preventDefault();
		var url=jQuery(this).attr("href");
		var myWindow=window.open(url,'','width=800,height=400');
	myWindow.focus();

	});
var image_custom_uploader;
 jQuery('#your_image_url_button').click(function(e) {
 e.preventDefault();

 //If the uploader object has already been created, reopen the dialog
 if (image_custom_uploader) {
 image_custom_uploader.open();
 return;
 }

 //Extend the wp.media object
 image_custom_uploader = wp.media.frames.file_frame = wp.media({
 title: 'Choose Image',
 button: {
 text: 'Choose Image'
 },
 multiple: false
 });

 //When a file is selected, grab the URL and set it as the text field's value
 image_custom_uploader.on('select', function() {
 attachment = image_custom_uploader.state().get('selection').first().toJSON();
 var url = '';
 url = attachment['url'];
 jQuery('#your_image_url').val(url);
 });

 //Open the uploader dialog
 image_custom_uploader.open();
 });
});

function showMore (id)
{
	jQuery(".desc" + id + " .readmore").toggle();
	jQuery(".description" + id + "").toggle();
}

















	