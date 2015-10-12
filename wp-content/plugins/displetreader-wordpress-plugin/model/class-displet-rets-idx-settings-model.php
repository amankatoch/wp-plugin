<?php

class DispletRetsIdxSettingsModel extends DispletRetsIdxPlugin {
	protected static $_choices;
	protected static $_defaults;
	protected static $_sections = array(
		'open-general' => 'General',
		'license' => 'License',
		'upgrade' => 'Upgrade Account',
		'market' => 'Market',
		'general' => 'General',
		'disclaimer' => 'Disclaimer',
		'close-general' => '',
		'open-email' => 'Email',
		'email' => 'Email To/From',
		'duty-agent' => 'Duty Agent',
		'duty-lender' => 'Duty Lender',
		'property-suggestions' => 'Property Suggestions',
		'email-activity' => 'Email Activity',
		'email-template-options' => 'Email Template Options',
		'email-templates' => 'Email Templates',
		'close-email' => '',
		'open-listings' => 'Multiple Listings',
		'listings' => 'Display',
		'listings-fields' => 'Additional Fields',
		'property-type-navigation' => 'Property Type Navigation',
		'price-navigation' => 'Price Navigation',
		'statistics' => 'Statistics',
		'close-listings' => '',
		'open-pdp' => 'Individual Listing',
		'property-details' => 'Single Listing Details',
		'pdp-fields' => 'Additional Fields',
		'pdp-field-options' => 'Field Options',
		'pdp-photos' => 'Photos',
		'pdp-planwise' => 'PlanWise Affordability',
		'pdp-similar' => 'Similar Properties',
		'showing-request' => 'Showing Request',
		'close-pdp' => '',
		'open-search' => 'Search',
		'search-results' => 'Search Results',
		'close-search' => '',
		'open-registration' => 'Login/Registration',
		'registration-settings' => 'Registration Settings',
		'registration-form' => 'Registration Form',
		'login-form' => 'Login Form',
		'social-logins' => 'Social Logins',
		'blacklisted' => 'Blacklisted',
		'saved-search-registration' => 'Saved Search Registration',
		'close-registration' => '',
		'open-seo' => 'SEO',
		'seo-pdp' => 'Property Details Page',
		'seo-partial-address' => 'Partial Address Page',
		'seo-search-results' => 'Search Results Page',
		'close-seo' => '',
		'open-advanced' => 'Advanced',
		'listings-format' => 'Address Format',
		'property-filter' => 'Property Filter',
		'crm' => 'CRM / Automated Task Integration',
		'mobile' => 'Mobile',
		'misc' => 'Miscellaneous',
		'close-advanced' => '',
	);
	protected static $_settings;
	protected static $_settings_page;

	private static function _get_email_template_choices() {
		return array(
			'admin_email' => get_bloginfo( 'admin_email' ),
			'images' => array(),
			'site_name' => get_bloginfo( 'name' ),
		);
	}

	private static function _get_email_template_options( $choices ) {
		$options = array();

		// Email section
		$options['email'] = array(
			'section' => 'email',
			'id' => 'email',
			'title' => '"Send To:" Email Address',
			'desc' => 'The email address(es) to receive all lead notifications. Separate multiple email addresses with commas.May be used in conjuction with a duty agent (both would receive notifications).',
			'type' => 'text',
			'std' => $choices['admin_email'],
			'class' => 'nohtml'
		);

		$options['email_from_address'] = array(
			'section' => 'email',
			'id' => 'email_from_address',
			'title' => '"Send From:" Email Address',
			'desc' => 'The sender\'s email address that email notifications are mailed from.If a lead is assigned to an agent (via Duty Agent or Lead Manager), this value no longer takes effect for that lead (except for saved search updates which always use this value).',
			'type' => 'text',
			'std' => $choices['admin_email'],
			'class' => 'nohtml'
		);

		$options['email_from_name'] = array(
			'section' => 'email',
			'id' => 'email_from_name',
			'title' => '"Send From:" Name',
			'desc' => 'The sender\'s name to email notifications from. If a lead is assigned to an agent (via Duty Agent or Lead Manager), this setting no longer takes effect for that lead.',
			'type' => 'text',
			'std' => $choices['site_name'],
			'class' => 'nohtml'
		);

		// Email Template Options section
		$options['email_template_primary_color'] = array(
			'section' => 'email-template-options',
			'id' => 'email_template_primary_color',
			'title' => 'Primary Background Color',
			'desc' => 'The primary color used in the email templates',
			'type' => 'text',
			'std' => '#777',
			'class' => 'color',
		);
		$options['email_template_secondary_color'] = array(
			'section' => 'email-template-options',
			'id' => 'email_template_secondary_color',
			'title' => 'Secondary Background Color',
			'desc' => 'The secondary color used in the email templates',
			'type' => 'text',
			'std' => '#aaa',
			'class' => 'color',
		);
		$options['email_template_logo_image_id'] = array(
			'section' => 'email-template-options',
			'id' => 'email_template_logo_image_id',
			'title' => 'Logo Image',
			'type' => 'select2',
			'std' => '',
			'choices' => self::$_choices['images'],
		);
		$options['email_template_banner_image_id'] = array(
			'section' => 'email-template-options',
			'id' => 'email_template_banner_image_id',
			'title' => 'Banner Image',
			'type' => 'select2',
			'std' => '',
			'choices' => self::$_choices['images'],
		);

		// Email Templates section
		$options['email_signature'] = array(
			'section' => 'email-templates',
			'id' => 'email_signature',
			'title' => 'Email Signature',
			'desc' => 'Appears at the bottom of each outbound email to users and agents. Available data: %%site_name%% and %%site_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_signature(),
		);

		$options['email_title_new_registration_to_user'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_new_registration_to_user',
			'title' => 'New Registration, To User - Title',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_has_realtor%%, %%user_username%%, %%site_name%%, %%site_url%%, and %%registration_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_new_registration_title_to_user(),
		);

		$options['email_template_new_registration_to_user'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_new_registration_to_user',
			'title' => 'New Registration, To User - Body',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_has_realtor%%, %%user_username%%, %%user_password%%, %%site_name%%, %%site_url%%, and %%registration_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_new_registration_message_to_user(),
		);

		$options['email_title_new_registration_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_new_registration_to_admin',
			'title' => 'New Registration, To Agent - Title',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_has_realtor%%, %%user_username%%, %%site_name%%, %%site_url%%, and %%registration_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_new_registration_title_to_admin(),
		);

		$options['email_template_new_registration_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_new_registration_to_admin',
			'title' => 'New Registration, To Agent - Body',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_has_realtor%%, %%user_username%%, %%site_name%%, %%site_url%%, and %%registration_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_new_registration_message_to_admin(),
		);

		$options['email_title_property_showing_to_user'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_property_showing_to_user',
			'title' => 'Property Info/Showing, To User - Title',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_appointment%%, %%user_appointment2%%, %%user_message%%, %%property_address%%, %%property_mls%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_property_showing_title_to_user(),
		);

		$options['email_template_property_showing_to_user'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_property_showing_to_user',
			'title' => 'Property Info/Showing, To User - Body',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_appointment%%, %%user_appointment2%%, %%user_message%%, %%property_address%%, %%property_mls%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_property_showing_message_to_user(),
		);

		$options['email_title_property_showing_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_property_showing_to_admin',
			'title' => 'Property Info/Showing, To Agent - Title',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_appointment%%, %%user_appointment2%%, %%user_message%%, %%property_address%%, %%property_mls%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_property_showing_title_to_admin(),
		);

		$options['email_template_property_showing_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_property_showing_to_admin',
			'title' => 'Property Info/Showing, To Agent - Body',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_appointment%%, %%user_appointment2%%, %%user_message%%, %%property_address%%, %%property_mls%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_property_showing_message_to_admin(),
		);

		$options['email_title_saved_property_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_saved_property_to_admin',
			'title' => 'Saved Property, To Agent - Title',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_message%%, %%property_address%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_saved_property_title_to_admin(),
		);

		$options['email_template_saved_property_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_saved_property_to_admin',
			'title' => 'Saved Property, To Agent - Body',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%user_message%%, %%property_address%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_saved_property_message_to_admin(),
		);

		$options['email_title_saved_search_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_saved_search_to_admin',
			'title' => 'Saved Search, To Agent - Title',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%search_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_saved_search_title_to_admin(),
		);

		$options['email_template_saved_search_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_saved_search_to_admin',
			'title' => 'Saved Search, To Agent - Body',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%search_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_saved_search_message_to_admin(),
		);

		$options['email_title_email_friend_to_user'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_email_friend_to_user',
			'title' => 'Email To Friend, To Friend - Title',
			'desc' => 'Available data: %%user_name%% (equals "A Friend" if user isn\'t logged in), %%user_email%% (blank if user isn\'t logged in), %%user_message%%, %%friend_name%%, %%friend_email%%, %%property_address%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_email_friend_title_to_user(),
		);

		$options['email_template_email_friend_to_user'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_email_friend_to_user',
			'title' => 'Email To Friend, To Friend - Body',
			'desc' => 'Available data: %%user_name%% (equals "A Friend" if user isn\'t logged in), %%user_email%% (blank if user isn\'t logged in), %%user_message%%, %%friend_name%%, %%friend_email%%, %%property_address%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_email_friend_message_to_user(),
		);

		$options['email_title_email_friend_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_email_friend_to_admin',
			'title' => 'Email To Friend, To Agent - Title',
			'desc' => 'Available data: %%user_name%% (equals "A Friend" if user isn\'t logged in), %%user_email%% (blank if user isn\'t logged in), %%user_message%%, %%friend_name%%, %%friend_email%%, %%property_address%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_email_friend_title_to_admin(),
		);

		$options['email_template_email_friend_to_admin'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_email_friend_to_admin',
			'title' => 'Email To Friend, To Agent - Body',
			'desc' => 'Available data: %%user_name%% (equals "A Friend" if user isn\'t logged in), %%user_email%% (blank if user isn\'t logged in), %%user_message%%, %%friend_name%%, %%friend_email%%, %%property_address%%, %%property_url%%, %%site_name%%, and %%site_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_email_friend_message_to_admin(),
		);

		$options['email_title_assigned_lead'] = array(
			'section' => 'email-templates',
			'id' => 'email_title_assigned_lead',
			'title' => 'Newly Assigned Lead, To Agent - Title',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%site_name%%, %%site_url%% and %%leads_url%%',
			'type' => 'text',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_assigned_lead_title(),
		);

		$options['email_template_assigned_lead'] = array(
			'section' => 'email-templates',
			'id' => 'email_template_assigned_lead',
			'title' => 'Newly Assigned Lead, To Agent - Body',
			'desc' => 'Available data: %%user_name%%, %%user_email%%, %%user_phone%%, %%site_name%%, %%site_url%% and %%leads_url%%',
			'type' => 'editor',
			'std' => DispletRetsIdxEmailTemplatesModel::get_default_assigned_lead_message(),
		);

		return $options;
	}

