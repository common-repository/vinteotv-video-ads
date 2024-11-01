<?php 

class vinteo_Widget extends WP_Widget {
	static $instance;
	function vinteo_Widget() {
            // We set the static class var to true on the first run
            if ( ! $this->instance ) {
                    $this->instance = true;
            } 
            // abort silently for the second instance of the widget
            else {
                    return;
            }
        // widget actual processes
    }
	
	public function __construct() {
		parent::__construct(
	 		'vinteo_widget', // Base ID
			'Vinteo.tv Widget', // Name
			array( 'description' => __( 'Vinteo.tv Widget', 'text_domain' ), ) // Args
		);
	}

	
	
	public function widget( $args, $instance ) {
		$config = get_option('wvt_ads');
		if( $config['inj_type'] != 'widget' ){
			return false;
		}		
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_id = apply_filters( 'widget_title', $instance['sub_id'] );
		$width = apply_filters( 'widget_title', $instance['width'] );
		$height = apply_filters( 'widget_title', $instance['height'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		$config = get_option('wvt_options');
		echo wvt_show_code( $config['account_id'], $sub_id, $width, $height );
		
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['sub_id'] = strip_tags( $new_instance['sub_id'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['height'] = strip_tags( $new_instance['height'] );

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$sub_id = $instance[ 'sub_id' ];
			$width = $instance[ 'width' ];
			$height = $instance[ 'height' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
		<label class="search_mark" for="<?php echo $this->get_field_id( 'sub_id' ); ?>"><?php _e( 'Sub ID' ); ?>&nbsp;&nbsp;<input   id="<?php echo $this->get_field_id( 'sub_id' ); ?>" name="<?php echo $this->get_field_name( 'sub_id' ); ?>" type="number"  min="0" max="99" value="<?php if( esc_attr( $sub_id ) ) echo esc_attr( $sub_id ); else echo '1'; ?>" /></label> 
		
		</p>
		<!--
		<p>
		<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width' ); ?>&nbsp;&nbsp;<input   id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text"   value="<?php echo esc_attr( $width ); ?>" /></label> 
		
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height' ); ?>&nbsp;<input   id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text"   value="<?php echo esc_attr( $height ); ?>" /></label> 
		
		</p>
		-->
		
		<?php 
	}

} // class Foo_Widget
// register Foo_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "vinteo_Widget" );' ) );

?>