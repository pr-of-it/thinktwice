$(function () {

    var following = $('.users-list-following');
    var experts = $('.users-list-experts');
    var portals = $('.users-list-portalse');
    var others = $('.users-list-others');

    var not_following = $('.users-list-box:not(.users-list-following)');

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
        
        console.log(target.attr('class'), target.data('count'))
        target.find('header span').html('Всего (' + target.data('count') + ')');
    };

    var ajaxUpdate = function (target) {

    };

    $('.users-list-box').each(function () {
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
            console.log(following.data('count'), source.data('count'))
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
            console.log(role)
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
    

});