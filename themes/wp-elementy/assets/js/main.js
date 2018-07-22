jQuery(document).ready(function($) {
	"use strict";

	/* window */
	var window_width, window_height, scroll_top;

	/* admin bar */
	var adminbar = $('#wpadminbar');
	var adminbar_height = 0;

	/* header menu */
	var header = $('#cshero-header');
	var header_top = 0;

	var trigger_phone = false;

	/* scroll status */
	var scroll_status = '';

	$('.cms-blog-item, .cms-blog-single').fitVids();
	/**
	 * check iframe ready to relayout masonry, which is get problem with iframe.
	 * @author LuanNguyen
	 * @since 1.0.0
	 * */
	$('iframe').load(function() {
		var checkFrame = setInterval(function(){
			if($('.cms-grid-masonry').length && $('.shuffle').length){
				$('.cms-grid-masonry').shuffle('layout');
				clearInterval(checkFrame);
			}
		}, 1000);
	});

	//pie char
	$('.vc_pie_chart').each(function() {
		$(this).waypoint(
			function() {
				$(this).circliful();
			}, {
				offset : '95%',
				triggerOnce : true
		});	
	});

	/* Offset shortcode nav */
	$('.menu li a', '.shortcode-sidebar-area').addClass('is-one-page');
	var offsetFooter = $('.elementy-footer-wrap').height() + 30;
	jQuery('.menu-typography-demo-container').parent().affix({
		offset: { 
			top: 380,
			bottom: offsetFooter		
		}
	});
	jQuery('.menu-shortcodes-demo-container').parent().affix({
		offset: { top: 380,
			bottom: offsetFooter		
		}
	});

	/* Header fixed */
	jQuery('#cshero-header.header-sticky, #cshero-header.opt-page-sticky').affix({
		offset: { top: 1, }
	});	

	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover()
	//Woo button
    $('input.minus').click(function(){
        $(this).parent().find('input.input-text').get(0).stepDown();
    });
    $('input.plus').click(function(){
        $(this).parent().find('input.input-text').get(0).stepUp();
    });

	/**
	* Fit videos ajax Complete
	*/
	$(document).ajaxComplete(function(event, xhr, settings){
		$('.cms-blog-item').fitVids();
		cms_image_carousel();
		//jQuery('audio,video').mediaelementplayer();

		//remove view cart after 5s
		if(settings.url.indexOf('wc-ajax=add_to_cart') > 0){
			setTimeout(function(){
				$('.added_to_cart').hide();
			},5000);
		}

		wp_elementy_countdown();
		removeCartItem();
	});

	/**
	 * window load event.
	 * 
	 * Bind an event handler to the "load" JavaScript event.
	 * @author Fox
	 */
	$(window).on('load', function() {
		/** current scroll */
		scroll_top = $(window).scrollTop();

		/** current window width */
		window_width = $(window).width();

		/** current window height */
		window_height = $(window).height();

		/* get admin bar height */
		adminbar_height = adminbar.length > 0 ? adminbar.outerHeight(true) : 0 ;

		/* get top header menu */
		header_top = header.length > 0 ? header.offset().top - adminbar_height : 0 ;
		cms_image_carousel();
		cms_lightbox_popup();
		if(trigger_phone == false) {
			portfolio_filter_onphone();
		}

		if ( $('.wow').length ) {
		    initWow(); 
		};

		/* Bs init */
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		set_height_for_bgimage();
		setTimeout(function(){ wp_elementy_countdown(); }, 1000);
		cms_arrow_down();
		cms_back_to_top();
		/* page loading. */
		cms_page_loading();
		cms_mp4video_bg();
		add_placeholder();
		cms_topbar_indent();
		removeCartItem();
	});

	/**
	 * reload event.
	 * 
	 * Bind an event handler to the "navigate".
	 */
	window.onbeforeunload = function(){
		cms_page_loading(1);
	}
	
	/**
	 * resize event.
	 * 
	 * Bind an event handler to the "resize" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).on('resize', function(event, ui) {
		/**
		 * check iframe ready to relayout masonry, which is get problem with iframe.
		 * @author LuanNguyen
		 * @since 1.0.0
		 * */
		$('iframe').load(function(){
			if($('.cms-grid-masonry').length && $('.shuffle').length){
				$('.cms-grid-masonry').shuffle('layout');
			}
		})

		/** current window width */
		window_width = $(event.target).width();

		/** current window height */
		window_height = $(window).height();

		/** current scroll */
		scroll_top = $(window).scrollTop();

		/* check sticky menu. */
		/*cms_stiky_menu();*/
		if(trigger_phone == false) {
			portfolio_filter_onphone();
		}
		set_height_for_bgimage();
		cms_topbar_indent();
	});
	
	/**
	 * scroll event.
	 * 
	 * Bind an event handler to the "scroll" JavaScript event, or trigger that event on an element.
	 * @author Fox
	 */
	$(window).on('scroll', function() {
		/** current scroll */
		scroll_top = $(window).scrollTop();

		/* check sticky menu. */
		/*cms_stiky_menu();*/

		setTimeout(function() {
			if (jQuery('.cshero-main-header').hasClass('affix')) {
				jQuery('.indent-header').addClass('affix-indent');
			}  else {
				jQuery('.indent-header').removeClass('affix-indent');
			};
		},100);

		cms_back_to_top();
	});

	/**
	 * Stiky menu
	 *
	 * Show or hide sticky menu.
	 * @author Fox
	 * @since 1.0.0
	 */
	function cms_stiky_menu() {
		if (header.hasClass('sticky-desktop') && header_top < scroll_top && window_width > 991) {
			header.addClass('header-fixed');
			$('body').addClass('hd-fixed');
		} else {
			header.removeClass('header-fixed');
			$('body').removeClass('hd-fixed');
		}
	}

	/**
	 * Mobile menu
	 * 
	 * Show or hide mobile menu.
	 * @author Fox
	 * @since 1.0.0
	 */
	
	$('body').on('click', '#cshero-menu-mobile', function(){
		var navigation = $(this).parent().find('#cshero-header-navigation');
		if(!navigation.hasClass('collapse')){
			navigation.addClass('collapse');
		} else {
			navigation.removeClass('collapse');
		}
	});

	/**
	 * One page
	 * 
	 * @author Fox
	 */
	if(CMSOptions.one_page == true){
		$('body').on('click', '.onepage', function () {
			$('#cshero-menu-mobile').removeClass('close-open');
			$('#cshero-header-navigation').removeClass('open-menu');
			$('.cshero-menu-close').removeClass('open');
		});
		
		var one_page_options = {'filter' : '.is-one-page'};
		
		if(CMSOptions.one_page_speed != undefined) one_page_options.speed = parseInt(CMSOptions.one_page_speed);
		if(CMSOptions.one_page_easing != undefined) one_page_options.easing =  CMSOptions.one_page_easing;
		$('#site-navigation, .widget_nav_menu').singlePageNav(one_page_options);
	}

	/**
	 * Custom Owl Carousel
	 * 
	 * @author DuongTung
	 * @since 1.0.0
	 */
	function cms_image_carousel() {
		if ( $('.cms-carousel-wrapper').length ) {
			var data_margin = '';
			$('.cms-carousel-wrapper').each(function(index, el) {
				var id_carousel = $(el).attr('id');
				var wrap = $('#' + id_carousel + ' .cms-owl-carousel');

				var image_carousel_setting = {};
					image_carousel_setting.items = wrap.attr('data-per-view');
					image_carousel_setting.rewind = true;

					var data_margin;
	                if ( undefined != wrap.attr('data-margin') || null != wrap.attr('data-margin') ) {
	                    data_margin = parseInt(wrap.attr('data-margin'));
	                } else {
	                    data_margin = 0;
	                }

					image_carousel_setting.margin = data_margin;
					image_carousel_setting.mouseDrag = true;
					image_carousel_setting.autoplay = (wrap.attr('data-autoplay') === "true");
					image_carousel_setting.autoplaySpeed = 800;
					image_carousel_setting.dots = (wrap.attr('data-pagination') === "true");
					image_carousel_setting.loop = (wrap.attr('data-loop') === "true");
					image_carousel_setting.nav = (wrap.attr('data-nav') === "true");
			        image_carousel_setting.navText = ["<i class='icon icon-arrows-left'></i>", "<i class='icon icon-arrows-right'></i>"];
			        if (wrap.attr('data-per-view') == 5) {
			        	image_carousel_setting.responsive = {
					        1000:{
					            items:5
					        },
					        900:{
					            items:3
					        },
					        470:{
					            items:1
					        },
					        0:{
					            items:1
					        }
					    } 
			        }

			        if (wrap.attr('data-per-view') == 4) {
			        	image_carousel_setting.responsive = {
					        1000:{
					            items:4
					        },
					        900:{
					            items:3
					        },
					        470:{
					            items:1
					        },
					        0:{
					            items:1
					        }
					    } 
			        }

			        if (wrap.attr('data-per-view') == 3) {
			        	image_carousel_setting.responsive = {
					        1000:{
					            items:3
					        },
					        900:{
					            items:3
					        },
					        470:{
					            items:1
					        },
					        0:{
					            items:1
					        }
					    } 
			        }
				//Play
				wrap.owlCarousel(image_carousel_setting);
			});
		}
	}

	/**
	 * Init Wow
	 * 
	 * @author DuongTung
	 * @since 1.0.0
	 */
	function initWow(){
		var wow = new WOW( { mobile: false, } );
		wow.init();
	}

	/* CMS Countdown. */
	var _e_countdown = [];
	function wp_elementy_countdown() {
		"use strict";
		$('.cms-countdown').each(function () {
			var event_date = $(this).find('.cms-countdown-bar');
			var data_count = event_date.data('count');
			var server_offset = event_date.data('timezone');
			/* get local time zone */
			var offset = (new Date()).getTimezoneOffset();
			offset = (- offset / 60) - server_offset;
			
			if(data_count != undefined){
				var data_label = event_date.attr('data-label');
				
				if(data_label != undefined && data_label != ''){
					data_label = data_label.split(',')
				} else {
					data_label = ['days','hours','minutes','seconds'];
				}
				
				data_count = data_count.split(',')
				
				var austDay = new Date(data_count[0],parseInt(data_count[1]) - 1,data_count[2],parseInt(data_count[3]) + offset,data_count[4],data_count[5]);
				
				_e_countdown.push(event_date.countdown({
					until: austDay,
					layout:'<div class="clearfix"> <div class="countdown-item-container"> <span class="countdown-amount">{dn}</span> <span class="countdown-period">'+data_label[0]+'</span> </div> <div class="countdown-item-container"> <span class="countdown-amount">{hn}</span> <span class="countdown-period">'+data_label[1]+'</span> </div> <div class="countdown-item-container"> <span class="countdown-amount">{mn}</span> <span class="countdown-period">'+data_label[2]+'</span> </div> <div class="countdown-item-container"> <span class="countdown-amount">{sn}</span> <span class="countdown-period">'+data_label[3]+'</span> </div> </div>'
				}));
			}
		});
	}

	/**
	 * LightBox
	 * 
	 * @author DuongTung
	 * @since 1.0.0
	 */
	function cms_lightbox_popup() {
		$('.cms-lightbox').magnificPopup({
			// delegate: 'a',
			type: 'image',
			mainClass: 'mfp-3d-unfold',
			removalDelay: 500, //delay removal by X to allow out-animation
			callbacks: {
				beforeOpen: function() {
				// just a hack that adds mfp-anim class to markup 
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				// this.st.mainClass = this.st.el.attr('data-effect');
				}
			},
			closeOnContentClick: true,
			midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
		});

		/* gallery */
		$('.cms-popup-gallery').magnificPopup({
			delegate: '.lightbox',
			type: 'image',
			tLoading: 'Loading image #%curr%...',
			mainClass: 'mfp-3d-unfold',
			removalDelay: 500, //delay removal by X to allow out-animation
			callbacks: {
				beforeOpen: function() {
					// just a hack that adds mfp-anim class to markup 
					this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
					// this.st.mainClass = this.st.el.attr('data-effect');
				}
			},
			gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				/*titleSrc: function(item) {
				return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
				}*/
			}
		});

		/* Carousel */
		if ($('.carousel-with-lightbox').length) {
			$('.carousel-with-lightbox').each(function (i, el) {
				var id = $(el).attr('id');

				$(el).find('.owl-item').not('.cloned').addClass('owl-item-popup');

				$('#'+id).magnificPopup({
					delegate: '.owl-item-popup a, .woo-lightbox',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					mainClass: 'mfp-3d-unfold',
					removalDelay: 500, //delay removal by X to allow out-animation
					callbacks: {
						beforeOpen: function() {
							// just a hack that adds mfp-anim class to markup 
							this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
							// this.st.mainClass = this.st.el.attr('data-effect');
						}
					},
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						/*titleSrc: function(item) {
						return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
						}*/
					}
				});
			});
		}
		
		$('.cms-video-popup, .cms-lightbox-map').magnificPopup({
			//disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,

			fixedContentPos: false
		});
	}

	//open search form
	var MqL = 1170;
	$('.cd-search-trigger').on('click', function(event) {

		event.preventDefault();
		toggleSearch();
	});

	/**
	 * Toggle Search Style
	 * 
	 * @author DuongTung
	 * @since 1.0.0
	 */
	function toggleSearch(type) {
		if($('.cd-search').hasClass('is-visible')) {
			//close search 
			$('.cd-search').removeClass('is-visible');
			$('.cd-search-trigger').removeClass('search-is-visible');
			$('.cd-overlay').removeClass('search-is-visible');
            $('.icon_cart_wrap').show();
		} else {
			//toggle search visibility
			$('.cd-search').addClass('is-visible');
			$('.cd-search-trigger').addClass('search-is-visible');
			$('.cd-overlay').addClass('search-is-visible');
            $('.icon_cart_wrap').hide();
			if($(window).width() > MqL){
                $('.cms-in-desktop .cd-search').find('.search-head').focus();
            }
		}
	}

	/**
	 * Portfolio Filter on phone
	 * 
	 * @author DuongTung
	 * @since 1.0
	 */
	function portfolio_filter_onphone() {
		trigger_phone = true;
		if ( window_width - 599 <= 0 ) { //On phone
			$('.cms-grid-filter-inphone a').on('click', function(e) {
				var $this = $(this);
				e.preventDefault();
				var wrap = $this.parents('.cms-filter-wrap');
				if ( $('.cms-filter-category', wrap).hasClass('active') ) {
					$('.cms-filter-category', wrap).removeClass('active').slideUp();
				} else {
					$('.cms-filter-category', wrap).addClass('active').slideDown(300);
				}
			});

			$('.cms-filter-category a').on('click', function() {
				var $this = $(this),
					wrap = $this.parents('.cms-filter-wrap');;
				$('.cms-filter-category', wrap).removeClass('active').slideUp();
				$('.cms-grid-filter-inphone a').text($this.text());
			});
		}
	}

	/**
	 * Arrow down
	 * 
	 * @author Duong Tung
	 * @since 1.0.0
	 */
	function cms_arrow_down() {
		var adminbar_height = 0;
		var adminbar = $('body').find('#wpadminbar');
		if(adminbar.length == 1) {
			adminbar_height = parseInt(adminbar.height());
		}

		$('.arrow-in-home a, .btn-slider-scroll').on('click', function(e) {
			var id_scroll = $(this).attr('href');
			/*var sticky_height = $('.header-fixed').height();*/
			
			/*var header_height = CMSOptions.headder_height_sticky;*/

			e.preventDefault();	
			$("html, body").animate({ scrollTop: $(id_scroll).offset().top - adminbar_height }, 800);
		});
	}

	function add_placeholder() {
		var wrap = $('.vc_wp_search.search-in-faq');

		wrap.each(function() {
			$('#s', wrap).attr("placeholder", "Search in our help center");
		});
	}

	/**
	 * Set height shortcode bgimage
	 * 
	 */
	function set_height_for_bgimage() {
		$('.cms-bgimage-wrap .cms-bgimage-inner').each(function() {
			var wrap = $(this);
			var h = wrap.parents('.cms-sameheight').siblings().height();

			/*if ( window_width - 992 >= 0 ) {
				wrap.css('height', h);
			} else {
				wrap.css('height', '');
			}*/
		});
	}

    /**
	 * Back To Top
	 * 
	 * @author Fox
	 * @since 1.0.0
	 */
	$('body').on('click', '#back-to-top', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 1500);
    });
	
	/* Show or hide buttom  */
	function cms_back_to_top() {
		/* back to top */
        if (scroll_top < window_height) {
        	$('#back-to-top').addClass('off').removeClass('on');
        } else {
        	$('#back-to-top').removeClass('off').addClass('on');
        }
	}

	function cms_topbar_indent() {
		if ($('.has-topsidebar').length) {
			var tobar_h = $('.has-topsidebar .topbar-wrap').height();

			$('.has-topsidebar .main-menu-container').css('top', tobar_h);
		}
	}

	function removeCartItem() {
        $('.mini_cart_item a.remove').click(function() {
			$(this).addClass('wc-remove').html('<i class="wc-loading"></i>');
			var product_key = $(this).data('item_key');
	        $.ajax({
	            type: 'POST',
	            dataType: 'json',
	            url: wc_add_to_cart_params.ajax_url,
	            data: { action: "product_remove", 
	                    product_key: product_key
	            },success: function(data){
	                updateCartFragment();
	            }
	        });
	        return false;
		});
    }

    function updateCartFragment() {
        var $fragment_refresh = {
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: { action: 'woocommerce_get_refreshed_fragments' },
            success: function( data ) {console.log(data);
                if ( data && data.fragments ) {          
                    jQuery.each( data.fragments, function( key, value ) {
                        jQuery(key).replaceWith(value);
                    });
                }
            }
        };

        jQuery.ajax( $fragment_refresh );  
    }

	/**
	 * Page Loading.
	 */
	function cms_page_loading($load) {
		switch ($load) {
		case 1:
			$('#loader-overflow').css('display','block')
			break;
		default:
			$('#loader-overflow').css('display','none')
			break;
		}
	}

	/**
	 * 
	 */
	function cms_mp4video_bg() {
		$('.sm-video').each(function(i, el) {
			var data_mp4_name = $(el).attr('data-mp4-name'),
				data_mp4_path = $(el).attr('data-mp4-path');

				console.log(data_mp4_name);
				console.log(data_mp4_path);

			var videobackground = new $.backgroundVideo($(el), {
                "align": "centerXY",
                "width": 1920,
                "height": 1080,
                "path": data_mp4_path,
                "filename": data_mp4_name, // FILE NAME of your video
                "types": ["mp4", "webm"],
                "autoplay": true,
                "loop": true
            });
		});
	}

	/**
	 * Edit the count on the categories widget
	 * @author LuanNguyen
     * @since 1.0.0
     * @param element parent
	 * */

    $.fn.extend({
        cmsReplaceCount: function(is_woo) {
            this.each(function(){
            	if (is_woo == true) {
            		$(this).find('span.count').each(function(){
	                    var count = '<small>' + $(this).text().replace('(','').replace(')','') + '</small>';
	                    $(this).parent().append(count).find('span.count').remove();
	                })	
            	} else {
            		$(this).addClass('cms-custom-widget')
            		$(this).find(' > ul > li').each(function() {
            			var cms_li = $(this);
            			
            			var small = $(this).html().replace('(','<small>').replace(')','</small>');
            			cms_li.html(small);
            		});
            	}
            })
        }
    });
    // replace span.count to small
    $('.product-categories').cmsReplaceCount(true);
    $('.widget_archive, .widget_categories').cmsReplaceCount(false);

});

