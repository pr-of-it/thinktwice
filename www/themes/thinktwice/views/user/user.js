$(function () {

var app = Config;

// create config and init classes
app.init();

setWidth = function(is_set) {
    var width = 0;
    $('> .step-day', app.rails).each(function(){
        width += $(this).outerWidth(true);
    })
    if(is_set == 'set') {
        var containerWidth = width;
        $('#container').width(containerWidth + 200);

        app.rails.width(width * 2);
    }
    return width;
}

window.onload = function() {
    setWidth('set');
};

$("#wrapper").mousewheel(function (event, delta, deltaX, deltaY) {
    this.scrollLeft += (deltaX * 90); // трекпад на маке
    this.scrollLeft -= (deltaY * 90); // колесико мыши

    return false;
});

$('.link-advice').click(function(){
    app.bgPopup.show();
    $('#rails').addClass('disabled');
    $('.get-call').addClass('visible-on');
});

// скрываем окна
$('body').on('click', '.close-popup,#bg-popup', function(e){
    var target = $(e.target);
    $('#rails').removeClass('disabled')
    $('.get-call').removeClass('visible-on')
    app.bgPopup.hide();
    return false;
});


$("#slider").slider({
    range: "min",
    min: 15,
    max: 60,
    step: 15,
    value: 15,
    slide: function(event, ui) {
        var delay = function() {
            $( "#CallRequest_duration" ).val( ui.value );
            $( "#slider-result" ).html( ui.value *  parseFloat(USER.consult_price || "0"));
            $(".call-charge").html( ui.value * parseFloat(USER.consult_price || "0") );
            $(".call-duration").html( ui.value + " минут" );
            var handleIndex = $(ui.handle).data('index.uiSliderHandle');
            var label = '#min';
            $(label).html(ui.value).position({
                my: 'center top',
                at: 'center bottom',
                of: ui.handle,
                offset: "0,15"
            });
        };

        // wait for the ui.handle to set its position
        setTimeout(delay, 5);
    }
});

$('#min').html($('#slider').slider('values', 0)).position({
    my: 'center top',
    at: 'center bottom',
    of: $('#slider a:eq(0)'),
    offset: "0, 10"
});


$('.call-time-select').click(function(){
    $('.call-time-data').hide();
    $(this).next('.call-time-data').show();
});

$('.time-var span').click(function(){
    $(this).parents('.call-time-data').css('display', 'none');
});

$("#call-tabs-1, #call-tabs-2, #call-tabs-3").tabs();               


makeUrl = function(url) {
    return url;
};


$('.get-call .do-confirm input[type=button].change-phone').on('click', function () {
    var parent = $(this).parents('.do-confirm');
    var changeButton = $(this);
    var error = $(this).parent().find('.error').hide();
    var phone = parent.find('input[type=text][size=3]').val() + parent.find('input[type=text][size=7]').val();
    if (phone.length !== 10 || !/\d+/.test(phone)) {
        error.show();
        return false;
    }

    $.get(makeUrl('/user/ajaxRequestPhoneVerify'), {
            phone: '7' + phone
        }, function(data) {
            var code = data.code;
            //console.log(phone, code);
            changeButton.prop('disabled', true).css('opacity', .5);
            parent.find('input[type=text][size=5]').show();
            parent.find('input[type=button].confirm').show();
            var label = parent.find('.text-code-label');
            if (label.length)
                label.show();
            parent.find('.change-number').addClass('confirm-number');
            parent.find('.confirm-number-2').show();
            parent.find('input[type=text][size=3]').prop('disabled', true).show();
            parent.find('input[type=text][size=7]').prop('disabled', true).show();
    });
    
});

$('.get-call .do-confirm input[type=button].confirm').on('click', function () {
    var parent = $(this).parents('.do-confirm');

    var error = $(this).parent().find('.error').hide();
    var phone = parent.find('input[type=text][size=3]').val() + parent.find('input[type=text][size=7]').val();
    var code = parent.find('input[type=text][size=5]').val();
    if (code.length !== 6) {
        error.show();
        return false;
    }

    $.get(makeUrl('/user/ajaxVerifyPhoneCode'), {
        code: code
        }, function(data) {
            //console.log(data);
            if (data === true) {
                parent.find('input,.text,br').hide();
                parent.find('.header').text('Эксперт будет звонить на номер:')
                parent.append('<span class="text">+7 (' + phone.substr(0, 3) + ') ' + phone.substr(3, 7));
            } else {
                error.text('Неправильный код.').show();
            }
    });
    
});

});