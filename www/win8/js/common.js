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

		var popupCss = {
			position:"absolute",
			top:0, left:0, display:"none",
			height:$(doc).height(),
			width:$(window).width(),
			background:'#000',
			opacity:.6,
			filter:"alpha(opacity=60)",
			zIndex:100,
			cursor:"pointer"
		};

		if(document.getElementById("bg-popup") == null) {
			$("<div/>", {id: "bg-popup", css:popupCss}).appendTo("body")
		} else {
			$("#bg-popup").css(popupCss);
		}

		self.bgPopup = $('#bg-popup')


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

		/**
		 * Скроллим ленту по прокрутке колесика вверх - вниз
		 */
		$("#container").mousewheel(function (event, delta, deltaX, deltaY) {
			this.scrollLeft += (deltaX * 100); // трекпад на маке
			this.scrollLeft -= (deltaY * 100); // колесико мыши

			return false;
		});

		/**
		 * Скроллим ленту по нажатию клавиш
		 */
		$(doc).keydown(function (e) {
			var container = $('#container');

			if (e.keyCode == 37) {
				container.animate({
					scrollLeft: '-=360',
				}, 300);

				return false;

			} else if (e.keyCode == 39) {
				container.animate({
					scrollLeft: '+=360',
				}, 300);

				return false;
			}
		});

		/**
		 *  Подгрузка контетна в ленту
		 */

		var page = 1,
			newsBlockWidth = $('.news-list').width();

        $("#container").scroll(function () {

            var docViewLeft = $(window).scrollLeft();
            var docViewRight = docViewLeft + $(window).width();

            var elemOffset = $('ul.empty').offset();
            var elemLeft = elemOffset ? elemOffset.left : 0;
            if ( ((elemLeft <= docViewRight) && (elemLeft >= docViewLeft)) ) {
                $('ul.empty').removeClass('empty');
                $.get(
                    '/index.php/site/index',
                    {'BlogPost_page': ++page},
                    function (data) {
                    	var numItems = $(data).filter('.news-list:not(.empty)').length;
                    	self.setWidth('set', numItems * newsBlockWidth + 175);
                        $('#rails').append('<div class="step-day"><header class="day-name">Далее...</header>' + data + '</div>');
                        self.setWidth('set');
                    }
                );
            };

            return false;

        });


		/**
		 * Открываем новость
		 * Если клик имеет другой обработчик
		 * Не выполнять этот бинд
		 */
		self.rails.on('click', '.news-box', function(e) {
			var target = $(e.target)

			if (target.hasClass('icon-category')) {
				alert('TODO: Показать категорию')
				return false;
			} else if (target.hasClass('news-tag')) {
				alert('TODO: Включить фильрацию по тегу ' + target.text())
				return false;
			}
			if (!target.hasClass('news-box')) {
				target = target.parents('.news-box')
			}
			var window = $('.window-post');
			window.find('header.popup-head').html( target.find('h6').html() );  // $post->title
			window.find('article.content p').html( target.find('.news-body p').html() );  // $post->text
			window.find('.author b').html( target.find('header.news-author').html() );  // $post->blog->title
			window.popup();

			/*window.css({right: -window.width()})
			self.bgPopup.show();
			window.show()
			window.animate({
				right: 0,
				duration: Config.anim
			})*/
			return false;

		})

		// скрываем окно
		$('body').on('click', '.close-popup', function() {
			var window = $(this).parent();

			window.fadeOut(Config.anim)
			self.bgPopup.fadeOut(Config.anim)
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
		/*$('.news-like').click(function(){
			$('.window-post-edit').popup()
		})*/
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
	self.setWidth = function(is_set, extra){
		var width = 0
		$('.news-list', self.rails).each(function(){
			width += $(this).outerWidth(true)
		})
		if(is_set == 'set') {
			if (typeof extra === 'undefined')
				extra = 175
			self.rails.width(width + extra)
		}
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