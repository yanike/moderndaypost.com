<?php
/**
 * Define custom fields for widgets
 * 
 * @package Wpoperation
 * @subpackage Ultra Seven
 * @since 1.0.0
 */

function ultra_seven_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $ultra_seven_widgets_field_type ) {

    	// Standard text field
        case 'text' :
        ?>
            <p>
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $athm_field_value ); ?>" />

                <?php if ( isset( $ultra_seven_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $ultra_seven_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Standard url field
        case 'url' :
        ?>
            <p>
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $athm_field_value ); ?>" />

                <?php if ( isset( $ultra_seven_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $ultra_seven_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Textarea field
        case 'textarea' :
        ?>
            <p>
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label>
                <textarea class="widefat" rows="<?php echo esc_attr($ultra_seven_widgets_row); ?>" id="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $athm_field_value ); ?></textarea>
                <?php if ( isset( $ultra_seven_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $ultra_seven_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Checkbox field
        case 'checkbox' :
        ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?></label>

                <?php if ( isset( $ultra_seven_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $ultra_seven_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Radio fields
        case 'radio' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $ultra_seven_widgets_default;
        	}
        ?>
            <p class="ultra-radio <?php echo isset($ultra_seven_widgets_class) ?  esc_attr( $ultra_seven_widgets_class ) : '';?>">
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label><br>
                <?php
                foreach ( $ultra_seven_widgets_field_options as $athm_option_name => $athm_option_title ) {
                    ?>
                    <span class="radio-wrap">
                    <input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>" type="radio" value="<?php echo esc_attr($athm_option_name); ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
                    <label for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?></label>
                    </span>
                <?php } ?>
                 <br>
                <?php if ( isset( $ultra_seven_widgets_description ) ) { ?>
                    <small><?php echo esc_html( $ultra_seven_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        // Select field
        case 'select' :
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $ultra_seven_widgets_default;
            }
        ?>
            <p class="ultra-select <?php echo isset($ultra_seven_widgets_class) ? esc_attr( $ultra_seven_widgets_class ) : '';?> clear">
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label>
                <select name="<?php echo esc_attr( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $ultra_seven_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr( $instance->get_field_id($athm_option_name ) ); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $ultra_seven_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $ultra_seven_widgets_description ); ?></small>
                <?php } ?>
            </p>
        <?php
            break;

        case 'switch':
            if( empty( $athm_field_value ) ) {
                $athm_field_value = $ultra_seven_widgets_default;
            }
        ?>
            <p>
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label>
                <div class="widget_switch_options">
                    <?php 
                        foreach ( $ultra_seven_widgets_field_options as $key => $value ) {
                            if( $key == $athm_field_value ) {
                                echo '<span class="widget_switch_part '.esc_attr($key).' selected" data-switch="'.esc_attr($key).'">'. esc_html($value).'</span>';
                            } else {
                                echo '<span class="widget_switch_part '.esc_attr($key).'" data-switch="'.esc_attr($key).'">'. esc_html($value).'</span>';
                            }                            
                        }
                    ?>
                    <input type="hidden" id="<?php echo esc_attr( $instance->get_field_id( $key ) ); ?>" name="<?php echo esc_html( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>" value="<?php echo esc_attr($athm_field_value); ?>" />
                </div>
            </p>
        <?php
            break;

        case 'number' :
        	if( empty( $athm_field_value ) ) {
        		$athm_field_value = $ultra_seven_widgets_default;
        	}
        ?>
            <p  class="ultra-num-field <?php echo esc_attr( $ultra_seven_widgets_class );?>">
                <label class="wtitle" for="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label><br />
                <input name="<?php echo esc_html( $instance->get_field_name( $ultra_seven_widgets_name ) ); ?>" type="number" step="1" min="0" id="<?php echo esc_attr( $instance->get_field_id( $ultra_seven_widgets_name ) ); ?>" value="<?php echo esc_html( $athm_field_value ); ?>" class="small-text" />

                <?php if ( isset( $ultra_seven_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $ultra_seven_widgets_description ); ?></small>
                <?php } ?>
            </p>
       	<?php
            break;

        case 'section_header':
        ?>
        	<span class="section-header"><?php echo esc_html( $ultra_seven_widgets_title ); ?></span>
        <?php
        	break;

        case 'widget_layout_image':
        ?>
            <div class="layout-image-wrapper">
                <span class="image-title"><?php echo esc_html( $ultra_seven_widgets_title ); ?></span>
                <img src="<?php echo esc_url( $ultra_seven_widgets_layout_img ); ?>" title="<?php esc_attr_e( 'Widget Layout', 'ultra-seven' ); ?>" />
            </div>
        <?php
            break;

        case 'upload' :

            $output = '';
            $id = $instance->get_field_id( $ultra_seven_widgets_name );
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name( $ultra_seven_widgets_name );

            if ( $value ) {
                $class = ' has-file';
                $value = explode( 'wp-content', $value );
                $value = content_url().$value[1];
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label class="wtitle" for="' . $instance->get_field_id( $ultra_seven_widgets_name ) . '">' . $ultra_seven_widgets_title . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_attr__( 'No file chosen', 'ultra-seven' ) . '" />' . "\n";
            if ( function_exists( 'wp_enqueue_media' ) ) {
                if ( ( $value == '') ) {
                    $output .= '<input id="upload-' . $id . '" class="ap-upload-button button" type="button" value="' . esc_attr__( 'Upload', 'ultra-seven' ) . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . esc_attr__( 'Remove', 'ultra-seven' ) . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . esc_html__( 'Upgrade your version of WordPress for full media support.', 'ultra-seven' ) . '</i></p>';
            }

            $output .= '<div class="screenshot upload-thumb" id="' . $id . '-image">' . "\n";

            if ( $value != '' ) {
                $remove = '<a class="remove-image">'. esc_html__( 'Remove', 'ultra-seven' ).'</a>';
                $attachment_id = ultra_seven_get_attachment_id_from_url( $value );
                $image_array = wp_get_attachment_image_src( $attachment_id, 'large' );
                $image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
                if ( $image ) {
                    $output .= '<img src="' . $image_array[0] . '" />';
                } else {
                    $parts = explode( "/", $value );
                    for ( $i = 0; $i < sizeof( $parts ); ++$i ) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = esc_html__( 'View File', 'ultra-seven' );
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;// WPCS: XSS OK.
            break;

        //Multi checkboxes
        case 'multicheckboxes':            
            if( isset( $ultra_seven_widgets_title ) ) {
            ?>
                <label class="wtitle"><?php echo esc_html( $ultra_seven_widgets_title ); ?>:</label>
            <?php
            }?>
            <div class="multi-wraper">
            <?php
            foreach ( $ultra_seven_widgets_field_options as $athm_option_name => $athm_option_title) {
                if( isset( $athm_field_value[$athm_option_name] ) ) {
                    $athm_field_value[$athm_option_name] = 1;
                }else{
                    $athm_field_value[$athm_option_name] = 0;
                }
            ?>

                <p>
                    <input id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) );?>" name="<?php echo esc_attr($instance->get_field_name( $ultra_seven_widgets_name )).'['.esc_attr($athm_option_name).']'; ?>" type="checkbox" value="1" <?php checked( '1', $athm_field_value[$athm_option_name] ); ?>/>
                    <label for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) );?>"><?php echo esc_html( $athm_option_title ); ?></label>
                </p>
            <?php
                } ?>
                </div>
                <?php
            break;

	        case 'color' :
	           ?>
	           <p>
	               <label class="widget-label" for="<?php echo esc_attr($instance->get_field_id($ultra_seven_widgets_name)); ?>"><?php echo esc_html($ultra_seven_widgets_title); ?>:</label><br />
	               <input type="text" class="as-widget-color" name="<?php echo esc_attr($instance->get_field_name($ultra_seven_widgets_name)); ?>" value="<?php echo esc_attr($athm_field_value); ?>" />
	           </p>            
	           <script type="text/javascript">
	                jQuery(document).ready(function($){
	                   // Call Color Picker in Widget Area
	                    $('.as-widget-color').wpColorPicker({
                            change: function(){$(this).trigger('change')}
                        });        
	                });
	           </script>
	           <?php
	           break;

        case 'wraper-start':
        $widgets_style = isset($ultra_seven_widgets_style) ? $ultra_seven_widgets_style : '';
        ?>
        <div class="section-wrapper <?php echo esc_attr($wraper_class); ?>" style="<?php echo esc_attr($widgets_style) ?>">
        <?php
        break;

        case 'wraper-end':
        ?>
        </div>
        <?php
        break;

         // Select field
        case 'section_tab_wrapper' :
        ?>
            <ul class="widget-tabs-wrapper">
                <?php 
                    foreach ( $ultra_seven_widgets_field_options as $tab_key => $tab_value ) {
                        if( $ultra_seven_widgets_default == $tab_key ) {
                            $active_class = 'active';
                        } else {
                            $active_class = '';
                        }
                ?>
                <li class="widget-tab-control <?php echo esc_attr( $active_class ); ?>" data-tab="<?php echo esc_attr( $tab_key ); ?>"><?php echo esc_html( $tab_value ); ?></li>
                <?php } ?>
            </ul><!-- .widget-tabs-wrapper -->
        <?php
        break;
        //Seperator
        case 'seperator':
        ?>

        <p class="seperator">
            <label for="<?php echo esc_attr($instance->get_field_id($ultra_seven_widgets_name)); ?>">
                <?php echo esc_html($ultra_seven_seperator);?>
            </label>
        </p>

        <?php
        break;
    }
}

function ultra_seven_widgets_updated_field_value( $widget_field, $new_field_value ) {
    extract( $widget_field );

    // Allow only integers in number fields
    if ( $ultra_seven_widgets_field_type == 'number') {
        return ultra_seven_sanitize_number( $new_field_value );

        // Allow some tags in textareas
    } elseif ( $ultra_seven_widgets_field_type == 'textarea' ) {
        // Check if field array specifed allowed tags
        if ( !isset( $ultra_seven_widgets_allowed_tags ) ) {
            // If not, fallback to default tags
            $ultra_seven_widgets_allowed_tags = '<p><strong><em><a>';
        }
        return strip_tags( $new_field_value, $ultra_seven_widgets_allowed_tags );

        // No allowed tags for all other fields
    } elseif ( $ultra_seven_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } elseif ( $ultra_seven_widgets_field_type == 'multicheckboxes' ) {
        return $new_field_value;
    } else {
        return strip_tags( $new_field_value );
    }
}