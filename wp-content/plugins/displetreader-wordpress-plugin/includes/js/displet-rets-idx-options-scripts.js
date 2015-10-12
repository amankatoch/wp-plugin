(function(displetretsidxoptions, $, undefined) {
	function init(){
		create_tabs();
		add_color_picker_binding();
		add_thickbox_image_upload_binding();
		hide_explicit_content();
		highlight_errors();
	}

	function add_color_picker_binding() {
		$('#displet-rets-idx-options .displet-color-picker').wpColorPicker();
	}

	function add_thickbox_image_upload_binding() {
		var _custom_media = true;
		var _orig_send_attachment = wp.media.editor.send.attachment;
		$('#disclaimer_image-upload, #disclaimer_image-display').click(function(e) {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			_custom_media = true;
			wp.media.editor.send.attachment = function(props, attachment){
				if ( _custom_media ) {
					$('#disclaimer_image').val(attachment.url);
    				$('#disclaimer_image-display').css('background-image', 'url(' + attachment.url + ')');
    				$('#disclaimer_image-display').show();
				}
				else {
					return _orig_send_attachment.apply( this, [props, attachment] );
		    	};
			}
			wp.media.editor.open($(this));
			return false;
		});
		$('.add_media').on('click', function(){
			_custom_media = false;
		});
	}

	function create_tabs() {
		$('#displet-rets-idx-options .displet-tabbed').prev('h3').hide();
		if (window.location.hash && $('#displet-rets-idx-options .displet-tabbed').filter(window.location.hash).length) {
			go_to_tab(window.location.hash);
		}
		else {
			$('#displet-rets-idx-options .displet-tabbed').hide().first().show();
			$('#displet-rets-idx-options .displet-tabs a').first().addClass('nav-tab-active')
		}
		$('#displet-rets-idx-options .displet-tabs a').click(function(ev){
			ev.preventDefault();
			if (!$(this).hasClass('nav-tab-active')) {
				window.location.hash = $(this).attr('href');
				go_to_tab($(this).attr('href'));
			}
			return false;
		});
	}

	function go_to_tab(id) {
		$('#displet-rets-idx-options .displet-tabbed').hide().filter(id).show();
		$('#displet-rets-idx-options .displet-tabs .nav-tab-active').removeClass('nav-tab-active');
		$('#displet-rets-idx-options .displet-tabs a').filter(function(){
			if ($(this).attr('href') === id) {
				return true;
			}
			return false;
		}).addClass('nav-tab-active');
	}

	function hide_explicit_content() {
		$('#displet-rets-idx-options .displet-explicit-text').hide();
		$('#displet-rets-idx-options .displet-explicit-text-toggle').click(function(){
			var text = $(this).parent('div').parent('td').children('.displet-explicit-text');
			if (text.is(':visible')) {
				$(this).text('Explicit Content - Click to Show');
				text.hide();
			}
			else {
				$(this).text('Explicit Content - Click to Hide');
				text.show();
			}
		});
	}

	function highlight_errors() {
		var error_messages = $('#displet-rets-idx-options .displet-messages .settings-error');
		if (error_messages.length) {
			var first = true;
			var tab_id = false;
			error_messages.each(function() {
				var error_setting = $(this).attr('id').replace('setting-error-', '');
				$('label[for="' + error_setting + '"]').addClass('displet-error');
				var input = $('input[id="' + error_setting + '"]');
				input.addClass('displet-error');
				if (first) {
					tab_id = input.parents('.displet-tabbed').attr('id');
					first = false;
				}
			});
			if (tab_id) {
				go_to_tab('#' + tab_id);
			}
		}
	}

	$(document).ready(function(){
		init();
	});
}(window.displetretsidxoptions = window.displetretsidxoptions || {}, jQuery));