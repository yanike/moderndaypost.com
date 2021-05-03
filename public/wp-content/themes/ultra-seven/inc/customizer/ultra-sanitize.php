<?php


//Text
function ultra_seven_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

// Number
function ultra_seven_sanitize_number( $input ) {
    $output = intval($input);
     return $output;
}

//Checkbox
function ultra_seven_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

// Number Float-val
function ultra_seven_floatval( $input ) {
    $output = floatval( $input );
     return $output;
}


//switch option
function ultra_seven_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => esc_html__( 'Show', 'ultra-seven' ),
            'hide'  => esc_html__( 'Hide', 'ultra-seven' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//breadcrumb sanitize
function ultra_seven_sanitize_breadcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        )
     );
    return wp_kses($input,$all_tags);
    
}

//radio box sanitization function
function ultra_seven_sanitize_radio( $input, $setting ){
 
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                     
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
     
}

/* Active Callbacks */
function ultra_header_layout(){
    $header_layout = get_theme_mod('ultra_seven_header_layouts','ultra-header-1');
    if($header_layout == 'ultra-header-1'){
        return true;
    }
    return false;

}

function ultra_ticker_post_type(){
    $ticker_type = get_theme_mod('ultra_seven_ticker_type','latest');
    if($ticker_type == 'category'){
        return true;
    }
    return false;
}