jQuery(document).ready(function($) {
    'use strict';


    /**
     * Script for switch option
     */
    $('.switch_options').each(function() {
        //This object
        var obj = $(this);

        var switchPart = obj.children('.switch_part').attr('data-switch');
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        obj.children('.switch_part.' + input_val).addClass('selected');
        obj.children('.switch_part').on('click', function() {
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            $(input).val(switchVal).change(); //Finally change the value to 1
        });

    });
    /**
     * Script for widget switch option
     */
    $('body').on('click', '.widget_switch_part', function() {
        $(this).trigger('change');
        $(this).parent().find('.widget_switch_part').removeClass('selected');
        $(this).addClass('selected');
        var switch_val = $(this).data('switch');
        $(this).parent().find('input[type="hidden"]').val(switch_val);
    });

    $(document).on('click', '.wp-picker-container button', function() {
        $(this).$('.button[name="savewidget"]').prop('disabled', false);
    });

    /**
     * Widget tab wrapper control
     */
    $(document).on('widget-updated', function() {
        $('.widget-tabs-wrapper').each(function() {
            var vThis = $(this);
            var activeTab = vThis.children('li.active').attr('data-tab');
            vThis.siblings('.section-wrapper.' + activeTab).show();
        });
    });

    $('.widget-tabs-wrapper').each(function() {
        var vThis = $(this);
        var activeTab = vThis.children('li.active').attr('data-tab');
        vThis.siblings('.section-wrapper.' + activeTab).show();
    });

    $('body').on('click', '.widget-tab-control', function() {
        var tab_val = $(this).attr('data-tab');
        $(this).parent().find('.widget-tab-control').removeClass('active');
        $(this).addClass('active');
        $(this).parents('.widget-content').find('.section-wrapper').hide();
        $(this).parents('.widget-content').find('.section-wrapper.' + tab_val).fadeIn();
    });

    $('body').on('click', '.widget-content .seperator', function() {
        $('.banner-field').slideUp();
        $('.seperator').removeClass('arrow-up');
        $(this).toggleClass('arrow-up');
        $(this).siblings('.banner-field').slideToggle();
    });

    /* Post Type Dependency */
    $('.section-wrapper').each(function(){
        var dis = $(this);
        
        $(document).on('click','.ultra-radio.post-type input', function() {
           var val = $(this).val();
        
           if( val=='category' ){
            $(this).parent().parent().parent().find('.category-choose').show();
           }else{
            $(this).parent().parent().parent().find('.category-choose').hide();
           }
        });
    });
    //on load
    $('.section-wrapper').each(function(){
        var dis = $(this);
        var val = dis.find('.ultra-radio.post-type input:checked').val();
       if(val=='category'){
         dis.find('.category-choose').show();
       }else{
         dis.find('.category-choose').hide();
       }
    });

   
   
});