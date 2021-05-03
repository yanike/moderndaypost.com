/** 
 * Youtube Video Section
 */

function onYouTubeIframeAPIReady() {
    var cvideo = jQuery('#initial-video').attr('data-curvideo');
    player = new YT.Player('video-placeholder', {
        width: 740,
        height: 420,
        videoId: cvideo,
    });
}
/** 
 * Ultra Seven Custom Scripts
 */

jQuery(document).ready(function($) {
    'use strict';
    var win = $(window);

    //Preloader section
    win.load(function() {
        $('.ultra-seven-loader').fadeOut('slow');
    });

    /* For Header Search */
    $('.search-icon').on('click', function(e) {
        e.stopPropagation();
        $('.search-container').toggleClass('active');
        if ($('.search-container').hasClass('active')) {
            $('body').on('click', function() {
                $('.search-container').removeClass('active');
            });
            $(".search-container").on('click', function(e) {
                e.stopPropagation();
            });
        }
    });

    $(".search-icon").keyup(function(event) {
        if (event.keyCode === 13) {
            $('.search-container').toggleClass('active');
            if ($('.search-container').hasClass('active')) {
                $('body').on('click', function() {
                    $('.search-container').removeClass('active');
                });
                $(".search-container").on('click', function(e) {
                    e.stopPropagation();
                });
            }
        }
    });


    //Sticky Header
    if (ultra_params.sticky_menu == 'show') {
        win.scroll(function() {
            var sticky = $('.nav-search-wrap'),
                scroll = win.scrollTop();

            if (scroll >= 100) {
                sticky.addClass('fixed');
                $('.sticky-cont').addClass('ultra-container');
                $('.site-header.layout-three .ultra-logo').hide();
            } else {
                sticky.removeClass('fixed');
                $('.sticky-cont').removeClass('ultra-container');
                $('.site-header.layout-three .ultra-logo').show();
            }
        });
    }



    /* For Ticker */
    if($('.ultra-ticker').length){
    $('.ultra-ticker').lightSlider({
        loop: true,
        vertical: true,
        pager: false,
        auto: true,
        controls: true,
        speed: 600,
        pause: 3000,
        enableDrag: false,
        verticalHeight: 80,
        onSliderLoad: function() {
            $('.ultra-ticker').removeClass('cS-hidden');
        }
    });
    }

    /* For main slider */
    if($('.ultraSlider').length){
    $('.ultraSlider').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        enableDrag: false,
        loop: true,
        pager: false,
        pagerHtml: false,
        auto: true,
        speed: 700,
        pause: 4200,
        onSliderLoad: function() {
            $('.ultraSlider').removeClass('cS-hidden');

        }
    });
    }

    /**
     * Post Slider block
     */
    if($('.block-carousel').length){
    $('.block-carousel').each(function() {
        var ID = $(this).closest('.ultra-block-wrapper').attr('data-id');
        var Class = $(this).closest('.ultra-block-wrapper').attr('data-class');
        $('.' + Class + " .block-carousel").lightSlider({
            pager: false,
            speed: 700,
            item: ID,
            loop: true,
            auto: true,
            enableDrag: true,
            responsive: [{
                breakpoint: 840,
                settings: {
                    item: 2,
                    slideMove: 1,
                    slideMargin: 6,
                }
            }, {
                breakpoint: 480,
                settings: {
                    item: 1,
                    slideMove: 1
                }
            }],
            onSliderLoad: function() {
                $('.block-carousel').removeClass('cS-hidden');
            }
        });
    });
    }
    /* For Single Post gallery */
    if($('.ultra-gallery-items').length){
    $('.ultra-gallery-items').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        enableDrag: false,
        loop: true,
        speed: 700,
        pager: false,
        auto: true,
        onSliderLoad: function() {
            $('.ultra-gallery-items').removeClass('cS-hidden');

        }
    });
    }   

    /* Related Posts Slider */
    var RelatedWrap = $(".slide .related-posts-wrapper");
    if(RelatedWrap.length){
    RelatedWrap.lightSlider({
        item: 3,
        pager: false,
        enableDrag: false,
        controls: false,
        speed: 650,
        onSliderLoad: function() {
            RelatedWrap.removeClass('cS-hidden');
        },
        responsive: [{
            breakpoint: 840,
            settings: {
                item: 2,
                slideMove: 1,
                slideMargin: 6,
            }
        }, {
            breakpoint: 480,
            settings: {
                item: 1,
                slideMove: 1,
            }
        }]
    });

    $('.slide-action .ultra-lSPrev').on('click', function() {
        RelatedWrap.goToPrevSlide();
    });
    $('.slide-action .ultra-lSNext').on('click', function() {
        RelatedWrap.goToNextSlide();
    });
    }

    /* Woo SLider */
    var wooSlider = $(".tabs-cat-product");
    if(wooSlider.length){
    wooSlider.lightSlider({
        item: 4,
        pager: false,
        loop: true,
        speed: 600,
        controls: false,
        slideMargin: 20,
        onSliderLoad: function() {
            $('.tabs-cat-product').removeClass('cS-hidden');
        },
        responsive: [{
            breakpoint: 800,
            settings: {
                item: 2,
                slideMove: 1,
                slideMargin: 6,
            }
        }, {
            breakpoint: 480,
            settings: {
                item: 1,
                slideMove: 1,
            }
        }]
    });

    $('.ultra-lSPrev').click(function() {
        wooSlider.goToPrevSlide();
    });
    $('.ultra-lSNext').click(function() {
        wooSlider.goToNextSlide();
    });
    }

    /* Recent Popular tabs*/
    $(".widget_ultra_seven_widget_tabs .widget-tab-titles li").on('click', function() {
        $(this).siblings("li").removeClass('active');
        $(this).addClass("active");
        $(this).parents(".widget_ultra_seven_widget_tabs").find(".tab-content").hide();
        var selected_tab = $(this).find("a").attr("href");
        $(this).parents(".widget_ultra_seven_widget_tabs").find(selected_tab).show();
        return false;
    });

    /**
     * Youtube list selector with play and pause
     */
     if($('.vplay').length){
    $('.vplay').on('click', function() {
        player.playVideo();
        $(this).hide();
        $('.vpause').show();
    });

    $('.vpause').on('click', function() {
        player.pauseVideo();
        $(this).hide();
        $('.vplay').show();
    });

    $(document).on('click', '.list-thumb', function() {
        $('.list-thumb').removeClass('now-playing');
        $(this).addClass('now-playing');

        $('.vpause').hide();
        $('.vplay').show();

        var url = $(this).attr('data-videoid');
        var vid_title = $(this).attr('data-videotitle');
        var vid_time = $(this).attr('data-videotime');

        $('.curVideo-title').html(vid_title);
        $('.curVideo-time').html(vid_time);
        player.cueVideoById(url);
    });
    }
    /**
     * Sticky Sidebar
     */
    if (ultra_params.sidebar_sticky == 'show') {
        $('.primary, .secondary').theiaStickySidebar();
    }
    /**
     * WoW Animation
     */
    if (ultra_params.wow == 'show') {
        new WOW().init();
    }

    //Fix audio and video size
    if($('.ultra_video_wrap').length){
        $(".ultra-single-content").fitVids();
    }
    if($('.ultra_audio_wrap').length){
        $(".ultra-single-content").fitVids({
            customSelector: "iframe[src^='https://w.soundcloud.com']"
        });
    }


    /**
     * Back to top button
     **/
    win.scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#ultra-go-top').fadeIn();
        } else {
            $('#ultra-go-top').fadeOut();
        }
    });

    $('#ultra-go-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 2000);
        return false;
    });

    if (ultra_params.smoothscroll == 'show') {
        SmoothScroll({
             animationTime    : 1000, // [ms]
             stepSize         : 100, // [px]
        })
    }


