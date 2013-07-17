$(function () {

    var following = $('.users-list-following ul.users-list');
    var experts = $('.users-list-experts ul.users-list');
    var portals = $('.users-list-portalse ul.users-list');
    var others = $('.users-list-others ul.users-list');

    var not_following = $('.users-list-box:not(.users-list-following)');

    var fixVisibility = function (target) {
        var numItems = target.hasClass('users-list-row-2') ? 4 : 6;
        if (target.hasClass('users-list-experts'))
            numItems -= 1;
        target.find('.users-item').slice(numItems).hide();
        target.find('.users-item').slice(0, numItems).show();
        //console.log(target.find('.users-item').slice(0, numItems).length)
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
            }
            parent.detach().prependTo(following);
            $(self).removeClass('follow').addClass('unfollow');
            fixVisibility(following);
            fixVisibility(parent);
        })
    })

    following.on('click', '.unfollow', function (e) {
        var parent = $(this).parent(),
            self = this;
        $.get('/users/ajaxUnfollowUser', {id: parent.data('id')}, function (data) {
            if (!data){
                console.error('unfollow error', data)
            }
            var role = parent.data('userrole');
            var target = others;
            //console.log(role)
            if (role === 'expert') target = experts;
            else if (role === 'rss') target = portals;
            parent.detach().prependTo(target);
            $(self).removeClass('unfollow').addClass('follow');
            fixVisibility(target);
            fixVisibility(parent);
        })
    });
    

});