(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
        var display;
        var no_display;
        $('body').click(function (e) {
            var target = $(e.target);
            if (target.parents('.shopping_cart_dropdown').length == 0 && !target.hasClass('shopping_cart_dropdown')) {
                $('.widget_searchform_content,.shopping_cart_dropdown').removeClass('active').slideUp();
            }
        });
        $('.widget_searchform_content,.shopping_cart_dropdown').click(function (e) {
            e.stopPropagation();
        });
        $('.widget_cart_search_wrap [data-display]').click(function (e) {
            var container = $(this).parents('.widget_cart_search_wrap');
            e.stopPropagation();
            var _this = $(this);
            display = _this.attr('data-display');
            no_display = _this.attr('data-no_display');
            $(display, container).css({
                left: 0
            });
            if ($(display, container).hasClass('active')) {
                $(display, container).removeClass('active').slideUp();
            } else {
                if (display == '.widget_searchform_content') {
                    $(display, container).addClass('active').css('display', 'block');
                    $(no_display, container).removeClass('active').slideUp();    
                }
                $(display, container).addClass('active').slideDown().css('display', 'block');
                $(no_display, container).removeClass('active').slideUp();

                var offset = $(display, container).offset().left + $(display).outerWidth() - $(window).width()
                if (offset > 0) {
                    $(display, container).css({
                        left: 0 - offset
                    });
                } else {
                    $(display, container).css({
                        left: 0
                    });

                }
            }
        });
        $(window).scroll(function () {
            $('.shopping_cart_dropdown').each(function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active').slideUp();
                }
            })
        })
        //Scroll on cart
        setTimeout(function () {
            $('.shopping_cart_dropdown_inner').css({
                maxHeight: '300px',
                overflow: 'hidden'
            }).bind('mousewheel', function (event) {
                event.preventDefault();
                var scrollTop = this.scrollTop;
                this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
            });
        }, 1000);
        
        $('.shopping_cart_dropdown_inner').css({maxHeight:'300px'}).bind('mousewheel', function (event) {
            event.preventDefault();
            var scrollTop = this.scrollTop;
            this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
        });
        
    })
})(jQuery);