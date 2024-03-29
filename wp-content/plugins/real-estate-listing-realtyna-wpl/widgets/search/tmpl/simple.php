<?php
defined('_WPLEXEC') or die('Restricted access');

/** add Layout js **/
$js[] = (object) array('param1'=>'jquery.checkbox', 'param2'=>'packages/jquery.ui/checkbox/jquery.checkbox.js');
foreach($js as $javascript) wpl_extensions::import_javascript($javascript);

$bott_div_open = false;
?>
<form action="<?php echo wpl_property::get_property_listing_link(); ?>" id="wpl_search_form_<?php echo $widget_id; ?>" method="GET" onsubmit="return wpl_do_search_<?php echo $widget_id; ?>();" class="wpl_search_from_box simple clearfix wpl_search_kind<?php echo $this->kind; ?>">
    <!-- Do not change the ID -->
    <div id="wpl_searchwidget_<?php echo $widget_id; ?>" class="clearfix">
	    <div class="wpl_search_from">
	    	<?php
                foreach($this->rendered as $data)
                {
                    echo '<div class="wpl_search_feilds '.$data['field_data']['type'].'">'.$data['html'].'</div>';
                }
            ?>
	    	<div class="search_submit_box">
		    	<input id="wpl_search_widget_submit<?php echo $widget_id; ?>" class="wpl_search_widget_submit" type="submit" value="<?php echo __('Search', WPL_TEXTDOMAIN); ?>" />
		    </div>
	    </div>
	</div>
</form>
<?php include _wpl_import('widgets.search.scripts.js', true, true); ?>