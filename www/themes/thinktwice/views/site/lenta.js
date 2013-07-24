$(function () {

if ($('#post-editor').length) {
    var ckconf = {
        toolbar: [['Bold'], ['Italic'], ['Link'], ['Maximize']],
        height: ($('.create-post .wysiwyg-text-field').height() - 74) + 'px',
        uiColor: '#e1e1db',
        dialog_backgroundCoverColor: 'black',
        dialog_backgroundCoverOpacity: 0.6,
        language: 'ru'
    };
    var editor = CKEDITOR.replace('post-editor', ckconf);

    editor.on('contentDom', function() {
        this.document.on('click', function(event){
            $('.create-post').click()
        });
    });
}

var app = Config;

// create config and init classes
app.init();

window.onload = function() {
    app.loadData();
};

$("#wrapper").mousewheel(function (event, delta, deltaX, deltaY) {
    if (app.rails.hasClass('disabled')) {
        return true;
    }
    this.scrollLeft += (deltaX * 90); // трекпад на маке
    this.scrollLeft -= (deltaY * 90); // колесико мыши

    return false;
});

$(document).keydown(function (e) {
    var container = $('#container');

    if (app.rails.hasClass('disabled'))
        return true;

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
app.rails.on('click', '.news-box', function(e){
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
    var data = target.parent().data();

    var popup = $('.window-post');

    var title = target.find('h6').html();
    popup.find('div.scroll header.popup-head').html(title);  // $post->title
    //popup.find('form input.title-field').val(title);
    var text = target.find('.news-body div').html();
    popup.find('div.window-post-text').html(text);  // $post->text
    //popup.find('form textarea').html(text);
    /*if (CKEDITOR.instances['popup-post-editor'])
        CKEDITOR.instances['popup-post-editor'].setData(text);*/
    popup.find('.author b').html( target.find('header.news-author').html() );  // $post->blog->title

    popup.find('.article-info img').attr('src', data.avatar);
    popup.find('.article-info .user-name').text(data.user_name || '');
    popup.find('.article-info a').attr('href', app.makeUrl('/user/?id=' + data.uid));


    $.get(app.makeUrl('/blog/ajaxGetPostEditForm'),
        {id: data.id}, function (d) {
            if (app.editor) {
                app.editor.destroy();
            }
            var uploader = popup.find('.file-upload-wrapper').detach();
            var uploaderContent = uploader.find('.file-upload-container')
            uploader.find('.hidden-image').remove();
            uploader.find('.attach-list').html('');
            popup.find('form').html(d);
            popup.find('.tag-attach-box').append(uploader);

            var media = $('<ul class="attach-list media-list" />');

            for (var i=0; i < data.media.length; i++ ) {
                var item = data.media[i];
                media.append('<li><img src="' + item.url  +'"><span data-id="' +  item.id + '">Удалить</span></li>');
            }
            uploaderContent.append(media);
            //uploaderContent.width(media.width());

            if (popup.find('#popup-post-editor').length) {
                app.editor = CKEDITOR.replace('popup-post-editor', app.ckconf);
            }
            popup.find('select').styler();
    }); // TODO: обработка ошибок связи

    //popup.find('form input.id-field').val(data.id);

    var imgTarget = target.find('.image-gallery-min-full'),
        img = popup.find('div.window-post-image');
    img.css('height', '417px')
    if (imgTarget.length) {
        var bg = imgTarget.css('background-image');
        var src = bg.replace(/(^url\()|(\)$)/g, '');
        var temp = new Image();
        temp.onload = function() {
            var targetWidth = popup.find('article').width();
            img.css('width', targetWidth + 'px');
            //console.log(targetWidth, this.width, this.height)
            if (this.width < targetWidth) {
                img.css('background-size', 'auto');
            } else {
                img.css('background-size', 'cover');
            }
            if (temp.height < 417)
                img.css('height', temp.height + 'px');
        };
        temp.src = src;
        img.css('background-image', bg);
        img.show();
    } else {
        img.hide();
    }
    popup.removeClass('edit-post');
    app.bgPopup.show();
    $('#rails').addClass('disabled');
    popup.addClass('visible-on');
})

// скрываем окна
$('body').on('click', '.close-popup,#popup-wrapper,#bg-popup', function(e){
    var target = $(e.target);
    if (
            (!target.hasClass('close-popup') &&
            (target.hasClass('window-post') || target.parents('.window-post').length))
            ||
            (target.hasClass('create-post') || target.parents('.create-post').length)
        )
    {
        return true;
    }
    $('#rails').removeClass('disabled')
    $('.create-post').addClass('opacity-hide')
    $('.window-post').removeClass('visible-on');
    app.bgPopup.hide();

    return false;
});

$('.edit-post-button,.window-post .button-cancel').on('click', function(e) {
    e.preventDefault();
    var popup = $(this).parents('.window-post');
    popup.toggleClass('edit-post');
    return false;
});

// Удаление изображений при редактировании поста
$('#blog-edit-form').on('click', '.media-list li > span', function () {
    var self = this;
    $.get('/blog/ajaxDeletePostMedia', {id: $(self).data('id')}, function(d) {
        $(self).parent().remove();
    });
})

// открываем редактор для поста
$('.create-post').click(function(){
    if($('.window-post').hasClass('visible-on'))
        return true;
    if($(this).hasClass('opacity-hide')){
        //$('#popup-wrapper').css('z-index', 100);
        //$('#popup-wrapper').css('pointer-events', 'auto');
        app.bgPopup.show();
        $(this).removeClass('opacity-hide');
        $('#rails').addClass('disabled');
    }

    //else return false;
})

/**
 *  Подгрузка контетна в ленту
 */


$("#wrapper").scroll(function () {
    if (app.rails.hasClass('disabled'))
        return false;
    var width = app.setWidth() - 300;
    var scroll = $(this).scrollLeft() + $(window).width();

    if (app.rails.hasClass('quick-start'))
        width += ($('.quick-start-box').outerWidth() + 90);

    if (!app.postsAreLoading && !app.everythingWasLoaded && scroll > width) {
        //alert([width, scroll]);
        app.loadData();
    }


});

});