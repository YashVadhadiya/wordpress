(function ($, window, document, undefined) {

	$(document).ready(function () {

		"use strict";

		/* Shop Product Shortcode */
		if ($('body').find('.wn-shop-products-shortocde').length >= 1) {
			$('body').addClass('woocommerce woocommerce-page wn-shop');
			$(this).find('.wn-woo-sidebar').remove();
			$(this).find('.wn-woo-main').removeClass('wn-woo-has-sidebar');
		}

		/* Start One Lines */

		$('.deep-woo-single-product-price ins .woocommerce-Price-amount').addClass('colorf');
		$('.deep-woo-single-details-content.deep-woo-single-share-button .social-sharing a').addClass('hcolorf');

		// call nice select plugin
		$('.deep-woo-single-product-attr').find('select').niceSelect();

		(function () {

			var data_value = $('.wn-woo-variables').find('.value').find('.list').find('li.selected').data('value');
			if (data_value == '') {
				$('.single_add_to_cart_button').attr('disabled', 'disabled');
			}

			$('.wn-woo-variables').find('.value').find('select').on('change', function () {
				var $this = $(this),
					optionSelected = $("option:selected", $this),
					valueSelected = $this.val();

				if (valueSelected == '') {
					$this.closest('.deep-woo-single-detail').find('.single_add_to_cart_button').attr('disabled', 'disabled');
				} else {
					$this.closest('.deep-woo-single-detail').find('.single_add_to_cart_button').removeAttr('disabled');
				}

			});

		})();

		$('select').on('change', function (e) {
			var optionSelected = $("option:selected", this);
			var valueSelected = this.value;
		});

		// Review Tab
		$("<li>Reviews</li>").insertBefore($(".woocommerce-Tabs-panel #reviews #comments .commentlist li:first-of-type"));

		$('.related.products > ul.products,.upsells.products > ul.products').addClass('deep-woo-related-carousel-wrap owl-carousel owl-theme');

		// Add webnus wrap class
		$('body').not('.woocommerce').addClass('wn-woo-wrap');

		if (($('body').hasClass('woocommerce')) && $('body').find('.wn-woo-wrap').length == '0') {
			$('body').addClass('wn-woo-wrap');
		}


		/* Start Functions */

		// Run after Ajax
		function run_document_ready_and_after_ajax() {


			// List and Grid Switcher
			var $woo_main = $('.post-type-archive-product .wn-woo-main'),
				current_woo_skin_name = $woo_main.find('.wn-woo-skin-switcher').find('span.wn-active').data('woo-skin'),
				$filter_widget = $woo_main.find('.wn-woo-mobile-filters-widgets');

			$('.wn-woo-mobile-filters .wn-woo-mobile-filters-button').on('click', function(e) {
				e.preventDefault();
				
				$filter_widget.slideToggle( 400, function(){
					if ( ! $(this).hasClass('active') ) {
						$filter_widget.addClass('fade-in');
						$(this).addClass('active');
					} else {
						$filter_widget.removeClass('fade-in');
						$(this).removeClass('active');
					}
				});
			});		

			$filter_widget.find('.wn-woo-widget-wrap li .widget-title').on('click', function () {

				if ($(this).hasClass('open-title')) {
					$(this).find('i').removeClass('ti-minus').addClass('ti-plus');
					$(this).siblings('.woo-widget-content').slideUp(260).removeClass('open-content');
					$(this).removeClass('open-title');
				} else {
					$filter_widget.find('.widget-title i').removeClass('ti-minus').addClass('ti-plus');
					$filter_widget.find('.woo-widget-content').slideUp(260).removeClass('open-content');
					$filter_widget.find('.widget-title').removeClass('open-title');
					$(this).find('i').addClass('ti-minus');
					$(this).addClass('open-title');
					$(this).siblings('.woo-widget-content').addClass('open-content').slideDown('open');
				}

			});

			// Remove () from category count in widget
			$('.product-categories .cat-item .count').text(function (_, text) {
				return text.replace(/\(|\)/g, '');
			});

			// Add X to filters
			$('.widget_layered_nav .wc-layered-nav-term.chosen a').append('<i class="ti-close"></i>');


			// Toggle woo list/gird
			$woo_main.find('.wn-woo-skin-switcher').find('a').on('click', function (event) {

				event.preventDefault();

				var $this = $(this),
					$child_span = $this.find('span');

				if ($child_span.hasClass('wn-active')) {
					return;
				}

				var woo_skin_name = $child_span.data('woo-skin');

				// add wn-active to current span
				$woo_main.find('.wn-woo-skin-switcher').find('span').removeClass('wn-active');
				$child_span.addClass('wn-active');

				$woo_main.find('.product.type-product').removeClass('type-grid').removeClass('type-list').addClass('type-' + woo_skin_name);
				$woo_main.attr('data-woo-skin', woo_skin_name);

				$woo_main.find('.wn-woo-skin').hide();
				$woo_main.find('.wn-woo-skin.wn-woo-products-' + woo_skin_name).show();

			});

			// readmore and add to cart style
			$('.add_to_cart_button.wc-forward, .type-list-readmore a').addClass('colorf large square').wrapInner('<span></span>');

			$('body').on('click', '.add_to_cart_button', function (event) {
				$(this).find('span').css({
					color: 'transparent',
					transition: 'none'
				});
				$(this).css({
					color: 'transparent',
					transition: 'none'
				});
				$(this).ajaxStop(function () {
					$(this).siblings('.wc-forward').addClass('button colorf large square').wrapInner('<span></span>');
				});
			});

			$('.button.yith-wcqv-button,.wn-woo-btn .button,.wn-woo-btn.wn-wishlist-btn').on('click', function () {
				$(this).closest('.product.type-product.type-grid').addClass('active-hover');
				$(this).ajaxStop(function () {
					$(this).closest('.product.type-product.type-grid').removeClass('active-hover');
				});
			});
		}
		run_document_ready_and_after_ajax();


		// start ajax add product wishlist
		function add_to_wishlist() {
			$('.wn-wishlist-btn').not('.wn-added-wishlist').on('click', function (event) {

				if ($(this).hasClass('wn-added-wishlist')) {
					event.stopPropagation();
					return;
				} else {
					var $this = $(this);
					$this.addClass('wn-wishlist-btn-loader');
					// get product id 
					var field = $this.attr('data-id');
					var number = parseInt($('.wn-wishlist-cnt').text(), 10);
				}
				$.ajax({
					type: 'POST',
					url: deep_wishlist_js.ajax_url, //get ajax url from loclized script
					data: {
						'action': 'add_wishlist_deep', // wp ajax function action
						'proidadd': field
					},
					success: function (data) {
						if ($(this).hasClass('wn-added-wishlist')) {
							event.stopPropagation();
							return;
						} else {
							setTimeout(function () {
								if (data != 0) {
									$('.wn-header-wishlist-content-wrap').remove(); // delete prev content
									var a = data; // get new content
									$(a).appendTo('.wn-header-wishlist-wrap'); // replace new content
									$('.wn-wishlist-cnt').text(number + 1); // add one to cnt wishlist when clicked
									$this.closest('.deep-woo-single-wishlist-button').attr('data-name', deep_wishlist_js.translatblewishlist);
									$this.attr('data-wntooltip', deep_wishlist_js.translatblewishlist).addClass('wn-added-wishlist'); // wishlist tooltip
									$this.removeClass('wn-wishlist-btn-loader');
								}
							}, 100);
						}
					}
				});
			});
		}
		add_to_wishlist(); // end ajax add product wishlist

		// start ajax remove product wishlist
		(function () {
			$('.wn-remove-from-wishlist').on('click', function (event) {

				event.preventDefault();

				var $this = $(this),
					field = $this.attr('data-wish'), //get id
					items_in_header = $('.wn-header-wishlist-content-wrap').find('.wn-remove-from-wishlist'),
					items_in_content = $('.wn-wishlist-single-wrap').find('.wn-remove-from-wishlist'),
					$preloader = $('<div class="wn-circle-side-wrap"><div data-loader="wn-circle-side"></div></div>');

				$preloader.appendTo($(this).closest('.wn-wishlist-contents'));
				$preloader.appendTo($(this).closest('.wn-wishlist-single-wrap'));


				$.ajax({
					type: 'POST',
					url: deep_wishlist_js.ajax_url,
					data: {
						'action': 'remove_wishlist_deep', // ajax url get from loclized
						'proid': field
					},
					success: function (data) {
						setTimeout(function () {
							$('.wn-wishlist-cnt').text($('.wn-wishlist-cnt').text() - 1); // remove item from cnt
							$('.wn-wishlist-total-cnt').text($('.wn-wishlist-total-cnt').text() - 1); // remove item from cnt in wrap

							for (var i = 0; i < items_in_header.length; i++) {
								if (items_in_header[i]['attributes']['0']['value'] == field) {
									items_in_header[i].closest('.wn-wishlist-content').remove();
								}
							}
							for (var i = 0; i < items_in_content.length; i++) {
								if (items_in_content[i]['attributes']['0']['value'] == field) {
									items_in_content[i].closest('.wn-wishlist-content-sl').remove();

								}
							}
							$preloader.remove();
						}, 1000);
					}
				});
			});
		})(); // end ajax remove product wishlist

		/* global woocommerce_price_slider_params, accounting */
		function run_price_filter_after_ajax() {

			// woocommerce_price_slider_params is required to continue, ensure the object exists
			if (typeof woocommerce_price_slider_params === 'undefined') {
				return false;
			}

			// Get markup ready for slider
			$('input#min_price, input#max_price').hide();
			$('.price_slider, .price_label').show();

			// Price slider uses jquery ui
			var min_price = $('.price_slider_amount #min_price').data('min'),
				max_price = $('.price_slider_amount #max_price').data('max'),
				current_min_price = parseInt(min_price, 10),
				current_max_price = parseInt(max_price, 10);

			if (woocommerce_price_slider_params.min_price) {
				current_min_price = parseInt(woocommerce_price_slider_params.min_price, 10);
			}
			if (woocommerce_price_slider_params.max_price) {
				current_max_price = parseInt(woocommerce_price_slider_params.max_price, 10);
			}

			$(document.body).on('price_slider_create price_slider_slide', function (event, min, max) {

				$('.price_slider_amount span.from').html(accounting.formatMoney(min, {
					symbol: woocommerce_price_slider_params.currency_format_symbol,
					decimal: woocommerce_price_slider_params.currency_format_decimal_sep,
					thousand: woocommerce_price_slider_params.currency_format_thousand_sep,
					precision: woocommerce_price_slider_params.currency_format_num_decimals,
					format: woocommerce_price_slider_params.currency_format
				}));

				$('.price_slider_amount span.to').html(accounting.formatMoney(max, {
					symbol: woocommerce_price_slider_params.currency_format_symbol,
					decimal: woocommerce_price_slider_params.currency_format_decimal_sep,
					thousand: woocommerce_price_slider_params.currency_format_thousand_sep,
					precision: woocommerce_price_slider_params.currency_format_num_decimals,
					format: woocommerce_price_slider_params.currency_format
				}));

				$(document.body).trigger('price_slider_updated', [min, max]);
			});

			$('.price_slider').slider({
				range: true,
				animate: true,
				min: min_price,
				max: max_price,
				values: [current_min_price, current_max_price],
				create: function () {

					$('.price_slider_amount #min_price').val(current_min_price);
					$('.price_slider_amount #max_price').val(current_max_price);

					$(document.body).trigger('price_slider_create', [current_min_price, current_max_price]);
				},
				slide: function (event, ui) {

					$('input#min_price').val(ui.values[0]);
					$('input#max_price').val(ui.values[1]);

					$(document.body).trigger('price_slider_slide', [ui.values[0], ui.values[1]]);
				},
				change: function (event, ui) {

					$(document.body).trigger('price_slider_change', [ui.values[0], ui.values[1]]);
				}
			});
		}


		// start ajax filters
		(function () {

			// Get URL without Queries
			function getPathFromUrl(url) {
				return url.split(/[?#]/)[0];
			}

			// Get Queries without URL
			function getQueriesFromUrl(query) {
				return query.split(/[?#]/)[1];
			}

			// Change value of query in URL
			function updateQueryStringParameter(uri, key, value) {
				var queries = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
				var separator = uri.indexOf('?') !== -1 ? "&" : "?";
				if (uri.match(queries)) {
					return uri.replace(queries, '$1' + key + "=" + value + '$2');
				} else {
					return uri + separator + key + "=" + value;
				}
			}

			function deep_jquery_woocommerce() {
				$('.woocommerce-ordering').off("change", "select.orderby");
				//Target quantity inputs on product pages
				$('input.qty:not(.product-quantity input.qty)').each(function () {
					var min = parseFloat($(this).attr('min'));

					if (min >= 0 && parseFloat($(this).val()) < min) {
						$(this).val(min);
					}
				});
				// call nice select plugin
				$('.wn-woo-wrap').find('.wn-nice-select').find('select').niceSelect();
			}
			deep_jquery_woocommerce();

			$('.wn-woo-wrap').on('click', '.cat-item a,.price_slider_amount button,.nice-select.orderby ul li,.widget_layered_nav .wc-layered-nav-term a,.woocommerce-pagination .page-numbers li a,.widget_product_tag_cloud .tagcloud a', function (event) {

				event.preventDefault();

				var $target = $(event.target),
					$hasBeenClicked = 'none',
					$this = $(this),
					$wn_woo_wrap = $this.closest('.wn-woo-wrap'),
					$old_url = $wn_woo_wrap.find('.deep-woo-ajax-url').attr('value');

				// Get queries from $old_url
				if ($old_url.indexOf('?') > -1) {
					var $query_url = getQueriesFromUrl($old_url),
						$page_url = getPathFromUrl($old_url);
				}

				// Get just main url from $old_url
				if ($old_url.indexOf('page/') > -1) {

					if ($old_url.indexOf('?') > -1) {
						var $old_url = $old_url.split('page')[0] + '/?' + $query_url;
					} else {
						var $old_url = $old_url.split('page')[0];
					}

				}

				// Check which element clicked
				if ($target.is('.cat-item a')) {

					$hasBeenClicked = 'category';

					// Get URL for ajax
					if ($old_url.indexOf('?') > -1) {
						var $url = $this.attr('href') + '?' + $query_url;
					} else {
						var $url = $this.attr('href');
					}

					// add current class to category navigation
					$wn_woo_wrap.find('.cat-item').removeClass('current-cat');
					$this.parent('.cat-item').addClass('current-cat');

				} else if ($target.is('.price_slider_amount button')) {

					$hasBeenClicked = 'price';
					var $min_price = parseInt($this.siblings('.price_label').find('span:first-child').html().replace(/[^0-9\.]/g, ''), 10),
						$max_price = parseInt($this.siblings('.price_label').find('span:last-child').html().replace(/[^0-9\.]/g, ''), 10);
					if ($old_url.indexOf('?') > -1) {
						var $new_url_min_price = updateQueryStringParameter($old_url, 'min_price', $min_price),
							$new_url_max_price = updateQueryStringParameter($new_url_min_price, 'max_price', $max_price),
							$url = $new_url_max_price;
					} else {
						var $url = $old_url + '?min_price=' + $min_price + '&max_price=' + $max_price;
					}

				} else if ($target.is('.nice-select.orderby ul li')) {

					$hasBeenClicked = 'sort';
					var $orderby = $(this).data("value");
					if ($old_url.indexOf('?') > -1) {
						var $url = updateQueryStringParameter($old_url, 'orderby', $orderby);
					} else {
						var $url = $old_url + '?orderby=' + $orderby;
					}

				} else if ($target.is('.widget_layered_nav .wc-layered-nav-term a')) {

					$hasBeenClicked = 'color';
					var $current_color = $(this).attr("name");

					var $url = $this.attr('href');

				} else if ($target.is('.widget_product_tag_cloud .tagcloud a')) {

					$hasBeenClicked = 'tag';

					// Get URL for ajax
					if ($old_url.indexOf('?') > -1) {
						$url = $this.attr('href') + '?' + $query_url;
					} else {
						var $url = $this.attr('href');
					}

				} else if ($target.is('.woocommerce-pagination .page-numbers li a')) {

					$hasBeenClicked = 'pagination';

					// Get URL for ajax
					var $page_number = $(this).text();
					if ($(this).hasClass('next') || $(this).hasClass('prev')) {
						var $url = $(this).attr('href');
					} else {
						if ($old_url.indexOf('?') > -1) {
							var $url = $page_url + 'page/' + $page_number + '/?' + $query_url;
						} else {
							var $new_url = $old_url.split('page')[0],
								$url = $new_url + 'page/' + $page_number;
						}
					}
				}
				// -> start ajax loading

				// add products preloader
				$wn_woo_wrap.prepend('<div class="wn-products-overlay"><div class="wn-preloader"><span class="wn-preloader-square"></span><span class="wn-preloader-square"></span><span class="wn-preloader-square"></span></div></div>');

				// -> fetch ajax
				$.ajax({
					type: "POST",
					url: $url,
					dataType: 'html',
					cache: false,
					headers: {
						'cache-control': 'no-cache'
					},
					data: {
						action: 'deep_woo_get_ajax_info',
						url: $url,
						hasBeenClicked: $hasBeenClicked
					},
					success: function (data) {
						$('#wn-woo-wrap').html($(data).find('#wn-woo-wrap').html());
						run_document_ready_and_after_ajax();
						list_grid_shop_ajax();
						run_price_filter_after_ajax();
						add_to_wishlist();
					},
					complete: function (data) {
						deep_jquery_woocommerce();
						if ($('body').find('.wn-shop-products-shortocde').length >= 1) {
							$('body').find('.wn-shop-products-shortocde').find('.wn-woo-sidebar').remove();
							$('body').find('.wn-shop-products-shortocde').find('.wn-woo-main').removeClass('wn-woo-has-sidebar');
						}
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {}
				});

				// -> end ajax loading
				$('.wn-woo-wrap').find('selector').show();

			});

		})(); // end ajax filters


		// special offer
		(function () {
			jQuery(".sp-offer-gallery").owlCarousel({
				items: 1,
				itemsDesktop: [1200, 1], // 1 items between 1200px and 961px
				itemsDesktopSmall: [960, 1], // 1 betweem 960px and 480px
				itemsMobile: [768, 1], // 1 items between 768px and 0
				autoPlay: true,
				pagination: true,
				navigationText: ["", ""],
			});
		})();



		//Start Single Product

		// Next and Prev Post
		(function () {	
			$('.wn-prev-product').on('mouseenter', function(){
				$('.deep-woo-prev-product-post').show();
			})
			.on('mouseleave', function(){
				$('.deep-woo-prev-product-post').hide();
			});			

			$('.wn-next-product').on('mouseenter', function(){
				$('.deep-woo-next-product-post').show();
			})
			.on('mouseleave', function(){
				$('.deep-woo-next-product-post').hide();
			});

			$('.deep-woo-prev-product-detail-price ins .woocommerce-Price-amount').addClass('colorf');
			$('.deep-woo-next-product-detail-price ins .woocommerce-Price-amount').addClass('colorf');

		})();

		// Single Product Slider
		(function () {
			if ($.fn.slick) {
				$('.single-product-wrap .deep-woo-product-main-thumbs').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: true,
					fade: true,
					asNavFor: '.deep-woo-product-thumbs'
				});
				$('.deep-woo-product-thumbs').slick({
					slidesToShow: 5,
					slidesToScroll: 1,
					asNavFor: '.deep-woo-product-main-thumbs',
					arrows: true,
					vertical: true,
				});
			}
		})();

		if ($.fn.slick) {
			$('#yith-quick-view-modal .deep-woo-product-main-thumbs').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				infinite: true,
			});
		}

		(function () {
			$('.wn-popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
				disableOn: 700,
				type: 'iframe',
				mainClass: 'my-mfp-zoom-in',
				removalDelay: 100,
				preloader: false,
				fixedContentPos: false
			});
		})();


		if ($('.woocommerce-Tabs-panel p.comment-form-author input').val() !== '') {
			$('.woocommerce-Tabs-panel p.comment-form-author').addClass('wn-active');
		}
		if ($('.woocommerce-Tabs-panel p.comment-form-email input').val() !== '') {
			$('.woocommerce-Tabs-panel p.comment-form-email').addClass('wn-active');
		}

		(function () {
			$(".deep-woo-related-carousel-wrap").owlCarousel({
				items: 5,
				autoPlay: true,
				pagination: true,
				dots: true,
				navigationText: ["", ""],
				margin: 30,
				responsive: {
					0: {
						items: 1,
					},
					600: {
						items: 3,
					},
					960: {
						items: 4,
					},
					1400: {
						items: 5,
					}
				}
			});
		})();

		//End Single Product


		// View cart
		(function () {

			$('.added_to_cart.wc-backward.button, .woocommerce button,.wc-forward.button').addClass('colorf square').wrapInner('<span></span>');

			// run after woocommerce ajax
			$(document.body).on('updated_cart_totals', function () {
				$('.added_to_cart.wc-backward.button, .wc-forward.button, .woocommerce button ').addClass('colorf square').wrapInner('<span></span>');
			});

			// Manually apply cpoupon
			$('.wn-coupon-submit .button').on('click', function (event) {
				event.preventDefault();

				$('#coupon_code').val($('.wn-submit').val()); // copy our copun to their copun

				// triggare thi coupon button
				$('input[name=apply_coupon]').trigger('click');

			});

		})();

		// quantity change style
		if (!String.prototype.getDecimals) {
			String.prototype.getDecimals = function () {
				var num = this,
					match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
				if (!match) {
					return 0;
				}
				return Math.max(0, (match[1] ? match[1].length : 0) - (match[1] ? +match[1] : 0));
			}
		}

		function wcqi_refresh_quantity_increments() {
			$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<i class="ti-angle-down minus hcolorf"></i>').prepend('<i class="ti-angle-up plus hcolorf"></i>');
		}

		$(document).on('updated_wc_div', function () {
			wcqi_refresh_quantity_increments();
		});

		$(document).on('click', '.plus, .minus', function () {
			// Get values
			var $qty = $(this).closest('.quantity').find('.qty'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

			// Format values
			if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
			if (max === '' || max === 'NaN') max = '';
			if (min === '' || min === 'NaN') min = 0;
			if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

			// Change the value
			if ($(this).is('.plus')) {
				if (max && (currentVal >= max)) {
					$qty.val(max);
				} else {
					$qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
				}
			} else {
				if (min && (currentVal <= min)) {
					$qty.val(min);
				} else if (currentVal > 0) {
					$qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
				}
			}
			// Trigger change event
			$qty.trigger('change');
		});

		wcqi_refresh_quantity_increments();
	});

	// Checkout
	$(document).on('focus', 'a.shipping-calculator-button', function () {
		$(this).toggleClass('open');
		$('.wn-shipping-toggle').toggleClass('open');
	});
	$('.form-row input , .form-row textarea').on('focus', function () {
		$(this).closest('.form-row').find('label').css('opacity', '0');
		$(this).addClass('wn-disable');
	});
	$('.form-row input , .form-row textarea').each(function () {
		if ($(this).val() == '') {
			$(this).closest('.form-row').find('label').css('opacity', '1');
			$(this).removeClass('wn-disable');
		} else {
			$(this).closest('.form-row').find('label').css('opacity', '0');
			$(this).addClass('wn-disable');
		}
	});
	$('.form-row input, .form-row textarea').on('focusout', function () {
		if ($(this).val() == '') {
			$(this).closest('.form-row').find('label').css('opacity', '1');
			$(this).removeClass('wn-disable');
		} else {
			$(this).closest('.form-row').find('label').css('opacity', '0');
			$(this).addClass('wn-disable');
		}
	});
	$('#ship-to-different-address-checkbox[checked="checked"]').closest('#ship-to-different-address').addClass('wn-checked');

	$('.checkbox').on('click', function () {
		var $this = $(this).parent('#ship-to-different-address');
		if (!$this.hasClass('wn-checked')) {
			setTimeout(function () {
				$this.addClass('wn-checked');
			}, 1);
		} else {
			setTimeout(function () {
				$this.removeClass('wn-checked');
			}, 1);
		}
	});

	//Compare sticky
	$('.compare-sticky .wn-product .remove a').on('click', function () {
		var prod_id = $(this).parents('.wn-product').data('product_id');
		$('.wn-product[data-product_id = "' + prod_id + '"]').delay(2200).fadeOut(0, function () {
			$(this).remove();
		});
	});

	$('.remove a').on('click', function (event) {

		event.preventDefault();
		var button = $(this),

			data = {
				action: yith_woocompare.actionremove,
				id: button.data('product_id'),
				context: 'frontend'
			},

			product_cell = $('td.product_' + data.id + ', th.product_' + data.id);

		// add ajax loader
		if (typeof $.fn.block != 'undefined') {
			button.block({
				message: null,
				overlayCSS: {
					background: '#fff url(' + yith_woocompare.loader + ') no-repeat center',
					backgroundSize: '16px 16px',
					opacity: 0.6
				}
			});
		}
		$.ajax({
			type: 'post',
			url: yith_woocompare.ajaxurl.toString().replace('%%endpoint%%', yith_woocompare.actionremove),
			data: data,
			dataType: 'html',
			success: function (response) {

				// in compare table
				var table = $(response).filter('table.compare-list');
				$('body > table.compare-list').replaceWith(table);

				$('.compare[data-product_id="' + button.data('product_id') + '"]', window.parent.document).removeClass('added').html(yith_woocompare.button_text);

				//Compare sticky
				var prod_id = button.data('product_id');
				$('.compare-sticky .wn-product[data-product_id = "' + prod_id + '"]').fadeOut(400, function () {
					$(this).remove();
				});

				// removed trigger
				$(window).trigger('yith_woocompare_product_removed');
			}
		});
	});

	(function () {
		var popuped = false;
		$(window).on('resize scroll', function () {
			if (popuped == true) {
				return
			}

			if ($(window).scrollTop() >= '400') {
				$('.compare-sticky').slideDown(300);

			}
			if ($(window).scrollTop() <= '399') {
				$('.compare-sticky').slideUp(300);
			}
		});
	})();

	function remove_compare_preload() {
		$('.wn-compare').find('.wrap-preloader').remove();
		$('.compare-alert').remove();
	}

	(function () {
		var compare_wrap = '.remove',
			compare_item = $(compare_wrap).find('td');
		if (compare_item.length > 3) {
			$(compare_wrap).find('td:last-child a').trigger('click');
			setTimeout(remove_compare_preload, 3000);
		}

	})();

	// Best sellers
	(function () {
		var best_seller_wrapper = $('.yith-wcbsl-bestsellers-wrapper');
		best_seller_wrapper.removeClass('yith-wcbsl-bestsellers-wrapper').addClass('yith-deep-bestsellers-wrapper');
		best_seller_wrapper.find('.yith-wcbsl-bestseller-wrapper').removeClass('yith-wcbsl-bestseller-wrapper').addClass('yith-deep-bestseller-wrapper');
		best_seller_wrapper.find('.yith-wcbsl-bestseller-container').removeClass('yith-wcbsl-bestseller-container').addClass('yith-deep-bestseller-container');
		best_seller_wrapper.find('.yith-wcbsl-bestseller-position').removeClass('yith-wcbsl-bestseller-position').addClass('yith-deep-bestseller-position');
		best_seller_wrapper.find('.yith-wcbsl-bestseller-thumb-wrapper').removeClass('yith-wcbsl-bestseller-thumb-wrapper').addClass('yith-deep-bestseller-thumb-wrapper');
		best_seller_wrapper.find('.yith-wcbsl-bestseller-content-wrapper').removeClass('yith-wcbsl-bestseller-content-wrapper').addClass('yith-deep-bestseller-content-wrapper');
		best_seller_wrapper.show();;
	})();


	// login and register 
	$('.woocommerce-account .woocommerce-Button').addClass('colorb');
	$('.wn-woo-login .button').on('click', function (event) {
		event.preventDefault();
	});
	$('#customer_login .u-column2.col-2').css('display', 'none');
	$('.wn-woo-login .btn-login').css('display', 'none');
	$('.wn-woo-login .btn-register, .wn-woo-login .btn-login').on('click', function () {
		$('#customer_login .u-column1.col-1').slideToggle(400).siblings('.u-column2.col-2').slideToggle(400);
		$(this).fadeOut(0).siblings().fadeIn(0);
	});

	/*List and Grid Switcher after run ajax*/
	function list_grid_shop_ajax() {
		var $woo_main = $('.post-type-archive-product .wn-woo-main'),
			current_woo_skin_name = $woo_main.attr('data-woo-skin');
		$woo_main.find('.product.type-product').removeClass('type-grid').removeClass('type-list').addClass('type-' + current_woo_skin_name);
		$woo_main.find('.wn-woo-skin').hide();
		$woo_main.find('.wn-woo-skin.wn-woo-products-' + current_woo_skin_name).show();
		$woo_main.find('.wn-woo-skin-switcher').find('span').removeClass('wn-active');
		$woo_main.find('.wn-woo-skin-switcher').find('span.wn-' + current_woo_skin_name + '-view-icon').addClass('wn-active');
	}

	function deep_time_out() {

		if ($('input#username:-webkit-autofill').val()) {
			$('input:-webkit-autofill').trigger('click');
		}

		if ($('#billing_state').find(":selected").text() == 'Select an option…') {
			$('label[for="billing_state"]').css('z-index', '2');
		}

		$('.select2').on('focusout', function () {
			if ($('#billing_state').find(":selected").text() != 'Select an option…') {
				$('label[for="billing_state"]').css('z-index', '0');
			}
		});

	}
	setTimeout(deep_time_out, 1);

	// Remove cart ajax
	$(document).on('click', '.mini_cart_item .remove', function (event) {
		var $this = $(this),
			$preloader = $('<div class="wn-circle-side-wrap"><div data-loader="wn-circle-side"></div></div>'),
			cartproductid = $this.data('product_id');

		event.preventDefault();
		$preloader.appendTo($(this).closest('.cart_list'));
		$.ajax({
			url: woocommerce_params.ajax_url,
			type: 'POST',
			dataType: 'html',
			data: {
				action: 'deep_woo_ajax_update_cart',
				cart_product_id: cartproductid,
			},
			success: function (data) {
				$('.widget_shopping_cart_content').html(data);
				$preloader.remove();
				setTimeout(function () {
					$this.find('.wn-ajax-error').remove();
				}, 400);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {}
		});
	});

	/*  Catalog Mode */
	$('li.product.type-product').find('.wc_email_inquiry_button_container').each(function () {
		var button_grid = $(this).clone();
		var button_list = $(this).clone();
		$(this).closest('.product').find('.wn-woo-skin.wn-woo-products-grid').find('.wn-woo-thumbnail-hover').find('.wn-woo-btn').append(button_grid);
		$(this).closest('.product').find('.wn-woo-skin.wn-woo-products-list').find('.type-list-readmore').append(button_list);
		$(this).closest('.product').find('.wn-woo-skin.wn-woo-products-grid').find('.wn-woo-thumbnail-hover').find('.wn-woo-btn').find('.sl-basket').remove();
		$(this).closest('.product').find('.wn-woo-skin.wn-woo-products-grid').find('.price').remove();
		$(this).closest('.product').find('.wn-woo-skin.wn-woo-products-list').find('.price').remove();
		$(this).remove();
	});

	// Single Gallery
	$('.single-product').find('.woocommerce-product-gallery').addClass('col-md-6');

})(jQuery, window, document);