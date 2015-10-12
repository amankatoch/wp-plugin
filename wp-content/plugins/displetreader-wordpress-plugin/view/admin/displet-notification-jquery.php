<script>
jQuery(document).ready(function($){
	$('#toplevel_page_displettools-uid-slug').pointer({
		content: '<?php echo addslashes($model["message"]); ?>',
		position: {
			edge: 'left',
			align: 'center'
		},
		close: function() {
			var data = {
				action: 'displet_update_notify_version_request',
				_ajax_nonce: '<?php echo wp_create_nonce("displet_update_notify_version_nonce"); ?>',
				version: '<?php echo $model["version"]; ?>'
			};
			$.post(ajaxurl, data);
		}
	}).pointer('open');
});
</script>