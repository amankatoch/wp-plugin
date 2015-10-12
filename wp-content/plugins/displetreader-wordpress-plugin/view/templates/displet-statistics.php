<div id="displet-stats" class="<?php displetretsidx_the_default_styles_class(); ?> <?php displetretsidx_the_color_scheme_class(); ?>">
	<?php if ( displetretsidx_have_listings() ) : ?>
		<?php if ( displetretsidx_has_caption() ) : ?>
			<div class="displet-title displet-font-color">
				<?php displetretsidx_the_caption(); ?>
			</div>
		<?php endif; ?>
		<table>
			<tr>
				<?php if ( displetretsidx_has_lowest_price() && displetretsidx_has_highest_price() ) : ?>
					<th scope="row" class="displet-font-color-light">
						Price Range:
					</th>
					<td>
						$<span class="<?php displetretsidx_the_lowest_price_class(); ?> displet-font-color-light"><?php displetretsidx_the_lowest_price(); ?>
						</span>
						to
						$<span class="<?php displetretsidx_the_highest_price_class(); ?> displet-font-color-light"><?php displetretsidx_the_highest_price(); ?>
						</span>
					</td>
				<?php endif; ?>
				<?php if ( displetretsidx_has_average_price() ) : ?>
					<th scope="row" class="displet-font-color-light">
						Price Average:
					</th>
					<td>
						$<span class="<?php displetretsidx_the_average_price_class(); ?> displet-font-color-light"><?php displetretsidx_the_average_price(); ?>
						</span>
					</td>
				<?php endif; ?>
			</tr>
			<tr>
				<?php if ( displetretsidx_has_lowest_square_footage() || displetretsidx_has_highest_square_footage() ) : ?>
					<th scope="row" class="displet-font-color-light">
						Size Range:
					</th>
					<td>
						<span class="<?php displetretsidx_the_lowest_square_footage_class(); ?> displet-font-color-light">
							<?php displetretsidx_the_lowest_square_footage(); ?>
						</span>
						to
						<span class="<?php displetretsidx_the_highest_square_footage_class(); ?> displet-font-color-light">
							<?php displetretsidx_the_highest_square_footage(); ?>
						</span>
						Sq. Ft.
					</td>
				<?php endif; ?>
				<?php if ( displetretsidx_has_average_square_footage() ) : ?>
					<th scope="row" class="displet-font-color-light">
						Size Average:
					</th>
					<td>
						<span class="<?php displetretsidx_the_average_square_footage_class(); ?> displet-font-color-light">
							<?php displetretsidx_the_average_square_footage(); ?>
						</span>
						Sq. Ft.
					</td>
				<?php endif; ?>
			</tr>
		</table>
		<?php displetretsidx_the_listings_loading_element(); ?>
	<?php else : ?>
		<div class="displet-no-results">
			No listings available.
		</div>
	<?php endif; ?>
</div>