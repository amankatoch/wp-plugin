<div id="displet-price-navigation" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<?php if ( displetretsidx_has_caption() ) : ?>
		<div class="displet-title displet-font-color">
			<?php displetretsidx_the_caption(); ?> by Price
		</div>
	<?php endif; ?>
	<div class="displet-table">
		<div class="displet-tr">
			<div class="displet-td">
				<a class="<?php displetretsidx_the_price_navigation_point_class(); ?> active displet-font-color-light" displetminprice="0" displetmaxprice="999999999">
					All Prices
				</a>
			</div>
			<?php $i = 2; ?>
			<?php if ( displetretsidx_have_price_navigation() ) : while ( displetretsidx_have_price_navigation() ) : displetretsidx_the_price_navigation(); ?>
				<?php if ( $i % 3 == 1 ) : ?>
					</div><div class="displet-tr">
				<?php endif; ?>
				<?php if ( displetretsidx_is_first_price_point() ) : ?>
					<div class="displet-td">
						<a class="<?php displetretsidx_the_price_navigation_point_class(); ?> displet-font-color-light" displetminprice="<?php displetretsidx_the_min_price_point(); ?>" displetmaxprice="<?php displetretsidx_the_max_price_point(); ?>">
							Under $<?php displetretsidx_the_pretty_max_price_point(); ?>
						</a>
					</div>
				<?php elseif ( displetretsidx_is_last_price_point() ) : ?>
					<div class="displet-td">
						<a class="displet-price-navigation displet-font-color-light" displetminprice="<?php displetretsidx_the_min_price_point(); ?>" displetmaxprice="<?php displetretsidx_the_max_price_point(); ?>">
							Over $<?php displetretsidx_the_pretty_min_price_point(); ?>
						</a>
					</div>
				<?php else : ?>
					<div class="displet-td">
						<a class="displet-price-navigation displet-font-color-light" displetminprice="<?php displetretsidx_the_min_price_point(); ?>" displetmaxprice="<?php displetretsidx_the_max_price_point(); ?>">
							$<?php displetretsidx_the_pretty_min_price_point(); ?> - $<?php displetretsidx_the_pretty_max_price_point(); ?>
						</a>
					</div>
				<?php endif; ?>
			<?php $i++; endwhile; endif; ?>
		</div>
	</div>
	<?php displetretsidx_the_listings_loading_element(); ?>
</div>