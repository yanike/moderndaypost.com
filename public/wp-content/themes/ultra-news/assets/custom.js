/** 
 * Ultra News Custon Scripts
 */

(function($) {
    'use strict';
    var win = $(window);

    //Sticky Header
    if (ultra_params.sticky_menu == 'show') {
        win.scroll(function() {
            var sticky = $('.ultra-custom-header'),
                scroll = win.scrollTop();

            if (scroll >= 100) {
                sticky.addClass('fixed');
            } else {
                sticky.removeClass('fixed');
            }
        });
    }

})(jQuery);    