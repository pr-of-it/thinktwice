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
		self.header = $('#header')

		// init
		$('input, select').styler();

		// устанавливаем ширину блока
		self.setWidth('set')

		// delegate events
		self.bind()

		// плитка на рабочем столе
		$('.mp-level-list').w8tile()

		$('.reg-helper').delay(3000).fadeOut(2000)

		window.onload = function(){
			Config.setWidth('set')
		}
	}

	self.bind = function(){

		$('.my-interest:not(.expert-only)').click(function(e){
			if(window.user_id === 'null') return false;

			$('.create-post').addClass('opacity-hide')

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

		$('.my-interest.expert-only').click(function(e){

			if ($(this).hasClass('active'))
				$(this).removeClass('active')
			else
				$(this).addClass('active')
			return false;
		})

		;(function(){
			var notify_interest = null
			$('.my-interest').on({
				mouseover: function () {
					if(notify_interest) clearTimeout(notify_interest)
					if (window.user_id === 'null')
						$(this).next().addClass('notify-show')
				},
				mouseout: function () {
					var _this = $(this)
					if (window.user_id === 'null')
						notify_interest = setTimeout(function () {
							_this.next().removeClass('notify-show')
						}, 500)
				}
			})
			$('.notify-reg').on({
				mouseover: function(){
					if(notify_interest) clearTimeout(notify_interest)
				},
				mouseout:function(){
					var _this = $(this)
					notify_interest = setTimeout(function () {
						_this.removeClass('notify-show')
					}, 500)
				}
			})
		})();

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
			$(this).parent().add('#bg-popup').removeClass('visible-on')
		})

		// открываем редактор для поста
		$('.create-post').click(function(){
			if($(this).hasClass('opacity-hide')){
				$(this).removeClass('opacity-hide')
				$('#rails').addClass('disabled')
			}

			else return false;
		})
		// скрываем его
		$(doc).on('click', '*', function(e){
			var target = $(e.target)
			if(!target.hasClass('create-post') && !target.closest('.create-post').length){
				$('#rails').removeClass('disabled')
				$('.create-post').addClass('opacity-hide')
			}

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
		$('.video-box .content').click(function(){
			$('.window-post').popup()
		})

		// фильтруем по категориям
		$('.news-tag', self.rails).click(function(){
			$('.lenta-settings', self.header).hide()
			$('.filter-by', self.header).show().find('div').off().on({
				click:function(){
					$(this).closest('.filter-by').hide()
					$('.lenta-settings', self.header).show()
				}
			}).prev().text($(this).text())
		})


	}

	/**
	 * устанавливаем ширину блока
	 */
	self.setWidth = function(is_set){
		var width = 0
		$('> *:not(.quick-start-box)', self.rails).each(function(){
			width += $(this).outerWidth(true)
		})
		if(is_set == 'set')
			self.rails.width(width + 175)
		return width
	}

	$.fn.w8tile = function () {
		return this.each(function(){
			var list = $(this),
				items = list.find('> li'),
				width_item = items.first().outerWidth(true),
				height_item = items.first().outerHeight(true),
				level = [2, 3, 4, 5],
				res = null

			$(window).on('resize.tile', function(){

				$.each(level, function(i){
					res = ((items.length / level[i]) * width_item) + width_item
					if (list.height() > (height_item * level[i])) {
						list.width(res).parent().parent().width(res)
						self.setWidth('set')
					}
				})

			})
			$(window).trigger('resize.tile')
		})
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
		var panel = $('.lenta-settings', Config.header)

		// показываем фильтр
		$('.icon-filter', panel).click(function(){
			var li = $(this).parent(),
				menu = $(this).next()

			$('.create-post').addClass('opacity-hide')
			if($('.interest-menu').is(':visible'))
				$('.my-interest').click()

			li.addClass('active')

			$(this).closest('ul').find('> li').not(li).hide(Config.anim)
			menu.show()

			$('.button-ok', panel).show()

			var menu_height = menu.height()

			// засвечиваем рельс ленты
			Config.rails.addClass('disabled')
			$('#container').css({
				top: menu_height +'px',
				bottom: -menu_height + 'px'
			})

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
			$('#container').css({
				top: 0,
				bottom: 0
			})
		})

		// сорт. по дате
		$('.datepicker-field').datepicker()
		$('.icon-archive').click(function(){
			$('.datepicker-field').datepicker('show')
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
}); // dom ready