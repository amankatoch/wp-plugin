<?php displetretsidx_get_template_part( 'displet-mobile-header' ); ?>

<div id="displet-mobile-home-page" class="<?php displetretsidx_the_default_mobile_styles_class(); ?>">
	<div id="displet-quick-search" class="<?php displetretsidx_the_default_mobile_styles_class(); ?>">
		<?php displetretsidx_get_mobile_quick_search_form(); ?>
		<?php if ( displetretsidx_use_nearby_listings() ) : ?>
			<a class="<?php displetretsidx_the_nearby_listings_class(); ?>" href="<?php displetretsidx_the_mobile_search_url(); ?>">
				<i class="fa fa-compass fa-2x"></i>
				Nearby Listings
				<?php displetretsidx_the_nearby_listings_loading_element(); ?>
			</a>
		<?php endif; ?>
		<div class="displet-submit">
			<a class="<?php displetretsidx_the_quick_search_submit_class(); ?>" href="<?php displetretsidx_the_mobile_search_url(); ?>">
				<i class="fa fa-search fa-lg"></i>
				View Homes
			</a>
		</div>
	</div>
	<?php if ( displetretsidx_has_mobile_menu() ) : ?>
		<div class="displet-menu">
			<?php displetretsidx_the_mobile_menu(); ?>
		</div>
	<?php endif; ?>
</div>

<?php displetretsidx_get_template_part( 'displet-mobile-footer' ); ?>