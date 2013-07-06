function CConfig() { // для наследования класса внутри нового клаcса - CConfig.apply(this);
	var self = this,
		kineticSide = null;

	/**
	 * main configuration
	 */

	self.viewLines = 1;
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

		$('.reg-helper').delay(3000).fadeOut(2000)

		window.onload = function(){
			Config.loadData();
			//Config.makeRails();
			//Config.fixPostPositions();
			//Config.setWidth('set');
		}
	}

	self.bind = function(){

		$('.my-interest').click(function(e){
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
			this.scrollLeft += (deltaX * 30); // трекпад на маке
			this.scrollLeft -= (deltaY * 30); // колесико мыши

			return false;
		});

		$(document).keydown(function (e) {
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
		 * Открываем новость
		 * Если клик имеет другой обработчик
		 * Не выполнять этот бинд
		 */
		self.rails.on('click', '.news-box', function(e){
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


		$(window).resize(function() {
			self.fixPostPositions();
			self.setWidth('set');

			/*setTimeout(function() {

			}, 1000);*/
		});
	}

	//var Mustache = Mustache || { compile: function(a) {return function(b){ return a;}} };
	var lentaTemplate = Mustache.compile(
		'<li class="news-item{{extraClass}}">' +
			'<div class="news-box">' +
				'<div class="news-tag">{{tag}}</div>' +
				'<div class="news-body">' +
					'{{#preview}}<img src="{{preview}}" alt=""/>{{/preview}}' +
					'<header class="news-author">{{author}}</header>' +
					'<h6>{{title}}</h6>' +
					'<p>{{text}}</p>' +
				'</div>' +
				'<div class="news-like">{{likes}}</div>' +
				'<a href="" class="icon-users"></a>' +
				'<div class="time-slider" class="{{timeClass}}"></div>' +
			'</div>' +
			'<div class="time-dott" class="{{timeClass}}">' +
				'<span>{{time}}</span>' +
			'</div>' +
		'</li>'
	);

	self.loadData = function(opts) {
		opts = opts || {};
		var loader = self.rails.find('.ajax-loader');
		//loader.css({visibility: 'visible'});

		$.getJSON('/index.php/blog/getIndexBlogPosts', {
			limit: opts['limit'] | 20,
			offset: opts['offset'] | 0
		}, function(data) {
			var ul = $('<ul class="news-list"/>'),
				running = false;
			for(var i=0; i<data.length; i++) {
				var item = data[i];
				var post = lentaTemplate({
					extraClass: '',
					tag: item.tag || '#TODO',
					preview: item.preview,
					author: item.author || '<TODO: Автор Новости>',
					title: item.title,
					text: item.text,
					likes: item.likes || 0,
					timeClass: '',
					time: new Date(item.time)
				});
				ul.append(post);
				running = true;
				if (item.image) {
					if (running) {
						self.rails.append(ul);
						ul = $('<ul class="news-list"/>');
						running = false;
					}
					ul.addClass('full-item').appendTo(self.rails)
				} else if (running && i === (data.length + 1)) {
					self.rails.append(ul);
				}
			}
			Config.makeRails();
			Config.fixPostPositions();
			Config.setWidth('set');
		})
		.fail(function() {})
		.always(function() {});
	}

	/*
		Проставим нужные классы для правильного построения ленты
	*/
	self.makeRails = function() {
		$('.news-list:not(.full-item)', self.rails).each(function () {
			var step = $(this),
				numItems = $('.news-item', step).length;

			var topWidth = 0, bottomWidth = 0;

			$('.news-item', step).each(function(i) {
				$(this).data({position: i});
				if (topWidth <= (bottomWidth + 60)) {
					topWidth += $(this).outerWidth() + 30;
					$(this).addClass('line-1').removeClass('line-2');
				} else {
					bottomWidth += $(this).outerWidth() + 30;
					$(this).addClass('line-2').removeClass('line-1');
				}
				//console.log(i, i&1,  $(this))
			});
		});
	}

	self.fixPostPositions = function() {
		if (self.viewLines === 1 && $(window).height() > 768) {
			//console.log('fixing for 2 lines')
			self.viewLines = 2;
			$('.news-list:not(.full-item)', self.rails).each(function () {
				var allItems = $('.news-item', $(this)),
					topItems = allItems.filter('.line-1'),
					bottomItems = allItems.filter('.line-2');
				allItems.removeClass('line-break');
				bottomItems.first().addClass('line-break');
				bottomItems.detach();
				bottomItems.appendTo($(this));

			});
		} else if (self.viewLines === 2 && $(window).height() <= 768) {
			//console.log('fixing for 1 line')
			self.viewLines = 1;
			$('.news-list:not(.full-item)', self.rails).each(function () {
				var allItems = $('.news-item', $(this));
				allItems.detach().sort(function (a, b) {
					var aPos = $(a).data('position'),
						bPos = $(b).data('position');
					if (aPos < bPos) return -1;
					if (aPos > bPos) return 1;
					return 0;
				});
				$(this).append(allItems);
			});
		}
	}

	/**
	 * устанавливаем ширину блока
	 */
	self.setWidth = function(is_set) {
		var width = 0;
		$('> .news-list', self.rails).each(function(){
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