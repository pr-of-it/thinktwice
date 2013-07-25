$(function () {

    var app = Config;

    // create config and init classes
    app.init();

    $("#wrapper").mousewheel(function (event, delta, deltaX, deltaY) {
        if (app.rails.hasClass('disabled')) {
            return true;
        }
        this.scrollLeft += (deltaX * 90); // трекпад на маке
        this.scrollLeft -= (deltaY * 90); // колесико мыши

        return false;
    });

    var following = $('.users-list-following');
    var experts = $('.users-list-experts');
    var portals = $('.users-list-portals');
    var others = $('.users-list-others');

    var not_following = $('.users-list-box:not(.users-list-following,.ajax-loader)');
    
    var othersColumns = 5,
        loading = false,
        numItemsToLoad = 20;

    var tmpl = document.getElementById('user-template')
    var userTemplate = Mustache.compile(tmpl.innerHTML);


    var mode = 'all';

    var usersController = {
        'following': [],
        'experts': [],
        'portals': [],
        'others': []
    };

    //var UsersData = {};

    var userDesc = function (role) {
        var desc = 'Пользователь';
        if (role === 'expert') desc = 'Специалист методологии';
        else if (role === 'rss') desc = 'Новостной<br>портал';
        return desc;
    };


    var initUserBlock = function (blockName) {
        var target = $('.users-list-' + blockName);
        usersController[blockName] = [];
        target.find('.users-item:not(.user-plus)').each(function () {
            usersController[blockName].push($(this).data('id'));
            $(this).find('.desc').html(userDesc($(this).data('userrole')));
        });
    };


    var loader = {
        init: function () {
            var loader = $('.ajax-loader');
            loader.find('img').show();
            loader.find('span').hide();
        },
        finish: function () {
            var loader = $('.ajax-loader')
            loader.find('img').hide();
            loader.find('span').text('Все пользователи загружены.').show();
        }
    }


    $('.users-list-box header:first-child').each(function (e) {
        var header = $(this), parent = header.parent();

        parent.data('count', parseInt(header.find('span').text().substr(7)));
        //console.log(parent.data('count'))

        header.css('cursor', 'pointer');
        header.on('click', function () {
            if (mode !== 'all') {
                $('.users-list-box:not(.ajax-loader)').show();
                $(this).data('selected', 0)
                mode = 'all';
                loader.init();
                fixWidth();
            } else {
                if (parent.is('.users-list-following')) {
                    mode = 'following';
                } else if (parent.is('.users-list-portals')) {
                    mode = 'portals';
                } else if (parent.is('.users-list-experts')) {
                    mode = 'experts';
                } else {
                    mode = 'others';
                }
                $('.users-list-box:not(.ajax-loader)').not(parent).hide();
                $(this).data('selected', 1);
                allLoaded[mode] = false;
                loader.init();
                fixWidth();
            }
        })
    });

    var allLoaded = {
        'following': false,
        'experts': false,
        'portals': false,
        'others': false
    };

    var numColumns = {
        'following': 5,
        'experts': 5,
        'portals': 5,
    };

    loadItem = function(item, blockName) {
        var user = {
            id: item.id,
            role: item.role.name,
            name: item.name,
            avatar: item.avatar,
            desc: userDesc(item.role.name),
            extraClass: ''
        }
        if (user.role === 'expert') {
            user.extraClass =  ' user-premium';
            user.ratingBox = true;
            user.price = item.consult_price || 0;
        }
        user.followClass = blockName === 'following' ? 'unfollow' : 'follow';
        usersController[blockName].push(user.id);
        //UsersData[user.id] = user;
        var newBlock = userTemplate(user);
        var target = $('.users-list-' + blockName);
        target.find('.users-list:last').append(newBlock);
    };

    var loadData = function (blockName) {
        loading = true;
        $.get('/users/ajaxGetUsers', {
            offset: usersController[blockName].length,
            limit: numItemsToLoad,
            filter: blockName
        }, function (data) {
            console.log('Loading ' + data.length + ' ' + blockName + ' items...')
            //alert(data.length)
            if (data.length === 0) {
                if (blockName === 'others' || mode !== 'all') {
                    loader.finish();
                }
                allLoaded[blockName] = true;
                loading = false;
                return;
            }
            for (var i=0; i<data.length; i++) {
                var item = data[i];
                loadItem(item, blockName);
            }

            var target = $('.users-list-' + blockName);
            var numItems = target.find('.users-item').length;
            console.log('Loaded ' + numItems + ' ' + blockName + ' items total.')

            fixWidth();
            loading = false;

        });
    }

    var columnize = function (target) {
        var plus = target.find('.user-plus');
        if (plus.length) {
            plus.detach();
        }
        var items = target.find('li.users-item:not(.user-plus)').detach();
        var ul = target.find('.users-list:first').detach();
        target.find('.users-list').remove();

        var itemsLeft = items.length;
        ul.width(184).css('float', 'left');
        
        var visibleRows = Math.floor($('#rails').outerHeight() / 230);

        var begin = 0, end = visibleRows;        

        while (itemsLeft > 0) {
            var newUl = ul.clone();
            newUl.append(items.slice(begin, end));
            target.append(newUl);

            itemsLeft -= visibleRows;
            begin += visibleRows;
            end += visibleRows;
        }
        if (plus.length)
            plus.appendTo(target.find('.users-list:last'));
    }

    var fixVisibility = function (target) {
        var visibleRows = Math.floor(($('#rails').outerHeight()) / 230);

        //console.log(visibleRows, $('#rails').height(), ($('#rails').height() ) / 230)
        if (target.hasClass('users-list-following')) {
            blockName = 'following';
        } else if (target.hasClass('users-list-experts')) {
            blockName = 'experts';
        } else if (target.hasClass('users-list-portals')) {
            blockName = 'portals';
        } else if (target.hasClass('users-list-others')) {
            blockName = 'others';
        }

        var columns = mode === 'all' ? 3 : (numColumns[blockName] || othersColumns);

        var items = target.find('.users-item:not(.user-plus)');

        if (items.length + 1 < 3 * visibleRows) {
            columns = 3;
        } else if (mode !== 'all' && items.length + 1 < 5 * visibleRows) {
            columns = 5;
        }
        var numItems = columns * visibleRows;
        target.width(columns * 184);
        if (blockName === 'experts') {
            numItems -= 1;
        } else if (blockName === 'others' && mode === 'all') {
            if (items.length < 3 * visibleRows) {
                othersColumns = 3;
            } else if (items.length < 5 * visibleRows) {
                othersColumns = 5;
            } 
            numItems = othersColumns * visibleRows;
            target.width(othersColumns * 184);
        }

        columnize(target);

        if (blockName === 'others') {
            numItems = othersColumns * visibleRows;
        }

        if (items.length < numItems && !allLoaded[blockName]) {
            loader.init();
            loadData(blockName);
        } 
        items.slice(numItems).hide();
        items.slice(0, numItems).show();
        target.find('header span').html('Всего (' + target.data('count') + ')');
    };

    var fixWidth = function() {
        if (mode === 'all') {
            initUserBlock('following');
            initUserBlock('experts');
            initUserBlock('portals');
            initUserBlock('others');
            $('.users-list-box:not(.ajax-loader)').each(function () {
                fixVisibility($(this));
            });
        } else {
            initUserBlock(mode);
            fixVisibility($('.users-list-' + mode));
        }
        
        var width = $('.users-list-wrap').outerWidth() + 200;

        // Для очень больших мониторов
        if ($(window).width() > width) {
            width = $(window).width() + 200;
        } // TODO: увеличивать кол-во колонок, чтобы заполнить экран

        $('#container').width(width);
        $('#rails').width(width * 1.2);
    }

    $(window).on('resize', fixWidth);

    fixWidth();

    not_following.on('click', '.follow', function (e) {
        //console.log('click follow', this)
        var parent = $(this).parent(),
            self = this;
        $.get('/users/ajaxFollowUser', {id: parent.data('id')}, function (data) {
            //console.log('follow', data)
            if (!data){
                console.error('follow error', data)
                return
            }
            var source = parent.parents('.users-list-box');
            //console.log(following, parent, $(self))
            parent.detach().prependTo(following.find('.users-list:first'));
            $(self).removeClass('follow').addClass('unfollow');
            following.data('count', following.data('count') + 1);
            source.data('count', source.data('count') - 1);

            fixWidth();
        }).fail(function(d) {
            //console.log('fail', d)
        }).always(function (d) {
            //console.log('always', d)
        });
    })

    following.on('click', '.unfollow', function (e) {
        var parent = $(this).parent(),
            self = this;
        //console.log('click unfollow', this)
        $.get('/users/ajaxUnfollowUser', {id: parent.data('id')}, function (data) {
            //console.log('follow', data)
            if (!data){
                console.error('unfollow error', data)
                return
            }
            //console.log('unfollow', data)
            var role = parent.data('userrole');
            var target = others;

            //console.log(role)
            if (role === 'expert') target = experts;
            else if (role === 'rss') target = portals;
            //console.log(target, parent, $(self))
            parent.detach().prependTo(target.find('.users-list:first'));
            $(self).removeClass('unfollow').addClass('follow');

            target.data('count', target.data('count') + 1);
            following.data('count', following.data('count') - 1);

            fixWidth();
        }).fail(function(d) {
            //console.log('fail', d)
        }).always(function (d) {
            //console.log('always', d)
        });
    });
    

    var loaderMonkey = function () {
        if (loading || $('#rails').hasClass('disabled'))
            return false;

        var height = $(document).height(),
            adjust = -30;

        if (height < 768) adjust = -90;
        else if (height < 900) adjust = -60;
        else if (height > 1200) adjust = 0;
        else if (height > 2048) adjust = 60;

        var winWidth = $(window).width();
        var width = $('#container').outerWidth() + adjust;
        var scroll = $('#wrapper').scrollLeft() + winWidth;
        
        //console.log(scroll > width, scroll, width, winWidth > (width - 210))
        if (scroll > width || winWidth > (width - 210)) {
            //console.log(scroll, width, scroll-width)
            if (mode === 'all' && !allLoaded.others) {
                othersColumns += 2;
                fixWidth();
            } else if (!allLoaded[mode]) {
                numColumns[mode] += 2;
                fixWidth();
            }
            
        }
    }

    $("#wrapper").scroll(loaderMonkey);
    setInterval(loaderMonkey, 1000);

});