(function ($) {
    "use strict";
    jQuery(document).ready(function () {

        /* Sticky Header */
        var sticky_size = '';
        if (Math.max(document.documentElement.clientWidth, window.innerWidth || 0) > 960) {
            sticky_size = 'desktop';
        } else if (768 < Math.max(document.documentElement.clientWidth, window.innerWidth || 0) && Math.max(document.documentElement.clientWidth, window.innerWidth || 0) < 960) {
            sticky_size = 'tablets';
        } else if (Math.max(document.documentElement.clientWidth, window.innerWidth || 0) < 768) {
            sticky_size = 'mobiles';
        }

        $('.whb-sticky-view.both:not(.whb-sticky-fixed)').scrollMenu({
            scrollUpClass: 'is-visible',
            scrollDownClass: 'is-visible',
            scrollTopClass: 'is-top',
            scrollBottomClass: 'is-bottom',
            timeOut: 1000 / 60,
            tolleranceUp: 5,
            tolleranceDown: 5,
            scrollOffset: $('.whb-' + sticky_size + '-view').outerHeight() + 50,
            onScrollMenuUp: function () {},
            onScrollMenuDown: function () {},
            onScrollMenuTop: function () {},
            onScrollMenuBottom: function () {},
            onScrollMenuOffsetIn: function () {
                $('.whb-sticky-view:not(.whb-sticky-fixed)').addClass('header-sticky-hide');
            },
            onScrollMenuOffsetOut: function () {
                $('.whb-sticky-view:not(.whb-sticky-fixed)').removeClass('header-sticky-hide');
            }
        });
        $('.whb-sticky-view.upscroll:not(.whb-sticky-fixed)').scrollMenu({
            scrollUpClass: 'is-visible',
            scrollDownClass: 'is-hidden',
            scrollTopClass: 'is-top',
            scrollBottomClass: 'is-bottom',
            timeOut: 1000 / 60,
            tolleranceUp: 5,
            tolleranceDown: 5,
            scrollOffset: $('.whb-' + sticky_size + '-view').outerHeight() + 50,
            onScrollMenuUp: function () {},
            onScrollMenuDown: function () {},
            onScrollMenuTop: function () {},
            onScrollMenuBottom: function () {},
            onScrollMenuOffsetIn: function () {
                $('.whb-sticky-view:not(.whb-sticky-fixed)').addClass('header-sticky-hide');
            },
            onScrollMenuOffsetOut: function () {
                $('.whb-sticky-view:not(.whb-sticky-fixed)').removeClass('header-sticky-hide');
            }
        });
        $('.whb-sticky-view.downscroll:not(.whb-sticky-fixed)').scrollMenu({
            scrollUpClass: 'is-hidden',
            scrollDownClass: 'is-visible',
            scrollTopClass: 'is-top',
            scrollBottomClass: 'is-bottom',
            timeOut: 1000 / 60,
            tolleranceUp: 5,
            tolleranceDown: 5,
            scrollOffset: $('.whb-' + sticky_size + '-view').outerHeight() + 50,
            onScrollMenuUp: function () {},
            onScrollMenuDown: function () {},
            onScrollMenuTop: function () {},
            onScrollMenuBottom: function () {},
            onScrollMenuOffsetIn: function () {
                $('.whb-sticky-view:not(.whb-sticky-fixed)').addClass('header-sticky-hide');
            },
            onScrollMenuOffsetOut: function () {
                $('.whb-sticky-view:not(.whb-sticky-fixed)').removeClass('header-sticky-hide');
            }
        });

        // Share Toggles
        $('#wn-share-modal-icon').on('click', function () {
            var $current_element = $(this).closest('#webnus-header-builder');
            if ($current_element.find('.wn-header-share').hasClass('opened')) {
                $current_element.find('.main-slide-toggle').slideUp('opened');
                $current_element.find('.wn-header-share').removeClass('opened');
            } else {
                $current_element.find('.main-slide-toggle').slideDown(240);
                $current_element.find('#header-search-modal').slideUp(240);
                $current_element.find('#header-social-modal').slideUp(240);
                $current_element.find('#header-share-modal').slideDown(240);
                $current_element.find('.wn-header-share').addClass('opened');
                $current_element.find('.wn-header-search').removeClass('opened');
                $current_element.find('.wn-header-social').removeClass('opened');
            }
        });

        $(document).on('click', function (e) {
            if (e.target.id == 'wn-share-modal-icon')
                return;

            var $this = $('#wn-share-modal-icon');
            if ($this.closest('#webnus-header-builder').find('.wn-header-share').hasClass('opened')) {
                $this.closest('#webnus-header-builder').find('.main-slide-toggle').slideUp('opened');
                $this.closest('#webnus-header-builder').find('.wn-header-share').removeClass('opened');
            }
        });

        $(document).on('click', function (e) {
            //  return;
            var target = $(e.target);
            if (e.target.id == 'wn-search-modal-icon' || e.target.id == 'search-icon-trigger' || e.target.id == 'whb-trigger-element' || target.parents('.main-slide-toggle').length)
                return;

            var $this = $('.whb-header-slide').find('.whb-trigger-element');
            if ($this.closest('#webnus-header-builder').find('.wn-header-search').hasClass('opened')) {
                $this.closest('#webnus-header-builder').find('.main-slide-toggle').slideUp('opened');
                $this.closest('#webnus-header-builder').find('.wn-header-search').removeClass('opened');
            }
        });

        $(document).on('click', '#header-search-modal,#header-social-modal,#header-share-modal', function (e) {
            e.stopPropagation();
        });

        if ($.fn.magnificPopup) {
            // Popup map or any iframe
            $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,

                fixedContentPos: false
            });
            // Inline popups
            $('.whb-modal-element').each(function (index, el) {
                $(this).magnificPopup({
                    type: 'inline',
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = this.st.el.attr('data-effect');
                        }
                    },
                    midClick: true
                });
            });
        }

        if ($.fn.niceSelect) {
            $('.wn-polylang-switcher-dropdown select').niceSelect();
        }

        if ($.fn.superfish) {
            $('.whb-area:not(.whb-vertical) ul.nav').superfish({
                delay: 300,
                hoverClass: 'wn-menu-hover',
                animation: {
                    opacity: "show",
                    height: 'show'
                },
                animationOut: {
                    opacity: "hide",
                    height: 'hide'
                },
                easing: 'easeOutQuint',
                speed: 280,
                speedOut: 0,
                pathLevels: 2,
            });
        }

        $('.whb-nav-wrap .nav li a').addClass('hcolorf');


        /* Vertical Header */
        // #wrap Class vertical
        if ($('.whb-desktop-view').find('.whb-row1-area').hasClass('whb-vertical-toggle')) {
            $('#wrap').addClass('whb-header-vertical-toggle');
        } else if ($('.whb-desktop-view').find('.whb-row1-area').hasClass('whb-vertical')) {
            $('#wrap').addClass('whb-header-vertical-no-toggle');
        }

        // Toggle Vertical
        var $vertical_wrap = $('.whb-vertical.whb-vertical-toggle');
        var $vertical_contact_wrap = $('.whb-vertical-contact-form-wrap');

        $('.vertical-menu-icon-foursome').on('click', function (event) {
            event.preventDefault();

            if ($vertical_wrap.hasClass('is-open')) {
                $vertical_wrap.removeClass('is-open');
                $vertical_wrap.removeClass('whb-open-with-delay');
                $(this).siblings('.whb-vertical-logo-wrap,.vertical-contact-icon,.vertical-fullscreen-icon').removeClass('is-open');
                $(this).removeClass('is-open');
            } else {
                if ($vertical_contact_wrap.hasClass('is-open')) {
                    $vertical_contact_wrap.removeClass('is-open');
                    $vertical_wrap.addClass('whb-open-with-delay');
                    $('.vertical-contact-icon i').removeClass('is-open colorf');
                }
                $vertical_wrap.addClass('is-open');
                $(this).siblings('.whb-vertical-logo-wrap,.vertical-contact-icon,.vertical-fullscreen-icon').addClass('is-open');
                $(this).addClass('is-open');
            }

        });

        $('.vertical-menu-icon-triad').on('click', function (event) {
            event.preventDefault();

            if ($vertical_wrap.hasClass('is-open')) {
                $vertical_wrap.removeClass('is-open');
                $vertical_wrap.removeClass('whb-open-with-delay');
                $(this).removeClass('is-open');
            } else {
                if ($vertical_contact_wrap.hasClass('is-open')) {
                    $vertical_contact_wrap.removeClass('is-open');
                    $vertical_wrap.addClass('whb-open-with-delay');
                    $('.vertical-contact-icon i').removeClass('is-open colorf');
                }
                $vertical_wrap.addClass('is-open');
                $(this).addClass('is-open');
            }

        });

        // Vertical Contact Icon
        $('.vertical-contact-icon i').on('click', function (event) {
            event.preventDefault();

            if ($vertical_contact_wrap.hasClass('is-open')) {
                $vertical_contact_wrap.removeClass('is-open');
                $(this).removeClass('is-open colorf');
            } else {
                if ($vertical_wrap.hasClass('is-open')) {
                    $vertical_wrap.removeClass('is-open');
                    $vertical_contact_wrap.addClass('whb-open-with-delay');
                    $('.vertical-menu-icon-triad').removeClass('is-open colorf');
                }
                $vertical_contact_wrap.addClass('is-open');
                $(this).addClass('is-open colorf');
            }

        });

        // Vertical Nicescroll
        if ($.fn.niceScroll) {
            $('.whb-vertical').find('.whb-content-wrap').niceScroll({
                scrollbarid: 'whb-vertical-menu-scroll',
                cursorwidth: "5px",
                autohidemode: true,
            });
        }

        // Fullscreen Icon
        $('.vertical-fullscreen-icon i').toggle(function () {
            var site_document = document.documentElement,
                site_screen = site_document.requestFullScreen || site_document.webkitRequestFullScreen || site_document.mozRequestFullScreen || site_document.msRequestFullscreen;
            if (typeof site_screen != "undefined" && site_screen) {
                site_screen.call(site_document);
            } else if (typeof window.ActiveXObject != "undefined") {
                // for Internet Explorer
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript != null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }, function () {
            $.fullscreen.exit();
            return false;
        });

        // Vertical Menu
        $('.whb-vertical').find('.nav').find('li').each(function () {
            var $list_item = $(this);

            if ($list_item.children('ul').length) {
                $list_item.children('a').removeClass('sf-with-ul').append('<i class="sl-arrow-down whb-vertical-nav-icon"></i>');
            }
            
            $list_item.children('a').children('i').on('click', function (e) {           
                e.preventDefault();
                $list_item.children('ul').slideToggle(350,
                    function() {
                        if($list_item.children('a').children('i').hasClass('sl-arrow-down')) {
                            $list_item.children('a').children('i').attr('class', 'sl-arrow-up whb-vertical-nav-icon');
                            
                        } else {
                            $list_item.children('a').children('i').attr('class', 'sl-arrow-down whb-vertical-nav-icon');
                            
                        }
                    }
                );
            });
        });

    });

})(jQuery);