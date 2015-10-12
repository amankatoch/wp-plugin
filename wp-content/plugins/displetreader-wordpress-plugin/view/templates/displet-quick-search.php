<div id="displet-quick-search" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<?php if ( displetretsidx_has_quick_search_title() ) : ?>
		<div class="displet-title">
			<?php displetretsidx_the_quick_search_title(); ?>
		</div>
	<?php endif; ?>
	<div class="displet-inner">
		<div class="displet-table">
			<div class="displet-tr">
				<?php if ( displetretsidx_have_quick_search_columns() ) : while ( displetretsidx_have_quick_search_columns() ) : ?>
					<div class="displet-td displet-group">
						<?php displetretsidx_the_quick_search_column(); ?>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
		<div class="displet-submit">
			<a href="<?php displetretsidx_the_search_results_page_url(); ?>" class="<?php displetretsidx_the_quick_search_submit_class(); ?> displet-button">
				View Results
			</a>
		</div>
		<div class="displet-advanced">
			<a href="<?php displetretsidx_the_search_results_page_url(); ?>">
				Advanced Search
			</a>
		</div>
	</div>
</div>