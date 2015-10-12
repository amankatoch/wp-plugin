<?php

class DispletRetsIdxQuickSearchWidget extends WP_Widget {
	function DispletRetsIdxQuickSearchWidget() {
		parent::__construct( false, 'Displet Quick Search', array(
			'description' => 'Adds a quick search'
		) );
	}

	function form( $instance ) {
        $title = isset( $instance['title'] ) ? strip_tags( $instance['title'] ) : 'Search Properties';
        $id = isset( $instance['id'] ) ? intval( $instance['id'] ) : 1;
        $search_forms = DispletRetsIdxOptionsController::get_option( 'search_forms' );
        $registered_quick_search_ids = array(
        	1 => 1,
        );
        if ( !empty( $search_forms ) && is_array( $search_forms ) ) {
        	foreach ( $search_forms as $key => $search_form ) {
        		if ( $key > 3 ) {
        			$form_id = $key - 3;
        			$registered_quick_search_ids[ $form_id ] = $form_id;
        		}
        	}
        }
    ?>
        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				Title:
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>">
				Form ID:
			</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>">
				<?php if ( !empty( $registered_quick_search_ids ) ) : foreach ( $registered_quick_search_ids as $option_id ) : ?>
					<option value="<?php echo $option_id; ?>" <?php selected( $option_id, $id ); ?>>
						<?php echo $option_id; ?>
					</option>
				<?php endforeach; endif; ?>
			</select>
		</p>
	<?php
	}

	function update( $new_instance, $old_instance ) {
        return array(
        	'id' => isset( $new_instance['id'] ) ? $new_instance['id'] : 1,
        	'title' => isset( $new_instance['title'] ) ? $new_instance['title'] : '',
        );
	}

	function widget( $args, $instance ) {
		extract(  $args  );
		global $displetretsidx_option;
        $title = !empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        $id = !empty( $instance['id'] ) ? intval( $instance['id'] ) : 1;
		$model = array(
			'options' => $displetretsidx_option,
			'title' => $title,
			'id' => $id,
		);
	    echo $before_widget . DispletRetsIdxTemplatesController::get_template( 'displet-quick-search.php', $model ) . $after_widget;
	}
}

?>