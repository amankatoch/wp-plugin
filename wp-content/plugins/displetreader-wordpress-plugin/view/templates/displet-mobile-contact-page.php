<?php displetretsidx_get_template_part( 'displet-mobile-header' ); ?>

<div id="displet-mobile-contact-page" class="<?php displetretsidx_the_default_mobile_styles_class(); ?>">

	<?php displetretsidx_the_mobile_contact_page_top(); ?>

	<div class="displet-contact">
		<?php if ( displetretsidx_has_phone() ) : ?>
			<div class="displet-phone">
				<span>
					Phone:
				</span>
				<a href="<?php displetretsidx_the_phone_url(); ?>">
					<?php displetretsidx_the_phone(); ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( displetretsidx_has_email() ) : ?>
			<div class="displet-email">
				<span>
					Email:
				</span>
				<a href="<?php displetretsidx_the_email_url(); ?>">
					<?php displetretsidx_the_email(); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>

	<?php displetretsidx_the_mobile_contact_page_bottom(); ?>

</div>

<?php displetretsidx_get_template_part( 'displet-mobile-footer' ); ?>