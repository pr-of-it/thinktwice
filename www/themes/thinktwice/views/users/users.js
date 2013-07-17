$(function () {

    var following = $('.users-list-following');
    var experts = $('.users-list-experts');
    var portals = $('.users-list-portalse');
    var others = $('.users-list-others');

    var not_following = $('.users-list-box:not(.users-list-following,.ajax-loader)');

    $('.users-list-box header:first-child').each(function (e) {
        var header = $(this), parent = header.parent();

        parent.data('count', parseInt(header.find('span').text().substr(7)));
        //console.log(parent.data('count'))

        /*header.css('cursor', 'pointer');
        header.on('click', function () {
            $('.users-list-box').not(parent).hide();
        })*/
    });

    var fixVisibility = function (target) {
        var numItems = target.hasClass('users-list-row-2') ? 4 : 6;
        if (target.hasClass('users-list-experts'))
            numItems -= 1;
        var items = target.find('.users-item:not(.user-plus)');
        items.slice(numItems).hide();
        items.slice(0, numItems).show();

        //console.log(target.attr('class'), numItems, items.length, items.slice(numItems).length)
        //console.log(target.attr('class'), numItems, items.length, items.slice(0, numItems).length)
        
        //console.log(target.attr('class'), target.data('count'))
        target.find('header span').html('Всего (' + target.data('count') + ')');
    };

    var ajaxUpdate = function (target) {

    };



    $('.users-list-box:not(.ajax-loader)').each(function () {
        fixVisibility($(this));
    });
    
    not_following.on('click', '.follow', function (e) {
        var parent = $(this).parent(),
            self = this;
        $.get('/users/ajaxFollowUser', {id: parent.data('id')}, function (data) {
            if (!data){
                console.error('follow error', data)
                return
            }
            var source = parent.parents('.users-list-box');
            parent.detach().prependTo(following);
            $(self).removeClass('follow').addClass('unfollow');
            following.data('count', following.data('count') + 1);
            source.data('count', source.data('count') - 1);
            //console.log(following.data('count'), source.data('count'))
            fixVisibility(following);
            fixVisibility(source);
        });
    })

    following.on('click', '.unfollow', function (e) {
        var parent = $(this).parent(),
            self = this;
        $.get('/users/ajaxUnfollowUser', {id: parent.data('id')}, function (data) {
            if (!data){
                console.error('unfollow error', data)
                return
            }
            var role = parent.data('userrole');
            var target = others;
            //console.log(role)
            if (role === 'expert') target = experts;
            else if (role === 'rss') target = portals;
            parent.detach().prependTo(target);
            $(self).removeClass('unfollow').addClass('follow');

            target.data('count', target.data('count') + 1);
            following.data('count', following.data('count') - 1);

            fixVisibility(target);
            fixVisibility(following);

        })
    });
    

    var numItems = others.find('.users-item').length,
        everythingWasLoaded = false,
        loading = false;

    loadData = function() {
        //console.log('Подгрузка... TODO ', numItems)
        loading = true;

        var loaderFunc = 
        $.get('/users/ajaxGetUsers', {offset: numItems, limit: 20}, function (origData) {
            var data = [];
            for (var i=0; i<origData.length; i++) {
                var item = origData[i];
                if (item.role.name !== 'expert' && item.role.name !== 'rss') {
                    for (var j=0; j < item.followers.length; j++) {
                        var follower = item.followers[j];
                        if (follower.id == window.USER.id)
                            continue;
                    }
                    data.push(item);
                }
            }
            if (data.length === 0) {
                var loader = $('.ajax-loader')
                loader.find('img').hide();
                loader.find('span').text('Все пользователи загружены.').show();
                everythingWasLoaded = true;
                return;
            }
            for (var i=0; i<data.length; i++) {
                var item = data[i];
                var block = others.find('.users-item:first').clone();
                block.find('.avatar-rating img').attr('src', item.avatar);
                var name = block.find('header.name a');
                name.attr('href', '/user/index/' + item.id);
                name.text(item.name);
                block.data('id', item.id);
                block.data('userrole', item.role.name);
                //console.log(item.role.name, item.id);
                others.find('.users-list').append(block);
            }
            fixWidth();
            loading = false;
        });
    }

    fixWidth = function() {
        numItems = others.find('.users-item').length;
        others.find('.users-item').show();
        others.width( ((numItems/2)|0) * 184 );
        $('#container').width($('.users-list-wrap').width() + 500)
    }

    fixWidth();

    $("#wrapper").scroll(function () {
        if ($('#rails').hasClass('disabled'))
            return false;
        var width = $('#container').width() - 90;
        var scroll = $(this).scrollLeft() + $(window).width();

        if (!loading && scroll > width) {
            loadData();
        }


    });

});