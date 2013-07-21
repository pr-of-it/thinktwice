$(function () {

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
        });
    };

    //console.log(usersController)
    //console.log(UsersData)

    $('.users-list-box header:first-child').each(function (e) {
        var header = $(this), parent = header.parent();

        parent.data('count', parseInt(header.find('span').text().substr(7)));
        //console.log(parent.data('count'))

        header.css('cursor', 'pointer');
        /*header.on('click', function () {
            $('.users-list-box').not(parent).hide();
        })*/
    });

    var allLoaded = {
        'following': false,
        'experts': false,
        'portals': false,
        'others': false
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
        usersController[blockName].push(user.id);
        //UsersData[user.id] = user;
        var newBlock = userTemplate(user);
        var target = $('.users-list-' + blockName);
        target.find('.users-list').append(newBlock);
        var plus = target.find('.user-plus');
        if (plus.length)
            plus.detach().appendTo(target.find('.users-list'));
    };

    var loadData = function (blockName, after) {
        $.get('/users/ajaxGetUsers', {
            offset: usersController[blockName].length,
            limit: numItemsToLoad,
            filter: blockName
        }, function (data) {
            console.log('Loading ' + data.length + ' ' + blockName + ' items...')
            //alert(data.length)
            if (data.length === 0) {
                if (blockName === 'others') {
                    var loader = $('.ajax-loader')
                    loader.find('img').hide();
                    loader.find('span').text('Все пользователи загружены.').show();
                }
                allLoaded[blockName] = true;
                loading = false;
                return;
            }
            for (var i=0; i<data.length; i++) {
                var item = data[i];
                loadItem(item, blockName);
            }
            numItems = $('.users-list-' + blockName).find('.users-item').length;
            console.log('Loaded ' + numItems + ' ' + blockName + ' items total.')
            fixWidth();
            loading = false;
            if (after) after();
        });
    }

    var fixVisibility = function (target) {
        var visibleRows = Math.floor($('#rails').height() / 230);
        var numItems = 3 * visibleRows;
        var items = target.find('.users-item:not(.user-plus)');
        if (target.hasClass('users-list-following')) {
            blockName = 'following';
        } else if (target.hasClass('users-list-experts')) {
            numItems -= 1;
            blockName = 'experts';
        } else if (target.hasClass('users-list-portals')) {
            blockName = 'portals';
        } else if (target.hasClass('users-list-others')) {
            if (items.length < 3 * visibleRows) {
                othersColumns = 3;
            } else if (items.length < 5 * visibleRows) {
                othersColumns = 5;
            } 
            numItems = othersColumns * visibleRows;
            target.width(othersColumns * 184);
            blockName = 'others';
        }
        var loadRemaining = function () {
            items = $('.users-list-' + blockName + ' .users-item:not(.user-plus)');
            if (blockName === 'others') {
                numItems = othersColumns * visibleRows;
                //console.log(visibleRows, othersColumns, numItems, items.length,  allLoaded[blockName], blockName)
            }
            if (items.length < numItems && !allLoaded[blockName]) {
                //console.log(items.length, numItems, blockName)
                loadData(blockName);
            }
        }
        loadRemaining();
        items.slice(numItems).hide();
        items.slice(0, numItems).show();
        target.find('header span').html('Всего (' + target.data('count') + ')');
    };

    var fixWidth = function() {
        initUserBlock('following');
        initUserBlock('experts');
        initUserBlock('portals');
        initUserBlock('others');
        $('.users-list-box:not(.ajax-loader)').each(function () {
            fixVisibility($(this));
        });
        var width = $('.users-list-wrap').outerWidth() + 200;
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
            parent.detach().prependTo(following);
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
            console.log(target, parent, $(self))
            parent.detach().prependTo(target);
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
    

    $("#wrapper").scroll(function () {
        if ($('#rails').hasClass('disabled'))
            return false;

        var height = $(document).height(),
            adjust = -30;

        if (height < 768) adjust = -90;
        else if (height < 900) adjust = -60;
        else if (height > 1200) adjust = 0;
        else if (height > 2048) adjust = 60;

        var width = $('#container').outerWidth() + adjust;
        var scroll = $(this).scrollLeft() + $(window).width();
        //console.log(scroll, width, scroll-width)
        if (!loading && !allLoaded.others && scroll > width) {
            fixWidth();
        }
    });

});