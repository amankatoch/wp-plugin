<?php

class DispletRetsIdxSidescrollerWidget extends WP_Widget{
	function DispletRetsIdxSidescrollerWidget() {
		parent::__construct( false, 'Displet Listings Scroller', array(
			'description' => 'Show RETS/IDX listings in a horizontal scroller.',
			'classname' => 'displet-sidescroller-widget',
		 ) );
	}

	public function form( $instance ) {
		$title = ( !isset( $instance['title'] ) ) ? 'Featured Listings' : esc_attr( $instance['title'] );
		$visible = ( !isset( $instance['visible'] ) ) ? '1' : esc_attr( $instance['visible'] );
		$settings = ( empty( $instance['settings'] ) ) ? array() : $instance['settings'];
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ) ?>">
				Title
			</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ) ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo $title; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'visible' ) ?>">
				Number of Simultaneously Visible Slides
			</label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'visible' ) ?>" id="<?php echo $this->get_field_id( 'visible' ); ?>" value="<?php echo $visible; ?>"/>
		</p>
		<p>
		<div class="displet-widget-control">
			<input type="hidden" id="<?php echo $this->get_field_id( 'settings' ) ?>"
				name="<?php echo $this->get_field_name( 'settings' ) ?>"
				class="displet-widget-control-settings"
				value="<?php echo esc_attr( self::_serialize_for_jquery( $settings ) ) ?>"/>
			<button class="displet-widget-configure">
				Configure
			</button>

			<span class="displet-widget-control-markup" style="display: none">
		<?php
				// to avoid nesting forms, we must encode the markup for the dialog
				$array = array();
				echo htmlspecialchars( DispletRetsIdxTemplatesController::get_admin_template( 'widget_form_dialog.phtml', $array ) );
		?>
			</span>
		</div>
		</p>
<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$array = array();
		parse_str( $new_instance['settings'], $array );
		$instance['settings'] = $array;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['visible'] = strip_tags( $new_instance['visible'] );
		return $instance;
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( isset( $instance['settings']['criteria'] )
			&& is_array( $instance['settings']['criteria'] ) ) {
			$settings = $instance['settings']['criteria'];
		}
		else {
			$settings = false;
		}
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'];
			echo $title;
			echo $args['after_title'];
		}
		if ( $settings ) {
			$model = array();
			if ( is_array( $settings ) ) {
				foreach ( $settings as $key => $value ) {
					$new_key = strtolower( $key );
					$model[ $new_key ] = $value;
				}
			}
			$model['is_widget'] = true;
			$residentials = new DispletRetsIdxResidentials( $model );
			$listings = $residentials->get_residentials();
			$model = !empty( $listings ) ? array_merge( $model, $listings ) : $model;
			$model['visible'] = !empty( $instance['visible'] ) && is_numeric( $instance['visible'] ) ? $instance['visible'] : 1;
			echo DispletRetsIdxTemplatesController::get_template( 'displet-sidescroller-widget.php', $model );
		}
		else if ( current_user_can( 'manage_options' ) ) {
			echo '<i>Please configure your DispletReader widget.</i>';
		}
		echo $args['after_widget'];
	}

	// format widget settings so jquery can pick them up
	protected static function _serialize_for_jquery( array $settings ) {
		$serialized = http_build_query( $settings );
		return $serialized;
	}
}

?>