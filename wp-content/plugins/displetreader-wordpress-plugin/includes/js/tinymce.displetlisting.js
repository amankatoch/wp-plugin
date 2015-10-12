// DispletListing TinyMCE plugin
;(function ($) {
 	tinymce.create('tinymce.plugins.DispletListing', {
		'_searches': [],

		'_get_listing_defaults': function () {
			var that = this;
			$.ajax({
				'async': false,
				'url': ajaxurl,
				'data': {
					'action': 'displetreader',
					'subaction': 'get_listing_defaults',
					'method': 'get',
				},
				'success': function (json) {
					that._listing_defaults = json;
					return json;
				}
			});
		},

		'init': function (editor, url) {
			var that = this;
			this._url = url;
			this._listing_defaults = false;
			this._get_listing_defaults();
			editor.addCommand('DispletListingEdit', function () {
				editor.windowManager.open({
					'file': displetretsidx_url + '/view/admin/displet-listing.php',
					'height': 573, // Strangely iframe is 2px smaller than this on WP 3.9 with new TinyMCE
					'width': 668,
					'inline': 1
				}), {
					'plugin_url': url
				};
			});
			editor.addButton('DispletListing', {
				'title': 'Insert Displet RETS/IDX Listings',
				'cmd': 'DispletListingEdit',
				'image': displetretsidx_url + '/includes/css/images/displet-listing-icon.png'
			});
			editor.onBeforeSetContent.add(function (editor, o) {
				o.content = that._shortcode_to_placeholder(o.content);
			});
			editor.onPostProcess.add(function (editor, o) {
				if (o.get) {
					o.content = that._placeholder_to_shortcode(o.content);
				}
			});
			editor.onMouseDown.add(function (editor, ev) {
				var shortcode = false;
				var search_index = false;
				if ($(ev.target).hasClass('displethview')) {
					shortcode = 'displethview';
				}
				else if ($(ev.target).hasClass('displetlisting')) {
					shortcode = 'displetlisting';
				}
				if (shortcode) {
					var index_regex = /-(\d+)/;
					var match = index_regex.exec(ev.target.id);
					if (match !== null) {
						search_index = match[1];
						that._current = {
							'type': shortcode,
							'index': search_index,
							'attrs': that._searches[search_index]
						};
						editor.execCommand('DispletListingEdit');
					}
				}
			});
			window.onpopstate = function(event) {
				if (event && event.state && event.state.searches) {
					for (var i = 0; i < event.state.searches.length; i++) {
						that._searches[i] = event.state.searches[i];
					};
				}
			}
		},

		'_shortcode_to_placeholder': function (content) {
			var that = this;
			var shortcode_regex = /(?:<p>)?\[(DispletListing|DispletHView)\s*(.*)\](?:<\/p>)/g;
			var attr_regex = /(\w+)="([^"]*)"/g;
			return content.replace(shortcode_regex, function (shortcode, listing_type, attr_string) {
				var attributes = [];
				var match = [];
				while ((match = attr_regex.exec(attr_string)) !== null) {
					attributes.push({
						'name': match[1],
						'value': match[2]
					});
				};
				var i = that._searches.push(attributes) - 1;
				if (listing_type === 'DispletListing') {
					var id_string = 'displetlisting-';
					var class_string = 'displetlisting';
				}
				else {
					var id_string = 'displethview-';
					var class_string = 'displethview';
				}
				if (!displetretsidx_is_ie) {
					history.replaceState({
						searches: that._searches,
					}, '');
				}
				var return_string = '<p><img id="' + id_string + i + '" src="' + displetretsidx_url + '/includes/css/images/displet-listing.png' + '" class="mceItem ' + class_string + '"/></p>';
				return return_string;
			});
		},

		'_placeholder_to_shortcode': function (content) {
			var that = this;
			var listing_regex = /<img[\A class="mceItem displetlisting"\Z]* id="(displetlisting|displethview)-(\d+)".*?\/>/g;
			return content.replace(listing_regex, function (div, listing_type, index) {
				var attrs = that._searches[index];
				var attr_string = '';
				var property_types = '';
				var property_type_string = '';
				var statuses = '';
				var status_string = '';
				var area_mls_defineds = '';
				var area_mls_defined_string = '';
				var cities = '';
				var city_string = '';
				var school_districts = '';
				var school_district_string = '';
				if (typeof(attrs) !== 'undefined') {
					$.each(attrs, function (i, v) {
						if (this.name == 'property_type' && this.value != undefined) {
							property_types += this.value + ',';
						}
						else if (this.name == 'status' && this.value != undefined) {
							statuses += this.value + ',';
						}
						else if (this.name == 'area_mls_defined' && this.value != undefined) {
							area_mls_defineds += this.value + ',';
						}
						else if (this.name == 'city' && this.value != undefined) {
							cities += this.value + ',';
						}
						else if (this.name == 'school_district' && this.value != undefined) {
							school_districts += this.value + ',';
						}
						else if (this.name == 'sort' && this.value != undefined) {
							if (this.value == 'price-ascending') {
								attr_string += ' sort_by=list_price direction=asc';
							}
							else if (this.value == 'price-descending') {
								attr_string += ' sort_by=list_price direction=desc';
							}
							else if (this.value == 'date-ascending') {
								attr_string += ' sort_by=list_date direction=asc';
							}
							else if (this.value == 'date-descending') {
								attr_string += ' sort_by=list_date direction=desc';
							}
						}
						else{
							attr_string += ' ' + this.name + '="' + this.value + '"';
						}
					});
				}
				if (property_types != '') {
					property_type_string = ' property_type="' + property_types.replace(/,$/, '') + '"';
				}
				if (statuses != '') {
					status_string = ' status="' + statuses.replace(/,$/, '') + '"';
				}
				if (area_mls_defineds != '') {
					area_mls_defined_string = ' area_mls_defined="' + area_mls_defineds.replace(/,$/, '') + '"';
				}
				if (cities != '') {
					city_string = ' city="' + cities.replace(/,$/, '') + '"';
				}
				if (school_districts != '') {
					school_district_string = ' school_district="' + school_districts.replace(/,$/, '') + '"';
				}
				if (listing_type === 'displetlisting') {
					var shortcode = 'DispletListing';
				}
				else {
					var shortcode = 'DispletHView';
				}
				var return_string = '<p>[' + shortcode + attr_string + property_type_string + status_string + area_mls_defined_string + city_string + school_district_string + ']</p>';
				return return_string;
			});
		}
	});
	tinymce.PluginManager.add('DispletListing', tinymce.plugins.DispletListing);
 })(jQuery);