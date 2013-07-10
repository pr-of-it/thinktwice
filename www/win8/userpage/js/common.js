function CConfig() { // для наследования класса внутри нового клаcса - CConfig.apply(this);
	var self = this,
		kineticSide = null;

	/**
	 * main configuration
	 */

	self.anim = 200;     // time animation
	self.ajaxError = function (e, usertext) {
		alert('statusText: ' + e.statusText + '\nresponseText: ' + e.responseText + '\n\n' + (usertext ? usertext : ''));
	}// ошибка ajax запроса

	/**
	 * init scripts
	 */
	self.init = function () {
		$('html').addClass('js');
		$('.addlast, .columns').children().filter(':last-child').addClass('last');
		if (!window.console) console = { log: function () {
		}, dir: function () {
		}, warn: function () {
		}, error: function () {
		} }
		doc = document
		self.rails = $('#rails')

		// init
		$('input, select').styler();

		// устанавливаем ширину блока
		self.setWidth('set')

		// delegate events
		self.bind()
	}

	self.bind = function(){
	
		$('.my-interest').click(function(e){
			if($(e.target).is('span'))
			{
				if ($(this).hasClass('active'))
					$(this).removeClass('active')
				else
					$(this).addClass('active')
			}
			else
			{
				var span = $(this).find('span')
				if(span.is(':visible'))
				{
					span.hide()
					var h = $('.interest-menu').show().height()
					$("#container").css({
						top: h + 'px',
						bottom: -h + 'px'
					}).fadeTo(Config.anim, .5).css('z-index', 1)
				}
				else
				{
					span.show()
					$('.interest-menu').hide()
					$("#container").css({
						top: 0,
						bottom: 0
					}).fadeTo(Config.anim, 1).css('z-index', 0)
				}

			}
			return false;
		})

		$("#container").mousewheel(function (event, delta, deltaX, deltaY) {
			this.scrollLeft += (deltaX * 100); // трекпад на маке
			this.scrollLeft -= (deltaY * 100); // колесико мыши

			return false;
		});

		$(document).keydown(function (e) {
			var container = document.getElementById('container');

			if (e.keyCode == 37) {
				container.scrollLeft -= 100;
				return false;
			} else if (e.keyCode == 39) {
				container.scrollLeft += 100;
				return false;
			}
		});

		/**
		 * Открываем новость
		 * Если клик имеет другой обработчик
		 * Не выполнять этот бинд
		 */
		self.rails.on('click', '.news-box', function(e){
			var target = $(e.target)
			if(!target.hasClass('news-like') && !target.hasClass('icon-category') && !target.hasClass('news-tag'))
			{
				$('.window-post').popup()
			}
		})

		// скрываем окно
		$('body').on('click', '.close-popup', function(){
			$(this).parent().add('#bg-popup').fadeOut(Config.anim)
		})

		// открываем редактор для поста
		$('.create-post').click(function(){
			if($(this).hasClass('opacity-hide'))
				$(this).removeClass('opacity-hide')

			else return false;
		})
		// скрываем его
		$(doc).on('click', '*', function(e){
			var target = $(e.target)
			if(!target.hasClass('create-post') && !target.closest('.create-post').length)
				$('.create-post').addClass('opacity-hide')

			// скрываем основное меню
			if(!target.is('.interest-menu a') && $('.interest-menu').is(':visible'))
				$('.my-interest').click()
		})

		// todo: удалить
		$('.news-like').click(function(){
			$('.window-post-edit').popup()
		})
		$('.news-item img').click(function(){
			$('.window-post-2').popup()
		})
		
		$('.video-box .close').click(function(){
			$(this).closest('.quick-start-box').addClass('qsb-hide')
			$('#rails').removeClass('quick-start')
		})
	}

	/**
	 * устанавливаем ширину блока
	 */
	self.setWidth = function(is_set){
		var width = 0
		$('.news-list', self.rails).each(function(){
			width += $(this).outerWidth(true)
		})
		if(is_set == 'set')
			self.rails.width(width + 175)
		return width
	}
}
Config = new CConfig(); // init classes

/**
 * @class: Filter
 * @desc: Работа с фильтром в ленте
 */
