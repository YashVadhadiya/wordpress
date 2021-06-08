jQuery(document).ready(function($){
    if ( jQuery('.top-header-toggle-btn').length > 0 ) {
        $('.top-header-toggle-btn').on('click', function (e) {
            e.preventDefault();
            $('.site-header-topbar .container').toggle('slow');
            $('.top-header-toggle-btn i').toggleClass('ct-rotate');
        });
    }
    if ($('.hero_slick-slider').length > 0) {
        $('.hero_slick-slider').slick({
            items: 1,
            dots: false,
            infinite: true,
            centerMode: false,
            autoplay: true,
            lazyLoad: 'ondemand',
            adaptiveHeight: true
        });
    }

   /*
    ** ### Back to top function for guide section in detail page
    */ 

	if ($('.go-to-top').length) {
      var scrollTrigger = $('body').position(); // px
          goToTop = function () {
			  
      var scrollTop = $(window).scrollTop();
              if (scrollTop > 150) {
                  $('.footer-go-to-top').addClass('show');
              } else {
                  $('.footer-go-to-top').removeClass('show');
              }
          };
      goToTop();
      $(window).on('scroll', function () {
          goToTop();
      });
      $('.go-to-top').on('click', function (e) {
          e.preventDefault();
          $('html,body').animate({
              scrollTop: scrollTrigger.top
          }, 700);
      });
    }




    /****
     * Mobile Dropdown Menu Script
     */

    var menuPrimary_ul = $('#primary-menu'),
        parrentLink_li = $('#primary-menu > .menu-item-has-children'),
        secondLink_li = $('#primary-menu > .menu-item-has-children .menu-item-has-children'),
        subMenu_ul = $('#primary-menu > li  > .sub-menu'),
        secSubMenu_ul = $('#primary-menu .sub-menu .sub-menu'),
        MenuToggleBtn_button = $('#masthead .menu-toggle');

    function addMobileAccessBtn() {
        parrentLink_li.append('<span class="for-sub-menu"></span>');
        secondLink_li.append('<span class="sec-sub-menu"></span>');
    }

    function mobileMenuEasyDropDown() {
        addMobileAccessBtn();

        var subMenuBtn_span = $('.for-sub-menu');
        var secSubMenuBtn_span = $('.sec-sub-menu');

        subMenuBtn_span.click(function() {
            $(this).siblings(subMenu_ul).toggleClass('open');
        })

        secSubMenuBtn_span.click(function() {
            $(this).siblings(secSubMenu_ul).toggleClass('sec-open');
        })




    }

    function offCanvaMenu() {
        jQuery('.main-navigation').addClass('toggled');
        menuPrimary_ul.addClass('off_canva_nav');
        $('#primary-menu > li:first-child').addClass('focus');
        $('#primary-menu > li:first-child a').focus();


    }

    var width = $(window).width();
    if(width < 992) {
        $('.main-navigation').on('keydown', function(e) {
            if($('.main-navigation').hasClass('toggled')) {
                var focusableEls = $('.main-navigation a[href]:not([disabled]), .main-navigation button');
                var firstFocusableEl = focusableEls[0];
                var lastFocusableEl = focusableEls[focusableEls.length - 1];
                var KEYCODE_TAB = 9;
                if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
                    if ( e.shiftKey ) /* shift + tab */ {
                        if (document.activeElement === firstFocusableEl) {
                            lastFocusableEl.focus();
                            e.preventDefault();
                        }
                    }
                    else /* tab */ {
                        if (document.activeElement === lastFocusableEl) {
                            firstFocusableEl.focus();
                            e.preventDefault();
                        }
                    }
                }
            }
        });
    }

    MenuToggleBtn_button.click(function() {
        offCanvaMenu();

        jQuery('#primary-menu .close_nav').click(function() {

            jQuery('.main-navigation').removeClass('toggled');
            menuPrimary_ul.removeClass('off_canva_nav');
            $('.menu-toggle').focus();
        })
    })

    mobileMenuEasyDropDown();


    /****
     * Search Dialoge JS
     */
    if ($('.search-section').length) {
        var searchDialoge_section = $('.site > .search-section'),
            searchToggle_button = $('.search-toggle'),
            searchField_input = $('.site > .search-section .search-field'),
            searchClose_button = $('.close-btn');

        searchToggle_button.click(function () {
            searchDialoge_section.toggleClass('ct-search-access');
            setTimeout(function () {
                searchField_input.focus();
            }, 100)

            $('.site > .search-section').on('keydown', function (e) {
                if ($('.site > .search-section').hasClass('ct-search-access')) {
                    var focusableEls = $(' .site > .search-section .close-btn, .site > .search-section .search-field, .site > .search-section .search-submit');
                    var firstFocusableEl = focusableEls[0];
                    var lastFocusableEl = focusableEls[focusableEls.length - 1];
                    var KEYCODE_TAB = 9;
                    if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
                        if (e.shiftKey) /* shift + tab */ {
                            if (document.activeElement === firstFocusableEl) {
                                lastFocusableEl.focus();
                                e.preventDefault();
                            }
                        } else /* tab */ {
                            if (document.activeElement === lastFocusableEl) {
                                firstFocusableEl.focus();
                                e.preventDefault();
                            }
                        }
                    }
                }
            });

            searchClose_button.click(function () {
                searchDialoge_section.removeClass('ct-search-access');
            });
        });

    }

    //sticky sidebar
    var at_body = $("body");
    var at_window = $(window);

    if(at_body.hasClass('ct-sticky-sidebar')){
            $('#secondary, #primary').theiaStickySidebar();

    }

 });
jQuery(window).load(function($) {
    if ( jQuery('.fairy-masonry').length > 0 ) {
        var $container = jQuery('.fairy-masonry');
        // initialize
        $container.masonry({
            itemSelector: '.fairy-masonry article.post',
            columnWidth: '.fairy-masonry article.post',
            percentPosition: true
        });
    }
});

 