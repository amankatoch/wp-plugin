<?php 
/**
* Plugin Name: PPRS Email Marketing
* Plugin URI: http://www.esferasoft.com
* Description: This plugin provides a complete email marketing newsletter solution
* Version: 1.0.0
* Author: Raman Jaswal
* Author URI: http://www.facebook.com/raman.jaswal
* License: GPL2
*/

define('PPRS_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('PPRS_PLUGIN_PATH',plugin_dir_path( __FILE__ ));


require_once( PPRS_PLUGIN_PATH . '/classes/pprs-lists-list-table.php' );
require_once( PPRS_PLUGIN_PATH . '/classes/pprs-subscribers-list-table.php' );

add_action( 'init', 'pprs_newsletter_init' );

/**
* Initalize DB
*/
register_activation_hook( __FILE__, 'pprs_install' );
function pprs_install() {
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$table_lists = $wpdb->prefix . 'pprs_newsletter_lists';
	$table_subscribers = $wpdb->prefix . 'pprs_newsletter_subscribers';
	$table_list_subscribers_map = $wpdb->prefix . 'pprs_list_subscriber_map';

	$sql = "CREATE TABLE IF NOT EXISTS $table_lists (
		ID bigint(20) unsigned NOT NULL auto_increment,
		name varchar(50),
		description text,
		subscribers bigint(20),
		updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		added datetime DEFAULT NOW() NOT NULL,
		PRIMARY KEY  (ID)
	) $charset_collate;";
	
	dbDelta( $sql );

	$sql = "CREATE TABLE IF NOT EXISTS $table_subscribers (
		ID bigint(20) unsigned NOT NULL auto_increment,
		email varchar(50),
		fname varchar(50),
		lname varchar(50),
		status varchar(50),
		updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		added datetime DEFAULT NOW() NOT NULL,
		PRIMARY KEY  (ID)
	) $charset_collate;";

	dbDelta( $sql );

	$sql = "CREATE TABLE IF NOT EXISTS $table_list_subscribers_map (
		list_id bigint(20)  unsigned NOT NULL,
		subscriber_id bigint(20) unsigned NOT NULL
	) $charset_collate;";
	dbDelta( $sql );
    
    /**
    *   Default Newsletter Page
    **/
	global $user_ID;
    $newsletter_page = array(
      'post_title'    => 'Newsletter Page',
      'post_content'  => '[pprs_newsletter]',
      'post_status'   => 'publish',
      'post_parent' => 0,
      'post_author' => $user_ID,
      'post_type' => 'page'
    );
    
  $page_id = wp_insert_post( $newsletter_page );

	/**
	* Plugin Default Settings
	**/
	$options = array();

	//-- General
	$options['general'] =  array(
		"from_name" => get_bloginfo('name'),
		"from_address" => get_bloginfo('admin_email'),
		"reply_to_address" => get_bloginfo('admin_email'),
		"send_delay" => "30",
		"post_list_count" => "30"
	);
	$options['frontend'] = array(
	    "newsletter_home" => $page_id,
	    "share_button" => 1,
	    "services" => array( 'twitter','facebook','googleplus' ),
	    "homepageslugs" => array(
            "confirm" => "confirm",
            "subscribe" => "subscribe",
            "unsubscribe" => "unsubscribe",
            "profile" => "profile"
	    ),
	    "use_archive" => ""
	);
	
	$options['subscribers'] = array(
	    "notification" => array(
	            "send_notification" => "",
	            "emails" => get_bloginfo('admin_email')
	        )
	);
	
	$options['texts'] = array(
	    "subscription_form" => array(
	            "confirmation" => "Please confirm your subscription!",
	            "successful" => "Thanks for your interest!",
	            "error_message" => "Following fields are missing or incorrect",
	            "unsubscribe" => "You have successfully unsubscribed!",
	            "unsubscribe_error" => "An error occurred! Please try again later!",
	            "profile_update" => "Profile updated!",
	            "newsletter_signup" => "Sign up to our newsletter"
	        ),
	   "field_labels" => array(
	            "email" => "Email",
	            "first_name" => "First Name",
	            "last_name" => "Last Name",
	            "lists" => "Lists",
	            "submit_button" => "Subscribe",
	            "profile_button" => "Update Profile",
	            "unsubscribe_button" => "Yes, unsubscribe me"
	       ),
	   "mail" => array(
	            "unsubscribe_link" => "unsubscribe",
	            "webversion_link" => "webversion",
	            "forward_link" => "forward to a friend",
	            "profile_link" => "update profile"
	       )
	        
	);
	
	$options['tags'] = array(
	    "permanent_tags" => array(
	            "can_spam" => 'You have received this email because you have subscribed to <a href="{homepage}">{company}</a> as {email}. If you no longer wish to receive emails please {unsub}',
	            "notification" => "If you received this email by mistake, simply delete it. You won't be subscribed if you don't click the confirmation link",
	            "copyright" => "© {year} {company}, All rights reserved",
	            "company" => get_bloginfo("sitename"),
	            "homepage" => get_bloginfo("url")
	        ),
	    "custom_tags" => array(
	            "c" => "Replace Text"
	        ),
	    "special_tags" => array(
	            "cache" => 60
	        )
	);
	
	$options['delivery'] = array(
		"split_campaigns" => 1,
		"pause_campaigns" => 1,
		"time" => 0,
		"test_email" => get_bloginfo("admin_email")
	);

	$options['bouncing'] = array(
			"bounce_address" => get_bloginfo("admin_email")
		);

	add_option( "pprs_options" , $options );

    
}

register_uninstall_hook(__FILE__,'pprs_uninstall');
function pprs_uninstall(){
	global $wpdb;

	$table_name = $wpdb->prefix . 'pprs_newsletter_lists';
	$sql = "DROP TABLE $table_name";
	$wpdb->query($sql);
}


