(function($) {
    'use strict';

    $('.hamburger').on('click', function() {
        $(this).toggleClass('is-active');
        $(this).next().toggleClass('nav-show')
    });	
	    /*--
    	Mobile Menu
    ------------------------*/
    $('.mobile-menu nav').meanmenu({
        meanScreenWidth: "990",
        meanMenuContainer: ".mobile-menu",
        onePage: true,
    });
	
	/*---------------------
	Nivo Slider active js 
	--------------------- */
	$('#mainSlider_id2').nivoSlider({
		directionNav: true,
		animSpeed: 1000,
		slices: 18,
		pauseTime: 15000,
		pauseOnHover: false,
		controlNav: false,
		prevText: '<i class="fas fa-long-arrow-alt-left nivo-prev-icon"></i>',
		nextText: '<i class="fas fa-long-arrow-alt-right nivo-next-icon"></i>'					
	});
				

			/*---------------------
			 HOME-2countdown
			--------------------- */
				$('[data-countdown]').each(function() {
				  var $this = $(this), finalDate = $(this).data('countdown');
				  $this.countdown(finalDate, function(event) {
					$this.html(event.strftime('<span class="cdowns days"><span class="time-counts">%-D</span> <p>Days</p></span> <span class="cdowns hour"><span class="time-counts">%-H</span> <p>Hour</p></span> <span class="cdowns minutes"><span class="time-counts">%M</span> <p>Min</p></span> <span class="cdowns second"> <span><span class="time-counts">%S</span> <p>Sec</p></span>'));
				  });
				});				
				
				
				
				
				
				
				
				
				
/* Portfolio Isotope  */

				$('.em_load').imagesLoaded(function() {

					if ($.fn.isotope) {

						var $portfolio = $('.em_load');

						$portfolio.isotope({

							itemSelector: '.grid-item',

							filter: '*',

							resizesContainer: true,

							layoutMode: 'masonry',

							transitionDuration: '0.8s'

						});


						$('.filter_menu li').on('click', function() {

							$('.filter_menu li').removeClass('current_menu_item');

							$(this).addClass('current_menu_item');

							var selector = $(this).attr('data-filter');

							$portfolio.isotope({

								filter: selector,

							});

						});

					};

				});

				/*--------------------------
					portfolio gallery post
				---------------------------- */
				$('.portfolio_gallery_post').owlCarousel({
					nav: true,
					dots: false,
					navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
					responsive: {
						0: {
							items: 1
						},
						768: {
							items: 1
						},
						992: {
							items: 1
						},
						1920: {
							items: 1
						}
					}
				})							
	
	
	
	
	
		/*--------------------------
					TESTIMONIAL CONTEXT
				---------------------------- */
	
	if ($('.witr_testiSlider').length > 0) {
							$('.witr_testiSlider').slick({
								slidesToShow: 1,
								slidesToScroll: 1,
								arrows: false,
								fade: true,
								asNavFor: '.wirt_TraSlider',
								autoplay: true,
							});

							$('.wirt_TraSlider').slick({
								slidesToShow: 1,
								slidesToScroll: 1,
								asNavFor: '.witr_testiSlider',
								arrows: true,
								dots: false,
								autoplaySpeed: 2000,
								speed: 700,								
								centerMode: true,
								centerPadding: '0',
								focusOnSelect: true,
								responsive: [
									{
										breakpoint: 1200,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1,
										}
									},
									{
										breakpoint: 992,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1,
										}
									},
									{
										breakpoint: 767,
										settings: {
											slidesToShow: 1,
											slidesToScroll: 1,
										}
									}
								]								
							});
						}	
	
	
	
	/*====== foter section =======*/
	
	
	
	window.mc4wp = window.mc4wp || {
		listeners: [],
		forms: {
			on: function(evt, cb) {
				window.mc4wp.listeners.push(
					{
						event   : evt,
						callback: cb
					}
				);
			}
		}
	}
	
	
	
	
	
	
	
	/*====== Screenshots Slide Slick =======*/
	$('.imagess_id1').slick({	

				infinite: true,
				autoplay: true,
				autoplaySpeed: 3000,
				speed: 700,					
				slidesToShow: 1,
				slidesToScroll: 1,
				centerMode: true,
				centerPadding: '0',					
				arrows: true,
				dots: false,
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
				},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
				},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
				]
			});

	
	
	
	var witr_cp = $('.witr_circle_id1');

			  witr_cp.circleProgress({
				startAngle: -Math.PI / 4 * 3,
				value: 0.9,
				size: 100,
				lineCap: 'square',
				fill: {  gradient: ["#FF5E14", "#FF5E14"]}
			  });
	
	
	
	/*====== Screenshots Slide Slick =======*/
			$('.imagess_id2').slick({	

				infinite: true,
				autoplay: true,
				autoplaySpeed: 1000,
				speed: 700,					
				slidesToShow: 5,
				slidesToScroll: 1,
				centerMode: true,
				centerPadding: '0',					
				arrows: true,
				dots: false,
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 5,
							slidesToScroll: 1,
						}
				},
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
						}
				},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
				]
			});
	
	

    // top quearys menu 
    var emsmenu = $(".em-quearys-menu i.t-quearys");
    var emscmenu = $(".em-quearys-menu i.t-close");
    var emsinner = $(".em-quearys-inner");
    emsmenu.on('click', function() {
        emsinner.addClass('em-s-open');
        $(this).addClass('em-s-hiddens');
        emscmenu.removeClass('em-s-hidden');
    });
    emscmenu.on('click', function() {
        emsinner.removeClass('em-s-open');
        $(this).addClass('em-s-hidden');
        emsmenu.removeClass('em-s-hidden');
    });

	// 6.HOME 2 HERO CAROUSEL
    $('.em-slick-slider-new').slick({
        dots: true,
        speed: 300,
        arrows: true,
        autoplay: true,
        fade: true,
        autoplaySpeed: 6000,
        responsive: [{
            breakpoint: 769,
            settings: {
                arrows: false,
            }
        }]
    });


	if ($('.headrooma').length != 0) {
        // grab an element
        var myElement = document.querySelector(".headrooma");
        // construct an instance of Headroom, passing the element
        var headroom = new Headroom(myElement);
        // initialise
        headroom.init();
    }
	
    /*---------------------
    WOW active js 
    --------------------- */
    new WOW().init();
    /*--------------------------
     scrollUp
    ---------------------------- */
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    // Venubox

    $('.venobox').venobox({

        numeratio: true,

        infinigall: true

    });
		
	    /*--
    	One Page Nav
    ----------------------------------- */
     var top_offset = $('.one_page').height() +0;
    $('.one_page .context_menu .nav_scroll').onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 1000,
         scrollOffset: top_offset,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'swing',
    });

    $(".nav_scroll li:first-child").addClass("current");
    /* sticky nav 1 */
    $('.one_page').scrollToFixed({
        preFixed: function() {
            $(this).find('.scroll_fixed').addClass('prefix');
        },
        postFixed: function() {
            $(this).find('.scroll_fixed').addClass('postfix').removeClass('prefix');
        }
    });	
		
	/* sticky nav 2 */
    var headers1 = $('.trp_nav_area');
    $(window).on('scroll', function() {

        if ($(window).scrollTop() > 200) {
            headers1.addClass('hbg2');
        } else {
            headers1.removeClass('hbg2');
        }		

    });		
	
	$('.counter').counterUp({
		delay: 10,
		time: 1000
	});	

    /*--------------------------
    	blog messonary
    ---------------------------- */
    $('.bgimgload').imagesLoaded(function() {
        if ($.fn.isotope) {
            var $blogmassonary = $('.blog-messonary');
            $blogmassonary.isotope({
                itemSelector: '.grid-item',
                filter: '*',
                resizesContainer: true,
                layoutMode: 'masonry',
                transitionDuration: '0.8s'
            });

        };
    });

    /*--------------------------
    	single gallery
    ---------------------------- */
    $('.single_gallery').owlCarousel({
        nav: true,
        dots: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1920: {
                items: 1
            }
        }
    })
    /*--------------------------
    	portfolio gallery post
    ---------------------------- */
    $('.portfolio_gallery_post').owlCarousel({
        nav: true,
		dots: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1920: {
                items: 1
            }
        }
    })
    /*--------------------
    	woo active 
    -----------------------------------*/

    $('.wp_related').owlCarousel({
        loop: false,
        autoplay: false,
        autoplayTimeout: 10000,
        dots: false,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            },
            1300: {
                items: 3
            }
        }
    })
	    $('.witr_cross_car').owlCarousel({
        loop: false,
        autoplay: false,
        autoplayTimeout: 10000,
        dots: false,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1000: {
                items: 1
            },
            1920: {
                items: 2
            }
        }
    })
	
	// Mouse Direction Hover Iffect
	$('.single_protfolio').directionalHover();

	$('.single_protfolio').directionalHover({
		// CSS class for the overlay
		overlay: "em_port_content",
		// Linear or swing
		easing: "swing",
		speed: 50
	});	
		
	/* Bootstrap Accordion  */
	$('.faq-part .card').each(function () {
		var $this = $(this);
		$this.on('click', function (e) {
			var has = $this.hasClass('active');
			$('.faq-part .card').removeClass('active show');
			if (has) {
				$this.removeClass('active show');
			} else {
				$this.addClass('active show');
			}
		});
	});
	/* Nice select  */
	$('select.orderby').niceSelect();
    if ($('.service_slider').length > 0) {
        $('.service_slider').slick({
            autoplay: false,
            autoplaySpeed: 2000,
            speed: 300,
            slidesToShow: 5,
            dots: true,
            arrows: false,
        });
    }

	
	
	
	
	
	
			$('.carso_id1').slick({
							infinite: true,
							autoplay: true,
							autoplaySpeed: 30000,
							speed: 700,					
							slidesToShow: 2,
							slidesToScroll: 1,
							arrows: true,
							dots: false,
							responsive: [
								{
									breakpoint: 1200,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
									}
							},
								{
									breakpoint: 992,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
									}
							},
								{
									breakpoint: 767,
									settings: {
										slidesToShow: 1,
										slidesToScroll: 1,
									}
							}
							// You can unslick at a given breakpoint now by adding:
							// settings: "unslick"
							// instead of a settings object
							]
						});
	
	
	
	
	
				//<!--======SCREENSHOTS PART ENDS ======-->			
						


					//====== 1 mobile Slide Slick
					$('.witrslk_id1').slick({
						infinite: true,
						autoplay: true,
						autoplaySpeed: 3000,
						speed: 700,					
						slidesToShow: 5,
						slidesToScroll: 1,
						centerMode: true,
						centerPadding: '0',					
						arrows: true,
						dots: false,
						responsive: [
							{
								breakpoint: 1200,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
								}
						},
							{
								breakpoint: 992,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
								}
						},
							{
								breakpoint: 768,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
								}
						}
						// You can unslick at a given breakpoint now by adding:
						// settings: "unslick"
						// instead of a settings object
						]
					});
			

				//====== Our News
				$('.blog_active').slick({
					infinite: true,
					autoplay: true,
					autoplaySpeed: 3000,
					speed: 700,					
					slidesToShow: 3,
					slidesToScroll: 1,
					arrows: true,
					dots: false,
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 1,
							}
					},
						{
							breakpoint: 992,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1,
							}
					},
						{
							breakpoint: 767,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
							}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
					]
				});

					//home2 TESTIMONIAL CONTEXT
					$('.testomonial_active').slick({
							infinite: true,
							autoplay: true,
							autoplaySpeed: 30000,
							speed: 700,					
							slidesToShow: 2,
							slidesToScroll: 1,
							arrows: true,
							dots: false,
							responsive: [
								{
									breakpoint: 1200,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
									}
							},
								{
									breakpoint: 992,
									settings: {
										slidesToShow: 2,
										slidesToScroll: 1,
									}
							},
								{
									breakpoint: 767,
									settings: {
										slidesToShow: 1,
										slidesToScroll: 1,
									}
							}
							// You can unslick at a given breakpoint now by adding:
							// settings: "unslick"
							// instead of a settings object
							]
						});
					
					
					
					

})(jQuery);