/* global signifyOptions */
 /*
 * Custom scripts
 * Description: Custom scripts for signify
 */

( function( $ ) {
	// Owl Carousel
	if ( typeof $.fn.owlCarousel === "function" ) {
		// Featured Slider
		var sliderOptions = {
			rtl:signifyOptions.rtl ? true : false,
			autoHeight:true,
			margin: 0,
			items: 1,
			nav: true,
			dots: false,
			autoplay: true,
			autoplayTimeout: 4000,
			loop: true,
		};

		$(".main-slider").owlCarousel(sliderOptions);

		var testimonialOptions = {
			rtl:signifyOptions.rtl ? true : false,
			autoHeight: true,
			margin: 0,
			items: 1,
			nav: true,
			autoplay: false,
			autoplayTimeout: 4000,
			loop: true,
			responsive:{
				0: {
					items:1
				},
			},
			dotsContainer: '#testimonial-dots',
			navContainer: '#testimonial-nav'
		};

		$( '.testimonial-slider' ).owlCarousel(testimonialOptions);

		$('#testimonial-content-section .owl-dot').on( 'click',function () {
			$( '.testimonial-slider' ).trigger('to.owl.carousel', [$(this).index(), 300]);
		});
	}

	// Match Height of Featured Content
	if ( typeof $.fn.matchHeight === "function" ) {
		$('#featured-content-section .entry-container').matchHeight();
	}

	$( function() {

		// Match Height of Featured Content
		if ( $.isFunction( $.fn.MatchHeight ) ) {
			$('#featured-content-section .entry-container').matchHeight();
		}

		// Functionality for scroll to top button
		$(window).on( 'scroll', function () {
			if ( $( this ).scrollTop() > 100 ) {
				$( '#scrollup' ).fadeIn('slow');
				$( '#scrollup' ).show();
			} else {
				$('#scrollup').fadeOut('slow');
				$("#scrollup").hide();
			}
		});

		$( '#scrollup' ).on( 'click', function () {
			$( 'body, html' ).animate({
				scrollTop: 0
			}, 500 );
			return false;
		});

		// Fit Vid load
		if ( typeof $.fn.fitVids === "function" ) {
			$('.hentry, .widget').fitVids();
		}
	});

	// Add header video class after the video is loaded.
	$( document ).on( 'wp-custom-header-video-loaded', function() {
		$( 'body' ).addClass( 'has-header-video' );
	});

	/*
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	$( function() {
		$( document ).ready( function() {
			if ( true === supportsInlineSVG() ) {
				document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
			}
		});
	});

	$( '.search-toggle' ).on( 'click', function() {
		$( this ).toggleClass( 'open' );
		$( this ).attr( 'aria-expanded', $( this ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		$( '.search-wrapper' ).toggle();
	});


	/* Menu */
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			.append( $( '<span />', { 'class': 'screen-reader-text', text: signifyOptions.screenReaderText.expand }) );

		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

		// Toggle buttons and submenu items with active children menu items.
		container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
		container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

		// Add menu items with submenus to aria-haspopup="true".
		container.find( '.menu-item-has-children, .page_item_has_children' ).attr( 'aria-haspopup', 'true' );

		container.find( '.dropdown-toggle' ).on( 'click', function( e ) {
			var _this            = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );

			// jscs:disable
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
			screenReaderSpan.text( screenReaderSpan.text() === signifyOptions.screenReaderText.expand ? signifyOptions.screenReaderText.collapse : signifyOptions.screenReaderText.expand );
		} );
	}

	// Top Menu
	menuToggleTop       = $( '#menu-toggle-top' ); // button id
	siteTopMenu         = $( '#top-main-wrapper' ); // wrapper id
	siteNavigationTop   = $( '#site-top-navigation' ); // nav id
	initMainNavigation( siteNavigationTop );

	// Enable menuToggleTop.
	( function() {
		// Return early if menuToggleTop is missing.
		if ( ! menuToggleTop.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggleTop.add( siteNavigationTop ).attr( 'aria-expanded', 'false' );

		menuToggleTop.on( 'click', function() {
			$( this ).add( siteTopMenu ).toggleClass( 'toggled-on selected' );

			// jscs:disable
			$( this ).add( siteNavigationTop ).attr( 'aria-expanded', $( this ).add( siteNavigationTop ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	initMainNavigation( $( '.main-navigation' ) );

	masthead          = $( '#masthead' );
	menuToggle        = masthead.find( '.menu-toggle' );
	siteHeaderMenu    = masthead.find( '#site-header-menu' );
	siteNavigation    = masthead.find( '#site-navigation' );
	socialNavigation  = masthead.find( '#social-navigation' );


	// Enable menuToggle.
	( function() {

		// Assume the initial scroll position is 0.
		var scroll = 0;

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		menuToggle.on( 'click.signify', function() {
			// jscs:disable
			$( this ).add( siteNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );


		// Add an initial values for the attribute.
		menuToggle.add( siteNavigation ).attr( 'aria-expanded', 'false' );
		menuToggle.add( socialNavigation ).attr( 'aria-expanded', 'false' );

		// Wait for a click on one of our menu toggles.
		menuToggle.on( 'click.signify', function() {

			// Assign this (the button that was clicked) to a variable.
			var button = this;

			// Gets the actual menu (parent of the button that was clicked).
			var menu = $( this ).parents( '.menu-wrapper' );

			// Remove selected classes from other menus.
			$( '.menu-toggle' ).not( button ).removeClass( 'selected' );
			$( '.menu-wrapper' ).not( menu ).removeClass( 'is-open' );

			// Toggle the selected classes for this menu.
			$( button ).toggleClass( 'selected' );
			$( menu ).toggleClass( 'is-open' );

			// Is the menu in an open state?
			var is_open = $( menu ).hasClass( 'is-open' );

			// If the menu is open and there wasn't a menu already open when clicking.
			if ( is_open && ! jQuery( 'body' ).hasClass( 'menu-open' ) ) {

				// Get the scroll position if we don't have one.
				if ( 0 === scroll ) {
					scroll = $( 'body' ).scrollTop();
				}

				// Add a custom body class.
				$( 'body' ).addClass( 'menu-open' );

			// If we're closing the menu.
			} else if ( ! is_open ) {

				$( 'body' ).removeClass( 'menu-open' );
				$( 'body' ).scrollTop( scroll );
				scroll = 0;
			}
		} );

		// Close menus when somewhere else in the document is clicked.
		$( document ).on( 'click touchstart', function() {
			$( 'body' ).removeClass( 'menu-open' );
			$( '.menu-toggle' ).removeClass( 'selected' );
			$( '.menu-wrapper' ).removeClass( 'is-open' );
		} );

		// Stop propagation if clicking inside of our main menu.
		$( '.site-header-menu, .menu-inside-wrapper, .menu-toggle, .dropdown-toggle, .search-field, #site-navigation, #social-search-wrapper, #social-navigation .search-submit' ).on( 'click touchstart', function( e ) {
			e.stopPropagation();
		} );
	} )();

	//For Footer Menu
	menuToggleFooter       = $( '#menu-toggle-footer' ); // button id
	siteFooterMenu         = $( '#footer-menu-wrapper' ); // wrapper id
	siteNavigationFooter   = $( '#site-footer-navigation' ); // nav id
	initMainNavigation( siteNavigationFooter );

	// Enable menuToggleFooter.
	( function() {
		// Return early if menuToggleFooter is missing.
		if ( ! menuToggleFooter.length ) {
			return;
		}

		// Add an initial values for the attribute.
		menuToggleFooter.add( siteNavigationFooter ).attr( 'aria-expanded', 'false' );

		menuToggleFooter.on( 'click', function() {
			$( this ).add( siteFooterMenu ).toggleClass( 'toggled-on selected' );

			// jscs:disable
			$( this ).add( siteNavigationFooter ).attr( 'aria-expanded', $( this ).add( siteNavigationFooter ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			// jscs:enable
		} );
	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.signify', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}

					if ( ! $( e.target ).closest( '.top-navigation li' ).length ) {
						$( '.top-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.signify', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );

				siteNavigationTop.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.signify', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.signify' );
				siteNavigationTop.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.signify' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.signify', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.signify blur.signify', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		} );

		siteNavigationTop.find( 'a' ).on( 'focus.signify blur.signify', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		} );

		$('.main-navigation button.dropdown-toggle').on( 'click',function() {
			$(this).toggleClass('active');
			$(this).parent().find('.children, .sub-menu').toggleClass('toggled-on');
		});

		$('.top-navigation button.dropdown-toggle').on( 'click',function() {
			$(this).toggleClass('active');
			$(this).parent().find('.children, .sub-menu').toggleClass('toggled-on');
		});
	} )();

	$(document).ready(function() {
		/*Search and Social Container*/
		$('.toggle-top').on('click', function(e){
			$(this).toggleClass('toggled-on');
		});

		$('#search-toggle').on('click', function(){
			$('#header-menu-social, #share-toggle').removeClass('toggled-on');
			$('#header-search-container').toggleClass('toggled-on');
		});

		$('#share-toggle').on('click', function(e){
			e.stopPropagation();
			$('#header-search-container, #search-toggle').removeClass('toggled-on');
			$('#header-menu-social').toggleClass('toggled-on');
		});
	});

	/* Playlist On Scroll For Mobile */
	var PlaylistOnScroll = function(){

		var scrollTop = $(window).scrollTop();

		if (scrollTop > 46) {
			$('body').addClass('playlist-fixed');
		} else {
			$('body').removeClass('playlist-fixed');
		}
	};

	/*Onload*/
	PlaylistOnScroll();

	/*On Scroll*/
	$(window).on( 'scroll',function() {
		PlaylistOnScroll();
	});

	// Show count in header if count is more than 0
	if (parseInt($(".site-header-cart .cart-contents .count").text()) !== 0) {
		$(".site-header-cart .cart-contents .count").show();
	}

	$( window ).on( 'load resize', function () {
		adjustHeight();
	});

	$('.team-content-wrapper .owl-nav button').each(function(){
		$(this).on('click', function(){
			adjustHeight();
		});
	});

	function adjustHeight(){
		var windowWidth = $(window).width();
		if(windowWidth > 768){
			var topHeight = $('#team-content-section .owl-item.active .entry-container').outerHeight();
			// calculate margin size
			var marginTop = topHeight / 2;
			//console.log(marginTop);

			// set css
			$('#team-content-section .owl-item.active .entry-container').css('margin-top', -marginTop);

			var thumbnail = $('#team-content-section .owl-item.active .post-thumbnail').outerHeight();
			var newHeight = thumbnail + marginTop + 42;

			$('#team-content-section  .owl-stage-outer.owl-height').css('height', newHeight);
		}else{
			var marginTop = 0;
			$('#team-content-section .owl-item.active .entry-container').css('margin-top', marginTop);
		}

		var containerHeight = $('.team-content-wrapper .owl-item.active .entry-container').innerHeight() + 42;
		$('.team-content-wrapper .owl-nav').css("bottom", containerHeight);
	}

	$(document).ready(function(){
		$('#team-dots').appendTo(".team-content-wrapper");
	});

	var windowWidth = $(window).width();
	if(windowWidth > 1200){
		$( window ).on( 'load resize', function () {
			var height = $('.team-content-wrapper .owl-item.active .post-thumbnail').innerHeight() + 35;
			$('.team-content-wrapper #team-dots').css("top", height);
		});
	};

	var windowWidth = $(window).width();
	if(windowWidth > 768){
		 $( window ).on( 'load resize', function () {
		 });
	}

	// Mobile Nav, search toggle on focus out event
	jQuery( document ).ready( function() {
		body = jQuery( document.body );
		jQuery( window )
			.on( 'load.signify resize.signify', function() {
			if ( window.innerWidth < 1200 ) {
				jQuery('#site-header-menu .menu-inside-wrapper').on('focusout', function () {
					var $elem = jQuery(this);

					// let the browser set focus on the newly clicked elem before check
					setTimeout(function () {
						if ( ! $elem.find(':focus').length ) {
							jQuery( '#menu-toggle' ).trigger('click');
						}
					}, 0);
				});

				jQuery('#top-menu-wrapper .menu-inside-wrapper').on('focusout', function () {
					var $elem = jQuery(this);

					// let the browser set focus on the newly clicked elem before check
					setTimeout(function () {
						if ( ! $elem.find(':focus').length ) {
							jQuery( '#menu-toggle-top' ).trigger('click');
						}
					}, 0);
				});
			}

			if ( window.innerWidth > 767 ) {
				jQuery('#primary-search-wrapper').on('focusout', function () {
					var $elem = jQuery(this);

					// let the browser set focus on the newly clicked elem before check
					setTimeout(function () {
						if ( ! $elem.find(':focus').length ) {
							jQuery( '#social-search-toggle' ).trigger('click');
						}
					}, 0);
				});
			}
		} );
	});

	// Portfolio Masonry.
	if ( $.isFunction( $.fn.masonry ) ) { 
		// Masonry blocks for portfolio.
		$blocksPortfolio = $('.grid');
		$blocksPortfolio.imagesLoaded(function(){
			$blocksPortfolio.masonry({
				itemSelector: '.grid-item',
				// slow transitions
				transitionDuration: '1s'
			});

			// Fade blocks in after images are ready (prevents jumping and re-rendering)
			$('.grid-item').fadeIn();

			$blocksPortfolio.find( '.grid-item' ).animate( {
				'opacity' : 1
			});
		});

		$( function() {
			setTimeout( function() { $blocksPortfolio.masonry(); }, 2000);
		});

		$(window).resize(function () {
			$blocksPortfolio.masonry();
		});
	}

	const top = function(){
    	let headerPadding = $('.header-top-bar').outerHeight();
    	$('.has-header-top.transparent-header-color-scheme .site-header-main').css('padding-top', headerPadding);
    }
    top();

    $(function(){
        $('.playlist-wrapper .hentry').append('<button class="playlist-hide"><span class="fa fa-angle-left" aria-hidden="true"></span></button>');
        $('.playlist-hide').on('click', function(){
            $(this).parents('.section').toggleClass('playlist-shorten');
            $('body').toggleClass('playlist-made-short');
        });
    });
    
})( jQuery );
