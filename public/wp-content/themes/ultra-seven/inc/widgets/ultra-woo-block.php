<?php
/**
 * Woocommerce Block Widget
 *
 * @package Ultra Seven 
 */
add_action( 'widgets_init', 'ultra_woo_block_register' );

function ultra_woo_block_register() {
    register_widget( 'ultra_seven_woo_block' );
}
class Ultra_Seven_Woo_Block extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'ultra_seven_woo_block',
            'description' => esc_html__( 'Display Products in slider.', 'ultra-seven' )
        );
      parent::__construct( 'ultra_seven_woo_block', esc_html__( '*ULTRA : Product Slider', 'ultra-seven' ), $widget_ops );
    }

    private function widget_fields() {

        $fields = array(

            'block_title' => array(
                'ultra_seven_widgets_name'         => 'block_title',
                'ultra_seven_widgets_title'        => esc_html__( 'Block Title', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'no_of_item' => array(
                'ultra_seven_widgets_name'         => 'no_of_item',
                'ultra_seven_widgets_title'        => esc_html__( 'Product No.', 'ultra-seven' ),
                'ultra_seven_widgets_default'      => 6, 
                'ultra_seven_widgets_field_type'   => 'number'
            ),           
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($arg, $instance) {
    	extract($arg);
        echo wp_kses_post( $arg['before_widget'] );
       
        $ultra_element_title = isset( $instance['block_title'] ) ? $instance['block_title'] : '';
        $no_of_item = isset( $instance['no_of_item'] ) ? $instance['no_of_item'] : 6;
        $ultra_block_header_type = 'style-1';
        wp_enqueue_style('lightslider');
        wp_enqueue_script('lightslider-js');
        ?>

<div class=" ultra-block-wrapper woo-tab-slider">                
    <div class="ultra-container">
		<?php
		if(class_exists('woocommerce')):

		$product_number = $no_of_item;         
		?>
        <div class="block-title-wrap clearfix">
            <div class="ultra_sevenAction">
                <div class="ultra-lSPrev"></div>
                <div class="ultra-lSNext"></div>
            </div>
        </div>                   
        <div class="block-header <?php echo esc_attr($ultra_block_header_type);?> clearfix">
            <div class="header"><?php echo esc_html($ultra_element_title); ?> </div>
        </div><!-- .block-header-->
        <div class="ultra-tab-content clearfix">
           
            <div class="tabs-content-wrap store-product">                        
                <div class="tabs-product-area">    
                    <ul class="tabs-cat-product cS-hidden">                            
                        <?php 
                            $product_args = array(
                                'post_type' => 'product',
                                'posts_per_page' => $product_number
                            );
                            $query = new WP_Query($product_args);

                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                            
                        <?php } } wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
        </div>
		<?php 
		else:
			echo '<p>'.esc_html__('Woocommerce Plugin is Deactivated','ultra-seven').'</p>';
		endif; 
		?>
    </div>
</div>


        <?php
        echo wp_kses_post( $arg['after_widget'] );
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    ultra_seven_widgets_updated_field_value()      defined in accessmag-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$ultra_seven_widgets_name] = ultra_seven_widgets_updated_field_value( $widget_field, $new_instance[$ultra_seven_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    ultra_seven_widgets_show_widget_field()        defined in accessmag-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $ultra_seven_widgets_field_value = !empty( $instance[$ultra_seven_widgets_name]) ? esc_attr($instance[$ultra_seven_widgets_name] ) : '';
            ultra_seven_widgets_show_widget_field( $this, $widget_field, $ultra_seven_widgets_field_value );
        }
    }
}
