<?php
	$models = array();
	if ( !empty( $model['layout'] ) && $model['layout'] === 'table' ) {
		if ( !empty( $model['listings_by_status'] ) && is_array( $model['listings_by_status'] ) ) {
			foreach ( $model['listings_by_status'] as $the_model ) {
				$models[] = $the_model;
			}
		}
	}
	else{
		$models[] = $model;
	}
?>
<script>
	<?php if ( !empty( $models ) ) : foreach ( $models as $the_model ) : ?>
		var query = {
			args: <?php echo json_encode( $the_model['query_args'] ); ?>,
			data_from: '<?php echo $the_model["data_from"]; ?>',
			listings: <?php echo json_encode( $the_model['listings'] ); ?>,
		}
		displetretsidx.queries.push(query);
	<?php endforeach; endif; ?>
</script>