<?php

class DispletRetsIdxUpdatesModel extends DispletRetsIdxPlugin {
	protected static function get_message( $version ) {
		ob_start();
		call_user_func( array( 'DispletRetsIdxUpdatesModel', 'get_' . $version . '_message' ) );
		$output = ob_get_contents();
		ob_end_clean();
		return trim( str_replace( PHP_EOL, '', $output ) );
	}

	private static function get_2_0_12_message() {
		?>
			<h3>
				Attention: Existing Displet Users
			</h3>
			<p>
				Please take notice that we have recently upgraded our security procedures and have
				<b>
					added an API password
				</b>
				to your settings page. If you have already authenticated,
				<b>
					you do not need to enter a password
				</b>,
				but may wish to request the password for future use by
				<a href="http://displet.zendesk.com" target="_blank">
					submitting a ticket
				</a>.
			</p>
		<?php
	}

	private static function get_2_0_13_message() {
		?>
			<h3>
				New Displet Feature
			</h3>
			<p>
				You can now view your users favorites & saved searches directly from your lead management screen.
				Click the details link next to each lead.
			</p>
		<?php
	}

	private static function get_2_0_25_message() {
		?>
			<h3>
				New Displet Feature
			</h3>
			<p>
				We've given the login/regisration prompt a facelift and new options!
				Take a look on your RE Search Settings page to find the newly added
				<b>
					"soft prompt"
				</b>
				and
				<b>
					"back prompt"
				</b>
				options, which offer more flexibility on how you'd like to encourage registration.
				Soft prompts can be closed, and back prompts return you to the previous page.
			</p>
		<?php
	}

	private static function get_2_0_51_message() {
		?>
			<h3>
				Attn: Facebook Login Changes
			</h3>
			<p>
				If you use Facebook login, there is a new setting that is now required to continue using it.
				Please navigate to
				<a href="<?php echo admin_url( 'admin.php?page=displet-re-search-settings' ) ?>">
					your settings page
				</a>
				and add your
				<b>
					<a href="https://developers.facebook.com/apps" target="_blank">
						Facebook app secret
					</a>
				</b>
				in order to continue using Facebook login.
			</p>
		<?php
	}

	private static function get_2_1_message() {
		?>
			<h3>
				New Search Forms Page
			</h3>
			<p>
				The search fields and search forms have been moved from the Widgets page
				to their own page under the Displet Tools menu. If you have any questions
				on using this feature, let us know via a
				<a href="http://displet.zendesk.com" target="_blank">
					support ticket
				</a>
				and we'll be happy to help.
			</p>
		<?php
	}

	private static function get_welcome_message() {
		?>
			<h3>
				Welcome
			</h3>
			<p>
				Thank you for installing the Displet RETS/IDX Plugin.
				Check out our
				<a href="http://displet.com/wiki/2-0-quick-start-guide/" target="_blank">
					quick start guide
				</a>
				in addition to other
				<a href="http://displet.com/wiki" target="_blank">
					helpful tutorials from our Wiki
				</a>
				to leverage the most benefits we have to offer.
			</p>
		<?php
	}
}

?>