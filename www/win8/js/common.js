(function() {
	var days = ['воскрусенье','понедельни','вторник','среда','четверг','пятница','суббота'];

	var months = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];

	Date.prototype.getMonthName = function() {
		return months[ this.getMonth() ];
	};
	Date.prototype.getDayName = function() {
		return days[ this.getDay() ];
	};
	Date.fromDateTimeString = function(dateStr) {
		var dt = dateStr.split(/[ T]/),
			d = dt[0].split('-'),
			t = dt[1].split(':');
		return new Date(d[0], (d[1]-1), d[2], t[0], t[1], t[2]);
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
		console.error('statusText: ' + e.statusText + '\nresponseText: ' + e.responseText + '\n\n' + (usertext ? usertext : ''));
	}// ошибка ajax запроса


	self.ckconf = {
		toolbar: [['Bold'], ['Italic'], ['Link'], ['Maximize']],
		height: '250px',
		uiColor: '#e1e1db',
		dialog_backgroundCoverColor: 'black',
		dialog_backgroundCoverOpacity: 0.6,
		language: 'ru'
	};
	self.editor = null;
	

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
		var tmpl = document.getElementById('lenta-template')
		if (tmpl)
			self.postTemplate = Mustache.compile(tmpl.innerHTML);


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
			zIndex:99,
			cursor:"pointer"
		};

		if(document.getElementById("bg-popup") == null) {
			$("<div/>", {id: "bg-popup", css: popupCss}).appendTo("body")
		} else {
			$("#bg-popup").css(popupCss);
		}

		self.bgPopup = $('#bg-popup');

		if ($('.create-post').length)
			$('.create-post').detach().appendTo('#popup-wrapper');


	};

	self.makeUrl = function(url) {
		return url;
	};

	self.showPopup = function(target) {
		self.rails.addClass('disabled');
		self.bgPopup.show();
		target.addClass('visible-on');
	};

	self.hidePopup = function(target) {
		target.removeClass('visible-on');
		self.bgPopup.hide();
		self.rails.removeClass('disabled');
	};

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

		

		// скрываем его
		$(doc).on('click', '*', function(e){
			var target = $(e.target)
			/*if(!target.hasClass('create-post') && !target.parents('.create-post').length){
				$('#rails').removeClass('disabled')
				$('.create-post').addClass('opacity-hide')
				$('#popup-wrapper').css('z-index', 0);
				self.bgPopup.hide();
			}*/

			// скрываем основное меню
			if(!target.is('.interest-menu a') && $('.interest-menu').is(':visible'))
				$('.my-interest').click()
		})

		$('.video-box .close').click(function(){
			$(this).closest('.quick-start-box').addClass('qsb-hide')
			$('#rails').removeClass('quick-start');
			self.setWidth('set');
		})

		if ($('body').hasClass('index'))
			$(window).resize(function() {
				self.fixPostPositions();
				self.setWidth('set');
			});



		// Форма поста
		/*$('#blog-form').on('submit', function () {
			var data = $(this).serializeArray();
			$.post('', data, function(data) {
				console.log(data);
				alert(data);
			})
			.fail(function() {alert('Не удалось отправить данные.');})
			.always(function() {});
			return false;
		});*/
	}

	var zFill = function(s) {
		return ('00' + s).substr((s+'').length, 2);
	}

	var declension = function (num, nominative, genitivesingular, genitiveplural) {

		if (num == 11) {return genitiveplural;}
		if (num == 12) {return genitiveplural;}
		if (num == 13) {return genitiveplural;}
		if (num == 14) {return genitiveplural;}

		num = '' + num;

		var length = num.length;

		num = num.substring(length-1, length);

		if (num == '1') {return nominative;}

		if (num == '2') {return genitivesingular;}
		if (num == '3') {return genitivesingular;}
		if (num == '4') {return genitivesingular;}

		if (num == '5') {return genitiveplural;}
		if (num == '6') {return genitiveplural;}
		if (num == '7') {return genitiveplural;}
		if (num == '8') {return genitiveplural;}
		if (num == '9') {return genitiveplural;}
		if (num == '0') {return genitiveplural;}
	};

	self.formatTimelineDate = function(s) {
		var now = new Date(),
			date = Date.fromDateTimeString(s),
			time = zFill(date.getHours()) + ':' + zFill(date.getMinutes()),
			timeFormat;
		if (date.getDate() == now.getDate() &&
				date.getMonth() == now.getMonth() &&
				date.getFullYear() == now.getFullYear()) {
			var dateMinutes = date.getHours()*60 + date.getMinutes(),
				nowMinutes = now.getHours()*60 + now.getMinutes();

			var minDelta = nowMinutes - dateMinutes;
			if (minDelta <= 3) {
				timeFormat = 'сейчас';
			} else if (minDelta <= 60) {
				timeFormat = minDelta + ' ' + declension(minDelta, 'минуту', 'минуты', 'минут') + ' назад';
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
		var date = Date.fromDateTimeString(s);
		return ( date.getFullYear() + '.' + zFill(date.getMonth()+1) + '.' + zFill(date.getDate()));
	}

	self.formatTimelineHeader = function(s) {
		var date = Date.fromDateTimeString(s),
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
		$.getJSON(self.makeUrl('/blog/ajaxGetIndexBlogPosts'), {
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

			var lastStep = self.rails.find('.step-day:last');
			if (lastStep.length) {
				stepDay = lastStep;
				dayRunning = true;
			}

			var header, headerText, oldHeaderText;
			for(var i=0; i<data.length; i++) {
				var item = data[i];
				var timeFormat = self.formatTimelineDate(item.time),
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
						if (oldHeaderText)
							stepDay.prepend(header.text(oldHeaderText));
						self.rails.append(stepDay);
						stepDay = $('<div class="step-day"/>');
						dayRunning = false;
					}
				}

				var preview = (!item.image && item.media && item.media.length && item.media[0].url) || null;
				var post = $(self.postTemplate({
					extraClass: (item.blog && item.blog.type === 3) ? ' white-style' : '',
					tag: item.tag || '',
					preview: preview,
					author: (item.blog && item.blog.title) || '',
					title: item.title,
					text: item.text,
					likes: item.likes || 0,
					time: timeFormat,
					image: item.image,
					media: item.image && item.media,
					hasMedia: (item.image && item.media.length)
				}));
				post.data({
					position: i + self.numPosts,
					id: item.id,
					avatar: (item.blog && item.blog.user.avatar) || '',
					uid: (item.blog && item.blog.user.id) || null,
					user_name: (item.blog && item.blog.user.name || 'Эксперт'),
					time: item.time,
					media: item.media || []
				});
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
				//loader.hide();
				loader.find('img').hide();
				loader.find('span').text('Все записи загружены.').show();
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

			$('.news-item', step).sort(sortPosts).each(function(i) {
				if (topWidth <= (bottomWidth + 60)) {
					//console.log('line-1', i, topWidth, bottomWidth)
					topWidth += $(this).outerWidth() + 30;
					$(this).addClass('line-1')//.removeClass('line-2');
				} else {
					//console.log('line-2', i, topWidth, bottomWidth)
					bottomWidth += $(this).outerWidth() + 30;
					$(this).addClass('line-2')//.removeClass('line-1');
				}
			});
		});
	}

	self.fixTimelineHeaders = function() {
		var aPos = $(a).data('position'),
			bPos = $(b).data('position');
		if (aPos < bPos) return -1;
		if (aPos > bPos) return 1;
		return 0;
	}

	var sortPosts = function (a, b) {
		var aPos = $(a).data('position'),
			bPos = $(b).data('position');
		if (aPos < bPos) return -1;
		if (aPos > bPos) return 1;
		return 0;
	}

	self._isTwoLinesMediaQueryActive = function () {
		return (/50%$/.test( $('.news-list:first').css('background-position') ));
	}

	self.fixPostPositions = function(force) {
		if ( (self.viewLines === 1 && self._isTwoLinesMediaQueryActive()) ||
			 (self.viewLines === 2 && force) ) {

			self.viewLines = 2;
			$('.news-list:not(.full-item)', self.rails).each(function () {
				var allItems = $('.news-item', $(this));
				
				var topItems = allItems.filter('.line-1'),
					bottomItems = allItems.filter('.line-2');

				allItems.removeClass('line-break');
				bottomItems.first().addClass('line-break');
				bottomItems.detach().appendTo($(this));


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
		} else if ( (self.viewLines === 2 && !self._isTwoLinesMediaQueryActive()) ||
					(self.viewLines === 1 && force) ) {
			//console.log('fixing for 1 line')
			self.viewLines = 1;
			$('.news-list:not(.full-item)', self.rails).each(function () {
				var allItems = $('.news-item', $(this));
				allItems.detach().sort(sortPosts);
				$(this).append(allItems);
			});
			self.setWidth('set');
		}
		//$('.step-day:first .news-list:first').css('width', '100%'); //IE8 fix
	}

	/**
	 * устанавливаем ширину блока
	 */
	self.setWidth = function(is_set) {
		var width = 0;
		$('> .step-day', self.rails).each(function(){
			width += $(this).outerWidth(true);
		})
		if(is_set == 'set') {
			var containerWidth = width;
			if (self.rails.hasClass('quick-start'))
				containerWidth += ($('.quick-start-box').outerWidth() + 90);
			$('#container').width(containerWidth);

			self.rails.width(width * 2 + (560+120)*20);
		}
		//console.log(width)
		return width;
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
	// css 3 styles and placeholder for old ie
	if (window.PIE) {
		$('input[placeholder], textarea[placeholder]').placeholder();
		$('.pie, .interest-cell, #wrapper, .news-box').each(function () {
			PIE.attach(this);
		});
	}

}); // dom ready