/**
* Register Post type : newsletter
*/
function pprs_newsletter_init() {
    $labels = array(
        'name'               => _x( 'Newsletters', 'post type general name', 'pprs-newsletter' ),
        'singular_name'      => _x( 'Newsletter', 'post type singular name', 'pprs-newsletter' ),
        'menu_name'          => _x( 'Newsletters', 'admin menu', 'pprs-newsletter' ),
        'name_admin_bar'     => _x( 'Newsletter', 'add new on admin bar', 'pprs-newsletter' ),
        'add_new'            => _x( 'New Campaign', 'newsletter', 'pprs-newsletter' ),
        'add_new_item'       => __( 'Add New Campaign', 'pprs-newsletter' ),
        'new_item'           => __( 'New Campaign', 'pprs-newsletter' ),
        'edit_item'          => __( 'Edit Campaign', 'pprs-newsletter' ),
        'view_item'          => __( 'View Campaign', 'pprs-newsletter' ),
        'all_items'          => __( 'All Campaigns', 'pprs-newsletter' ),
        'search_items'       => __( 'Search Campaigns', 'pprs-newsletter' ),
        'parent_item_colon'  => __( 'Parent Campaigns:', 'pprs-newsletter' ),
        'not_found'          => __( 'No campaign found.', 'pprs-newsletter' ),
        'not_found_in_trash' => __( 'No campaigns found in Trash.', 'pprs-newsletter' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'newsletter' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title'),
    );
 
    register_post_type( 'newsletter', $args );
}

/**
* Remove Publish Metabox
*/
function pprs_remove_publish_box() {
    remove_meta_box( 'submitdiv', 'newsletter', 'side' );
}
add_action( 'admin_menu', 'pprs_remove_publish_box' );

/**
*  Add Metaboxes
*/

add_action( 'add_meta_boxes', 'pprs_add_metboxes' );
function pprs_add_metboxes() {

		add_meta_box(
			'pprs_campaign_details',
			__( 'Campaign Details', 'pprs' ),
			'pprs_campign_details',
			'newsletter',
			'normal'
		);

		add_meta_box(
			'pprs_campaign_template',
			__( 'Template', 'pprs' ),
			'pprs_campign_template',
			'newsletter',
			'normal'
		);

		add_meta_box(
			'pprs_campaign_savebox',
			__( 'Save', 'pprs' ),
			'pprs_campign_savebox',
			'newsletter',
			'side'
		);
}

/**
* Metabox Fields
*/
function pprs_campign_details(){

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'pprs_save_campaign_data', 'pprs_campign_details_nonce' );

	/**
	* Get Campaign Details if already saved
	*/

	if(isset($_GET['post'])){
		$campaign_details = get_post_meta($_GET['post'],'_pprs_campaign_details',true);
	}

	$output = '<table class="form-table">';
	$output .= '<tr>
					<th>Subject</th>
					<td><input type="text" name="pprs_campaign[subject]" value="'.$campaign_details['subject'].'" class="widefat" id="pprs_campign_subject" /></td>
				</tr>';
	$output .= '<tr>
					<th>Preheader</th>
					<td><input type="text" name="pprs_campaign[preheader]" value="'.$campaign_details['preheader'].'" class="widefat" id="pprs_campign_preheader" /></td>
				</tr>';
	$output .= '<tr>
					<th>From Name</th>
					<td><input type="text" name="pprs_campaign[fromname]" value="'.$campaign_details['fromname'].'" class="widefat" id="pprs_campign_fromname" /></td>
				</tr>';
	$output .= '<tr>
					<th>From Email</th>
					<td><input type="text" name="pprs_campaign[fromemail]" value="'.$campaign_details['fromemail'].'" class="widefat" id="pprs_campign_fromemail" /></td>
				</tr>';
	$output .= '<tr>
					<th>Reply to Email</th>
					<td><input type="text" name="pprs_campaign[replyto]" value="'.$campaign_details['replyto'].'" class="widefat" id="pprs_campign_replyto" /></td>
				</tr>';

	$output .= '</table>';
	echo $output;
}

