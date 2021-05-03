<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * Ultra: Social Icons
 *
 * Widget to display social icons
 *
 * @package Wpoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */

add_action( 'widgets_init', 'ultra_social_icons_register' );

function ultra_social_icons_register() {
    register_widget( 'ultra_social_icons' );
}
class Ultra_Social_Icons extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'widget_ultra_social_icons',
            'description' => esc_html__( 'Display Social Icons.', 'ultra-seven' )
        );
        parent::__construct( 'ultra_social_icons', esc_html__( '*ULTRA : Social Icons', 'ultra-seven' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(

            'block_title' => array(
                'ultra_seven_widgets_name'         => 'block_title',
                'ultra_seven_widgets_title'        => esc_html__( 'Block Title', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'facebook' => array(
                'ultra_seven_widgets_name'         => 'facebook',
                'ultra_seven_widgets_title'        => esc_html__( 'Facebook URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            'twitter' => array(
                'ultra_seven_widgets_name'         => 'twitter',
                'ultra_seven_widgets_title'        => esc_html__( 'Twitter URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            'instagram' => array(
                'ultra_seven_widgets_name'         => 'instagram',
                'ultra_seven_widgets_title'        => esc_html__( 'Instagram URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            'linkedin' => array(
                'ultra_seven_widgets_name'         => 'linkedin',
                'ultra_seven_widgets_title'        => esc_html__( 'LinkedIn URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            'gplus' => array(
                'ultra_seven_widgets_name'         => 'gplus',
                'ultra_seven_widgets_title'        => esc_html__( 'Google Plus URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            'pinterest' => array(
                'ultra_seven_widgets_name'         => 'pinterest',
                'ultra_seven_widgets_title'        => esc_html__( 'Pinterest URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),           
        );
        return $fields;
    }
    public function widget($args, $instance) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }
        echo wp_kses_post( $args['before_widget'] );
        if ( ! empty( $instance['block_title'] ) ) {
            echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', $instance['block_title'] ,$instance, $this->id_base ). wp_kses_post( $args['after_title'] );// WPCS: XSS OK.
        }
        $facebook = isset($instance['facebook']) ? $instance['facebook'] : '';
        $twitter = isset($instance['twitter']) ? $instance['twitter'] : '';
        $instagram = isset($instance['instagram']) ? $instance['instagram'] : '';
        $linkedin = isset($instance['linkedin']) ? $instance['linkedin'] : '';
        $gplus = isset($instance['gplus']) ? $instance['gplus'] : '';
        $pinterest = isset($instance['pinterest']) ? $instance['pinterest'] : '';
        $layout = 'theme1';
        ?>

        <ul class="ultra-social-icons <?php echo esc_attr($layout);?>">
            <?php if($facebook){ ?>
            <li class="Facebook">
                <a href="<?php echo esc_url($facebook); ?>" target="_blank" title="<?php echo esc_attr__('Facebook','ultra-seven'); ?>">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <?php } if($twitter){ ?>
            <li class="Twitter">
                <a href="<?php echo esc_url($twitter); ?>" target="_blank" title="<?php echo esc_attr__('Twitter','ultra-seven'); ?>">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <?php } if($instagram){ ?>
            <li class="Instagram">
                <a href="<?php echo esc_url($instagram); ?>" target="_blank" title="<?php echo esc_attr__('Instagram','ultra-seven'); ?>">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
            <?php } if($linkedin){ ?>
            <li class="Linkedin">
                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" title="<?php echo esc_attr__('LinkedIn','ultra-seven'); ?>">
                    <i class="fa fa-linkedin"></i>
                </a>
            </li>
            <?php } if($gplus){ ?>
            <li class="Google-plus">
                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" title="<?php echo esc_attr__('Google Plus','ultra-seven'); ?>">
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>
            <?php } if($pinterest){ ?>
            <li class="Pinterest">
                <a href="<?php echo esc_url($pinterest); ?>" target="_blank" title="<?php echo esc_attr__('Pinterest','ultra-seven'); ?>">
                    <i class="fa fa-pinterest"></i>
                </a>
            </li>
            <?php } ?>
        </ul>
        <?php
        echo wp_kses_post( $args['after_widget'] );
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