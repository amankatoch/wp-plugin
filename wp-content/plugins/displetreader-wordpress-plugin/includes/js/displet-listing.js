;(function ($, popup) {
	$(function () {
		var plugin = popup.editor.plugins.DispletListing;
		var $form = $('form');
		var orientation = false;
		var order;
		if (typeof(plugin._current) !== 'undefined' && typeof(plugin._current.attrs) !== 'undefined') {
			$.each(plugin._current.attrs, function (i, v) {
				if (this.name === 'order') {
					order = this.value;
				}
			});
		}
		// populate the form from shortcode attributes
		var sort_by = '';
		var sort_direction = '';
		if (typeof(plugin._current) !== 'undefined' && typeof(plugin._current.attrs) !== 'undefined') {
			$.each(plugin._current.attrs, function (i, v) {
				var field_to_populate = '[name="criteria[' + this.name + ']"]';
				switch (this.name) {
					case 'property_type':
					case 'status':
					case 'area_mls_defined':
					case 'city':
					case 'school_district':
						var $el = $(field_to_populate, $form);
						var values_array = this.value.split(',');
						$el.val(values_array);
						break;
					case 'sort_by':
						sort_by = this.value;
						if (sort_direction != '') {
							var $el = $('[name="criteria[sort]"]', $form);
							if (this.value == 'list_price') {
								var value_start = 'price-';
							}
							else if (this.value == 'list_date'){
								var value_start = 'date-';
							}
							if (value_start != undefined) {
								var value = value_start + sort_direction + 'ending';
								$el.val(value);
							}
						}
						break;
					case 'direction':
						sort_direction = this.value;
						if (sort_by != '') {
							var $el = $('[name="criteria[sort]"]', $form);
							if (sort_by == 'list_price') {
								var value_start = 'price-';
							}
							else if (sort_by == 'list_date'){
								var value_start = 'date-';
							}
							if (value_start != undefined) {
								var value = value_start + this.value + 'ending';
								$el.val(value);
							}
						}
						break;
					default:
						var $el = $(field_to_populate, $form);
						if ($el.attr('type') === 'text') {
							$el.val(this.value);
						}
						else {
							$el.val([this.value]);
						}
						break;
				}
			});
		}
		$('#displet-listing select[name="criteria[listings]"]').change();
		$form.submit(function () {
			var $this = $(this);
			var shortcode_name = 'DispletListing';
			var data = $this.serializeArray();
			var data_filtered = [];
			var attrs = '';
			var multi_selects = {};

			$.each(data, function () {
				if (this.value !== '') {
					this.name = this.name.replace('criteria[', '').replace(']', '');
					if (this.name === 'sort') {
						if (this.value === 'price-descending') {
							data_filtered.push({
								'name': 'sort_by',
								'value': 'list_price'
							});
							data_filtered.push({
								'name': 'direction',
								'value': 'desc'
							});
						}
						else if (this.value === 'price-ascending') {
							data_filtered.push({
								'name': 'sort_by',
								'value': 'list_price'
							});
							data_filtered.push({
								'name': 'direction',
								'value': 'asc'
							});
						}
						else if (this.value === 'date-descending') {
							data_filtered.push({
								'name': 'sort_by',
								'value': 'list_date'
							});
							data_filtered.push({
								'name': 'direction',
								'value': 'desc'
							});
						}
						else if (this.value === 'date-ascending') {
							data_filtered.push({
								'name': 'sort_by',
								'value': 'list_date'
							});
							data_filtered.push({
								'name': 'direction',
								'value': 'asc'
							});
						}
					}
					else if (this.name === 'property_type' || this.name === 'status' || this.name === 'area_mls_defined' || this.name === 'city' || this.name === 'school_district') {
						multi_selects[this.name] = multi_selects[this.name] ? multi_selects[this.name] + ',' + this.value : this.value;
					}
					else {
						//attrs += this.name + '="' + this.value + '" '; Nothing appears to be using this
						data_filtered.push({'name': this.name, 'value': this.value});
					}
				}
			});
			if (multi_selects) {
				for (var property in multi_selects) {
					data_filtered.push({
						'name': property,
						'value': multi_selects[property],
					});
				}
			}
			if (typeof(plugin._current) !== 'undefined' && typeof(plugin._current.attrs) !== 'undefined') {
				plugin._searches[plugin._current.index] = data_filtered;
				var index = plugin._current.index;
			}
			else {
				var index = plugin._searches.push(data_filtered) - 1;
			}
			popup.editor.execCommand('mceInsertContent',
				false,
				'<img id="' + shortcode_name.toLowerCase()
					+ '-' + index + '" src="' + plugin._url
					+ '/../css/images/displet-listing.png" class="mceItem ' +
					shortcode_name.toLowerCase() + '"/>');
			popup.editor.execCommand('mceRepaint');
			popup.close();
		});
		$('#cancel').click(function () {
			popup.close();
		});
		displetretsidx_admin.init_displet_listing_dialog();
	});
})(jQuery, tinyMCEPopup);