	protected static function _get_email_template_options_with_defaults() {
		return self::_get_email_template_options( self::_get_email_template_choices() );
	}

	protected static function _get_options() {
		self::_set_choices();
		self::_set_defaults();
		self::_set_options();
		return self::$_settings;
	}

	protected static function _get_sections() {
		$sections = self::$_sections;
		if ( !empty( self::$_options['displet_app_key'] ) ) {
			unset( $sections['upgrade'] );
			unset( $sections['market'] );
		}
		else{
			unset( $sections['license'] );
		}
		return $sections;
	}

	protected static function _has_new_email_template_option( $options, $action_options ) {
		$email_template_options = DispletRetsIdxEmailTemplatesModel::get_option_slugs();
		if ( !empty( $email_template_options ) && is_array( $email_template_options ) ) {
			$is_new = array();
			foreach ( $email_template_options as $email_template_option ) {
				$is_new[] = DispletRetsIdxUtilities::is_option_new( $email_template_option, $action_options, $options );
			}
			$is_new = array_filter( $is_new );
			if ( !empty( $is_new ) ) {
				return true;
			}
		}
		return false;
	}

	private static function _set_choices() {
		self::$_choices = array(
			'admin_and_agent_users' => array(),
			'cities' => array(),
			'images' => array(),
			'pages' => array(),
			'property_types' => array(
				'House' => 'House',
				'Condo' => 'Condo',
				'Lease' => 'Lease',
				'Land' => 'Land',
				'Multi' => 'Multi',
				'Ranch' => 'Ranch',
			),
		);
		self::$_choices = array_merge( self::$_choices, self::_get_email_template_choices() );
		$field_options = DispletRetsIdxOptionsController::get_option('fields');
		if ( !empty( $field_options['property_type'] ) ) {
			self::$_choices['property_types'] = array();
			foreach ( $field_options['property_type'] as $property_type ) {
				self::$_choices['property_types'][ $property_type ] = $property_type;
			}
		}
		if ( !empty( $field_options['city'] ) ) {
			foreach ( $field_options['city'] as $city ) {
				self::$_choices['cities'][ $city ] = $city;
			}
		}
		self::_set_page_choices();
		self::_set_image_choices();
		self::_set_user_choices();
	}

	private static function _set_defaults() {
		self::$_defaults = array(
			'authenticated_url' => false,
			'rets_page_id' => false,
		);
		$rets_page = get_page_by_path( 'rets' );
		if ( !empty( $rets_page ) ) {
			self::$_defaults['rets_page_id'] = $rets_page->ID;
		}
		$action_options = DispletRetsIdxOptionsController::get_option( 'action' );
		if ( !empty( $action_options['authenticated_url'] ) ) {
			self::$_defaults['authenticated_url'] = $action_options['authenticated_url'];
		}
	}

	private static function _set_image_choices() {
		$images = DispletRetsIdxUtilities::get_images();
		self::$_choices['images'] = array(
			'None',
		) + DispletRetsIdxOptionsController::get_associative_array_from_post_objects( $images );
	}

