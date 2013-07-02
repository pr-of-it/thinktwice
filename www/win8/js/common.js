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
				$(this).find('span').hide()
				//
			}
			return false;
		})

		/**
		 * Скроллим ленту по прокрутке колесика вверх - вниз
		 */
		$("#container").mousewheel(function (event, delta, deltaX, deltaY) {
			this.scrollLeft += (deltaX * 30); // трекпад на маке
			this.scrollLeft -= (deltaY * 30); // колесико мыши

			return false;
		});

		$(doc).keydown(function (e) {
			var container = doc.getElementById('container');

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
}); // dom ready