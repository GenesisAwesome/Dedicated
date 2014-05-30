jQuery(document).ready(function($) {

	$('.nav-primary .genesis-nav-menu').before('<span class="responsive-navigation"><i class="fa fa-bars"></i> Navigation</span>');
	$('.nav-primary .sub-menu').before( '<span class="responsive-sub-nav"></span>' );

	$('.responsive-navigation, .responsive-sub-nav').click(function(){
		$(this).toggleClass('nav-active').next('.genesis-nav-menu, .sub-menu').slideToggle();
	});

	// Reset Nav
	$(window).resize(function(e) {
		if ( window.innerWidth > 767 ) {
			$('.nav-primary .genesis-nav-menu, .nav-primary .sub-menu').removeAttr('style');
			$('.responsive-navigation, .responsive-sub-nav').removeClass('nav-active');
		}
	});

	$('#dedicated-social a').tipsy({
		gravity : 's',
		fade    : true,
		offset  : 3
	});

	$('.flexslider').flexslider({
		selector       : '.slides > li',
		animation      : 'slide',
		easing         : 'swing',
		direction      : 'horizontal',
		animationLoop  : true,
		smoothHeight   : true,
		startAt        : 0,
		slideshow      : true,
		slideshowSpeed : 7000,
		animationSpeed : 600,
		initDelay      : 0,
		pauseOnAction  : true,
		pauseOnHover   : true
	});

	$('.site-container').fitVids();

	$('.dedicated-thumb a').each(function() {
		$(this).fancybox({
			openEffect  : 'fade',
			closeEffect : 'elastic',
			helpers: {
				title : {
					type : 'float'
				}
			},
			overlay : {
				speedIn : 500,
				opacity : 0.90
			}
		});
	});

});