<?php
/**
 * Ultra : Posts List
 *
 * Widget to display latest or selected category posts as on list style.
 *
 * @package wpoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */

add_action( 'widgets_init', 'ultra_post_list_register' );

function ultra_post_list_register() {
    register_widget( 'ultra_post_list' );
}

class Ultra_Post_List extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'widget_ultra_seven_posts_list',
            'description' => esc_html__( 'Display posts in list format.', 'ultra-seven' )
        );
        parent::__construct( 'ultra_post_list', esc_html__( '*ULTRA : Post List', 'ultra-seven' ), $widget_ops );
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
                'ultra_seven_widgets_default'      => 4,
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
            
            'block_view_all_text' => array(
                'ultra_seven_widgets_name'         => 'block_view_all_text',
                'ultra_seven_widgets_title'        => esc_html__( 'View all Text', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
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
    public function widget($args, $instance) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }
        echo wp_kses_post( $args['before_widget'] );
        if ( ! empty( $instance['block_title'] ) ) {
            echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', $instance['block_title'] ,$instance, $this->id_base ). wp_kses_post( $args['after_title'] );// WPCS: XSS OK.
        }
        $ultra_seven_block_posts_count = empty( $instance['block_posts_count'] ) ? 4 : $instance['block_posts_count'];
        $ultra_seven_block_posts_type    = empty( $instance['block_post_type'] ) ? 'latest' : $instance['block_post_type'];
        $ultra_seven_block_cat_id    = empty( $instance['block_post_category'] ) ? null : $instance['block_post_category'];
        $block_layout = empty( $instance['block_post_layout'] ) ? 'layout-1' : $instance['block_post_layout'];
        $ultra_seven_block_view_all_text   = empty( $instance['block_view_all_text'] ) ? '': $instance['block_view_all_text'];

        ?>
       <div class="post-list-wraper <?php echo esc_attr($block_layout);?>">
            <div class="ultra-posts-wrap">
                <?php 
                $block_args = ultra_seven_query_args( $ultra_seven_block_posts_type, $ultra_seven_block_posts_count, $ultra_seven_block_cat_id );
                $paged=1;
                $block_query = new WP_Query( $block_args );
                if( $block_query->have_posts() ) {
                    $count = 0;
                    while( $block_query->have_posts() ) {
                        $count++;
                        $block_query->the_post();
                        $image_id = get_post_thumbnail_id();
                        if($block_layout=='layout-1' || ($block_layout=='layout-2' && $count==1)){
                        $image_path = wp_get_attachment_image_src( $image_id, 'ultra-medium-image' );
                        $class = 'post-large';
                        }else{
                        $image_path = wp_get_attachment_image_src( $image_id, 'ultra-small-image', true );
                        $class = '';
                        }

                        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
                        ?>
                        <div class="single-post <?php echo esc_attr($class);?> clearfix wow fadeInUp" data-wow-duration="0.7s">
                            <div class="post-thumb">
                                <a class="thumb-zoom" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                    <?php if($block_layout=='layout-1'){ ?>
                                    <div class="image-overlay"></div>
                                    <?php }?>
                                </a>
                            </div>    
                            <div class="post-caption">
                                <h3 class="large-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-meta clearfix">
                                    <?php 
                                        do_action( 'ultra_seven_post_meta' );   
                                    ?>
                                </div><!-- .post-meta --> 
                                <?php if($block_layout=='layout-2' && $count==1){?>
                                <p> <?php echo ultra_seven_get_excerpt_content( get_the_content(), 100 );// WPCS: XSS OK.?>
                                </p> 
                                <?php }?>
                            </div>
                        </div><!-- .single-post  -->
                        <?php
                    }
                }
                wp_reset_postdata();
               ?>
            </div>
           <?php
           if($ultra_seven_block_view_all_text){
             if($ultra_seven_block_posts_type == 'category'){
                $view_link = get_category_link($cat_id);
             }else{
                $view_link = esc_url(get_permalink( get_option( 'page_for_posts' ) ));
             }
            ?>
            <div class="load-posts">
                <a href="<?php echo esc_url($view_link);?>" class="loadmore">
                <?php echo esc_html($ultra_seven_block_view_all_text);?>
                </a>
            </div>
            <?php
           }  
           ?>
        </div><!-- .block-post-wrapper -->

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
