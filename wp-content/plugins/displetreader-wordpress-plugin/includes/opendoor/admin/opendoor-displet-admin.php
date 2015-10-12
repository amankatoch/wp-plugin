<?php

class OpenDoorDispletAdmin
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    private $options2;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_opendoor_submenu_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_opendoor_submenu_page()
    {
        
        // this adds the menu item to Displet Tools, but when clicked we get a 404
        
        add_submenu_page( 
            'displettools-uid-slug', 
            'OpenDoor', 
            'Marketing + Referrals', 
            'manage_options', 
            'opendoor-displet-admin', 
            array( $this, 'create_admin_page' )
        );
        
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'publisher_options' );
        
        /*
        // useful to see the data structure on page load...
        print "<div><pre>";
        print_r($this->options);
        print "</pre></div>";
        */
        
        echo '<div class="wrap">';
        screen_icon();
        echo '  <h2>Content Marketing and Social Referrals</h2>';
        echo '  <a href="http://www.opndr.com" target="_blank">';
        echo '      <img src="http://www.opndr.com/img/layout/logo/logo-fing-bubbles-555x300.png" height="149" align="right" />';
        echo '  </a>';        
        echo '  <p>';
        echo '      <a href="http://www.opndr.com" target="_blank">OpenDoor</a> automatically engages website visitors by using common social connections to create instant rapport and trust for your real estate agents and brand.';
        echo '  </p>';
        
        echo '  <form method="post" action="options.php">';

        settings_fields( 'publisher_options' );
        do_settings_sections( 'opendoor-displet-admin' );
        
        $this->create_content_targeting();
        
        submit_button(); 
        
        echo '  </form>';
        echo '</div>';
        
        echo '<div class="wrap">';
        echo '  <h2>Advanced Settings</h2>';
        echo '  <p>To activate advanced settings contact <a href="mailto:julia.smart@opndr.com">julia.smart@opndr.com</a>.</p>';
        echo '  <ul style="list-style:initial; padding-left:30px;">';
        echo '      <li>UI/UX Personalization - Modify the OpenDoor Plugin to look like a native part of your website</li>';
        echo '      <li>Broker/Company Filter - Limit social referrals to members of your real estate team</li>';
        echo '      <li>Content Distribution - Promote your real estate blog to demonstrate local knowledge and leadership</li>';
        echo '      <li>CRM Integration - Add new clients to your existing workflow</li>';
        echo '      <li>SEO - Best practices for boosting website rank using OpenDoor</li>';
        echo '      <li>Pro Assistance - Fast Plugin Setup & Customization Service</li>';
        echo '  </ul>';
        echo '</div>';
        
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {   
        // ===== Application Settings
        register_setting(
            'publisher_options',                    // Option group
            'publisher_options',                    // Option name
            array( $this, 'sanitize' )              // Sanitize
        );

        // --- Section :: Application Settings 
        add_settings_section(
            'publisher_info_section',                           // ID
            'Application Settings',                             // Title
            array( $this, 'publisher_info_section_info' ),      // Callback
            'opendoor-displet-admin'                                    // Page
        );

        // --- Field : site_name
	    add_settings_field(
            'site_name', 
            'Broker/Company Name <br><font style="font-size:11px; font-weight:normal;">(aka Publisher Name)</font>', 
            array( $this, 'create_site_name_input' ), 
            'opendoor-displet-admin', 
            'publisher_info_section'
        );   

        // --- Field : app_id
        add_settings_field(
            'app_id', 
            'Application ID (app_id)', 
            array( $this, 'create_app_id_input' ), 
            'opendoor-displet-admin', 
            'publisher_info_section'
        );
        
        // --- Section :: Content Settings 
        add_settings_section(
            'content_targeting_section',                 // ID
            'Blog Content Targeting',                        // Title
            array( $this, 'content_targeting_section_info' ),       // Callback
            'opendoor-displet-admin'                            // Page
        );
              
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        
        // --- publisher_info
        if(!empty($input["publisher_info"])){
            
            // -- app_id
            if( isset( $input["publisher_info"]['app_id'] ) ) {
                if( preg_match( "/([0-9a-z]+\.[0-9a-z]+)/i", $input["publisher_info"]['app_id'], $matches ) ) {
                    $new_input["publisher_info"]['app_id'] = $matches[1];
                }
            }
                
            // -- site_name
            if( isset( $input["publisher_info"]['site_name'] ) ) {
                $new_input["publisher_info"]['site_name'] = sanitize_text_field( $input["publisher_info"]['site_name'] );
            }
        
        }
        
        
        // --- content_targeting
        if(!empty($input["content_targeting"])){
            
            if(
                !empty($input["content_targeting"])
                &&
                is_array($input["content_targeting"])
            ){
            
                // start a new sequential index regardless of the previous one...
                $newIndex = 0;
                foreach($input["content_targeting"] as $index => $contentSettingInfo){
                
                    $hasInfo = 0;
                
                    // -- uri
                    if( 
                        isset( $contentSettingInfo['uri'] ) 
                        &&
                        !empty($contentSettingInfo['uri'])
                    ) {
                        $new_input["content_targeting"][$newIndex]['uri'] = sanitize_text_field( $contentSettingInfo['uri'] );
                        $hasInfo = 1;
                    }
        
                    // -- indids
                    if( 
                        isset( $contentSettingInfo['indids'] ) 
                        &&
                        !empty($contentSettingInfo['indids'])
                    ) {
                        $new_input["content_targeting"][$newIndex]['indids'] = $contentSettingInfo['indids'];
                        $hasInfo = 1;
                    }
                    
                    if($hasInfo){
                        $newIndex++;
                    }
            
                }
            }
            
        }
        
        return $new_input;

    }
    
    
    /** 
     * Print the Section text
     */
    public function publisher_info_section_info()
    {
        print 'The following credentials are used to identify your website within OpenDoor. ';
    }
    
    public function content_targeting_section_info()
    {
        print 'If you are regularly publishing articles or blog posts OpenDoor helps distribute your content to relevant industry professionals. Use the form below to set target industries for entire sections of your site.  These will automatically be applied as default to all content that matches the specified URI fragment but can be modified on a per article basis if needed.';
    }


    // --- create_app_id_input :: Get the settings option array and print one of its values
    public function create_app_id_input()
    {
        printf(
            '<input type="text" id="app_id" name="publisher_options[publisher_info][app_id]" value="%s" />',
            isset( $this->options["publisher_info"]['app_id'] ) ? esc_attr( $this->options["publisher_info"]['app_id']) : ''
        );
        echo '<p>Need an App Id? <a href="http://www.opndr.com/opn/apply" target="_blank">Request here</a></p>';
    }


    // --- create_site_name_input :: Get the settings option array and print one of its values
    public function create_site_name_input()
    {
        $siteName = "";
        
        $blogInfo = get_bloginfo("name");
        
        if(isset( $this->options["publisher_info"]['site_name'] )) {
            
            $siteName = esc_attr( $this->options["publisher_info"]['site_name']);
            
        } elseif(!empty($blogInfo)) {
            
            $siteName = esc_attr( $blogInfo );
        }
        
        printf(
            '<input type="text" id="site_name" name="publisher_options[publisher_info][site_name]" value="%s" />',
            $siteName
        );
    }
    
    
    
    // --- create_content_targeting_by_uri :: Get the settings option array and print one of its values
    public function create_content_targeting_by_uri($inputs = array("id" => "", "selected" => array(), "uri" => "", "default-selected" => ""))
    {
        

        echo '
        
                <div id="'.$inputs["id"].'"></div>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery("#'. preg_replace("/([\[\]])/", "\\\\\\\\\${1}", $inputs["id"]).'")
                            .targetContent({
                                "options" : opndr.industries,
                                "selected" : '. json_encode(array_flip($inputs["selected"])) .',
                                "default-selected" : '. json_encode(array_flip($inputs["default-selected"])) .',
                                "input-name-root" : "'.$inputs["id"].'",
                                "uri" : "'.$inputs["uri"].'"
                            });
                    });
                </script>
                
        ';
        
        
    }
    
    
    // --- create_site_name_input :: Get the settings option array and print one of its values
    public function create_add_new_content_targeting_button($inputs = array("id" => "content-target-x", "default-selected" => ""))
    {
        

        echo '
        
                <button class="button button-secondary" id="opendoor-add-content-target">+ Add URL</button>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery("#opendoor-add-content-target")
                            .data("id-root", "'.$inputs["id"].'")
                            .click(function(e) {
				                e.preventDefault();
				                var newContentTarget = jQuery("<div></div>")
				                    .appendTo(jQuery("div.content_targeting_section"));
				                newContentTarget
				                    .targetContent({
                                        "options" : opndr.industries,
                                        "selected" : {},
                                        "default-selected" : '. json_encode(array_flip($inputs["default-selected"])) .',
                                        "input-name-root" : (new Array("'.$inputs["id"].'[", new Date().getTime(), "]")).join(""),
                                        "uri" : ""
                                    });
                				return false;
                			});
                    });
                </script>
                
        ';
        
        
    }
    
    public function create_content_targeting()
    {
        
        
        echo '<div class="content_targeting_section">';
        
        // --- create on page stash of industries...
        $industriesJSON = file_get_contents('http://www.opndr.com/api/getindustrylist');
        
        if(!empty($industriesJSON)){
        
            $industryList = json_decode($industriesJSON);
            echo '<script type="text/javascript">';
            if(
                !empty($industryList->ok)
                &&
                !empty($industryList->ok->industries)
            ){
                echo '  opndr.industries = '. json_encode($industryList->ok->industries) . ';';
            } else {
                echo '  opndr.industries = {};';
            }
            echo '</script>';
            
        }
        
        if(
            !empty($this->options["content_targeting"])
        ){
            
            $currentOptions = $this->options["content_targeting"];
            
            $newIndex = 0;
            foreach($currentOptions as $index => $contentSettingInfo){
                
                $myIdRoot = "publisher_options[content_targeting][".$newIndex."]";
                $mySelected = $contentSettingInfo["indids"];
                $myUri = $contentSettingInfo["uri"];
                
                $this->create_content_targeting_by_uri(array(
                    "id" => $myIdRoot,
                    "uri" => $myUri,
                    "selected" => $mySelected,
                    "default-selected" => array("53081544a328a7.79884436")  // "REAL ESTATE"
                ));
                
                $newIndex++;
                
            }
            
            
        } else {
            
            $newIndex = 0;
            
            $idRoot = "publisher_options[content_targeting][".$newIndex."]";
            
            $this->create_content_targeting_by_uri(array(
                "id" => $idRoot,
                "default-selected" => array("53081544a328a7.79884436")  // "REAL ESTATE"
            ));
            
        }
        
        echo '</div>';
        
        $this->create_add_new_content_targeting_button(array(
            "id" => "publisher_options[content_targeting]",
            "default-selected" => array("53081544a328a7.79884436")  // "REAL ESTATE"
        ));

        
       
    }
    
    
}

if( is_admin() )
    $opendoor_admin = new OpenDoorDispletAdmin();
?>