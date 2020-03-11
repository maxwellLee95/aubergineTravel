/**
 * xsl 20170824
 * loading
 */

function loadingMsg(msg, hidebg, time) {
    if (msg == undefined) {
        msg = 'loadingMsg error: msg undefined';
        hidebg = true;
        time = 1000;
    }
    $('#loading').remove();
    $('body').append('<div id="loading"><div class="loading-bg"></div><div class="loading">' + msg + '</div></div>')
    $('.loading').html(msg);
    $('#loading').show();
    if (hidebg == true) {
        $('.loading').css({
            backgroundSize: 0,
            paddingTop: '15px',
        });
    } else {
        $('.loading').css({
            backgroundSize: '35px',
            paddingTop: '60px',
        });
    }
    $('.loading').css('marginLeft', '-' + (document.querySelector('.loading').offsetWidth / 2) + 'px');
    if (!isNaN(time)) {
        hideLoading(time);
    }
};

function hideLoading(time) {
    setTimeout(function() {
        $('#loading').hide();
    }, time);
};