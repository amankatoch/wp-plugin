<div id="displet-search-form" class="<?php displetretsidx_the_default_styles_class(); ?>">
	<div class="displet-forms">
		<div class="displet-table">
			<div class="displet-tr">
				<?php if ( displetretsidx_have_search_form_columns() ) : while ( displetretsidx_have_search_form_columns() ) : ?>
					<div class="displet-td displet-group">
						<?php displetretsidx_the_search_form_column(); ?>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
		<div class="<?php displetretsidx_the_advanced_search_form_class(); ?>">
			<div class="displet-table">
				<div class="displet-tr">
					<?php if ( displetretsidx_have_advanced_search_form_columns() ) : while ( displetretsidx_have_advanced_search_form_columns() ) : ?>
						<div class="displet-td displet-group">
							<?php displetretsidx_the_advanced_search_form_column(); ?>
						</div>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="displet-submit displet-group">
		<?php if ( displetretsidx_have_advanced_search_form_columns() ) : ?>
			<a href="javascript:;" class="<?php displetretsidx_the_advanced_search_form_toggle_class(); ?>">
				<span class="displet-more-fields">
					More Search Fields
				</span>
				<span class="displet-less-fields">
					Less Search Fields
				</span>
			</a>
		<?php endif; ?>
		<div class="displet-right displet-group">
			<a class="<?php displetretsidx_the_save_search_class(); ?>" href="javascript:;">
				Save Search
			</a>
			<div class="displet-space"></div>
			<a class="<?php displetretsidx_the_submit_search_class(); ?>" href="javascript:;">
				Submit Search
			</a>
		</div>
	</div>
</div>