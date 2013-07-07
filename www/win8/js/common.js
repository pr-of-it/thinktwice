(function() {
    var days = ['воскрусенье','понедельни','вторник','среда','четверг','пятница','суббота'];

    var months = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];

    Date.prototype.getMonthName = function() {
        return months[ this.getMonth() ];
    };
    Date.prototype.getDayName = function() {
        return days[ this.getDay() ];
    };
})();
function CConfig() { // для наследования класса внутри нового клаcса - CConfig.apply(this);
	var self = this,
		kineticSide = null;

	/**
	 * main configuration
	 */

	self.viewLines = 1;
	self.numPosts = 0;
	self.postsAreLoading = false;
	self.everythingWasLoaded = false;
	self.timelineHeaders = {};

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

		// delegate events
		self.bind()

		$('.reg-helper').delay(3000).fadeOut(2000)

		var popupCss = {
			position:"absolute",
			top:0, left:0, display:"none",
			height: '100%',
			width: '100%',
			background:'#000',
			opacity:.6,
			filter:"alpha(opacity=60)",
			zIndex:100,
			cursor:"pointer"
		};

		if(document.getElementById("bg-popup") == null) {
			$("<div/>", {id: "bg-popup", css: popupCss}).appendTo("body")
		} else {
			$("#bg-popup").css(popupCss);
		}

		self.bgPopup = $('#bg-popup').addClass('close-popup');

		window.onload = function(){
			self.loadData();
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
			
			var imgTarget = target.find('.image-gallery-min-full'),
				img = window.find('img:first');
			if (imgTarget.length) {
				var src = imgTarget.css('background-image');
				img[0].src = src.replace(/^url\(/, '').replace(/\)$/, '');
				img.show();
			} else {
				img.hide();
			}

			self.bgPopup.show();
			window.addClass('visible-on');
		})

		// скрываем окно
		$('body').on('click', '.close-popup', function(){
			self.bgPopup.hide();
			$('.window-post').removeClass('visible-on');
			
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
		});

		/**
		 *  Подгрузка контетна в ленту
		 */

		$("#container").scroll(function () {
			var width = self.rails.width() - 440;
			var scroll = $('#container').scrollLeft() + $(window).width();

			if (!self.postsAreLoading && !self.everythingWasLoaded && scroll > width)
				self.loadData();


		});
	}

	var lentaTemplate = Mustache.compile(
		'<li class="news-item{{extraClass}}">' +
			'<div class="news-box">' +
				'<div class="news-tag">{{tag}}</div>' +
				'{{#image}}' +
				'<div style="background-image: url(/{{image}});" class="image-gallery-min-full">' +
				'</div>' +
				'{{/image}}' +
				'<div class="news-body">' +
					'{{#preview}}<img src="{{preview}}" alt="{{title}}"/>{{/preview}}' +
					'<header class="news-author">{{author}}</header>' +
					'<h6>{{title}}</h6>' +
					'<p>{{text}}</p>' +
					'<span class="text-hide"></span>' +
				'</div>' +
				'<div class="news-like">{{likes}}</div>' +
				'<a href="" class="icon-users"></a>' +
				'<div class="time-slider"></div>' +
			'</div>' +
			'<div class="time-dott">' +
				'<span>{{time}}</span>' +
			'</div>' +
		'</li>'
	);

	var zFill = function(s) {
		return ('00' + s).substr((s+'').length, 2);
	}

	self.formatTimelineDate = function(s) {
		var date = new Date(s),
			now = new Date(),
			time = zFill(date.getHours()) + ':' + zFill(date.getMinutes()),
			timeFormat;
		if (date.getDate() == now.getDate() &&
				date.getMonth() == now.getMonth() &&
				date.getFullYear() == now.getFullYear()) {
			if (date.getHours() == now.getHours()) {
				if (now.getMinutes() - date.getMinutes() <= 3)
					timeFormat = 'сейчас';
				else if (now.getMinutes() - date.getMinutes() <= 60)
					timeFormat = (now.getMinutes() - date.getMinutes()) + ' минут назад'
			} else timeFormat = time;
		} else if (date.getFullYear() == now.getFullYear()) {
			if (date.getDate() == now.getDate() - 1)
				timeFormat = 'вчера ' + time;
			else
				timeFormat = date.getDate() + ' ' + date.getMonthName() + ' ' + time;
		} else {
			timeFormat = date.getFullYear() + '.' + zFill(date.getMonth()+1) + '.' + zFill(date.getDate()) + ' ' + time;
		}
		return timeFormat;
	}

	self.timelineHeaderKey = function(s) {
		var date = new Date(s);
		return ( date.getFullYear() + '.' + zFill(date.getMonth()+1) + '.' + zFill(date.getDate()));
	}

	self.formatTimelineHeader = function(s) {
		var date = new Date(s),
			now = new Date();
		if (date.getDate() == now.getDate() &&
				date.getMonth() == now.getMonth() &&
				date.getFullYear() == now.getFullYear()) {
			return 'сегодня'
		} else if (date.getFullYear() == now.getFullYear()) {
			if (date.getDate() == now.getDate() - 1)
				return 'вчера';
			
			return date.getDate() + ' ' + date.getMonthName();
		}
		return self.timelineHeaderKey(s);
	}

	self.loadData = function(opts) {
		opts = opts || {};
		var loader = self.rails.find('.ajax-loader').show();

		self.postsAreLoading = true;
		console.log('loading data...')
		$.getJSON('/index.php/blog/getIndexBlogPosts', {
			limit: opts['limit'] | 20,
			offset: opts['offset'] | self.numPosts
		}, function(data) {
			var	stepDay = $('<div class="step-day"/>'),
				ul = $('<ul class="news-list"/>'),
				running = false,
				dayRunning = false;

			loader.detach();

			var lastUl = self.rails.find('.news-list:not(.ajax-loader):last');
			if (lastUl.length && !lastUl.hasClass('full-item')) {
				ul = lastUl;
				running = true;
			}

			var header, headerText, oldHeaderText;
			for(var i=0; i<data.length; i++) {
				var item = data[i],
					timeFormat = self.formatTimelineDate(item.time),
					timelineHeader = self.timelineHeaderKey(item.time);

				if (!self.timelineHeaders[timelineHeader]) {
					header = $('<header class="day-name" />')
					header.data('key', timelineHeader);
					oldHeaderText = headerText;
					headerText = self.formatTimelineHeader(item.time);
					self.timelineHeaders[timelineHeader] = headerText;

					if (dayRunning) {
						if (!ul.is(lastUl)) stepDay.append(ul);
						ul = $('<ul class="news-list"/>');
						running = false;
						stepDay.prepend(header.text(oldHeaderText));
						//console.log('appending stepday', oldHeaderText, stepDay.find('.news-item').length)
						self.rails.append(stepDay);
						stepDay = $('<div class="step-day"/>');
						dayRunning = false;
					}
				}

				var preview = item.preview || ( ((Math.random() > .8) && !item.image) ? '/win8/img/tmp/image-float.png' : null );
				var post = $(lentaTemplate({
					extraClass: '',
					tag: '#' + (i+1+self.numPosts) + ' ' + (item.tag || '#TODO'),
					preview: preview,
					author: item.author || 'Автор',
					title: item.title,
					text: item.text,
					likes: item.likes || 0,
					time: timeFormat,
					image: item.image
				}));
				post.data({position: i + self.numPosts});
				if (preview) {
					post.addClass('medium-width');
				}
				if (item.image) {
					if (running) {
						if (!ul.is(lastUl)) stepDay.append(ul);
						ul = $('<ul class="news-list"/>');
						running = false;
					}
					ul.append(post);
					ul.addClass('full-item').appendTo(stepDay);
					ul = $('<ul class="news-list"/>');
					if (i === (data.length - 1)) {
						header = $('<header class="day-name" />')
						stepDay.prepend(header.text(headerText));
						self.rails.append(stepDay);
					}
				} else if (i === (data.length - 1)) {
					ul.append(post);
					if (!ul.is(lastUl)) stepDay.append(ul);
					header = $('<header class="day-name" />')
					stepDay.prepend(header.text(headerText));
					self.rails.append(stepDay);
				} else {
					ul.append(post);
					running = true;
					dayRunning = true;
				}
			}

			self.rails.append(loader);
			self.postsAreLoading = false;
			self.numPosts += data.length;
			if (data.length === 0) {
				loader.hide();
				self.everythingWasLoaded = true;
			}
			console.log('...loaded ' + data.length + ' items.')
			self.makeRails();
			self.fixPostPositions(true);
			//self.fixTimelineHeaders();
		})
		.fail(function() {})
		.always(function() {});
	}

	/*
		Проставим нужные классы для правильного построения ленты
	*/
	self.makeRails = function() {
		$('.news-list:not(.full-item)', self.rails).each(function () {
			var step = $(this);

			var topWidth = 0, bottomWidth = 0;

			$('.news-item', step).each(function(i) {
				if (topWidth <= (bottomWidth + 60)) {
					//console.log('line-1', i, topWidth, bottomWidth)
					topWidth += $(this).outerWidth() + 30;
					$(this).addClass('line-1').removeClass('line-2');
				} else {
					//console.log('line-2', i, topWidth, bottomWidth)
					bottomWidth += $(this).outerWidth() + 30;
					$(this).addClass('line-2').removeClass('line-1');
				}
			});
		});
	}

	self.fixTimelineHeaders = function() {
		
	}

	self.fixPostPositions = function(force) {
		if ( (self.viewLines === 1 && $(window).height() > 768) ||
		     (self.viewLines === 2 && force) ) {
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

				var dots = [];
				$('.time-dott', $(this)).each(function() {
					var parent = $(this).parent();
					$(this).removeClass('alt-pos');
					parent.find('.time-slider').removeClass('alt-pos');
					dots.push([
						$(this).offset().left,
						parent.hasClass('line-2'),
						$(this), parent.find('.time-slider')
					])
				});
				dots.sort();
				for (var i=1; i < dots.length; i++) {
					var dot = dots[i];
					if (Math.abs(dot[0] - dots[i-1][2].offset().left) < 60) {
						dot[2].toggleClass('alt-pos');
						dot[3].toggleClass('alt-pos');
					}
				}
			});
			self.setWidth('set');
		} else if ( (self.viewLines === 2 && $(window).height() <= 768) ||
		            (self.viewLines === 1 && force) ) {
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
			self.setWidth('set');
		}
	}

	/**
	 * устанавливаем ширину блока
	 */
	self.setWidth = function(is_set) {
		var width = 0;
		$('> .step-day', self.rails).each(function(){
			width += $(this).outerWidth(true);
		})
		if(is_set == 'set')
			self.rails.width(width + 175);
		//console.log(width)
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