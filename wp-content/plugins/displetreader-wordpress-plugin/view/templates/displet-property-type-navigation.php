<div id="displet-property-type-navigation" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<div class="displet-table">
		<div class="displet-tr">
			<div class="displet-td">
				<a class="<?php displetretsidx_the_property_type_point_class(); ?> active displet-font-color-light" displetpropertytype="all">
					All Property Types
				</a>
			</div>
			<?php $i = 2; if ( displetretsidx_have_property_type_navigation() ) : while ( displetretsidx_have_property_type_navigation() ) : displetretsidx_the_property_type_navigation(); ?>
				<?php if ($i % 3 == 1) : ?>
					</div><div class="displet-tr">
				<?php endif; ?>
				<div class="displet-td">
					<a class="<?php displetretsidx_the_property_type_point_class(); ?> displet-font-color-light" displetpropertytype="<?php displetretsidx_the_property_type_point(); ?>">
						<?php displetretsidx_the_property_type_point(); ?>
					</a>
				</div>
			<?php $i++; endwhile; endif; ?>
		</div>
	</div>
	<?php displetretsidx_the_listings_loading_element(); ?>
</div>