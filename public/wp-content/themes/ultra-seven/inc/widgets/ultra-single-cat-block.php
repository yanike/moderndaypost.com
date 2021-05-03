<?php
/**
 * ULTRA : Single Cat Block
 *
 * Widget to display latest or selected category posts.
 *
 * @package WPoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */

add_action( 'widgets_init', 'ultra_single_cat_block_register' );

function ultra_single_cat_block_register() {
    register_widget( 'ultra_single_cat_block' );
}

class Ultra_Single_Cat_Block extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'ultra_single_cat_block',
            'description' => esc_html__( 'Display posts in prebuilt format.', 'ultra-seven' )
        );
        parent::__construct( 'ultra_single_cat_block', esc_html__( '*ULTRA : Single Cat Block', 'ultra-seven' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        global $ultra_seven_posts_type, $ultra_seven_cat_dropdown, $ultra_seven_block_layout, $ultra_seven_column_choice;
        
        $fields = array(

            'post_section_block' => array(
                'ultra_seven_widgets_name' => 'post_section_block',
                'ultra_seven_widgets_default'      => 'general',
                'ultra_seven_widgets_field_options'=>array('general'=>esc_html__('General Section','ultra-seven'),
                                                          'design'=>esc_html__('Design Section','ultra-seven')
                                                          ),
                'ultra_seven_widgets_field_type'   => 'section_tab_wrapper'
            ),

            'block_wrapper_post' => array(
                'wraper_class'      => 'general',
                'ultra_seven_widgets_style'      =>'',
                'ultra_seven_widgets_field_type'   => 'wraper-start'
            ),

            'block_title' => array(
                'ultra_seven_widgets_name'         => 'block_title',
                'ultra_seven_widgets_title'        => esc_html__( 'Block Title', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'block_post_type' => array(
                'ultra_seven_widgets_name' => 'block_post_type',
                'ultra_seven_widgets_title' => esc_html__( 'Block posts: ', 'ultra-seven' ),
                'ultra_seven_widgets_class' => 'horizontal post-type',
                'ultra_seven_widgets_field_type' => 'radio',
                'ultra_seven_widgets_default' => 'latest',
                'ultra_seven_widgets_field_options' => $ultra_seven_posts_type
            ),

            'block_posts_count' => array(
                'ultra_seven_widgets_name'         => 'block_posts_count',
                'ultra_seven_widgets_title'        => esc_html__( 'No. of Posts', 'ultra-seven' ),
                'ultra_seven_widgets_class'      => 'horizontal',
                'ultra_seven_widgets_default'      => 5,
                'ultra_seven_widgets_field_type'   => 'number'
            ),

            'block_post_offset' => array(
                'ultra_seven_widgets_name'         => 'block_post_offset',
                'ultra_seven_widgets_title'        => esc_html__( 'Offset', 'ultra-seven' ),
                'ultra_seven_widgets_class'      => 'horizontal',
                'ultra_seven_widgets_default'      => 0,
                'ultra_seven_widgets_field_type'   => 'number'
            ),

            'block_post_category' => array(
                'ultra_seven_widgets_name' => 'block_post_category',
                'ultra_seven_widgets_title' => esc_html__( 'Category for Block Posts', 'ultra-seven' ),
                'ultra_seven_widgets_class'      => 'category-choose',
                'ultra_seven_widgets_default'      => 0,
                'ultra_seven_widgets_field_type' => 'select',
                'ultra_seven_widgets_field_options' => $ultra_seven_cat_dropdown
            ),

            'block_wrapper_end_post' => array(
                'ultra_seven_widgets_field_type'   => 'wraper-end'
            ),

            //design

            'block_wrapper_design' => array(
                'wraper_class'      => 'design',
                'ultra_seven_widgets_style'        =>  'display:none',
                'ultra_seven_widgets_field_type'   => 'wraper-start'
            ),
            
            'block_excerpt_length' => array(
                'ultra_seven_widgets_name'         => 'block_excerpt_length',
                'ultra_seven_widgets_default'      => 150,
                'ultra_seven_widgets_title'        => esc_html__( 'Excerpt Length', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'number'
            ), 

            'block_post_layout' => array(
                'ultra_seven_widgets_name' => 'block_post_layout',
                'ultra_seven_widgets_title' => esc_html__( 'Block Layouts', 'ultra-seven' ),
                'ultra_seven_widgets_description' => esc_html__( 'Choose the block layout from available options.', 'ultra-seven' ),
                'ultra_seven_widgets_default'      => 'layout-1',
                'ultra_seven_widgets_field_type' => 'radio',
                'ultra_seven_widgets_field_options' => $ultra_seven_block_layout
            ),

            'block_wrapper_end_design' => array(
                'ultra_seven_widgets_field_type'   => 'wraper-end'
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
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $block_title   = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $post_count = empty( $instance['block_posts_count'] ) ? 5 : $instance['block_posts_count'];
        $offset = empty( $instance['block_post_offset'] ) ? 0 : $instance['block_post_offset'];
        $post_type    = empty( $instance['block_post_type'] ) ? 'latest' : $instance['block_post_type'];
        $cat_id    = empty( $instance['block_post_category'] ) ? null: $instance['block_post_category'];
        $block_layout = empty( $instance['block_post_layout'] ) ? 'layout-1' : $instance['block_post_layout'];
        $ultra_excerpt_length   = empty( $instance['block_excerpt_length'] ) ? '': $instance['block_excerpt_length'];
        $block_header_type = 'style-1';
        echo wp_kses_post($before_widget);
    ?>
		<div class="ultra-block-wrapper single-cat1 <?php echo esc_attr($block_layout);?> clearfix">
		    <div class="ultra-container">
		        <?php if($block_title):?>
		            <div class="block-header <?php echo esc_attr($block_header_type);?> clearfix">
		                <div class="header"><?php echo esc_html($block_title); ?> </div>
		            </div><!-- .block-header-->
		        <?php endif; ?>
		        <div class="single-cat-content">
		        <?php 
		            $block_args = ultra_seven_query_args( $post_type, $post_count, $cat_id, $offset );
		            $block_query = new WP_Query( $block_args );
		            $post_count = 0;
		            $total_posts_count = $block_query->post_count;
		            if( $block_query->have_posts() ) {
		                while( $block_query->have_posts() ) {
		                    $block_query->the_post();
		                    $post_count++;

		                    if( $post_count == 1 ) {
		                        $ultra_seven_font_size = 'large-font';
		                        $image_size = 'ultra-medium-image';
		                        echo '<div class="left-post-wrapper clearfix wow fadeInDown" data-wow-duration="0.7s">';
		                    } elseif( $post_count == 2 ) {
		                        $ultra_seven_font_size = 'small-font';
		                        $image_size = 'ultra-small-image';
		                        $ultra_seven_animate_class = 'fadeInUp';
		                        echo '<div class="right-posts-wrapper clearfix wow fadeInUp" data-wow-duration="0.7s">';
		                    } else {
		                        $ultra_seven_font_size = 'small-font';
		                        $image_size = 'ultra-small-image';
		                    }
		                    ?>
		                    <div class="single-post clearfix">
		                        <div class="post-thumb">
		                            <?php ultra_seven_home_image( $image_size );
		                             do_action( 'ultra_seven_post_format_icon' ); ?>
		                        </div><!-- .post-thumb -->
		                        <div class="post-wrapper">
		                        <div class="post-caption-wrapper">
		                            <?php if( $post_count == 1 ) { do_action( 'ultra_seven_post_cat_or_tag_lists' ); } ?>
		                            <h3 class="<?php echo esc_attr( $ultra_seven_font_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		                            <div class="post-meta clearfix">
		                                <?php 
		                                    do_action( 'ultra_seven_post_meta' );
		                                    if( $post_count == 1 ) { 
		                                        ultra_seven_post_views();
		                                        ultra_seven_post_comments();
		                                        do_action( 'ultra_seven_block_post_review' );
		                                    }
		                                ?>
		                            </div><!-- .post-meta -->
		                            <?php 
		                            if( $post_count == 1 ) { 
		                                $post_content = get_the_content();
                                        if($ultra_excerpt_length!=''){
		                                echo '<p>'. ultra_seven_get_excerpt_content( $post_content, $ultra_excerpt_length ) .'</p>';// WPCS: XSS OK.
                                        }
		                                ultra_seven_share_block();
		                            } ?>
		                            </div><!-- .post-caption-wrapper -->
		                        </div>
		                    </div><!-- .single-post -->
		                    <?php
		                    if( $post_count == 1 || $post_count == $total_posts_count ) {
		                        echo '</div>';
		                    }
		                }
		            }
		            wp_reset_postdata();
		        ?>
		        </div><!-- .single-cat-content -->
		    </div>
		</div><!-- .ultra-block-wrapper -->
        <?php
        echo wp_kses_post($after_widget);
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