/**
* Save Metabox data
*/
function pprs_save_campaign_data( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['pprs_campign_details_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['pprs_campign_details_nonce'], 'pprs_save_campaign_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['newsletter'] ) && 'page' == $_POST['newsletter'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	// Make sure that it is set.
	if ( ! isset( $_POST['pprs_campaign'] ) ) {
		return;
	}

	// Update the meta field in the database.
	update_post_meta( $post_id, '_pprs_campaign_details', $_POST['pprs_campaign'] );

	if(isset($_POST['campaign_template']) && $_POST['template-edited'] == 'true' ){
		update_post_meta( $post_id, '_pprs_campaign_template', $_POST['campaign_template'] );
	}

}
add_action( 'save_post', 'pprs_save_campaign_data' );

/**
* Add Rich Text Editor
*/
add_action('admin_print_scripts', 'pprs_do_jslibs' );
add_action('admin_print_styles', 'pprs_do_css' );

function pprs_do_css()
{
    wp_enqueue_style('thickbox');
    //add_editor_style(PPRS_PLUGIN_URL.'assets/css/editor-style.css');
}

function pprs_do_jslibs()
{
    wp_enqueue_script('editor');
    wp_enqueue_script('thickbox');
    add_action( 'admin_head', 'wp_tiny_mce' );
}

/* Editor Style*/
add_filter( 'mce_css', 'filter_mce_css' );

function filter_mce_css( $mce_css ) {

	$mce_css .= ', ' . PPRS_PLUGIN_URL.'assets/css/editor-style.css';

	return $mce_css;
}

/**/

/**
* Create Template Metabox
*/
function pprs_campign_template(){

	wp_enqueue_script("pprs-scripts",PPRS_PLUGIN_URL . "assets/js/scripts.js");
	wp_enqueue_style("pprs-styles",PPRS_PLUGIN_URL . "assets/css/style.css");

	if(isset($_GET['post'])){
		$campaign_template = get_post_meta($_GET['post'],'_pprs_campaign_template',true);
	}

	//$output .="<button type='button' onclick='export_template()'>Export</button>";
	$output .= '<div id="output-wrapper"><textarea name="campaign_template" id="template-output" style="visibility:hidden;height:0px"></textarea></div>';
	$output .= '<input type="hidden" id="template-edited" name="template-edited" value="false">';
	$output .= '<iframe id="builder-frame" height="500px" onload="iframeLoaded()" scrolling="no" width="100%"" src="'.PPRS_PLUGIN_URL.'inc/template-builder/builder.php?post='.$_GET['post'].'"></iframe>';
	$output .= '<a id="scroll-to" style="display: block;"></a>';
	include( PPRS_PLUGIN_PATH . "inc/template-builder/edit_modules.php" );
	echo $output;
}

/**
* Custom Save Metabox
*/
function pprs_campign_savebox($post, $args = array()){
		global $action;

	$post_type = $post->post_type;
	$post_type_object = get_post_type_object($post_type);
	$can_publish = current_user_can($post_type_object->cap->publish_posts);
?>
<div class="submitbox" id="submitpost">

<?php // Hidden submit button early on so that the browser chooses the right button when form is submitted with Return key ?>
<div style="display:none;">
<?php submit_button( __( 'Save' ), 'button', 'save' ); ?>
</div>

<div id="major-publishing-actions">
<?php
/**
 * Fires at the beginning of the publishing actions section of the Publish meta box.
 *
 * @since 2.7.0
 */
do_action( 'post_submitbox_start' );
?>
<div id="delete-action">
<?php
if ( current_user_can( "delete_post", $post->ID ) ) {
	if ( !EMPTY_TRASH_DAYS )
		$delete_text = __('Delete Permanently');
	else
		$delete_text = __('Move to Trash');
	?>
<a class="submitdelete deletion" href="<?php echo get_delete_post_link($post->ID); ?>"><?php echo $delete_text; ?></a><?php
} ?>
</div>

<div id="publishing-action">
<span class="spinner"></span>
<?php
if ( !in_array( $post->post_status, array('publish', 'future', 'private') ) || 0 == $post->ID ) {
	if ( $can_publish ) :
		if ( !empty($post->post_date_gmt) && time() < strtotime( $post->post_date_gmt . ' +0000' ) ) : ?>
		<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Schedule') ?>" />
		<?php submit_button( __( 'Schedule' ), 'primary button-large', 'publish', false ); ?>
<?php	else : ?>
		<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Publish') ?>" />
		<?php submit_button( __( 'Save' ), 'primary button-large', 'publish', false ); ?>
<?php	endif;
	else : ?>
		<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Submit for Review') ?>" />
		<?php submit_button( __( 'Submit for Review' ), 'primary button-large', 'publish', false ); ?>
<?php
	endif;
} else { ?>
		<input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Update') ?>" />
		<input name="save" type="submit" class="button button-primary button-large" id="publish" value="<?php esc_attr_e( 'Update' ) ?>" />
<?php
} ?>
</div>
<div class="clear"></div>
</div>
</div>

<?php
}

/**
* Customize List Campaigns page
*/
add_filter( 'manage_edit-newsletter_columns', 'pprs_newletter_columns' );

function pprs_newletter_columns( $columns ) 
{
    $columns['title'] = 'Name'; //Rename Title
    unset($columns['date']); //Remove Date

    //Add new columns
    $columns['status'] = 'Status';
    $columns['total'] = 'Total';
    $columns['open'] = 'Open';
    $columns['clicks'] = 'Clicks';
    $columns['unsubscribe'] = 'Unsubscribe';
    $columns['bounces'] = 'Bounces';

    return $columns;
}
add_filter('post_row_actions','pprs_newsletter_action_row', 10, 2);

function pprs_newsletter_action_row($actions, $post){
    //check if post type is newsletter
    if ($post->post_type =="newsletter"){

        unset($actions['inline hide-if-no-js']); //Remove Quick Edit
        unset($actions['trash']); //Remove Trash
    }
    return $actions;
}

/*Enable Editor Support*/
add_action('admin_print_scripts', 'do_jslibs' );
add_action('admin_print_styles', 'do_css' );

function do_css()
{
    wp_enqueue_style('thickbox');
}

function do_jslibs()
{
    wp_enqueue_script('editor');
    wp_enqueue_script('thickbox');

    wp_enqueue_media();
    
    add_action( 'admin_head', 'wp_tiny_mce' );

}

add_action( 'manage_posts_custom_column', 'pprs_fill_columns' );
function pprs_fill_columns($column) {
	global $post;
	switch($column) {
		case 'status' :
			echo get_post_status($post->ID);
		break;
		case 'total':
			echo 'total';
		break;
		case 'open':
			echo 'opens';
		break;
		case 'clicks':
			echo 'clicks';
		break;
		case 'unsubscribe':
			echo 'unsubscribes';
		break;
		case 'bounces':
			echo 'bounces';
		break;
	}
}

/**
* Create sub menus of Newsletter Menu
*/

add_action('admin_menu', 'pprs_submenu_page_lists');

function pprs_submenu_page_lists() {
	//-- Lists
	add_submenu_page( 'edit.php?post_type=newsletter', 'Lists', 'Lists', 'manage_options', 'pprs_lists', 'pprs_submenu_lists' );

	//-- Subscriibers
	add_submenu_page( 'edit.php?post_type=newsletter', 'Subscribers', 'Subscribers', 'manage_options', 'pprs_subscribers', 'pprs_submenu_subscribers' );

	//--Setiings
    add_options_page("Newsletters Settings" ,"Newsletters", "manage_options", "newsletters", "pprs_newsleeters_settings" );
}

// Lists - List Page Output
function pprs_submenu_lists(){
	if(!isset($_GET['new'])){
		echo '<div class="wrap">
						<h2>Lists
							<a href="'.admin_url("edit.php?post_type=newsletter&page=pprs_lists&new").'" class="page-title-action">Add New List</a>
						</h2>';
		echo '<form action="" method="POST">';
		$listsListTable = new PPRS_Lists_List_Table(); 
		 
		$listsListTable->prepare_items();
		$listsListTable->display();
		echo "</form>";
		echo "</div>";

	}else{
		?> 
		<div class="wrap">
			<h2>Add New List</h2>
			<form action="" method="POST">
				<table class="form-table" style="max-width:80%">

					<tr>
						<th>Name</th>
						<td><input type="text" name="pprs_list[name]" value="" class="widefat" id="pprs_list_name"></td>
					</tr>

					<tr>
						<th>Description</th>
						<td><textarea name="pprs_list[description]" class="widefat" id="pprs_list_description" rows=4></textarea></td>
					</tr>

					<tr>
						<th></th>
						<td>
						<input type="hidden" name="pprs_submit_form" value="list" />
						<input type="submit" class="button button-primary button-large" value="Save" name="save" /></td>
					</tr>

				</table>

			</form>
		</div>
	<?php }
}

function pprs_submenu_subscribers(){

	if(!isset($_GET['new'])){
		echo '<div class="wrap">
						<h2>Subscribers
							<a href="'.admin_url("edit.php?post_type=newsletter&page=pprs_subscribers&new").'" class="page-title-action">Add New Subscriber</a>
						</h2>';
		echo '<form action="" method="POST">';
		$subscribersListTable = new PPRS_Subscribers_List_Table(); 
		 
		$subscribersListTable->prepare_items();
		$subscribersListTable->display();
		echo "</form>";
		echo "</div>";
	}else{

		$listsListTable = new PPRS_Lists_List_Table();
		$lists = $listsListTable->get_lists();

		?> 
		<div class="wrap">
			<style type="text/css">
				.widefat{
					padding: 10px;
				}
				.pprs-cols-2 {
				    margin: 10px 0;
				}

				.pprs-cols-2 > input {
				    display: inline-block;
				    width: 49.7%;
				}

				.pprs-cols-2 > label {
				    display: block;
				    margin-bottom: 2px;
				}
			</style>
			<h2>Add New Subscriber</h2>
			<form action="" method="POST">
				<table class="form-table" style="max-width:80%">

					<tr>
						<td width="160" valign="top" style="vertical-align:top">
							<img id="subscriber-avatar" src="http://www.gravatar.com/avatar/?s=160" alt="avatar" />
						</td>
						<td valign="top" style="vertical-align:top">
							<div>
								<input type="email" placeholder="Email" name="pprs_subscriber[email]" value="" class="widefat" id="pprs_list_email">
							</div>
							<div class="pprs-cols-2">
								<label><strong>Name</strong></label>
								<input type="text" placeholder="First Name" name="pprs_subscriber[fname]" value="" class="widefat" id="pprs_list_fname">
								<input type="text" placeholder="Last Name" name="pprs_subscriber[lname]" value="" class="widefat" id="pprs_list_lname">
							</div>
							<div style="clear:both;"></div>
							<div>
								<select name="pprs_subscriber[status]" id="pprs_list_status">
									<option value="0">pending</option>
									<option value="1">subscriberd</option>
									<option value="2">unsubscribed</option>
									<option value="3">hardbounce</option>
								</select>
							</div>
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<label><strong>Lists</strong></label>
							<?php if(count($lists) == 0): ?>
								<div style="color:#f00">No List Created. You can create one <a href="<?php echo admin_url('edit.php?post_type=newsletter&page=pprs_lists&new'); ?>">here</a></div>
							<?php endif; ?>
							<?php foreach($lists as $list): ?>
								<div>
									<label><input type="checkbox" name="pprs_subscriber[lists][]" value="<?php echo $list->ID; ?>"><?php echo $list->name; ?></label>
								</div>
							<?php endforeach ?>

						</td>
					</tr>

					<tr>
						<td></td>
						<td>
						<input type="hidden" name="pprs_submit_form" value="subscribe" />
						<input type="submit" class="button button-primary button-large" value="Save" name="save" /></td>
					</tr>

				</table>

			</form>
			<script>
			jQuery(document).ready(function($){
				$('#pprs_list_email').blur(function(){

					var email = $(this).val();
					$.ajax({
						url: ajaxurl,
						data: { 'action' : 'get_subscriber_avatar', 'email': email },
						method: 'POST',
						success: function(image){
							$('#subscriber-avatar').attr('src',image);
						}
					});

				});

			});
			</script>
		</div>
	<?php }
}

add_action( 'wp_ajax_get_subscriber_avatar', 'get_subscriber_avatar' );
function get_subscriber_avatar(){
	$email = trim( $_POST['email'] );
	$email = strtolower( $email );
	echo "http://www.gravatar.com/avatar/" . md5( $email ) . "?s=160";
	die();
}

function my_admin_notice() {
    if(isset($_GET['success']) && $_GET['success'] == 1){
    ?>
    <div class="updated">
        <p><?php _e( 'List Added', 'pprs-text-domain' ); ?></p>
    </div>
    <?php
	}
}
add_action( 'admin_notices', 'my_admin_notice' );

function pprs_process_forms(){

	global $wpdb;

	//-- Save List
	if(isset($_POST['pprs_submit_form']) && $_POST['pprs_submit_form'] == 'list' ) {
		$data = $_POST['pprs_list'];

		$sql = "INSERT INTO {$wpdb->prefix}pprs_newsletter_lists SET 
				name = '{$data['name']}',
				description = '{$data['description']}',
				subscribers = 0
			";
		if($wpdb->query($sql)){
			 wp_redirect( admin_url('edit.php?post_type=newsletter&page=pprs_lists&s') ); exit;
		}

	}

	//-- Save Subscribers
	if(isset($_POST['pprs_submit_form']) && $_POST['pprs_submit_form'] == 'subscribe' ) {
		$data = $_POST['pprs_subscriber'];

		$sql = "INSERT INTO {$wpdb->prefix}pprs_newsletter_subscribers SET 
				email = '{$data['email']}',
				fname = '{$data['fname']}',
				lname = '{$data['lname']}',
				status = '{$data['status']}'
			";

		if($wpdb->query($sql)){
			$subscriber_id = $wpdb->insert_id;

			foreach($data['lists'] as $list_id){
				$sql = "INSERT INTO {$wpdb->prefix}pprs_list_subscriber_map SET 
					list_id = '{$list_id}',
					subscriber_id = '{$subscriber_id}'
				";
				$wpdb->query($sql);
			}
			wp_redirect( admin_url('edit.php?post_type=newsletter&page=pprs_subscribers&s') ); exit;
		}

	}

}

add_action( 'init', 'pprs_process_forms' );

add_action( 'admin_init', 'register_pprs_options' );
function register_pprs_options(){
	register_setting( 'pprs-newsletters-options', 'pprs_options' );
}

function pprs_newsleeters_settings(){ 

       // $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : "general";  
	?>
	<div class="wrap">

		<h1>Newsletter Settings</h1>
		<?php settings_errors(); 
         
		?> 
         <div id="tabs">
         <h2 class="nav-tab-wrapper">  
         	<ul>
            <li><a href="#General" class="nav-tab">General</a>  </li>
            <li> <a href="#Frontend" class="nav-tab">Frontend</a></li> 
            <li><a href="#Subscribers" class="nav-tab">Subscribers</a>  </li>
        	<li><a href="#Users" class="nav-tab">Users</a></li>
        	<li><a href="#Texts" class="nav-tab">Texts</a></li>
        	<li><a href="#Tags" class="nav-tab">Tags</a></li>
        	<li><a href="#Delivery" class="nav-tab">Delivery</a></li>
        	<li><a href="#Bouncing" class="nav-tab">Bouncing</a></li>
        </ul>
      </h2>
    
        	<!--<a href="?page=newsletters&tab=authentication" class="nav-tab <?php //echo $active_tab == 'authentication' ? 'nav-tab-active' : ''; ?>">Authentication</a>
        </h2>   -->
    	<style type="text/css">
			.form-table-inner td{
				padding: 0;
			}
			.info{
				font-weight: normal;
				color: #666;
				font-size: 12px;
				font-style: italic;
			}
			p.submit{
				padding:0;
				margin: 0 !important;
			}
			.ui-state-default.ui-corner-top {
              display: inline;
             }
		</style>
		<form action="options.php" method="POST">
	        
	        <?php settings_fields( 'pprs-newsletters-options' ); 
	        	do_settings_sections( 'pprs-newsletters-options' );
	        	$options = get_option('pprs_options');
	        	?>
	        	<div id="General">
	        		<table class="form-table">
	        			<tr>
	        				<th><label for="pprs_options_fromname">From Name *</label></th>
	        				<td><input type="text" name="pprs_options[general][from_name]" value="<?php echo $options['general']['from_name']; ?>" id="pprs_options_from_name" class="regular-text" />&nbsp;&nbsp;<span class="info">The sender name which is displayed in the from field</span></td>
	        			</tr>
	        			<tr>
	        				<th><label for="">From Address *</label></th>
	        				<td><input type="text" name="pprs_options[general][from_address]" value="<?php echo $options['general']['from_address']; ?>" id="pprs_options_from_address" class="regular-text" />&nbsp;&nbsp;<span class="info">The sender email address.</span></td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Reply to Address *</label></th>
	        				<td><input type="text" name="pprs_options[general][reply_to_address]" value="<?php echo $options['general']['reply_to_address']; ?>" id="pprs_options_reply_to_address" class="regular-text" />&nbsp;&nbsp;<span class="info">The address users can reply to</span></td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Send delay *</label></th>
	        				<td><input type="text" name="pprs_options[general][send_delay]" value="<?php echo $options['general']['send_delay'] ?>" id="pprs_options_send_delay" class="small-text" />&nbsp;&nbsp;<span class="info"> The default delay in minutes for sending campaigns.</span></td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Deliver by Time Zone *</label></th>
	        				<td>
	        					<input type="checkbox" name="pprs_options[general][deliver_timezone]" id="pprs_options_deliver_timezone" value="1" <?php if($options['general']['deliver_timezone'] == 1){ echo "checked"; } ?> />
	        					Send Campaigns based on the subscribers timezone if known
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Embed Images *</label></th>
	        				<td>
	        					<input type="checkbox" name="pprs_options[general][embed_images]" id="deliver_timezone_embed_images" value="1" <?php if($options['general']['embed_images'] == 1){ echo "checked"; } ?> />
	        					Embed images in the mail
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Post List Count</label></th>
	        				<td><input type="text" name="pprs_options[general][post_list_count]" value="<?php echo $options['general']['post_list_count'] ?>" id="pprs_options_post_list_count" class="small-text" />&nbsp;&nbsp;<span class="info">Number of posts or images displayed at once in the editbar.</span></td>
	        			</tr>
	        			<tr>
	        				<td></td>
	        				
	        			</tr>
	        			<tr>
	        				<td style="padding-top:30px;" colspan="2"><span class="info">* can be changed in each campaign</span></td>
	        			</tr>
	        		</table>
	        		</div>
	        		<div id="Frontend">
	        			<table class="form-table">
	      				<tr>
	        				<th><label for="">Newsletter Homepage</label></th>
	        				<td>
	        				    <?php 
	        				        $pages = get_posts(array(
	        				                'post_type' => 'page',
	        				                'posts_per_page' => -1
	        				            ));
	        				    ?>
	        					<select type="text" name="pprs_options[frontend][newsletter_home]" id="pprs_newsletter_home" >
	        						<option value="">--select--</option>
	        						<?php foreach($pages as $page): ?>
	        						    <option value="<?php echo $page->ID; ?>" <?php if($options['frontend']['newsletter_home'] == $page->ID){ echo "selected"; } ?>><?php echo $page->post_title; ?></option>
	        						<?php endforeach; ?>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Share Button</label></th>
	        				<td>
	        					<input type="checkbox" name="pprs_options[frontend][share_button]" id="pprs_options_share_button" value="1" <?php if( $options['frontend']['share_button'] == 1 ){ echo "checked"; } ?> />
	        					Offer share option for your customers
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Services</label></th>
	        				<td>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="twitter" <?php if(in_array('twitter',$options['frontend']['services'])){ echo "checked"; } ?> /> Twitter <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="facebook" <?php if(in_array('facebook',$options['frontend']['services'])){ echo "checked"; } ?> /> Facebook <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="googleplus" <?php if(in_array('googleplus',$options['frontend']['services'])){ echo "checked"; } ?> /> Google+ <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="googlebookmarks" <?php if(in_array('googlebookmarks',$options['frontend']['services'])){ echo "checked"; } ?> /> Google Bookmarks <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="pinterest" <?php if(in_array('pinterest',$options['frontend']['services'])){ echo "checked"; } ?> /> Pinterest <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="delicious" <?php if(in_array('delicious',$options['frontend']['services'])){ echo "checked"; } ?> /> Delicious <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="blogger" <?php if(in_array('blogger',$options['frontend']['services'])){ echo "checked"; } ?> /> Blogger <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="sharethis" <?php if(in_array('sharethis',$options['frontend']['services'])){ echo "checked"; } ?> /> ShareThis <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="reddit" <?php if(in_array('reddit',$options['frontend']['services'])){ echo "checked"; } ?> /> Reddit <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="digg" <?php if(in_array('digg',$options['frontend']['services'])){ echo "checked"; } ?> /> Digg <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="evernote" <?php if(in_array('evernote',$options['frontend']['services'])){ echo "checked"; } ?> /> Evernote <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="stubleupon" <?php if(in_array('stubleupon',$options['frontend']['services'])){ echo "checked"; } ?> /> StumbleUpon <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="linkedin" <?php if(in_array('linkedin',$options['frontend']['services'])){ echo "checked"; } ?> /> LinkedIn <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="xing" <?php if(in_array('xing',$options['frontend']['services'])){ echo "checked"; } ?> /> Xing <br/>
	        					<input type="checkbox" name="pprs_options[frontend][services][]" value="yahoo" <?php if(in_array('yahoo',$options['frontend']['services'])){ echo "checked"; } ?> /> Yahoo! <br/>
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Homepage Slugs</label></th>
	        				<td>
	        					<div style="margin-bottom:5px">
	        						Confirm Slug:<br/>
	        						<input type="text" name="pprs_options[frontend][homepageslugs][confirm]" value="<?php echo $options['frontend']['homepageslugs']['confirm']; ?>" id="pprs_options_services_confirm" />
	        					</div>
	        					<div style="margin-bottom:5px">
	        						Subscribe Slug:<br/>
	        						<input type="text" name="pprs_options[frontend][homepageslugs][subscribe]" value="<?php echo $options['frontend']['homepageslugs']['subscribe']; ?>" id="pprs_options_services_subscribe" />
	        					</div>
	        					<div style="margin-bottom:5px">
	        						Unsubscribe Slug:<br/>
	        						<input type="text" name="pprs_options[frontend][homepageslugs][unsubscribe]" value="<?php echo $options['frontend']['homepageslugs']['unsubscribe']; ?>" id="pprs_options_services_unsubscribe" />
	        					</div>
	        					<div style="margin-bottom:5px">
	        						Profile Slug:<br/>
	        						<input type="text" name="pprs_options[frontend][homepageslugs][profile]" value="<?php echo $options['frontend']['homepageslugs']['profile']; ?>" id="pprs_options_services_profile" />
	        					</div>
	        					
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Use Archive</label></th>
	        				<td>
	        					<input type="checkbox" name="pprs_options[frontend][use_archive]" id="pprs_options_usearchive" value="1" <?php if($options['frontend']['use_archive']){ echo "checked"; } ?> />
	        					enable archive function to display your newsletters in a reverse chronological order
	        				</td>
	        			</tr>
	        			<tr>
	        				<td></td>
	        				
	        			</tr>
	        		</table>
	        		</div>

	        		<div id="Subscribers">
                     <table class="form-table">
	        			<tr>
	        				<th><label for="">Notification</label></th>
	        				<td><input type="checkbox" name="pprs_options[subscribers][notification][send_notification]" value="1" <?php if($options['subscribers']['notification']['send_notification'] == 1){ echo "checked"; } ?> /> Send a notification of new subscribers to following receivers (comma separated)<br/>
	        				<input type="text" name="pprs_options[subscribers][notification]" value="<?php echo $options['subscribers']['notification']['emails']; ?>" class="regular-text">
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Custom Fields:</label><br/>
	        				<span class="info">Custom field tags are individual tags for each subscriber. You can ask for them on subscription and/or make it a required field.</span></th>
	        				<td>
	        					<button type="button" value="add" class="button">Add</button>
	        				</td>
	        			</tr>
	        		</table>
	        		</div>
	        		
	        		<div id="Users">
	        		</div>

                     <div id="Texts">
                     	<table class="form-table">
	        			<tr>
	        				<th><label for="">Subscription Form</label><br/>
	        				<span class="info">Define messages for the subscription form..</span></th>
	        				<td>
	        					       					    		
	        						<tr>
	        							<td width="150"><label for="">Confirmation:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][subscription_form][confirmation]" value="<?php echo $options['texts']['subscription_form']['confirmation'];  ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Successful:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][subscription_form][successful]" value="<?php echo $options['texts']['subscription_form']['successful'];  ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Error Message:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][subscription_form][error_message]" value="<?php echo $options['texts']['subscription_form']['error_message'];  ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Unsubscribe:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][subscription_form][unsubscribe]" value="<?php echo $options['texts']['subscription_form']['unsubscribe'];  ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Unsubscribe Error:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][subscription_form][unsubscribe_error]" value="<?php echo $options['texts']['subscription_form']['unsubscribe_error'];  ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Profile Update:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][subscription_form][profile_update]" value="<?php echo $options['texts']['subscription_form']['profile_update'];  ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Newsletter Sign up:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][subscription_form][newsletter_signup]" value="<?php echo $options['texts']['subscription_form']['newsletter_signup']; ?>" /></td>
	        						</tr>
	        					
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Field Labels</label><br/>
	        				<span class="info">Define texts for the labels of forms. Custom field labels can be defined on the Subscribers tab</span></th>
	        				<td>
	        					<table class="form-table-inner">
	        						<tr>
	        							<td width="150"><label for="">Email:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][field_labels][email]" value="<?php echo $options["texts"]["field_labels"]["email"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">First Name:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][field_labels][first_name]" value="<?php echo $options["texts"]["field_labels"]["first_name"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Last Name:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][field_labels][last_name]" value="<?php echo $options["texts"]["field_labels"]["last_name"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Lists:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][field_labels][lists]" value="<?php echo $options["texts"]["field_labels"]["lists"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Submit Button:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][field_labels][submit_button]" value="<?php echo $options["texts"]["field_labels"]["submit_button"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Profile Button:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][field_labels][profile_button]" value="<?php echo $options["texts"]["field_labels"]["profile_button"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Unsubscribe Button:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][field_labels][unsubscribe_button]" value="<?php echo $options["texts"]["field_labels"]["unsubscribe_button"]; ?>" /></td>
	        						</tr>
	        					</table>
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Mail</label><br/>
	        				<span class="info">Define texts for the mails</span></th>
	        				<td>
	        					<table class="form-table-inner">
	        						<tr>
	        							<td width="150"><label for="">Unsubscribe Link:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][mail][unsubscribe_link]" value="<?php echo $options["texts"]["mail"]["unsubscribe_link"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Webversion Link:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][mail][webversion_link]" value="<?php echo $options["texts"]["mail"]["webversion_link"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Forward Link:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][mail][forward_link]" value="<?php echo $options["texts"]["mail"]["forward_link"]; ?>" /></td>
	        						</tr>
	        						<tr>
	        							<td><label for="">Profile Link:</label></td>
	        							<td><input type="text" class="regular-text" name="pprs_options[texts][mail][profile_link]" value="<?php echo $options["texts"]["mail"]["profile_link"]; ?>" /></td>
	        						</tr>        						
	        					</table>
	        				</td>
	        			</tr>
	        		</table>
	        		</div>
	        		<div id="Tags">
	        			<table class="form-table">
	        			<tr>
	        				<td colspan="2"><span class="info">Tags are placeholder for your newsletter. You can set them anywhere in your newsletter template with the format <code>{tagname}</code>. Custom field tags are induvidual for each subscriber.</span><br/>
	        				<span class="info">You can set alternative content with <code>{tagname|alternative content}</code> which will be uses if <code>[tagname]</code> is not defined. All unused tags will get removed in the final message</span></td>
	        			</tr>
	        			<tr>
	        				<td colspan="2"><span class="info">reserved tags: <code>{unsub}</code>, <code>{unsublink}</code>, <code>{webversion}</code>, <code>{webversionlink}</code>, <code>{forward}</code>, <code>{forwardlink}</code>, <code>{subject}</code>, <code>{preheader}</code>, <code>{profile}</code>, <code>{profilelink}</code>, <code>{headline}</code>, <code>{content}</code>, <code>{link}</code>, <code>{email}</code>, <code>{emailaddress}</code>, <code>{firstname}</code>, <code>{lastname}</code>, <code>{fullname}</code>, <code>{year}</code>, <code>{month}</code>, <code>{day}</code>, <code>{share}</code>, <code>{tweet}</code></span></td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Permanent Tags</label></th>
	        				<td>
	        					<span class="info">These are permanent tags which cannot get deleted. The CAN-SPAM tag is required in many countries.</span>
	        					<div style="margin-bottom:5px;">
		        					<code>{can-spam}</code><br/>
		        					<input type="text" name="pprs_options[tags][permanent_tags][can_spam]" class="widefat" value="<?php echo $options['tags']['permanent_tags']['can_spam']; ?>">
	        					</div>
	        					<div style="margin-bottom:5px;">
		        					<code>{notification}</code><br/>
		        					<input type="text" name="pprs_options[tags][permanent_tags][notification]" class="widefat" value="<?php echo $options['tags']['permanent_tags']['notification']; ?>">
	        					</div>
	        					<div style="margin-bottom:5px;">
		        					<code>{copyright}</code><br/>
		        					<input type="text" name="pprs_options[tags][permanent_tags][copyright]" class="widefat" value="<?php echo $options['tags']['permanent_tags']['copyright']; ?>">
	        					</div>
	        					<div style="margin-bottom:5px;">
		        					<code>{company}</code><br/>
		        					<input type="text" name="pprs_options[tags][permanent_tags][company]" class="widefat" value="<?php echo $options['tags']['permanent_tags']['company']; ?>">
	        					</div>
	        					<div style="margin-bottom:5px;">
		        					<code>{homepage}</code><br/>
		        					<input type="text" name="pprs_options[tags][permanent_tags][homepage]" class="widefat" value="<?php echo $options['tags']['permanent_tags']['homepage']; ?>">
	        					</div>
	        				</td>

	        			</tr>
	        			<tr>
	        				<th><label for="">Custom Tags:</label></th>
	        				<td>
	        					<span class="info">Add your custom tags here. They work like permanent tags</span><br/>
	        					<div class="customtag">
	        				 		<?php foreach($options['tags']['custom_tags'] as $tag=>$vaue): ?>
	        							<code>{<?php echo $tag; ?>}</code><br/>
	        							<input type="text" name="pprs_options[tags][custom_tags][<?php echo $tag; ?>]" class="regular-text" value="<?php echo $value; ?>">
	        						<?php endforeach; ?>        						
	        					</div>
	        					<?php
                                  
	        					?>
	        					<button type="button" class="button" id="add-ctag">Add</button>
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Special Tags:</label></th>
	        				<td>
	        					<span class="info">Special tags display dynamic content and are equally for all subscribers</span><br/>
	        					<code>{tweet:username}</code> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        					<span class="info">displays the last tweet from Twitter user [username]</span><br/>
								<div style="margin:8px 0;">
								<span>(cache it for <input type="text" name="pprs_options[tags][special_tags][cache]" class="small-text" value="<?php echo $options['tags']['special_tags']['cache'] ?>"> minutes)</span>
								</div>
								<span class="info">To enable the tweet feature you have to create a new Twitter App and insert your credentials</span>
								<table class="form-table-inner">
									<tr>
										<td><label for="">Access token:</label></td>
										<td><input type="text" name="pprs_options[tags][special_tags][access_token]" class="regular-text" value="<?php echo $options['tags']['special_tags']['access_token'] ?>"></td>
									</tr>
									<tr>
										<td><label for="">Access token Secret:</label></td>
										<td><input type="text" name="pprs_options[tags][special_tags][secret]" class="regular-text" value="<?php echo $options['tags']['special_tags']['secret'] ?>"></td>
									</tr>
									<tr>
										<td><label for="">Consumer Key:</label></td>
										<td><input type="text" name="pprs_options[tags][special_tags][consumer_key]" class="regular-text" value="<?php echo $options['tags']['special_tags']['consumer_key'] ?>"></td>
									</tr>
									<tr>
										<td><label for="">Consumer Secret:</label></td>
										<td><input type="text" name="pprs_options[tags][special_tags][consumer_secret]" class="regular-text" value="<?php echo $options['tags']['special_tags']['consumer_secret'] ?>"></td>
									</tr>
									</table>
									<div style="margin:10px 0">
										<div style="margin-bottom:5px">
											<code>{share:twitter}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays button to share the newsletter via Twitter
										</div>
										<div style="margin-bottom:5px">
											<code>{share:facebbok}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays button to share the newsletter via Facebook
										</div>
										<div style="margin-bottom:5px">
											<code>{share:google}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays button to share the newsletter via Google+
										</div>
										<div style="margin-bottom:5px">
											<code>{share:linkedin}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays button to share the newsletter via LinkedIn
										</div>
									</div>
								
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Dynamic Tags</label></th>
	        				<td>
	        					<span class="info">Dynamic tags let you display your posts or pages in a reverse chronicle order. Some examples:</span>
	        					<div style="margin:10px 0">
									<div style="margin-bottom:5px">
										<code>{post_title:-1}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the latest post title
									</div>
									<div style="margin-bottom:5px">
										<code>{page_title:-4}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the fourth latest page title
									</div>
									<div style="margin-bottom:5px">
										<code>{post_image:-1}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the feature image of the latest posts
									</div>
									<div style="margin-bottom:5px">
										<code>{post_image:-4|23}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the feature image of the fourth latest posts. 
										<div style="margin:5px 0;"><span>Uses the image with ID 23 if the post doesn't have a feature image</span></div>
									</div>
								</div>
	        					<div style="margin:10px 0">
									<div style="margin-bottom:5px">
										<code>{post_content:-1}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the latest post title
									</div>
									<div style="margin-bottom:5px">
										<code>{post_excerpt:-1}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the fourth latest page title
									</div>
									<div style="margin-bottom:5px">
										<code>{post_date:-1}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the latest posts date
									</div>
									<div style="margin-bottom:5px">
										<code>{post_title:23}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the post title of post ID 23
									</div>
									<div style="margin-bottom:5px">
										<code>{post_link:15}</code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;displays the permalink of post ID 15
									</div>
								</div>
								<span class="info">Instead of "post_" and "page_" you can use custom post types too</span>
	        				</td>
	        			</tr>
	        		</table>
	        		</div>
	        		<div id="Delivery">
                      <table class="form-table">
	        			<tr>
	        				<th><label for="">Number of mails sent</label></th>
	        				<td>
	        					Send max <strong>20</strong> emails at once and max <strong>1000</strong> within <strong>24</strong> hours
	        				</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Split campaigns</label></th>
	        				<td><input type="checkbox" name="pprs_options[delivery][split_campaigns]" value="1" <?php if($options['delivery']['split_campaigns'] == 1){ echo "checked"; } ?>> send campaigns simultaneously instead of one after the other</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Pause campaigns</label></th>
	        				<td><input type="checkbox" name="pprs_options[delivery][pause_campaigns]" value="1" <?php if($options['delivery']['pause_campaigns'] ==1){ echo "checked"; } ?>> pause campaigns if an error occursr</td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Time between mails</label></th>
	        				<td><input type="textbox" class="small-text" name="pprs_options[delivery][time]" value="<?php echo $options['delivery']['time']; ?>"> milliseconds<br/>
	        				<span class="info">define a delay between mails in milliseconds if you have problems with sending two many mails at once</span></td>
	        			</tr>
	        			<tr>
	        				<th><label for="">Send test email with current settings</label></th>
	        				<td><input type="email" class="text" name="pprs_options[delivery][test_email]" value="<?php echo $options['delivery']['test_email']; ?>">&nbsp;<button type="button" class="button">Send Test</button><br/>
	        				<span class="info">You have to save your settings before you can test them!</span></td>
	        			</tr>
	        		</table>
	        		</div>
	        		
	        		<div id="Bouncing">
                     <table class="form-table">
	        			<tr>
	        				<th><label for="">Bounce Address</label></th>
	        				<td><input type="text" name="pprs_options[bouncing][bounce_address]" value="<?php echo $options['bouncing']['bounce_address']  ?>" class="regular-text" /> <span>Undeliverable emails will return to this address</span></td>
	        			</tr>

	                  </table>
	        		</div>
	        		
	        <?php submit_button(); ?>
	    </form>
 
      <!-- test tabs -->
     
   
    
      <!-- end -->


	</div>
</div>

 <script>

         
          jQuery( "#tabs" ).tabs();
        
         </script>
<?php
}