function CFilter(config){
	var self = this;

	// methods
	self.run = function(){
		var panel = $('.lenta-settings', document.getElementById('header'))

		// показываем фильтр
		$('.icon-filter', panel).click(function(){
			var li = $(this).parent(),
				menu = $(this).next()

			li.addClass('active')

			$(this).closest('ul').find('> li').not(li).hide(Config.anim)
			menu.show()

			$('.button-ok', panel).show()

			var menu_height = menu.height()

			// засвечиваем рельс ленты
			Config.rails.addClass('disabled')
			$('#container').css('top', menu_height + 'px')

			return false;
		})

		// чеки - категории
		$('.cat-item', panel).click(function(){
			if($(this).hasClass('active'))
				$(this).removeClass('active')
			else
				$(this).addClass('active')
		})

		// кнопка применить
		$('.button-ok', panel).off().click(function(){
			$(this).hide()
			panel.find('> ul > li').show().removeClass('active')
			$('.lenta-set-menu', panel).hide()

			Config.rails.removeClass('disabled')
			$('#container').css('top', 0)
		})

		// сорт. по дате
		$('.icon-archive').datepicker().click(function(){
			return false;
		})	


		return true;
	}

	self.__init__ = function(){
		$(self.run)
		return true
	}
	self.__init__()
}




var Filter = new CFilter({});


$(function () {

	// create config and init classes
	Config.init();

	// css 3 styles and placeholder for old ie
	if (window.PIE) {
		$('input[placeholder], textarea[placeholder]').placeholder();
		$('.pie, .interest-cell, #wrapper, .news-box').each(function () {
			PIE.attach(this);
		});
	}
	
		$("#slider").slider({
            range: "min",
            min: 15,
            max: 60,
            step: 15,
            value: 15,
            slide: function(event, ui) {
                var delay = function() {
                    $( "#CallRequest_duration" ).val( ui.value );
                    $( "#slider-result" ).html( ui.value *  parseFloat(USER.consult_price || "0"));
                    $(".call-charge").html( ui.value * parseFloat(USER.consult_price || "0") );
                    $(".call-duration").html( ui.value + " минут" );
                    var handleIndex = $(ui.handle).data('index.uiSliderHandle');
                    var label = '#min';
                    $(label).html(ui.value).position({
                        my: 'center top',
                        at: 'center bottom',
                        of: ui.handle,
                        offset: "0,15"
                    });
                };

                // wait for the ui.handle to set its position
                setTimeout(delay, 5);
            }
        });

        $('#min').html($('#slider').slider('values', 0)).position({
            my: 'center top',
            at: 'center bottom',
            of: $('#slider a:eq(0)'),
            offset: "0, 10"
        });



		$('.link-advice').click(function(){
			$('.get-call').popup();
		})	
	
		$('.call-time-select').click(function(){
			$('.call-time-data').hide();
			$(this).next('.call-time-data').show();
		});
		
		$('.time-var span').click(function(){
			$(this).parents('.call-time-data').css('display', 'none');
		});
		
		$("#call-tabs-1, #call-tabs-2, #call-tabs-3").tabs();				
	
		
		makeUrl = function(url) {
			return '/index.php' + url;
		};


		$('.get-call .do-confirm input[type=button].change-phone').on('click', function () {
			var parent = $(this).parents('.do-confirm');
			var changeButton = $(this);
			var error = $(this).parent().find('.error').hide();
			var phone = parent.find('input[type=text][size=3]').val() + parent.find('input[type=text][size=7]').val();
			if (phone.length !== 10 || !/\d+/.test(phone)) {
				error.show();
				return false;
			}

			$.get(makeUrl('/user/ajaxRequestPhoneVerify'), {
				phone: '7' + phone
				}, function(data) {
					var code = data.code;
					console.log(phone, code);
					changeButton.hide();
					parent.find('input[type=text][size=5]').show();
					parent.find('input[type=button].confirm').show();
					var label = parent.find('.text-code-label');
					if (label.length)
						label.show();
					parent.find('.change-number').addClass('confirm-number');
					parent.find('.confirm-number-2').show();
					parent.find('input[type=text][size=3]').prop('disabled', true).show();
					parent.find('input[type=text][size=7]').prop('disabled', true).show();
			});
			
		});

		$('.get-call .do-confirm input[type=button].confirm').on('click', function () {
			var parent = $(this).parents('.do-confirm');

			var error = $(this).parent().find('.error').hide();
			var code = parent.find('input[type=text][size=5]').val();
			if (code.length !== 6 || !/\d+/.test(code)) {
				error.show();
				return false;
			}

			$.get(makeUrl('/user/ajaxVerifyPhoneCode'), {
				code: code
				}, function(data) {
					//console.log(data);
					if (data === true) {
						parent.find('input[type=text][size=5]').hide();
						parent.find('input[type=button].confirm').hide();
						parent.find('.code-label').hide();
					} else {
						error.text('Неправильный код.').show();
					}
			});
			
		});


}); // dom ready

