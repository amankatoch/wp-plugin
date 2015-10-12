<div id="displet-search-forms" class="wrap displet-admin">
	<h2>
		Displet RETS/IDX Search Forms
	</h2>
	<?php settings_errors(); ?>
	<h2 class="displet-tabs nav-tab-wrapper">
		<?php if ( !empty( $model['search_forms'] ) ) : foreach ( $model['search_forms'] as $form_id => $search_form ) : ?>
			<?php if ( $form_id === 0 ) : ?>
				<a href="#search_results" class="nav-tab">
					Search Results
				</a>
			<?php elseif ( $form_id === 2 && $model['has_mobile_search_form'] ) : ?>
				<a href="#mobile" class="nav-tab">
					Mobile
				</a>
			<?php elseif ( $form_id > 3 ) : ?>
				<a href="#quick_search_<?php echo $form_id - 3; ?>" class="nav-tab">
					Quick Search
					<?php if ( $form_id > 4 ) echo $form_id - 3; ?>
				</a>
			<?php endif; ?>
		<?php endforeach; endif; ?>
		<a href="javascript:;" class="displet-add-quick-search nav-tab">
			Add Quick Search
		</a>
	</h2>
	<form action="options.php" method="post">
		<div class="displet-none">
			<?php
				settings_fields( $model['options_slug'] );
				do_settings_sections( $model['page_slug'] );
			?>
		</div>
		<?php if ( !empty( $model['search_forms'] ) ) : foreach ( $model['search_forms'] as $form_id => $search_form ) : ?>
			<?php if ( $form_id === 0 ) : $field_id = 0; ?>
				<div id="search_results" class="displet-tabbed">
					<h3>
						Usage
					</h3>
					<p>
					The search results page search form is automatically displayed on the
					<a href="<?php echo $model['search_results_page_url']; ?>" target="_blank">
						Search Results page.
					</a>
					<h3>
						Search Results Page Search Form
					</h3>
			<?php elseif ( $form_id === 1 ) : ?>
				<h3>
					Search Results Page Search Form - Advanced Section
				</h3>
				<p>
					The advanced section is hidden until the user performs an action (click) to display its fields.
				</p>

			<?php elseif ( $form_id === 2 ) : $field_id = 0;  ?>
				<div id="mobile" class="displet-tabbed">
					<h3>
						Usage
					</h3>
					The mobile homepage search form is automatically displayed on the
					<a href="<?php echo $model['mobile_homepage_url']; ?>" target="_blank">
						Mobile Homepage.
					</a>
					<h3>
						Mobile Homepage Search Form
					</h3>
			<?php elseif ( $form_id === 3 ) : ?>
				<h3>
					Mobile Search Results Page Search Form
				</h3>
				<p>
					The mobile search results page search form is automatically displayed on the
					<a href="<?php echo $model['mobile_search_results_page_url'] ?>">
						Mobile Search Results page.
					</a>
				</p>
			<?php else : $field_id = 0; ?>
				<div id="quick_search_<?php echo $form_id - 3; ?>" class="displet-tabbed">
					<h3>
						Usage
					</h3>
					<p>
						This quick search form is displayed anywhere the Displet Quick Search widget (with Form ID "<?php echo $form_id - 3; ?>" selected) or
						<code>[DispletQuickSearch id="<?php echo $form_id - 3; ?>"]</code>
						shortcode is used.
					</p>
					<h3>
						Quick Search Form
					</h3>
			<?php endif; ?>
			<div class="displet-table-wrapper">
				<table class="displet-search-form form-table" for="<?php echo $form_id; ?>">
					<tr>
						<?php if ( !empty( $search_form ) ) : foreach ( $search_form as $column_id => $search_fields ) : ?>
							<th>
								<span>
									Column <?php echo $column_id + 1; ?>
								</span>
								<?php if ( $column_id !== 0 ) : ?>
									|
									<a class="displet-delete" href="javascript:;" for="<?php echo $column_id; ?>">
										Delete
									</a>
								<?php endif; ?>
							</th>
						<?php endforeach; endif; ?>
						<th class="displet-add"></th>
					</tr>
					<tr>
						<?php if ( !empty( $search_form ) ) : foreach ( $search_form as $column_id => $search_fields ) : ?>
							<td for="<?php echo $column_id; ?>">
								<div class="displet-sortable">
									<?php if ( !empty( $search_fields ) ) : foreach ( $search_fields as $search_field ) : ?>
										<div class="displet-search-field">
											<h4>
												<a class="displet-toggle-content" href="javascript:;"></a>
												<span>
													<?php echo $search_field['label'] ?>
												</span>
											</h4>
											<div class="displet-content">
												<p class="displet-label"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['label'] ) ) echo ' style="display: none;"'; ?>>
													<label>
														Label:
													</label>
													<input name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][label]" class="widefat" type="text" value="<?php echo $search_field['label']; ?>"/>
												</p>
												<p class="displet-field">
													<label>
														Field:
													</label>
													<select name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][field]" class="widefat">
														<?php if ( !empty( $model['search_fields'] ) ) : foreach ( $model['search_fields'] as $slug => $field ) : ?>
															<option value="<?php echo $slug; ?>" <?php selected( $slug, $search_field['field'] ); ?>>
																<?php echo $field['title']; ?>
															</option>
														<?php endforeach; endif; ?>
													</select>
												</p>
												<fieldset<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['range'] ) && empty( $model['search_fields'][ $search_field['field'] ]['options'] ) ) echo ' style="display: none;"'; ?>>
													<legend>
														Values
													</legend>
													<p class="displet-options"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['options'] ) ) echo ' style="display: none;"'; ?>>
														<label>
															Options:
														</label>
														<select multiple name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][options][]" class="widefat">
															<?php if ( !empty( $model['search_fields'][ $search_field['field'] ]['options'] ) && is_array( $model['search_fields'][ $search_field['field'] ]['options'] ) ) : foreach ( $model['search_fields'][ $search_field['field'] ]['options'] as $option ) : ?>
																<option value="<?php echo $option; ?>" <?php if ( !empty( $search_field['options'] ) && is_array( $search_field['options'] ) && in_array( $option, $search_field['options'] ) ) echo 'selected="selected"'; ?>>
																	<?php echo $option; ?>
																</option>
															<?php endforeach; else : ?>
																<option value="" selected="selected"></option>
															<?php endif; ?>
														</select>
														<small>
															Hold the Ctrl key (Windows) or Command key (Mac) prior to clicking to select multiple options
														</small>
													</p>
													<p class="displet-min"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['range']['min'] ) ) echo ' style="display: none;"'; ?>>
														<label>
															Min:
														</label>
														<input name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][min]" class="widefat" type="text" value="<?php echo $search_field['min']; ?>"/>
														<small>
															Enter the minimum value
														</small>
													</p>
													<p class="displet-max"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['range']['max'] ) ) echo ' style="display: none;"'; ?>>
														<label>
															Max:
														</label>
														<input name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][max]" class="widefat" type="text" value="<?php echo $search_field['max']; ?>"/>
														<small>
															Enter the maximum value
														</small>
													</p>
													<p class="displet-increment"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['range']['increment'] ) ) echo ' style="display: none;"'; ?>>
														<label>
															Increment:
														</label>
														<input name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][increment]" class="widefat" type="text" value="<?php echo $search_field['increment']; ?>"/>
														<small>
															Enter the value to increment from min to max
														</small>
													</p>
													<p class="displet-range"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['range']['custom'] ) ) echo ' style="display: none;"'; ?>>
														<label>
															Custom Range:
														</label>
														<textarea name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][range]" class="widefat"><?php if ( !empty( $search_field['range'] ) ) echo implode( PHP_EOL, $search_field['range'] ); ?></textarea>
														<small>
															Enter 1 value per line
														</small>
													</p>
													<p class="displet-lease-max"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['range']['lease_max'] ) ) echo ' style="display: none;"'; ?>>
														<label>
															Lease Max:
														</label>
														<input name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][lease_max]" class="widefat" type="text" value="<?php echo $search_field['lease_max']; ?>"/>
														<small>
															Enter the maxium value to be displayed during lease searches
														</small>
													</p>
													<p class="displet-sale-min"<?php if ( empty( $model['search_fields'][ $search_field['field'] ]['range']['sale_min'] ) ) echo ' style="display: none;"'; ?>>
														<label>
															Sale Min:
														</label>
														<input name="displet_rets_idx_search_forms[search_forms][<?php echo $form_id; ?>][<?php echo $column_id; ?>][<?php echo $field_id; ?>][sale_min]" class="widefat" type="text" value="<?php echo $search_field['sale_min']; ?>"/>
														<small>
															Enter the minimum value to be displayed during sale searches
														</small>
													</p>
												</fieldset>
												<div class="displet-action">
													<a class="displet-delete" href="javascript:;">
														Delete
													</a>
													|
													<a class="displet-close" href="javascript:;">
														Close
													</a>
												</div>
											</div>
										</div>
									<?php $field_id++; endforeach; endif; ?>
								</div>
							</td>
						<?php endforeach; endif; ?>
						<td class="displet-add <?php if ( $form_id === 2 || $form_id === 3 ) echo 'displet-no-add-column'; ?>">
							<div class="displet-content">
								<div class="displet-half">
									<div>
										<a class="displet-add-field" href="javascript:;">
											<span></span>
											<h3>
												Add Field
											</h3>
										</a>
									</div>
								</div>
								<?php if ( $form_id !== 2 && $form_id !== 3 ) : ?>
									<div class="displet-half">
										<div>
											<a class="displet-add-column" href="javascript:;">
												<span></span>
												<h3>
													Add Column
												</h3>
											</a>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<?php if ( $form_id === 1 || $form_id > 2 ) : ?>
				</div>
			<?php endif; ?>
		<?php endforeach; endif; ?>
		<p class="submit">
			<input type="submit" value="Save Changes" class="button-primary">
		</p>
	</form>
	<div class="displet-search-field-placeholder">
		<div class="displet-search-field">
			<h4>
				<a class="displet-toggle-content" href="javascript:;"></a>
				<span>
					Select Field
				</span>
			</h4>
			<div class="displet-content" style="display: block;">
				<p class="displet-label" style="display: none;">
					<label>
						Label:
					</label>
					<input name="displet_rets_idx_search_forms[search_forms][X][Y][Z][label]" class="widefat" type="text" value=""/>
				</p>
				<p class="displet-field">
					<label>
						Field:
					</label>
					<select name="displet_rets_idx_search_forms[search_forms][X][Y][Z][field]" class="widefat">
						<option selected="selected" disabled>
							Select A Field
						</option>
						<?php if ( !empty( $model['search_fields'] ) ) : foreach ( $model['search_fields'] as $slug => $field ) : ?>
							<option value="<?php echo $slug; ?>">
								<?php echo $field['title']; ?>
							</option>
						<?php endforeach; endif; ?>
					</select>
				</p>
				<fieldset style="display: none;">
					<legend>
						Values
					</legend>
					<p class="displet-options">
						<label>
							Options:
						</label>
						<select multiple name="displet_rets_idx_search_forms[search_forms][X][Y][Z][options][]" class="widefat"></select>
						<small>
							Hold the Ctrl key (Windows) or Command key (Mac) prior to clicking to select multiple
						</small>
					</p>
					<p class="displet-min">
						<label>
							Min:
						</label>
						<input name="displet_rets_idx_search_forms[search_forms][X][Y][Z][min]" class="widefat" type="text" value=""/>
						<small>
							Enter the minimum value
						</small>
					</p>
					<p class="displet-max">
						<label>
							Max:
						</label>
						<input name="displet_rets_idx_search_forms[search_forms][X][Y][Z][max]" class="widefat" type="text" value=""/>
						<small>
							Enter the maximum value
						</small>
					</p>
					<p class="displet-increment">
						<label>
							Increment:
						</label>
						<input name="displet_rets_idx_search_forms[search_forms][X][Y][Z][increment]" class="widefat" type="text" value=""/>
						<small>
							Enter the value to increment from min to max
						</small>
					</p>
					<p class="displet-range">
						<label>
							Custom Range:
						</label>
						<textarea name="displet_rets_idx_search_forms[search_forms][X][Y][Z][range]" class="widefat"></textarea>
						<small>
							Enter 1 value per line
						</small>
					</p>
					<p class="displet-lease-max">
						<label>
							Lease Max:
						</label>
						<input name="displet_rets_idx_search_forms[search_forms][X][Y][Z][lease_max]" class="widefat" type="text" value=""/>
						<small>
							Enter the maxium value to be displayed during lease searches
						</small>
					</p>
					<p class="displet-sale-min">
						<label>
							Sale Min:
						</label>
						<input name="displet_rets_idx_search_forms[search_forms][X][Y][Z][sale_min]" class="widefat" type="text" value=""/>
						<small>
							Enter the minimum value to be displayed during sale searches
						</small>
					</p>
				</fieldset>
				<div class="displet-action">
					<a class="displet-delete" href="javascript:;">
						Delete
					</a>
					|
					<a class="displet-close" href="javascript:;">
						Close
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="displet-search-form-placeholder">
		<div id="quick_search_W" class="displet-tabbed">
			<h3>
				Usage
			</h3>
			<p>
				This search form is used anywhere the Displet Quick Search W widget(s) and
				<code>[DispletQuickSearch id="W"]</code>
				shortcode(s) are displayed.
			</p>
			<h3>
				Search Form Columns
			</h3>
			<div class="displet-table-wrapper">
				<table class="displet-search-form form-table" for="X">
					<tr>
						<th>
							<span>
								Column 1
							</span>
						</th>
						<th class="displet-add"></th>
					</tr>
					<tr>
						<td for="0">
							<div class="displet-sortable"></div>
						</td>
						<td class="displet-add">
							<div class="displet-content">
								<div class="displet-half">
									<div>
										<a class="displet-add-field" href="javascript:;">
											<span></span>
											<h3>
												Add Field
											</h3>
										</a>
									</div>
								</div>
								<div class="displet-half">
									<div>
										<a class="displet-add-column" href="javascript:;">
											<span></span>
											<h3>
												Add Column
											</h3>
										</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>