(function(displetretsidx_admin, $, undefined) {
	var displet_listing_property_showcase_fields = [
		'caption',
		'layout',
		'listings',
		'minListPrice',
		'maxListPrice',
		'maxBathrooms',
		'maxBedrooms',
		'maxSquareFeet',
		'minBathrooms',
		'minBedrooms',
		'minSquareFeet',
		'subdivision',
		'zip',
	];

	function init() {
		set_selectors();
		if (displetretsidx_admin.pages) {
			if (displetretsidx_admin.pages.is_lead_manager_page) {
				lead_manager_init();
			}
			else if (displetretsidx_admin.pages.is_search_forms_page) {
				search_forms_init();
			}
			else if (displetretsidx_admin.pages.is_add_user_page) {
				populate_user_role_select_from_hash();
			}
		}
		agent_profile_init();
		$(document).trigger('displetretsidx_admin_init');
	}

	/*********************
	General
	*********************/

	function create_tabs(scope) {
		if (window.location.hash && $('.displet-tabbed', scope).filter(window.location.hash).length) {
			go_to_tab(window.location.hash, scope);
		}
		else {
			$('.displet-tabbed', scope).hide().first().show();
			$('.displet-tabs a', scope).first().addClass('nav-tab-active')
		}
		$(scope).delegate('.displet-tabs a', 'click', function(ev){
			ev.preventDefault();
			if (!$(this).hasClass('nav-tab-active')) {
				window.location.hash = $(this).attr('href');
				go_to_tab($(this).attr('href'), scope);
			}
			return false;
		});
	}

	function go_to_tab(id, scope) {
		$('.displet-tabbed', scope).hide().filter(id).show();
		$('.displet-tabs .nav-tab-active', scope).removeClass('nav-tab-active');
		$('.displet-tabs a', scope).filter(function(){
			if ($(this).attr('href') === id) {
				return true;
			}
			return false;
		}).addClass('nav-tab-active');
	}

	function set_selectors() {
		displetretsidx_admin.element = {};
	}

	/*********************
	Displet Listing Dialog
	*********************/

	function add_drawing_manager_binding() {
		displetretsidx_admin.polygon_options = {
			fillColor: '#f00',
			fillOpacity: .3,
			strokeColor: '#f00',
			strokeOpacity: .8,
			strokeWeight: 1,
			editable: true,
		};
		displetretsidx_admin.drawing_manager = new google.maps.drawing.DrawingManager({
			drawingControlOptions: {
				drawingModes: [
					google.maps.drawing.OverlayType.POLYGON,
				],
			},
			polygonOptions: displetretsidx_admin.polygon_options,
		});
		if (displetretsidx_admin.drawing_manager) {
			displetretsidx_admin.drawing_manager.setMap(displetretsidx_admin.map);
		}
	}

	function add_get_listing_agent_binding() {
		$('#displet-listing .displet-get-listing-agent-id').click(function(){
			var mls = $('#displet-listing input[name="criteria[mls_number]"]').val();
			if (mls) {
				var data = {
					action: 'displet_get_agent_id_request',
					_ajax_nonce: displetretsidx_get_agent_id_nonce,
					mls_number: mls
				};
				$.post(displetretsidx_ajax_url, data, function(response){
					if (response == 'Failed') {
						alert('There was an error processing your request. Please try again or try a different MLS number.');
					}
					else{
						$('#displet-listing input[name="criteria[listing_agent_id]"]').val(response);
						$('#displet-listing input[name="criteria[mls_number]"]').removeClass('displet-error');
						$('#displet-listing input[name="criteria[mls_number]"]').val('');
					}
				});
			}
			else{
				$('#displet-listing input[name="criteria[mls_number]"]').addClass('displet-error');
				alert('Please enter a MLS number to check the agent id of.');
			}
		});
	}

	function add_get_listing_office_binding() {
		$('#displet-listing .displet-get-listing-office-id').click(function(){
			var mls = $('#displet-listing input[name="criteria[mls_number]"]').val();
			if (mls) {
				var data = {
					action: 'displet_get_office_id_request',
					_ajax_nonce: displetretsidx_get_office_id_nonce,
					mls_number: mls
				};
				$.post(displetretsidx_ajax_url, data, function(response){
					if (response == 'Failed') {
						alert('There was an error processing your request. Please try again or try a different MLS number.');
					}
					else{
						$('#displet-listing input[name="criteria[listing_office_id]"]').val(response);
						$('#displet-listing input[name="criteria[mls_number]"]').removeClass('displet-error');
						$('#displet-listing input[name="criteria[mls_number]"]').val('');
					}
				});
			}
			else{
				$('#displet-listing input[name="criteria[mls_number]"]').addClass('displet-error');
				alert('Please enter a MLS number to check the office id of.');
			}
		});
	}

	function add_layout_binding() {
		update_orientation_from_layout(displetretsidx_admin.element.layout_select.val());
		displetretsidx_admin.element.layout_select.bind('change', function(){
			update_orientation_from_layout(this.value);
		});
	}

	function add_map_polygon(polygon) {
		remove_map_polygon();
		displetretsidx_admin.polygon = polygon;
		displetretsidx_admin.polygon_lat_longs = displetretsidx_admin.polygon.getPath().getArray();
		set_polygon_value();
		add_map_polygon_close_button();
		google.maps.event.addListener(displetretsidx_admin.polygon.getPath(), 'set_at', reposition_map_polygon_close_button);
		google.maps.event.addListener(displetretsidx_admin.polygon.getPath(), 'insert_at', reposition_map_polygon_close_button);
		displetretsidx_admin.drawing_manager.setOptions({
			drawingMode: null,
		});
	}

	function add_map_polygon_binding() {
		if (displetretsidx_admin.drawing_manager) {
			google.maps.event.addListener(displetretsidx_admin.drawing_manager, 'overlaycomplete', function(event) {
				add_map_polygon(event.overlay);
			});
		}
	}

	function add_map_polygon_close_button() {
		if (displetretsidx_admin.polygon_lat_longs && $.isArray(displetretsidx_admin.polygon_lat_longs)) {
			displetretsidx_admin.polygon_close_button = new google.maps.Marker({
				position: displetretsidx_admin.polygon_lat_longs[0],
				map: displetretsidx_admin.map,
				icon: {
					anchor: new google.maps.Point(10, 26),
					url: displetretsidx_admin.images.close,
				},
				zIndex: 2222,
  			});
  			google.maps.event.addListener(displetretsidx_admin.polygon_close_button, 'click', remove_map_polygon);
  			google.maps.event.addListener(displetretsidx_admin.polygon_close_button, 'mouseover', function(){
  				displetretsidx_admin.polygon_close_button.setIcon({
					anchor: new google.maps.Point(10, 26),
					url: displetretsidx_admin.images.close_hover,
				});
  			});
  			google.maps.event.addListener(displetretsidx_admin.polygon_close_button, 'mouseout', function(){
  				displetretsidx_admin.polygon_close_button.setIcon({
					anchor: new google.maps.Point(10, 26),
					url: displetretsidx_admin.images.close,
				});
  			});
		}
	}

	function add_property_showcase_binding() {
		$('#displet-listing select[name="criteria[listings]"]').change(function(){
			if (this.value && this.value === 'showcase') {
				$('#displet-listing input, #displet-listing select').each(function(){
					var field = this.name.match(/\[([^\]]+)\]/);
					if (field && field[1]) {
						if (displet_listing_property_showcase_fields.indexOf(field[1]) === -1) {
							$(this).prop('disabled', 'disabled').addClass('displet-showcase-disabled');
							$(this).parent('td').prev('th').addClass('displet-showcase-disabled');
						}
					}
				});
			}
			else {
				$('#displet-listing .displet-showcase-disabled').each(function(){
					$(this).removeClass('displet-showcase-disabled');
					if ($(this).is('select, input') && !$(this).hasClass('idxonly')) {
						$(this).prop('disabled', false);
					}
				});
			}
		});
	}

	function create_displet_listing_tabs() {
		$('#displet-listing .displet-section').hide().first().show();
		$('#displet-listing .displet-tabs a').click(function(ev){
			ev.preventDefault();
			if (!$(this).hasClass('displet-active')) {
				var id = $(this).attr('href');
				$('#displet-listing .displet-tabs .displet-active').removeClass('displet-active');
				$(this).addClass('displet-active');
				$('#displet-listing .displet-section').hide().filter(id).show();
				if (id === '#map') {
					var center = displetretsidx_admin.map.getCenter();
					google.maps.event.trigger(displetretsidx_admin.map, 'resize');
					displetretsidx_admin.map.setCenter(center);
				}
			}
			return false;
		});
	}

	function geocode_location(location){
		var geocoder = new google.maps.Geocoder()
    	geocoder.geocode({'address': location}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				 displetretsidx_admin.map.setCenter(results[0].geometry.location);
			}
    	});
	}

	displetretsidx_admin.init_displet_listing_dialog = function() {
		console.log('aaa');
		create_displet_listing_tabs();
		set_displet_listing_selectors();
		add_layout_binding();
		add_get_listing_agent_binding();
		add_get_listing_office_binding();
		add_property_showcase_binding();
		maybe_init_map();
	}

	function maybe_draw_polygon() {
		if (displetretsidx_admin.initial_polygon_coordinates) {
			var poly_paths = [];
			for (var i = 0; i < displetretsidx_admin.initial_polygon_coordinates.length; i++) {
				var lat_long = displetretsidx_admin.initial_polygon_coordinates[i].replace('+', ' ').split(' ');
				var g_lat_long = new google.maps.LatLng(parseFloat(lat_long[1]), parseFloat(lat_long[0]));
				poly_paths.push(g_lat_long);
			};
			displetretsidx_admin.polygon_options.paths = poly_paths;
  			var polygon = new google.maps.Polygon(displetretsidx_admin.polygon_options);
  			polygon.setMap(displetretsidx_admin.map);
  			add_map_polygon(polygon);
		}
	}

	function maybe_init_map() {
		if (displetretsidx_admin.options.use_polygon_search) {
			maybe_set_initial_polygon_value();
			set_map();
			add_drawing_manager_binding();
			add_map_polygon_binding();
			maybe_draw_polygon();
		}
	}

	function maybe_set_initial_polygon_value() {
		var poly_val = displetretsidx_admin.element.polygon_input.val();
		if (poly_val) {
			displetretsidx_admin.initial_polygon_coordinates = poly_val.split(',');
		}
	}

	function remove_map_polygon() {
		remove_polygon_value();
		if (displetretsidx_admin.polygon) {
			displetretsidx_admin.polygon.setMap(null);
		}
		remove_map_polygon_close_button();
	}

	function remove_map_polygon_close_button() {
		if (displetretsidx_admin.polygon_close_button) {
			displetretsidx_admin.polygon_close_button.setMap(null);
		}
	}

	function remove_polygon_value() {
		displetretsidx_admin.element.polygon_input.val('');
	}

  	function reposition_map_polygon_close_button(index) {
  		remove_map_polygon_close_button();
  		displetretsidx_admin.polygon_lat_longs = this.getArray();
		set_polygon_value();
  		add_map_polygon_close_button();
	}

	function set_displet_listing_selectors() {
		displetretsidx_admin.element.polygon_input = $('#displet-listing input[name="criteria[poly]"]');
		displetretsidx_admin.element.layout_select = $('#displet-listing select[name="criteria[layout]"]');
		displetretsidx_admin.element.orientation_select = $('#displet-listing select[name="criteria[orientation]"]');
		displetretsidx_admin.element.orientation_label = $('#displet-listing .orientation');
	}

	function set_map() {
		if (displetretsidx_admin.initial_polygon_coordinates) {
			var lat_long = displetretsidx_admin.initial_polygon_coordinates[0].replace('+', ' ').split(' ');
			var map_center = new google.maps.LatLng(lat_long[1], lat_long[0]);
		}
		else {
			if (displetretsidx_admin.first_city) {
				geocode_location(displetretsidx_admin.first_city);
			}
			var map_center = new google.maps.LatLng(38.8833, -77.0167);
		}
		displetretsidx_admin.map = new google.maps.Map($('#displet-map-canvas')[0], {
			zoom: 11,
			center: map_center,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});
	}

	function set_polygon_value() {
		if (displetretsidx_admin.polygon_lat_longs.length) {
			var locations = [];
			for (var i = 0; i < displetretsidx_admin.polygon_lat_longs.length; i++) {
				locations.push(displetretsidx_admin.polygon_lat_longs[i].lng() + ' ' + displetretsidx_admin.polygon_lat_longs[i].lat());
			};
			locations.push(displetretsidx_admin.polygon_lat_longs[0].lng() + ' ' + displetretsidx_admin.polygon_lat_longs[0].lat());
			var poly = locations.join(',');
			displetretsidx_admin.element.polygon_input.val(poly);
		}
	}

	function update_orientation_from_layout(value) {
		if (value === 'table') {
			displetretsidx_admin.element.orientation_select.hide();
			displetretsidx_admin.element.orientation_label.hide();
		}
		else {
			displetretsidx_admin.element.orientation_select.show();
			displetretsidx_admin.element.orientation_label.show();
		}
	}

	/*********************
	Lead Manager Page
	*********************/

	function lead_manager_init() {
		create_tabs('#displet-lead-manager');
		add_lead_assignation_binding();
		$('#displet-lead-manager .displet-leads .displet-lead .displet-user').click(function(){
			var id = $(this).attr('id');
			if ($('#displet-lead-manager .displet-leads .displet-lead-details.' + id).is(':visible')){
				$('#displet-lead-manager .displet-leads .displet-lead-details.' + id).fadeOut();
			}
			else{
				$('#displet-lead-manager .displet-leads .displet-lead-details.' + id).fadeIn();
			}
		});
		$('#displet_delete_selected_users').click(function(){
			var users_array = new Array();
			$('#displet-lead-manager .displet-leads input:checked').each(function(){
				users_array.push($(this).attr('id'))
			});
			if (users_array.length) {
				var confirm = window.confirm('Are you sure you wish to delete the selected users?');
				if (confirm == true){
					var data = {
					    action: 'displet_delete_users_request',
					    _ajax_nonce: displetretsidx_delete_users_nonce,
					    displet_users: users_array,
					};
					$.post(ajaxurl, data, function(response) {
						if (response != 'Succesful Deletion') {
							alert(response);
						}
						window.location.reload();
					});
				}
			}
			else{
				alert('No user has been selected.');
			}
		});
		$("#displet-lead-manager #logged_in_since").datepicker({dateFormat: 'mm/dd/yy'});
	}

	function add_lead_assignation_binding() {
		$('#displet_reassign_selected_users').click(function(){
			var users_array = [];
			$('#displet-lead-manager .displet-leads input:checked').each(function(){
				users_array.push($(this).attr('id'))
			});
			if (users_array.length) {
				var confirm = window.confirm('Are you sure you wish to reassign the selected users?');
				if (confirm == true){
					var agent_id = $('#displet_assigned_agent').val();
					var lender_id = $('#displet_assigned_lender').val();
					if (agent_id || lender_id) {
						var data = {
						    action: 'displet_reassign_users_request',
						    _ajax_nonce: displetretsidx_reassign_users_nonce,
						    displet_users: users_array,
						    displet_agent: agent_id,
						    displet_lender: lender_id,
						};
						$.post(ajaxurl, data, function(response) {
							if (response != 'Succesful Assignation') {
								alert(response);
							}
							window.location.reload();
						});
					}
					else {
						alert('Select an agent or lender to be assigned to the selected lead(s).');
					}
				}
			}
			else{
				alert('No user has been selected.');
			}
		});
	}

	/*********************
	Search Forms Page
	*********************/

	function search_forms_init() {
		create_tabs('#displet-search-forms');
		set_search_forms_selectors();
		set_search_forms_vars();
		set_search_forms_new_content();
		add_search_field_delete_binding();
		add_search_field_label_input_binding();
		add_search_field_type_select_binding();
		add_search_field_toggle_binding();
		add_search_form_column_delete_binding();
		add_search_form_column_sortable_binding();
		add_new_search_field_binding();
		add_new_search_form_column_binding();
		add_new_quick_search_binding();
	}

	function add_new_quick_search_binding() {
		displetretsidx_admin.element.add_quick_search.unbind('click').click(function(ev){
			ev.preventDefault();
			var search_forms = $('#displet-search-forms form .displet-search-form');
			var search_forms_count = search_forms.length;
			var form_id = search_forms_count;
			for (var i = 3; i < search_forms_count; i++) {
				if (!search_forms.filter('[for="' + i + '"]').length) {
					var form_id = i;
				}
			};
			var quick_search_id = form_id - 3;
			if (search_forms_count !== form_id) {
				var tab_after_new_tab = $('#displet-search-forms .displet-tabs a').filter('[href="#quick_search_' + (quick_search_id + 1) + '"]');
				console.log(tab_after_new_tab);
			}
			if (search_forms_count === form_id || !tab_after_new_tab.length) {
				var tab_after_new_tab = $('#displet-search-forms .displet-tabs a').last();
			}
			tab_after_new_tab.before('<a href="#quick_search_' + quick_search_id + '" class="nav-tab">Quick Search ' + quick_search_id + '</a>');
			$('#displet-search-forms form .submit').before(displetretsidx_admin.new_search_form_html.replace('quick_search_W', 'quick_search_' + quick_search_id).replace('Displet Quick Search W', 'Displet Quick Search ' + quick_search_id).replace('id="W"', 'id="' + quick_search_id + '"').replace('for="X"', 'for="' + form_id + '"'));
			return false;
		});
	}

	function add_new_search_field_binding() {
		$('#displet-search-forms').delegate('.displet-add-field', 'click', function(){
			var table = $(this).parents('table');
			displetretsidx_admin.fields_count++;
			table.find('.displet-sortable').first().append(displetretsidx_admin.new_search_field_html.replace(/\[X\]\[Y\]\[Z\]/g, '[' + table.attr('for') + '][0][' + displetretsidx_admin.fields_count + ']'));
		});
	}

	function add_new_search_form_column_binding() {
		$('#displet-search-forms').delegate('.displet-add-column', 'click', function(){
			var table = $(this).parents('table');
			var columns_count = table.find('td').not('.displet-add').length;
			var add_el = table.find('.displet-add');
			add_el.first().before('<th><span>Column ' + (columns_count + 1) + '</span> | <a class="displet-delete" href="javascript:;" for="' + columns_count + '">Delete</a></th>');
			add_el.last().before('<td for="' + columns_count + '"><div class="displet-sortable"></div></td>');
			add_search_form_column_sortable_binding();
		});
	}

	function add_search_field_delete_binding() {
		$('#displet-search-forms').delegate('.displet-search-field .displet-delete', 'click', function(){
			$(this).parents('.displet-search-field').remove();
		});
	}

	function add_search_field_label_input_binding() {
		$('#displet-search-forms').delegate('.displet-search-field .displet-label input', 'change paste keyup', function(){
			$(this).parents('.displet-search-field').find('h4 span').text(this.value);
		});
	}

	function add_search_field_type_select_binding() {
		$('#displet-search-forms').delegate('.displet-search-field .displet-field select', 'change', function(){
			var selected_option = $(this).children('option:selected');
			var value = selected_option.val();
			var text = selected_option.text().trim();
			var search_field = $(this).parents('.displet-search-field');
			var label_p = search_field.find('.displet-label');
			var label = $(label_p).children('input');
			var fieldset = search_field.find('fieldset');
			var options_p = search_field.find('.displet-options');
			var options = options_p.find('select');
			var min_p = search_field.find('.displet-min');
			var min = min_p.find('input');
			var max_p = search_field.find('.displet-max');
			var max = max_p.find('input');
			var increment_p = search_field.find('.displet-increment');
			var increment = increment_p.find('input');
			var range_p = search_field.find('.displet-range');
			var range = range_p.find('textarea');
			var lease_max_p = search_field.find('.displet-lease-max');
			var lease_max = lease_max_p.find('input');
			var sale_min_p = search_field.find('.displet-sale-min');
			var sale_min = sale_min_p.find('input');
			if (displetretsidx_admin.search_fields) {
				if (!displetretsidx_admin.search_fields[value] || !displetretsidx_admin.search_fields[value].label) {
					$(label_p).slideUp();
					label.val(text);
					search_field.find('h4 span').text(text);
				}
				else{
					$(label).val(displetretsidx_admin.search_fields[value].label);
					search_field.find('h4 span').text(displetretsidx_admin.search_fields[value].label);
					$(label_p).slideDown();
				}
				if (!displetretsidx_admin.search_fields[value] || (!displetretsidx_admin.search_fields[value].range && !displetretsidx_admin.search_fields[value].options) ) {
					$(fieldset).slideUp();
					options.val('');
					min.val('');
					max.val('');
					increment.val('');
					range.val('');
				}
				else{
					if (displetretsidx_admin.search_fields[value].options) {
						var options_html = '';
						$(displetretsidx_admin.search_fields[value].options).each(function(){
							options_html += '<option value="' + this + '">' + this + '</option>';
						});
						options.html(options_html);
						options.val(displetretsidx_admin.search_fields[value].options);
						options_p.show();
					}
					else {
						options_p.hide();
						options.html('<option value="" selected="selected"></option>');
						options.val('');
					}
					if (displetretsidx_admin.search_fields[value].range && displetretsidx_admin.search_fields[value].range.min) {
						min.val(displetretsidx_admin.search_fields[value].range.min);
						min_p.show();
					}
					else {
						min_p.hide();
						min.val('');
					}
					if (displetretsidx_admin.search_fields[value].range && displetretsidx_admin.search_fields[value].range.max) {
						max.val(displetretsidx_admin.search_fields[value].range.max);
						max_p.show();
					}
					else {
						max_p.hide();
						max.val('');
					}
					if (displetretsidx_admin.search_fields[value].range && displetretsidx_admin.search_fields[value].range.increment) {
						increment.val(displetretsidx_admin.search_fields[value].range.increment);
						increment_p.show();
					}
					else {
						increment_p.hide();
						increment.val('');
					}
					if (displetretsidx_admin.search_fields[value].range && displetretsidx_admin.search_fields[value].range.custom) {
						range_p.show();
					}
					else {
						range_p.hide();
						range.val('');
					}
					if (displetretsidx_admin.search_fields[value].range && displetretsidx_admin.search_fields[value].range.lease_max) {
						lease_max_p.show();
					}
					else {
						lease_max_p.hide();
						lease_max.val('');
					}
					if (displetretsidx_admin.search_fields[value].range && displetretsidx_admin.search_fields[value].range.sale_min) {
						sale_min_p.show();
					}
					else {
						sale_min_p.hide();
						sale_min.val('');
					}
					fieldset.slideDown();
				}
			}
		});
	}

	function add_search_field_toggle_binding() {
		$('#displet-search-forms').delegate('.displet-search-field .displet-toggle-content, .displet-search-field .displet-close', 'click', function(){
			var content = $(this).parents('.displet-search-field').children('.displet-content');
			if (content.is(':visible')) {
				content.slideUp(200);
			}
			else {
				content.slideDown(200);
			}
		});
	}

	function add_search_form_column_delete_binding() {
		$('#displet-search-forms').delegate('th .displet-delete', 'click', function(){
			var table = $(this).parents('table');
			table.find('td[for="' + $(this).attr('for') + '"]').remove();
			$(this).parents('th').remove();
			renumber_search_form_columns(table);
			renumber_search_field_columns(table);
		});
	}

	function add_search_form_column_sortable_binding() {
		$('#displet-search-forms .displet-sortable').sortable({
			connectWith: '#displet-search-forms .displet-sortable',
			over: function(event, ui) {
				ui.placeholder.height('45px');
			},
			receive: function(event, ui) {
				var form_index = $(event.target).parents('table').attr('for');
				var column_index = $(event.target).parents('td').attr('for');
				var label_value = ui.item.find('.displet-label input').val();
				var field_value = ui.item.find('.displet-field select').val();
				var options_value = ui.item.find('.displet-options select').val();
				var min_value = ui.item.find('.displet-min input').val();
				var max_value = ui.item.find('.displet-max input').val();
				var increment_value = ui.item.find('.displet-increment input').val();
				var range_value = ui.item.find('.displet-range textarea').val();
				ui.item.html(ui.item.html().replace(/\[\d+\]\[\d+\]\[(\d+)\]/g, '[' + form_index + '][' + column_index + '][$1]'));
				ui.item.find('.displet-label input').val(label_value);
				ui.item.find('.displet-field option[value="' + field_value + '"]').attr('selected', 'selected');
				ui.item.find('.displet-options select').val(options_value);
				ui.item.find('.displet-min input').val(min_value);
				ui.item.find('.displet-max input').val(max_value);
				ui.item.find('.displet-increment input').val(increment_value);
				ui.item.find('.displet-range textarea').val(range_value);
			},
			start: function(event, ui) {
				ui.item.find('.displet-content').hide();
				ui.placeholder.height('45px');
			}
		});
	}

	function renumber_search_field_columns(table) {
		table.find('.displet-search-field input, .displet-search-field select').each(function(){
			var column_index = $(this).parents('td').attr('for');
			var name = $(this).attr('name');
			$(this).attr('name', name.replace(/\[(\d+)\]\[\d+\]\[(\d+)\]/, '[$1][' + column_index + "][$2]"));
		});
	}

	function renumber_search_form_columns(table) {
		var i = 0;
		table.find('th').not('.displet-add').each(function(){
			if (i > 0) {
				var delete_el = $(this).find('.displet-delete');
				if (parseInt(delete_el.attr('for')) !== i) {
					delete_el.attr('for', i);
					$(this).find('span').text('Column ' + (i + 1));
				}
			}
			i++;
		});
		var i = 0;
		table.find('td').not('.displet-add').each(function(){
			if (i > 0) {
				if (parseInt($(this).attr('for')) !== i) {
					$(this).attr('for', i);
				}
			}
			i++;
		});
	}

	function set_search_forms_new_content() {
		displetretsidx_admin.new_search_field_html = displetretsidx_admin.element.new_search_field.html();
		displetretsidx_admin.new_search_form_html = displetretsidx_admin.element.new_search_form.html();
	}

	function set_search_forms_selectors() {
		displetretsidx_admin.element.add_quick_search = $('#displet-search-forms .displet-add-quick-search');
		displetretsidx_admin.element.new_search_field = $('#displet-search-forms .displet-search-field-placeholder');
		displetretsidx_admin.element.new_search_form = $('#displet-search-forms .displet-search-form-placeholder');
	}

	function set_search_forms_vars() {
		displetretsidx_admin.fields_count = $('#displet-search-forms .displet-search-field').length - 1;
	}

	/*********************
	Agent Profile Page
	*********************/

	function agent_profile_init() {
		if ($('#profile-page').length) {
			add_thickbox_image_upload_binding();
		}
	}

	function add_thickbox_image_upload_binding() {
		var _custom_media = true;
		var _orig_send_attachment = wp.media.editor.send.attachment;
		$('#displetretsidx_agent_headshot_url-upload, #displetretsidx_agent_headshot_url-display').click(function(e) {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			_custom_media = true;
			wp.media.editor.send.attachment = function(props, attachment){
				if ( _custom_media ) {
					$('#displetretsidx_agent_headshot_url').val(attachment.url);
    				$('#displetretsidx_agent_headshot_url-display').css('background-image', 'url(' + attachment.url + ')');
    				$('#displetretsidx_agent_headshot_url-display').show();
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

	/*********************
	Add User Page
	*********************/

	function populate_user_role_select_from_hash() {
		if (window.location.hash) {
			var hash_array = window.location.hash.replace('#', '').split('/');
			for (var i = hash_array.length - 1; i >= 0; i--) {
				var current_hash = hash_array[i].split('=');
				if (current_hash[0] != undefined && current_hash[0] == 'role'){
					$('#createuser select#role option[value=' + current_hash[1] + ']').attr('selected', true);
				}
			}
		}
	}

	$(document).ready(function(){
		init();
	});
}(window.displetretsidx_admin = window.displetretsidx_admin || {}, jQuery));

/*********************
Lead Manager Single
*********************/

jQuery(document).ready(function($){
	$('#displet-lead-manager-single .toggle-div-div').click(function(){
		var all = $(this).parent('div').children('div');
		if (all.is(':visible')) {
			all.hide();
			$(this).text('View All');
		}
		else {
			all.show();
			$(this).text('View Less');
		}
	});
});

/*********************
Saved Searches Page
*********************/

jQuery(document).ready(function($){
	$('#displet_delete_selected_saved_searches').click(function(){
		var searches_array = [];
		$('.displet-saved-searches-page table input:checked').each(function(){
			searches_array.push($(this).attr('name'));
		});
		if (searches_array.length) {
			var confirm = window.confirm('Are you sure you wish to delete the selected saved searches?');
			if (confirm == true){
				var data = {
				    action: 'displet_delete_searches_request',
				    _ajax_nonce: displetretsidx_admin.nonces.delete_search,
				    api_search_ids: searches_array,
				};
				$.post(ajaxurl, data, function(response) {
					if (response == 'Succesful Deletion') {
						window.location.reload();
					}
					else {
						alert(response);
						window.location.reload();
					}
				});
			}
		}
		else{
			alert('No saved search has been selected.');
		}
	});
});

// DispletReader Widget Config
;(function ($) { if (typeof($.widget) !== 'undefined') {
	// widget to attach to all div.displet-widget-configure
	$.widget('displetreader.widget_config', {
		'options': {
			'dialog_options': {
				'minWidth': 668,
				'minHeight': 358,
				'buttons': [{
					'text': 'Save',
					'click': function () {
						var $form = $('form', this);
						$form.trigger('submit');
						$(this).dialog('close');
					}
				}],
				'autoOpen': false,
				'create': function () {
					// hack so css scope works
					$(this).closest('.ui-dialog').wrap('<div id="displet-sidescroller" class="displet-admin"/>');
					$(document).bind('displetretsidx_admin_init', function(){
						displetretsidx_admin.init_displet_listing_dialog();
					});
				}
			},
			'markup_selector': '.displet-widget-control-markup',
			'tabs_selector': '.ui-tabs',
			'config_button_selector': 'button.displet-widget-configure',
			'options_input_selector': '.displet-widget-control-settings'
		},

		'_create': function () {
			var $this = $(this);
			var that = this;
			var o = this.options;
			var el = this.element;

			this.options_input = $(o.options_input_selector, el);
			this.wp_widget_form = $(el).closest('.widget-inside').find('form');

			this.$dialog = $(this._decode_html()).dialog(o.dialog_options);

			this.form = $('form', this.$dialog);

			$(o.tabs_selector, this.$dialog).tabs();

			$(o.config_button_selector, el).bind('click', function (ev) {
				that.$dialog.dialog('open');
				ev.preventDefault();
				return false;
			});

			this.form.bind('submit', function (ev) {
				that.save_settings($(this).serializeArray());
				ev.preventDefault();
				ev.stopPropagation();
				return false;
			});

			this._find_title();
		},

		'_init': function () {
			this.wp_widget_settings = this.options_input.val();
			this.populate();
			this._find_title();
		},

		'_find_title': function () {
			var title = $(this.element).closest('.widget').find('h4').text();
			if (title !== null) {
				this.$dialog.dialog('option', 'title', title);
			}
		},

		'_decode_html': function () {
			var encoded_html = $(this.options.markup_selector, this.element).html();
			var decoded_html = $('<div id="displet-sidescroller" class="displet-admin"/>').html(encoded_html).text();
			return decoded_html;
		},

		'populate': function () {
			var that = this;

			if (this.wp_widget_settings != '') {
				var data = this.parse_uri(this.wp_widget_settings);

				$.each(data, function (i, v) {
					$(':input[name="' + this.name + '"]', that.form).val(this.value);
				});
			}
		},

		'parse_uri': function (uri) {
			var array = uri.split('&');
			var data = [];
			$.each(array, function (i, v) {
				var input = v.split('=');
				data.push({
					'name': unescape(input[0]),
					'value': unescape(input[1])
				});
			});

			return data;
		},

		'save_settings': function (data) {
			var filtered = [];

			$.each(data, function (i, v) {
				if (this.value !== '') {
					filtered.push({
						'name': this.name,
						'value': this.value
					});
				}
			});
			this.options_input.val($.param(filtered));

			$('input.widget-control-save', this.wp_widget_form).click();
		},

		'destroy': function () {
			$.Widget.prototype.destroy.apply(this, arguments);
			this.$dialog.dialog('destroy');
		}
	});

	// document.ready, attach
	$(function () {
		var widgets_right = $('div#widgets-right');

		// attach widget instances on page load
		$('div.displet-widget-control', widgets_right).widget_config();

		// listen for dragstop on ui-draggables
		$('.ui-draggable').live('dragstop', function (ev, ui) {
			$('div.displet-widget-control', widgets_right).widget_config();
		});

		// wp replaces node on submit, listen for it
		$(widgets_right).ajaxStop(function () {
			$('div.displet-widget-control', widgets_right).widget_config();
			displetretsidx_admin.init_displet_listing_dialog();
		});
	});
}})(jQuery);