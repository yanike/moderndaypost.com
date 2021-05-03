<?php
/**
 * Tabs Widget
 *
 * @package Ultra Seven 
 */
add_action( 'widgets_init', 'ultra_tabs_register' );

function ultra_tabs_register() {
    register_widget( 'ultra_seven_tabs' );
}
class Ultra_Seven_Tabs extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'widget_ultra_seven_widget_tabs',
            'description' => esc_html__( 'Display Social Icons.', 'ultra-seven' )
        );
      parent::__construct( 'ultra_seven_tabs', esc_html__( '*ULTRA : Tabs', 'ultra-seven' ), $widget_ops );
    }

    private function widget_fields() {

        $fields = array(

            'block_title' => array(
                'ultra_seven_widgets_name'         => 'block_title',
                'ultra_seven_widgets_title'        => esc_html__( 'Block Title', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),

            'recent_posts_tab' => array(
                'ultra_seven_widgets_name'         => 'recent_posts_tab',
                'ultra_seven_widgets_title'        => esc_html__( 'Recent Posts Tab', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'checkbox'
            ),
            'popular_posts_tab' => array(
                'ultra_seven_widgets_name'         => 'popular_posts_tab',
                'ultra_seven_widgets_title'        => esc_html__( 'Popular Posts Tab', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'checkbox'
            ),
            'recent_comments_tab' => array(
                'ultra_seven_widgets_name'         => 'recent_comments_tab',
                'ultra_seven_widgets_title'        => esc_html__( 'Recent Comments Tab', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'checkbox'
            ),
            'no_of_item' => array(
                'ultra_seven_widgets_name'         => 'no_of_item',
                'ultra_seven_widgets_title'        => esc_html__( 'No. of Posts to Display', 'ultra-seven' ),
                'ultra_seven_widgets_default'      => 4,
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
        if ( ! empty( $instance['title'] ) ) {
            echo wp_kses_post( $arg['before_title'] ) . apply_filters( 'widget_title', $instance['title']  ,$instance, $this->id_base). wp_kses_post( $arg['after_title'] );// WPCS: XSS OK.
        }
		$no_of_item = !empty( $instance['no_of_item'] ) ? $instance['no_of_item'] : 4 ;
        
		if( (!isset($no_of_item)) || ($no_of_item == NULL)){ 
            $no_of_item = '5'; 
        }
		
		$args_latest = array(
			'post_type' => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $no_of_item		
		);	
        $recent_post = isset( $instance['recent_posts_tab'] ) ? 1 : '';
        $popular_post = isset( $instance['popular_posts_tab'] ) ? 1 : '';
        $recent_comment = isset( $instance['recent_comments_tab'] ) ? 1 : '';

        if(($recent_post != '1' && $popular_post != '1')
            ||($recent_post != '1' && $recent_comment != '1')
            ||$recent_comment != '1' && $popular_post != '1'){
            $full_tab = null;
        }else{
            $full_tab = '1';
        }
        $uid = uniqid();
        ?>
        <div class="widget-tabs-title-container clearfix">
			<ul class="widget-tab-titles clearfix">
                <?php if($recent_post == '1') {?>
				    <li class="active"><h3><a href="#widget-tab1-content-<?php echo esc_attr($uid);?>"><?php $full_tab ? esc_html_e('Recent','ultra-seven'): esc_html_e('Latest Posts', 'ultra-seven'); ?></a></h3></li>
                <?php }?>
                <?php if($popular_post == '1') {?>
				    <li class="<?php if($recent_post != '1') { echo "active"; }?>"><h3><a href="#widget-tab2-content-<?php echo esc_attr($uid);?>"><?php $full_tab ? esc_html_e('Popular','ultra-seven'): esc_html_e('Popular Posts', 'ultra-seven'); ?></a></h3></li>
                <?php }?>
                <?php if($recent_comment == '1') {?>
				    <li class="<?php if(($recent_post != '1') && ($popular_post != '1')) { echo "active"; }?>"><h3><a href="#widget-tab3-content-<?php echo esc_attr($uid);?>"><?php $full_tab ? esc_html_e('Comments','ultra-seven'): esc_html_e('Latest Comments', 'ultra-seven'); ?></a></h3></li>
                <?php }?>
            </ul>
		</div>
        <div class="widget-tabs-content">
            <?php if($recent_post == '1') {?>      			
    			<div id="widget-tab1-content-<?php echo esc_attr($uid);?>" class="tab-content" <?php if($recent_post == '1') { echo 'style="display: block;"';}?>>	
    				<?php $latest_posts = new WP_Query( $args_latest ); ?>
    				<?php if ( $latest_posts -> have_posts() ) : ?>
    
    					<ul class="list post-list">
        					<?php while ( $latest_posts -> have_posts() ) : 
        					    $latest_posts -> the_post(); $post_id = get_the_ID(); 
	                            $image_id = get_post_thumbnail_id();
	                            $image_path = wp_get_attachment_image_src( $image_id, 'ultra-small-image', true );
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        					      ?>					
        						<li class="content_out small-post clearfix">
                                    <div class="ultra-article-wrapper" itemscope itemtype="http://schema.org/Article">
            							<div class="ultra-mask thumb-zoom">
                                            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                        </div>        
		                                <div class="post-caption clearfix">
		                                    <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		                                    <div class="post-meta">
		                                        <?php do_action( 'ultra_seven_post_meta' ); ?>
		                                    </div>
		                                </div><!-- .post-caption -->	
                                    </div>
        						</li>
        					<?php endwhile; wp_reset_postdata();?>
    					</ul>
    				<?php endif;?>
    			</div>
    		<?php }?>
            <?php if($popular_post == '1') {?>
    			<div id="widget-tab2-content-<?php echo esc_attr($uid);?>" class="tab-content" <?php if($recent_post != '1') { echo 'style="display: block;"'; }?>>
    				<?php
    					$args_popular = array(
    						'post_type' => 'post',
    						'ignore_sticky_posts' => 1,
    						'posts_per_page' => $no_of_item,
    						'orderby' => 'comment_count'						
    					);	
    				?>
    				<?php $latest_posts = new WP_Query( $args_popular ); ?>
    				<?php if ( $latest_posts -> have_posts() ) : ?>
    					<ul class="list post-list">
        					<?php while ( $latest_posts -> have_posts() ) : 
        					    $latest_posts -> the_post(); $post_id = get_the_ID(); 
	                            $image_id = get_post_thumbnail_id();
	                            $image_path = wp_get_attachment_image_src( $image_id, 'ultra-small-image', true );
	                            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
        					    ?>					
        						<li class="content_out small-post clearfix">
                                    <div class="ultra-article-wrapper" itemscope itemtype="http://schema.org/Article">
            							<div class="ultra-mask thumb-zoom">
                                            <img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" title="<?php the_title(); ?>" />
                                        </div>
        
 		                                <div class="post-caption clearfix">
		                                    <h3 class="small-font"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		                                    <div class="post-meta">
		                                        <?php do_action( 'ultra_seven_post_meta' ); ?>
		                                    </div>
		                                </div><!-- .post-caption -->	
                                    </div>
        						</li>
        					<?php endwhile; wp_reset_postdata();?>
    					</ul>
    			    <?php endif;?>
    			</div>
    		<?php }?>
            <?php if($recent_comment == '1') {?>
    			<div id="widget-tab3-content-<?php echo esc_attr($uid);?>" class="tab-content" <?php if(($recent_post != '1') && ($popular_post != '1')) { echo 'style="display: block;"'; }?>>
    				<ul class="list comment-list">
    					<?php 
    						//get recent comments
    						$args = array(
    							   'status' => 'approve',
    								'number' => $no_of_item
    							);	
    						$comments = get_comments($args);
    						
    						foreach($comments as $comment) :							
    							$commentcontent = strip_tags($comment->comment_content);			
                                $commentcontent = ultra_seven_get_excerpt_content( $commentcontent, 30 );
    
                                
    							$commentauthor = $comment->comment_author;
    							$commentauthor = ultra_seven_get_excerpt_content( $commentauthor, 30 );		
    
    							$commentid = $comment->comment_ID;
    							$commenturl = get_comment_link($commentid); 
                                
                                $ultra_postid = $comment->comment_post_ID;
                                $title = get_the_title($ultra_postid);
                                $short_title = ultra_seven_get_excerpt_content( $title, 30 );
    		                   ?>
                                <li class="clearfix">
                                    <div class="author-comment-wrap">
                                        <div class="avatar thumb-zoom">
                                			<?php echo get_avatar( $comment, '80' ); ?>
                                		</div>
                                        <div class="text-wrap">
                                        <div class="cm-header">
                                            <div class="author-name">
                                                <?php echo esc_attr($commentauthor); ?>
                                            </div>
                                            <span>on</span>
                                            <div class="date">
                                                <?php echo (get_comment_date('', $commentid)); ?>
                                            </div>
                                        </div>
                                        <h4 class="post-title">
                                            <a href="<?php echo esc_url(get_permalink($ultra_postid)) ?>"><?php echo esc_html($short_title); ?></a>
                                        </h4>   
                                        <div class="comment-text">
                                    		<a href="<?php echo esc_url($commenturl); ?>"><?php echo esc_html($commentcontent); ?></a>
                                    	</div>
                                        </div> 
                                    </div>
                                </li>
    				<?php endforeach; wp_reset_postdata();?>
    				</ul>
    			</div>
            <?php }?>
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
