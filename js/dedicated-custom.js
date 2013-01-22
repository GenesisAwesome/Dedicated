jQuery(document).ready(function($) {

	var search_val = $('.searchinput').val();
	$('.searchinput').focus(function(){
		$(this).closest('#dedicated-search').addClass('searchfoucs');
		if($(this).val() == search_val) $(this).val("");
	}).blur(function(){
		$(this).closest('#dedicated-search').removeClass('searchfoucs');
		if($(this).val() === "") { $(this).val(search_val); }
	});

	$('ul.menu-primary li a').append('<span class="bar"></span>');

	$('.menu-primary').after(function(){
		return $('<div id="dedicated-mobile"><a class="trigger" href="#">Navigation<span></span></a></div>').hide();
	});

	$('ul.menu-primary:first').clone().attr('id', 'dedicated-mobilemenu').removeAttr('class').hide().appendTo('#dedicated-mobile');
	$('#dedicated-mobile a.trigger').addClass('close');
	$('#dedicated-mobile a.trigger').click(function(){
		$this = $(this);
		if($this.hasClass('close')){
			$this.removeClass('close').addClass('open');
			$this.parent().find('#dedicated-mobilemenu').slideDown();
		} else {
			$this.removeClass('open').addClass('close');
			$this.parent().find('#dedicated-mobilemenu').slideUp();
		}
	});

	$('#dedicated-social a').tipsy({
		gravity : 's',
		fade    : true,
		offset  : 3
	});

	$('.flexslider').flexslider({
		selector          : '.slides > li',
		animation         : 'slide',
		easing            : 'swing',
		direction         : 'horizontal',
		animationLoop     : true,
		smoothHeight       : true,
		startAt           : 0,
		slideshow         : true,
		slideshowSpeed    : 7000,
		animationSpeed    : 600,
		initDelay         : 0,
		pauseOnAction     : true,
		pauseOnHover      : true
	});

	$('body').fitVids();

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