	private static function _set_options() {
		$options = array();

		// App key section
		$options[] = array(
			'section' => 'license',
			'id' => 'displet_app_key',
			'title' => 'Displet 2.0 RETS/IDX API Key',
			'type' => 'text',
			'class' => 'nohtml',
			'auth' => self::$_defaults['authenticated_url'],
		);

		$options[] = array(
			'section' => 'license',
			'id' => 'displet_app_token',
			'title' => 'Displet 2.0 RETS/IDX API Password',
			'type' => 'password',
			'class' => 'nohtml'
		);

		// General section
		$options[] = array(
			'section' => 'general',
			'id' => 'color_scheme',
			'title' => 'Color Scheme',
			'type' => 'select2',
			'std' => 'default',
			'choices' => array(
				'default' => 'Default',
				'black' => 'Black',
				'blue' => 'Blue',
				'brown' => 'Brown',
				'green' => 'Green',
				'red' => 'Red',
				'yellow' => 'Yellow',
			),
		);

		$options[] = array(
			'section' => 'general',
			'id' => 'phone',
			'title' => 'Phone Number',
			'type' => 'text',
			'class' => 'nohtml'
		);

		// Market
		$options[] = array(
			'section' => 'market',
			'id' => 'oodle_region',
			'title' => 'Default Region',
			'type' => 'select2',
			'std' => 'usa',
			'choices' => array(
				'usa' => 'United States',
				'canada' => 'Canada',
				'abilene' => 'Abilene, TX',
				'albany' => 'Albany, NY',
				'albanyga' => 'Albany, GA',
				'albuquerque' => 'Albuquerque, NM',
				'alexandriala' => 'Alexandria, LA',
				'allentown' => 'Allentown, PA',
				'altoona' => 'Altoona, PA',
				'amarillo' => 'Amarillo, TX',
				'anchorage' => 'Anchorage, AK',
				'annistonal' => 'Anniston, AL',
				'appleton' => 'Appleton, WI',
				'asheville' => 'Asheville, NC',
				'athensga' => 'Athens, GA',
				'atlanta' => 'Atlanta, GA',
				'atlanticcity' => 'Atlantic City, NJ',
				'auburn' => 'Auburn, AL',
				'augusta' => 'Augusta, GA',
				'austin' => 'Austin, TX',
				'bakersfield' => 'Bakersfield, CA',
				'baltimore' => 'Baltimore, MD',
				'bangorme' => 'Bangor, ME',
				'barnstablema' => 'Barnstable, MA',
				'batonrouge' => 'Baton Rouge, LA',
				'beaumont' => 'Beaumont, TX',
				'bellingham' => 'Bellingham, WA',
				'bentonharbor' => 'Benton Harbor, MI',
				'billings' => 'Billings, MT',
				'biloxi' => 'Biloxi, MS',
				'binghamton' => 'Binghamton, NY',
				'birmingham' => 'Birmingham, AL',
				'bismarck' => 'Bismarck, ND',
				'bloomington' => 'Bloomington, IL',
				'bloomingtonin' => 'Bloomington, IN',
				'boise' => 'Boise, ID',
				'boston' => 'Boston, MA',
				'brownsville' => 'Brownsville, TX',
				'bryantx' => 'Bryan, TX',
				'buffalo' => 'Buffalo, NY',
				'burlington' => 'Burlington, VT',
				'canton' => 'Canton, OH',
				'casper' => 'Casper, WY',
				'cedarrapids' => 'Cedar Rapids, IA',
				'champaign' => 'Champaign, IL',
				'charleston' => 'Charleston, SC',
				'charlestonwv' => 'Charleston, WV',
				'charlotte' => 'Charlotte, NC',
				'charlottesville' => 'Charlottesville, VA',
				'chattanooga' => 'Chattanooga, TN',
				'cheyenne' => 'Cheyenne, WY',
				'chicago' => 'Chicago, IL',
				'chico' => 'Chico, CA',
				'cincinnati' => 'Cincinnati, OH',
				'clarksvilletn' => 'Clarksville, TN',
				'cleveland' => 'Cleveland, OH',
				'coloradosprings' => 'Colorado Springs, CO',
				'columbiamo' => 'Columbia, MO',
				'columbia' => 'Columbia, SC',
				'columbus' => 'Columbus, OH',
				'columbusga' => 'Columbus, GA',
				'corpuschristi' => 'Corpus Christi, TX',
				'corvallis' => 'Corvallis, OR',
				'cumberland' => 'Cumberland, MD',
				'dallas' => 'Dallas, TX',
				'danvilleva' => 'Danville, VA',
				'davenport' => 'Davenport, IA',
				'dayton' => 'Dayton, OH',
				'daytonabeach' => 'Daytona Beach, FL',
				'decatural' => 'Decatur, AL',
				'decaturil' => 'Decatur, IL',
				'denver' => 'Denver, CO',
				'desmoines' => 'Des Moines, IA',
				'detroit' => 'Detroit, MI',
				'dothan' => 'Dothan, AL',
				'doverde' => 'Dover, DE',
				'dubuque' => 'Dubuque, IA',
				'duluth' => 'Duluth, MN',
				'eauclaire' => 'Eau Claire, WI',
				'elpaso' => 'El Paso, TX',
				'elkhart' => 'Elkhart, IN',
				'elmira' => 'Elmira, NY',
				'enidok' => 'Enid, OK',
				'erie' => 'Erie, PA',
				'eugene' => 'Eugene, OR',
				'evansville' => 'Evansville, IN',
				'fargo' => 'Fargo, ND',
				'fayettevillear' => 'Fayetteville, AR',
				'fayettevillenc' => 'Fayetteville, NC',
				'flagstaff' => 'Flagstaff, AZ',
				'florenceal' => 'Florence, AL',
				'florencesc' => 'Florence, SC',
				'fortcollins' => 'Fort Collins, CO',
				'fortmyers' => 'Fort Myers, FL',
				'fortpierce' => 'Fort Pierce, FL',
				'fortsmith' => 'Fort Smith, AR',
				'ftwaltonbeach' => 'Fort Walton Beach, FL',
				'fortwayne' => 'Fort Wayne, IN',
				'fresno' => 'Fresno, CA',
				'gadsden' => 'Gadsden, AL',
				'gainesville' => 'Gainesville, FL',
				'glensfalls' => 'Glens Falls, NY',
				'goldsboronc' => 'Goldsboro, NC',
				'grandforks' => 'Grand Forks, ND',
				'grandjunction' => 'Grand Junction, CO',
				'grandrapids' => 'Grand Rapids, MI',
				'greatfalls' => 'Great Falls, MT',
				'greenbay' => 'Green Bay, WI',
				'greensboro' => 'Greensboro, NC',
				'greenvillenc' => 'Greenville, NC',
				'greenville' => 'Greenville, SC',
				'harrisburg' => 'Harrisburg, PA',
				'hartford' => 'Hartford, CT',
				'hattiesburg' => 'Hattiesburg, MS',
				'hendersonville' => 'Hendersonville, NC',
				'hickory' => 'Hickory, NC',
				'honolulu' => 'Honolulu, HI',
				'houma' => 'Houma, LA',
				'houston' => 'Houston, TX',
				'huntingtonwv' => 'Huntington, WV',
				'huntsville' => 'Huntsville, AL',
				'indianapolis' => 'Indianapolis, IN',
				'iowacity' => 'Iowa City, IA',
				'jacksonmi' => 'Jackson, MI',
				'jackson' => 'Jackson, MS',
				'jacksontn' => 'Jackson, TN',
				'jacksonville' => 'Jacksonville, FL',
				'jacksonvillenc' => 'Jacksonville, NC',
				'jamestownny' => 'Jamestown, NY',
				'janesville' => 'Janesville, WI',
				'johnsoncity' => 'Johnson City, TN',
				'johnstown' => 'Johnstown, PA',
				'jonesboro' => 'Jonesboro, AR',
				'joplin' => 'Joplin, MO',
				'kalamazoo' => 'Kalamazoo, MI',
				'kc' => 'Kansas City, MO',
				'killeen' => 'Killeen, TX',
				'knoxville' => 'Knoxville, TN',
				'kokomo' => 'Kokomo, IN',
				'lacrosse' => 'La Crosse, WI',
				'lafayettein' => 'Lafayette, IN',
				'lafayettela' => 'Lafayette, LA',
				'lakecharles' => 'Lake Charles, LA',
				'lakeland' => 'Lakeland, FL',
				'lancaster' => 'Lancaster, PA',
				'lansing' => 'Lansing, MI',
				'laredo' => 'Laredo, TX',
				'lascruces' => 'Las Cruces, NM',
				'lasvegas' => 'Las Vegas, NV',
				'lawrenceks' => 'Lawrence, KS',
				'lawtonok' => 'Lawton, OK',
				'lewistonme' => 'Lewiston, ME',
				'lexington' => 'Lexington, KY',
				'lima' => 'Lima, OH',
				'lincoln' => 'Lincoln, NE',
				'littlerock' => 'Little Rock, AR',
				'longviewtx' => 'Longview, TX',
				'la' => 'Los Angeles, CA',
				'louisville' => 'Louisville, KY',
				'lubbock' => 'Lubbock, TX',
				'lynchburg' => 'Lynchburg, VA',
				'macon' => 'Macon, GA',
				'madison' => 'Madison, WI',
				'manchesternh' => 'Manchester, NH',
				'mansfieldoh' => 'Mansfield, OH',
				'mcallen' => 'McAllen, TX',
				'medford' => 'Medford, OR',
				'melbournefl' => 'Melbourne, FL',
				'memphis' => 'Memphis, TN',
				'merced' => 'Merced, CA',
				'meridian' => 'Meridian, MS',
				'miami' => 'Miami, FL',
				'milwaukee' => 'Milwaukee, WI',
				'minneapolis' => 'Minneapolis, MN',
				'missoula' => 'Missoula, MT',
				'mobileal' => 'Mobile, AL',
				'modesto' => 'Modesto, CA',
				'monroela' => 'Monroe, LA',
				'montgomery' => 'Montgomery, AL',
				'muncie' => 'Muncie, IN',
				'myrtlebeach' => 'Myrtle Beach, SC',
				'naples' => 'Naples, FL',
				'nashville' => 'Nashville, TN',
				'natchez' => 'Natchez, MS',
				'newlondon' => 'New London, CT',
				'neworleans' => 'New Orleans, LA',
				'ny' => 'New York, NY',
				'newark' => 'Newark, NJ',
				'norfolk' => 'Norfolk, VA',
				'ocala' => 'Ocala, FL',
				'odessa' => 'Odessa, TX',
				'oklahomacity' => 'Oklahoma City, OK',
				'omaha' => 'Omaha, NE',
				'orlando' => 'Orlando, FL',
				'owensboro' => 'Owensboro, KY',
				'panamacity' => 'Panama City, FL',
				'parkersburg' => 'Parkersburg, WV',
				'pensacola' => 'Pensacola, FL',
				'peoria' => 'Peoria, IL',
				'philly' => 'Philadelphia, PA',
				'phoenix' => 'Phoenix, AZ',
				'pinebluff' => 'Pine Bluff, AR',
				'pittsburgh' => 'Pittsburgh, PA',
				'pittsfieldma' => 'Pittsfield, MA',
				'pocatello' => 'Pocatello, ID',
				'portcharlotte' => 'Port Charlotte, FL',
				'portland' => 'Portland, OR',
				'portlandme' => 'Portland, ME',
				'providence' => 'Providence, RI',
				'provo' => 'Provo, UT',
				'pueblo' => 'Pueblo, CO',
				'puntagorda' => 'Punta Gorda, FL',
				'raleigh' => 'Raleigh, NC',
				'rapidcity' => 'Rapid City, SD',
				'readingpa' => 'Reading, PA',
				'redding' => 'Redding, CA',
				'reno' => 'Reno, NV',
				'richlandwa' => 'Richland, WA',
				'richmond' => 'Richmond, VA',
				'roanoke' => 'Roanoke, VA',
				'rochester' => 'Rochester, NY',
				'rochestermn' => 'Rochester, MN',
				'rockfordil' => 'Rockford, IL',
				'rockymount' => 'Rocky Mount, NC',
				'sacramento' => 'Sacramento, CA',
				'saginaw' => 'Saginaw, MI',
				'salinas' => 'Salinas, CA',
				'saltlakecity' => 'Salt Lake City, UT',
				'sanangelo' => 'San Angelo, TX',
				'sanantonio' => 'San Antonio, TX',
				'sandiego' => 'San Diego, CA',
				'sf' => 'San Francisco, CA',
				'sanluisobispo' => 'San Luis Obispo, CA',
				'santabarbara' => 'Santa Barbara, CA',
				'santafe' => 'Santa Fe, NM',
				'sarasota' => 'Sarasota, FL',
				'savannah' => 'Savannah, GA',
				'scranton' => 'Scranton, PA',
				'seattle' => 'Seattle, WA',
				'sebring' => 'Sebring, FL',
				'sharonpa' => 'Sharon, PA',
				'sheboygan' => 'Sheboygan, WI',
				'shermantx' => 'Sherman, TX',
				'shreveport' => 'Shreveport, LA',
				'siouxcity' => 'Sioux City, IA',
				'siouxfalls' => 'Sioux Falls, SD',
				'southbend' => 'South Bend, IN',
				'spokane' => 'Spokane, WA',
				'springfieldil' => 'Springfield, IL',
				'springfieldma' => 'Springfield, MA',
				'springfieldmo' => 'Springfield, MO',
				'stlouis' => 'St Louis, MO',
				'stcloud' => 'St. Cloud, MN',
				'stjosephmo' => 'St. Joseph, MO',
				'statecollege' => 'State College, PA',
				'steubenville' => 'Steubenville, OH',
				'stockton' => 'Stockton, CA',
				'sumtersc' => 'Sumter, SC',
				'syracuse' => 'Syracuse, NY',
				'tallahassee' => 'Tallahassee, FL',
				'tampa' => 'Tampa, FL',
				'terrehaute' => 'Terre Haute, IN',
				'texarkana' => 'Texarkana, TX',
				'thevillages' => 'The Villages, FL',
				'toccoa' => 'Toccoa, GA',
				'toledo' => 'Toledo, OH',
				'topeka' => 'Topeka, KS',
				'trenton' => 'Trenton, NJ',
				'tucson' => 'Tucson, AZ',
				'tulsa' => 'Tulsa, OK',
				'tuscaloosa' => 'Tuscaloosa, AL',
				'tylertx' => 'Tyler, TX',
				'utica' => 'Utica, NY',
				'victoriatx' => 'Victoria, TX',
				'visalia' => 'Visalia, CA',
				'waco' => 'Waco, TX',
				'dc' => 'Washington, DC',
				'waterlooia' => 'Waterloo, IA',
				'wausau' => 'Wausau, WI',
				'westpalmbeach' => 'West Palm Beach, FL',
				'wheeling' => 'Wheeling-Steubenville, WV',
				'wichita' => 'Wichita, KS',
				'wichitafallstx' => 'Wichita Falls, TX',
				'williamsportpa' => 'Williamsport, PA',
				'wilmington' => 'Wilmington, NC',
				'winstonsalem' => 'Winston-Salem, NC',
				'winterhaven' => 'Winter Haven, FL',
				'woodbridge' => 'Woodbridge, VA',
				'yakima' => 'Yakima, WA',
				'yorkpa' => 'York, PA',
				'youngstown' => 'Youngstown, OH',
				'yubacity' => 'Yuba City, CA',
				'yuma' => 'Yuma, AZ',
				'abbotsford' => 'Abbotsford',
				'barrie' => 'Barrie',
				'brantford' => 'Brantford',
				'calgary' => 'Calgary',
				'charlottetown' => 'Charlottetown',
				'chathamkent' => 'Chatham-Kent',
				'edmonton' => 'Edmonton',
				'guelph' => 'Guelph',
				'halifaxns' => 'Halifax',
				'hamilton' => 'Hamilton',
				'iqaluit' => 'Iqaluit',
				'kelowna' => 'Kelowna',
				'kingstonon' => 'Kingston',
				'kitchener' => 'Kitchener',
				'londonon' => 'London, ON',
				'moncton' => 'Moncton',
				'montreal' => 'Montreal',
				'oshawa' => 'Oshawa',
				'ottawa' => 'Ottawa-Gatineau',
				'peterboroughcan' => 'Peterborough',
				'quebec' => 'Quebec City',
				'regina' => 'Regina',
				'saguenay' => 'Saguenay',
				'saintjohn' => 'Saint John',
				'saskatoon' => 'Saskatoon',
				'sherbrooke' => 'Sherbrooke',
				'niagara' => 'St. Catharines-Niagara',
				'stjohns' => 'St. John\'s',
				'sudbury' => 'Sudbury',
				'thunderbay' => 'Thunder Bay',
				'toronto' => 'Toronto',
				'troisrivieres' => 'Trois-Rivieres',
				'vancouver' => 'Vancouver',
				'victoria' => 'Victoria',
				'whitehorse' => 'Whitehorse',
				'windsor' => 'Windsor',
				'winnipeg' => 'Winnipeg',
				'yellowknife' => 'Yellowknife',
			),
		);

		$options[] = array(
			'section' => 'market',
			'id' => 'oodle_category',
			'title' => 'Default Category',
			'type' => 'select2',
			'std' => 'housing/sale',
			'choices' => array(
				'housing/sale' => 'Property For Sale',
				'housing/rent' => 'Property For Lease',
			),
		);

		// Disclaimer
		$options[] = array(
			'section' => 'disclaimer',
			'id' => 'disclaimer_image',
			'title' => 'Disclaimer Image/Logo',
			'desc' => 'Add a photo to the beginning of the disclaimer.',
			'type' => 'image',
		);

		$options[] = array(
			'section' => 'disclaimer',
			'id' => 'disclaimer',
			'title' => 'Disclaimer',
			'desc' => 'Appears beneath all listings. Available data: %%date_last_updated%%',
			'type' => 'editor',
		);

		// Upgrade section
		$options[] = array(
			'section' => 'upgrade',
			'id' => 'displet_app_key',
			'title' => 'Displet 2.0 RETS/IDX App Key',
			'desc' => 'Upgrading to RETS/IDX data will get you complete & accurate listing data and enhanced functionality. You are currently using the free version, which has the best data that we can provide complimentary - <b>having RETS/IDX data instead offers more listings, more accurate information, more search and property detail fields, more and better photos, and more plugin features</b>.',
			'type' => 'text',
			'class' => 'nohtml'
		);

		$options[] = array(
			'section' => 'upgrade',
			'id' => 'displet_app_token',
			'title' => 'Displet 2.0 RETS/IDX API Password',
			'type' => 'password',
			'class' => 'nohtml'
		);

		// Duty Agent section
		$options[] = array(
			'section' => 'duty-agent',
			'id' => 'duty_agent',
			'title' => 'Duty Agent',
			'desc' => 'Select the agents(s) that new leads should be assigned to. If multiple users are selected, lead assignation will rotate through each agent with each new lead. When a lead is assigned to an agent, inbound emails from the lead will go to the agent and outbound emails to the lead will come from the assigned agent. <a href="' . admin_url('user-new.php#role=displet_agent') . '">Create New Agents Here</a>',
			'type' => 'multi-checkbox',
			'idx' => true,
			'choices' => self::$_choices['admin_and_agent_users'],
		);

		$options[] = array(
			'section' => 'duty-agent',
			'id' => 'duty_agent_use_listing_agent_email',
			'title' => 'Assign To Listing Agent',
			'desc' => 'Check to assign the listing agent as the duty agent (only when the listing agent\'s email exists as a user in WordPress). Requires the listing agent\'s email in your MLS\' RETS feed (most do not include this information).',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		// Duty Lender
		$options[] = array(
			'section' => 'duty-lender',
			'id' => 'duty_lender',
			'title' => 'Duty Lender',
			'desc' => 'Select the lender(s) that new leads should be assigned to. If multiple users are selected, lead assignation will rotate through each lender with each new lead. Duty lenders are in addition to duty agents (i.e. if at least one agent and at least one lender are selected, both will receive the lead). <a href="' . admin_url('user-new.php#role=displet_lender') . '">Create New Lenders Here</a>',
			'type' => 'multi-checkbox',
			'idx' => true,
			'choices' => self::$_choices['admin_and_lender_users'],
		);

		// Property Suggestions section
		$options[] = array(
			'section' => 'property-suggestions',
			'id' => 'use_property_suggestions',
			'title' => 'Send Property Suggestions',
			'desc' => 'Check to email listings to the user based on their viewing history and the criteria below.',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true
		);

		$options[] = array(
			'section' => 'property-suggestions',
			'id' => 'property_suggestions_views_min',
			'title' => 'Number of Property Views to Activate',
			'desc' => 'Enter a whole number, 1 or higher',
			'type' => 'text',
			'class' => 'numeric',
			'min' => 1,
			'std' => 1,
		);

		$options[] = array(
			'section' => 'property-suggestions',
			'id' => 'property_suggestions_zips_min',
			'title' => 'Number of Property Views to Add Zip',
			'desc' => 'Enter a whole number, 3 or higher',
			'type' => 'text',
			'class' => 'numeric',
			'min' => 3,
			'std' => 3,
		);

		$options[] = array(
			'section' => 'property-suggestions',
			'id' => 'property_suggestions_price_variance',
			'title' => 'Price Variance (+/- Median)',
			'desc' => 'Enter a decimal, .25 or lower',
			'type' => 'text',
			'class' => 'numeric',
			'min' => .01,
			'max' => .25,
			'std' => .15,
		);

		$options[] = array(
			'section' => 'property-suggestions',
			'id' => 'property_suggestions_square_footage_variance',
			'title' => 'Square Footage Variance (+/- Median)',
			'desc' => 'Enter a decimal, .25 or lower',
			'type' => 'text',
			'class' => 'numeric',
			'min' => .01,
			'max' => .25,
			'std' => .15,
		);

		// Email Activity section
		$options[] = array(
			'section' => 'email-activity',
			'id' => 'email_activity',
			'title' => 'Send Activity Report',
			'desc' => 'Check to send a daily email containing a summary of recent user activity information to the "Send To" email address above.',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options = array_merge( $options, self::_get_email_template_options( self::$_choices ) );

		if ( DispletRetsIdxUtilities::is_unregistered_address_theme() ) {
			$options[] = array(
				'section' => 'email-templates',
				'id' => 'email_title_unregistered_address',
				'title' => 'Unregistered Address, To Agent - Title',
				'desc' => 'Available data: %%property_address%%, %%site_name%%, and %%site_url%%',
				'type' => 'text',
				'std' => DispletRetsIdxEmailTemplatesModel::get_default_unregistered_address_title(),
			);

			$options[] = array(
				'section' => 'email-templates',
				'id' => 'email_template_unregistered_address',
				'title' => 'Unregistered Address, To Agent - Body',
				'desc' => 'Available data: %%property_address%%, %%site_name%%, and %%site_url%%',
				'type' => 'editor',
				'std' => DispletRetsIdxEmailTemplatesModel::get_default_unregistered_address_message(),
			);
		}

		// Listings section
		$options[] = array(
			'section' => 'listings',
			'id' => 'listings_layout',
			'title' => 'Layout',
			'desc' => 'The default layout of listings to be displayed.',
			'type' => 'select2',
			'std' => 'default',
			'choices' => array(
				'default' => 'Grouped by View (Gallery/List/Map)',
				'table' => 'Grouped by Status (Table)',
			),
		);

		$options[] = array(
			'section' => 'listings',
			'id' => 'listings_orientation',
			'title' => 'View',
			'desc' => 'The default view to be displayed on listings grouped by view. User\'s last choice (in their current browsing session) trumps this setting.',
			'type' => 'select2',
			'std' => 'gallery',
			'choices' => array(
				'gallery' => 'Gallery',
				'list' => 'List',
				'map' => 'Map',
			),
		);

		$options[] = array(
			'section' => 'listings',
			'id' => 'listings_sort',
			'title' => 'Sort',
			'desc' => 'The default order of listings. User\'s last choice (in their current browsing session) trumps this setting.',
			'type' => 'select2',
			'std' => 'price-descending',
			'choices' => array(
				'price-ascending' => 'Price - Low to High',
				'price-descending' => 'Price - High to Low',
				'list-date-descending' => 'List Date - Newest to Oldest',
				'list-date-ascending' => 'List Date - Oldest to Newest',
			),
		);

		$options[] = array(
			'section' => 'listings',
			'id' => 'listings_per_page',
			'title' => 'Listings Per Page',
			'desc' => 'Enter a numeric value from 5-15.',
			'type' => 'text',
			'std' => '10',
			'class' => 'numeric',
			'min' => 5,
			'max' => 15
		);

		$options[] = array(
			'section' => 'listings',
			'id' => 'use_numbered_pagination',
			'title' => 'Numbered Pagination',
			'desc' => 'Check to include page numbers in between Previous and Next links.',
			'type' => 'checkbox',
			'std' => 1,
		);

		// Additional Listing Fields
		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'include_subdivision',
			'title' => 'Show Subdivision',
			'desc' => 'Check to include the subdivision name on each listing.',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'include_mls_number',
			'title' => 'Show MLS Number',
			'desc' => 'Check to include the MLS number on each listing.',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'emphasize_mls_number',
			'title' => 'Emphasize MLS Number',
			'desc' => 'Check to emphasize the MLS number on each listing.',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'include_listing_agent',
			'title' => 'Show Listing Agent',
			'desc' => 'Check to include the listing agent\'s name on each listing.',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'include_listing_office',
			'title' => 'Show Listing Office',
			'desc' => 'Check to include the name of the listing office on each listing.',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'emphasize_listing_office_and_agent',
			'title' => 'Emphasize Listing Office/Agent',
			'desc' => 'Check to emphasize the name of the listing office and listing agent on each listing.',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'include_disclaimer_image',
			'title' => 'Show Disclaimer Image/Logo',
			'desc' => 'Check to include the disclaimer image/logo on each listing.',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'listings-fields',
			'id' => 'use_price_reduction',
			'title' => 'Show Price Reduction',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		// Property Type Navigation section
		$options[] = array(
			'section' => 'property-type-navigation',
			'id' => 'include_property_type_navigation',
			'title' => 'Show Property Type Navigation',
			'desc' => 'Check to include property type navigation (on listings grouped by view only)',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'property-type-navigation',
			'id' => 'include_property_type_sorting',
			'title' => 'Show Property Type Sorting',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		// Price Navigation section
		$options[] = array(
			'section' => 'price-navigation',
			'id' => 'include_price_navigation',
			'title' => 'Show Price Navigation',
			'desc' => 'Check to include price navigation (on listings grouped by view only)',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'price-navigation',
			'id' => 'price_navigation_prices',
			'title' => 'Default Price Navigation Prices',
			'desc' => 'Enter a comma-seprated list of prices (in thousands). Ex. 100,200,300,400,500,750',
			'type' => 'text',
			'class'	  => 'nohtml',
			'idx' => true,
		);

		// Statistics section
		$options[] = array(
			'section' => 'statistics',
			'id' => 'include_stats',
			'title' => 'Show Statistics',
			'type' => 'select2',
			'std' => 'basic',
			'choices' => array(
				'no' => 'None',
				'basic' => 'Basic',
				'advanced' => 'Advanced',
			),
			'idx' => true,
		);

		// Property details section
		$options[] = array(
			'section' => 'property-details',
			'id' => 'property_details_page_id',
			'title' => 'Property Details Page',
			'type' => 'select2',
			'std' => self::$_defaults['rets_page_id'],
			'choices' => self::$_choices['pages'],
		);

		if ( function_exists( 'is_plugin_active' ) && is_plugin_active('displet-property-showcase/displet-property-showcase.php') ) {
			$options[] = array(
				'section' => 'property-details',
				'id' => 'use_pdp_for_showcase_details',
				'title' => 'Use Property Details Page for Displet Property Showcase listings',
				'desc' => 'Check to use the Displet RETS/IDX Property Details Page for listings from Displet Property Showcae',
				'type' => 'checkbox',
				'std' => 0,
			);
		}

		// Property details planwise section
		$options[] = array(
			'section' => 'pdp-planwise',
			'id' => 'use_planwise_affordability',
			'title' => 'Show PlanWise Widget',
			'desc' => 'Check to include an affordability widget',
			'type' => 'checkbox',
			'std' => 1,
		);

		// Property details similar properties section
		$options[] = array(
			'section' => 'pdp-similar',
			'id' => 'include_similar_properties',
			'title' => 'Similar Properties Slideshow',
			'desc' => 'Check to include a slideshow of similar properties at the bottom of the page',
			'type' => 'checkbox',
			'std' => 1,
		);

		// Additional Listing Fields
		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_subdivision_pdp',
			'title' => 'Show Subdivision',
			'desc' => 'Check to include the subdivision name in the header beneath the address (appears in details regardless of this setting).',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'emphasize_mls_number_pdp',
			'title' => 'Emphasize MLS Number',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_listing_agent_pdp',
			'title' => 'Show Listing Agent Name',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_listing_agent_id',
			'title' => 'Show Listing Agent ID',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_listing_office_pdp',
			'title' => 'Show Listing Office Name',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_listing_office_id',
			'title' => 'Show Listing Office ID',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'emphasize_listing_office_and_agent_pdp',
			'title' => 'Emphasize Listing Office/Agent Name/ID',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_list_date',
			'title' => 'Show List Date',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_modified',
			'title' => 'Show Modified Date',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_foreclosure',
			'title' => 'Show Foreclosure',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_short_sale',
			'title' => 'Show Short Sale',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_longitude',
			'title' => 'Show Longitude',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_latitude',
			'title' => 'Show Latitude',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_feed_image_trans_date',
			'title' => 'Show Feed Image Trans Date',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_sysid',
			'title' => 'Show Sysid',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		$options[] = array(
			'section' => 'pdp-fields',
			'id' => 'include_price_per_square_feet',
			'title' => 'Show Price Per Square Feet',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		// Field Options
		$options[] = array(
			'section' => 'pdp-field-options',
			'id' => 'zip_label',
			'title' => 'Zip Code Label',
			'type' => 'select2',
			'std' => 'zip',
			'idx' => true,
			'choices' => array(
				'zip' => 'Zip',
				'postal_code' => 'Postal Code',
			),
		);

		$options[] = array(
			'section' => 'pdp-field-options',
			'id' => 'pdp_disclaimer_below_photos',
			'title' => 'Move Disclaimer Above Details',
			'type' => 'checkbox',
			'desc' => 'Check to place the disclaimer higher up in the content, beneath the property photos',
			'std' => 0,
		);

		// Photos section
		$options[] = array(
			'section' => 'pdp-photos',
			'id' => 'pdp_force_full_width_photos',
			'title' => 'Force Full Width Photos',
			'desc' => 'Check to enlarge photos if necessary to display full width',
			'type' => 'checkbox',
			'std' => 0,
		);

		// Request Showing section
		$options[] = array(
			'section' => 'showing-request',
			'id' => 'showing_request_require_phone',
			'title' => 'Require Phone',
			'type' => 'checkbox',
			'std' => 1,
			'idx' => true,
		);

		// Search Results section
		$options[] = array(
			'section' => 'search-results',
			'id' => 'search_results_page_id',
			'title' => 'Search Results Page',
			'type' => 'select2',
			'std' => self::$_defaults['rets_page_id'],
			'choices' => self::$_choices['pages'],
		);

		$options[] = array(
			'section' => 'search-results',
			'id' => 'use_polygon_search',
			'title' => 'Polygon Search',
			'type' => 'checkbox',
			'std' => 0,
			'idx' => true,
		);

		// Registration Settings section
		$options[] = array(
			'section' => 'registration-settings',
			'id' => 'registration_type',
			'title' => 'Registration Type',
			'desc' => 'Hard Prompt: the registration window may not be closed. Soft Prompt: the registration window may be closed, but will continue to launch on each property view until login/registration. Back Prompt: the registration window may be closed but returns to the previous page instead of revealing the content underneath.',
			'type' => 'select2',
			'std' => 'hard',
			'choices' => array(
				'hard' => 'Hard Prompt (Default)',
				'soft' => 'Soft Prompt',
				'back' => 'Back Prompt',
			),
		);

		$options[] = array(
			'section' => 'registration-settings',
			'id' => 'require_registration_to_view_properties',
			'title' => 'Prompt From Property Details Page',
			'desc' => 'Check to have the registration window prompt on the property details page.',
			'type' => 'checkbox',
			'std' => 1,
		);

		$options[] = array(
			'section' => 'registration-settings',
			'id' => 'allowed_public_views',
			'title' => 'Registration Required After __ Property Views',
			'desc' => 'Prompt the visitor to register after viewing details of __ properties. Enter 1 to force registration on the first property view (highly recommended).',
			'type' => 'text',
			'std' => '1',
			'class' => 'numeric',
		);

		$options[] = array(
			'section' => 'registration-settings',
			'id' => 'require_registration_to_search',
			'title' => 'Prompt From Search Results Page',
			'desc' => 'Check to have the registration window prompt on the search results page.',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'registration-settings',
			'id' => 'allowed_public_searches',
			'title' => 'Registration Required After __ Property Searches',
			'desc' => 'Prompt the visitor to register after searching __ times. Enter 1 to force registration on the first search.',
			'type' => 'text',
			'std' => '1',
			'class' => 'numeric',
		);

		$options[] = array(
			'section' => 'registration-settings',
			'id' => 'exclude_referred_visitors',
			'title' => 'Exclude Referred Visitors',
			'desc' => 'Registration window only launches if referred from ' . home_url(),
			'type' => 'checkbox',
			'std' => 1,
		);

		$options[] = array(
			'section' => 'registration-settings',
			'id' => 'allow_sitewide_registration',
			'title' => 'Allow Sitewide Registration Prompts',
			'desc' => 'Add the title "Login To View Listings" without quotes to any link to make it a registration prompt link. Other permitted titles: "Sign Up To View Listings", "Login To View Unlimited Listings", "Sign Up To View Unlimited Listings", "Login To Save Listings", "Sign Up To Save Listings", "Login To Save Searches" and "Sign Up To Save Searches"',
			'type' => 'checkbox',
			'std' => 0,
		);

		// Registration Form section
		$options[] = array(
			'section' => 'registration-form',
			'id' => 'require_phone',
			'title' => 'Require Phone Number',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'registration-form',
			'id' => 'include_working_with_realtor',
			'title' => 'Include Working With Realtor',
			'desc' => 'Check to include an additional field on the registration form which says, "Are you working with a Realtor?"',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'registration-form',
			'id' => 'require_working_with_realtor',
			'title' => 'Require Working With Realtor',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'registration-form',
			'id' => 'registration_title',
			'title' => 'Title',
			'type' => 'text',
			'class' => 'nohtml',
			'std' => 'Please Register To View Details',
		);

		$options[] = array(
			'section' => 'registration-form',
			'id' => 'registration_message',
			'title' => 'Message',
			'type' => 'editor',
			'std' => '<b>Why register?</b> When you register, you will have the ability to save your favorite properties, leave comments, and save searches to update you when new listings hit the market. Use our powerful search tool for free',
		);

		$options[] = array(
			'section' => 'registration-form',
			'id' => 'registration_disclaimer',
			'title' => 'Disclaimer',
			'type' => 'editor',
			'std' => 'Don\'t worry, we hate spam as much as you and would never share your information or send you unsolicited email.',
		);

		// Login Form section
		$options[] = array(
			'section' => 'login-form',
			'id' => 'login_without_password',
			'title' => 'Login Without Password',
			'desc' => 'Check to allow RE Search Users to login without a password.',
			'type' => 'checkbox',
			'std' => 0,
		);

		// Social Logins section
		$options[] = array(
			'section' => 'social-logins',
			'id' => 'facebook_app_id',
			'title' => 'Facebook App ID',
			'type' => 'text',
			'class' => 'nohtml',
			'help'=> 'http://displet.com/wiki/login-with-facebook/'
		);

		$options[] = array(
			'section' => 'social-logins',
			'id' => 'facebook_app_secret',
			'title' => 'Facebook App Secret',
			'type' => 'text',
			'class' => 'nohtml',
			'help'=> 'http://displet.com/wiki/login-with-facebook/'
		);

		$options[] = array(
			'section' => 'social-logins',
			'id' => 'google_client_id',
			'title' => 'Google Client ID',
			'type' => 'text',
			'class' => 'nohtml',
			'help'=> 'http://displet.com/wiki/login-with-google/'
		);

		$options[] = array(
			'section' => 'social-logins',
			'id' => 'google_client_secret',
			'title' => 'Google Client Secret',
			'type' => 'text',
			'class' => 'nohtml',
			'help'=> 'http://displet.com/wiki/login-with-google/'
		);

		$options[] = array(
			'section' => 'social-logins',
			'id' => 'google_api_key',
			'title' => 'Google API Key',
			'type' => 'text',
			'class' => 'nohtml',
			'help'=> 'http://displet.com/wiki/login-with-google/'
		);

		// Blacklisted
		$options[] = array(
			'section' => 'blacklisted',
			'id' => 'blacklisted_names',
			'title' => 'Blacklisted Names',
			'desc' => 'Names matching any phrase listed here will be banned from registering. Enter 1 per line and use %% to match surrounding characters, e.g. %%partial_name%%',
			'type' => 'textarea',
			'class' => 'inlinehtml',
			'std' => '%%asdf%%' . PHP_EOL . 'anus' . PHP_EOL . 'arse' . PHP_EOL . 'arsehole' . PHP_EOL . 'ass' . PHP_EOL . 'ass-hat' . PHP_EOL . 'ass-jabber' . PHP_EOL . 'ass-pirate' . PHP_EOL . 'assbag' . PHP_EOL . 'assbandit' . PHP_EOL . 'assbanger' . PHP_EOL . 'assbite' . PHP_EOL . 'assclown' . PHP_EOL . 'asscock' . PHP_EOL . 'asscracker' . PHP_EOL . 'asses' . PHP_EOL . 'assface' . PHP_EOL . 'assfuck' . PHP_EOL . 'assfucker' . PHP_EOL . 'assgoblin' . PHP_EOL . 'asshat' . PHP_EOL . 'asshead' . PHP_EOL . 'asshole' . PHP_EOL . 'asshopper' . PHP_EOL . 'assjacker' . PHP_EOL . 'asslick' . PHP_EOL . 'asslicker' . PHP_EOL . 'assmonkey' . PHP_EOL . 'assmunch' . PHP_EOL . 'assmuncher' . PHP_EOL . 'assnigger' . PHP_EOL . 'asspirate' . PHP_EOL . 'assshit' . PHP_EOL . 'assshole' . PHP_EOL . 'asssucker' . PHP_EOL . 'asswad' . PHP_EOL . 'asswipe' . PHP_EOL . 'axwound' . PHP_EOL . 'bampot' . PHP_EOL . 'bastard' . PHP_EOL . 'beaner' . PHP_EOL . 'bitch' . PHP_EOL . 'bitchass' . PHP_EOL . 'bitches' . PHP_EOL . 'bitchtits' . PHP_EOL . 'bitchy' . PHP_EOL . 'blow job' . PHP_EOL . 'blowjob' . PHP_EOL . 'bollocks' . PHP_EOL . 'bollox' . PHP_EOL . 'boner' . PHP_EOL . 'brotherfucker' . PHP_EOL . 'bullshit' . PHP_EOL . 'bumblefuck' . PHP_EOL . 'butt plug' . PHP_EOL . 'butt pirate' . PHP_EOL . 'butt-pirate' . PHP_EOL . 'buttfucka' . PHP_EOL . 'buttfucker' . PHP_EOL . 'camel toe' . PHP_EOL . 'carpetmuncher' . PHP_EOL . 'chesticle' . PHP_EOL . 'chinc' . PHP_EOL . 'chink' . PHP_EOL . 'choad' . PHP_EOL . 'chode' . PHP_EOL . 'clit' . PHP_EOL . 'clitface' . PHP_EOL . 'clitfuck' . PHP_EOL . 'clusterfuck' . PHP_EOL . 'cock' . PHP_EOL . 'cockass' . PHP_EOL . 'cockbite' . PHP_EOL . 'cockburger' . PHP_EOL . 'cockface' . PHP_EOL . 'cockfucker' . PHP_EOL . 'cockhead' . PHP_EOL . 'cockjockey' . PHP_EOL . 'cockknoker' . PHP_EOL . 'cockmaster' . PHP_EOL . 'cockmongler' . PHP_EOL . 'cockmongruel' . PHP_EOL . 'cockmonkey' . PHP_EOL . 'cockmuncher' . PHP_EOL . 'cocknose' . PHP_EOL . 'cocknugget' . PHP_EOL . 'cockshit' . PHP_EOL . 'cocksmith' . PHP_EOL . 'cocksmoke' . PHP_EOL . 'cocksmoker' . PHP_EOL . 'cocksniffer' . PHP_EOL . 'cocksucker' . PHP_EOL . 'cockwaffle' . PHP_EOL . 'coochie' . PHP_EOL . 'coochy' . PHP_EOL . 'coon' . PHP_EOL . 'cooter' . PHP_EOL . 'cracker' . PHP_EOL . 'cum' . PHP_EOL . 'cumbubble' . PHP_EOL . 'cumdumpster' . PHP_EOL . 'cumguzzler' . PHP_EOL . 'cumjockey' . PHP_EOL . 'cumslut' . PHP_EOL . 'cumtart' . PHP_EOL . 'cunnie' . PHP_EOL . 'cunnilingus' . PHP_EOL . 'cunt' . PHP_EOL . 'cuntass' . PHP_EOL . 'cuntface' . PHP_EOL . 'cunthole' . PHP_EOL . 'cuntlicker' . PHP_EOL . 'cuntrag' . PHP_EOL . 'cuntslut' . PHP_EOL . 'dago' . PHP_EOL . 'damn' . PHP_EOL . 'deggo' . PHP_EOL . 'dick' . PHP_EOL . 'dick-sneeze' . PHP_EOL . 'dickbag' . PHP_EOL . 'dickbeaters' . PHP_EOL . 'dickface' . PHP_EOL . 'dickfuck' . PHP_EOL . 'dickfucker' . PHP_EOL . 'dickhead' . PHP_EOL . 'dickhole' . PHP_EOL . 'dickjuice' . PHP_EOL . 'dickmilk' . PHP_EOL . 'dickmonger' . PHP_EOL . 'dicks' . PHP_EOL . 'dickslap' . PHP_EOL . 'dicksucker' . PHP_EOL . 'dicksucking' . PHP_EOL . 'dicktickler' . PHP_EOL . 'dickwad' . PHP_EOL . 'dickweasel' . PHP_EOL . 'dickweed' . PHP_EOL . 'dickwod' . PHP_EOL . 'dike' . PHP_EOL . 'dildo' . PHP_EOL . 'dipshit' . PHP_EOL . 'doochbag' . PHP_EOL . 'dookie' . PHP_EOL . 'douche' . PHP_EOL . 'douche-fag' . PHP_EOL . 'douchebag' . PHP_EOL . 'douchewaffle' . PHP_EOL . 'dumass' . PHP_EOL . 'dumb ass' . PHP_EOL . 'dumbass' . PHP_EOL . 'dumbfuck' . PHP_EOL . 'dumbshit' . PHP_EOL . 'dumshit' . PHP_EOL . 'dyke' . PHP_EOL . 'fag' . PHP_EOL . 'fagbag' . PHP_EOL . 'fagfucker' . PHP_EOL . 'faggit' . PHP_EOL . 'faggot' . PHP_EOL . 'faggotcock' . PHP_EOL . 'fagtard' . PHP_EOL . 'fatass' . PHP_EOL . 'fellatio' . PHP_EOL . 'feltch' . PHP_EOL . 'flamer' . PHP_EOL . 'fuck' . PHP_EOL . 'fuckass' . PHP_EOL . 'fuckbag' . PHP_EOL . 'fuckboy' . PHP_EOL . 'fuckbrain' . PHP_EOL . 'fuckbutt' . PHP_EOL . 'fuckbutter' . PHP_EOL . 'fucked' . PHP_EOL . 'fucker' . PHP_EOL . 'fuckersucker' . PHP_EOL . 'fuckface' . PHP_EOL . 'fuckhead' . PHP_EOL . 'fuckhole' . PHP_EOL . 'fuckin' . PHP_EOL . 'fucking' . PHP_EOL . 'fucknut' . PHP_EOL . 'fucknutt' . PHP_EOL . 'fuckoff' . PHP_EOL . 'fucks' . PHP_EOL . 'fuckstick' . PHP_EOL . 'fucktard' . PHP_EOL . 'fucktart' . PHP_EOL . 'fuckup' . PHP_EOL . 'fuckwad' . PHP_EOL . 'fuckwit' . PHP_EOL . 'fuckwitt' . PHP_EOL . 'fudgepacker' . PHP_EOL . 'gay' . PHP_EOL . 'gayass' . PHP_EOL . 'gaybob' . PHP_EOL . 'gaydo' . PHP_EOL . 'gayfuck' . PHP_EOL . 'gayfuckist' . PHP_EOL . 'gaylord' . PHP_EOL . 'gaytard' . PHP_EOL . 'gaywad' . PHP_EOL . 'goddamn' . PHP_EOL . 'goddamnit' . PHP_EOL . 'gooch' . PHP_EOL . 'gook' . PHP_EOL . 'gringo' . PHP_EOL . 'guido' . PHP_EOL . 'handjob' . PHP_EOL . 'hard on' . PHP_EOL . 'heeb' . PHP_EOL . 'hell' . PHP_EOL . 'hoe' . PHP_EOL . 'homo' . PHP_EOL . 'homodumbshit' . PHP_EOL . 'honkey' . PHP_EOL . 'humping' . PHP_EOL . 'jackass' . PHP_EOL . 'jagoff' . PHP_EOL . 'jap' . PHP_EOL . 'jerk off' . PHP_EOL . 'jerkass' . PHP_EOL . 'jigaboo' . PHP_EOL . 'jizz' . PHP_EOL . 'jungle bunny' . PHP_EOL . 'junglebunny' . PHP_EOL . 'kike' . PHP_EOL . 'kooch' . PHP_EOL . 'kootch' . PHP_EOL . 'kraut' . PHP_EOL . 'kunt' . PHP_EOL . 'kyke' . PHP_EOL . 'lameass' . PHP_EOL . 'lardass' . PHP_EOL . 'lesbian' . PHP_EOL . 'lesbo' . PHP_EOL . 'lezzie' . PHP_EOL . 'mcfagget' . PHP_EOL . 'mick' . PHP_EOL . 'minge' . PHP_EOL . 'mothafucka' . PHP_EOL . 'mothafuckin' . PHP_EOL . 'motherfucker' . PHP_EOL . 'motherfucking' . PHP_EOL . 'muff' . PHP_EOL . 'muffdiver' . PHP_EOL . 'munging' . PHP_EOL . 'negro' . PHP_EOL . 'nigaboo' . PHP_EOL . 'nigga' . PHP_EOL . 'nigger' . PHP_EOL . 'niggers' . PHP_EOL . 'niglet' . PHP_EOL . 'nut sack' . PHP_EOL . 'nutsack' . PHP_EOL . 'paki' . PHP_EOL . 'panooch' . PHP_EOL . 'pecker' . PHP_EOL . 'peckerhead' . PHP_EOL . 'penis' . PHP_EOL . 'penisbanger' . PHP_EOL . 'penisfucker' . PHP_EOL . 'penispuffer' . PHP_EOL . 'piss' . PHP_EOL . 'pissed' . PHP_EOL . 'pissed off' . PHP_EOL . 'pissflaps' . PHP_EOL . 'polesmoker' . PHP_EOL . 'pollock' . PHP_EOL . 'poon' . PHP_EOL . 'poonani' . PHP_EOL . 'poonany' . PHP_EOL . 'poontang' . PHP_EOL . 'porch monkey' . PHP_EOL . 'porchmonkey' . PHP_EOL . 'prick' . PHP_EOL . 'punanny' . PHP_EOL . 'punta' . PHP_EOL . 'pussies' . PHP_EOL . 'pussy' . PHP_EOL . 'pussylicking' . PHP_EOL . 'puto' . PHP_EOL . 'queef' . PHP_EOL . 'queer' . PHP_EOL . 'queerbait' . PHP_EOL . 'queerhole' . PHP_EOL . 'renob' . PHP_EOL . 'rimjob' . PHP_EOL . 'ruski' . PHP_EOL . 'sand nigger' . PHP_EOL . 'sandnigger' . PHP_EOL . 'schlong' . PHP_EOL . 'scrote' . PHP_EOL . 'shit' . PHP_EOL . 'shitass' . PHP_EOL . 'shitbag' . PHP_EOL . 'shitbagger' . PHP_EOL . 'shitbrains' . PHP_EOL . 'shitbreath' . PHP_EOL . 'shitcanned' . PHP_EOL . 'shitcunt' . PHP_EOL . 'shitdick' . PHP_EOL . 'shitface' . PHP_EOL . 'shitfaced' . PHP_EOL . 'shithead' . PHP_EOL . 'shithole' . PHP_EOL . 'shithouse' . PHP_EOL . 'shitspitter' . PHP_EOL . 'shitstain' . PHP_EOL . 'shitter' . PHP_EOL . 'shittiest' . PHP_EOL . 'shitting' . PHP_EOL . 'shitty' . PHP_EOL . 'shiz' . PHP_EOL . 'shiznit' . PHP_EOL . 'skank' . PHP_EOL . 'skeet' . PHP_EOL . 'skullfuck' . PHP_EOL . 'slut' . PHP_EOL . 'slutbag' . PHP_EOL . 'smeg' . PHP_EOL . 'snatch' . PHP_EOL . 'spic' . PHP_EOL . 'spick' . PHP_EOL . 'splooge' . PHP_EOL . 'spook' . PHP_EOL . 'suckass' . PHP_EOL . 'tard' . PHP_EOL . 'testicle' . PHP_EOL . 'thundercunt' . PHP_EOL . 'tit' . PHP_EOL . 'titfuck' . PHP_EOL . 'tits' . PHP_EOL . 'tittyfuck' . PHP_EOL . 'twat' . PHP_EOL . 'twatlips' . PHP_EOL . 'twats' . PHP_EOL . 'twatwaffle' . PHP_EOL . 'unclefucker' . PHP_EOL . 'va-j-j' . PHP_EOL . 'vag' . PHP_EOL . 'vagina' . PHP_EOL . 'vajayjay' . PHP_EOL . 'vjayjay' . PHP_EOL . 'wank' . PHP_EOL . 'wankjob' . PHP_EOL . 'wetback' . PHP_EOL . 'whore' . PHP_EOL . 'whorebag' . PHP_EOL . 'whoreface' . PHP_EOL . 'wop',
			'explicit' => true,
		);

		$options[] = array(
			'section' => 'blacklisted',
			'id' => 'blacklisted_emails',
			'title' => 'Blacklisted Emails',
			'desc' => 'Email addresses matching any phrase listed here will be banned from registering. Enter 1 per line and use %% to match surrounding characters, e.g. %%partial_email%%',
			'type' => 'textarea',
			'class' => 'inlinehtml',
			'std' => '%%eat_shit%%' . PHP_EOL . '%%eat-shit%%' . PHP_EOL . '%%eatshit%%' . PHP_EOL . '%%fuck_off%%' . PHP_EOL . '%%fuck-off%%' . PHP_EOL . '%%fuckoff%%' . PHP_EOL . '%%fuck_you%%' . PHP_EOL . '%%fuck-you%%' . PHP_EOL . '%%fuckyou%%' . PHP_EOL . 'fu@%%' . PHP_EOL . '%%go_to_hell%%' . PHP_EOL . '%%go-to-hell%%' . PHP_EOL . '%%gotohell%%',
			'explicit' => true,
		);

		// Save Search Registration
		$options[] = array(
			'section' => 'saved-search-registration',
			'id' => 'save_search_registration_title',
			'title' => 'Title',
			'type' => 'text',
			'class' => 'nohtml',
			'std' => 'Sign Up For Saved Search Updates',
		);

		$options[] = array(
			'section' => 'saved-search-registration',
			'id' => 'allow_sitewide_save_search_registrations',
			'title' => 'Allow Sitewide Save Search Registration Prompts',
			'desc' => 'Add the title "Sign Up For Property Updates" without quotes to any link to make it a registration prompt link. Other permitted titles: "Sign Up To Save Searches" and "Sign Up For Saved Search Updates"',
			'type' => 'checkbox',
			'std' => 0,
		);

		// SEO Property Details Page
		$options[] = array(
			'section' => 'seo-pdp',
			'id' => 'property_details_page_title',
			'title' => 'Title Format',
			'desc' => 'How should the title be formatted on Property Details pages? Available data: %%address%%, %%city%%, %%state%%, %%zip_code%%, %%subdivision%%, %%mls_number%%',
			'type' => 'text',
			'std' => '%%address%%, %%city%%, %%state%% %%zip_code%%',
			'class' => 'inlinehtml',
		);

		$options[] = array(
			'section' => 'seo-pdp',
			'id' => 'property_details_page_h1',
			'title' => 'H1 Format',
			'desc' => 'How should the H1 (page title) be formatted on Property Details pages? Available data: %%address%%, %%city%%, %%state%%, %%zip_code%%, %%subdivision%%, %%mls_number%%',
			'type' => 'text',
			'std' => '%%address%%, %%city%%, %%state%% %%zip_code%%',
			'class' => 'inlinehtml',
		);

		// SEO Partial Address Page
		$options[] = array(
			'section' => 'seo-partial-address',
			'id' => 'partial_address_page_title',
			'title' => 'Title Format',
			'desc' => 'How should the title be formatted on Partial Address pages? Available data: %%city%%, %%state%%, %%zip_code%%',
			'type' => 'text',
			'std' => '%%city%%, %%state%% %%zip_code%%',
			'class' => 'inlinehtml',
		);

		$options[] = array(
			'section' => 'seo-partial-address',
			'id' => 'partial_address_page_h1',
			'title' => 'H1 Format',
			'desc' => 'How should the H1 (page title) be formatted on Partial Address pages? Available data: %%city%%, %%state%%, %%zip_code%%',
			'type' => 'text',
			'std' => '%%city%%, %%state%% %%zip_code%%',
			'class' => 'inlinehtml',
		);

		// SEO Search Results Page
		$options[] = array(
			'section' => 'seo-search-results',
			'id' => 'no_index_no_follow_search_results_page',
			'title' => 'Noindex, Nofollow',
			'desc' => 'Check to add a meta tag that encourages search engines not to index the content on your Search Results page.',
			'type' => 'checkbox',
			'std' => 0,
		);

		// Listings Format section
		$options[] = array(
			'section' => 'listings-format',
			'id' => 'address_format',
			'title' => 'Address Format',
			'desc' => 'How should addresses be formatted sitewide? Available data: %%street_number%%, %%street_name%%, %%street_pre_direction%%, %%street_post_direction%%, %%unit%% - Ex. %%street_number%% %%street_pre_direction%% %%street_name%% %%street_post_direction%% #%%unit%% = 1234 N Main St #301',
			'type' => 'text',
			'std' => '%%street_number%% %%street_pre_direction%% %%street_name%% %%street_post_direction%% #%%unit%%'
		);

		// Property Filter section
		$options[] = array(
			'section' => 'property-filter',
			'id' => 'property_type_include_filter',
			'title' => 'Property Types',
			'desc' => 'Includes listings only from the selected property type(s). Leave all unchecked to include all property types.',
			'type' => 'multi-checkbox',
			'idx' => true,
			'choices' => self::$_choices['property_types'],
		);

		$options[] = array(
			'section' => 'property-filter',
			'id' => 'zip_code_include_filter',
			'title' => 'Zip Code Include',
			'desc' => 'Enter one per line. Includes listings only from these zip codes. Leave blank to include all zip codes.',
			'type' => 'textarea',
			'idx' => true,
		);

		$options[] = array(
			'section' => 'property-filter',
			'id' => 'city_include_filter',
			'title' => 'City Include',
			'desc' => 'Includes listings only from the selected cities. Leave all unchecked to include all cities.',
			'type' => 'multi-checkbox',
			'idx' => true,
			'choices' => self::$_choices['cities'],
		);

		$options[] = array(
			'section' => 'property-filter',
			'id' => 'min_price_filter',
			'title' => 'Minimum Price',
			'desc' => 'Enter the minimum price (in thousands). Ex. 100 = $100,000. Excludes listings that are less expensive. Leave blank to not have a minimum price.',
			'type' => 'text',
			'idx' => true,
		);

		$options[] = array(
			'section' => 'property-filter',
			'id' => 'max_price_filter',
			'title' => 'Maximum Price',
			'desc' => 'Enter the maximum price (in thousands). Ex. 1000 = $1,000,000. Excludes listings that are more expensive. Leave blank to not have a maximum price.',
			'type' => 'text',
			'idx' => true,
		);

		// CRM section
		$options[] = array(
			'section' => 'crm',
			'id' => 'zapier_registration_url',
			'title' => 'Zapier Webhook URL(s) - User Registration',
			'desc' => 'Enter one URL per line. Multiple entries for multiple zaps.',
			'type' => 'textarea',
			'class' => '',
			'help'=> 'http://displet.com/wiki/zapier-integration/'
		);

		$options[] = array(
			'section' => 'crm',
			'id' => 'zapier_showing_url',
			'title' => 'Zapier Webhook URL(s) - Property Showing Request',
			'desc' => 'Enter one URL per line. Multiple entries for multiple zaps.',
			'type' => 'textarea',
			'class' => '',
			'help'=> 'http://displet.com/wiki/zapier-integration/'
		);

		// Mobile section
		$options[] = array(
			'section' => 'mobile',
			'id' => 'mobile_version',
			'title' => 'Mobile RETS/IDX Search',
			'desc' => 'Check to prompt visitors on mobile devices to be redirected to the mobile-specific RETS/IDX search',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'mobile',
			'id' => 'mobile_header_title',
			'title' => 'Mobile RETS/IDX Header - Title',
			'desc' => 'If the above setting is enabled, enter the title to be displayed in the header of the mobile-specific RETS/IDX pages.',
			'type' => 'text',
			'class'	  => 'nohtml'
		);

		$options[] = array(
			'section' => 'mobile',
			'id' => 'mobile_header_text',
			'title' => 'Mobile RETS/IDX Header - Text',
			'desc' => 'If Mobile RETS/IDX Search is enabled above, enter any text to be displayed in the header of the mobile-specific RETS/IDX pages.',
			'type' => 'editor',
		);

		$options[] = array(
			'section' => 'mobile',
			'id' => 'use_nearby_listings',
			'title' => 'Include Nearby Listings Search',
			'desc' => 'Check to incluce a link in the mobile search that will find nearby listings.',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'mobile',
			'id' => 'mobile_footer',
			'title' => 'Mobile RETS/IDX Footer',
			'desc' => 'If Mobile RETS/IDX Search is enabled above, enter any information here to be displayed in the header of the mobile-specific RETS/IDX pages.',
			'type' => 'editor',
		);

		$options[] = array(
			'section' => 'mobile',
			'id' => 'mobile_email',
			'title' => 'Mobile RETS/IDX Contact Page - Email',
			'desc' => 'If Mobile RETS/IDX Search is enabled above, enter the email address to be displayed on the mobile-specific contact pages.',
			'type' => 'text',
			'class'	  => 'email'
		);

		// Miscellaneous section
		$options[] = array(
			'section' => 'misc',
			'id' => 'disable_custom_templates',
			'title' => 'Disable Custom Templates',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'misc',
			'id' => 'allow_sitewide_showing_requests',
			'title' => 'Allow Sitewide Showing Requests',
			'desc' => 'Add the title "Request A Showing" without quotes to any link to make it a showing request link. Other permitted titles: "Schedule A Showing", "Request Property Information"',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'misc',
			'id' => 'add_price_to_url',
			'title' => 'Append Price to URL',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'misc',
			'id' => 'map_variance',
			'title' => 'Max Latitudinal/Longitudinal Variance',
			'desc' => 'Degrees from the average latitude and longitude that a map marker may be plotted.',
			'type' => 'text',
			'std' => '2',
			'class' => 'numeric',
		);

		$options[] = array(
			'section' => 'misc',
			'id' => 'no_link',
			'title' => 'Plain Text Citation',
			'type' => 'checkbox',
			'std' => 0,
		);

		$options[] = array(
			'section' => 'misc',
			'id' => 'results_limit',
			'title' => 'Limit Results to ____ Listings',
			'desc' => 'How many listings per search may the user view? Leave blank to allow the user to view all results (recommended unless required otherwise by your MLS).',
			'type' => 'text',
			'class' => 'numeric',
			'idx' => true
		);

		$options[] = array(
			'section' => 'misc',
			'id' => 'board_translations',
			'title' => 'Agent/Office Name Translations',
			'type' => 'select2',
			'choices' => array(
				'none' => 'None',
				'barmls' => 'BARMLS',
				'ccar' => 'CCAR',
				'gamls' => 'GAMLS',
				'nneren' => 'NNEREN',
			),
			'std' => 'none',
			'idx' => true
		);

		self::$_settings = $options;
	}

	private static function _set_page_choices() {
		$pages = get_pages();
		self::$_choices['pages'] = DispletRetsIdxOptionsController::get_associative_array_from_post_objects( $pages );
	}

	private static function _set_user_choices() {
		$admin_users = get_users( array(
			'role' => 'administrator',
		) );
		if ( !empty( $admin_users ) ) {
			foreach ( $admin_users as $user ) {
				self::$_choices['admin_and_agent_users'][ $user->ID ] = $user->display_name;
				self::$_choices['admin_and_lender_users'][ $user->ID ] = $user->display_name;
			}
		}
		$agent_users = get_users( array(
			'role' => 'displet_agent',
		) );
		if ( !empty( $agent_users ) ) {
			foreach ( $agent_users as $user ) {
				self::$_choices['admin_and_agent_users'][ $user->ID ] = $user->display_name;
			}
		}
		$lender_users = get_users( array(
			'role' => 'displet_lender',
		) );
		if ( !empty( $lender_users ) ) {
			foreach ( $lender_users as $user ) {
				self::$_choices['admin_and_lender_users'][ $user->ID ] = $user->display_name;
			}
		}
	}
}

?>