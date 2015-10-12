<div id="displet-stats-advanced" class="<?php displetretsidx_the_default_styles_class(); ?>">
	<div class="displet-tabs displet-group">
		<?php if ( displetretsidx_have_advanced_stats() ) : while ( displetretsidx_have_advanced_stats() ) : displetretsidx_the_advanced_stats(); ?>
			<a class="<?php displetretsidx_the_advanced_stats_tab_class(); ?>" href="javascript:;" for="<?php displetretsidx_the_advanced_stats_tab_for(); ?>">
				<?php displetretsidx_the_advanced_stats_status(); ?>
				<span>
					<?php displetretsidx_the_advanced_stats_count(); ?>
				</span>
			</a>
		<?php endwhile; endif; ?>
	</div>
	<?php if ( displetretsidx_have_advanced_stats() ) : while ( displetretsidx_have_advanced_stats() ) : displetretsidx_the_advanced_stats(); ?>
		<div class="<?php displetretsidx_the_advanced_stats_content_class(); ?>" for="<?php displetretsidx_the_advanced_stats_content_for(); ?>">
			<div class="displet-table">
				<?php if ( displetretsidx_have_advanced_stats_data() ) : ?>
					<div class="displet-tr">
						<div class="displet-td">
							<?php displetretsidx_the_advanced_stats_count(); ?>
							Total Listings
						</div>
						<div class="displet-td">
							Avg Price = $
							<?php displetretsidx_the_average_price(); ?>
						</div>
						<div class="displet-td">
							Avg $/SF = $
							<?php displetretsidx_the_advanced_stats_average_price_per_square_foot(); ?>
						</div>
					</div>
					<div class="displet-tr">
						<div class="displet-td">
							Avg Size =
							<?php displetretsidx_the_average_square_footage(); ?>
							Sq Ft
						</div>
						<div class="displet-td">
							Avg Beds =
							<?php displetretsidx_the_advanced_stats_average_bedrooms(); ?>
						</div>
						<div class="displet-td">
							Avg Baths =
							<?php displetretsidx_the_advanced_stats_average_bathrooms(); ?>
						</div>
					</div>
				<?php else : ?>
					<div class="displet-tr">
						<div class="displet-td">
							No listings available.
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endwhile; endif; ?>
</div>