/**
* Mobile navigation
*
*/
 $('body').on('click keypress','.toggle-wrapp', function(e){
    e.preventDefault();
     

    $('.site-header').toggleClass('toggled-on');
    $('body').toggleClass('toggled-modal');


    if( $(this).hasClass('close-wrapp') ){
        ultraElFocus('.mob-outer-wrapp .toggle-wrapp');
        
    }else{
        ultraElFocus('.toggle.close-wrapp.toggle-wrapp');
    }
   
 });



$('.mob-nav-wrapp ul li ul').slideUp();



$('body').on('vclick touchstart keypress','.mob-nav-wrapp .sub-toggle', function()  {
  
  $(this).next('ul.sub-menu').slideToggle(400);
  $(this).parent('li').toggleClass('mob-menu-toggle');
});

$('body').on('click touchstart keypress','.mob-nav-wrapp .sub-toggle-children',function() {
  $(this).next().next('ul.sub-menu').slideToggle(400);
    
});



// Elements to focus after modals are closed.
function ultraElFocus(focusElement){
     var _doc = document;
     setTimeout( function() {

    focusElement = _doc.querySelector( focusElement );
    focusElement.focus();

    }, 200 );
}



ultraSevenFocusTab();
function ultraSevenFocusTab(){
        var _doc = document;

        _doc.addEventListener( 'keydown', function( event ) {
            var toggleTarget, modal, selectors, elements, menuType, bottomMenu, activeEl, lastEl, firstEl, tabKey, shiftKey;
                
            if ( _doc.body.classList.contains( 'toggled-modal' ) ) {
                toggleTarget = '.mob-nav-wrapp';//mobile menu wrapper
                selectors = 'input, a, button';
                modal = _doc.querySelector( toggleTarget );

                elements = modal.querySelectorAll( selectors );
                elements = Array.prototype.slice.call( elements );

                if ( '.menu-modal' === toggleTarget ) {
                    menuType = window.matchMedia( '(min-width: 1000px)' ).matches;
                    menuType = menuType ? '.expanded-menu' : '.mobile-menu';

                    elements = elements.filter( function( element ) {
                        return null !== element.closest( menuType ) && null !== element.offsetParent;
                    } );

                    elements.unshift( _doc.querySelector( '.mob-outer-wrapp .toggle-wrapp' ) ); //mobile toggle

                    bottomMenu = _doc.querySelector( '.mob-outer-wrapp .menu-last' );//mobile menu last div

                    if ( bottomMenu ) {
                        bottomMenu.querySelectorAll( selectors ).forEach( function( element ) {
                            elements.push( element );
                        } );
                    }
                }

                lastEl = elements[ elements.length - 1 ];
                firstEl = elements[0];
                activeEl = _doc.activeElement;
                tabKey = event.keyCode === 9;
                shiftKey = event.shiftKey;

                if ( ! shiftKey && tabKey && lastEl === activeEl ) {
                    event.preventDefault();
                    firstEl.focus();
                }

                if ( shiftKey && tabKey && firstEl === activeEl ) {
                    event.preventDefault();
                    lastEl.focus();
                }
            }
        } );
}

});