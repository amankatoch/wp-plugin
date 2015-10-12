<?php
/*
OpenDoor Wordpress Plugin Version: 1.0.49 - MODIFIED
*/

include('widgets/opn.php');

if( is_admin() ) {
    
    // --- <scripts>
	function opendoor_displet_admin_scripts(){
	    
		wp_register_script('select_add', plugins_url('app/mod/select_add/jquery.select_add.js', __FILE__));
		wp_enqueue_script('select_add');
		
		wp_register_script('target_content', plugins_url('app/mod/target_content/jquery.target_content.js', __FILE__));
		wp_enqueue_script('target_content');
		
		wp_register_style('admin_css', plugins_url('app/views/admin/admin.css', __FILE__));
		wp_enqueue_style('admin_css');
		
	}
	add_action('admin_enqueue_scripts','opendoor_displet_admin_scripts');
	
	include('admin/opendoor-displet-admin.php');
	
} else {
	
	// --- <head>
	function opendoor_displet_object_meta(){


		// construct meta tags creating OPN media asset object
		
		    $publisherOptions = get_option( 'publisher_options' );
		    
		    $postId = get_the_ID();
		    $postInfo = wp_get_single_post($postId, ARRAY_A);

		    if(!empty($publisherOptions["publisher_info"])) {
		        
		        // --- opn:site_name
		        if(!empty($publisherOptions["publisher_info"]["site_name"])) {
		            echo '<meta property="opn:site_name" content="'.$publisherOptions["publisher_info"]["site_name"].'" />';
	            }
	            
	            
	            // --- opn:app_id
		        if(!empty($publisherOptions["publisher_info"]["app_id"])) {
		            echo '<meta property="opn:app_id" content="'.$publisherOptions["publisher_info"]["app_id"].'" />';
	            }
		        
	        }
	        
	        // --- opn:url
		    $permaLink = get_permalink($postId);
		    echo '<meta property="opn:url" content="'.$permaLink.'" />';
	        
	        // --- opn:type
	        echo '<meta property="opn:type" content="article" />';

            // --- opn:title
	        echo '<meta property="opn:title" content="'.get_the_title().'" />';

		    if(
		        !empty($publisherOptions["content_targeting"])
		        &&
		        is_array($publisherOptions["content_targeting"])
		    ) {
		        
		        $myIndids = array();
		        
		       foreach( $publisherOptions["content_targeting"] as $index => $targetingInfo){
		           
                    if(!empty($targetingInfo["uri"])){
                        
                        $pregReadyUrl = preg_quote($targetingInfo["uri"]);
                        $pregReadyUrl = preg_replace('/\//', '\/', $pregReadyUrl);
                        
                        if(preg_match("/".$pregReadyUrl."/i", $permaLink)){
		                   
                            $myIndids = array_merge($myIndids, $targetingInfo["indids"]);
		           
		               }
	                   
	               }
		           
	           }
	           
	           // --- opn:industries
	           if(!empty($myIndids)){
                   echo '<meta property="opn:industries" content="'.implode(",", $myIndids).'" />';
               }
		        
	        }
	        
	        // --- opn:image
		    if(
		        !empty($postInfo["post_content"])
		    ) {
		        
		        if(preg_match('/<img.+src *= *[\'"](?P<src>.+?)[\'"].*>/i', $postInfo["post_content"], $image)){
		            echo '<meta property="opn:image" content="'.$image["src"].'" />';
	            }
		        
	        }
	        
	        // --- opn:description
		    //echo '<meta property="opn:description" content="'.get_post_meta($postId, 'description', false).'" />';
		    
		    
		    // --- opn:keywords
		    if(!empty($postInfo["tags_input"])){
		        echo '<meta property="opn:keywords" content="'.implode(",", $postInfo["tags_input"]).'" />';
	        }
	        
		    
		    // --- opn:published
		    // WARNING FOR REAL ESTATE  - anything with a publish tag will be considered a sharable media asset
		    //  this is undesireable in the case of property listing pages as they will 
		    //  drown out original content from other sources like your blog.
		    // 
		    //  So: 
		    //      ONLY include "opn:published" on blog pages you want publicized with fresh original content
		    //  - OR -
		    //      contact julia.smart@opner.com for details and solutions to determine which pages are indexed for sharing
		    // 
		    if(!empty($postInfo["post_date_gmt"])){
		        // for blogs that only publish origional content the following line can be included to 
		        // automatically register new posts with OpenDoor Publisher Network.
		        //echo '<meta property="opn:published" content="'.date($postInfo["post_date_gmt"]).'" />';
	        }
		    
		    
		    // --- opn:region
		    //echo '<meta property="opn:region" content="''" />';
		    

	}
	add_action('wp_head', 'opendoor_displet_object_meta');


	// --- <scripts>
	function opendoor_displet_scripts(){
	    
		wp_register_script('opn_beacon','http://www.opndr.com/app/v1.12/mod/opn_beacon/1.0.3/jquery.opn_beacon.min.js');
		wp_enqueue_script('opn_beacon');
	}
	add_action('wp_enqueue_scripts','opendoor_displet_scripts');
	
}
?>