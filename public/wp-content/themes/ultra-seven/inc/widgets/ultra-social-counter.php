<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * Ultra: Social Counter
 *
 * Widget to display social counter
 *
 * @package Wpoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */

add_action( 'widgets_init', 'ultra_social_counter_register' );

function ultra_social_counter_register() {
    register_widget( 'ultra_social_counter' );
}
class Ultra_Social_Counter extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'widget_ultra_social_counters',
            'description' => esc_html__( 'Display Social Counter.', 'ultra-seven' )
        );
        parent::__construct( 'ultra_social_counter', esc_html__( '*ULTRA : Social Counter', 'ultra-seven' ), $widget_ops );
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

            //Facebook
            'fb-wrap' => array(
            'wraper_class'=> 'banner-field-wrap',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ),

            'ultra_seven_seperator_field1' => array(
            'ultra_seven_seperator' => esc_html__('Facebook', 'ultra-seven'),
            'ultra_seven_widgets_name' => 'ultra_seven_seperator_field1',
            'ultra_seven_widgets_field_type' => 'seperator',
            ),

            'wraper-field1' => array(
            'wraper_class'=> 'banner-field',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ), 

            'facebook_info' => array(
                'ultra_seven_widgets_name'         => 'facebook_info',
                'ultra_seven_widgets_title'        => esc_html__( 'Info', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'facebook_count' => array(
                'ultra_seven_widgets_name'         => 'facebook_count',
                'ultra_seven_widgets_title'        => esc_html__( 'Count', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'facebook_url' => array(
                'ultra_seven_widgets_name'         => 'facebook_url',
                'ultra_seven_widgets_title'        => esc_html__( 'URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            
            'wraper-field1-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            'fb-wrap-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            //Twitter
            'twitter-wrap' => array(
            'wraper_class'=> 'banner-field-wrap',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ),

            'ultra_seven_seperator_field2' => array(
            'ultra_seven_seperator' => esc_html__('Twitter', 'ultra-seven'),
            'ultra_seven_widgets_name' => 'ultra_seven_seperator_field2',
            'ultra_seven_widgets_field_type' => 'seperator',
            ),

            'wraper-field2' => array(
            'wraper_class'=> 'banner-field hidden',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ), 

            'twitter_info' => array(
                'ultra_seven_widgets_name'         => 'twitter_info',
                'ultra_seven_widgets_title'        => esc_html__( 'Info', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'twitter_count' => array(
                'ultra_seven_widgets_name'         => 'twitter_count',
                'ultra_seven_widgets_title'        => esc_html__( 'Count', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'twitter_url' => array(
                'ultra_seven_widgets_name'         => 'twitter_url',
                'ultra_seven_widgets_title'        => esc_html__( 'URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            
            'wraper-field2-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            'twitter-wrap-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            //linkedin
            'linkedin-wrap' => array(
            'wraper_class'=> 'banner-field-wrap',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ),

            'ultra_seven_seperator_field3' => array(
            'ultra_seven_seperator' => esc_html__('LinkedIn', 'ultra-seven'),
            'ultra_seven_widgets_name' => 'ultra_seven_seperator_field3',
            'ultra_seven_widgets_field_type' => 'seperator',
            ),

            'wraper-field3' => array(
            'wraper_class'=> 'banner-field hidden',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ), 

            'linkedin_info' => array(
                'ultra_seven_widgets_name'         => 'linkedin_info',
                'ultra_seven_widgets_title'        => esc_html__( 'Info', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'linkedin_count' => array(
                'ultra_seven_widgets_name'         => 'linkedin_count',
                'ultra_seven_widgets_title'        => esc_html__( 'Count', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'linkedin_url' => array(
                'ultra_seven_widgets_name'         => 'linkedin_url',
                'ultra_seven_widgets_title'        => esc_html__( 'URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            
            'wraper-field3-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            'linkedin-wrap-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            //google plus
            'gplus-wrap' => array(
            'wraper_class'=> 'banner-field-wrap',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ),

            'ultra_seven_seperator_field4' => array(
            'ultra_seven_seperator' => esc_html__('Google Plus', 'ultra-seven'),
            'ultra_seven_widgets_name' => 'ultra_seven_seperator_field4',
            'ultra_seven_widgets_field_type' => 'seperator',
            ),

            'wraper-field4' => array(
            'wraper_class'=> 'banner-field hidden',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ), 

            'gplus_info' => array(
                'ultra_seven_widgets_name'         => 'gplus_info',
                'ultra_seven_widgets_title'        => esc_html__( 'Info', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'gplus_count' => array(
                'ultra_seven_widgets_name'         => 'gplus_count',
                'ultra_seven_widgets_title'        => esc_html__( 'Count', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'gplus_url' => array(
                'ultra_seven_widgets_name'         => 'gplus_url',
                'ultra_seven_widgets_title'        => esc_html__( 'URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            
            'wraper-field4-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            'gplus-wrap-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            //Pinterest
            'pinterest-wrap' => array(
            'wraper_class'=> 'banner-field-wrap',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ),

            'ultra_seven_seperator_field5' => array(
            'ultra_seven_seperator' => esc_html__('Pinterest', 'ultra-seven'),
            'ultra_seven_widgets_name' => 'ultra_seven_seperator_field5',
            'ultra_seven_widgets_field_type' => 'seperator',
            ),

            'wraper-field5' => array(
            'wraper_class'=> 'banner-field hidden',
            'ultra_seven_widgets_field_type' => 'wraper-start',
            ), 

            'pinterest_info' => array(
                'ultra_seven_widgets_name'         => 'pinterest_info',
                'ultra_seven_widgets_title'        => esc_html__( 'Info', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'pinterest_count' => array(
                'ultra_seven_widgets_name'         => 'pinterest_count',
                'ultra_seven_widgets_title'        => esc_html__( 'Count', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'pinterest_url' => array(
                'ultra_seven_widgets_name'         => 'pinterest_url',
                'ultra_seven_widgets_title'        => esc_html__( 'URL', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'url'
            ),
            
            'wraper-field5-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
            ),

            'pinterests-wrap-end' => array(
            'ultra_seven_widgets_field_type' => 'wraper-end',
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
    public function widget($args, $instance) {
        echo wp_kses_post( $args['before_widget'] );
        if ( ! empty( $instance['block_title'] ) ) {
            echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', $instance['block_title'] ,$instance, $this->id_base ). wp_kses_post( $args['after_title'] );// WPCS: XSS OK.
        }
        $layout = 'theme2';
        $fb_info = isset($instance['facebook_info']) ? $instance['facebook_info'] : ''; 
        $fb_count = isset($instance['facebook_count']) ? $instance['facebook_count'] : ''; 
        $fb_url = isset($instance['facebook_url']) ? $instance['facebook_url'] : '';

        $twitter_info = isset($instance['twitter_info']) ? $instance['twitter_info'] : ''; 
        $twitter_count = isset($instance['twitter_count']) ? $instance['twitter_count'] : ''; 
        $twitter_url = isset($instance['twitter_url']) ? $instance['twitter_url'] : '';

        $linkedin_info = isset($instance['linkedin_info']) ? $instance['linkedin_info'] : ''; 
        $linkedin_count = isset($instance['linkedin_count']) ? $instance['linkedin_count'] : ''; 
        $linkedin_url = isset($instance['linkedin_url']) ? $instance['linkedin_url'] : '';

        $gplus_info = isset($instance['gplus_info']) ? $instance['gplus_info'] : ''; 
        $gplus_count = isset($instance['gplus_count']) ? $instance['gplus_count'] : ''; 
        $gplus_url = isset($instance['gplus_url']) ? $instance['gplus_url'] : '';

        $pinterest_info = isset($instance['pinterest_info']) ? $instance['pinterest_info'] : ''; 
        $pinterest_count = isset($instance['pinterest_count']) ? $instance['pinterest_count'] : ''; 
        $pinterest_url = isset($instance['pinterest_url']) ? $instance['pinterest_url'] : '';
        ?>
            <ul class="ultra-social-followers <?php echo esc_attr($layout); ?>">
                <?php if($fb_url){?>
                <li class="Facebook">
                    <a href="<?php echo esc_url($fb_url); ?>" target="_blank" title="<?php echo esc_attr__('Facebook','ultra-seven'); ?>">
                        <i class="fa fa-facebook"></i>
                        <?php if($fb_count){?>
                        <span class="name"><?php echo esc_html($fb_count); ?></span>
                        <?php }?>
                        <?php if($fb_info){?>
                        <span class="title"><?php echo esc_html($fb_info); ?></span>
                        <?php }?>
                        <span class="like"><?php echo esc_html__('Like','ultra-seven');?></span>
                    </a>
                </li>
                <?php }?>
                <?php if($twitter_url){?>
                <li class="Twitter">
                    <a href="<?php echo esc_url($fb_url); ?>" target="_blank" title="<?php echo esc_attr__('Twitter','ultra-seven'); ?>">
                        <i class="fa fa-twitter"></i>
                        <?php if($twitter_count){?>
                        <span class="name"><?php echo esc_html($twitter_count); ?></span>
                        <?php }?>
                        <?php if($twitter_info){?>
                        <span class="title"><?php echo esc_html($twitter_info); ?></span>
                        <?php }?>
                        <span class="like"><?php echo esc_html__('Follow','ultra-seven');?></span>
                    </a>
                </li>
                <?php }?>
                <?php if($pinterest_url){?>
                <li class="Pinterest">
                    <a href="<?php echo esc_url($fb_url); ?>" target="_blank" title="<?php echo esc_attr__('Pinterest','ultra-seven'); ?>">
                        <i class="fa fa-pinterest"></i>
                        <?php if($pinterest_count){?>
                        <span class="name"><?php echo esc_html($pinterest_count); ?></span>
                        <?php }?>
                        <?php if($pinterest_info){?>
                        <span class="title"><?php echo esc_html($pinterest_info); ?></span>
                        <?php }?>
                        <span class="like"><?php echo esc_html__('Follow','ultra-seven');?></span>
                    </a>
                </li>
                <?php }?>
                <?php if($linkedin_url){?>
                <li class="Linkedin">
                    <a href="<?php echo esc_url($fb_url); ?>" target="_blank" title="<?php echo esc_attr__('Linkedin','ultra-seven'); ?>">
                        <i class="fa fa-linkedin"></i>
                        <?php if($linkedin_count){?>
                        <span class="name"><?php echo esc_html($linkedin_count); ?></span>
                        <?php }?>
                        <?php if($linkedin_info){?>
                        <span class="title"><?php echo esc_html($linkedin_info); ?></span>
                        <?php }?>
                        <span class="like"><?php echo esc_html__('Follow','ultra-seven');?></span>
                    </a>
                </li>
                <?php }?>
                <?php if($gplus_url){?>
                <li class="Google-plus">
                    <a href="<?php echo esc_url($fb_url); ?>" target="_blank" title="<?php echo esc_attr__('Goggle Plus','ultra-seven'); ?>">
                        <i class="fa fa-google-plus"></i>
                        <?php if($gplus_count){?>
                        <span class="name"><?php echo esc_html($gplus_count); ?></span>
                        <?php }?>
                        <?php if($gplus_info){?>
                        <span class="title"><?php echo esc_html($gplus_info); ?></span>
                        <?php }?>
                        <span class="like"><?php echo esc_html__('Follow','ultra-seven');?></span>
                    </a>
                </li>
                <?php }?>

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