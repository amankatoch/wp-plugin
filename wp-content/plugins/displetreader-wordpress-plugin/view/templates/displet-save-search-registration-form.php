<div id="displet-save-search-registration-form" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<div class="displet-input">
		<input class="<?php displetretsidx_save_search_registration_user_name_class(); ?>" type="text" placeholder="Name" value="<?php displetretsidx_save_search_registration_user_name_value(); ?>">
		<span class="displet-required displet-font-color">
			*
		</span>
	</div>
	<div class="displet-input">
		<input class="<?php displetretsidx_save_search_registration_user_email_class(); ?>" type="text" placeholder="Email Address" value="<?php displetretsidx_save_search_registration_user_email_value(); ?>">
		<span class="displet-required displet-font-color">
			*
		</span>
	</div>
	<div class="displet-input">
		<input class="<?php displetretsidx_save_search_registration_user_phone_class(); ?>" type="text" placeholder="Phone" value="<?php displetretsidx_save_search_registration_user_phone_value(); ?>">
	</div>
	<div class="displet-input">
		<input class="<?php displetretsidx_save_search_registration_city_class(); ?>" type="text" placeholder="City">
	</div>
	<div class="displet-input">
		<input class="<?php displetretsidx_save_search_registration_zip_class(); ?>" type="text" placeholder="Zip">
	</div>
	<div class="displet-input">
		<select class="<?php displetretsidx_save_search_registration_min_bedrooms_class(); ?>">
			<?php displetretsidx_the_save_search_registration_min_bedrooms_options(); ?>
		</select>
	</div>
	<div class="displet-input">
		<select class="<?php displetretsidx_save_search_registration_min_bathrooms_class(); ?>">
			<?php displetretsidx_the_save_search_registration_min_bathrooms_options(); ?>
		</select>
	</div>
	<div class="displet-input">
		<select class="<?php displetretsidx_save_search_registration_min_list_price_class(); ?>">
			<?php displetretsidx_the_save_search_registration_min_list_price_options(); ?>
		</select>
	</div>
	<div class="displet-input">
		<select class="<?php displetretsidx_save_search_registration_max_list_price_class(); ?>">
			<?php displetretsidx_the_save_search_registration_max_list_price_options(); ?>
		</select>
	</div>
	<div class="displet-input">
		<select class="<?php displetretsidx_save_search_registration_property_type_class(); ?>">
			<?php displetretsidx_the_save_search_registration_property_type_options(); ?>
		</select>
	</div>
	<?php displetretsidx_save_search_registration_error_element(); ?>
	<div class="displet-action">
		<input class="<?php displetretsidx_save_search_registration_submit_class(); ?> displet-button" type="submit" value="Submit">
		<span class="displet-loading-holder">
			<?php displetretsidx_the_loading_element(); ?>
		</span>
	</div>
</div>