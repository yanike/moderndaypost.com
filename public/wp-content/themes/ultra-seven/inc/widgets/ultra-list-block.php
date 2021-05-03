<?php
/**
 * ULTRA : List Block
 *
 * Widget to display latest or selected category posts as in List style.
 *
 * @package WPoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */

add_action( 'widgets_init', 'ultra_list_block_register' );

function ultra_list_block_register() {
    register_widget( 'ultra_list_block' );
}

class Ultra_List_Block extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'ultra_list_block',
            'description' => esc_html__( 'Display posts in list format.', 'ultra-seven' )
        );
        parent::__construct( 'ultra_list_block', esc_html__( '*ULTRA : List Block', 'ultra-seven' ), $widget_ops );
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

            'block_excerpt' => array(
                'ultra_seven_widgets_name'         => 'block_excerpt',
                'ultra_seven_widgets_title'        => esc_html__( 'Excerpt Length', 'ultra-seven' ),
                'ultra_seven_widgets_default'      => 150,
                'ultra_seven_widgets_field_type'   => 'number'
            ),

            'block_readmore_text' => array(
                'ultra_seven_widgets_name'         => 'block_readmore_text',
                'ultra_seven_widgets_title'        => esc_html__( 'Read More Text', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
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
        $view_all_text   = empty( $instance['block_view_all_text'] ) ? '': $instance['block_view_all_text'];
        $excerpt_length = empty( $instance['block_excerpt'] ) ? 150 : $instance['block_excerpt'];
        $readmore_text   = empty( $instance['block_readmore_text'] ) ? '': $instance['block_readmore_text'];
        $block_header_type = 'style-1';
        echo wp_kses_post($before_widget);
    ?>
		<div class="ultra-block-wrapper latest-posts <?php echo esc_attr($block_layout);?>">
		    <div class="ultra-container">
		        <?php if($block_title):?>
		            <div class="block-header <?php echo esc_attr($block_header_type);?> clearfix">
		                <div class="header"><?php echo esc_html($block_title); ?> </div>
		            </div><!-- .block-header-->
		        <?php endif; ?>
		        <div class="posts-list-wrap">
		        <?php 
		            $block_args = ultra_seven_query_args( $post_type, $post_count, $cat_id, $offset );
		            $block_query = new WP_Query( $block_args );
		            if( $block_query->have_posts() ) {
		                $count=0;
		                while( $block_query->have_posts() ) {
		                    $count++;
		                    $block_query->the_post();
		                    if( ($block_layout=='layout-1' && $count==1) || ($block_layout=='layout-2' && $count==1) ){
		                    $image_size = 'ultra-xlarge-image';
		                    $large_class='single-post-large';
		                    $font_class = 'large-font';
		                    }else{
		                    $image_size = 'ultra-slider1-right';
		                    $large_class = 'single-post';
		                    $font_class = 'small-font';
		                    }

		                    if($count%2==0 && $block_layout=='layout-2'){
		                        $class="left-reverse";
		                    }elseif($count%2!=0 && $block_layout=='layout-2'){
		                        $class="right-reverse";
		                    }else{
		                        $class="";
		                    }
		                    if(has_post_thumbnail()){
		                        $thumb = '';
		                    }else{
		                        $thumb = 'no-image';
		                    }
		                    ?>
		                    <div class="<?php echo esc_attr($large_class).' '.esc_attr($class);?> clearfix wow fadeInUp" data-wow-duration="0.7s">
		                        <div class="post-thumb <?php echo esc_attr($thumb);?>">
		                            <?php 
		                            ultra_seven_home_image( $image_size );
		                            do_action( 'ultra_seven_post_format_icon' );
		                            ?>
		                        </div><!-- .post-thumb -->
		                        <div class="post-content-wrapper clearfix">
		                            <?php do_action( 'ultra_seven_post_cat_or_tag_lists' ); ?>
		                            <h3 class="<?php echo esc_attr($font_class);?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		                            <div class="post-meta clearfix">
		                                <?php 
		                                    do_action( 'ultra_seven_post_meta' );
		                                    ultra_seven_post_views();
		                                    ultra_seven_post_comments();
		                                ?>
		                            </div><!-- .post-meta -->
		                            <?php if( ($block_layout=='layout-1' && $count>1) || ($block_layout=='layout-2' && $count>1) || $block_layout=='layout-3' ) : ?>
		                                <div class="post-content">
		                                   <?php   $post_content = get_the_content(); ?>
		                                   <p> <?php echo ultra_seven_get_excerpt_content( $post_content, $excerpt_length );// WPCS: XSS OK.?>
		                                   </p>
		                                   <?php if($readmore_text){?>
		                                    <a class="block-list-more" href="<?php the_permalink();?>"><?php echo esc_html($readmore_text);?></a>
		                                    <?php }?>
		                                </div><!-- .post-content -->
		                            <?php endif; ?>
		                        </div><!-- .post-content-wrapper -->
		                    </div><!-- .single-post  -->
		                    <?php
		                }
		            }
		            wp_reset_postdata();
		        ?>
		        </div>
		       <?php
		       if($view_all_text){
                 if($post_type == 'category'){
                    $view_link = get_category_link($cat_id);
                 }else{
                    $view_link = esc_url(get_permalink( get_option( 'page_for_posts' ) ));
                 }
		       	?>
		        <div class="load-posts">
		            <a href="<?php echo esc_url($view_link);?>" class="loadmore">
		            <?php echo esc_html($view_all_text);?>
		            </a>
		        </div>
		       	<?php
		       }  
               ?>
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