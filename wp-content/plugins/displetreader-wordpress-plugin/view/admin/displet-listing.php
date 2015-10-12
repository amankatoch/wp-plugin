<?php
	include_once( dirname(__FILE__) . '/../../../../../wp-load.php' );
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	global $displetretsidx_option;
	$model = array(
		'options' => $displetretsidx_option,
		'field_options' => DispletRetsIdxOptionsController::get_option('fields')
	);
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Displet RETS/IDX Listing Criteria
	</title>
	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('displetreader-wordpress-plugin/includes/css/displet-rets-idx-admin-styles.css'); ?>"/>
	<script>
		var displetretsidx_admin = {
			first_city: '<?php if ( !empty( $model["field_options"]["city"][0] ) ) echo $model["field_options"]["city"][0]; ?>',
			images: {
				close: '<?php echo plugins_url("displetreader-wordpress-plugin/includes/css/images/close.png"); ?>',
				close_hover: '<?php echo plugins_url("displetreader-wordpress-plugin/includes/css/images/close_hover.png"); ?>',
			},
			options: {
				use_polygon_search: <?php echo !empty( $model['options']['use_polygon_search'] ) ? 'true' : 'false'; ?>,
			},
		};
	</script>
	<script src="<?php echo includes_url('js/jquery/jquery.js'); ?>"></script>
	<script src="<?php echo includes_url('js/tinymce/tiny_mce_popup.js'); ?>"></script>
	<script src="http://maps.googleapis.com/maps/api/js?libraries=drawing&sensor=false"></script>
	<script src="../../includes/js/displet-rets-idx-admin-scripts.js"></script>
	<script src="../../includes/js/displet-listing.js"></script>
</head>
<body id="displet-listing" class="displet-admin">
	<form>
		<?php
			echo DispletRetsIdxTemplatesController::get_admin_template('options.php', $model);
			echo DispletRetsIdxTemplatesController::get_admin_template('criteria.php', $model);
		?>
		<div class="mceActionPanel">
			<button id="insert" type="submit">Save</button>
			<button id="cancel">Cancel</button>
		</div>
	</form>
</body>
</div>
</html>