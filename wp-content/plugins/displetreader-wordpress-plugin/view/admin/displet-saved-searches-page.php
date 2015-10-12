<div id="displet-saved-searches-page" class="wrap displet-saved-searches-page displet-admin">
	<h2>
		Saved Searches
	</h2>
	<table>
		<?php if ( !empty( $model['searches'] ) ) : foreach ( $model['searches'] as $saved_search ) : ?>
			<tr>
				<td class="select">
					<?php if ( !empty( $saved_search['api_id'] ) ) : ?>
						<input name="<?php echo $saved_search['api_id']; ?>" type="checkbox">
					<?php endif; ?>
				</td>
				<td>
					<a href="<?php echo $saved_search['url']; ?>">
						<?php if ( !empty( $saved_search['name'] ) ) : ?>
							<b>
								<?php echo trim( $saved_search['name'] ); ?>
							</b>
							|
						<?php endif; ?>
						<?php if ( !empty( $saved_search['description'] ) ) : ?>
							<?php echo $saved_search['description']; ?>
						<?php endif; ?>
					</a>
				</td>
			</tr>
		<?php $i++; endforeach; else : ?>
			<tr>
				<td>
					You have no saved searches at this time.
				</td>
			</tr>
		<?php endif; ?>
	</table>
	<div class="submit">
		<a href="javascript:;" id="displet_delete_selected_saved_searches" class="button-primary">
			Delete Selected Searches
		</a>
	</div>
	<div class="displet-response"></div>
</div>