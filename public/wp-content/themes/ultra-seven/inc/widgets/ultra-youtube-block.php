<?php
/**
 * YOutube Videos Widget
 *
 * @package Ultra Seven 
 */
add_action( 'widgets_init', 'ultra_youtube_block_register' );

function ultra_youtube_block_register() {
    register_widget( 'ultra_seven_youtube_block' );
}
class Ultra_Seven_Youtube_Block extends WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'widget_ultra_seven_youtube_block',
            'description' => esc_html__( 'Display youtube Videos.', 'ultra-seven' )
        );
      parent::__construct( 'ultra_seven_youtube_block', esc_html__( '*ULTRA : Youtube Videos', 'ultra-seven' ), $widget_ops );
    }

    private function widget_fields() {

        $fields = array(

            'block_title' => array(
                'ultra_seven_widgets_name'         => 'block_title',
                'ultra_seven_widgets_title'        => esc_html__( 'Block Title', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),
            'api_key' => array(
                'ultra_seven_widgets_name'         => 'api_key',
                'ultra_seven_widgets_title'        => esc_html__( 'API Key', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'text'
            ),
            'youtube_videos' => array(
                'ultra_seven_widgets_name'         => 'youtube_videos',
                'ultra_seven_widgets_title'        => esc_html__( 'Video ID\'s', 'ultra-seven' ),
                'ultra_seven_widgets_row'          => 10,
                'ultra_seven_widgets_description'      => esc_html__( 'Add youtube Videos Id\'s seperated by commas.(eg: xrt27dZ7DOA, u8--jALkijM, HusniLw9i68)', 'ultra-seven' ),
                'ultra_seven_widgets_field_type'   => 'textarea'
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
        $ultra_seven_videos_ids = isset( $instance['youtube_videos'] ) ? $instance['youtube_videos'] : '';
        $ultra_block_header_type = 'style-1';
        wp_enqueue_script('iframe-api');
        ?>
        <div class="ultra-block-wrapper youtube-video">
            <div class="ultra-container">
                
                <?php 
                    //$API = 'AIzaSyAZoRJdR_yT0As29mAiCNItc25jSfVHC5k';
                    $API = isset( $instance['api_key'] ) ? $instance['api_key'] : '';
                    if( !empty( $ultra_seven_videos_ids ) && !empty($API) ) {
                        $seperate_id = explode( ',', $ultra_seven_videos_ids );
                        $init_vid = $seperate_id[0];
                        
                        $resvid = wp_remote_get( 'https://www.googleapis.com/youtube/v3/videos?id='. $init_vid .'&part=id,contentDetails,snippet&key='.$API, array(
                                        'sslverify' => false
                                    ) );

                        $init_data = wp_remote_retrieve_body($resvid);

                        $init_obj = json_decode($init_data, true);
                        if(isset($init_obj)){
                            if(isset($init_obj['error'])){
                                echo '<p>'.$init_obj['error']['message'].'</p>';
                                return;
                            }
                            $video_title = $init_obj['items'][0]['snippet']['title'];
                            $video_duration = ultra_seven_covtime( $init_obj['items'][0]['contentDetails']['duration'] );
                            ?>
                            <div class="youtube-inner-wrapper">
                                <?php if($ultra_element_title):?>
                                    <div class="block-header <?php echo esc_attr($ultra_block_header_type);?> clearfix">
                                        <div class="header"><?php echo esc_html($ultra_element_title); ?> </div>
                                    </div><!-- .block-header-->
                                <?php endif; ?>
                                <input id="initial-video" type="hidden" data-curVideo="<?php echo esc_attr( $init_vid ); ?>" />
                                <div id="video-placeholder"></div>
                                <div class="video-list-wrapper">
                                    <div class="video-controls clearfix">
                                        <div class="controller">
                                            <span class="ctrl-icon vplay">
                                                <i class="fa fa-play"></i>           
                                            </span>
                                            <span class="ctrl-icon vpause" style="display: none;">
                                                <i class="fa fa-pause"></i>            
                                            </span>
                                        </div>
                                        <div class="curVideo-info">
                                            <div class="curVideo-title"><?php echo esc_html( $video_title ); ?></div>
                                            <div class="curVideo-time"><?php echo esc_html( $video_duration ); ?></div>
                                        </div><!-- .cur-video-info -->
                                    </div><!-- .video-controls -->
                                    <div class="single-list-wrapper clearfix">
                                        <?php 
                                            $tcount = 1;
                                            foreach ( $seperate_id as $key => $value ) {
                                                $response = wp_remote_get( 'https://www.googleapis.com/youtube/v3/videos?id='. $value .'&part=id,contentDetails,snippet&key='.$API, array(
                                                            'sslverify' => false
                                                        ) );

                                                $data = wp_remote_retrieve_body($response);

                                                $obj = json_decode($data, true);
                                                if( is_array($obj) && !empty( $obj[ 'items' ] ) ) {

                                                    $video_thumb = $obj['items'][0]['snippet']['thumbnails']['default']['url'];
                                                    $video_title = $obj['items'][0]['snippet']['title'];
                                                    $video_duration = ultra_seven_covtime( $obj['items'][0]['contentDetails']['duration'] );
                                        ?>
                                                    <div class="list-thumb clearfix <?php if( $tcount == 1 ){ echo "now-playing"; } ?>" data-videoid="<?php echo esc_attr( $value ); ?>" data-videotitle="<?php echo esc_attr( $video_title ); ?>" data-videotime="<?php echo esc_attr( $video_duration ); ?>">
                                                        <figure class="list-thumb-figure">
                                                            <img src="<?php echo esc_url( $video_thumb ); ?>" title="<?php echo esc_attr( $video_title );?>" alt="<?php echo esc_attr( $video_title );?>"/>
                                                        </figure>
                                                        <div class="list-thumb-details">
                                                            <span class="thumb-title"><?php echo esc_html( $video_title ); ?></span>
                                                            <span class="thumb-time"><?php echo esc_html( $video_duration ) ; ?></span>
                                                        </div>
                                                    </div><!--.list-thumb-->
                                        <?php }else{ ?> 
                                                    <div class="ultra-video-list clearfix">  
                                                        <div class="ultra-title-duration">
                                                            <h6><i><?php _e( 'Either this video has been removed or you don\'t have access to watch this video', 'ultra-seven' ); ?></i></h6>
                                                        </div>
                                                    </div>
                                            <?php }

                                            $tcount++;
                                            }
                                        ?>
                                    </div><!-- .single-list-wrapper -->
                                </div><!-- .video-list-wrapper -->
                            </div><!-- .youtube-inner-wrapper -->
                        <?php }else{ echo '<p>'.esc_html__('No Internet Connection!!','ultra-seven').'</p>'; }?>
                <?php }else{ echo '<p>'.esc_html__('Invalid ID!!','ultra-seven').'</p>'; } ?>
            </div>
        </div><!-- .ultra-block-wrapper -->

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
